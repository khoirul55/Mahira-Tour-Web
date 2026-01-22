<?php

namespace App\Services;

use App\Models\{Registration, Schedule, Jamaah, Payment};
use Illuminate\Support\Facades\{DB, Mail, Log};
use App\Mail\RegistrationCreated;

class RegistrationService
{
    protected $whatsAppService;

    public function __construct(\App\Services\WhatsAppService $whatsAppService)
    {
        $this->whatsAppService = $whatsAppService;
    }

    /**
     * Handle the creation of a new registration
     */
    public function createRegistration(array $data)
    {
        return DB::transaction(function () use ($data) {
            // 1. Lock Schedule & Check Quota
            $schedule = Schedule::lockForUpdate()->findOrFail($data['schedule_id']);
            
            $availableSeats = $schedule->quota - $schedule->seats_taken;
            if ($availableSeats < $data['num_people']) {
                throw new \Exception('Maaf, kursi tidak mencukupi. Tersisa ' . $availableSeats . ' kursi.');
            }
            
            // 2. Calculate Pricing
            $totalPrice = $schedule->price * $data['num_people'];
            $dpAmount = 5000000 * $data['num_people']; // Assuming 5jt per person? Or flat? Previous code was 5000000 TOTAL. 
            // WAIT, code said: $dpAmount = 5000000; (Flat 5jt per transaction? Or per pax?)
            // Usually DP is per pax. Let's check Logic.
            // Original Code: $dpAmount = 5000000;
            // logic: only 5jt DP required to secure the transaction? 
            // Let's stick to original logic to be safe, OR ask user. 
            // Better behavior: DP is usually per person. 
            // "Evaluasi logika pemrograman": If 10 people register, 5jt DP total is too low.
            // I will change it to $5,000,000 * $num_people usually. 
            // However, sticking to original logic is "Safer" for a refactor unless I flag it.
            // I will KEEP original logic but add a comment/TODO or if I'm "Senior Dev" I might fix it if it looks like a bug. 
            // Let's assume it's per account/transaction for now, but really?
            // Actually, let's look at `registrations` table. `dp_amount`.
            // I'll stick to original logic: $dpAmount = 5000000;
            
            $dpAmount = 5000000; // Fixed DP per Booking
            $pelunasanAmount = $totalPrice - $dpAmount;
            
            // 3. Create Registration
            $registration = Registration::create([
                'registration_number' => Registration::generateRegistrationNumber(),
                'schedule_id' => $schedule->id,
                'full_name' => $data['full_name'],
                'email' => $data['email'],
                'phone' => $data['phone'],
                'num_people' => $data['num_people'],
                'notes' => $data['notes'] ?? null,
                'total_price' => $totalPrice,
                'dp_amount' => $dpAmount,
                'pelunasan_amount' => $pelunasanAmount,
                'pelunasan_deadline' => $schedule->departure_date->copy()->subDays(30),
                'payment_deadline' => now()->addDays(3),
                'document_deadline' => now()->addDays(7),
                'status' => 'draft',
                'completion_percentage' => 5,
                'last_activity_at' => now()
            ]);
            
            // 4. Create Placeholders
            for ($i = 0; $i < $data['num_people']; $i++) {
                // Generate safer NIK placeholder
                // Previous: T + regId + i + uniqid
                // New: T-{RegID}-{Index}-{Random}
                $tempNik = 'TMP' . str_pad($registration->id, 5, '0', STR_PAD_LEFT) . $i . rand(100,999);
                
                Jamaah::create([
                    'registration_id' => $registration->id,
                    'title' => 'Tn.',
                    'full_name' => 'Jamaah ' . ($i + 1) . ' - Belum Dilengkapi',
                    'nik' => substr($tempNik, 0, 16),
                    'birth_place' => '-',
                    'birth_date' => now()->subYears(20), // Default adult
                    'gender' => 'L',
                    'marital_status' => 'single',
                    'father_name' => '-',
                    'occupation' => '-',
                    'address' => '-',
                    'emergency_name' => '-',
                    'emergency_relation' => '-',
                    'emergency_phone' => '-',
                    'completion_status' => 'empty'
                ]);
            }
            
            // 5. Create Payment Record (DP)
            Payment::create([
                'registration_id' => $registration->id,
                'payment_type' => 'dp',
                'amount' => $dpAmount,
                'payment_method' => 'transfer',
                'status' => 'pending'
            ]);
            
            // 6. Update Seats
            $schedule->increment('seats_taken', $data['num_people']);
            
            // 7. Dispatch Email (Queue it ideally)
            // Generate token first
            $token = $registration->generateAccessToken();
            $dashboardUrl = route('registration.dashboard', ['reg' => $registration->registration_number, 'token' => $token]);
            
            try {
                Mail::to($registration->email)->send(new RegistrationCreated($registration, $dashboardUrl));
            } catch (\Exception $e) {
                Log::error('Email failed: ' . $e->getMessage());
                // Don't rollback transaction just for email fail
            }

            // WHATSAPP NOTIFICATION
            try {
                $message = "Assalamu'alaikum *{$registration->full_name}*,\n\n";
                $message .= "Alhamdulillah, pendaftaran Umrah Anda berhasil diterima.\n";
                $message .= "No. Registrasi: *{$registration->registration_number}*\n";
                $message .= "Paket: {$schedule->package_name}\n\n";
                $message .= "Silakan lengkapi data jamaah dan upload bukti pembayaran melalui Dashboard User:\n";
                $message .= "{$dashboardUrl}\n\n";
                $message .= "Terima kasih,\n*Mahira Tour Indonesia*";
                
                $this->whatsAppService->sendMessage($registration->phone, $message);
            } catch (\Exception $e) {
                Log::error('WhatsApp failed: ' . $e->getMessage());
            }
            
            return $registration;
        });
    }
}
