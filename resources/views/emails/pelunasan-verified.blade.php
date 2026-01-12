
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            color: #333;
            max-width: 600px;
            margin: 0 auto;
            padding: 20px;
        }
        .header {
            background: linear-gradient(135deg, #10B981 0%, #059669 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .content {
            background: #f0fdf4;
            padding: 30px;
            border-radius: 0 0 10px 10px;
        }
        .info-box {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #10B981;
        }
        .badge-lunas {
            display: inline-block;
            background: #D1FAE5;
            color: #059669;
            padding: 10px 20px;
            border-radius: 50px;
            font-weight: bold;
            font-size: 1.2em;
            margin: 20px 0;
        }
        .btn {
            display: inline-block;
            padding: 15px 30px;
            background: #10B981;
            color: white;
            text-decoration: none;
            border-radius: 50px;
            font-weight: bold;
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            color: #6B7280;
            font-size: 14px;
        }
        .check-icon {
            font-size: 4em;
            color: #10B981;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="check-icon">✅</div>
        <h1>PEMBAYARAN LUNAS!</h1>
    </div>
    
    <div class="content">
        <p>Assalamualaikum <strong>{{ $registration->full_name }}</strong>,</p>
        
        <p>Alhamdulillah, pembayaran Umrah Anda telah <strong>LUNAS</strong>! 🎉</p>
        
        <center>
            <div class="badge-lunas">💚 STATUS: LUNAS ✅</div>
        </center>
        
        <div class="info-box">
            <strong>📋 Detail Pembayaran:</strong><br>
            <strong>No. Registrasi:</strong> {{ $registration->registration_number }}<br>
            <strong>Paket:</strong> {{ $registration->schedule->package_name }}<br>
            <strong>Total Biaya:</strong> Rp {{ number_format($registration->total_price, 0, ',', '.') }}<br>
            <hr>
            <strong style="color: #10B981; font-size: 1.2em;">✅ LUNAS</strong>
        </div>
        
        <p><strong>📅 Jadwal Keberangkatan:</strong><br>
        {{ $registration->schedule->departure_date->format('d F Y') }}</p>
        
        <p style="background: #D1FAE5; padding: 15px; border-radius: 8px; border: 2px solid #10B981;">
            <strong>Langkah Selanjutnya:</strong><br>
            ✅ Pembayaran selesai<br>
            🔄 Tim kami akan menghubungi untuk persiapan keberangkatan<br>
            📄 Pastikan semua dokumen sudah lengkap
        </p>
        
        <center>
            <a href="{{ $dashboardUrl }}" class="btn">
                📱 Lihat Dashboard Saya
            </a>
        </center>
        
        <p>Jika ada pertanyaan, hubungi kami:<br>
        📞 WhatsApp: 0821-8451-5310<br>
        📧 Email: info@mahiratour.com</p>
        
        <p>Jazakumullah khairan,<br>
        <strong>Tim Mahira Tour</strong></p>
    </div>
    
    <div class="footer">
        <p>© {{ date('Y') }} Mahira Tour. Travel Haji & Umrah Terpercaya.</p>
        <p style="font-size: 12px; color: #9CA3AF;">
            Email ini dikirim otomatis. Jangan balas email ini.
        </p>
    </div>
</body>
</html>