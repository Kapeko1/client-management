<?php

namespace App\Http\Controllers;

use App\DTOs\ClientData;
use App\Models\Client;
use App\Services\ClientService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Log\Logger;
use Illuminate\Support\Facades\Log;
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
            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput()
                ->with('modal_open', true);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Wystąpił błąd podczas dodawania klienta: ' . $e->getMessage())
                ->withInput()
                ->with('modal_open', true);
        }
    }

    public function create(): View
    {
        return view('clients.create');
    }
}
