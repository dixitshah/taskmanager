<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\User;
use App\Models\Category;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::first(); // assume user exists
        $category = Category::first();

        Task::create([
            'user_id' => $user->id,
            'category_id' => $category->id,
            'title' => 'Sample Task',
            'description' => 'This is a test task',
            'due_date' => now()->addDays(3),
            'status' => 'pending',
            'priority' => 'high',
        ]);

    }
}
