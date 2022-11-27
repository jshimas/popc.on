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
    @vite('resources/css/app.css')
</head>
<body class="">
    <main class="flex justify-center items-center w-screen h-screen bg-gradient-to-r from-pink-400 to-pink-600">
        <a href="/" class="text-white text-4xl font-semibold rounded-md absolute top-4 right-4">&#10005;</a>
        @yield('content')
    </main>
</body>
</html>