<?php

namespace Database\Factories;

use App\Models\File;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<File>
 */
class FileFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'filename' => $this->faker->name(),
            'mime_type' => $this->faker->mimeType(),
            'path' => $this->faker->name(),
            'visibility' => $this->faker->boolean(),
        ];
    }
}
