<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($user->name . " " . $user->last_name) }}
        </h2>
    </x-slot>

    <form action="update-user" method="post" enctype="multipart/form-data">
        @csrf
        <div>
            <label for="name">First name</label>
            <input type="text" name="name" id="name" value="{{$user->name}}">
        </div>
        
        <div>
            <label for="lastname">Last name</label>
            <input type="text" name="lastname" id="lastname" value="{{$user->last_name}}">
        </div>
        
    </form>

 


                
</x-app-layout>
