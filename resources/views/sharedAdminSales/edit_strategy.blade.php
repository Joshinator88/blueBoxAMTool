<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __($strategy->title) }}
        </h2>
    </x-slot>


    <div class="w-4/12 bg-white m-5 p-5 rounded-md">
        <h1 class="text-2xl font-medium text-blue-600 text-center border-b border-blue-300 w-8/12 mx-auto mb-5">Strategy</h1>
        <form action="">
            <div class="flex flex-col mb-3">
                <label for="title">Title</label>
                <input class="rounded-md border-blue-300" type="text" name="title" id="title" value="{{ $strategy->title }}">
            </div>
            <div class="flex flex-col mb-3">
                <label for="summary">Summary</label>
                <textarea name="summary" id="summary" class="h-40 rounded-md border-blue-300">{{ $strategy->summary }}</textarea>
            </div>
            <div class="flex flex-col mb-3">
                <label for="today">Today</label>
                <input class="rounded-md border-blue-300" type="text" name="today" id="today" value="{{ $strategy->today }}">
            </div>
            <div class="flex flex-col mb-3">
                <label for="tomorrow">Tomorrow</label>
                <input class="rounded-md border-blue-300" type="text" name="tomorrow" id="tomorrow" value="{{ $strategy->tomorrow }}">
            </div>
            <div class="flex flex-col mb-3">
                <label for="how">How</label>
                <input class="rounded-md border-blue-300" type="text" name="how" id="how" value="{{ $strategy->how }}">
            </div>
            <div class="flex flex-col mb-3">
                <label for="alignment">Alignment</label>
                <input class="rounded-md border-blue-300" type="text" name="alignment" id="alignment" value="{{ $strategy->alignment }}">
            </div>
            <div class="w-4/12 mx-auto">
                <input class="transition duration-300 hover:duration-300 hover:scale-105 bg-blue-800 text-white p-1 w-full mx-auto my-1 rounded-md hover:cursor-pointer hover:bg-blue-700 hover:text-slate-50" type="submit" name="edit" id="edit" value="Edit">
            </div>
        </form>
    </div>
    


</x-app-layout>
