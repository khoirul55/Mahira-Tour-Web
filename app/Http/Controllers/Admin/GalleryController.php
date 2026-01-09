<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    /**
     * Display galleries
     */
    public function index(Request $request)
    {
        $query = Gallery::query()->ordered();
        
        // Filter by category
        if ($request->category && $request->category !== 'all') {
            $query->where('category', $request->category);
        }
        
        // Filter by status
        if ($request->has('status')) {
            $query->where('is_active', $request->status === 'active');
        }
        
        $galleries = $query->paginate(20);
        
        $categories = [
            'Makkah',
            'Madinah',
            'Wisata Islami',
            'Akomodasi',
            'Dokumentasi',
            'Fasilitas',
            'Transportasi'
        ];
        
        return view('admin.galleries.index', compact('galleries', 'categories'));
    }
    
    /**
     * Show create form
     */
    public function create()
    {
        $categories = [
            'Makkah',
            'Madinah',
            'Wisata Islami',
            'Akomodasi',
            'Dokumentasi',
            'Fasilitas',
            'Transportasi'
        ];
        
        return view('admin.galleries.create', compact('categories'));
    }
    
    /**
     * Store new gallery
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
        $file = $request->file('image');
        $filename = time() . '_' . uniqid() . '.' . $file->extension();
        $path = $file->storeAs('galleries', $filename, 'public');
        
        Gallery::create([
            'title' => $validated['title'],
            'category' => $validated['category'],
            'image_path' => $path,
            'display_order' => $validated['display_order'] ?? 0,
            'is_active' => $request->has('is_active') // FIX INI
        ]);
        
        return redirect()->route('admin.galleries.index')
            ->with('success', 'Foto berhasil ditambahkan ke galeri');
            
    } catch (\Exception $e) {
        return back()->withErrors(['error' => $e->getMessage()])->withInput();
    }
}
    
    /**
     * Show edit form
     */
    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);
        
        $categories = [
            'Makkah',
            'Madinah',
            'Wisata Islami',
            'Akomodasi',
            'Dokumentasi',
            'Fasilitas',
            'Transportasi'
        ];
        
        return view('admin.galleries.edit', compact('gallery', 'categories'));
    }
    
    /**
     * Update gallery
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
        if ($request->hasFile('image')) {
            if (Storage::disk('public')->exists($gallery->image_path)) {
                Storage::disk('public')->delete($gallery->image_path);
            }
            
            $file = $request->file('image');
            $filename = time() . '_' . uniqid() . '.' . $file->extension();
            $path = $file->storeAs('galleries', $filename, 'public');
            $validated['image_path'] = $path;
        }
        
        $validated['is_active'] = $request->has('is_active'); // FIX INI
        
        $gallery->update($validated);
        
        return redirect()->route('admin.galleries.index')
            ->with('success', 'Foto berhasil diupdate');
            
    } catch (\Exception $e) {
        return back()->withErrors(['error' => $e->getMessage()])->withInput();
    }
}
    
    /**
     * Delete gallery
     */
    public function destroy($id)
    {
        try {
            $gallery = Gallery::findOrFail($id);
            $gallery->deleteWithFile();
            
            return back()->with('success', 'Foto berhasil dihapus');
            
        } catch (\Exception $e) {
            return back()->withErrors(['error' => 'Gagal hapus foto: ' . $e->getMessage()]);
        }
    }
    
    /**
     * Toggle status
     */
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