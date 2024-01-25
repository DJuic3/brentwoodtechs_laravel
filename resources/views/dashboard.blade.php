<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">

            <a href="{{ route('finance.personalitems') }}" class="edit-btn mb-4 inline-center">My Contributions</a>

        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex justify-center">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex">
                <div class="p-6 text-gray-900 flex-shrink-0 w-1/3">
                    {{ __("Employee Information") }}
                </div>
            </div>
        </div>
    </div>
    <style>
        a.edit-btn {
            background-color: #3498db;
            color: #fff;
            padding: 0.5rem 1rem;
            border-radius: 0.25rem;
            text-decoration: none;
            margin-right: 0.5rem;
        }
    </style>
    <div class="container mx-auto">
        <ul class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <li class="border p-4 rounded-md">
                <strong class="text-lg mb-2 block">Name:</strong>
                {{ auth()->user()->name ?: 'Not Complete' }}
            </li>
            <li class="border p-4 rounded-md">
                <strong class="text-lg mb-2 block">Email:</strong>
                {{ auth()->user()->email ?: 'Not Complete' }}
            </li>
            <li class="border p-4 rounded-md">
                <strong class="text-lg mb-2 block">Phone Number:</strong>
                {{ auth()->user()->phonenumber ?: 'Not Complete' }}
            </li>
            <li class="border p-4 rounded-md">
                <strong class="text-lg mb-2 block">Department:</strong>
                {{ auth()->user()->department ?: 'Not Complete' }}
            </li>
            <li class="border p-4 rounded-md">
                <strong class="text-lg mb-2 block">Date of Birth:</strong>
                {{ auth()->user()->dob ?: 'Not Complete' }}
            </li>
            <li class="border p-4 rounded-md">
                <strong class="text-lg mb-2 block">Status:</strong>
                {{ auth()->user()->status ?: 'Not Complete' }}
            </li>
            <li class="border p-4 rounded-md">
                <strong class="text-lg mb-2 block">Gender:</strong>
                {{ auth()->user()->gender ?: 'Not Complete' }}
            </li>
        </ul>
    </div>



</x-app-layout>
