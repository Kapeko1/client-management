<?php

namespace App\Services;

use App\DTOs\ClientData;
use App\Models\Client;

class ClientService {

    public function createClient(ClientData $clientData): Client
    {
        return Client::create([
            'first_name' => $clientData->first_name,
            'last_name' => $clientData->last_name,
            'email' => $clientData->email,
            'phone' => $clientData->phone,
        ]);
    }


}
