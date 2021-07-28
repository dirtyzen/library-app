<?php

namespace Database\Seeders;

use App\Models\Categories;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('categories')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        $categories = [
            [
                'name' => 'Books',
                'slug' => 'books',
            ],
            [
                'name' => 'CDs',
                'slug' => 'cds',
            ],
            [
                'name' => 'Games',
                'slug' => 'games',
            ],
        ];

        foreach ($categories as $category) {
            Categories::create($category);
        }
    }
}
