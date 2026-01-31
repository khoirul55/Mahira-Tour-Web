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
    /**
     * Verify or Reject Document
     */
    public function verify(Request $request, $id)
    {
        $document = Document::with(['jamaah.registration'])->findOrFail($id);
        
        // Cek action: approve / reject
        // Jika tidak ada action di request, default ke 'approve' (maintain backward compatibility)
        $action = $request->input('action', 'approve'); 
        
        if ($action === 'reject') {
            $document->update([
                'is_verified' => false,
                'verification_notes' => $request->notes, // Alasan penolakan
                'verified_at' => null
            ]);
            
            $messageStatus = 'Ditolak';
            
            // WA Notification: REJECT
            try {
                $reg = $document->jamaah->registration;
                $waMessage = "Assalamu'alaikum *{$reg->full_name}*,\n\n";
                $waMessage .= "⚠️ *DOKUMEN DITOLAK*\n";
                $waMessage .= "Dokumen jamaah atas nama *{$document->jamaah->full_name}* tidak valid.\n\n";
                $waMessage .= "Jenis: " . strtoupper($document->document_type) . "\n";
                $waMessage .= "Alasan: _{$request->notes}_\n\n";
                $waMessage .= "Mohon segera upload ulang dokumen yang jelas/valid melalui Dashboard Jamaah.\n";
                $waMessage .= "*Mahira Tour*";

                \App\Jobs\SendWhatsAppNotification::dispatch($reg->phone, $waMessage);
            } catch (\Exception $e) {
                // Silent fail
            }

        } else {
            // Approve Logic
            $document->update([
                'is_verified' => true,
                'verified_at' => now(),
                'verification_notes' => $request->notes
            ]);
            
            $document->jamaah->updateCompletionStatus();
            $messageStatus = 'Diverifikasi';

            // WA Notification: APPROVED
            try {
                $reg = $document->jamaah->registration;
                // Cek apakah semua dokumen jamaah ini sudah complete?
                // Logic simple: Notif per dokumen verified
                $waMessage = "Assalamu'alaikum *{$reg->full_name}*,\n\n";
                $waMessage .= "✅ *DOKUMEN DIVERIFIKASI*\n";
                $waMessage .= "Dokumen jamaah atas nama *{$document->jamaah->full_name}* telah kami setujui.\n\n";
                $waMessage .= "Jenis: " . strtoupper($document->document_type) . "\n";
                $waMessage .= "Status: *VALID*\n\n";
                $waMessage .= "Terima kasih telah melengkapi data administrasi.\n";
                $waMessage .= "*Mahira Tour*";

                \App\Jobs\SendWhatsAppNotification::dispatch($reg->phone, $waMessage);
            } catch (\Exception $e) {
                // Silent fail
            }
        }
        
        return back()->with('success', 'Dokumen berhasil ' . $messageStatus);
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
        $jamaah = Jamaah::with('registration')->findOrFail($jamaahId);
        
        $jamaah->update([
            'passport_processed' => true,
            'passport_processed_at' => now(),
            'passport_notes' => $request->notes
        ]);
        
        // WA Notification: PASSPORT PROCESSING
        try {
            $reg = $jamaah->registration;
            $waMessage = "Assalamu'alaikum *{$reg->full_name}*,\n\n";
            $waMessage .= "📢 *UPDATE PENGURUSAN PASPOR*\n";
            $waMessage .= "Permohonan pembuatan paspor untuk jamaah *{$jamaah->full_name}* sedang kami proses.\n\n";
            $waMessage .= "Status: ⏳ *SEDANG DIURUS TIM*\n\n";
            $waMessage .= "Mohon Siapkan Dokumen Asli:\n";
            $waMessage .= "1. KTP & KK Asli\n";
            $waMessage .= "2. Akta Lahir / Buku Nikah Asli\n";
            $waMessage .= "3. Ijazah Terakhir (Opsional)\n\n";
            $waMessage .= "_Tim kami akan menghubungi Anda segera untuk jadwal FOTO & WAWANCARA di Kantor Imigrasi._\n\n";
            $waMessage .= "*Mahira Tour*";

            \App\Jobs\SendWhatsAppNotification::dispatch($reg->phone, $waMessage);
        } catch (\Exception $e) {
            // Log::error('WA Passport failed: ' . $e->getMessage());
        }
        
        return back()->with('success', 'Request passport untuk ' . $jamaah->full_name . ' sedang diproses!');
    }
}
