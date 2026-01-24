<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; background-color: #f4f4f4; padding: 20px; }
        .container { max-width: 600px; margin: 0 auto; background: #ffffff; padding: 30px; border-radius: 8px; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
        .header { text-align: center; border-bottom: 2px solid #001D5F; padding-bottom: 20px; margin-bottom: 20px; }
        .logo { max-height: 60px; }
        .content { color: #333333; line-height: 1.6; }
        .footer { margin-top: 30px; text-align: center; font-size: 12px; color: #999999; border-top: 1px solid #eeeeee; padding-top: 20px; }
        .btn { display: inline-block; background-color: #D4AF37; color: #ffffff; padding: 10px 20px; text-decoration: none; border-radius: 5px; margin-top: 20px; font-weight: bold; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Selamat Datang!</h2>
        </div>
        <div class="content">
            <p>Assalamu'alaikum Warahmatullahi Wabarakatuh,</p>
            <p>Terima kasih telah berlangganan Newsletter <strong>Mahira Tour</strong>. Anda kini menjadi bagian dari keluarga besar kami.</p>
            <p>Insya Allah, kami akan membagikan informasi bermanfaat seputar:</p>
            <ul>
                <li>Info & Promo Paket Umrah Terbaru</li>
                <li>Tips & Panduan Ibadah di Tanah Suci</li>
                <li>Kabar & Dokumentasi Jamaah</li>
            </ul>
            <p>Semoga niat suci Anda untuk bertamu ke Baitullah dimudahkan oleh Allah SWT.</p>
            
            <div style="text-align: center;">
                <a href="{{ route('home') }}" class="btn">Kunjungi Website Kami</a>
            </div>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Mahira Tour. All rights reserved.</p>
            <p>Jl. Muradi No. 19, Sungai Penuh, Jambi</p>
        </div>
    </div>
</body>
</html>
