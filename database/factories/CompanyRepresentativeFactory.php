<?php

namespace Database\Factories;

use App\Enums\DepartmentsEnum;
use App\Models\CompanyRepresentative;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\CompanyRepresentative>
 */
class CompanyRepresentativeFactory extends Factory
{
    protected $model = CompanyRepresentative::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'first_name' => $this->faker->firstName(),
            'last_name' => $this->faker->lastName(),
            'department' => $this->faker->randomElement(DepartmentsEnum::cases())
        ];
    }
}
