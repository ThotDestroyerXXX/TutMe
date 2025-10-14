<?php

namespace App\Http\Controllers;

use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MidtransController extends Controller{

    public function createTransaction(Request $request)
    {
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = false;
        Config::$isSanitized = true;
        Config::$is3ds = true;
        

        $params = [
            'transaction_details' => [
                'order_id' => uniqid(),
                'gross_amount' => 10000,
            ],
            'customer_details' => [
                'first_name' => 'Darrel',
                'email' => 'gautamadarrel06@gmail.com',
            ],
        ];

        $snapToken = Snap::getSnapToken($params);
        return view('transaction.midtrans', ['snapToken' => $snapToken]);
    }
}