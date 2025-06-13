@extends('layouts.app')

@section('content')
    <div class="container mx-auto">
        <a href="{{ route('clients.index') }}" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-2 px-4 rounded">Powrót</a>
        <div class="m-6">
            <h1 class="text-2xl font-bold">Szczegóły klienta</h1>
        </div>

        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
        @endif


        <div class="bg-white p-6 rounded-lg shadow-md mb-6 flex flex-row justify-between">
            <div>
                <h2 class="text-xl font-semibold mb-4">Dane Klienta</h2>
                <p><strong>Imię:</strong> {{ $client->first_name }}</p>
                <p><strong>Nazwisko:</strong> {{ $client->last_name }}</p>
                <p><strong>Email:</strong> {{ $client->email }}</p>
                <p><strong>Telefon:</strong> {{ $client->phone ?? 'Brak' }}</p>
            </div>
                <form action="{{ route('clients.destroy', $client) }}" method="POST" onsubmit="return confirm('Czy na pewno chcesz usunąć tego klienta?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Usuń</button>
                </form>

        </div>
        <hr class="my-6">

        <div class="bg-white p-6 rounded-lg shadow-md mb-6">
            <h3 class="text-xl font-semibold mb-4">Opiekunowie Klienta</h3>
            @if($client->companyRepresentatives->isNotEmpty())
                <ul class="space-y-3">
                    @foreach($client->companyRepresentatives as $representative)
                        <li class="flex justify-between items-center p-3 bg-gray-50 rounded-md">
                            <div>
                                <span class="font-medium">{{ $representative->first_name }} {{ $representative->last_name }}</span>
                                <span class="text-sm text-gray-600">- {{ $representative->department->label() }}</span>
                            </div>
                            <form action="{{ route('representatives.destroy', $representative) }}" method="POST" onsubmit="return confirm('Czy na pewno chcesz usunąć tego opiekuna?');">
                                @csrf
                                @method('DELETE')
                                <input type="hidden" name="client_id" value="{{ $client->id }}">
                                <button type="submit" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-3 rounded text-sm">X</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            @else
                <p class="text-gray-500">Brak przypisanych opiekunów.</p>
            @endif
        </div>

        <h3 class="text-lg font-semibold mb-2">Dodaj opiekuna</h3>
        <form action="{{ route('clients.representatives.store', $client) }}" method="POST">
            @csrf
            <div class="flex items-center">
                <select name="representative_id" class="block w-full bg-white border-gray-300 rounded-md shadow-sm">
                    <option hidden>Wybierz opiekuna</option>
                    @foreach($all_representatives->diff($client->companyRepresentatives) as $representative)
                        <option value="{{ $representative->id }}">{{ $representative->first_name }} {{ $representative->last_name }} - {{$representative->department->label()}}</option>
                    @endforeach
                </select>
                <button type="submit" class="ml-4 bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Dodaj</button>
            </div>
            @error('representative_id')
            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
            @enderror
        </form>
    </div>
@endsection
