<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    /**
     * Cek Pendaftaran Form
     */
    public function checkRegistrationForm()
    {
        return view('pages.check-registration');
    }

    /**
     * Cek Pendaftaran Submit
     */
    public function checkRegistrationSubmit(Request $request)
    {
        $validated = $request->validate([
            'keyword' => 'required|string', // Bisa No. Reg atau No. HP
            'email' => 'required|email'
        ]);
        
        // Cari berdasarkan Email DAN (No. Reg ATAU No. HP)
        $registration = \App\Models\Registration::where('email', $validated['email'])
            ->where(function($query) use ($validated) {
                $query->where('registration_number', $validated['keyword'])
                      ->orWhere('phone', $validated['keyword'])
                      // Support format HP 08xx vs 62xx
                      ->orWhere('phone', 'like', '%' . substr($validated['keyword'], -10)); 
            })
            ->first();
        
        if (!$registration) {
            return back()
                ->withErrors(['error' => 'Data tidak ditemukan. Pastikan Email dan Nomor Registrasi/HP sesuai.'])
                ->withInput();
        }
        
        // Generate/get token
        $token = $registration->generateAccessToken();
        
        // Redirect to dashboard
        return redirect()->route('registration.dashboard', [
            'reg' => $registration->registration_number,
            'token' => $token
        ]);
    }
}
