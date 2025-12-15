<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class TransactionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [];

        for ($i = 0; $i < 30; $i++) {
            $data[] = [
                'id' => Str::ulid(),
                'amount' => rand(10000, 1000000),
                'email' => 'user' . rand(1, 5) . '@example.com',
                'transaction_date' => now()->subDays(rand(0, 30))->toDateString(),
            ];
        }

        DB::table('transactions')->insert($data);
    }
}
