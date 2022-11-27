@props(['showtime'])

<div class="flex justify-around items-center gap-3 bg-pink-600 text-white font-semibold rounded-md p-2">
    <div>
        <div>{{$showtime->date}}</div>    
        <div>{{$showtime->time}} val.</div>    
    </div>
    <div class="border-solid border-2 border-white rounded-md px-3 py-1">{{$showtime->price}} €</div>    
</div>