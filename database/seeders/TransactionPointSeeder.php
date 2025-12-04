<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TransactionPointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');
        $userId = DB::table('users')->pluck('id')->toArray();
        $courseId = DB::table('courses')->pluck('id')->toArray();


        for ($i = 0; $i < 10; $i++) {
            DB::table('transaction_points')->insert([
                'id' => Str::ulid(),
                'user_id' => $faker->randomElement($userId),
                'amount' => $faker->numberBetween(100, 1000),
                'type' => $faker->randomElement(['credit', 'debit']),
                'course_id' => $faker->randomElement($courseId),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
