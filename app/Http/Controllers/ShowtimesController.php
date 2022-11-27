<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Showtime;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class ShowtimesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $movies = DB::table('movies')
            ->select('*', 'age_rating.rating AS age_rating', 'movies.id AS id')
            ->join('age_rating', 'age_rating.id', '=', 'movies.age_rating')
            ->join('showtimes', 'showtimes.movie_fk', '=', 'movies.id')
            ->groupBy('movies.id')
            ->get();

        foreach($movies as $movie) {
            $showtimes = DB::table('showtimes')
                ->where('showtimes.movie_fk', '=', $movie->id)
                ->where('showtimes.date', '>', Carbon::now())
                ->get();
            $movie->showtimes = $showtimes;
        }        

        // dd($movies);

        return view('showtime.index', [
            'movies' => $movies
        ]);        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $movies = DB::table('movies')->select('movies.id', 'movies.name')->get();
 
        return view('showtime.create', [
            'movies' => $movies
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
        // dd($request);
        $validator = Validator::make($request->all(), 
        [
            'movieId'         => "numeric|required",
            'date'            => "date|required|after_or_equal:tomorrow",
            'time'            => ["required", "regex:/^([0-9]|0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/"],
            'ticket_quantity' => "numeric|required|min:1",
            'price'           => "numeric|required|min:0",
        ], 
        [
            'required'        => 'Šis laukas yra privalomas',
            'after_or_equal'  => 'Pasirinkite ateites datą',
            'regex'           => 'Neatitinka formatas',
            'min'             => 'Mažiausias galimas kieis :min',
        ]);

        if ($validator->fails()) {
            return redirect("showtimes/new")
                        ->withErrors($validator)
                        ->withInput();
        }

        Showtime::create([
            'movie_fk'        => $request->input('movieId'),
            'date'            => $request->input('date'),
            'date'            => date('Y-m-d', strtotime($request->input('date'))),
            'time'            => $request->input('time'),
            'ticket_quantity' => $request->input('ticket_quantity'),
            'price'           => $request->input('price')
        ]);

        return redirect('/');
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
