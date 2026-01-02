<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = [
            // Makkah
            [
                'image' => asset('storage/gallery/gallery-1.webp'),
                'title' => 'Jamaah Mahira Tour di Masjidil Haram',
                'category' => 'Makkah'
            ],
            [
                'image' => asset('storage/gallery/gallery-2.webp'),
                'title' => 'Jamaah di depan Ka\'bah',
                'category' => 'Makkah'
            ],
            [
                'image' => asset('storage/gallery/gallery-3.webp'),
                'title' => 'Tawaf bersama Muthawwif',
                'category' => 'Makkah'
            ],
            [
                'image' => asset('storage/gallery/gallery-4.webp'),
                'title' => 'Sa\'i Safa dan Marwah',
                'category' => 'Makkah'
            ],
            [
                'image' => asset('storage/gallery/gallery-5.webp'),
                'title' => 'Berdoa di Multazam',
                'category' => 'Makkah'
            ],
            
            // Madinah
            [
                'image' => asset('storage/gallery/gallery-6.webp'),
                'title' => 'Jamaah di Masjid Nabawi',
                'category' => 'Madinah'
            ],
            [
                'image' => asset('storage/gallery/gallery-7.webp'),
                'title' => 'Ziarah Raudhah',
                'category' => 'Madinah'
            ],
            [
                'image' => asset('storage/gallery/gallery-8.webp'),
                'title' => 'Berfoto di depan Payung Masjid Nabawi',
                'category' => 'Madinah'
            ],
            
            // Wisata Islami
            [
                'image' => asset('storage/gallery/gallery-9.webp'),
                'title' => 'Ziarah Jabal Rahmah',
                'category' => 'Wisata Islami'
            ],
            [
                'image' => asset('storage/gallery/gallery-10.webp'),
                'title' => 'Gua Hira',
                'category' => 'Wisata Islami'
            ],
            [
                'image' => asset('storage/gallery/gallery-11.webp'),
                'title' => 'Masjid Quba',
                'category' => 'Wisata Islami'
            ],
            [
                'image' => asset('storage/gallery/gallery-12.webp'),
                'title' => 'Jabal Uhud',
                'category' => 'Wisata Islami'
            ],
            
            // Akomodasi
            [
                'image' => asset('storage/gallery/gallery-13.webp'),
                'title' => 'Hotel Bintang 5 Dekat Masjidil Haram',
                'category' => 'Akomodasi'
            ],
            [
                'image' => asset('storage/gallery/gallery-14.webp'),
                'title' => 'Kamar Hotel yang Nyaman',
                'category' => 'Akomodasi'
            ],
            [
                'image' => asset('storage/gallery/hotel-3.jpeg'),
                'title' => 'View Hotel Menghadap Ka\'bah',
                'category' => 'Akomodasi'
            ],
            
            // Dokumentasi
            [
                'image' => asset('storage/gallery/jamaah4.jpeg'),
                'title' => 'Sholat Jamaah di Masjidil Haram',
                'category' => 'Dokumentasi'
            ],
            [
                'image' => asset('storage/gallery/jamaah5.jpeg'),
                'title' => 'Keberangkatan Jamaah Mahira Tour',
                'category' => 'Dokumentasi'
            ],
            [
                'image' => asset('storage/gallery/dokumentasi-1.jpeg'),
                'title' => 'Foto Bersama di Bandara',
                'category' => 'Dokumentasi'
            ],
            [
                'image' => asset('storage/gallery/dokumentasi-2.jpeg'),
                'title' => 'Pembagian Perlengkapan Umrah',
                'category' => 'Dokumentasi'
            ],
            [
                'image' => asset('storage/gallery/dokumentasi-3.jpeg'),
                'title' => 'Manasik Umrah',
                'category' => 'Dokumentasi'
            ],
            
            // Fasilitas
            [
                'image' => asset('storage/gallery/fasilitas-1.jpeg'),
                'title' => 'Bus AC Full',
                'category' => 'Fasilitas'
            ],
            [
                'image' => asset('storage/gallery/fasilitas-2.jpeg'),
                'title' => 'Makan Prasmanan Hotel',
                'category' => 'Fasilitas'
            ],
            [
                'image' => asset('storage/gallery/fasilitas-3.jpeg'),
                'title' => 'Perlengkapan Umrah Lengkap',
                'category' => 'Fasilitas'
            ],
            
            // Transportasi
            [
                'image' => asset('storage/gallery/transportasi-1.jpeg'),
                'title' => 'Pesawat Garuda Indonesia',
                'category' => 'Transportasi'
            ],
            [
                'image' => asset('storage/gallery/transportasi-2.jpeg'),
                'title' => 'Check-in di Bandara',
                'category' => 'Transportasi'
            ],
            [
                'image' => asset('storage/gallery/transportasi-3.jpeg'),
                'title' => 'Bus Pariwisata Mewah',
                'category' => 'Transportasi'
            ],
        ];

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