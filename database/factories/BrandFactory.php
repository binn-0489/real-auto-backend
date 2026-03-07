<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        static $brands = [
            'Toyota', 'Ford', 'Honda', 'Mercedes-Benz',
            'Kia', 'Lada', 'Chevrolet', 'Audi', 'BMW', 'Mitsubishi'
        ];

        return [
            'title' => array_pop($brands),
        ];
    }
}
