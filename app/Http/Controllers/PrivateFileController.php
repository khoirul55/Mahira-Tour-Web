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
        // 1. Check if file exists
        if (!Storage::disk('secure')->exists($path)) {
            // Fallback to public
            if (Storage::disk('public')->exists($path)) {
                 return response()->file(Storage::disk('public')->path($path));
            }
            abort(404, 'File not found');
        }

        $file = Storage::disk('secure')->path($path);

        // 2. ADMIN AUTH
        if (auth()->guard('admin_web')->check()) {
            return response()->file($file);
        }

        // 3. USER TOKEN AUTH (Mahira Dashboard Token)
        $token = $request->query('token') ?: $request->cookie('mahira_dashboard_token');

        if ($token) {
            // Check ownership via Document
            $document = Document::where('file_path', $path)->with('jamaah.registration')->first();
            if ($document && $document->jamaah->registration->validateAccessToken($token)) {
                return response()->file($file);
            }

            // Check ownership via Payment
            $payment = Payment::where('proof_path', $path)->with('registration')->first();
            if ($payment && $payment->registration->validateAccessToken($token)) {
                return response()->file($file);
            }
            
            // Check ownership via Passport (if stored separately, but usually in Document)
        }

        abort(403, 'Unauthorized access');
    }
}
