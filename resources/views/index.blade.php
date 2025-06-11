@extends('layouts.app')

@section('content')
    <div class="flex justify-between items-center mb-6">
        <h1 class="text-2xl font-bold">Lista Klientów</h1>
        <button id="openModalBtn" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Dodaj Klienta
        </button>
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

    <div class="bg-white p-8 rounded-lg shadow-md">
        <div class="overflow-x-auto">
            @if ($clients->isNotEmpty())
                <table id="clientsTable" class="min-w-full w-full bg-white">
                    <thead class="bg-gray-200">
                    <tr>
                        <th class="py-2 px-4 border-b ">Imię</th>
                        <th class="py-2 px-4 border-b">Nazwisko</th>
                        <th class="py-2 px-4 border-b">Email</th>
                        <th class="py-2 px-4 border-b">Telefon</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($clients as $client)
                        <tr class="hover:bg-gray-100">
                            <td class="py-2 px-4 border-b">{{ $client->first_name }}</td>
                            <td class="py-2 px-4 border-b">{{ $client->last_name }}</td>
                            <td class="py-2 px-4 border-b">{{ $client->email }}</td>
                            <td class="py-2 px-4 border-b">{{ $client->phone ?? 'Brak' }}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            @else
                <p class="text-center text-gray-500">Brak klientów do wyświetlenia.</p>
            @endif
        </div>
    </div>

    <div id="clientModal" class="fixed inset-0 hidden overflow-y-auto h-full w-full z-50" style="background-color: rgba(0, 0, 0, 0.5);">
        <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
            <div class="mt-3">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-medium text-gray-900">Dodaj nowego klienta</h3>
                    <button id="closeModalBtn" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>

                <form action="{{ route('clients.store') }}" method="POST" class="space-y-4">
                    @csrf

                    <div>
                        <label for="first_name" class="block text-sm font-medium text-gray-700 mb-1">
                            Imię <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                               name="first_name"
                               id="first_name"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                               required>
                    </div>

                    <div>
                        <label for="last_name" class="block text-sm font-medium text-gray-700 mb-1">
                            Nazwisko <span class="text-red-500">*</span>
                        </label>
                        <input type="text"
                               name="last_name"
                               id="last_name"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                               required>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700 mb-1">
                            Email <span class="text-red-500">*</span>
                        </label>
                        <input type="email"
                               name="email"
                               id="email"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500"
                               required>
                    </div>

                    <div>
                        <label for="phone" class="block text-sm font-medium text-gray-700 mb-1">
                            Telefon
                        </label>
                        <input type="tel"
                               name="phone"
                               id="phone"
                               class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                    </div>

                    <div class="flex justify-end space-x-3 mt-6">
                        <button type="button"
                                id="cancelModalBtn"
                                class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400 focus:outline-none focus:ring-2 focus:ring-gray-500">
                            Anuluj
                        </button>
                        <button type="submit"
                                class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            Dodaj klienta
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('#clientsTable').DataTable({
                dom: '<"flex justify-between mb-4"lf>rt<"flex justify-between mt-4"ip>',
                language: {
                    "emptyTable":     "Brak danych w tabeli",
                    "info":           "Wyświetlanie od _START_ do _END_ z _TOTAL_ rekordów",
                    "infoEmpty":      "Wyświetlanie 0 do 0 z 0 rekordów",
                    "infoFiltered":   "(filtrowane z _MAX_ wszystkich rekordów)",
                    "infoPostFix":    "",
                    "thousands":      ",",
                    "lengthMenu":     "Pokaż _MENU_ rekordów",
                    "search":         "Szukaj:",
                    "zeroRecords":    "Nie znaleziono pasujących rekordów",
                    "paginate": {
                        "first":      "Pierwsza",
                        "last":       "Ostatnia",
                        "next":       "Następna",
                        "previous":   "Poprzednia"
                    }
                }
            });

            const modal = $('#clientModal');
            const openModalBtn = $('#openModalBtn');
            const closeModalBtn = $('#closeModalBtn');
            const cancelModalBtn = $('#cancelModalBtn');

            openModalBtn.on('click', function() {
                modal.removeClass('hidden');
                $('#name').focus();
            });

            function closeModal() {
                modal.addClass('hidden');
                modal.find('form')[0].reset();
                $('.text-red-500.text-sm').remove();
                $('input').removeClass('border-red-500');
            }

            closeModalBtn.on('click', closeModal);
            cancelModalBtn.on('click', closeModal);

            modal.on('click', function(e) {
                if (e.target === this) {
                    closeModal();
                }
            });
        });
    </script>

@endpush
