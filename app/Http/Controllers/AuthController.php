<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Form Login Admin
     */
    public function showLoginForm()
    {
        // Jika sudah login, redirect ke dashboard
        if (Auth::guard('admin')->check()) {
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
        
        if (Auth::guard('admin')->attempt($validated, $request->remember)) {
            $request->session()->regenerate();
            return redirect()->route('admin.dashboard')
                ->with('success', 'Login berhasil! Selamat datang, ' . Auth::guard('admin')->user()->name);
        }
        
        return back()->withErrors(['email' => 'Email atau password salah'])->withInput();
    }

    /**
     * Process Logout Admin
     */
    public function logout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect()->route('admin.login')->with('success', 'Logout berhasil');
    }
}
