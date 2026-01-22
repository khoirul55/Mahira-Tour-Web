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
            'registration_number' => 'required|string',
            'email' => 'required|email'
        ]);
        
        $registration = \App\Models\Registration::where('registration_number', $validated['registration_number'])
            ->where('email', $validated['email'])
            ->first();
        
        if (!$registration) {
            return back()
                ->withErrors(['error' => 'Nomor registrasi atau email tidak ditemukan. Pastikan data yang Anda masukkan benar.'])
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
