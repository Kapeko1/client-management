<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\CompanyRepresentative;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        $representatives = CompanyRepresentative::factory()->count(10)->create();
        $clients = Client::factory()->count(50)->create();

        $clients->each(function ($client) use ($representatives) {
            $representativesToAttach = $representatives->random(rand(1, 3))->pluck('id');
            $client->companyRepresentatives()->attach($representativesToAttach);
        });
    }
}
