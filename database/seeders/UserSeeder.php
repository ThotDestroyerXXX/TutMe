<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::factory(50)->create();
        User::create([
            'id' => '1',
            'email' => 'gautamadarrel06@gmail.com',
            'name' => 'Darrel Gautama',
            'email_verified_at' => null,
            'password' => '123',
            'remember_token' => NULL,
            'role' => 'Tutor',
            'phone_number' => null,
            'image_url' => null,
            'bio' => null,
            'NISN' => null,
            'point' => '50',
            'rating' => '5',
            'education_level' => 'Master',
            'major' => 'Computer Science',
        ]);
        User::create([
            'id' => '2',
            'email' => 'gautamadarrel@yahoo.com',
            'name' => 'Darrel',
            'email_verified_at' => null,
            'password' => '123',
            'remember_token' => NULL,
            'role' => 'Donator',
            'phone_number' => null,
            'image_url' => null,
            'bio' => null,
            'NISN' => null,
            'point' => '0',
            'rating' => '5',
            'education_level' => 'Master',
            'major' => 'Computer Science',
        ]);
    }
}
