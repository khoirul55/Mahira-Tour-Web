<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestimonialController extends Controller
{
     public function index()
    {
 $testimonials = [
        [
            'name' => 'Bapak Ahmad Yani',
            'location' => 'Lampung',
            'package' => 'Paket Umrah Reguler',
            'rating' => 5,
            'comment' => 'Alhamdulillah, pelayanan Mahira Tour sangat memuaskan. Hotel dekat dengan Masjidil Haram, pembimbing sangat ramah dan membantu. Perlengkapan lengkap, semuanya terorganisir dengan baik. Terima kasih Mahira Tour!',
            'date' => '2024-11-15',
            'image' => asset('storage/gallery/jamaah1.webp'),
        ],
        [
            'name' => 'Ibu Siti Fatimah',
            'location' => 'Padang',
            'package' => 'Paket Umrah VIP',
            'rating' => 5,
            'comment' => 'Pengalaman umrah yang luar biasa bersama Mahira Tour. Fasilitas VIP benar-benar premium, hotel sangat dekat dengan Masjidil Haram. Muthawwif sangat sabar dan membantu. Sangat recommended!',
            'date' => '2024-10-20',
            'image' => asset('storage/gallery/jamaah2.webp'),
        ],
        [
            'name' => 'Bapak Abdullah Hasan',
            'location' => 'Jambi',
            'package' => 'Paket Umrah Ramadhan',
            'rating' => 5,
            'comment' => 'Subhanallah, umrah di bulan Ramadhan bersama Mahira Tour sangat berkesan. Sahur dan berbuka bersama, kajian rutin, semuanya teratur. Air zam-zam juga banyak. Jazakumullah khairan!',
            'date' => '2024-09-08',
            'image' => asset('storage/gallery/jamaah3.webp'),
        ],
        [
            'name' => 'Ibu Aminah Zahra',
            'location' => 'Jakarta',
            'package' => 'Paket Umrah Reguler',
            'rating' => 5,
            'comment' => 'Mahira Tour sangat profesional. Dari awal pendaftaran sampai pulang, semuanya lancar. Hotel Al Safwah sangat nyaman, makanan enak, dan tim sangat responsif. Insya Allah akan umrah lagi dengan Mahira Tour.',
            'date' => '2024-08-25',
            'image' => asset('storage/gallery/jamaah1.webp'),
        ],
        [
            'name' => 'Bapak Ridwan Kamil',
            'location' => 'Bengkulu',
            'package' => 'Paket Umrah Reguler',
            'rating' => 4,
            'comment' => 'Pelayanan bagus, harga kompetitif. Bus eksklusif sangat nyaman untuk transportasi. Perlengkapan lengkap semua sudah disediakan. Manasik sebelum berangkat juga sangat membantu. Recommended!',
            'date' => '2024-07-12',
            'image' => asset('storage/gallery/jamaah2.webp'),
        ],
        [
            'name' => 'Ibu Khadijah',
            'location' => 'Lampung',
            'package' => 'Wisata Halal Internasional',
            'rating' => 5,
            'comment' => 'Wisata halal ke Turki sangat menyenangkan! Tour guide ramah dan informatif. Semua tempat yang dikunjungi menarik. Makanan halal semua, hotel nyaman. Terima kasih Mahira Tour untuk pengalaman yang tak terlupakan!',
            'date' => '2024-06-30',
            'image' => asset('storage/gallery/jamaah3.webp'),
        ]
    ];
    
    return view('pages.testimonials', compact('testimonials'));
    }
}
