<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::create([
            'name'=> 'John Doe',
            'email'=> 'johndoe@example.com',
            'password'=>bcrypt('password')
        ]);
        $user->createToken('JohnDoe')->plainTextToken;

        User::factory()->count(10)->create();

    }
}
