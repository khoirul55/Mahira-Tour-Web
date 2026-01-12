<?php

namespace App\Mail;

use App\Models\Registration;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DPVerified extends Mailable
{
    use Queueable, SerializesModels;

    public $registration;
    public $dashboardUrl;

    public function __construct(Registration $registration)
    {
        $this->registration = $registration;
        $this->dashboardUrl = route('registration.dashboard', [
            'reg' => $registration->registration_number,
            'token' => $registration->access_token
        ]);
    }

    public function build()
    {
        return $this->subject('✅ Pembayaran DP Diverifikasi - Mahira Tour')
                    ->view('emails.dp-verified');
    }
}