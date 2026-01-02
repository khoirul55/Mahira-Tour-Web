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
        ['name' => 'Nadirman Hamdan', 'position' => 'Komisaris']
    ];
    
    $branches = [
        [
            'name' => 'Kantor Pusat',
            'region' => 'Sungai Penuh',
            'address' => 'Jl. Muradi, Desa Koto Keras, Kecamatan Pesisir Bukit, Kota Sungai Penuh',
            'is_main' => true
        ],
        [
            'name' => 'Regional Sumatera Barat',
            'region' => 'Padang',
            'address' => 'Jl. Raya Taruko 1 / Manunggal 3 No 66 A, RT 5 RW 8, Korong Gadang, Kec. Kuranji',
            'is_main' => false
        ],
        [
            'name' => 'Cabang Jambi',
            'region' => 'Jambi',
            'address' => 'Jl. Sunan Gunung Djati RT.28, Kenali Asam, Kota Baru, Jambi',
            'is_main' => false
        ],
        [
            'name' => 'Cabang Jakarta Timur',
            'region' => 'Jakarta',
            'address' => 'Jl. Tegal Amba No 6, Desa Lorong Sawit, Kec. Lorong Sawit, Jakarta Timur',
            'is_main' => false
        ],
        [
            'name' => 'Cabang Padang Utara',
            'region' => 'Padang',
            'address' => 'Jl. Pategangan, Gang L No. 4, RT. 004, RW. 003, Air Tawar Barat, Padang Utara',
            'is_main' => false
        ],
        [
            'name' => 'Cabang Bengkulu',
            'region' => 'Bengkulu',
            'address' => 'Jl. Sutoyo 6, Kelurahan Tanah Patah, Kec. Ratu Agung, Kota Bengkulu, RW. 02, RT. 19, No. 72',
            'is_main' => false
        ],
        [
            'name' => 'Cabang Merangin',
            'region' => 'Merangin',
            'address' => 'Muara Panco Barat, Kec. Renah Pembarap, Kabupaten Merangin',
            'is_main' => false
        ]
    ];
    
    return view('pages.about', compact('companyInfo', 'visionMission', 'leadership', 'branches'));
    }
}
