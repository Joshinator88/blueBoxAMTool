@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-5">
    <div class="grid grid-cols-3 gap-4">
        <!-- Parent Company Info -->
        <div class="bg-white shadow-md rounded p-4">
            <h3 class="text-blue-600 font-semibold text-lg mb-4">{{ $parent->name }}</h3>
            <div class="mb-4">
                <h4 class="text-blue-500 font-semibold">Colleague</h4>
                <p>John Doe</p>
                <a href="mailto:john.doe@example.com"><img src="path-to-email-icon" alt="Email"></a>
            </div>
            <div class="mb-4">
                <h4 class="text-blue-500 font-semibold">Contracts of (this parent)</h4>
                @foreach($parent->contracts as $contract)
                    <p>{{ $contract->title }}<br><small>{{ $contract->type }}</small></p>
                @endforeach
            </div>
        </div>

        <!-- Contacts -->
        <div class="bg-white shadow-md rounded p-4">
            <h3 class="text-blue-600 font-semibold text-lg mb-4">Contacts</h3>
            <ul>
                @foreach($parent->contacts as $contact)
                    <li class="flex justify-between items-center mb-2">
                        <div>
                            <p>{{ $contact->name }}</p>
                            <p><a href="mailto:{{ $contact->email }}">{{ $contact->email }}</a></p>
                        </div>
                        <div>
                            <a href="mailto:{{ $contact->email }}"><img src="path-to-email-icon" alt="Email"></a>
                            <form action="{{ route('contacts.destroy', $contact->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit"><img src="path-to-delete-icon" alt="Delete"></button>
                            </form>
                        </div>
                    </li>
                @endforeach
            </ul>
            <button class="bg-green-500 text-white py-2 rounded-md w-full hover:bg-green-400 mt-4">Add Contact</button>
        </div>

        <!-- Strategies -->
        <div class="bg-white shadow-md rounded p-4">
            <h3 class="text-blue-600 font-semibold text-lg mb-4">Strategies</h3>
            @foreach($parent->strategies as $strategy)
                <div class="mb-4">
                    <h4 class="font-semibold">{{ $strategy->title }}</h4>
                    <p>{{ $strategy->description }}</p>
                </div>
            @endforeach
            <button class="bg-green-500 text-white py-2 rounded-md w-full hover:bg-green-400 mt-4">Add Strategy</button>
        </div>
    </div>
</div>
@endsection
