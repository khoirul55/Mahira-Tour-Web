<?php

namespace App\Http\Controllers;

use App\Models\{Schedule, Registration, Jamaah, Payment, Document};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB, Storage};


class RegistrationController extends Controller
{
    public function index(Request $request)
    {
        $schedules = Schedule::where('status', 'active')
            ->where('departure_date', '>=', now())
            ->get();
        
        $packages = $schedules->mapWithKeys(fn($s) => [
            $s->id => $s->package_name . ' - Rp ' . number_format($s->price, 0, ',', '.')
        ]);
        
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
        
        $allSchedules = $schedules->mapWithKeys(fn($s) => [
            $s->id => [
                'id' => $s->id,
                'package_name' => $s->package_name,
                'departure_date' => $s->departure_date->format('Y-m-d'),
                'return_date' => $s->return_date->format('Y-m-d'),
                'departure_route' => $s->departure_route,
                'price' => $s->price,
                'airline' => $s->airline,
                'flyer_image' => basename($s->flyer_image),
                'quota' => $s->quota,
                'seats_taken' => $s->seats_taken
            ]
        ]);
        
        return view('pages.register', compact('packages', 'selectedSchedule', 'allSchedules'));
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'schedule_id' => 'required|exists:schedules,id',
            'num_people' => 'required|integer|between:1,10',
            'full_name' => 'required|string|min:3|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|regex:/^08[0-9]{9,11}$/',
            'notes' => 'nullable|string|max:1000',
        ]);
        
        DB::beginTransaction();
        
        try {
            $schedule = Schedule::findOrFail($validated['schedule_id']);
            
            if ($schedule->available_seats < $validated['num_people']) {
                throw new \Exception('Kursi tidak mencukupi.');
            }
            
            $totalPrice = $schedule->price * $validated['num_people'];
            $dpAmount = $totalPrice * 0.30;
            
            $registration = Registration::create([
                'registration_number' => Registration::generateRegistrationNumber(),
                'schedule_id' => $schedule->id,
                'full_name' => $validated['full_name'],
                'email' => $validated['email'],
                'phone' => $validated['phone'],
                'num_people' => $validated['num_people'],
                'notes' => $validated['notes'],
                'total_price' => $totalPrice,
                'status' => 'pending'
            ]);
            
            // Create DP payment record (pending)
            Payment::create([
                'registration_id' => $registration->id,
                'payment_type' => 'dp',
                'amount' => $dpAmount,
                'payment_method' => 'transfer',
                'status' => 'pending'
            ]);
            
            $schedule->increment('seats_taken', $validated['num_people']);
            
            DB::commit();
            
            session(['pending_registration_id' => $registration->id]);
            
            return redirect()->route('register.payment', $registration->id)
                ->with('success', 'Nomor registrasi: ' . $registration->registration_number);
            
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }
    
    public function payment($registrationId)
    {
        $registration = Registration::with('schedule', 'payments')->findOrFail($registrationId);
        
        if (session('pending_registration_id') != $registrationId) {
            abort(403, 'Akses ditolak.');
        }
        
        $dpPayment = $registration->payments()->where('payment_type', 'dp')->first();
        
        return view('pages.register-payment', compact('registration', 'dpPayment'));
    }
    
    public function submitPayment(Request $request, $registrationId)
    {
        if (session('pending_registration_id') != $registrationId) {
            abort(403);
        }
        
        $validated = $request->validate([
            'payment_proof' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048',
            'payment_method' => 'required|in:transfer,cash'
        ]);
        
        DB::beginTransaction();
        
        try {
            $registration = Registration::findOrFail($registrationId);
            $dpPayment = $registration->payments()->where('payment_type', 'dp')->firstOrFail();
            
            $file = $request->file('payment_proof');
            $filename = 'dp_' . $registration->registration_number . '_' . time() . '.' . $file->extension();
            $path = $file->storeAs('payments', $filename, 'public');
            
            $dpPayment->update([
                'proof_path' => $path,
                'payment_method' => $validated['payment_method'],
                'status' => 'pending' // Admin will verify
            ]);
            
            DB::commit();
            
            session()->forget('pending_registration_id');
            
            return redirect()->route('register.success', $registration->id)
                ->with('success', 'Bukti DP berhasil diupload. Menunggu verifikasi admin.');
            
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    
    public function documents($registrationId)
    {
        $registration = Registration::with('jamaah.documents')->findOrFail($registrationId);
        
        // Only allow if DP is verified
        if (!$registration->hasDPVerified()) {
            return redirect()->route('register.success', $registration->id)
                ->with('error', 'Upload dokumen bisa dilakukan setelah DP diverifikasi admin.');
        }
        
        return view('pages.register-documents', compact('registration'));
    }
    
    public function uploadDocuments(Request $request, $registrationId)
    {
        $validated = $request->validate([
            'jamaah_id' => 'required|exists:jamaah,id',
            'document_type' => 'required|in:ktp,kk,photo,buku_nikah',
            'document' => 'required|file|mimes:jpg,jpeg,png,pdf|max:2048'
        ]);
        
        try {
            $jamaah = Jamaah::where('id', $validated['jamaah_id'])
                ->where('registration_id', $registrationId)
                ->firstOrFail();
            
            $file = $request->file('document');
            $filename = $validated['jamaah_id'] . '_' . $validated['document_type'] . '_' . time() . '.' . $file->extension();
            $path = $file->storeAs('documents/' . $validated['document_type'], $filename, 'public');
            
            Document::updateOrCreate(
                ['jamaah_id' => $validated['jamaah_id'], 'document_type' => $validated['document_type']],
                ['file_path' => $path, 'file_name' => $file->getClientOriginalName()]
            );
            
            return back()->with('success', 'Dokumen berhasil diupload');
            
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    
    public function success($registrationId)
    {
        $registration = Registration::with('schedule', 'payments')->findOrFail($registrationId);
        return view('pages.register-success', compact('registration'));
    }
}