<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        // Ambil dari database (bukan hardcode)
        $galleries = Gallery::active()
            ->ordered()
            ->get()
            ->map(function($gallery) {
                return [
                    'image' => $gallery->image_url,
                    'title' => $gallery->title,
                    'category' => $gallery->category
                ];
            })
            ->toArray();

        $categories = [
            'all' => 'Semua',
            'Makkah' => 'Makkah',
            'Madinah' => 'Madinah',
            'Wisata Islami' => 'Wisata Islami',
            'Akomodasi' => 'Akomodasi',
            'Dokumentasi' => 'Dokumentasi',
            'Fasilitas' => 'Fasilitas',
            'Transportasi' => 'Transportasi'
        ];

        return view('pages.gallery', compact('galleries', 'categories'));
    }
}