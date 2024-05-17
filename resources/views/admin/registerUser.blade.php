<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User management') }}
        </h2>
    </x-slot>

 
                <form method="POST" enctype="multipart/form-data"  class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 ml-2 w-5/12 mt-2">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="firstname">
                            First Name
                        </label>
                        <input class="w-full rounded-md border-blue-300" id="firstname" name="firstname" type="text" placeholder="First Name">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="lastname">
                            Last Name
                        </label>
                        <input class="w-full rounded-md border-blue-300" id="lastname" name="lastname" type="text" placeholder="Last Name">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="email">
                            Email
                        </label>
                        <input class="w-full rounded-md border-blue-300" id="email" name="email" type="text" placeholder="Email">
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="role">
                            Role
                        </label>
                        <select class="w-full rounded-md border-blue-300" name="role" id="role">
                            @foreach ($roles as $role)
                            <option value="{{ $role->id }}">{{$role->role}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-gray-700 text-sm font-bold mb-2" for="Gender">
                            Gender
                        </label>
                        <select class="w-full rounded-md border-blue-300" name="gender" id="gender">
                            @foreach ($genders as $gender)
                            <option value="{{ $gender->id }}">{{$gender->gender}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <input class="bg-blue-500 text-white py-1 rounded-md w-full hover:bg-blue-400 hover:cursor-pointer" id="email" type="submit" name="submit" placeholder="Email">
                    </div>
                </form>
                
</x-app-layout>
