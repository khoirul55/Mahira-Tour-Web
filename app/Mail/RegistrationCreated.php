<?php

namespace App\Mail;

use App\Models\Registration;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegistrationCreated extends Mailable
{
    use Queueable, SerializesModels;

    public $registration;
    public $dashboardUrl;

    public function __construct(Registration $registration, $dashboardUrl)
    {
        $this->registration = $registration;
        $this->dashboardUrl = $dashboardUrl;
    }

    public function build()
    {
        return $this->subject('Pendaftaran Berhasil - Mahira Tour')
                    ->view('emails.registration_created');
    }
}