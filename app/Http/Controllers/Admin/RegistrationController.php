<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Registration;
use App\Models\Schedule;
use App\Exports\RegistrationsExport;
use App\Exports\SingleRegistrationExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class RegistrationController extends Controller
{
    /**
     * List All Registrations
     */
    public function index(Request $request)
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
    public function show($id)
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
    public function export(Request $request)
    {
        $filters = $request->only(['status', 'schedule_id', 'search']);
        $filename = 'registrations_' . date('Y-m-d_His') . '.xlsx';
        
        return Excel::download(new RegistrationsExport($filters), $filename);
    }
    
    /**
     * Export Single Registration to Excel
     */
    public function exportSingle($id)
    {
        $registration = Registration::with(['schedule', 'jamaah.documents', 'payments'])->findOrFail($id);
        $filename = 'jamaah_' . $registration->registration_number . '_' . date('Ymd') . '.xlsx';
        
        return Excel::download(new SingleRegistrationExport($registration), $filename);
    }
}
