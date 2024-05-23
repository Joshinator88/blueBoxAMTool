<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($user->name . " " . $user->last_name) }}
        </h2>
    </x-slot>

    @if (isset($error))
        <h2 class="text-center text-red-600 p-3 mb-3">{{$error}}</h2>
    @elseif (isset($message))
        <h2 class="text-center text-red-600 p-3 mb-3">{{$message}}</h2>
    @endif
    
    <form class="bg-white mt-2 mx-auto p-5 rounded-md w-3/5" action="editUser" method="post" enctype="multipart/form-data">
        @csrf
        <div class="my-2 flex justify-between" >
            <label class="my-auto w-2/12" for="name">First name</label>
            <input class="w-10/12 rounded-md border-blue-300" type="text" name="name" id="name" value="{{$user->name}}">
        </div>
        
        <div class="my-2 flex justify-between">
            <label class="my-auto w-2/12" for="lastname">Last name</label>
            <input class="w-10/12 rounded-md border-blue-300" type="text" name="lastname" id="lastname" value="{{$user->last_name}}">
        </div>

        <div class="my-2 flex justify-between">
            <label class="my-auto w-2/12" for="role">
                Role
            </label>
            <select class="w-10/12 rounded-md border-blue-300" name="role" id="role">
                @foreach ($roles as $role)
                    @if ($role->id == $user->role->id)
                        <option value="{{ $role->id }}" selected="selected">{{$role->role}}</option>
                    @else
                        <option value="{{ $role->id }}">{{$role->role}}</option>
                    @endif
                @endforeach
            </select>
        </div>

        <div class="my-2 flex justify-between">
        <label class="my-auto w-2/12" for="gender">
                            Gender
                        </label>
                        <select class="w-10/12 rounded-md border-blue-300" name="gender" id="gender">
                            @foreach ($genders as $gender)
                                @if ($gender->id == $user->gender->id)
                                    <option value="{{ $gender->id }}" selected="selected">{{$gender->gender}}</option>
                                @else
                                    <option value="{{ $gender->id }}">{{$gender->gender}}</option>
                                @endif
                            @endforeach
                        </select>
        </div>

        <div class="my-2 flex justify-between">
            <label class="my-auto w-2/12" for="email">Email</label>
            <input class="w-10/12 rounded-md border-blue-300" type="email" name="email" id="email" value="{{$user->email}}">
        </div>
        
        <div class="my-2 flex justify-between">
            <label class="my-auto w-2/12" for="phone">Phone</label>
            <input class="w-10/12 rounded-md border-blue-300" type="text" name="phone" id="phone" value="{{$user->phone}}">
        </div>

        <div class="flex flex-col">
            <input class="bg-blue-800 text-white p-1 w-4/12 mx-auto my-1 rounded-md hover:cursor-pointer hover:bg-blue-700 hover:text-slate-50" type="submit" value="Update" name="update" id="update">
            <input class="bg-red-800 text-white p-1 w-4/12 mx-auto my-1 rounded-md hover:cursor-pointer hover:bg-red-700 hover:text-slate-50" type="submit" value="Reset password" name="resetPassword" id="resetPassword">
        </div>
        <input type="hidden" name="userId" id="userId" value="{{$user->id}}">
    </form>

 


                
</x-app-layout>
