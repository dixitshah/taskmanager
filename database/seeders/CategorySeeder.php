<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert([
            ['name' => 'Work', 'description' => 'Work related tasks'],
            ['name' => 'Personal', 'description' => 'Personal tasks'],
            ['name' => 'Shopping', 'description' => 'Grocery & shopping tasks'],
        ]);
    }

}
