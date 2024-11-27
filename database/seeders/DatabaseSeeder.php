<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Transport;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'is_admin' => 1,
        ]);

        Classroom::factory(5)->create();
        Transport::factory(5)->create();
    }
}
