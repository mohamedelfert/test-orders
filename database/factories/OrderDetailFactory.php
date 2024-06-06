<?php

namespace Database\Factories;

use App\Models\OrderDetail;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderDetailFactory extends Factory
{
    protected $model = OrderDetail::class;

    public function definition()
    {
        return [
            'order_id' => null,
            'product_name' => $this->faker->word,
            'quantity' => $this->faker->numberBetween(1, 100),
            'price' => $this->faker->randomFloat(2, 1, 100),
        ];
    }
}
