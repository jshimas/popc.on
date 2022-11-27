@extends('authentication.layout')

@section('content')
    <div class="w-1/4 p-12 bg-white rounded-md flex flex-col shadow-xl">
        <h4 class="text-3xl text-center font-semibold mb-1">POPC.<span class="text-pink-600">ON</span></h4>
        <form class="flex flex-col gap-4" action="/login" method="POST">
          @csrf
            <p class="mb-4 font-semibold text-gray-700 text-center uppercase tracking-wide">Prisijungimas</p>            
              <input
                type="text"
                class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-pink-700 focus:border-pink-700 focus:outline-none"
                id="email"
                name="email"
                placeholder="El. paštas"
                value="{{ old('email') }}"
              /> 
              <div>
                <input
                type="password"
                class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:ring-pink-700 focus:border-pink-700 focus:outline-none"
                id="password"
                name="password"
                placeholder="Slaptažodis"
                />          
                @error('email')
                  <div class="text-red-700 mt-1">{{ $message }}</div>
                @enderror    
              </div>                
            <div class="text-center pt-1 pb-1">
              <button
                class="px-6 py-2.5 text-white bg-pink-600 font-semibold text-sm leading-tight uppercase rounded shadow-md hover:bg-pink-700 transition duration-150 ease-in-out w-full focus:ring-4 focus:outline-none focus:ring-pink-300"
                type="submit"
                data-mdb-ripple="true"
                data-mdb-ripple-color="light"                
              >
                Prisijungti
              </button>
            </div>
            <a href="/signup" class="w-fit ml-auto text-gray-600 underline hover:text-pink-700 transition ease-in-out duration-75">Neturite paskyros? Prisiregistruokite</a>
            </div>
          </form>
    </div>
@endsection