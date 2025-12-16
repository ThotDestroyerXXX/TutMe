<?php

namespace App\Http\Controllers;

use App\Exports\TransactionsExport;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transactions;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Facades\Excel;
use Midtrans\Transaction;

class TransactionsController extends Controller
{

    public function createTransaction(Request $request)
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;

        $request->validate([
            'amount' => 'required|numeric|between:1000,1000000',
        ]);

        $amount = $request->input('amount');

        $params = [
            'transaction_details' => [
                'order_id' => uniqid(),
                'gross_amount' => $amount,
            ],
            'customer_details' => [
                'email' => Auth::user()->email,
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return view('transaction.midtrans', ['snapToken' => $snapToken]);
    }

    public function store(Request $request)
    {
        $amount = $request->query('amount');
        $status = $request->query('status');

        if (in_array($status, ['capture', 'settlement'])) {
            $newTr = Transactions::create([
                'id' => Str::ulid(),
                'amount' => $amount,
                'transaction_date' => now(),
                'email' => App(UserController::class)->getUserById(Auth::id())->email,
            ]);
            $newTr->save();
        }

        return app(HomeController::class)->index();
    }

    public function getSumTransaction()
    {
        return Transactions::sum('amount');
    }

    public function getTransactionPersentage()
    {
        return $this->getSumTransaction() > 0 ? (App(UserController::class)->getUsedPoint() / $this->getSumTransaction()) * 100 : 0;
    }

    public function export()
    {
        // Use temp disk for serverless environments like Vercel
        return Excel::download(new TransactionsExport, 'transactions.xlsx')
            ->deleteFileAfterSend(true);
    }
}
