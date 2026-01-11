<?php

namespace App\Http\Controllers;

use App\Models\Schedule;

class ScheduleController extends Controller
{
    public function index()
    {
        // ✅ Ambil data REAL dari database
        $schedules = Schedule::where('status', 'active')
            ->where('departure_date', '>=', now())
            ->orderBy('departure_date', 'asc')
            ->get()
            ->map(function($schedule) {
                $available = $schedule->available_seats;
                
                if ($available <= 0) {
                    $status = 'full';
                } elseif ($available <= 5) {
                    $status = 'almost_full';
                } else {
                    $status = 'available';
                }
            
                // ✅ Return semua data dari database (bukan hardcode)
                return [
                    'id' => $schedule->id,
                    'package_name' => $schedule->package_name,
                    'departure_date' => $schedule->departure_date->format('Y-m-d'),
                    'return_date' => $schedule->return_date->format('Y-m-d'),
                    'departure_route' => $schedule->departure_route,
                    'quota' => $schedule->quota,
                    'seats_taken' => $schedule->seats_taken,
                    'available_seats' => $available,
                    'status' => $status,
                    'price' => $schedule->price,
                    'airline' => $schedule->airline,
                    'duration' => $schedule->duration,
                    'flyer_image' => basename($schedule->flyer_image), // ✅ Ambil nama file dari path
                    'flyer_path' => $schedule->flyer_image // ✅ Tambahkan full path juga
                ];
            });
    
        // ✅ Ambil daftar rute untuk filter
        $departure_routes = Schedule::where('status', 'active')
            ->where('departure_date', '>=', now())
            ->distinct()
            ->pluck('departure_route')
            ->toArray();
    
        return view('pages.schedule', compact('schedules', 'departure_routes'));
    }
}