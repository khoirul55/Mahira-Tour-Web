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
        $payment = Payment::with('registration.schedule')->findOrFail($id);
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

                // Send WhatsApp Notification (DP Approved)
                try {
                    $reg = $payment->registration;
                    $waMessage = "Assalamu'alaikum *{$reg->full_name}*,\n\n";
                    $waMessage .= "✅ *PEMBAYARAN DITERIMA*\n";
                    $waMessage .= "Alhamdulillah, pembayaran DP Anda telah kami verifikasi.\n\n";
                    $waMessage .= "No. Reg: *{$reg->registration_number}*\n";
                    $waMessage .= "Nominal: *Rp " . number_format($payment->amount, 0, ',', '.') . "*\n\n";
                    $waMessage .= "📅 *Status Terbaru:*\n";
                    $waMessage .= "Status Pendaftaran: *TERKONFIRMASI*\n";
                    $waMessage .= "Sisa Tagihan: *Rp " . number_format($reg->sisaPelunasan(), 0, ',', '.') . "*\n\n";
                    $waMessage .= "Silakan cek detail di Dashboard Jamaah.\n";
                    $waMessage .= "*Mahira Tour*";

                    \App\Jobs\SendWhatsAppNotification::dispatch($reg->phone, $waMessage);
                } catch (\Exception $e) {
                    Log::error('WA DPVerified failed: ' . $e->getMessage());
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

                // Send WhatsApp Notification (DP Rejected)
                try {
                    $reg = $payment->registration;
                    $waMessage = "Assalamu'alaikum *{$reg->full_name}*,\n\n";
                    $waMessage .= "❌ *PEMBAYARAN DITOLAK*\n";
                    $waMessage .= "Mohon maaf, bukti pembayaran DP Anda tidak dapat kami verifikasi.\n\n";
                    $waMessage .= "Alasan: _{$request->input('notes')}_\n\n";
                    $waMessage .= "Silakan upload ulang bukti pembayaran yang valid melalui Dashboard Jamaah.\n";
                    $waMessage .= "*Mahira Tour*";

                    \App\Jobs\SendWhatsAppNotification::dispatch($reg->phone, $waMessage);
                } catch (\Exception $e) {
                    Log::error('WA DPRejected failed: ' . $e->getMessage());
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

            // Send WhatsApp Notification (Tagihan Pelunasan)
            try {
                $waMessage = "Assalamu'alaikum *{$registration->full_name}*,\n\n";
                $waMessage .= "🔔 *REMINDER PELUNASAN*\n";
                $waMessage .= "Mengingatkan bahwa jadwal keberangkatan Anda semakin dekat.\n\n";
                $waMessage .= "Paket: {$registration->schedule->package_name}\n";
                $waMessage .= "Jatuh Tempo: *" . \Carbon\Carbon::parse($registration->pelunasan_deadline)->translatedFormat('d F Y') . "*\n";
                $waMessage .= "Sisa Tagihan: *Rp " . number_format($registration->sisaPelunasan(), 0, ',', '.') . "*\n\n";
                $waMessage .= "Mohon segera lakukan pelunasan agar persiapan dokumen dapat segera diproses.\n\n";
                $waMessage .= "🔗 *Link Upload Bukti Bayar:*\n";
                $waMessage .= route('registration.dashboard', ['reg' => $registration->registration_number, 'token' => $registration->access_token]) . "\n\n";
                $waMessage .= "*Mahira Tour*";

                \App\Jobs\SendWhatsAppNotification::dispatch($registration->phone, $waMessage);
            } catch (\Exception $e) {
                Log::error('WA Tagihan failed: ' . $e->getMessage());
            }
            
            $registration->update(['last_pelunasan_reminder_at' => now()]);
            
            return back()->with('success', '✅ Tagihan pelunasan berhasil dikirim ke ' . $registration->email . ' & WhatsApp');
            
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

                // Send WhatsApp Notification (Pelunasan APPROVED)
                try {
                    $reg = $payment->registration;
                    $waMessage = "Assalamu'alaikum *{$reg->full_name}*,\n\n";
                    $waMessage .= "🎉 *ALHAMDULILLAH LUNAS*\n";
                    $waMessage .= "Pembayaran pelunasan Umrah Anda telah kami terima.\n\n";
                    $waMessage .= "No. Reg: *{$reg->registration_number}*\n";
                    $waMessage .= "Paket: {$reg->schedule->package_name}\n\n";
                    $waMessage .= "Status: ✅ *LUNAS*\n\n";
                    $waMessage .= "Kami akan segera memproses dokumen visa & perlengkapan Anda.\n";
                    $waMessage .= "Mohon tunggu informasi selanjutnya mengenai manasik & keberangkatan.\n\n";
                    $waMessage .= "*Mahira Tour*";

                    \App\Jobs\SendWhatsAppNotification::dispatch($reg->phone, $waMessage);
                } catch (\Exception $e) {
                    Log::error('WA PelunasanVerified failed: ' . $e->getMessage());
                }
                
                DB::commit();
                return back()->with('success', '✅ Pelunasan verified! User dapat email & WA LUNAS');
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

                // Send WhatsApp Notification (Pelunasan REJECTED)
                try {
                    $reg = $payment->registration;
                    $waMessage = "Assalamu'alaikum *{$reg->full_name}*,\n\n";
                    $waMessage .= "❌ *PELUNASAN DITOLAK*\n";
                    $waMessage .= "Bukti pembayaran pelunasan Anda tidak dapat kami verifikasi.\n\n";
                    $waMessage .= "Alasan: _{$validated['rejection_reason']}_\n\n";
                    $waMessage .= "Silakan periksa kembali dan upload ulang bukti yang valid.\n";
                    $waMessage .= "*Mahira Tour*";

                    \App\Jobs\SendWhatsAppNotification::dispatch($reg->phone, $waMessage);
                } catch (\Exception $e) {
                    Log::error('WA PelunasanRejected failed: ' . $e->getMessage());
                }
                
                DB::commit();
                return back()->with('success', '⚠️ Pelunasan ditolak, notifikasi terkirim');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Verify Pelunasan Error: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Terjadi kesalahan saat memproses pelunasan.']);
        }
    }
}
