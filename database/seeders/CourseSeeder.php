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
            'subject' => 'Matematika',
            'title' => 'Bilangan',
            'description' => 'Testing',
            //'instructor_id' => '1',
            'topics' => ['Bilangan Bulat', 'Operasi Bilangan Bulat', 'Bilangan Pecahan', 'Operasi Bilangan Pecahan'],
        ]);

        Course::create([
            'subject' => 'Bahasa Inggris',
            'title' => 'Tenses',
            'description' => 'Testing',
            //'instructor_id' => '1',
            'topics' => ['Simple Present', 'Past Continuous', 'Present Perfect'],
        ]);
    }
}
