<?php

namespace App\Http\Controllers;

use App\DTOs\ClientData;
use App\Models\Client;
use App\Services\ClientService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Validation\ValidationException;


class ClientController extends Controller
{
    public function index(): View
    {
        $clients = Client::all();
        return view('index', ['clients' => $clients]);
    }


    public function store(ClientData $clientData, ClientService $clientService): RedirectResponse
    {
        try {
            $client = $clientService->createClient($clientData);
            return redirect()->route('clients.index')->with('success', 'Klient został pomyślnie dodany.');
        } catch (ValidationException $e) {
            return redirect()->route('clients.index')->with('error', 'TODO');
        }
    }

    public function create(): View
    {
        return view('clients.create');
    }
}
