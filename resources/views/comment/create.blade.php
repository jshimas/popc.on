@extends('layout')

@section('content')
<div>
    <a href="{{ URL::previous() }}" class="text-pink-700 py-1 px-3 hover:bg-pink-50 rounded-md"><- Grįžti</a>
    <div class="flex flex-col items-center">
        <div class=" items-end border-solid border-b border-gray-300 mb-8 pb-5">
            @if ($type == 'movie')
                <div>
                    <p class="text-5xl text-center text-gray-700 mb-2 ">Atsiliepimas apie filmą</p>
                    <p class="text-xl text-center text-gray-700 uppercase tracking-wider">{{ $header->movieName }}</p>
                </div>
            @elseif ($type == 'service')
                <div>
                    <p class="text-5xl text-center text-gray-700 mb-4">Atsiliepimas apie aptarnavimą</p>
                    <p class="text-xl text-center text-gray-700 ">{{ $header->movieName }} &centerdot; {{ $header->date }} - {{ $header->time }}</p>
                </div>
            @endif
        </a>
    </div>
    {{-- <form class="w-96 flex flex-col" action="/comments/{{ $type }}/{{ $id }}" method="POST"> --}}
    <form class="w-96 flex flex-col" action="/comments" method="POST">
        @csrf
        <div class="mb-6">
            <label for="rating" class="block mb-2 text-sm font-medium text-gray-900">Įvertinimas</label>
            <select id="rating" name="rating" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-pink-700 focus:border-pink-700 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-pink-700 dark:focus:border-pink-700">
                <option selected>Pasirinkite įvertinimą</option>
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>                
            </select>
        </div>
        <div class="mb-6">
            <label for="comment" class="block mb-2 text-sm font-medium text-gray-900">Komentaras</label>
            <textarea id="comment" name="comment" rows="6" cols="80" class="bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-pink-700 focus:border-pink-700 block w-full p-2.5 " required ></textarea>
        </div>  
        <input type="hidden" name="type" value="{{ $type }}">
        <input type="hidden" name="commentableId" value="{{ $id }}">      
        <button type="submit" class="text-white font-semibold bg-pink-600 hover:bg-pink-700 focus:ring-4 focus:outline-none focus:ring-pink-300 rounded-lg text-sm w-full sm:w-auto px-5 py-2.5 text-center">Pateikti</button>
    </form>
</div>
@endsection
