<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Question;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();
		$a = User::updateOrCreate(
            ['email' => 'demo@example.com'],
            ['name' => 'Usuario Demo', 'password' => Hash::make('password')]
        );
        $b = User::updateOrCreate(
            ['email' => 'otra@example.com'],
            ['name' => 'Otra Persona', 'password' => Hash::make('password')]
        );

        Question::factory()->count(2)->create(['user_id' => $a->id]);
		Question::factory()->count(1)->create(['user_id' => $b->id]);
    }
}
