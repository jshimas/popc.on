<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.5.3/dist/flowbite.min.css" />
    <title>POPC.ON</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/flowbite@1.5.3/dist/flowbite.js"></script>
    <script src="https://unpkg.com/flowbite@1.5.3/dist/datepicker.js"></script>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    @vite('resources/css/app.css')
</head>
<body class="">
  <nav class="border-solid border-b border-gray-300 flex justify-around items-center mb-10 py-5">
    <div class="flex items-center gap-8 text-gray-800 ">
      <a href="/" class="text-3xl mr-8">POPC.<span class="text-pink-600">ON</span></a>
      @if (Auth::check())
        <a href="/tickets" class="text-gray-600 hover:text-pink-700 text-m transition duration-100 ease-in-out">MANO BILIETAI</a>
        @if (Auth::user()->role == 'manager')
          <a href="/statistics" class="text-gray-600 hover:text-pink-700 text-m transition duration-100 ease-in-out">STATISTIKA</a>  
        @endif
      @endif
    </div>
    <ul class="flex gap-5 items-center">
      @if (Auth::check())
        <p class="text-gray-600">Naudotojas &centerdot; {{ Auth::user()->username }}</p>
        <form action="/logout" action="get">
          @csrf
          <button 
            type="submit"
            class="border-solid border-2 rounded-md border-pink-700 text-pink-700 font-semibold hover:bg-pink-50 py-1 px-4 transition duration-100 ease-in-out" 
          >
            Atsijungti
          </button>
        </form>
      @else
        <a href="/login" class="border-solid border-2 rounded-md border-pink-700 text-pink-700 font-semibold hover:bg-pink-50 py-1 px-4 transition duration-100 ease-in-out" >Prisijungti</a>
        <a href="/signup" class="rounded-md bg-pink-600 hover:bg-pink-700 text-white font-semibold py-1 px-4 transition duration-100 ease-in-out">Registruotis</a>   
      @endif
    </ul>
  </nav>
  <main class="flex justify-center">
    <div class="w-2/3 pb-12">
      @yield('content')
    </div>
  </main>
</body>
</html>