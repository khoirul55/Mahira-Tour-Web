<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .header { background: #001D5F; color: white; padding: 30px; text-align: center; }
        .content { padding: 30px; background: #f8f9ff; }
        .info-box { background: white; padding: 20px; border-radius: 8px; margin: 20px 0; border-left: 4px solid #F59E0B; }
        .btn { display: inline-block; padding: 15px 30px; background: #10B981; color: white; text-decoration: none; border-radius: 50px; font-weight: bold; margin: 20px 0; }
        .rekening { background: #FEF3C7; padding: 15px; border-radius: 8px; border: 2px solid #F59E0B; }
    </style>
</head>
<body>
    <div class="header">
        <h1>💰 Tagihan Pelunasan</h1>
    </div>
    
    <div class="content">
        <p>Assalamualaikum <strong>{{ $registration->full_name }}</strong>,</p>
        
        <p>Pendaftaran Umrah Anda sudah memasuki tahap pelunasan.</p>
        
        <div class="info-box">
            <strong>📋 Detail Pembayaran:</strong><br>
            <strong>No. Registrasi:</strong> {{ $registration->registration_number }}<br>
            <strong>Paket:</strong> {{ $registration->schedule->package_name }}<br>
            <strong>Total Biaya:</strong> Rp {{ number_format($registration->total_price, 0, ',', '.') }}<br>
            <strong>DP (Terbayar):</strong> Rp 5.000.000<br>
            <hr>
            <strong style="color: #DC2626;">Sisa Pelunasan:</strong> 
            <strong style="color: #DC2626; font-size: 1.3em;">Rp {{ number_format($sisaPelunasan, 0, ',', '.') }}</strong>
        </div>
        
        <div class="rekening">
            <strong>🏦 Rekening Transfer:</strong><br>
            Bank BCA<br>
            No. Rek: <strong>1234567890</strong><br>
            a.n. <strong>PT Mahira Tour Indonesia</strong>
        </div>
        
        @if($registration->pelunasan_deadline)
            <p><strong>⏰ Deadline Pelunasan:</strong><br>
            <span style="color: #DC2626; font-size: 1.2em;">{{ $registration->pelunasan_deadline->format('d F Y') }}</span><br>
            <small>(H-30 dari keberangkatan)</small></p>
        @else
            <p><strong>⏰ Deadline Pelunasan:</strong><br>
            <span style="color: #DC2626; font-size: 1.2em;">
                {{ $registration->schedule->departure_date->copy()->subDays(30)->format('d F Y') }}
            </span><br>
            <small>(H-30 dari keberangkatan: {{ $registration->schedule->departure_date->format('d F Y') }})</small></p>
        @endif
        
        <center>
            <a href="{{ $dashboardUrl }}" class="btn">
                📱 Upload Bukti Pelunasan
            </a>
        </center>
        
        <p>Jazakumullah khairan,<br>
        <strong>Tim Mahira Tour</strong></p>
    </div>
</body>
</html>