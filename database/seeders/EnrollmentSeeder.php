<?php

namespace Database\Seeders;

use App\Enums\EnrollmentStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class EnrollmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $userIds = DB::table('users')->pluck('id')->toArray();
        $courseIds = DB::table('courses')->pluck('id')->toArray();

        for ($i = 0; $i < 20; $i++) {
            DB::table('enrollments')->insert([
                'id' => Str::ulid(),
                'user_id' => $faker->randomElement($userIds),
                'course_id' => $faker->randomElement($courseIds),
                'point_spent' => 10,
                'grade' => $faker->optional()->randomFloat(2, 0, 100),
                'status' => $faker->randomElement(EnrollmentStatus::cases())->value,
                'recording' => null,
                'date' => $faker->date(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
