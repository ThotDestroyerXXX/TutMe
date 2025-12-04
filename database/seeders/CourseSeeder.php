<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Course;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
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
    }
}
