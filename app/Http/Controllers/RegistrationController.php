<?php

namespace App\Http\Controllers;

use App\Models\{Schedule, Registration, Jamaah, Payment, Document};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB, Storage};
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class RegistrationController extends Controller
{
    protected $registrationService;

    public function __construct(\App\Services\RegistrationService $registrationService)
    {
        $this->registrationService = $registrationService;
    }

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
    public function store(\App\Http\Requests\StoreRegistrationRequest $request)
    {
        try {
            $registration = $this->registrationService->createRegistration($request->validated());
            
            return redirect()
                ->route('registration.dashboard', [
                    'reg' => $registration->registration_number,
                    'token' => $registration->access_token // generated in service
                ])
                ->with('success', 'Booking berhasil! Link dashboard telah dikirim ke: ' . $registration->email);
                
        } catch (\Exception $e) {
            Log::error('Registration Error: ' . $e->getMessage());
            return back()
                ->withErrors(['error' => $e->getMessage()])
                ->withInput();
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
            $path = $file->storeAs('payments', $filename, 'secure');
            
            // Update payment record
            $dpPayment->update([
                'proof_path' => $path,
                'payment_method' => $validated['payment_method'],
                'status' => 'pending'
            ]);
            
            // Update registration
            $registration->update([
                'status' => 'pending',
                'last_activity_at' => now()
            ]);
            $registration->updateCompletion();
            
            DB::commit();

            // NOTIFIKASI ADMIN (New)
            try {
                $adminEmail = config('mail.from.address');
                \Illuminate\Support\Facades\Mail::to($adminEmail)->queue(new \App\Mail\PaymentProofUploaded($dpPayment, $registration));
            } catch (\Exception $e) {
                // Silent error agar user tidak terganggu jika email gagal
                Log::error('Admin Notif Error: ' . $e->getMessage());
            }

            return back()->with('success', 'Bukti pembayaran berhasil diunggah. Menunggu verifikasi dari admin.');
        
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Payment Upload Error: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Gagal mengunggah bukti pembayaran via sistem. Silakan coba lagi.']);
        }
    }

/**
 * Submit Bukti Pelunasan
 */
public function submitPelunasan(Request $request, $registrationId)
{
    $validated = $request->validate([
        'payment_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
        'payment_method' => 'required|in:transfer,cash'
    ]);
    
    DB::beginTransaction();
    
    try {
        $registration = Registration::findOrFail($registrationId);
        
        // Cek apakah perlu pelunasan
        if (!$registration->needsPelunasan()) {
            throw new \Exception('Pendaftaran ini tidak perlu pelunasan');
        }
        
        // Upload file
        $file = $request->file('payment_proof');
        $filename = 'pelunasan_' . 
            $registration->registration_number . '_' . 
            uniqid() . '_' . 
            time() . '.' . 
            $file->extension();
        $path = $file->storeAs('payments', $filename, 'secure');
        
        // Cek apakah sudah ada payment pelunasan
        $pelunasan = $registration->pelunasanPayment();
        
        if ($pelunasan) {
            // Update existing
            $pelunasan->update([
                'proof_path' => $path,
                'payment_method' => $validated['payment_method'],
                'status' => 'pending'
            ]);
        } else {
            // Create new
            $pelunasan = Payment::create([
                'registration_id' => $registration->id,
                'payment_type' => 'pelunasan',
                'amount' => $registration->sisaPelunasan(),
                'payment_method' => $validated['payment_method'],
                'proof_path' => $path,
                'status' => 'pending'
            ]);
        }
        
        DB::commit();

        // NOTIFIKASI ADMIN (New)
        try {
            $adminEmail = config('mail.from.address');
            \Illuminate\Support\Facades\Mail::to($adminEmail)->queue(new \App\Mail\PaymentProofUploaded($pelunasan, $registration));
        } catch (\Exception $e) {
            Log::error('Admin Notif Error: ' . $e->getMessage());
        }
        
        return back()->with('success', 'Bukti pelunasan berhasil diupload. Menunggu verifikasi admin.');
        
    } catch (\Exception $e) {
        DB::rollBack();
        Log::error('Pelunasan Upload Error: ' . $e->getMessage());
        return back()->withErrors(['error' => 'Gagal mengunggah bukti pelunasan. Silakan hubungi admin jika masalah berlanjut.']);
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
            $path = $file->storeAs('documents/' . $validated['document_type'], $filename, 'secure');
            
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
            Log::error('Document Upload Error: ' . $e->getMessage());
            return back()->withErrors(['error' => 'Gagal mengunggah dokumen. Pastikan format dan ukuran file sesuai.']);
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
    public function getJamaahData(Request $request, $id)
    {
        $jamaah = Jamaah::with('registration')->findOrFail($id);
        $token = $request->query('token') ?: $request->cookie('mahira_dashboard_token');

        if (!$token || !$jamaah->registration->validateAccessToken($token)) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }
        
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
            'emergency_phone' => $jamaah->emergency_phone,
            'documents' => $jamaah->documents->mapWithKeys(function ($doc) use ($token) {
                return [$doc->document_type => [
                    'exists' => true,
                    'file_name' => $doc->file_name,
                    'url' => route('admin.secure.file', ['path' => $doc->file_path, 'token' => $token])
                ]];
            })
        ]);
    }

    /**
     * API: Update Jamaah Data
     */
    /**
     * API: Update Jamaah Data
     */
    public function updateJamaahData(\App\Http\Requests\UpdateJamaahRequest $request, $id)
    {
        $jamaah = Jamaah::with('registration')->findOrFail($id);
        $token = $request->query('token') ?: $request->cookie('mahira_dashboard_token');

        if (!$token || !$jamaah->registration->validateAccessToken($token)) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        try {
            $jamaah->update($request->validated());
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

    /**
     * API: Passport Request
     */
    public function passportRequest(Request $request, $id)
    {
        $jamaah = Jamaah::with('registration')->findOrFail($id);
        $token = $request->query('token') ?: $request->cookie('mahira_dashboard_token');

        if (!$token || !$jamaah->registration->validateAccessToken($token)) {
            return response()->json(['success' => false, 'message' => 'Unauthorized'], 403);
        }

        $jamaah->update([
            'need_passport' => $request->need_passport ?? true,
            'passport_request_at' => now()
        ]);
        
        return response()->json([
            'success' => true,
            'message' => 'Request passport berhasil disimpan'
        ]);
    }
}