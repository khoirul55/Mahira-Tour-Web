<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * Form Login Admin
     */
    public function showLoginForm()
    {
        // Jika sudah login, redirect ke dashboard
        if (session('admin_logged_in')) {
            return redirect()->route('admin.dashboard');
        }
        
        return view('admin.login');
    }

    /**
     * Process Login Admin
     */
    public function login(Request $request)
    {
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        
        // Cari admin berdasarkan email
        $admin = Admin::where('email', $validated['email'])->first();
        
        // Validasi password
        if ($admin && Hash::check($validated['password'], $admin->password)) {
            session([
                'admin_logged_in' => true,
                'admin_id' => $admin->id,
                'admin_name' => $admin->name,
                'admin_email' => $admin->email
            ]);
            
            return redirect()->route('admin.dashboard')
                ->with('success', 'Login berhasil! Selamat datang, ' . $admin->name);
        }
        
        return back()->withErrors(['email' => 'Email atau password salah'])->withInput();
    }

    /**
     * Process Logout Admin
     */
    public function logout()
    {
        session()->flush();
        return redirect()->route('admin.login')->with('success', 'Logout berhasil');
    }
}
