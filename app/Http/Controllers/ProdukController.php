<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Produk;
use App\Models\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;

class ProdukController extends Controller
{
    public function index()
{
    $user_id = auth()->id(); // Mendapatkan ID pengguna yang sedang login

    // Ambil hanya produk yang dimasukkan oleh pengguna yang sedang login
    $produks = Produk::where('user_id', $user_id)->get();

    return view('frontendadmin.produk.index', ['produks' => $produks]);
}

    public function create(){
        
        return view('frontendadmin.produk.create');
    }

    
    public function store(Request $request)
{
    $request->validate([
        'nama_produk' => 'required|string|max:255',
        'harga' => 'required|numeric|min:0',
        'img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ], [
        'nama_produk.required' => 'Nama Produk tidak boleh kosong',
        'harga.required' => 'Harga tidak boleh kosong', // Pesan custom untuk validasi required
        'harga.numeric' => 'Harga harus berupa angka', // Pesan custom untuk validasi numeric
        'harga.min' => 'Harga tidak boleh negatif', // Pesan custom untuk validasi min:0
        'img.required' => 'Gambar produk Tidak Boleh Kosong', // Pesan custom untuk validasi required pada gambar
        'img.image' => 'File harus berupa gambar', // Pesan custom untuk validasi jenis file gambar
        'img.mimes' => 'Format file harus jpeg, png, jpg, gif, atau svg', // Pesan custom untuk validasi jenis format gambar
        'img.max' => 'Ukuran file gambar tidak boleh melebihi 2048 kilobita', // Pesan custom untuk validasi ukuran file gambar
    ]);

    $user_id = auth()->id(); // Mendapatkan ID pengguna yang saat ini masuk

    $produk = Produk::create([
        'nama_produk' => $request->nama_produk,
        'harga' => $request->harga,
        'user_id' => $user_id, // Menyimpan ID pengguna saat produk diunggah
    ]);

    $image = $request->file('img');
    $originalName = $image->getClientOriginalName();
    $imageName = time() . '_' .$originalName;
    $image->move(public_path('images'), $imageName);

    $imageUrl = url('images/' . $imageName);

    $produk->update([
        'img' => $imageUrl
    ]);

    $stock = new Stock();
    $stock->nama_produk = $request->nama_produk; 
    $stock->total_stok = 0;
    $stock->img = $imageUrl; 
    $stock->user_id = $user_id;
    $stock->save();

    return redirect()->route('produkadmin.index')->with('success_message', 'Product added successfully');
}


    public function edit($id)
{
    $produk = Produk::find($id);

    return view('frontendadmin.produk.edit', compact('produk'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'nama_produk' => 'required|string|max:255',
        'harga' => 'required|numeric|min:0',
        'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ], [
        'nama_produk.required' => 'Nama Produk tidak boleh kosong',
        'harga.required' => 'Harga tidak boleh kosong', // Pesan custom untuk validasi required
        'harga.numeric' => 'Harga harus berupa angka', // Pesan custom untuk validasi numeric
        'harga.min' => 'Harga tidak boleh negatif', // Pesan custom untuk validasi min:0
        'img.image' => 'File harus berupa gambar', // Pesan custom untuk validasi jenis file gambar
        'img.mimes' => 'Format file harus jpeg, png, jpg, gif, atau svg', // Pesan custom untuk validasi jenis format gambar
        'img.max' => 'Ukuran file gambar tidak boleh melebihi 2048 kilobita', // Pesan custom untuk validasi ukuran file gambar
    ]);

    $produk = Produk::findOrFail($id);

    $old_nama_produk = $produk->nama_produk; // Simpan nama produk sebelumnya

    $produk->update([
        'nama_produk' => $request->nama_produk,
        'harga' => $request->harga,
    ]);

    if ($request->hasFile('img')) {
        $image = $request->file('img');
        $originalName = $image->getClientOriginalName();
        $imageName = time() . '_' . $originalName;
        $image->move(public_path('images'), $imageName);

        $imageUrl = url('/images/' . $imageName);

        $produk->update([
            'img' => $imageUrl
        ]);
    }

    // Perbarui juga stok terkait
    $stock = Stock::where('nama_produk', $old_nama_produk)->first();
    if ($stock) {
        $stock->update([
            'nama_produk' => $request->nama_produk, // Mengubah nama produk di stok
            'img' => $produk->img,
        ]);
    }

    return redirect()->route('produkadmin.index')->with('success_message', 'Product updated successfully');
}

    public function destroy($id)
    {
    $produk = Produk::findOrFail($id);

    if ($produk->stock) {
        $produk->stock->delete();
    }
    $produk->delete();

    return redirect()->route('produkadmin.index')->with('success_message', 'Product deleted successfully');
    }
    public function updateCombinedData(Request $request, $id) {
        
        $product = Produk::find($id);
        $product->name = $request->input('nama_produk');
        $product->save();
    }

    

}
