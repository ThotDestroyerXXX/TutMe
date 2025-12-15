<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // schedule table
        // Schema::create('schedules', function (Blueprint $table) {
        //     $table->ulid('id')->primary();
        //     $table->date('date');
        //     $table->time('start_time');
        //     $table->time('end_time');
        //     $table->string('meeting_link');
        //     $table->foreignUlid('course_id')->constrained('courses')->onDelete('cascade');
        //     $table->timestamps();
        // });

        $faker = Faker::create('id_ID');

        $courseIds = DB::table('courses')->pluck('id')->toArray();

        for ($i = 0; $i < 20; $i++) {
            DB::table('schedules')->insert([
                'id' => Str::ulid(),
                'date' => $faker->date(),
                'start_time' => $faker->time('H:i:s'),
                'end_time' => $faker->time('H:i:s'),
                'meeting_link' => $faker->url(),
                'course_id' => $faker->randomElement($courseIds),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
