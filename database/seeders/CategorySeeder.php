<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            Category::firstOrCreate([
            'name'           => 'poiltical',
        ]);    Category::Create([
            'name'           => 'Sports',
        ]);    Category::Create([
            'name'           => 'funny',
        ]);




    }
}
