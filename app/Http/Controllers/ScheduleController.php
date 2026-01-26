<?php

namespace App\Http\Controllers;

use App\Models\Schedule;

class ScheduleController extends Controller
{
    public function index()
    {
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
            
                // ✅ PENTING: Gunakan flyer_image langsung dari database
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
                    'flyer_image' => $schedule->flyer_image // ✅ schedules/flyers/xxx.webp
                ];
            });
    
        $departure_routes = Schedule::where('status', 'active')
            ->where('departure_date', '>=', now())
            ->distinct()
            ->pluck('departure_route')
            ->toArray();
    
        return view('pages.schedule', compact('schedules', 'departure_routes'));
    }


    public function show($id, $slug = null)
    {
        $schedule = Schedule::where('id', $id)
            ->where('status', '!=', 'cancelled') // Allow 'full' to be seen, but not 'cancelled'
            ->firstOrFail();
            
        // SEO: Redirect if slug doesn't match
        $expectedSlug = \Illuminate\Support\Str::slug($schedule->package_name);
        if ($slug !== $expectedSlug) {
            return redirect()->route('schedule.detail', ['id' => $id, 'slug' => $expectedSlug]);
        }
        
        $related_packages = Schedule::where('status', 'active')
            ->where('id', '!=', $id)
            ->where('departure_date', '>=', now())
            ->inRandomOrder()
            ->take(3)
            ->get();
            
        return view('pages.schedule-detail', compact('schedule', 'related_packages'));
    }
}