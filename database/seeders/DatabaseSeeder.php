<?php

namespace Database\Seeders;

use App\Models\Action;
use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        Product::factory(10)->create();
        Action::factory(10)->create();
        Category::factory(15)->create();
        Banner::factory(10)->create();
        Order::factory(10)->create();

        for($i = 1; $i <= 10; $i++) {
            Action::find($i)->products()->attach([
                random_int(1, 3) => ['quantity' => random_int(1, 10)],
                random_int(4, 7) => ['quantity' => random_int(1, 10)],
                random_int(7, 10) => ['quantity' => random_int(1, 10)],
            ]);
            Category::find($i)->products()->attach(Product::all()->random(3));
        }
    }
}
