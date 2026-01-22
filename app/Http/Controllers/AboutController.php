<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AboutController extends Controller
{
    public function index()
    {
    $companyInfo = [
        'name' => 'Mahira Tour',
        'tagline' => 'Umrah Bersama, Berkah Bersama',
        'founded' => '2016',
        'ppiu_date' => '15 Februari 2025',
        'main_office' => 'Jl. Muradi, Desa Koto Keras, Kec. Pesisir Bukit, Kota Sungai Penuh',
        'phone' => '0821 8451 5310',
        'website' => 'www.mahiratour.co.id',
        'instagram' => '@mahiratourofficial',
        'facebook' => 'Mahira Umrah',
        'description' => 'Mahira Tour sudah ada sejak tahun 2016, baru diresmikan dengan diterbitkannya Izin PPIU pada 15 Februari 2025. Mahira Tour adalah sebuah perusahaan travel yang fokus pada penyelenggaraan perjalanan Umrah dan wisata halal dengan komitmen kuat terhadap kualitas dan kepuasan pelanggan.'
    ];
    
    $visionMission = [
        'vision' => 'Menjadi penyedia layanan travel Umrah dan wisata halal yang terpercaya dan terkemuka di Indonesia, dengan mengedepankan pelayanan prima dan nilai-nilai Islami.',
        'missions' => [
            'Menyediakan layanan perjalanan Umrah yang profesional, aman, dan nyaman',
            'Memberikan pengalaman wisata halal yang mendidik dan berkesan',
            'Menyediakan fasilitas dan akomodasi berkualitas tinggi',
            'Melayani dengan penuh dedikasi dan keikhlasan, serta menjunjung tinggi nilai-nilai keislaman',
            'Mengembangkan program-program edukatif yang mendukung pemahaman dan penghayatan ibadah serta wisata halal'
        ]
    ];
    
    $leadership = [
        ['name' => 'Khilal Hamdan', 'position' => 'Direktur Utama'],
        ['name' => 'Nadirman Hamdan', 'position' => 'Komisaris Utama']
    ];
    
    $branches = [
        [
            'name' => 'Kantor Pusat',
            'region' => 'Sungai Penuh',
            'address' => 'Jl. Muradi, Desa Koto Keras, Kecamatan Pesisir Bukit, Kota Sungai Penuh',
            'is_main' => true,
            'map_link' => 'https://maps.app.goo.gl/MahiraTourSungaiPenuh' // Placeholder or remove if not needed
        ],
        [
            'name' => 'Regional Sumatera Barat',
            'region' => 'Padang',
            'address' => 'Taruko I, Jl. Raya No.66 A, Korong Gadang, Kec. Kuranji, Kota Padang, Sumatera Barat 25158',
            'is_main' => false,
            'map_link' => 'https://maps.app.goo.gl/bN6zG5ds5Ynutf3k9?g_st=aw'
        ],
        [
            'name' => 'Cabang Jambi',
            'region' => 'Jambi',
            'address' => 'Gg. Nuri 1, RT.25/RW.no 16, Jelutung, Kec. Jelutung, Kota Jambi, Jambi 36136',
            'is_main' => false,
            'map_link' => 'https://maps.app.goo.gl/DZ4fU5dQsnxJXg3L8'
        ],
        [
            'name' => 'Cabang Bungo',
            'region' => 'Jambi',
            'address' => 'Suka Jaya, Kabupaten Bungo, Jambi',
            'is_main' => false,
            'map_link' => 'https://maps.app.goo.gl/CUKHXVoTSiyZyNif6?g_st=aw'
        ],
        [
            'name' => 'Cabang Tebo',
            'region' => 'Jambi',
            'address' => 'Jl. Padang Lamo, Tlk. Kuali, Kec. Tebo Ulu, Kabupaten Tebo, Jambi 37259',
            'is_main' => false,
            'map_link' => 'https://maps.app.goo.gl/sBNookviKWUfWY1bA?g_st=aw'
        ],
        [
            'name' => 'Cabang Merangin',
            'region' => 'Merangin',
            'address' => 'Muara Panco Barat, Kec. Renah Pembarap, Kabupaten Merangin',
            'is_main' => false,
            'map_link' => ''
        ]
    ];
    
    // Team Members (placeholder - bisa diisi nanti)
    $team = [
        // Uncomment dan isi data tim setelah foto tersedia
        // ['name' => 'Nama Tim', 'position' => 'Customer Service', 'photo' => 'team/nama.webp'],
    ];
    
    // Quick Stats
    $stats = [
        ['number' => '5000+', 'label' => 'Jamaah Terlayani', 'icon' => 'bi-people-fill'],
        ['number' => '10+', 'label' => 'Tahun Berpengalaman', 'icon' => 'bi-calendar-check'],
        ['number' => '7', 'label' => 'Cabang di Indonesia', 'icon' => 'bi-geo-alt-fill'],
        ['number' => '45+', 'label' => 'Keberangkatan/Tahun', 'icon' => 'bi-airplane-fill'],
    ];
    
    // PPIU Info
    $ppiuInfo = [
        'number' => '21062301498960002',
        'date' => '15 Februari 2025',
        'issuer' => 'Kementerian Agama Republik Indonesia',
    ];
    
    return view('pages.about', compact(
        'companyInfo', 
        'visionMission', 
        'leadership', 
        'branches', 
        'team', 
        'stats',
        'ppiuInfo'
    ));
    }
}
