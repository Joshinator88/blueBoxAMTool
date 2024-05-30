<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __(Auth::user()->name . " " . Auth::user()->last_name) }}
        </h2>
    </x-slot>

    
    <div class="bg-white w-4/12 mt-5 mx-auto p-5 pt-2 rounded-md">
        <!-- check if the user has any masters he is responsible for and if so they are displayed here  -->
        @if(Auth::user()->masters->count() > 0)
            @foreach (Auth::user()->masters as $master)
                <div>
                    <h2>{{ $master->name }}</h2>
                    @foreach($master->users as $user)
                        @if($user !== Auth::user())
                            <p class="text-blue-400 ml-3">{{$user->name}} {{$user->last_name}}</p>
                        @endif
                    @endforeach
                </div>
            @endforeach
        @endif

    </div>


                
</x-app-layout>
