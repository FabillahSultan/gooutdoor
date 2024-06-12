<?php
 
namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Produk; 
use App\Models\Transaksi;
use Illuminate\Support\Facades\Session; // Tambahkan ini
 
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware(['auth','verified']);
    // }
 
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $users = User::all(); // Mengambil semua pengguna
        return view('frontenduser.homepage', compact('users')); // Menyampaikan $users ke tampilan
    }

    public function Produkbyiduser($user_id)
    {
        session()->put('selected_store', $user_id);
        
        
        // Mengambil pengguna (user) berdasarkan ID
        $user = User::find($user_id);
        
        // Mengambil produk yang terkait dengan pengguna (user) tersebut
        $produks = Produk::join('users', 'produks.user_id', '=', 'users.id')
        ->where('produks.user_id', $user_id)
        ->select('produks.*','users.*')
        ->get();
    
        // Mengembalikan tampilan dengan produk yang ditemukan
        return view('frontenduser.produk', compact('user', 'produks'));
    }

    public function Produkbyiduser1($name_user,$id_user_enkription)
    {
        $user_id = decrypt($id_user_enkription);
        $user = User::find($user_id);
        
        $produks = Produk::join('users', 'produks.user_id', '=', 'users.id')
        ->where('produks.user_id', $user_id)
        ->where('users.name', $name_user)
        ->select('produks.*','users.*')
        ->get(); 

      
        return view('frontenduser.detail', compact('user', 'produks'));
    }
    

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:8',
            'type' => 'required|in:user,admin,manager',
            'alamat' => $request->user()->isAdmin() ? 'required|string|max:255' : '',
            'foto' => $request->user()->isAdmin() ? 'required|string|max:255' : '',
        ]);

        // Simpan data
        User::create($data);

        return redirect()->route('home')->with('success', 'User created successfully.');
    }

    public function detailpesanan(Request $request)
    {
        // Mendapatkan data produk yang dipilih dari query string
        $produkDipilih = json_decode($request->input('produk'), true);
    
        // Jika tidak ada produk yang dipilih, kembalikan ke halaman sebelumnya
        if (!$produkDipilih) {
            return redirect()->back()->with('error', 'Anda belum memilih produk apa pun.');
        }
    
        // Simpan data produk yang dipilih ke dalam session
        session()->put('produkDipilih', $produkDipilih);
    
        // Kirim data produk yang dipilih ke view
        return view('frontenduser.detailpesanan', compact('produkDipilih'));
    }

 
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminHome()
{
    $user_id = auth()->id();

    $produks = Produk::where('user_id', $user_id)->get();
    $totalProduks = $produks->count();

    $transaksi = Transaksi::where('user_id', $user_id)
                          ->orWhere('id_pesanan', $user_id)
                          ->where('status', '!=', 1)
                          ->get();
    $pengajuansewa = $transaksi->count();

    $query = Transaksi::where('user_id', $user_id)
                    ->orWhere('id_pesanan', $user_id)
                    ->where('status', '!=', 0);
    
    $transaksis = $query->get();

    $statistikPendapatan = 0;

    foreach ($transaksis as $transaksi) {
        $produkDipilih = explode(',', $transaksi->nama_produk);
        foreach ($produkDipilih as $produk) {
            $produk = trim($produk);
            $namaProduk = explode('(', $produk)[0];
            if (!empty($namaProduk)) {
                if (!isset($statistikPenjualan[$namaProduk])) {
                    $statistikPenjualan[$namaProduk] = 1;
                } else {
                    $statistikPenjualan[$namaProduk]++;
                }
            }
        }
        $statistikPendapatan += $transaksi->total_harga;
    }

    $banyaktransaksi = Transaksi::where('user_id', $user_id)
                        ->orWhere('id_pesanan', $user_id)
                        ->where('status', '!=', 0);

    $totaltransaksi = $banyaktransaksi->count();

    $uhuy = Transaksi::where('user_id', $user_id)
                        ->orWhere('id_pesanan', $user_id);

    $uhuyy = $uhuy->count();

    return view('frontendadmin.adminHome', compact('totalProduks', 'pengajuansewa',  'transaksi', 'totaltransaksi', 'statistikPendapatan', 'uhuyy'));
}
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function managerHome()
    {
        // $user = User::where('type', '!=', 2)->where('type', '!=', 1);
        $user = User::where('type', '!=', 2);
        $totaluser = $user->count();

         $admin = User::where('type', '!=', 0)->where('type', '!=', 2);
         $totaladmin = $admin->get();


        return view('frontendsuperadmin.managerHome', compact('totaluser', 'totaladmin'));
    }
}