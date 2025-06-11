<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\CompanyRepresentative;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ClientCompanyRepresentativeController extends Controller
{
    public function store(Request $request, Client $client): RedirectResponse
    {
        $request->validate([
            'representative_id' => 'required|exists:company_representatives,id',
        ]);

        $client->companyRepresentatives()->attach($request->representative_id);

        return redirect()->route('clients.show', $client)->with('success', 'Opiekun został dodany.');
    }
    public function destroy(Client $client, CompanyRepresentative $representative): RedirectResponse
    {
        $client->companyRepresentatives()->detach($representative->id);
        return redirect()->route('clients.show', $client)->with('success', 'Opiekun został usunięty.');
    }
}
