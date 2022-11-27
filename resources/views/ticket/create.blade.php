@extends('layout')

@section('content')
    <a href="{{ URL::previous() }}" class="text-pink-700 py-1 px-3 hover:bg-pink-50 rounded-md self-start">&larr; Grįžti</a>
    <form class="flex flex-col items-center" action="/tickets" method="POST">
        @csrf
        <p class="text-5xl text-left text-gray-700 border-solid border-b border-gray-300 mb-8 pb-5 px-28">Bilietas</p>            
        <p class="text-lg uppercase font-semibold text-gray-400">Filmas</p>
        <p class="text-3xl font-semibold mb-4">{{ $ticket->name }}</p>
        <div class="flex gap-5 justify-center w-full">
            <div class="flex flex-col w-1/2 items-end gap-2 text-gray-500 mb-4">
                <p>Amžiaus cenzas</p>
                <p>Režisierius</p>
                <p>Trukmė</p>
                </div>
            <div class="flex flex-col w-1/2 gap-2 items-start">
                <p>{{ $ticket->age_rating }}</p>
                <p>{{ $ticket->director }}</p>
                <p>{{ $ticket->length }}</p>
            </div>
        </div>
        <p class="text-xl font-semibold mb-2">Seansas</p>
        <div class="flex gap-5 justify-center w-full mb-4">
            <div class="flex flex-col w-1/2 items-end gap-2 text-gray-500 mb-4">
                <p>Data</p>
                <p>Laikas</p>
                <p>Užimtumas</p>
                <p>Kaina</p>
                </div>
            <div class="flex flex-col w-1/2 gap-2 items-start">
                <p>{{ $ticket->date }}</p>
                <p>{{ $ticket->time }}</p>
                <p>{{ round($ticket->occupancy, 0) }} %</p>
                <p>{{ $ticket->price }} &euro;</p>
            </div>
        </div>
        <div class="flex items-center gap-12 justify-center w-full">
            <div class="flex gap-4 items-center">
                <label for="tickets_quantity" class="block mb-2 text-md font-semibold text-gray-700">Bilietų kiekis</label>
                <input type="number" name="tickets_quantity" id="tickets_quantity" value="{{ old('tickets_quantity') }}" class="@error('tickets_quantity') is-invalid @enderror bg-white border border-gray-300 text-gray-700 text-sm rounded-lg focus:ring-pink-700 focus:border-pink-700 block w-32 p-2.5 " required></input>
            </div>                
            <input type="hidden" name="showtimeId" value="{{ $ticket->showtimeId }}">
            <button type="submit" class="text-white bg-pink-600 hover:bg-pink-700 focus:ring-4 focus:outline-none focus:ring-pink-300 font-semibold rounded-lg text-sm px-5 py-2.5 text-center">Užsakyti</button>
        </div>
        @error('tickets_quantity')
            <div class="text-red-700 mt-4">{{ $message }}</div>
        @enderror  
    </form>
@endsection
