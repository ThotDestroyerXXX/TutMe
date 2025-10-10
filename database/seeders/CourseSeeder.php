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
            'description' => 'Testing',
            'image' => 'math.png',
            //'instructor_id' => '1',
            'topics' => ['Bilangan Bulat', 'Operasi Bilangan Bulat', 'Bilangan Pecahan', 'Operasi Bilangan Pecahan'],
        ]);

        Course::create([
            'level' => '8',
            'subject' => 'Bahasa Inggris',
            'title' => 'Tenses',
            'description' => 'Testing',
            'image' => 'english.png',
            //'instructor_id' => '1',
            'topics' => ['Simple Present', 'Past Continuous', 'Present Perfect'],
        ]);
    }
}
