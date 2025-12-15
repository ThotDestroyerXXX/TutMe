<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Course;
use App\Models\Transaction;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            CourseSeeder::class,
            EnrollmentSeeder::class,
            ScheduleSeeder::class,
            TransactionsSeeder::class,
            TransactionPointSeeder::class,
        ]);
    }
}
