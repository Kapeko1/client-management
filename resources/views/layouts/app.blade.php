<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Zarządzanie Klientami</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.css" />

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 font-sans">
<nav class="bg-white shadow-md">
    <div class="container mx-auto px-6 py-3">
        <div class="flex items-center justify-between">
            <div>
            </div>
            <div>
                <a href="" class="px-4 py-2 text-gray-600 hover:text-gray-800 rounded-md @if(request()->routeIs('clients.*')) font-bold text-blue-600 @endif">Zarządzaj Klientami</a>
                <a href="" class="px-4 py-2 text-gray-600 hover:text-gray-800 rounded-md @if(request()->routeIs('data.*')) font-bold text-blue-600 @endif">Wyświetl Dane</a>
            </div>
        </div>
    </div>
</nav>

<main class="container mx-auto px-6 py-8">
    @yield('content')
</main>


<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/2.0.8/js/dataTables.js"></script>
@stack('scripts')
</body>
</html>
