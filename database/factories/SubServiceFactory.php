<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubService>
 */
class SubServiceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $images = [
            'services/cleaning.jpg',
            'services/Bonegrafting.jpg',
            'services/Clearretainer.jpg',
            'services/Implantsurgery.jpg',
        ];

        return [
            'Service' => $this->faker->words(2, true),
            'Price' => $this->faker->randomFloat(2, 500, 5000),
            'Description' => $this->faker->paragraph(2),
            'image_path' => $this->faker->randomElement($images),
            'parent_service' => null, // You can set this later or relate it dynamically
        ];
    }
}
