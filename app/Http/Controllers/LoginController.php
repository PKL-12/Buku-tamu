<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function index()
    {
        return view('login'); 
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);

        $admin = DB::table('admin')->where('username', $request->username)->first();

        if ($admin && Hash::check($request->password, $admin->password)) {

            session([
                'admin_id' => $admin->id,
                'admin_username' => $admin->username,
                'admin_name' => $admin->nama_lengkap
            ]);

            return redirect()->route('home');
        }

        return back()->withErrors([
            'login_error' => 'Username atau password salah'
        ]);
    }

    // =============================
    // FORM REGISTER
    // =============================
    public function register()
    {
        return view('register'); // register.blade.php
    }

    // =============================
    // PROSES SIMPAN USER BARU
    // =============================
    public function store(Request $request)
    {
        $request->validate([
            'nama_lengkap' => 'required',
            'username' => 'required|unique:admin,username',
            'password' => 'required|min:5'
        ]);

        DB::table('admin')->insert([
            'nama_lengkap' => $request->nama_lengkap,
            'username' => $request->username,
            'password' => Hash::make($request->password)
        ]);

        return redirect()->route('login')->with('success', 'Akun berhasil dibuat! Silakan login.');
    }

    public function logout(Request $request)
    {
        $request->session()->flush();
        return redirect()->route('login');
    }
}
