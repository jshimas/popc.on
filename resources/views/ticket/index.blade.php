@extends('layout')

@section('content')
    <div>
        <p class="text-5xl text-center text-gray-700 border-solid border-b border-gray-300 mb-8 pb-5 uppercase">Bilietai</p>  
        <div class="flex justify-center">
            <table>
                <tr class="border-b">
                    <th class="text-lg font-semibold text-gray-900 px-6 py-4 text-left whitespace-nowrap uppercase">Filmas</th>
                    <th class="text-lg font-semibold text-gray-900 px-6 py-4 text-left whitespace-nowrap uppercase">Cenzas</th>
                    <th class="text-lg font-semibold text-gray-900 px-6 py-4 text-left whitespace-nowrap uppercase">Žanras</th>
                    <th class="text-lg font-semibold text-gray-900 px-6 py-4 text-left whitespace-nowrap uppercase">Seanso data</th>
                    <th class="text-lg font-semibold text-gray-900 px-6 py-4 text-left whitespace-nowrap uppercase">Laikas</th>
                    <th class="text-lg font-semibold text-gray-900 px-6 py-4 text-left whitespace-nowrap uppercase">Bilietų kiekis</th>
                </tr>
                @foreach($tickets as $ticket)
                    <tr class="border-b">
                        <td class="text-md text-gray-900 font-medium px-6 py-4 whitespace-nowrap uppercase">{{ $ticket->name }}</td>
                        <td class="text-md text-gray-900 font-medium px-6 py-4 whitespace-nowrap">{{ $ticket->age_rating }}</td>
                        <td class="text-md text-gray-900 font-medium px-6 py-4 whitespace-nowrap">{{ $ticket->genre }}</td>
                        <td class="text-md text-gray-900 font-medium px-6 py-4 whitespace-nowrap">{{ $ticket->date }}</td>
                        <td class="text-md text-gray-900 font-medium px-6 py-4 whitespace-nowrap">{{ $ticket->time }}</td>
                        <td class="text-md text-center text-gray-900 font-medium px-6 py-4 whitespace-nowrap">{{ $ticket->quantity }}</td>
                        <td class="text-md text-gray-900 font-semibold px-6 py-4 whitespace-nowrap">
                            <a href="/comments/new/service/{{ $ticket->showtime_id }}" class="hover:text-pink-700 transition duration-100 ease-in-out hover:underline">Įvertinti aptarnavimą</a>
                        </td>
                    </td>
                @endforeach
            </table>
        </div>
    </div>
@endsection