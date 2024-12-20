<?php

namespace Database\Seeders;

use App\Models\Classroom;
use App\Models\Transport;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $teacherRole = Role::create(['name' => 'teacher']);
        $studentRole = Role::create(['name' => 'student']);

        // User::factory(10)->create();
        User::factory()->create([
            'name' => 'M_TTI',
            'email' => '1martinbonetti@gmail.com',
            'password' => 'password',
            'is_admin' => 1,
        ]);
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
            'is_admin' => 1,
        ]);

        $c = new Classroom;
        $c->label = 'SIO2';
        $c->letter = 'A';
        $c->user_id = 1;
        $c->save();

        User::factory(10)->student()->create([
            'classroom_id' => $c->id,
        ]);

        User::factory(5)->teacher()->create();

        Classroom::factory(5)->create();
        Transport::factory(5)->create();
    }
}
