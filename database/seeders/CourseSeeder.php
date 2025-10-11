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
            'instructor_id' => '01k78pbc2khbdy6r2gavkh5z6h',
            'topics' => ['Bilangan Bulat', 'Operasi Bilangan Bulat', 'Bilangan Pecahan', 'Operasi Bilangan Pecahan'],
        ]);

        Course::create([
            'level' => '8',
            'subject' => 'Bahasa Inggris',
            'title' => 'Tenses',
            'image' => 'bahasa inggris.png',
            'session' => '1',
            'instructor_id' => '01k78pbc2khbdy6r2gavkh5z6h',
            'topics' => ['Simple Present', 'Past Continuous', 'Present Perfect'],
        ]);
    }
}
