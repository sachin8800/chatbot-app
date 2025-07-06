<?php

namespace Database\Seeders;

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
    // Factory se 1 test user
    User::factory()->create([
        'name' => 'Test User',
        'email' => 'test@example.com',
    ]);

    // Static users from UserSeeder
    $this->call([
        UserSeeder::class,
    ]);
}

}
