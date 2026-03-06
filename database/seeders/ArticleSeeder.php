<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\ArticleCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Carbon\Carbon;

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $categories = ArticleCategory::pluck('id', 'slug');

        $articles = [
            // ===== KATEGORI: Info Umrah =====
            [
                'title' => 'Panduan Lengkap Persiapan Umrah untuk Pemula',
                'excerpt' => 'Persiapan umrah yang matang akan membuat ibadah Anda lebih khusyuk dan bermakna. Simak panduan lengkap dari dokumen perjalanan hingga perlengkapan yang wajib dibawa.',
                'body' => '
<h2>Mempersiapkan Umrah dengan Baik</h2>
<p>Umrah merupakan ibadah yang sangat dirindukan oleh setiap muslim. Agar perjalanan ibadah Anda berjalan lancar dan penuh berkah, diperlukan persiapan yang matang sejak jauh-jauh hari.</p>

<h3>1. Dokumen Perjalanan</h3>
<p>Pastikan dokumen-dokumen berikut sudah siap minimal 3 bulan sebelum keberangkatan:</p>
<ul>
<li><strong>Paspor</strong> — minimal berlaku 7 bulan dari tanggal keberangkatan</li>
<li><strong>Visa Umrah</strong> — diurus melalui travel resmi yang berizin Kemenag</li>
<li><strong>Sertifikat Vaksin Meningitis</strong> — wajib untuk masuk Arab Saudi</li>
<li><strong>KTP dan KK</strong> — sebagai dokumen pendukung</li>
</ul>

<h3>2. Persiapan Fisik</h3>
<p>Ibadah umrah membutuhkan stamina yang baik, terutama saat melaksanakan thawaf dan sa\'i. Mulailah rutin berolahraga minimal 1 bulan sebelum keberangkatan:</p>
<ul>
<li>Jalan kaki 30-60 menit setiap hari</li>
<li>Latihan naik turun tangga</li>
<li>Peregangan untuk menjaga fleksibilitas tubuh</li>
</ul>

<h3>3. Persiapan Spiritual</h3>
<p>Tidak kalah penting adalah persiapan spiritual. Perbanyak ibadah sunnah, baca Al-Qur\'an, dan pelajari tata cara umrah yang benar sesuai tuntunan Rasulullah ﷺ.</p>

<blockquote>
"Umrah ke umrah berikutnya adalah penghapus dosa di antara keduanya, dan haji yang mabrur tidak ada balasannya kecuali surga." (HR. Bukhari & Muslim)
</blockquote>

<h3>4. Perlengkapan yang Wajib Dibawa</h3>
<p>Berikut daftar perlengkapan yang sebaiknya Anda siapkan:</p>
<ul>
<li>Pakaian ihram (2 set untuk pria)</li>
<li>Mukena dan sajadah travel</li>
<li>Obat-obatan pribadi</li>
<li>Sandal yang nyaman untuk jalan jauh</li>
<li>Tas kecil untuk menyimpan dokumen</li>
<li>Charger dan adapter colokan listrik Saudi</li>
</ul>

<h3>5. Pilih Travel Umrah Terpercaya</h3>
<p>Pastikan Anda memilih travel umrah yang memiliki izin resmi PPIU dari Kemenag RI. Mahira Tour dengan nomor PPIU 21062301498960002 siap membantu perjalanan umrah Anda dengan pelayanan terbaik dan bimbingan yang sesuai syariat.</p>
',
                'category_slug' => 'info-umrah',
                'tags' => ['umrah', 'persiapan', 'pemula', 'panduan'],
                'is_featured' => true,
                'status' => 'published',
                'views_count' => 1247,
                'published_at' => Carbon::now()->subDays(3),
            ],

            // ===== KATEGORI: Tips Ibadah =====
            [
                'title' => '7 Doa Mustajab yang Dibaca Saat Thawaf di Ka\'bah',
                'excerpt' => 'Thawaf mengelilingi Ka\'bah adalah momen paling sakral dalam umrah. Berikut 7 doa yang dianjurkan dibaca saat thawaf beserta artinya.',
                'body' => '
<h2>Doa-Doa Saat Thawaf</h2>
<p>Thawaf merupakan salah satu rukun umrah yang dilaksanakan dengan mengelilingi Ka\'bah sebanyak 7 kali putaran. Momen ini adalah waktu yang sangat mustajab untuk berdoa kepada Allah SWT.</p>

<h3>1. Doa Saat Memulai Thawaf</h3>
<p>Ketika memulai dari Hajar Aswad, bacalah:</p>
<blockquote>بِسْمِ اللَّهِ وَاللَّهُ أَكْبَرُ<br>"Dengan nama Allah, dan Allah Maha Besar."</blockquote>

<h3>2. Doa Putaran Pertama</h3>
<p>Perbanyak istighfar dan doa mohon ampunan:</p>
<blockquote>سُبْحَانَ اللَّهِ وَالْحَمْدُ لِلَّهِ وَلَا إِلَهَ إِلَّا اللَّهُ وَاللَّهُ أَكْبَرُ</blockquote>

<h3>3. Doa di Antara Rukun Yamani dan Hajar Aswad</h3>
<p>Rasulullah ﷺ menganjurkan membaca doa berikut di antara Rukun Yamani dan Hajar Aswad:</p>
<blockquote>رَبَّنَا آتِنَا فِي الدُّنْيَا حَسَنَةً وَفِي الْآخِرَةِ حَسَنَةً وَقِنَا عَذَابَ النَّارِ<br>"Ya Tuhan kami, berilah kami kebaikan di dunia dan kebaikan di akhirat, dan lindungilah kami dari azab neraka." (QS. Al-Baqarah: 201)</blockquote>

<h3>Tips Penting Saat Thawaf</h3>
<ul>
<li>Jaga kekhusyukan dan konsentrasi</li>
<li>Tidak perlu berdesak-desakan untuk mencium Hajar Aswad</li>
<li>Boleh berdoa dengan bahasa Indonesia</li>
<li>Jaga wudhu selama thawaf</li>
<li>Shalat 2 rakaat setelah thawaf di belakang Maqam Ibrahim</li>
</ul>
',
                'category_slug' => 'tips-ibadah',
                'tags' => ['thawaf', 'doa', 'kabah', 'ibadah'],
                'is_featured' => false,
                'status' => 'published',
                'views_count' => 892,
                'published_at' => Carbon::now()->subDays(5),
            ],

            // ===== KATEGORI: Berita Mahira =====
            [
                'title' => 'Mahira Tour Berangkatkan 150 Jamaah Umrah Reguler Maret 2026',
                'excerpt' => 'Alhamdulillah, Mahira Tour kembali memberangkatkan rombongan jamaah umrah reguler dengan penerbangan langsung Jakarta-Jeddah.',
                'body' => '
<h2>Keberangkatan Umrah Maret 2026</h2>
<p>Alhamdulillah, pada tanggal 1 Maret 2026, Mahira Tour kembali memberangkatkan 150 jamaah umrah reguler dari Bandara Soekarno-Hatta menuju Jeddah, Arab Saudi.</p>

<p>Keberangkatan kali ini menggunakan penerbangan langsung Garuda Indonesia dengan durasi penerbangan sekitar 9 jam. Jamaah disambut dengan cuaca yang sejuk di Kota Jeddah dengan suhu sekitar 25°C.</p>

<h3>Rangkaian Ibadah</h3>
<p>Selama 9 hari di Tanah Suci, jamaah akan melaksanakan serangkaian ibadah yang telah disusun oleh tim pembimbing Mahira Tour:</p>
<ul>
<li><strong>Hari 1-4:</strong> Umrah dan ibadah di Makkah Al-Mukarramah</li>
<li><strong>Hari 5-8:</strong> Ziarah dan ibadah di Madinah Al-Munawwarah</li>
<li><strong>Hari 9:</strong> Perjalanan pulang ke Indonesia</li>
</ul>

<h3>Testimonial Jamaah</h3>
<p>"Alhamdulillah, pelayanan Mahira Tour sangat memuaskan. Pembimbingnya sabar dan penjelasannya mudah dipahami. Insya Allah tahun depan berangkat lagi bersama Mahira Tour!" — <em>Ibu Siti Aminah, jamaah asal Jakarta</em></p>

<p>Bagi Anda yang ingin bergabung pada keberangkatan berikutnya, silakan hubungi tim Mahira Tour melalui WhatsApp di <strong>0821-8451-5310</strong> atau kunjungi kantor kami di Kota Sungai Penuh, Jambi.</p>
',
                'category_slug' => 'berita-mahira',
                'tags' => ['keberangkatan', 'umrah-reguler', 'maret-2026'],
                'is_featured' => false,
                'status' => 'published',
                'views_count' => 534,
                'published_at' => Carbon::now()->subDays(7),
            ],

            // ===== KATEGORI: Promo & Paket =====
            [
                'title' => 'Promo Paket Umrah Ramadhan 2026 — Diskon Hingga 15%',
                'excerpt' => 'Raih kesempatan ibadah umrah di bulan Ramadhan dengan harga spesial! Dapatkan diskon hingga 15% untuk pendaftaran sebelum 15 Maret 2026.',
                'body' => '
<h2>Umrah Ramadhan 2026 Bersama Mahira Tour</h2>
<p>Bulan Ramadhan adalah waktu yang paling istimewa untuk melaksanakan umrah. Pahala umrah di bulan Ramadhan setara dengan pahala haji bersama Rasulullah ﷺ.</p>

<blockquote>
"Umrah di bulan Ramadhan setara dengan haji bersamaku." (HR. Bukhari & Muslim)
</blockquote>

<h3>Detail Paket Umrah Ramadhan</h3>
<p>Mahira Tour menyediakan paket spesial umrah Ramadhan dengan fasilitas terbaik:</p>

<ul>
<li>✈️ <strong>Penerbangan:</strong> Garuda Indonesia / Saudia Airlines (langsung)</li>
<li>🏨 <strong>Hotel Makkah:</strong> Bintang 4, jarak ±300m dari Masjidil Haram</li>
<li>🏨 <strong>Hotel Madinah:</strong> Bintang 4, jarak ±200m dari Masjid Nabawi</li>
<li>🚌 <strong>Transportasi:</strong> Bus VIP full AC</li>
<li>🍽️ <strong>Makan:</strong> 3x sehari (menu Indonesia)</li>
<li>👨‍🏫 <strong>Pembimbing:</strong> Ustadz bersertifikat Kemenag</li>
<li>📋 <strong>Durasi:</strong> 12 hari</li>
</ul>

<h3>Harga Promo</h3>
<p>Manfaatkan diskon <strong>hingga 15%</strong> untuk pendaftaran sebelum <strong>15 Maret 2026</strong>!</p>

<p>Hubungi kami sekarang untuk informasi lebih lanjut dan reservasi tempat. Kuota terbatas!</p>
',
                'category_slug' => 'promo-paket',
                'tags' => ['promo', 'ramadhan', 'diskon', 'paket-umrah'],
                'is_featured' => false,
                'status' => 'published',
                'views_count' => 2103,
                'published_at' => Carbon::now()->subDays(1),
            ],

            // ===== KATEGORI: Kisah Jamaah =====
            [
                'title' => 'Kisah Pak Hasan: Dari Pedagang Kaki Lima Hingga Bisa Berangkat Umrah',
                'excerpt' => 'Kisah inspiratif Pak Hasan, pedagang kaki lima dari Sungai Penuh yang berhasil mewujudkan mimpinya berangkat umrah setelah menabung selama 5 tahun.',
                'body' => '
<h2>Mimpi yang Akhirnya Terwujud</h2>
<p>Pak Hasan (58 tahun) adalah seorang pedagang kaki lima yang berjualan di Pasar Sungai Penuh, Jambi. Setiap hari ia berjualan dari pukul 5 pagi hingga 3 sore, menjual makanan tradisional untuk menghidupi keluarganya.</p>

<p>"Saya sudah lama bermimpi bisa ke Tanah Suci. Setiap kali lihat orang berangkat umrah dari kampung, hati ini selalu bergetar. Tapi dengan penghasilan saya, rasanya mustahil," cerita Pak Hasan.</p>

<h3>Menabung Sedikit Demi Sedikit</h3>
<p>Sejak tahun 2021, Pak Hasan mulai menyisihkan Rp 50.000 setiap hari dari hasil jualannya. Istrinya, Bu Fatimah, turut mendukung dengan menjual kue di rumah.</p>

<p>"Kami berdua bekerja keras. Kadang sehari hanya bisa sisihkan Rp 30.000, tapi kami istiqamah. Kami yakin Allah pasti mudahkan," tambahnya.</p>

<h3>Bertemu Mahira Tour</h3>
<p>Pada akhir 2025, Pak Hasan mendengar tentang Mahira Tour dari tetangganya yang sudah pernah berangkat umrah. Ia memberanikan diri datang ke kantor Mahira Tour untuk konsultasi.</p>

<p>"Tim Mahira Tour sangat ramah. Mereka menjelaskan dengan sabar tentang skema pembayaran yang bisa dicicil. Akhirnya saya mendaftar untuk keberangkatan Maret 2026," kenang Pak Hasan dengan mata berkaca-kaca.</p>

<h3>Momen yang Tak Terlupakan</h3>
<p>Saat pertama kali melihat Ka\'bah, Pak Hasan tidak bisa menahan air mata. "Semua jerih payah selama 5 tahun terbayar sudah. Allah benar-benar Maha Baik," ucapnya.</p>

<blockquote>
"Kalau ada niat yang tulus, Allah pasti bukakan jalan. Saya buktinya. Jangan pernah menyerah untuk bermimpi bisa ke Baitullah." — Pak Hasan
</blockquote>
',
                'category_slug' => 'kisah-jamaah',
                'tags' => ['inspirasi', 'kisah-nyata', 'motivasi'],
                'is_featured' => false,
                'status' => 'published',
                'views_count' => 1856,
                'published_at' => Carbon::now()->subDays(2),
            ],

            // ===== Draft Article =====
            [
                'title' => 'Perbedaan Umrah Reguler dan Umrah Plus: Mana yang Cocok untuk Anda?',
                'excerpt' => 'Bingung memilih antara umrah reguler atau umrah plus? Simak perbedaan keduanya dari segi fasilitas, durasi, dan harga.',
                'body' => '
<h2>Umrah Reguler vs Umrah Plus</h2>
<p>Artikel ini sedang dalam proses penulisan. Stay tuned!</p>
',
                'category_slug' => 'info-umrah',
                'tags' => ['umrah-reguler', 'umrah-plus', 'perbandingan'],
                'is_featured' => false,
                'status' => 'draft',
                'views_count' => 0,
                'published_at' => null,
            ],
        ];

        foreach ($articles as $data) {
            $categoryId = $categories[$data['category_slug']] ?? 1;

            Article::create([
                'title' => $data['title'],
                'slug' => Str::slug($data['title']),
                'excerpt' => $data['excerpt'],
                'body' => trim($data['body']),
                'category_id' => $categoryId,
                'tags' => $data['tags'],
                'is_featured' => $data['is_featured'],
                'status' => $data['status'],
                'views_count' => $data['views_count'],
                'published_at' => $data['published_at'],
                'author_id' => 1,
            ]);
        }

        $this->command->info('✅ 6 sample articles created (5 published + 1 draft)');
    }
}
