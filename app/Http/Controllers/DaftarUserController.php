<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DaftarUserController extends Controller
{
    public function daftartoko()
    {
        $admin = User::where('type', '!=', 0)->where('type', '!=', 2);
        $totaladmin = $admin->get();

        return view('frontendsuperadmin.daftartoko', compact('totaladmin'));
    }

    public function daftarcustomer()
    {
        $admin = User::where('type', '!=', 1)->where('type', '!=', 2);
        $totalcustomer = $admin->get();

        return view('frontendsuperadmin.daftarcustomer', compact('totalcustomer'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('manager.daftartoko')->with('success_message', 'User deleted successfully');
    }

    public function destroycustomer($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('manager.daftarcustomer')->with('success_message', 'User deleted successfully');
    }

    
}
