<?php

namespace App\Http\Controllers;

use App\Models\{Registration, Payment, Document, Jamaah, Schedule};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB, Storage};
use ZipArchive;

class AdminController extends Controller
{
    /**
     * Admin Dashboard
     */
    public function dashboard()
    {
        // Stats
        $stats = [
            'pending' => Payment::where('status', 'pending')
                ->whereNotNull('proof_path')
                ->count(),
            'pending_docs' => Document::where('is_verified', false)->count(),
            'confirmed' => Registration::where('status', 'confirmed')->count(),
            'total_revenue' => Payment::where('status', 'verified')->sum('amount')
        ];
        
        // Pending Payments
        $pendingPayments = Payment::with('registration')
            ->where('status', 'pending')
            ->whereNotNull('proof_path')
            ->latest()
            ->get();
        
        // Registrations with Documents
        $registrationsWithDocs = Registration::with(['jamaah.documents', 'payments'])
            ->whereHas('jamaah.documents')
            ->latest()
            ->get();
        
        // Passport Requests
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
     * Verify Payment (Approve/Reject)
     */
    public function verifyPayment(Request $request, $id)
    {
        $payment = Payment::findOrFail($id);
        $action = $request->input('action');
        
        DB::beginTransaction();
        
        try {
            if ($action === 'approve') {
                $payment->update([
                    'status' => 'verified',
                    'verified_by' => session('admin_id'),
                    'verified_at' => now()
                ]);
                
                // Update registration status
                $payment->registration->update(['status' => 'confirmed']);
                
                // TODO: Send WhatsApp/Email notification to user
                
                $message = 'Pembayaran berhasil diverifikasi!';
            } else {
                $payment->update([
                    'status' => 'rejected',
                    'rejection_notes' => $request->input('notes'),
                    'verified_by' => session('admin_id'),
                    'verified_at' => now()
                ]);
                
                // TODO: Send rejection notification to user
                
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
        
        // Search
        if ($request->search) {
            $query->where(function($q) use ($request) {
                $q->where('registration_number', 'like', '%' . $request->search . '%')
                  ->orWhere('full_name', 'like', '%' . $request->search . '%')
                  ->orWhere('email', 'like', '%' . $request->search . '%')
                  ->orWhere('phone', 'like', '%' . $request->search . '%');
            });
        }
        
        $registrations = $query->latest()->paginate(20);
        
        return view('admin.registrations.index', compact('registrations'));
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
     * Documents Index
     */
    public function documentsIndex(Request $request)
    {
        $query = Document::with(['jamaah.registration']);
        
        // Filter by verification status
        if ($request->has('verified')) {
            $query->where('is_verified', $request->verified === 'true');
        }
        
        // Filter by document type
        if ($request->type) {
            $query->where('document_type', $request->type);
        }
        
        $documents = $query->latest()->paginate(30);
        
        // Group by registration
        $registrationsWithDocs = Registration::with(['jamaah.documents'])
            ->whereHas('jamaah.documents')
            ->latest()
            ->paginate(10);
        
        return view('admin.documents.index', compact('documents', 'registrationsWithDocs'));
    }
    
    /**
     * Verify Document
     */
    public function verifyDocument(Request $request, $id)
    {
        $document = Document::findOrFail($id);
        
        $document->update([
            'is_verified' => true,
            'verified_by' => session('admin_id'),
            'verified_at' => now(),
            'verification_notes' => $request->notes
        ]);
        
        // Update jamaah completion status
        $document->jamaah->updateCompletionStatus();
        
        return back()->with('success', 'Dokumen berhasil diverifikasi!');
    }
    
    /**
     * Download All Documents for a Registration (ZIP)
     */
    public function downloadAllDocuments($registrationId)
    {
        $registration = Registration::with('jamaah.documents')->findOrFail($registrationId);
        
        $zipFileName = 'dokumen_' . $registration->registration_number . '_' . date('Ymd') . '.zip';
        $zipPath = storage_path('app/temp/' . $zipFileName);
        
        // Ensure temp directory exists
        if (!file_exists(storage_path('app/temp'))) {
            mkdir(storage_path('app/temp'), 0755, true);
        }
        
        $zip = new ZipArchive();
        
        if ($zip->open($zipPath, ZipArchive::CREATE | ZipArchive::OVERWRITE) !== true) {
            return back()->with('error', 'Gagal membuat file ZIP');
        }
        
        foreach ($registration->jamaah as $jamaah) {
            // Create folder for each jamaah
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
     * Download Single Document
     */
    public function downloadDocument($id)
    {
        $document = Document::with('jamaah')->findOrFail($id);
        
        $filePath = Storage::disk('public')->path($document->file_path);
        
        if (!file_exists($filePath)) {
            return back()->with('error', 'File tidak ditemukan');
        }
        
        $extension = pathinfo($document->file_path, PATHINFO_EXTENSION);
        $fileName = str_replace(' ', '_', $document->jamaah->full_name) . '_' . 
                    strtoupper($document->document_type) . '.' . $extension;
        
        return response()->download($filePath, $fileName);
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
            'passport_processed_by' => session('admin_id'),
            'passport_notes' => $request->notes
        ]);
        
        // TODO: Send notification to user that passport is being processed
        
        return back()->with('success', 'Request passport untuk ' . $jamaah->full_name . ' sedang diproses!');
    }
    
    /**
     * View Document Preview
     */
    public function previewDocument($id)
    {
        $document = Document::findOrFail($id);
        
        $filePath = Storage::disk('public')->path($document->file_path);
        
        if (!file_exists($filePath)) {
            abort(404, 'File tidak ditemukan');
        }
        
        $mimeType = mime_content_type($filePath);
        
        return response()->file($filePath, [
            'Content-Type' => $mimeType
        ]);
    }
}