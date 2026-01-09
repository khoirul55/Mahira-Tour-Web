<?php

namespace App\Http\Controllers;

use App\Models\{Registration, Payment};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\{DB, Storage};

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'pending' => Registration::where('status', 'pending')->count(),
            'confirmed' => Registration::where('status', 'confirmed')->count(),
            'total_revenue' => Registration::where('status', 'confirmed')->sum('total_price'),
        ];
        
        $pendingPayments = Payment::with('registration')
            ->where('status', 'pending')
            ->where('payment_type', 'dp')
            ->latest()
            ->get();
        
        return view('admin.dashboard', compact('stats', 'pendingPayments'));
    }
    
    public function verifyPayment(Request $request, $paymentId)
    {
        $validated = $request->validate([
            'action' => 'required|in:approve,reject',
            'notes' => 'nullable|string|max:500'
        ]);
        
        DB::beginTransaction();
        
        try {
            $payment = Payment::with('registration')->findOrFail($paymentId);
            
            if ($validated['action'] === 'approve') {
                $payment->update([
                    'status' => 'verified',
                    'verified_at' => now()
                ]);
                
                $payment->registration->update([
                    'status' => 'confirmed'
                ]);
                
                $message = 'DP berhasil diverifikasi';
            } else {
                $payment->update([
                    'status' => 'rejected',
                    'rejection_reason' => $validated['notes']
                ]);
                
                $message = 'DP ditolak';
            }
            
            DB::commit();
            
            return back()->with('success', $message);
            
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}