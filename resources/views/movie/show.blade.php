@extends('layout')

@section('content')
    <div>
        <h2 class="font-semibold text-3xl text-center mb-8 mt-1 tracking-wider bg-pink-600 text-white rounded-md py-6 px-5">{{$movie->name}}</h2>
        <div class="flex mb-12">
            <div class="flex-1 text-gray-700">
                <p class="text-end border-solid border-2 border-gray-500  rounded-md p-1 inline-block font-semibold mb-4">{{$movie->rating}}</p>
                <div class="flex flex-col gap-1 mb-12 text-md font-medium  tracking-wider">
                    <p>Metai: {{$movie->year}}</p>
                    <p>Režisierius: {{$movie->director}}</p>
                    <p>Žanras: {{$movie->genre}}</p>
                </div>
            </div>
            <div class="flex-1">
                <p class="text-gray-700 rounded-md font-semibold mb-4 text-xl uppercase">Bilietai</p>
                <div class="flex flex-col gap-4">
                    @foreach($movie->showtimes as $showtime)
                    <div>
                        <p>{{$showtime->date}}</p>    
                        <div class="flex items-center gap-3 font-semibold rounded-md"> 
                            <div class="flex items-center w-96 ">
                                <p class="text-2xl">{{$showtime->time}}</p> 
                                <p class="text-md border-solid border-2 border-white rounded-md px-3 py-1 "><span class="uppercase font-light text-gray-500">Kaina: </span>{{$showtime->price}} €</p>    
                                <p class="text-md border-solid border-2 border-white rounded-md px-3 py-1 "><span class="uppercase font-light text-gray-500">Užimtumas: </span>{{ round($showtime->occupancy, 0) }} %</p>    
                            </div>                              
                            @if (Auth::check())
                                <a href='/tickets/new?showtimeId={{$showtime->id}}' class="border-solid border-2 rounded-md border-pink-700 text-pink-700 font-semibold hover:bg-pink-50 py-1 px-4">Užsakyti</a>
                            @endif                     
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <p class="font-semibold text-2xl text-gray-700 mb-5 border-solid border-b border-gray-300 pb-3">Komentarai</p>  
        @if (Auth::check())            
            <a 
            href="/comments/new/movie/{{ $movie->id }}" 
            class="inline-block mb-5 border-solid border-2 rounded-md border-pink-700 text-pink-700 font-semibold hover:bg-pink-50 py-1 px-4"
            >
            &plus; Naujas komentaras
            </a>        
        @endif 
        <div class="flex flex-col gap-8">
            @foreach($movie->reviews as $review)
                <x-review-card :review="$review" />
            @endforeach
        </div>
    </div>
@endsection
