<?php

namespace Database\Seeders;

use App\Models\Transactions;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TransactionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // User::factory(50)->create();
        Transactions::create([
            'amount' => '10000',
            'transaction_date' => Transactions::create(2000, 1, 1),
        ]);
    }
}
