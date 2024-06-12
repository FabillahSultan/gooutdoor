<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class StockController extends Controller
{
    public function index()
    {
        $user_id = auth()->id(); // Mendapatkan ID pengguna yang sedang login

    // Ambil hanya produk yang dimasukkan oleh pengguna yang sedang login
        $stocks = Stock::where('user_id', $user_id)->get();

        return view('frontendadmin.stock.index', compact('stocks'));
    }

    public function create()
    {
        $stocks = Stock::all(); 

        return view('stock.create', compact('produks'));
    }

    public function store(Request $request)
    {
    $this->validate($request, [
        'produk_id' => 'required',
        'total_stok' => 'required',
    ]);

    $user_id = auth()->id(); // Mendapatkan ID pengguna yang saat ini masuk

    $product = Produk::find($request->input('produk_id'));

    Stock::create([
        'nama_produk' => $product->nama_produk,
        'produk_id' => $request->input('produk_id'),
        'total_stok' => $request->input('total_stok'),
        'img' => $request->input('img'),
    ]);

    return redirect()->route('adminstock.index')->with('success_message', 'Stock added successfully');
    }

    public function edit($id)
    {
        $stock = Stock::findOrFail($id);
        $produks = Produk::all(); // Fetch all products

        return view('frontendadmin.stock.edit', compact('stock', 'produks'));
    }

    public function update(Request $request, $id)
{
    $this->validate($request, [
        'total_stock' => 'required|numeric|min:0',
        // Tambahkan aturan validasi lainnya sesuai kebutuhan
    ], [
        'total_stock.required' => 'Harga tidak boleh kosong', // Pesan custom untuk validasi required
        'total_stock.numeric' => 'Harga harus berupa angka', // Pesan custom untuk validasi numeric
        'total_stock.min' => 'Harga tidak boleh negatif', // Pesan custom untuk validasi min:0
    ]);

    $stock = Stock::findOrFail($id);

    $stock->update([
        'total_stok' => $request->input('total_stock'),
        // Update bidang lainnya sesuai kebutuhan
    ]);

    return redirect()->route('adminstock.index')->with('success_message', 'Total stok berhasil diperbarui');
}


    public function destroy($id)
    {
        $stock = Stock::findOrFail($id);
        $stock->delete();

        return redirect()->route('adminstock.index')->with('success_message', 'Stock deleted successfully');
    }
}
