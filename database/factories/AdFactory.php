<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Ad>
 */
class AdFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => 1,//\App\Models\User::factory(),
            'brand_id' => $this->faker->numberBetween(1, 10),
            'model' => $this->faker->word(),
            'generation' => $this->faker->randomElement(['III', 'IV', 'V', 'VI', 'VII']),
            'price' => $this->faker->numberBetween(150000, 20000000),
            'mileage' => $this->faker->numberBetween(0, 500000),
            'year' => $this->faker->numberBetween(1990, 2026),
            'transmission' => $this->faker->randomElement(['MT', 'AT', 'CVT']),
            'drive' => $this->faker->randomElement(['передний', 'задний', 'полный']),
            'engine_type' => $this->faker->randomElement(['бензин', 'дизель', 'электро']),
            'engine_volume' => $this->faker->numberBetween(1.4, 5.0),
            'engine_power' => $this->faker->numberBetween(90, 600),
            'wheel' => $this->faker->randomElement(['левый', 'правый']),
            'condition' => $this->faker->randomElement(['битый', 'не битый']),
            'body_type' => $this->faker->randomElement(['седан', 'хэтчбэк', 'лифтбэк', 'универсал']),
            'description' => $this->faker->text(maxNbChars: 50),
            'location' => $this->faker->city(),
            'vin' => $this->faker->numberBetween(1000000000, 9999999999),
            'number' => $this->faker->numberBetween(100000, 999999),
            //надо будет еще добавить путь к папке с изображениями
            //'photo' => $this->faker->image("public/storage/photos", 640, 520, null, false),

        ];
    }
}
