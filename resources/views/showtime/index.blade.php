@extends('layout')

@section('content')
    <div>
        <div class="flex justify-between items-end border-solid border-b border-gray-300 mb-8 pb-5">
            <p class="text-5xl text-left text-gray-700">Kino seansai</p> 
            @if (Auth::check() && Auth::user()->role == 'admin')                
                <a href="/showtimes/new" class="border-solid border-2 rounded-md border-pink-700 text-pink-700 font-semibold hover:bg-pink-100 py-1 px-4 transition duration-100 ease-in-out">
                    <div class="flex items-center justify-center"><span class="mr-3 p-0">&plus;</span>Naujas seansas</div>
                </a>
            @endif 
        </div>
        <div class="flex justify-center">
            <div class="w-2/3 grid grid-cols-2 gap-6 ">
                @foreach ($movies as $movie)
                <x-movie-card :movie="$movie" />
                @endforeach
            </div>
        </div>
    </div>
@endsection
