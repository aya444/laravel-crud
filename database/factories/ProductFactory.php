<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{

    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name,
            'detail' => $this->faker->text(200),
            'price' => $this->faker->randomFloat(2,0,100),
            'quantity' => $this->faker->randomNumber(2),
        ];
    }
}