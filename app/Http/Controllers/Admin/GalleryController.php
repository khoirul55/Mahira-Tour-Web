<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use App\Helpers\ImageHelper; // ← IMPORT HELPER
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index(Request $request)
    {
        $query = Gallery::query()->ordered();
        
        if ($request->category && $request->category !== 'all') {
            $query->where('category', $request->category);
        }
        
        if ($request->has('status')) {
            $query->where('is_active', $request->status === 'active');
        }
        
        $galleries = $query->paginate(20);
        
        $categories = [
            'Makkah', 'Madinah', 'Wisata Islami', 
            'Akomodasi', 'Dokumentasi', 'Fasilitas', 'Transportasi'
        ];
        
        return view('admin.galleries.index', compact('galleries', 'categories'));
    }
    
    public function create()
    {
        $categories = [
            'Makkah', 'Madinah', 'Wisata Islami', 
            'Akomodasi', 'Dokumentasi', 'Fasilitas', 'Transportasi'
        ];
        
        return view('admin.galleries.create', compact('categories'));
    }
    
    /**
     * Store - CLEAN VERSION dengan Helper
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:Makkah,Madinah,Wisata Islami,Akomodasi,Dokumentasi,Fasilitas,Transportasi',
            'image' => 'required|image|mimes:jpeg,jpg,png,webp|max:5120',
            'display_order' => 'nullable|integer|min:0',
        ]);
        
        try {
            // ✅ SIMPLE: Cukup 1 baris!
            $imagePath = ImageHelper::optimizeAndSave(
                $request->file('image'), 
                'galleries',
                1200, // width
                900,  // height
                85    // quality
            );
            
            Gallery::create([
                'title' => $validated['title'],
                'category' => $validated['category'],
                'image_path' => $imagePath,
                'display_order' => $validated['display_order'] ?? 0,
                'is_active' => $request->has('is_active')
            ]);
            
            return redirect()->route('admin.galleries.index')
                ->with('success', 'Foto berhasil ditambahkan dan dioptimasi!');
                
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }
    
    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);
        
        $categories = [
            'Makkah', 'Madinah', 'Wisata Islami', 
            'Akomodasi', 'Dokumentasi', 'Fasilitas', 'Transportasi'
        ];
        
        return view('admin.galleries.edit', compact('gallery', 'categories'));
    }
    
    /**
     * Update - CLEAN VERSION dengan Helper
     */
    public function update(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);
        
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'category' => 'required|in:Makkah,Madinah,Wisata Islami,Akomodasi,Dokumentasi,Fasilitas,Transportasi',
            'image' => 'nullable|image|mimes:jpeg,jpg,png,webp|max:5120',
            'display_order' => 'nullable|integer|min:0',
        ]);
        
        try {
            // Update image if uploaded
            if ($request->hasFile('image')) {
                // ✅ Delete old image (1 baris)
                ImageHelper::deleteImage($gallery->image_path);
                
                // ✅ Upload new optimized image (1 baris)
                $validated['image_path'] = ImageHelper::optimizeAndSave(
                    $request->file('image'), 
                    'galleries',
                    1200,
                    900,
                    85
                );
            }
            
            $validated['is_active'] = $request->has('is_active');
            $gallery->update($validated);
            
            return redirect()->route('admin.galleries.index')
                ->with('success', 'Foto berhasil diupdate');
                
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()])->withInput();
        }
    }
    
    /**
     * Delete - Pakai Helper juga
     */
    public function destroy($id)
    {
        try {
            $gallery = Gallery::findOrFail($id);
            
            // ✅ Delete file with helper (1 baris)
            ImageHelper::deleteImage($gallery->image_path);
            
            $gallery->delete();
            
            return back()->with('success', 'Foto berhasil dihapus');
            
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }
    
    public function toggleStatus($id)
    {
        try {
            $gallery = Gallery::findOrFail($id);
            $gallery->update(['is_active' => !$gallery->is_active]);
            
            $status = $gallery->is_active ? 'diaktifkan' : 'dinonaktifkan';
            
            return back()->with('success', "Foto berhasil {$status}");
            
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal update status']);
        }
    }
}