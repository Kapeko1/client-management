<?php

namespace App\Http\Controllers;

use App\DTOs\ClientData;
use App\Models\Client;
use App\Models\CompanyRepresentative;
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
    public function show(Client $client): View
    {
        $all_representatives = CompanyRepresentative::all();
        return view('clients.show', compact('client', 'all_representatives'));
    }
    public function destroy(Client $client): RedirectResponse
    {
        $client->delete();
        return redirect()->route('clients.index')->with('success', 'Klient został usunięty.');
    }
    public function addRepresentative(Request $request, Client $client): RedirectResponse
    {
        $request->validate([
            'representative_id' => 'required|exists:company_representatives,id',
        ]);

        $client->companyRepresentatives()->attach($request->representative_id);

        return redirect()->route('clients.show', $client)->with('success', 'Opiekun został dodany.');
    }
    public function removeRepresentative(Client $client, CompanyRepresentative $representative): RedirectResponse
    {
        $client->companyRepresentatives()->detach($representative->id);
        return redirect()->route('clients.show', $client)->with('success', 'Opiekun został usunięty.');
    }

}
