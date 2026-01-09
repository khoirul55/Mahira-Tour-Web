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
            background: linear-gradient(135deg, #001D5F 0%, #002B8F 100%);
            color: white;
            padding: 30px;
            text-align: center;
            border-radius: 10px 10px 0 0;
        }
        .content {
            background: #f8f9ff;
            padding: 30px;
            border-radius: 0 0 10px 10px;
        }
        .info-box {
            background: white;
            padding: 20px;
            border-radius: 8px;
            margin: 20px 0;
            border-left: 4px solid #D4AF37;
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
    </style>
</head>
<body>
    <div class="header">
        <h1>🎉 Pendaftaran Berhasil!</h1>
    </div>
    
    <div class="content">
        <p>Assalamualaikum <strong>{{ $registration->full_name }}</strong>,</p>
        
        <p>Alhamdulillah, pendaftaran Umrah Anda telah berhasil diproses!</p>
        
        <div class="info-box">
            <strong>📋 Detail Pendaftaran:</strong><br>
            <strong>Nomor Registrasi:</strong> {{ $registration->registration_number }}<br>
            <strong>Paket:</strong> {{ $registration->schedule->package_name }}<br>
            <strong>Jumlah Jamaah:</strong> {{ $registration->num_people }} orang<br>
            <strong>Total Biaya:</strong> Rp {{ number_format($registration->total_price, 0, ',', '.') }}<br>
            <strong>DP (30%):</strong> Rp {{ number_format($registration->dp_amount, 0, ',', '.') }}
        </div>
        
        <p><strong>🔐 Akses Dashboard Anda:</strong></p>
        <p>Gunakan link di bawah untuk melengkapi data jamaah, upload DP, dan dokumen:</p>
        
        <center>
            <a href="{{ $dashboardUrl }}" class="btn">
                📱 Buka Dashboard Saya
            </a>
        </center>
        
        <p style="background: #FEF3C7; padding: 15px; border-radius: 8px; border: 2px solid #F59E0B;">
            <strong>⚠️ PENTING:</strong><br>
            • Simpan email ini dengan baik<br>
            • Link dashboard berlaku selamanya<br>
            • Deadline upload DP: <strong>{{ $registration->payment_deadline->format('d M Y') }}</strong>
        </p>
        
        <p>Jika ada pertanyaan, hubungi kami:</p>
        <p>
            📞 WhatsApp: 0821-8451-5310<br>
            📧 Email: info@mahiratour.com
        </p>
        
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