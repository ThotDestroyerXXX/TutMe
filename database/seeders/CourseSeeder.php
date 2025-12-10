<?php

namespace Database\Seeders;

use App\Enums\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course;
use App\Models\User;
use Faker\Factory as Faker;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $mentors = User::where('role', Role::TUTOR->value)->pluck('id')->toArray();
        Course::create([
            'level' => '7',
            'subject' => 'Matematika',
            'title' => 'Bilangan',
            'image' => 'matematika.png',
            'session' => '1',
            'day' => json_encode(['Monday', 'Wednesday']),
            'instructor_id' => '1',
            'topics' => json_encode(['Bilangan Bulat', 'Bilangan Pecahan', 'Bilangan Desimal']),
        ]);

        Course::create([
            'level' => '8',
            'subject' => 'Bahasa Inggris',
            'title' => 'Tenses',
            'image' => 'bahasa inggris.png',
            'session' => '1',
            'day' => json_encode(['Tuesday', 'Thursday']),
            'instructor_id' => '1',
            'is_active' => false,
            'topics' => json_encode(['Present Simple', 'Past Simple', 'Future Simple']),
        ]);

        for ($i = 3; $i <= 20; $i++) {
            $imageId = $faker->numberBetween(1, 50);
            Course::create([
                'level' => (string)$faker->numberBetween(7, 12),
                'subject' => $faker->randomElement(['Matematika', 'Bahasa Inggris', 'Fisika', 'Kimia', 'Biologi', 'Sejarah', 'Geografi']),
                'title' => $faker->sentence(3, true),
                'image' => "https://picsum.photos/id/" . $imageId . '/200/300',
                'session' => (string)$faker->numberBetween(1, 2),
                'day' => json_encode($faker->randomElements(['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'], $faker->numberBetween(1, 3))),
                'instructor_id' => $faker->randomElement($mentors),
                'topics' => json_encode([$faker->word(), $faker->word(), $faker->word()]),
            ]);
        }
    }
}
