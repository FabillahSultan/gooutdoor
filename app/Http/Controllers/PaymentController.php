<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transaksi;

class PaymentController extends Controller
{
    public function callback(Request $request)
    {
        $json = json_decode($request->json);

        // Logika untuk menangani status pembayaran
        $transaksi = Transaksi::find($json->order_id);
        $transaksi->status = $json->transaction_status; // Misalnya, capture, settlement, pending, dll.
        $transaksi->save();

        return redirect()->route('home')->with('success', 'Pembayaran berhasil diproses.');
    }
}
