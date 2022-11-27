<?php

namespace App\Http\Controllers;

use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\URL;

class CommentsController extends Controller
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
    public function create(Request $request)
    {
        $commentType = $request->type;
        $commentableId = $request->id;

        $movieName = '';
        $date = '';
        $time = '';
        if ($commentType == 'movie') {
            $movie = DB::table('movies')
                ->where('movies.id', '=', $commentableId)
                ->select('movies.name AS movieName')
                ->first();

            $movieName = $movie->movieName;
        } 
        elseif ($commentType == 'service') {
            $serviceInfo = DB::table('showtimes')
                ->join('movies', 'movies.id', '=', 'showtimes.movie_fk')
                ->where('showtimes.id', '=', $commentableId)
                ->select('showtimes.date', 'showtimes.time', 'movies.name')
                ->first();  

            $movieName = $serviceInfo->name;
            $date = $serviceInfo->date;
            $time = $serviceInfo->time;
        } 
        else {
            return 'Page Not Found...';
        }

        return view('comment.create', [
            'type' => $commentType,
            'id' => $commentableId,
            'header' => (object)[
                'movieName' => $movieName,
                'date' => $date,
                'time' => $time,
            ],
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
        $typeId = DB::table('review_type')
            ->where('type', '=', $request->type)
            ->first()
            ->id;

        date_default_timezone_set('Europe/Vilnius');
        Review::create([
            'rating' => $request->rating,
            'comment' => $request->comment,
            'type' => $typeId,
            'created_at' => date('Y-m-d H:i:s'),
            'movie_fk' => $request->type == 'movie' ? $request->commentableId : null,
            'showtime_fk' => $request->type == 'service' ? $request->commentableId : null,
            'user_fk' => Auth::id(),
        ]);
        return redirect($request->type == 'movie' ? "/movies/$request->commentableId" : "/tickets");
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
