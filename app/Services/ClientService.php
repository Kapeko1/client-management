<?php

namespace App\Services;

use App\DTOs\ClientData;
use App\Models\Client;

class ClientService {

    public function createClient($validatedData): Client
    {
        return Client::create([
            'first_name' => $validatedData->first_name,
            'last_name' => $validatedData->last_name,
            'email' => $validatedData->email,
            'phone' => $validatedData->phone,
        ]);
    }


}
