<?php

namespace App\Mail;

use App\Models\Payment;
use App\Models\Registration;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PaymentProofUploaded extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $payment;
    public $registration;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Payment $payment, Registration $registration)
    {
        $this->payment = $payment;
        $this->registration = $registration;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $type = strtoupper($this->payment->payment_type);
        
        return $this->subject("💰 Bukti Transfer Masuk: $type - " . $this->registration->full_name)
                    ->view('emails.admin.payment_proof_uploaded');
    }
}
