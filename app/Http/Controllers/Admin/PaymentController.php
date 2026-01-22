<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use App\Models\Payment;
use App\Mail\DPVerified;
use App\Mail\DPRejected;
use App\Mail\PelunasanTagihan;
use App\Mail\PelunasanVerified;
use App\Mail\PelunasanRejected;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class PaymentController extends Controller
{
    /**
     * Verify Payment (DP)
     */
    public function verify(Request $request, $id)
    {
        $payment = Payment::with('registration')->findOrFail($id);
        $action = $request->input('action');
        
        DB::beginTransaction();
        
        try {
            if ($action === 'approve') {
                $payment->update([
                    'status' => 'verified',
                    'verified_at' => now()
                ]);
                
                $payment->registration->update(['status' => 'confirmed']);
                
                // Send email notification
                try {
                    Mail::to($payment->registration->email)
                        ->send(new DPVerified($payment->registration));
                } catch (\Exception $e) {
                    Log::error('Email DPVerified failed: ' . $e->getMessage());
                }
                
                $message = 'Pembayaran berhasil diverifikasi!';
            } else {
                $payment->update([
                    'status' => 'rejected',
                    'rejection_notes' => $request->input('notes'),
                    'verified_at' => now()
                ]);
                
                // Send rejection email
                try {
                    Mail::to($payment->registration->email)
                        ->send(new DPRejected($payment->registration, $request->input('notes')));
                } catch (\Exception $e) {
                    Log::error('Email DPRejected failed: ' . $e->getMessage());
                }
                
                $message = 'Pembayaran ditolak.';
            }
            
            DB::commit();
            return back()->with('success', $message);
            
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Payment Verification Error: ' . $e->getMessage());
            return back()->with('error', 'Gagal memproses pembayaran. Silakan coba lagi.');
        }
    }

    /**
     * Pelunasan List
     */
    public function pelunasan()
    {
        $registrations = Registration::with('schedule', 'payments')
            ->where('status', 'confirmed')
            ->where('is_lunas', false)
            ->whereHas('payments', function($q) {
                $q->where('payment_type', 'dp')->where('status', 'verified');
            })
            ->get();
        
        return view('admin.pelunasan.index', compact('registrations'));
    }

    /**
     * Send Tagihan Pelunasan
     */
    public function sendTagihan($registrationId)
    {
        try {
            $registration = Registration::with('schedule')->findOrFail($registrationId);
            
            if (!$registration->needsPelunasan()) {
                return back()->with('error', 'Registrasi ini tidak perlu pelunasan');
            }
            
            Mail::to($registration->email)->send(new PelunasanTagihan($registration));
            
            $registration->update(['last_pelunasan_reminder_at' => now()]);
            
            return back()->with('success', '✅ Tagihan pelunasan berhasil dikirim ke ' . $registration->email);
            
        } catch (\Exception $e) {
            Log::error('Send Tagihan Error: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Gagal mengirim tagihan. Pastikan email user valid atau coba lagi nanti.']);
        }
    }

    /**
     * Verify Pelunasan
     */
    public function verifyPelunasan(Request $request, $paymentId)
    {
        $validated = $request->validate([
            'action' => 'required|in:approve,reject',
            'rejection_reason' => 'required_if:action,reject|nullable|string'
        ]);
        
        DB::beginTransaction();
        try {
            $payment = Payment::with('registration.schedule')->findOrFail($paymentId);
            
            if ($payment->payment_type !== 'pelunasan') {
                throw new \Exception('Bukan payment pelunasan');
            }
            
            if ($validated['action'] === 'approve') {
                $payment->update([
                    'status' => 'verified',
                    'verified_by' => session('admin_id'), // Assuming admin_id is stored in session
                    'verified_at' => now()
                ]);
                
                $payment->registration->update(['is_lunas' => true]);
                
                Mail::to($payment->registration->email)
                    ->send(new PelunasanVerified($payment->registration));
                
                DB::commit();
                return back()->with('success', '✅ Pelunasan verified! User dapat email LUNAS');
            } else {
                $payment->update([
                    'status' => 'rejected',
                    'rejection_reason' => $validated['rejection_reason'],
                    'verified_by' => session('admin_id'),
                    'verified_at' => now()
                ]);
                
                Mail::to($payment->registration->email)
                    ->send(new PelunasanRejected(
                        $payment->registration, 
                        $validated['rejection_reason']
                    ));
                
                DB::commit();
                return back()->with('success', '⚠️ Pelunasan ditolak, email notifikasi terkirim');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Verify Pelunasan Error: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Terjadi kesalahan saat memproses pelunasan.']);
        }
    }
}
