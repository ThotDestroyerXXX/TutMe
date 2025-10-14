<?php

namespace Database\Seeders;

use App\Models\Transactions;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Midtrans\Transaction;

class TransactionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //Transactions::factory(50)->create();
        $data = [];

        FOR ($I = 0; $I < 10; $I++) {
            $data[] = [
                'ID' => STR::UUID(),
                'AMOUNT' => RAND(10000, 1000000),
                'TRANSACTION_DATE' => NOW(),
            ];
        }

        DB::table('transactions')->insert($data);
    }
}
