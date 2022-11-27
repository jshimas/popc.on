<?php

namespace App\Http\Controllers;

use App\Models\Showtime;
use App\Models\Ticket;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MoviesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {       
        $movie = DB::table('movies')            
            ->join('age_rating', 'age_rating.id', '=', 'movies.age_rating')
            ->where('movies.id', '=', $id)
            ->select('*', 'movies.id AS id')
            ->first();
        $showtimes = Showtime::where('showtimes.movie_fk', '=', $id)
            ->where('showtimes.date', '>', Carbon::now())
            ->get();

        $reviews = DB::table('reviews')
            ->join('users', 'users.id', '=', 'reviews.user_fk')
            ->where('movie_fk', $id)
            ->select('reviews.id AS review_id', 'users.id AS user_id', 'users.username', 'reviews.rating', 'reviews.comment')
            ->get();        

            foreach($showtimes as $showtime) {
                $tickets_booked = Ticket::where('showtime_fk', '=', $showtime->id)->sum('tickets.quantity');
                $showtime['occupancy'] = $tickets_booked / $showtime->ticket_quantity * 100;
            }
            
        $movie->showtimes = $showtimes;
        $movie->reviews = $reviews;

        return view('movie.show', [
            'movie' => $movie
        ]);
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
