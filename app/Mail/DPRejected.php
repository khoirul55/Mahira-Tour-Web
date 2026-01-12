<?php

namespace App\Mail;

use App\Models\Registration;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class DPRejected extends Mailable
{
    use Queueable, SerializesModels;

    public $registration;
    public $reason;
    public $dashboardUrl;

    public function __construct(Registration $registration, $reason = null)
    {
        $this->registration = $registration;
        $this->reason = $reason;
        $this->dashboardUrl = route('registration.dashboard', [
            'reg' => $registration->registration_number,
            'token' => $registration->access_token
        ]);
    }

    public function build()
    {
        return $this->subject('⚠️ Pembayaran DP Ditolak - Mahira Tour')
                    ->view('emails.dp-rejected');
    }
}