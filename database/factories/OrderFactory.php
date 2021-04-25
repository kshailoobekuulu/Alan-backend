<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

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
    public function definition()
    {
        return [
            'address'   =>  $this->faker->address,
            'phone'     =>  $this->faker->phoneNumber,
            'total_price'=> $this->faker->numberBetween(200,500),
            'additional_information'=> $this->faker->sentence,
            'status'    =>  $this->faker->randomElement(['waiting','in_progress','on_its_way','delivered']),
        ];
    }
}
