<?php

namespace App\Http\Controllers;

use App\Models\{Registration, Payment, Document, Jamaah, Schedule};
use App\Exports\{RegistrationsExport, SingleRegistrationExport};
use App\Mail\{DPVerified, DPRejected};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB, Storage, Mail, Log};
use Maatwebsite\Excel\Facades\Excel;
use ZipArchive;


class AdminController extends Controller
{
    /**
     * Admin Dashboard
     */
    public function dashboard()
    {
        $stats = [
            'pending' => Payment::where('status', 'pending')
                ->whereNotNull('proof_path')
                ->count(),
            'pending_docs' => Document::where('is_verified', false)->count(),
            'confirmed' => Registration::where('status', 'confirmed')->count(),
            'total_revenue' => Payment::where('status', 'verified')->sum('amount')
        ];
        
        $pendingPayments = Payment::with('registration')
            ->where('status', 'pending')
            ->whereNotNull('proof_path')
            ->latest()
            ->get();
        
        $registrationsWithDocs = Registration::with(['jamaah.documents', 'payments'])
            ->whereHas('jamaah.documents')
            ->latest()
            ->get();
        
        $passportRequests = Jamaah::with('registration')
            ->where('need_passport', true)
            ->where('passport_processed', false)
            ->get();
        
        return view('admin.dashboard', compact(
            'stats', 
            'pendingPayments', 
            'registrationsWithDocs',
            'passportRequests'
        ));
    }
    
    /**
     * Verify Payment - FIXED
     */
    public function verifyPayment(Request $request, $id)
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
            return back()->with('error', 'Gagal memproses: ' . $e->getMessage());
        }
    }
    
    /**
     * List All Registrations
     */
    public function registrations(Request $request)
    {
        $query = Registration::with(['schedule', 'jamaah', 'payments']);
        
        // Filter by status
        if ($request->status) {
            $query->where('status', $request->status);
        }
        
        // Filter by schedule
        if ($request->schedule_id) {
            $query->where('schedule_id', $request->schedule_id);
        }
        
        // Search
        if ($request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('registration_number', 'like', "%{$search}%")
                  ->orWhere('full_name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%")
                  ->orWhere('phone', 'like', "%{$search}%");
            });
        }
        
        // Sort
        switch ($request->sort) {
            case 'oldest':
                $query->oldest();
                break;
            case 'name':
                $query->orderBy('full_name');
                break;
            default:
                $query->latest();
        }
        
        $registrations = $query->paginate(20);
        
        // Stats
        $stats = [
            'total' => Registration::count(),
            'draft' => Registration::where('status', 'draft')->count(),
            'pending' => Registration::where('status', 'pending')->count(),
            'confirmed' => Registration::where('status', 'confirmed')->count(),
        ];
        
        // Get schedules for filter
        $schedules = Schedule::orderBy('departure_date', 'desc')->get();
        
        return view('admin.registrations.index', compact('registrations', 'stats', 'schedules'));
    }
    
    /**
     * Show Registration Detail
     */
    public function showRegistration($id)
    {
        $registration = Registration::with([
            'schedule', 
            'jamaah.documents', 
            'payments'
        ])->findOrFail($id);
        
        return view('admin.registrations.show', compact('registration'));
    }
    
    /**
     * Export All Registrations to Excel
     */
    public function exportRegistrations(Request $request)
    {
        $filters = $request->only(['status', 'schedule_id', 'search']);
        $filename = 'registrations_' . date('Y-m-d_His') . '.xlsx';
        
        return Excel::download(new RegistrationsExport($filters), $filename);
    }
    
    /**
     * Export Single Registration to Excel
     */
    public function exportSingleRegistration($id)
    {
        $registration = Registration::with(['schedule', 'jamaah.documents', 'payments'])->findOrFail($id);
        $filename = 'jamaah_' . $registration->registration_number . '_' . date('Ymd') . '.xlsx';
        
        return Excel::download(new SingleRegistrationExport($registration), $filename);
    }
    
    /**
     * Verify Document
     */
    public function verifyDocument(Request $request, $id)
    {
        $document = Document::findOrFail($id);
        
        $document->update([
            'is_verified' => true,
            'verified_at' => now(),
            'verification_notes' => $request->notes
        ]);
        
        $document->jamaah->updateCompletionStatus();
        
        return back()->with('success', 'Dokumen berhasil diverifikasi!');
    }
    
    /**
     * Download All Documents (ZIP)
     */
    public function downloadAllDocuments($registrationId)
    {
        $registration = Registration::with('jamaah.documents')->findOrFail($registrationId);
        
        $zipFileName = 'dokumen_' . $registration->registration_number . '_' . date('Ymd') . '.zip';
        $zipPath = storage_path('app/temp/' . $zipFileName);
        
        if (!file_exists(storage_path('app/temp'))) {
            mkdir(storage_path('app/temp'), 0755, true);
        }
        
        $zip = new ZipArchive();
        
        if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            return back()->with('error', 'Gagal membuat file ZIP');
        }
        
        foreach ($registration->jamaah as $jamaah) {
            $folderName = str_replace(' ', '_', $jamaah->full_name);
            
            foreach ($jamaah->documents as $doc) {
                $filePath = Storage::disk('public')->path($doc->file_path);
                
                if (file_exists($filePath)) {
                    $extension = pathinfo($doc->file_path, PATHINFO_EXTENSION);
                    $fileName = $folderName . '/' . strtoupper($doc->document_type) . '.' . $extension;
                    $zip->addFile($filePath, $fileName);
                }
            }
        }
        
        $zip->close();
        
        return response()->download($zipPath, $zipFileName)->deleteFileAfterSend(true);
    }
    
    /**
     * Process Passport Request
     */
    public function processPassport(Request $request, $jamaahId)
    {
        $jamaah = Jamaah::findOrFail($jamaahId);
        
        $jamaah->update([
            'passport_processed' => true,
            'passport_processed_at' => now(),
            'passport_notes' => $request->notes
        ]);
        
        return back()->with('success', 'Request passport untuk ' . $jamaah->full_name . ' sedang diproses!');
    }
    //baru
