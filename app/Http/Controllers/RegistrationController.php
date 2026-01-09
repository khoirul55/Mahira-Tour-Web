<?php

namespace App\Http\Controllers;

use App\Models\{Schedule, Registration, Jamaah, Payment, Document};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB, Storage};
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class RegistrationController extends Controller
{
    /**
     * STEP 1: Form Quick Booking (3 fields only)
     */
    public function index(Request $request)
    {
        $schedules = Schedule::where('status', 'active')
            ->where('departure_date', '>=', now())
            ->get();
        
        $selectedSchedule = null;
        if ($request->schedule_id) {
            $schedule = Schedule::find($request->schedule_id);
            if ($schedule) {
                $selectedSchedule = [
                    'id' => $schedule->id,
                    'package_name' => $schedule->package_name,
                    'departure_date' => $schedule->departure_date->format('Y-m-d'),
                    'return_date' => $schedule->return_date->format('Y-m-d'),
                    'departure_route' => $schedule->departure_route,
                    'price' => $schedule->price,
                    'airline' => $schedule->airline,
                    'flyer_image' => basename($schedule->flyer_image)
                ];
            }
        }
        
        return view('pages.register-quick', compact('schedules', 'selectedSchedule'));
    }
    
    /**
     * STEP 2: Process Quick Booking
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'schedule_id' => 'required|exists:schedules,id',
            'full_name' => 'required|string|min:3|max:255',
            'phone' => 'required|string|regex:/^08[0-9]{9,11}$/',
            'email' => 'required|email|max:255',
            'num_people' => 'required|integer|between:1,10',
            'notes' => 'nullable|string|max:1000',
        ]);
        
        DB::beginTransaction();
        
            try {
                // TAMBAHKAN LOCKING DI SINI
                $schedule = Schedule::lockForUpdate()->findOrFail($validated['schedule_id']);
                
                // Hitung ulang available seats dengan locking
                $availableSeats = $schedule->quota - $schedule->seats_taken;
                
                if ($availableSeats < $validated['num_people']) {
                    throw new \Exception('Maaf, kursi tidak mencukupi. Tersisa ' . $availableSeats . ' kursi.');
                }
            
            $totalPrice = $schedule->price * $validated['num_people'];
            $dpAmount = $totalPrice * 0.30;
            
            // Create registration
            $registration = Registration::create([
                'registration_number' => Registration::generateRegistrationNumber(),
                'schedule_id' => $schedule->id,
                'full_name' => $validated['full_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'num_people' => $validated['num_people'],
                'notes' => $validated['notes'],
                'total_price' => $totalPrice,
                'dp_amount' => $dpAmount,
                'status' => 'draft',
                'completion_percentage' => 5, // 5% (booking created)
                'payment_deadline' => now()->addDays(3),
                'document_deadline' => now()->addDays(7),
                'last_activity_at' => now()
            ]);
            
            // ✅ Create placeholder jamaah records
            for ($i = 0; $i < $validated['num_people']; $i++) {
                Jamaah::create([
                    'registration_id' => $registration->id,
                    'title' => 'Tn.',
                    'full_name' => 'Jamaah ' . ($i + 1) . ' - Belum Dilengkapi',
                    'nik' => 'PENDING',
                    'birth_place' => '-',
                    'birth_date' => now()->subYears(30), // Default 30 tahun
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
            
            // Create pending DP payment record
            Payment::create([
                'registration_id' => $registration->id,
                'payment_type' => 'dp',
                'amount' => $dpAmount,
                'payment_method' => 'transfer',
                'status' => 'pending'
            ]);
            
            // Reserve seats
            $schedule->increment('seats_taken', $validated['num_people']);
            
            DB::commit();
            
            // TODO: Send WhatsApp notification with dashboard link
            // $dashboardUrl = $registration->dashboard_url;
            // SendWhatsAppNotification::dispatch($registration, $dashboardUrl);
            
            return redirect()
                ->route('registration.dashboard', [
                    'reg' => $registration->registration_number,
                    'token' => $registration->generateAccessToken()
                ])
            ->with('success', 'Booking berhasil! Nomor registrasi Anda: ' . $registration->registration_number);
            
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }
    
    /**
     * DASHBOARD: Central hub untuk manage pendaftaran
     */
    public function dashboard($registrationNumber, Request $request)
{
    // Find registration
    $registration = Registration::with(['schedule', 'jamaah.documents', 'payments'])
        ->where('registration_number', $registrationNumber)
        ->firstOrFail();
    
    // Validate access token
    $token = $request->query('token');
    
    // Jika tidak ada token di URL, cek cookie
    if (!$token) {
        $token = $request->cookie('mahira_dashboard_token');
    }
    
    if (!$token || !$registration->validateAccessToken($token)) {
        abort(403, 'Akses tidak valid. Silakan login melalui halaman Cek Pendaftaran.');
    }
    
    // Set cookie untuk next visit (30 hari)
    cookie()->queue('mahira_dashboard_token', $token, 60 * 24 * 30);
    
    // Update last activity
    $registration->update(['last_activity_at' => now()]);
    
    // Calculate completion
    $completion = $registration->calculateCompletion();
    $registration->update(['completion_percentage' => $completion]);
    
    // Get DP payment
    $dpPayment = $registration->dpPayment();
    
    return view('pages.dashboard', compact('registration', 'completion', 'dpPayment'));
}
    
    // ========================================
    // OLD METHODS (KEPT FOR COMPATIBILITY)
    // ========================================
    
    /**
     * Payment page
     */
    public function payment($registrationId)
    {
        $registration = Registration::with('schedule', 'payments')->findOrFail($registrationId);
        $dpPayment = $registration->payments()->where('payment_type', 'dp')->first();
        
        return view('pages.register-payment', compact('registration', 'dpPayment'));
    }
    
    /**
     * Submit payment proof
     */
    public function submitPayment(Request $request, $registrationId)
    {
        $validated = $request->validate([
            'payment_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'payment_method' => 'required|in:transfer,cash'
        ]);
        
        DB::beginTransaction();
        
        try {
            $registration = Registration::findOrFail($registrationId);
            $dpPayment = $registration->payments()->where('payment_type', 'dp')->firstOrFail();
            
                    // Upload file
            $file = $request->file('payment_proof');
            $filename = 'dp_' . 
                $registration->registration_number . '_' . 
                uniqid() . '_' . 
                time() . '.' . 
                $file->extension();
            $path = $file->storeAs('payments', $filename, 'public');
            
            // Update payment record
            $dpPayment->update([
                'proof_path' => $path,
                'payment_method' => $validated['payment_method'],
                'status' => 'pending' // Admin will verify
            ]);
            
            // Update registration
            $registration->update([
                'status' => 'pending',
                'last_activity_at' => now()
            ]);
            $registration->updateCompletion();
            
        DB::commit();

        // =============================
        // SETELAH DB::commit()
        // =============================

        // Generate token akses dashboard
        $token = $registration->generateAccessToken();

        // URL dashboard
        $dashboardUrl = route('registration.dashboard', [
            'reg'   => $registration->registration_number,
            'token' => $token
        ]);

        // Kirim email
        try {
            Mail::to($registration->email)
                ->send(new \App\Mail\RegistrationCreated($registration, $dashboardUrl));
        } catch (\Exception $e) {
            Log::error('Email failed', [
                'registration_id' => $registration->id,
                'error' => $e->getMessage()
            ]);
            // Tidak menggagalkan proses
        }

        return redirect()->route('registration.dashboard', [
            'reg'   => $registration->registration_number,
            'token' => $token
        ])->with(
            'success',
            'Booking berhasil! Link dashboard telah dikirim ke email Anda: ' . $registration->email
        );

    } catch (\Exception $e) {
        DB::rollBack();

        Log::error('Registration failed', [
            'error' => $e->getMessage()
        ]);

        return back()->withErrors('Terjadi kesalahan, silakan coba lagi.');
    }
}
    
    /**
     * Documents upload page
     */
    public function documents($registrationId)
    {
        $registration = Registration::with('jamaah.documents')->findOrFail($registrationId);
        
        // Only allow if DP is verified
        if (!$registration->hasDPVerified()) {
            return redirect()
                ->route('registration.dashboard', ['reg' => $registration->registration_number, 'token' => $registration->generateAccessToken()])
                ->with('error', 'Upload dokumen bisa dilakukan setelah DP diverifikasi admin.');
        }
        
        return view('pages.register-documents', compact('registration'));
    }
    
    /**
     * Upload documents
     */
    public function uploadDocuments(Request $request, $registrationId)
    {
        $validated = $request->validate([
            'jamaah_id' => 'required|exists:jamaah,id',
            'document_type' => 'required|in:ktp,kk,photo,buku_nikah',
            'document' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);
        
        DB::beginTransaction();
        
        try {
            $jamaah = Jamaah::where('id', $validated['jamaah_id'])
                ->where('registration_id', $registrationId)
                ->firstOrFail();
            
            // Upload file
            $file = $request->file('document');
            $filename = $validated['jamaah_id'] . '_' . 
                $validated['document_type'] . '_' . 
                uniqid() . '_' . 
                time() . '.' . 
                $file->extension();
            $path = $file->storeAs('documents/' . $validated['document_type'], $filename, 'public');
            
            // Create or update document
            Document::updateOrCreate(
                [
                    'jamaah_id' => $validated['jamaah_id'], 
                    'document_type' => $validated['document_type']
                ],
                [
                    'file_path' => $path, 
                    'file_name' => $file->getClientOriginalName()
                ]
            );
            
            // Update jamaah completion
            $jamaah->updateCompletionStatus();
            
            DB::commit();
            
            return back()->with('success', 'Dokumen berhasil diupload');
            
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    
    /**
     * Success page (deprecated - use dashboard instead)
     */
    public function success($registrationId)
    {
        $registration = Registration::with('schedule', 'payments')->findOrFail($registrationId);
        
        // Redirect to dashboard
        return redirect()
            ->route('registration.dashboard', [
                'reg' => $registration->registration_number,
                'token' => $registration->generateAccessToken()
            ]);
    }

    /**
 * API: Get Jamaah Data
 */
public function getJamaahData($id)
{
    $jamaah = Jamaah::findOrFail($id);
    
    return response()->json([
        'id' => $jamaah->id,
        'title' => $jamaah->title,
        'full_name' => $jamaah->full_name,
        'nik' => $jamaah->nik,
        'birth_place' => $jamaah->birth_place,
        'birth_date' => $jamaah->birth_date ? $jamaah->birth_date->format('Y-m-d') : null,
        'gender' => $jamaah->gender,
        'marital_status' => $jamaah->marital_status,
        'father_name' => $jamaah->father_name,
        'occupation' => $jamaah->occupation,
        'blood_type' => $jamaah->blood_type,
        'address' => $jamaah->address,
        'province' => $jamaah->province,
        'city' => $jamaah->city,
        'emergency_name' => $jamaah->emergency_name,
        'emergency_relation' => $jamaah->emergency_relation,
        'emergency_phone' => $jamaah->emergency_phone
    ]);
}

/**
 * API: Update Jamaah Data
 */
/**
 * API: Update Jamaah Data
 */
public function updateJamaahData(Request $request, $id)
{
    $validated = $request->validate([
        'title' => 'required|string',
        'full_name' => 'required|string|min:3',
        'nik' => 'required|string|size:16',
        'birth_place' => 'required|string',
        'birth_date' => 'required|date',
        'gender' => 'required|in:L,P',
        'marital_status' => 'required|in:single,married,divorced,widowed',
        'father_name' => 'required|string',
        'occupation' => 'required|string',
        'blood_type' => 'nullable|in:A,B,AB,O',
        'address' => 'required|string',
        'province' => 'nullable|string',
        'city' => 'nullable|string',
        'emergency_name' => 'required|string',
        'emergency_relation' => 'required|string',
        'emergency_phone' => 'required|string'
    ]);
    
    try {
        $jamaah = Jamaah::findOrFail($id);
        $jamaah->update($validated);
        $jamaah->updateCompletionStatus();
        
        return response()->json([
            'success' => true,
            'message' => 'Data jamaah berhasil disimpan'
        ]);
    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => $e->getMessage()
        ], 500);
    }
}
}