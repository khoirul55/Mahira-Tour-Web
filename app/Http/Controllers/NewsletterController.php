<?php

namespace App\Http\Controllers;

use App\Models\Newsletter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class NewsletterController extends Controller
{
    public function subscribe(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:newsletters,email',
        ], [
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email ini sudah terdaftar di newsletter kami.',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => 'error',
                'message' => $validator->errors()->first('email')
            ], 422);
        }

        try {
            Newsletter::create([
                'email' => $request->email,
                'status' => 'subscribed'
            ]);

            // Kirim Email Sambutan ke User
            \Illuminate\Support\Facades\Mail::to($request->email)->send(new \App\Mail\NewsletterWelcomeMail());

            // Kirim Notifikasi ke Admin
            \Illuminate\Support\Facades\Mail::to(env('MAIL_FROM_ADDRESS'))->send(new \App\Mail\NewsletterAdminAlertMail($request->email));

            return response()->json([
                'status' => 'success',
                'message' => 'Terima kasih telah berlangganan newsletter kami!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Terjadi kesalahan sistem. Silakan coba lagi.'
            ], 500);
        }
    }
}
