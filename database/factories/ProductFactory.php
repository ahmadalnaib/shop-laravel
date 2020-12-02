<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Store;
use App\Models\User;
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
            'name' => $this->faker->text($maxNbChars=10),
            'price'=>$this->faker->randomFloat($nbMaxDecimals=3,$min=1,$max=100),
            'store_id' => Store::factory(),

        ];
    }
}
