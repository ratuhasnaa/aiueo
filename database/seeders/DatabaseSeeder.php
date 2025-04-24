<?php

namespace Database\Seeders;

<<<<<<< HEAD
=======
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
>>>>>>> fitur-admin
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
<<<<<<< HEAD
        
        $this->call(ExpenseSeeder::class);
        
=======
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
>>>>>>> fitur-admin
    }
}
