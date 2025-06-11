<?php

namespace App\DTOs;

use Illuminate\Container\Attributes\Database;
use Spatie\LaravelData\Data;
use Spatie\LaravelData\Attributes\Validation\Rule;

class ClientData extends Data   {
    public function __construct(
        #[Rule(['required', 'string', 'max:255'])]
        public string $first_name,

        #[Rule(['required', 'string', 'max:255'])]
        public string $last_name,

        #[Rule(['required', 'email', 'unique:clients,email'])]
        public readonly string $email,

        #[Rule(['nullable', 'string', 'max:255'])]
        public readonly ?string $phone,
    )   {}
}
