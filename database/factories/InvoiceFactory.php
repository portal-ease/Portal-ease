<?php

namespace Database\Factories;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Invoice>
 */
class InvoiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'file_id' => $this->faker->uuid(),
            'name' => $this->faker->name(),
            'expiry_date' => $this->faker->date(),
            'price' => $this->faker->randomFloat(2, 10),
            'description' => $this->faker->text(),
        ];
    }
}
