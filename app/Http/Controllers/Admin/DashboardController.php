<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use App\Models\Payment;
use App\Models\Document;
use App\Models\Jamaah;

class DashboardController extends Controller
{
    public function index()
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
}
