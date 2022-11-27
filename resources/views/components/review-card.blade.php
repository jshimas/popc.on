@props(['review'])

<div class="flex">
    <div class="w-1/5 border-solid border-r border-gray-300 pr-5">
        <p class="text-lg font-semibold font-gray-700 tracking-wider">{{$review->username}}</p>
        <p class="mb-3 uppercase text-gray-500">Įvertinimas: <span>{{$review->rating}}</span></p>
    </div>
    <p class="w-4/5 font-gray-700 pl-5">{{$review->comment}}</p>
</div>