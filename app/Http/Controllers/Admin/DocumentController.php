<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use App\Models\Registration;
use App\Models\Jamaah;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use ZipArchive;

class DocumentController extends Controller
{
    /**
     * Verify Document
     */
    public function verify(Request $request, $id)
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
    public function downloadAll($registrationId)
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
                // Determine source disk based on file path or config
                // Assuming mixed usage of 'public' and 'secure'
                // We'll try to check both or assume secure if path matches logic
                
                $filePath = null;
                if (Storage::disk('secure')->exists($doc->file_path)) {
                    $filePath = Storage::disk('secure')->path($doc->file_path);
                } elseif (Storage::disk('public')->exists($doc->file_path)) {
                    $filePath = Storage::disk('public')->path($doc->file_path);
                }
                
                if ($filePath && file_exists($filePath)) {
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
}
