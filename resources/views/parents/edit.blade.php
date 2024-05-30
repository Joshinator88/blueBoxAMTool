<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Parent') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form method="POST" action="{{ route('parents.update', $parent->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="p-6">
                        @if ($errors->any())
                            <div class="mb-4">
                                <div class="text-red-600">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="name">
                                Name
                            </label>
                            <input class="w-full rounded-md border-blue-300 p-2" id="name" name="name" type="text" value="{{ $parent->name }}" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="category">
                                Category
                            </label>
                            <input class="w-full rounded-md border-blue-300 p-2" id="category" name="category" type="text" value="{{ $parent->category->name }}" required>
                        </div>
                        <div class="mb-4">
                        @foreach ($partners as $partner)
                        <!-- make it checked if the master is registrered with this partner -->
                            @if (in_array($partner->id, $selectedPartners))
                                <input checked type="checkbox" id="{{ $partner->name }}" name="{{ $partner->name }}" value="{{ $partner->id }}">
                            @else
                                <input type="checkbox" id="{{ $partner->name }}" name="{{ $partner->name }}" value="{{ $partner->id }}">
                            @endif
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
                                    @if ($user->id == $parent->users[1]->id)
                                        <option selected="selected" value="{{ $user->id }}">{{ $user->name . " " . $user->last_name }}</option>
                                    @else
                                        <option value="{{ $user->id }}">{{ $user->name . " " . $user->last_name }}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-4">
                            <button type="submit" class="bg-blue-500 text-white py-2 rounded-md w-full hover:bg-blue-400 hover:cursor-pointer">
                                Update Parent
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
