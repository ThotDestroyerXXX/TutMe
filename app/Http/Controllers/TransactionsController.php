<?php

namespace App\Http\Controllers;

use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transactions;
use Illuminate\Support\Str;

class TransactionsController extends Controller{

    public function createTransaction(Request $request)
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;
        
        $request->validate([
            'amount' => 'required|numeric|min:1000',
        ]);

        $amount = $request->input('amount');

        $params = [
            'transaction_details' => [
                'order_id' => uniqid(),
                'gross_amount' => $amount,
            ],
            'customer_details' => [
                'first_name' => Auth::user()->name ?? 'Guest',
                'email' => Auth::user()->email ?? 'guest@example.com',
            ],
        ];

        $snapToken = Snap::getSnapToken($params);

        return view('transaction.midtrans', ['snapToken' => $snapToken]);
    }

    public function store(Request $request)
    {
        $orderId = $request->query('order_id');
        $amount = $request->query('amount');
        $status = $request->query('status');

        if (in_array($status, ['capture', 'settlement'])) {
            $newTr = Transactions::create([
                'id' => Str::uuid(),
                'amount' => $amount,
                'transaction_date' => now(),
            ]);
            $newTr->save();
        }

        return app(HomeController::class)->index();
    }
}