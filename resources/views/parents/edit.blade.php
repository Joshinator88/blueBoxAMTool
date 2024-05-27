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
                            <input class="w-full rounded-md border-blue-300 p-2" id="category" name="category" type="text" value="{{ $parent->category }}" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="partners">
                                Partners
                            </label>
                            {{-- empty value --}}
                            <input class="w-full rounded-md border-blue-300 p-2" id="partners" name="partners" type="text" value="" required>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="sales_support">
                                Sales Support
                            </label>
                            <select class="w-full rounded-md border-blue-300 p-2" name="sales_support" id="sales_support" required>
                                <option value="support1" {{ $parent->sales_support == 'support1' ? 'selected' : '' }}>Sales support 1</option>
                                <option value="support2" {{ $parent->sales_support == 'support2' ? 'selected' : '' }}>Sales support 2</option>
                            </select>
                        </div>
                        <div class="mb-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2" for="sales_administrator">
                                Sales Administrator
                            </label>
                            <select class="w-full rounded-md border-blue-300 p-2" name="sales_administrator" id="sales_administrator" required>
                                <option value="admin1" {{ $parent->sales_administrator == 'admin1' ? 'selected' : '' }}>Sales administrator 1</option>
                                <option value="admin2" {{ $parent->sales_administrator == 'admin2' ? 'selected' : '' }}>Sales administrator 2</option>
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
