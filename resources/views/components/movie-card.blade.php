@props(['movie'])

<a href="/movies/{{$movie->id}}">
    <div class="flex flex-col h-full p-5 border-solid border border-gray-300 rounded-xl transition ease-in-out hover:shadow-lg hover:duration-150 hover:border-pink-600">
        <div class="flex justify-between items-start mb-5 grow">
            <div>
                <p class="text-2xl font-semibold mb-1">{{$movie->name}}</p>
                <p class="uppercase text-sm text-gray-700 tracking-widest">{{$movie->genre}}</p>
            </div>
            <p class="text-end border-solid border-2 border-pink-600 text-pink-600 rounded-md p-1 inline-block font-semibold">{{$movie->age_rating}}</p>
        </div>        
        <div class="flex flex-col gap-2">
            @foreach($movie->showtimes as $showtime)
                <x-showtime-card :showtime="$showtime" />
            @endforeach
        </div>
    </div>
</a>