// Tambahkan di AdminController

/**
 * Tab Perlu Pelunasan
 */
public function pelunasan()
{
    $registrations = Registration::with(['schedule', 'jamaah', 'payments'])
        ->where('status', 'confirmed')
        ->where('is_lunas', false)
        ->whereHas('payments', function($q) {
            $q->where('payment_type', 'dp')
              ->where('status', 'verified');
        })
        ->latest()
        ->get();
    
    return view('admin.pelunasan.index', compact('registrations'));
}

/**
 * Kirim Tagihan Pelunasan (Manual)
 */
public function sendTagihan($registrationId)
{
    $registration = Registration::with('schedule')->findOrFail($registrationId);
    
    if (!$registration->needsPelunasan()) {
        return back()->with('error', 'Registrasi ini tidak perlu pelunasan');
    }
    
    try {
        // Kirim email
        Mail::to($registration->email)
            ->send(new \App\Mail\PelunasanTagihan($registration));
        
        return back()->with('success', 'Tagihan pelunasan berhasil dikirim ke ' . $registration->email);
    } catch (\Exception $e) {
        return back()->with('error', 'Gagal kirim email: ' . $e->getMessage());
    }
}

/**
 * Verifikasi Pelunasan
 */
// FILE: app/Http/Controllers/AdminController.php (tambahkan method ini)

public function verifyPelunasan(Request $request, $paymentId)
{
    $validated = $request->validate([
        'action' => 'required|in:verify,reject',
        'rejection_reason' => 'required_if:action,reject|nullable|string'
    ]);
    
    DB::beginTransaction();
    try {
        $payment = Payment::with('registration.schedule')->findOrFail($paymentId);
        
        if ($payment->payment_type !== 'pelunasan') {
            throw new \Exception('Bukan payment pelunasan');
        }
        
        if ($validated['action'] === 'verify') {
            $payment->update([
                'status' => 'verified',
                'verified_by' => session('admin_id'),
                'verified_at' => now()
            ]);
            
            $payment->registration->update(['is_lunas' => true]);
            
            Mail::to($payment->registration->email)
                ->send(new \App\Mail\PelunasanVerified($payment->registration));
            
            DB::commit();
            return back()->with('success', '✅ Pelunasan verified! Status: LUNAS');
        } else {
            $payment->update([
                'status' => 'rejected',
                'rejection_reason' => $validated['rejection_reason'],
                'verified_by' => session('admin_id'),
                'verified_at' => now()
            ]);
            
            Mail::to($payment->registration->email)
                ->send(new \App\Mail\PelunasanRejected(
                    $payment->registration, 
                    $validated['rejection_reason']
                ));
            
            DB::commit();
            return back()->with('success', '⚠️ Pelunasan ditolak');
        }
    } catch (\Exception $e) {
        DB::rollBack();
        return back()->withErrors(['error' => $e->getMessage()]);
    }
}
}