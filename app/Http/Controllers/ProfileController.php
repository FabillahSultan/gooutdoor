<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user(); // Mengambil informasi lengkap pengguna yang sedang masuk
        return view('frontendadmin.profil.index', compact('user'));
    }

    public function edit()
    {
        $user = auth()->user();
    
        return view('frontendadmin.profil.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $user = User::where('id', auth()->user()->id)->firstOrFail();
    
        // Validasi data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,'.$user->id,
            'alamat' => 'required|string|max:255',
            'foto' => 'image|mimes:jpeg,png,jpg,gif|max:2048', // contoh validasi foto, sesuaikan dengan kebutuhan Anda
        ], [
            'name.required' => 'Nama Produk tidak boleh kosong',
            'email.required' => 'email tidak boleh kosong', // Pesan custom untuk validasi required
            'alamat.required' => 'alamat tidak boleh kosong', // Pesan custom untuk validasi required
            'foto.image' => 'File harus berupa gambar', // Pesan custom untuk validasi jenis file gambar
            'foto.mimes' => 'Format file harus jpeg, png, jpg, gif, atau svg', // Pesan custom untuk validasi jenis format gambar
            'foto.max' => 'Ukuran file gambar tidak boleh melebihi 2048 kilobita', // Pesan custom untuk validasi ukuran file gambar
        ]);
    
        // Update data
        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'alamat' => $validatedData['alamat'],
        ]);
        
        if ($request->hasFile('foto')) {
            // Hapus foto lama jika ada
            if ($user->foto) {
                // Mengambil nama file dari path foto lama
                $oldFoto = basename($user->foto);
                // Hapus foto lama dari direktori publik
                if (file_exists(public_path('foto_profil/' . $oldFoto))) {
                    unlink(public_path('foto_profil/' . $oldFoto));
                }
            }
        
            // Simpan foto baru
            $image = $request->file('foto');
            $originalName = $image->getClientOriginalName();
            $imageName = time() . '_' . $originalName;
            $image->move(public_path('foto_profil'), $imageName); // Simpan foto ke direktori publik
            $fotoPath = 'foto_profil/' . $imageName; // Simpan path foto
        
            $user->foto = $fotoPath;
        }
        
        $user->save();
        
    
        return redirect()->route('adminprofile.index')->with('success', 'Profil berhasil diperbarui');
    }
    


}
