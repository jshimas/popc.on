<?php

namespace App\Http\Controllers;

use App\Models\Showtime;
use App\Models\Ticket;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TicketsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tickets = DB::table('tickets')
            ->join('showtimes', 'showtimes.id', '=', 'tickets.showtime_fk')
            ->join('movies', 'movies.id', '=', 'showtimes.movie_fk')
            ->join('age_rating', 'age_rating.id', '=', 'movies.age_rating')
            ->where('user_fk', '=', Auth::id())
            ->select('tickets.id', 'tickets.quantity', 'tickets.order_date',
                'movies.name', 'movies.genre', 'age_rating.rating AS age_rating', 
                'showtimes.id AS showtime_id', 'showtimes.date', 'showtimes.time')
            ->orderBy('showtimes.date', 'asc')
            ->orderBy('showtimes.time', 'asc')
            ->get();

        return view('ticket.index', [
            'tickets' => $tickets
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $showtimeId = $request->showtimeId;
        $ticketsCount = Ticket::where('tickets.showtime_fk', $showtimeId)->sum('tickets.quantity');

        $ticketInfo = DB::table('showtimes')
            ->join('movies', 'movies.id', '=', 'showtimes.movie_fk')
            ->join('age_rating', 'age_rating.id', '=', 'movies.age_rating')
            ->where('showtimes.id', $showtimeId)
            ->select('age_rating.rating AS age_rating', 'movies.name', 'movies.director', 'movies.length', 'showtimes.date', 'showtimes.time', 'showtimes.price', 'showtimes.ticket_quantity', 'showtimes.id AS showtimeId')
            ->first();

        $ticketInfo->occupancy = $ticketsCount / $ticketInfo->ticket_quantity * 100;

        return view('ticket.create', [
            'ticket' => $ticketInfo
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request->all());
        $ticketsBooked = Ticket::where('tickets.showtime_fk', $request->showtimeId)->sum('tickets.quantity');
        $totalTickets = Showtime::where('id', $request->input('showtimeId'))->select('showtimes.ticket_quantity')->first()->ticket_quantity;
        $ticketsLeft = $totalTickets - $ticketsBooked;

        $validator = Validator::make($request->all(), 
        [
            'tickets_quantity' => "numeric|required|min:1|max:$ticketsLeft",
        ], 
        [
            'required' => 'Bilietų kiekis yra privalomas.',
            'min'      => 'Reikia užsakyti bent vieną bilietą',
            'max'      => "Maksimalus bilietų kiekis: $ticketsLeft.",
        ]);

        if ($validator->fails()) {
            return redirect("tickets/new?showtimeId=$request->showtimeId")
                        ->withErrors($validator)
                        ->withInput();
        }

        Ticket::create([
            'quantity' => $request->input('tickets_quantity'),
            'showtime_fk' => $request->input('showtimeId'),
            'user_fk' => Auth::id(),
            'order_date' => date("Y-m-d")
        ]);

        return redirect('/tickets');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
