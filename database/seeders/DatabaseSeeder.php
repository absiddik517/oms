<?php

namespace Database\Seeders;
use App\Models\Office;
use App\Models\LetterType;

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
            'name' => 'A.B. Siddik',
            'email' => 'absiddik517@gmail.com',
            'role' => 'admin',
            'password' => bcrypt('12345678'),
        ]);

        User::factory(9)->create();
        Office::factory(10)->create();

    }
}
