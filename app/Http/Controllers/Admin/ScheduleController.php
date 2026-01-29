<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Schedule;
use App\Helpers\ImageHelper;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ScheduleController extends Controller
{
    /**
     * Display all schedules
     */
    public function index(Request $request)
    {
        $query = Schedule::query()->orderBy('departure_date', 'desc');
        
        // Filter by status
        if ($request->has('status') && $request->status !== 'all') {
            $query->where('status', $request->status);
        }
        
        // Filter by route
        if ($request->has('route') && $request->route !== 'all') {
            $query->where('departure_route', $request->route);
        }
        
        $schedules = $query->paginate(15);
        
        // Get unique departure routes
        $routes = Schedule::distinct()
            ->pluck('departure_route')
            ->filter()
            ->toArray();
        
        return view('admin.schedules.index', compact('schedules', 'routes'));
    }
    
    /**
     * Show create form
     */
    public function create()
    {
        return view('admin.schedules.create');
    }
    
    /**
     * Store new schedule
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'package_name' => 'required|string|max:255',
            'departure_date' => 'required|date|after:today',
            'return_date' => 'required|date|after:departure_date',
            'departure_route' => 'required|string|max:100',
            'airline' => 'required|string|max:100',
            'duration' => 'required|string|max:50',
            'price' => 'required|numeric|min:0', // Used as Fixed Price
            'quota' => 'required|integer|min:1',
            'flyer_image' => 'required|image|mimes:jpeg,jpg,png,webp|max:10240', // 10MB
            'status' => 'required|in:active,full,cancelled',
            // New Fields
            'description' => 'nullable|string',
            'hotel_makkah' => 'nullable|string|max:255',
            'hotel_makkah_image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:5120',
            'hotel_madinah' => 'nullable|string|max:255',
            'hotel_madinah_image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:5120',
            'itinerary' => 'nullable|string',
            'features' => 'nullable|string',
            'excludes' => 'nullable|string',
            'gifts' => 'nullable|string',
            'additional_info' => 'nullable|string',
            'itinerary_pdf' => 'nullable|file|mimes:pdf|max:5120',
        ]);
        
        DB::beginTransaction();
        
        try {
            // Upload & optimize flyer
            $flyerPath = ImageHelper::optimizeAndSave(
                $request->file('flyer_image'), 
                'schedules/flyers',
                1200,  // Width untuk flyer
                1600,  // Height untuk flyer (portrait)
                90     // Quality tinggi untuk flyer
            );
            
            // Upload PDF if exists
            $pdfPath = null;
            if ($request->hasFile('itinerary_pdf')) {
                $pdfPath = $request->file('itinerary_pdf')->store('schedules/itineraries', 'public');
            }

            // Upload Hotel Images
            $hotelMakkahPath = null;
            if ($request->hasFile('hotel_makkah_image')) {
                $hotelMakkahPath = ImageHelper::optimizeAndSave($request->file('hotel_makkah_image'), 'schedules/hotels', 800, 600, 85);
            }

            $hotelMadinahPath = null;
            if ($request->hasFile('hotel_madinah_image')) {
                $hotelMadinahPath = ImageHelper::optimizeAndSave($request->file('hotel_madinah_image'), 'schedules/hotels', 800, 600, 85);
            }
            
            Schedule::create([
                'package_name' => $validated['package_name'],
                'departure_date' => $validated['departure_date'],
                'return_date' => $validated['return_date'],
                'departure_route' => $validated['departure_route'],
                'airline' => $validated['airline'],
                'duration' => $validated['duration'],
                'price' => $validated['price'],
                'quota' => $validated['quota'],
                'seats_taken' => 0,
                'flyer_image' => $flyerPath,
                'status' => $validated['status'],
                // New Fields
                'description' => $validated['description'] ?? null,
                'hotel_makkah' => $validated['hotel_makkah'] ?? null,
                'hotel_makkah_image' => $hotelMakkahPath,
                'hotel_madinah' => $validated['hotel_madinah'] ?? null,
                'hotel_madinah_image' => $hotelMadinahPath,
                'itinerary' => $validated['itinerary'] ?? null,
                'itinerary_pdf' => $pdfPath,
                'features' => $validated['features'] ?? null,
                'excludes' => $validated['excludes'] ?? null,
                'gifts' => $validated['gifts'] ?? null,
                'additional_info' => $validated['additional_info'] ?? null,
            ]);
            
            DB::commit();
            
            return redirect()->route('admin.schedules.index')
                ->with('success', 'Paket jadwal berhasil ditambahkan!');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }
    
    /**
     * Show edit form
     */
    public function edit($id)
    {
        $schedule = Schedule::findOrFail($id);
        return view('admin.schedules.edit', compact('schedule'));
    }
    
    /**
     * Update schedule
     */
    public function update(Request $request, $id)
    {
        $schedule = Schedule::findOrFail($id);
        
        $validated = $request->validate([
            'package_name' => 'required|string|max:255',
            'departure_date' => 'required|date',
            'return_date' => 'required|date|after:departure_date',
            'departure_route' => 'required|string|max:100',
            'airline' => 'required|string|max:100',
            'duration' => 'required|string|max:50',
            'price' => 'required|numeric|min:0',
            'quota' => 'required|integer|min:' . $schedule->seats_taken, // Quota minimal = seats yang sudah diambil
            'flyer_image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:10240',
            'status' => 'required|in:active,full,cancelled',
            // New Fields
            'description' => 'nullable|string',
            'hotel_makkah' => 'nullable|string|max:255',
            'hotel_makkah_image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:5120',
            'hotel_madinah' => 'nullable|string|max:255',
            'hotel_madinah_image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:5120',
            'itinerary' => 'nullable|string',
            'features' => 'nullable|string',
            'excludes' => 'nullable|string',
            'gifts' => 'nullable|string',
            'additional_info' => 'nullable|string',
            'itinerary_pdf' => 'nullable|file|mimes:pdf|max:5120',
        ]);
        
        DB::beginTransaction();
        
        try {
            // Update flyer if uploaded
            if ($request->hasFile('flyer_image')) {
                // Delete old flyer
                ImageHelper::deleteImage($schedule->flyer_image);
                
                // Upload new flyer
                $validated['flyer_image'] = ImageHelper::optimizeAndSave(
                    $request->file('flyer_image'), 
                    'schedules/flyers',
                    1200,
                    1600,
                    90
                );
            }
            
            // Update PDF if uploaded
            if ($request->hasFile('itinerary_pdf')) {
                 $validated['itinerary_pdf'] = $request->file('itinerary_pdf')->store('schedules/itineraries', 'public');
            }

            // Update Hotel Images
            if ($request->hasFile('hotel_makkah_image')) {
                if ($schedule->hotel_makkah_image) ImageHelper::deleteImage($schedule->hotel_makkah_image);
                $validated['hotel_makkah_image'] = ImageHelper::optimizeAndSave($request->file('hotel_makkah_image'), 'schedules/hotels', 800, 600, 85);
            }
            if ($request->hasFile('hotel_madinah_image')) {
                if ($schedule->hotel_madinah_image) ImageHelper::deleteImage($schedule->hotel_madinah_image);
                $validated['hotel_madinah_image'] = ImageHelper::optimizeAndSave($request->file('hotel_madinah_image'), 'schedules/hotels', 800, 600, 85);
            }
            
            $schedule->update($validated);
            
            DB::commit();
            
            return redirect()->route('admin.schedules.index')
                ->with('success', 'Paket jadwal berhasil diupdate!');
                
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }
    
    /**
     * Delete schedule
     */
    public function destroy($id)
    {
        DB::beginTransaction();
        
        try {
            $schedule = Schedule::findOrFail($id);
            
            // Check if ada registrasi
            if ($schedule->registrations()->count() > 0) {
                return back()->withErrors([
                    'error' => 'Tidak bisa hapus paket yang sudah ada pendaftaran. Total pendaftaran: ' . $schedule->registrations()->count()
                ]);
            }
            
            // Delete flyer
            ImageHelper::deleteImage($schedule->flyer_image);
            if ($schedule->hotel_makkah_image) ImageHelper::deleteImage($schedule->hotel_makkah_image);
            if ($schedule->hotel_madinah_image) ImageHelper::deleteImage($schedule->hotel_madinah_image);
            
            $schedule->delete();
            
            DB::commit();
            
            return back()->with('success', 'Paket jadwal berhasil dihapus');
            
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    
    /**
     * Toggle status (active/cancelled)
     */
    public function toggleStatus($id)
    {
        try {
            $schedule = Schedule::findOrFail($id);
            
            // Toggle between active and cancelled
            $newStatus = $schedule->status === 'active' ? 'cancelled' : 'active';
            $schedule->update(['status' => $newStatus]);
            
            $message = $newStatus === 'active' ? 'diaktifkan' : 'dibatalkan';
            
            return back()->with('success', "Paket berhasil {$message}");
            
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal update status']);
        }
    }
    
    /**
     * Update quota manually
     */
    public function updateQuota(Request $request, $id)
    {
        $validated = $request->validate([
            'quota' => 'required|integer|min:1'
        ]);
        
        try {
            $schedule = Schedule::findOrFail($id);
            
            if ($validated['quota'] < $schedule->seats_taken) {
                return back()->withErrors([
                    'error' => "Quota tidak bisa kurang dari kursi yang sudah terisi ({$schedule->seats_taken})"
                ]);
            }
            
            $schedule->update(['quota' => $validated['quota']]);
            
            // Auto update status jika full
            if ($schedule->seats_taken >= $validated['quota']) {
                $schedule->update(['status' => 'full']);
            } else if ($schedule->status === 'full') {
                $schedule->update(['status' => 'active']);
            }
            
            return back()->with('success', 'Quota berhasil diupdate');
            
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
}