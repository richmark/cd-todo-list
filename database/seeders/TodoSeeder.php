<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\TodoModel;

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TodoModel::factory()->count(240)->create(); 
    }
}
