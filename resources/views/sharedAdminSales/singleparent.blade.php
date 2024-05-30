<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($parent->name) }}
        </h2>
    </x-slot>

    
    <div>
        <!-- check if there are collegues outside of the currentlylogged in user and if the logged in user is not admin -->
        @if (isset($colleague) && Auth::user()->role->role !== "admin")
        <h1>collegue</h1>
        <div>
            <h3>{{ $colleague->name . " " . $colleague->last_name }}</h3>
        </div>
        @endif
    </div>                
</x-app-layout>
