<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Document;
use App\Models\Payment;

class PrivateFileController extends Controller
{
    public function show(Request $request, $path)
    {
        // 1. Cek Auth (Admin only for now, can extend to Owner later)
        if (!auth()->guard('admin_web')->check()) {
            abort(403, 'Unauthorized access');
        }

        // 2. Cek apakah file ada di secure storage
        if (Storage::disk('secure')->exists($path)) {
            $file = Storage::disk('secure')->path($path);
            return response()->file($file);
        }
        
        // 3. FALLBACK: Cek di public storage (untuk migrasi file lama)
        // Kadang path yang dikirim user lengkap dengan 'documents/...' atau 'payments/...'
        // Jadi kita coba cek langsung di disk public
        if (Storage::disk('public')->exists($path)) {
             $file = Storage::disk('public')->path($path);
             return response()->file($file);
        }

        abort(404, 'File not found');
    }
}
