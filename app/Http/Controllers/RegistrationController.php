<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Registration;
use App\Models\Jamaah;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class RegistrationController extends Controller
{
    public function index(Request $request)
    {
        // Get active schedules for dropdown
        $schedules = Schedule::where('status', 'active')
            ->where('departure_date', '>=', now())
            ->get();
        
        $packages = $schedules->mapWithKeys(function($schedule) {
            return [$schedule->id => $schedule->package_name . ' - Rp ' . number_format($schedule->price, 0, ',', '.')];
        });
        
        $departure_routes = Schedule::distinct()->pluck('departure_route')->toArray();
        $provinces = $this->getProvinces();
        $titles = ['Tn.', 'Ny.', 'Sdr.', 'Sdri.', 'H.', 'Hj.'];
        
        // Get selected schedule if from schedule page
        $selectedSchedule = null;
        if ($request->has('schedule_id')) {
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
                    'duration' => $schedule->duration,
                    'flyer_image' => basename($schedule->flyer_image)
                ];
            }
        }
        
        // Get all schedules for JS
        $allSchedules = $schedules->mapWithKeys(function($schedule) {
            return [$schedule->id => [
                'id' => $schedule->id,
                'package_name' => $schedule->package_name,
                'departure_date' => $schedule->departure_date->format('Y-m-d'),
                'return_date' => $schedule->return_date->format('Y-m-d'),
                'departure_route' => $schedule->departure_route,
                'price' => $schedule->price,
                'airline' => $schedule->airline,
                'duration' => $schedule->duration,
                'flyer_image' => basename($schedule->flyer_image),
                'quota' => $schedule->quota,
                'seats_taken' => $schedule->seats_taken,
                'facilities' => $this->getFacilities($schedule->id)
            ]];
        });
        
        return view('pages.register', compact(
            'packages',
            'departure_routes',
            'provinces',
            'titles',
            'selectedSchedule',
            'allSchedules'
        ));
    }
    
    public function store(Request $request)
    {
        // Validate Step 1 & 2
        $validated = $request->validate([
            // PIC Data
            'pic_title' => 'required|string',
            'pic_full_name' => 'required|string|min:3|max:255',
            'pic_email' => 'required|email|max:255',
            'pic_phone' => 'required|string|min:10|max:20',
            'pic_address' => 'nullable|string|max:500',
            'pic_province' => 'nullable|string|max:100',
            'pic_city' => 'nullable|string|max:100',
            
            // Booking Info
            'schedule_id' => 'required|exists:schedules,id',
            'num_people' => 'required|integer|min:1|max:10',
            'notes' => 'nullable|string|max:1000',
            
            // Jamaah Data (Array)
            'jamaah' => 'required|array|min:1',
            'jamaah.*.title' => 'required|string',
            'jamaah.*.full_name' => 'required|string|max:255',
            'jamaah.*.nik' => 'required|string|size:16',
            'jamaah.*.birth_place' => 'required|string|max:100',
            'jamaah.*.birth_date' => 'required|date|before:today',
            'jamaah.*.gender' => 'required|in:L,P',
            'jamaah.*.marital_status' => 'required|in:single,married,divorced,widowed',
            'jamaah.*.father_name' => 'required|string|max:255',
            'jamaah.*.occupation' => 'required|string|max:100',
            'jamaah.*.blood_type' => 'nullable|in:A,B,AB,O',
            'jamaah.*.address' => 'required|string',
            'jamaah.*.province' => 'nullable|string|max:100',
            'jamaah.*.city' => 'nullable|string|max:100',
            'jamaah.*.emergency_name' => 'required|string|max:255',
            'jamaah.*.emergency_relation' => 'required|string|max:50',
            'jamaah.*.emergency_phone' => 'required|string|max:20',
        ]);
        
        DB::beginTransaction();
        
        try {
            // Get schedule
            $schedule = Schedule::findOrFail($validated['schedule_id']);
            
            // Check availability
            if ($schedule->available_seats < $validated['num_people']) {
                return back()->withErrors(['error' => 'Kursi tidak mencukupi. Tersisa ' . $schedule->available_seats . ' kursi.'])->withInput();
            }
            
            // Calculate prices
            $totalPrice = $schedule->price * $validated['num_people'];
            $dpAmount = $totalPrice * 0.30;
            
            // Create Registration
            $registration = Registration::create([
                'registration_number' => Registration::generateRegistrationNumber(),
                'schedule_id' => $schedule->id,
                'pic_title' => $validated['pic_title'],
                'pic_full_name' => $validated['pic_full_name'],
                'pic_email' => $validated['pic_email'],
                'pic_phone' => $validated['pic_phone'],
                'pic_address' => $validated['pic_address'],
                'pic_province' => $validated['pic_province'],
                'pic_city' => $validated['pic_city'],
                'num_people' => $validated['num_people'],
                'departure_date' => $schedule->departure_date,
                'departure_route' => $schedule->departure_route,
                'notes' => $validated['notes'],
                'total_price' => $totalPrice,
                'dp_amount' => $dpAmount,
                'status' => 'pending'
            ]);
            
            // Create Jamaah records
            foreach ($validated['jamaah'] as $jamaahData) {
                Jamaah::create(array_merge(
                    ['registration_id' => $registration->id],
                    $jamaahData
                ));
            }
            
            // Update schedule seats
            $schedule->increment('seats_taken', $validated['num_people']);
            $schedule->updateStatus();
            
            DB::commit();
            
            // Store registration ID in session for document upload
            session(['pending_registration_id' => $registration->id]);
            
            // Redirect to document upload
            return redirect()->route('register.documents', $registration->id)
                ->with('success', 'Pendaftaran berhasil! Nomor registrasi: ' . $registration->registration_number);
            
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Terjadi kesalahan: ' . $e->getMessage()])->withInput();
        }
    }
    
    public function documents($registrationId)
    {
        $registration = Registration::with('jamaah')->findOrFail($registrationId);
        
        // Check if user owns this registration (simple check via session)
        if (session('pending_registration_id') != $registrationId) {
            abort(403, 'Unauthorized access');
        }
        
        return view('pages.register-documents', compact('registration'));
    }
    
    public function uploadDocuments(Request $request, $registrationId)
    {
        $registration = Registration::findOrFail($registrationId);
        
        $validated = $request->validate([
            'jamaah_id' => 'required|exists:jamaah,id',
            'document_type' => 'required|in:ktp,kk,photo,buku_nikah,akta_lahir',
            'document' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);
        
        try {
            $file = $request->file('document');
            $jamaahId = $validated['jamaah_id'];
            $docType = $validated['document_type'];
            
            // Generate unique filename
            $filename = $jamaahId . '_' . $docType . '_' . time() . '.' . $file->extension();
            
            // Store file
            $path = $file->storeAs('documents/' . $docType, $filename, 'public');
            
            // Save to database
            Document::create([
                'jamaah_id' => $jamaahId,
                'document_type' => $docType,
                'file_path' => $path,
                'file_name' => $file->getClientOriginalName()
            ]);
            
            return response()->json(['success' => true, 'message' => 'Dokumen berhasil diupload']);
            
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
    
    public function payment($registrationId)
    {
        $registration = Registration::with('schedule')->findOrFail($registrationId);
        
        if (session('pending_registration_id') != $registrationId) {
            abort(403);
        }
        
        return view('pages.register-payment', compact('registration'));
    }
    
    public function submitPayment(Request $request, $registrationId)
    {
        $registration = Registration::findOrFail($registrationId);
        
        $validated = $request->validate([
            'payment_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'payment_method' => 'required|in:transfer,cash'
        ]);
        
        try {
            $file = $request->file('payment_proof');
            $filename = 'dp_' . $registration->registration_number . '_' . time() . '.' . $file->extension();
            $path = $file->storeAs('payments', $filename, 'public');
            
            $registration->update([
                'dp_status' => 'paid',
                'dp_paid_at' => now()
            ]);
            
            // Clear session
            session()->forget('pending_registration_id');
            
            return redirect()->route('register.success', $registration->id)
                ->with('success', 'Bukti pembayaran berhasil diupload. Tim kami akan segera memverifikasi.');
            
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    
    public function success($registrationId)
    {
        $registration = Registration::with('schedule', 'jamaah')->findOrFail($registrationId);
        return view('pages.register-success', compact('registration'));
    }
    
    // Helper methods
    private function getProvinces()
    {
        return [
            'Lampung', 'Sumatera Barat', 'Jambi', 'DKI Jakarta', 'Bengkulu',
            'Sumatera Utara', 'Sumatera Selatan', 'Riau', 'Kepulauan Riau',
            'Jawa Barat', 'Jawa Tengah', 'Jawa Timur', 'Banten', 'Yogyakarta'
        ];
    }
    
    private function getFacilities($scheduleId)
    {
        // Default facilities (could be from database in future)
        return [
            'Hotel Bintang 5',
            'Makan 3x Sehari',
            'Tour Ziarah Lengkap',
            'Perlengkapan Umrah',
            'Manasik Persiapan',
            'Bus AC Exclusive'
        ];
    }
}