<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{
     public function index()
    {
 $contactInfo = [
        'office_name' => 'Mahira Tour & Travel',
        'tagline' => 'Umrah Bersama, Berkah Bersama',
        'main_office' => 'Jl. Muradi, Desa Koto Keras, Kecamatan Pesisir Bukit, Kota Sungai Penuh',
        'phone' => '0821 8451 5310',
        'whatsapp' => '6282184515310',
        'website' => 'www.mahiratour.co.id',
        'instagram' => '@mahiratourofficial',
        'facebook' => 'Mahira Umrah',
        'email' => 'info@mahiratour.co.id',
        'hours' => [
            'weekday' => 'Senin - Jumat: 08.00 - 17.00 WIB',
            'saturday' => 'Sabtu: 08.00 - 14.00 WIB',
            'sunday' => 'Minggu: Libur'
        ]
    ];
    
    $branches = [
        [
            'name' => 'Kantor Pusat',
            'city' => 'Sungai Penuh',
            'address' => 'Jl. Muradi, Desa Koto Keras, Kec. Pesisir Bukit',
            'phone' => '0821 8451 5310'
        ],
        [
            'name' => 'Regional Sumatera Barat',
            'city' => 'Padang',
            'address' => 'Jl. Raya Taruko 1 / Manunggal 3 No 66 A, RT 5 RW 8, Korong Gadang, Kec. Kuranji',
            'phone' => '-'
        ],
        [
            'name' => 'Cabang Jambi',
            'city' => 'Jambi',
            'address' => 'Jl. Sunan Gunung Djati RT.28, Kenali Asam, Kota Baru',
            'phone' => '-'
        ],
        [
            'name' => 'Cabang Jakarta',
            'city' => 'Jakarta Timur',
            'address' => 'Jl. Tegal Amba No 6, Desa Lorong Sawit, Kec. Lorong Sawit',
            'phone' => '-'
        ],
        [
            'name' => 'Cabang Padang Utara',
            'city' => 'Padang',
            'address' => 'Jl. Pategangan, Gang L No. 4, RT. 004, RW. 003, Air Tawar Barat',
            'phone' => '-'
        ],
        [
            'name' => 'Cabang Bengkulu',
            'city' => 'Bengkulu',
            'address' => 'Jl. Sutoyo 6, Kelurahan Tanah Patah, Kec. Ratu Agung, RW. 02, RT. 19, No. 72',
            'phone' => '-'
        ],
        [
            'name' => 'Cabang Merangin',
            'city' => 'Merangin',
            'address' => 'Muara Panco Barat, Kec. Renah Pembarap',
            'phone' => '-'
        ]
    ];
    
    $socialMedia = [
        'facebook' => 'https://facebook.com/MahiraUmrah',
        'instagram' => 'https://instagram.com/mahiratourofficial',
        'whatsapp' => 'https://wa.me/6282184515310'
    ];
    
    return view('pages.contact', compact('contactInfo', 'branches', 'socialMedia'));
    }
  /**
     * Handle contact form submission
     * TODO: Simpan ke database dan kirim email setelah setup
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'name' => 'required|string|min:3|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|min:10|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|min:10|max:2000'
        ], [
            // Custom error messages
            'name.required' => 'Nama harus diisi',
            'name.min' => 'Nama minimal 3 karakter',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Format email tidak valid',
            'phone.required' => 'Nomor telepon harus diisi',
            'phone.min' => 'Nomor telepon minimal 10 digit',
            'subject.required' => 'Subjek harus diisi',
            'message.required' => 'Pesan harus diisi',
            'message.min' => 'Pesan minimal 10 karakter',
            'message.max' => 'Pesan maksimal 2000 karakter'
        ]);
        
        // TODO: Simpan ke database
        // Contoh struktur untuk save nanti:
        /*
        $contact = Contact::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'subject' => $validated['subject'],
            'message' => $validated['message'],
            'status' => 'unread', // unread, read, replied
            'created_at' => now()
        ]);
        */
        
        // TODO: Kirim email notifikasi ke admin
        // Mail::to('admin@mahiratour.co.id')->send(new ContactFormMail($validated));
        
        // TODO: Kirim auto-reply ke customer
        // Mail::to($validated['email'])->send(new ContactAutoReplyMail($validated));
        
        // Sementara simpan ke session untuk development
        session()->flash('contact_data', $validated);
        
        // Redirect dengan pesan sukses
        return redirect()->route('contact')
            ->with('success', 
                'Terima kasih! Pesan Anda telah terkirim. Tim Mahira Tour akan segera menghubungi Anda.'
            );
    }
}
