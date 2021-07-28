<?php

namespace Database\Seeders;

use App\Models\Leases;
use App\Models\Products;
use App\Models\User;
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
        $this->call(CategoriesSeeder::class);

        User::factory(10)->create();

        Products::factory(100)->create();

        Leases::factory(20)->create();

    }
}
