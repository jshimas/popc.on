<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // ============ GENERAL STATISTICS ===============
        $avgServiceRating = DB::table('reviews')
            ->join('review_type', 'review_type.id', '=', 'reviews.type')
            ->where('review_type.type', '=', 'service')
            ->avg('reviews.rating');

        $pastShowtimes = DB::select(DB::raw("SELECT showtimes.id FROM showtimes WHERE showtimes.date < CURDATE()"));
        $totalTicketsBeforeToday = DB::select(DB::raw("SELECT SUM(showtimes.ticket_quantity) AS total FROM showtimes WHERE showtimes.date < CURDATE()"))[0]->total;
        
        $totalBookedTicketsBeforeToday = 0;
        foreach ($pastShowtimes as $showtime) {
            $bookedTickets = DB::table('tickets')
                ->where('showtime_fk', '=', $showtime->id)
                ->sum('tickets.quantity');
            $totalBookedTicketsBeforeToday += $bookedTickets;
        }
        $avgOccupancy = round($totalBookedTicketsBeforeToday / $totalTicketsBeforeToday * 100, 0);

        $ticketSoldThisYear = DB::table('tickets')
            ->join('showtimes', 'showtimes.id', '=', 'tickets.showtime_fk')
            ->whereBetween('showtimes.date', [
                Carbon::now()->startOfYear(),
                Carbon::now()->endOfYear(),
            ])
            ->sum('tickets.quantity');  
        
        $revenue = DB::table('tickets')
            ->select(DB::raw('sum(tickets.quantity * showtimes.price) as revenue'))
            ->join('showtimes', 'showtimes.id', '=', 'tickets.showtime_fk')
            ->whereBetween('showtimes.date', [
                Carbon::now()->startOfYear(),
                Carbon::now()->endOfYear(),
            ])
            ->first()
            ->revenue;

        // =========== BEST MOVIE STATISTICS =============
        $movieOfTheYear = DB::table('movies')
            ->select(DB::raw(
                'movies.id,
                sum(tickets.quantity * showtimes.price) as revenue,
                sum(tickets.quantity) as bookedTickets,
                sum(showtimes.ticket_quantity) as totalTickets'))
            ->join('showtimes', 'showtimes.movie_fk', '=', 'movies.id')
            ->join('tickets', 'tickets.showtime_fk', '=', 'showtimes.id')
            ->groupBy('movies.id')
            ->orderBy('revenue', 'desc')
            ->first();
        
        $totalTickets = DB::table('showtimes')
            ->where('showtimes.movie_fk', $movieOfTheYear->id)
            ->sum('showtimes.ticket_quantity');
        
        $bestMovieData = DB::table('movies')
            ->where('movies.id', $movieOfTheYear->id)
            ->first();

        $avgMovieRating = DB::table('reviews')
            ->where('movie_fk', $movieOfTheYear->id)
            ->avg('rating');
        
        $avgMovieServiceRating = DB::table('reviews')
            ->join('showtimes', 'showtimes.id', '=', 'reviews.showtime_fk')
            ->where('showtimes.movie_fk', $movieOfTheYear->id)
            ->avg('rating');

        // ================== CHART =======================
        $moviesRevenues = DB::table('movies')
            ->select(DB::raw(
                'movies.id,
                movies.name,
                sum(tickets.quantity * showtimes.price) as revenue'))
            ->join('showtimes', 'showtimes.movie_fk', '=', 'movies.id')
            ->join('tickets', 'tickets.showtime_fk', '=', 'showtimes.id')
            ->groupBy('movies.id')
            ->orderBy('revenue', 'desc')
            ->limit(5)
            ->get()->toArray();

        $chartData[] = ['Filmai','Pajamos, eur'];
        foreach ($moviesRevenues as $val) {
            $chartData[] = [$val->name, (int)$val->revenue];
        }
        
        // ================== REVIEWS =====================
        $lastMovieReviews = DB::table('reviews')
            ->select(
                'reviews.id AS id',
                'users.username',
                'reviews.rating',
                'movies.name AS movie',
                'reviews.comment')
            ->join('movies', 'movies.id', '=', 'reviews.movie_fk')
            ->join('users', 'users.id', '=', 'reviews.user_fk')
            ->where('reviews.type', 1)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
        $lastServiceReviews = DB::table('reviews')
            ->select(
                'reviews.id AS id',
                'users.username',
                'reviews.rating',
                'movies.name AS movie',
                'showtimes.date',
                'showtimes.time',
                'reviews.comment')
            ->join('showtimes', 'showtimes.id', '=', 'reviews.showtime_fk')
            ->join('movies', 'movies.id', '=', 'showtimes.movie_fk')
            ->join('users', 'users.id', '=', 'reviews.user_fk')
            ->where('reviews.type', 2)
            ->orderBy('created_at', 'desc')
            ->limit(5)
            ->get();
        
            // dd($lastMovieReviews);
                           
        return view('statistic.index', [
            'statistics' => (object)[
                'theater' => (object)[
                    'service_rating' => round($avgServiceRating, 2),
                    'avg_occupancy' => round($avgOccupancy, 0),
                    'tickets_sold' => $ticketSoldThisYear,
                    'yearly_revenue' => $revenue,
                ],
                'movie_of_the_year' => (object)[
                    'movie_name' => $bestMovieData->name,
                    'occupancy' => round($movieOfTheYear->bookedTickets / $totalTickets * 100, 0),
                    'service_rating' => round($avgMovieServiceRating , 2),
                    'movie_rating' => round($avgMovieRating , 2),
                    'revenue' => $movieOfTheYear->revenue,
                ],
                'chartData' => $chartData,
                'movie_reviews' => $lastMovieReviews,
                'service_reviews' => $lastServiceReviews,
            ]
        ]);
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
