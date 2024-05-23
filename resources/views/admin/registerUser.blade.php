<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('User management') }}
        </h2>
    </x-slot>

    @if(isset($message))
        <h2 class="text-center {{$color}} p-3 mb-3">{{ $message }}</h2>
    @endif
 <div class="flex">
 <form method="POST" action="usermanagement" enctype="multipart/form-data"  class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4 m-2 w-5/12">
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

                <div class="w-6/12 mt-5 mx-auto rounded h-fit">
                    <form method="Get" action="search-users" enctype="multipart/form-data" class="w-full bg-white rounded">
                    @csrf
                    <div class="flex">
                        <input class="rounded-l-md border-blue-300 w-10/12" type="text" id="userSearch" name="userSearch" placeholder="user@example.com">
                        <input class="rounded-r-md bg-blue-500 w-2/12 text-white hover:cursor-pointer hover:bg-blue-400" type="submit" id="searchSubmit" name="searchSubmit" value="Search">
                    </div>
                    </form>
                    @if(isset($searchedUsers))
                        <div class="mt-8 mb-3 bg-white p-5 pb-5 rounded-md">
                        @if(count($searchedUsers) > 0)
                        <ul>
                            @foreach($searchedUsers as $user)
                            <form action="editUser" method="POST" enctype="multipart/form-data"  class="mx-5 mb-3 border-b">
                                @csrf
                                <div class="grid grid-rows-2 grid-flow-col grid-cols-[auto_150px]">
                                        <p class="my-2">{{$user->name}}</p>
                                        <p class="my-2">{{$user->email}}</p>
                                        <input type="hidden" name="userId" id="userId" value="{{$user->id}}">
                                        <input type="submit" value="Edit" name="editUser" id="editUser" class="bg-green-700 text-white my-2 rounded-md hover:cursor-pointer hover:bg-green-600">
                                        <input type="submit" value="Delete" name="deleteUser" id="deleteUser" class="bg-red-700 text-white my-2 rounded-md hover:cursor-pointer hover:bg-red-600">
                                </div>
                                
                            </form>
                            @endforeach
                        </ul>
                        @else
                        <p class="mx-auto">there were no users found</p>
                        @endif
                        </div>
                    @endif
                    
                </div>
                
 </div>
                


                
</x-app-layout>
