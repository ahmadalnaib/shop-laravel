<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Store;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\App;

class OrderFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Order::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    function generateProducts()
    {
        $products=array();
        for($i=0; $i < rand(1,3); $i++)
        {
            $product=User::factory();
            $product->quantity=rand(1,4);
            $products[]=$product;
        }
        return json_encode($products);
    }

    public function definition()
    {

        return [
            'transaction_id' => $this->faker->randomNumber($nbDigits=8,$strict=false),
            'payment_type'=>$this->faker->randomElement($array=['visa','knet','cash']),
            'status'=>$this->faker->randomElement($array=['delivered','paid','pending','failed']),
            'products'=>$this->generateProducts(),
            'store_id' => Store::factory(),
            'user_id'=>User::factory(),

        ];
    }
}
