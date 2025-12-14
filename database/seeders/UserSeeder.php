<?php

namespace Database\Seeders;

use App\Enums\EducationLevel;
use App\Enums\Role;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        User::create([
            'id' => '1',
            'email' => 'gautamadarrel06@gmail.com',
            'name' => 'Darrel Gautama',
            'email_verified_at' => null,
            'password' => '123',
            'remember_token' => NULL,
            'role' => 'Mentor',
            'phone_number' => null,
            'image_url' => null,
            'bio' => null,
            'NISN' => null,
            'point' => '50',
            'rating' => '5',
            'education_level' => $faker->randomElement(EducationLevel::cases())->value,
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
            'education_level' => $faker->randomElement(EducationLevel::cases())->value,
            'major' => 'Computer Science',
        ]);
        User::create([
            'id' => '3',
            'email' => 'drel@gmail.com',
            'name' => 'Drel',
            'email_verified_at' => null,
            'password' => '123',
            'remember_token' => NULL,
            'role' => 'Tutee',
            'phone_number' => null,
            'image_url' => null,
            'bio' => null,
            'NISN' => null,
            'point' => '50',
            'rating' => '5',
            'education_level' => $faker->randomElement(EducationLevel::cases())->value,
            'major' => null,
        ]);

        for ($i = 4; $i <= 50; $i++) {
            $imageId = $faker->numberBetween(1, 50);
            User::create([
                'id' => (string)$i,
                'email' => $faker->unique()->safeEmail(),
                'name' => $faker->name(),
                'email_verified_at' => null,
                'password' => '123',
                'remember_token' => null,
                'role' => Role::STUDENT->value,
                'phone_number' => $faker->phoneNumber(),
                'image_url' => 'https://picsum.photos/id/' . $imageId . '/200/300',
                'bio' => $faker->paragraph(8, true),
                'NISN' => $faker->unique()->numerify('##########'),
                'point' => $faker->numberBetween(0, 100),
                'rating' => '5',
                'education_level' => $faker->randomElement(EducationLevel::cases())->value,
                'major' => null,
            ]);
        }
    }
}
