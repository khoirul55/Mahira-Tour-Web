<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TestimonialController extends Controller
{
     public function index()
    {
        $testimonials = [
            [
                'name' => 'Hj. Rosidah & Suami',
                'location' => 'Jambi',
                'package' => 'Paket Umrah 12 Hari',
                'rating' => 5,
                'comment' => 'Awalnya deg-degan karena ini umrah pertama saya dan suami. Tapi MasyaAllah, tim Mahira bener-bener nuntun dari nol. Pas manasik dijelasin detail banget, jadi di sana nggak bingung. Yang paling berkesan itu Ustadz pembimbingnya sabar banget nungguin kita yang jalannya pelan. Hotelnya juga beneran deket, keluar lobi langsung pelataran masjid. Alhamdulillah...',
                'date' => '2025-01-15',
                'image' => asset('storage/gallery/jamaah1.webp'),
            ],
            [
                'name' => 'Pak Dedi Susanto',
                'location' => 'Padang',
                'package' => 'Paket Umrah Plus Turki',
                'rating' => 5,
                'comment' => 'Jujur saya pilih Mahira karena harganya masuk akal dibanding travel lain. Ternyata fasilitasnya di luar ekspektasi. Makanan kateringnya lidah Indonesia banget (rendangnya mantap!), jadi nggak pusing mikirin makan. Pas di Turki juga hotelnya bagus. Cuma saran aja, waktu belanja di Madinah mungkin bisa diperlama dikit hehe. Recommended!',
                'date' => '2024-12-20',
                'image' => asset('storage/gallery/jamaah2.webp'),
            ],
            [
                'name' => 'Ibu Marlina',
                'location' => 'Kerinci',
                'package' => 'Paket Umrah VIP',
                'rating' => 5,
                'comment' => 'Baru kali ini ngerasain umrah senyaman ini. Busnya bagus AC dingin, koper diurusin tim handling jadi kita tinggal bawa badan aja masuk hotel. Buat yang bawa orang tua sepuh, Mahira sangat saya rekomendasikan karena pelayanan kursi rodanya sigap banget. Terima kasih Mahira Tour, semoga makin berkah.',
                'date' => '2024-11-05',
                'image' => asset('storage/gallery/jamaah3.webp'),
            ],
            [
                'name' => 'Keluarga Besar Bpk. Irawan',
                'location' => 'Pekanbaru',
                'package' => 'Paket Private Group',
                'rating' => 5,
                'comment' => 'Kami berangkat sekeluarga 7 orang, request kamar connecting, Alhamdulillah diusahakan sama adminnya. Respon admin WA pas pendaftaran cepet banget, pagi buta pun dibalas. Pas di Mekkah, muthawwifnya anak muda tapi ilmunya MasyaAllah, bacaan doanya bikin nangis. InsyaAllah tahun depan nabung lagi buat haji.',
                'date' => '2024-10-12',
                'image' => asset('storage/gallery/jamaah1.webp'),
            ],
            [
                'name' => 'Siti Aminah',
                'location' => 'Bungo',
                'package' => 'Paket Umrah Hemat',
                'rating' => 4,
                'comment' => 'Alhamdulillah lancar ibadahnya. Walaupun ambil paket hemat, tapi fasilitas tetep oke kok. Jarak hotel lumayan untuk jalan kaki sehat, tapi aksesnya gampang. Pembimbing perempuannya ramah banget, enak diajak curhat masalah fiqih wanita. Minus dikit di pesawat delay, tapi itu kan dari maskapainya ya, bukan travelnya.',
                'date' => '2024-09-28',
                'image' => asset('storage/gallery/jamaah2.webp'),
            ],
            [
                'name' => 'H. Zulkifli',
                'location' => 'Muara Tebo',
                'package' => 'Paket Umrah Ramadhan',
                'rating' => 5,
                'comment' => 'Moment berbuka puasa di Masjid Nabawi bareng rombongan Mahira itu nggak bakal terlupakan. Terharu banget. Tim Mahira gercep nyariin spot buat kita. Handling koper pas pulang juga rapi, air zam-zam aman sampe rumah. Sukses terus buat Mahira Tour.',
                'date' => '2024-04-10',
                'image' => asset('storage/gallery/jamaah3.webp'),
            ]
        ];
    
    return view('pages.testimonials', compact('testimonials'));
    }
}
