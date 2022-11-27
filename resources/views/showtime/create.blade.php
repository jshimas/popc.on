@extends('layout')

@section('content')
    <div class="flex flex-col items-center">
      <a href="{{ URL::previous() }}" class="text-pink-700 py-1 px-3 hover:bg-pink-50 rounded-md absolute left-72"><- Grįžti</a>
        <div class=" items-end border-solid border-b border-gray-300 mb-8 pb-5">
            <p class="text-5xl text-center text-gray-700">Naujas seansas</p>  
            </a>
        </div>
        <form action="/showtimes" method="POST" class="w-96 flex flex-col">
          @csrf
            <div class="mb-6">
              <label for="movie" class="block mb-2 text-sm font-medium text-gray-900">Filmas</label>
              <select id="movieId" name="movieId" class="@error('movieId') is-invalid @enderror bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-pink-700 focus:border-pink-700 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-pink-700 dark:focus:border-pink-700">
                <option @if(empty(old('movieId'))) selected @endif>Pasirinkite filmą</option>
                  @foreach($movies as $movie)
                    <option @if(!empty(old('movieId')) && $movie->id == old('movieId')) selected @endif value="{{ $movie->id }}">{{ $movie->name }}</option>
                  @endforeach
                </select>
                @error('movieId')
                  <div class="text-red-700 mt-1">{{ $message }}</div>
                @enderror  
            </div>
            <div class="mb-6">
              <label for="date" class="block text-sm font-medium text-gray-900 dark:text-gray-300">Seanso diena</label>
              <div class="relative">
                <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
                  <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z" clip-rule="evenodd"></path></svg>
                </div>
                <input datepicker datepicker-autohide id="date" name="date" type="text" value="{{ old('date') }}" class="@error('date') is-invalid @enderror bg-white border border-gray-300 text-gray-900 sm:text-sm rounded-lg focus:ring-pink-700 focus:border-pink-700 block w-full pl-10 p-2.5 " placeholder="Pasirinkite seanso dieną"></input>                 
              </div>
              @error('date')
                  <div class="text-red-700 mt-1">{{ $message }}</div>
              @enderror 
            </div>
              
            <div class="mb-6">
                <label for="time" class="block mb-2 text-sm font-medium text-gray-900">Seanso pradžia</label>
                <input type="text" id="time" name="time" value="{{ old('time') }}" class="@error('time') is-invalid @enderror bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-pink-700 focus:border-pink-700 block w-full p-2.5 " placeholder="Įveskite laiką formatu hh:mm" required>
                </input>
                @error('time')
                  <div class="text-red-700 mt-1">{{ $message }}</div>
                @enderror  
            </div>
            <div class="mb-6">
                <label for="ticket_quantity" class="block mb-2 text-sm font-medium text-gray-900">Bilietų kiekis</label>
                <input type="number" id="ticket_quantity" name="ticket_quantity" value="{{ old('ticket_quantity') }}" class="@error('ticket_quantity') is-invalid @enderror bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-pink-700 focus:border-pink-700 block w-full p-2.5 " required>
                </input>
                @error('ticket_quantity')
                  <div class="text-red-700 mt-1">{{ $message }}</div>
                @enderror  
            </div>
            <div class="mb-6">
                <label for="price" class="block mb-2 text-sm font-medium text-gray-900">Bilieto kaina</label>
                <input type="text" id="price" name="price" value="{{ old('price') }}" class="@error('price') is-invalid @enderror bg-white border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-pink-700 focus:border-pink-700 block w-full p-2.5 " required>
                </input>
                @error('price')
                  <div class="text-red-700 mt-1">{{ $message }}</div>
                @enderror  
            </div>
            
            <button type="submit" class="text-white font-semibold bg-pink-600 hover:bg-pink-700 focus:ring-4 focus:outline-none focus:ring-pink-300 rounded-lg text-sm w-full px-5 py-2.5 text-center">Sukurti</button>
          </form>
    </div>
@endsection
