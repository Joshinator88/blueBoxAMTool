<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($parent->name) }}
        </h2>
    </x-slot>
    <div class="flex justify-around">
        <div class="w-4/12 bg-white p-4 m-3 rounded-md shadow h-fit">
            <!-- check if there are collegues outside of the currentlylogged in user and if the logged in user is not admin -->
            @if (isset($colleague) && Auth::user()->role->role !== "admin")
            <h1 class="text-2xl font-medium text-blue-600 text-center border-b border-blue-300 w-8/12 mx-auto mb-5">collegue</h1>
            <div class="flex justify-between">
                <h3 class="text-lg italic ml-3">{{ $colleague->name . " " . $colleague->last_name }}</h3>
                <a href="">
                    <svg class="w-6" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 64" xml:space="preserve">
                        <g>
                            <path d="M57,8H7C3.7,8,1,10.7,1,14v36c0,3.3,2.7,6,6,6h50c3.3,0,6-2.7,6-6V14C63,10.7,60.3,8,57,8z M57,12c0.7,0,1.4,0.2,2,0.6L32,33.8
                            L5,12.6C5.6,12.2,6.3,12,7,12H57z M57,52H7c-1.7,0-3-1.3-3-3V15.3l26.8,21.5c1.1,0.9,2.4,1.3,3.7,1.3s2.7-0.4,3.7-1.3L60,15.3V49
                            C60,50.7,58.7,52,57,52z"/>
                        </g>
                    </svg>
                </a>
            </div>
            @endif
        </div>  
        
        <div class="w-4/12 bg-white rounded-md m-3 p-4 relative h-fit max-h-96 overflow-y-scroll">
            <h1 class="text-2xl font-medium text-blue-600 text-center border-b border-blue-300 w-8/12 mx-auto mb-5">strategies</h1>
            <svg class="absolute top-5 right-5 w-6 h-6 text-white bg-green-500 rounded-full" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>

            @foreach($parent->strategies as $strategy)
                <a href="/strategy/edit/{{$strategy->id}}">
                    <div class="mb-4 border-b border-blue-300 hover:shadow p-2 rounded-md">
                        <h1 class="">{{$strategy->title}}</h1>
                        <p class="text-sm italic ml-2 mb-3">{{ $strategy->summary }}</p>
                    </div>
                </a>
            @endforeach

        </div>
    </div>
</x-app-layout>
