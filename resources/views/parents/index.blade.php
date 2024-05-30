<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Parent Management') }}
        </h2>
    </x-slot>

    <div class="flex space-x-4 p-4">
        <!-- Find a Parent Section -->
        <div class="w-1/3 bg-white shadow-md rounded p-4">
            <h3 class="text-blue-600 font-semibold text-lg mb-4">Find a Parent</h3>
            <form method="GET" action="/parents/search" enctype="multipart/form-data" class="mb-4">
                @csrf
                <div class="flex">
                    <input class="rounded-l-md border-blue-300 w-10/12 p-2" type="text" id="parentSearch"
                        name="parentSearch" placeholder="Search parents...">
                    <button type="submit"
                        class="rounded-r-md bg-blue-500 w-2/12 text-white hover:cursor-pointer hover:bg-blue-400 flex items-center justify-center">
                        <svg class="h-5 w-5" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 16l-4-4m0 0l4-4m-4 4h16"></path>
                        </svg>
                    </button>
                </div>
            </form>
            @if(isset($parents))
            <div class="mt-8 mb-3 bg-white p-5 pb-5 rounded-md">
                @if(isset($parents))
                <div class="mt-8 mb-3 bg-white p-5 pb-5 rounded-md">
                    @if(count($parents) > 0)
                        <ul>
                            @foreach($parents as $parent)
                            <a href="/{{$parent->name}}" class="hover:text-blue-800 hover:animate-pulse">
                            <form action="/parents/update" method="POST"
                                      enctype="multipart/form-data" class="mx-5 mb-3 border-b">
                                    @csrf
                                    <div class="grid grid-rows-2 grid-flow-col grid-cols-[auto_150px]">
                                        <p class="my-2">{{ $parent->name }}</p>
                                        <p class="my-2">{{ optional($parent->category)->name }}</p>
                                        <input type="hidden" name="parentId" id="parentId" value="{{ $parent->id }}">
                                        <input type="submit" value="Edit" name="editParent" id="editParent"
                                               class="bg-green-700 text-white my-2 rounded-md hover:cursor-pointer hover:bg-green-600">
                                        <input type="submit" value="Delete" name="deleteParent" id="deleteParent"
                                               class="bg-red-700 text-white my-2 rounded-md hover:cursor-pointer hover:bg-red-600">
                                    </div>
                                </form>
                            </a>
                            @endforeach
                        </ul>
                    @else
                        <p class="mx-auto">No parents found</p>
                    @endif
                </div>
            @endif
            
            </div>
        @endif
        
        </div>

        <!-- Add Parent Form -->
        <div class="w-1/3 bg-white shadow-md rounded p-4">
            <h3 class="text-blue-600 font-semibold text-lg mb-4">Add Parent</h3>
            <form method="POST" action="{{ route('parents.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                        Name
                    </label>
                    <input class="w-full rounded-md border-blue-300 p-2" id="name" name="name" type="text"
                        placeholder="Name (required)">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="category_id">
                        Category
                    </label>
                    <select class="w-full rounded-md border-blue-300 p-2" id="category_id" name="category_id">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    @foreach ($partners as $partner)
                        <input type="checkbox" id="{{ $partner->name }}" name="{{ $partner->name }}" value="{{ $partner->id }}">
                        <label for="{{ $partner->id }}"> {{ $partner->name }}</label>
                    @endforeach
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="salesOne">
                        Sales agent one
                    </label>
                    <select class="w-full rounded-md border-blue-300 p-2" name="salesOne" id="salesOne" required>
                        @foreach ($users as $user)
                            @if ($user->id == $parent->users[0]->id)
                                <option selected="selected" value="{{ $user->id }}">{{ $user->name . " " . $user->last_name }}</option>
                            @else
                                <option value="{{ $user->id }}">{{ $user->name . " " . $user->last_name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="salesTwo">
                        Sales agent two
                    </label>
                    <select class="w-full rounded-md border-blue-300 p-2" name="salesTwo" id="salesTwo" required>
                        @foreach ($users as $user)
                            @if ($user->id == $parent->users[0]->id)
                                <option selected="selected" value="{{ $user->id }}">{{ $user->name . " " . $user->last_name }}</option>
                            @else
                                <option value="{{ $user->id }}">{{ $user->name . " " . $user->last_name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <button type="submit"
                        class="bg-blue-500 text-white py-2 rounded-md w-full hover:bg-blue-400 hover:cursor-pointer">
                        Add Parent
                    </button>
                </div>
            </form>
        </div>

        <!-- Add Category Form -->
        <div class="w-1/3 bg-white shadow-md rounded p-4">
            <h3 class="text-blue-600 font-semibold text-lg mb-4">Add Category</h3>
            <form method="POST" action="{{ route('categories.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="category_name">
                        Name
                    </label>
                    <input class="w-full rounded-md border-blue-300 p-2" id="category_name" name="category_name" type="text" placeholder="Name (required)">
                </div>
                <div class="mb-4">
                    <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                        Description
                    </label>
                    <textarea class="w-full rounded-md border-blue-300 p-2" id="description" name="description" placeholder="Description"></textarea>
                </div>
                <div class="mb-4">
                    <button type="submit" class="bg-blue-500 text-white py-2 rounded-md w-full hover:bg-blue-400 hover:cursor-pointer">
                        Add Category
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
