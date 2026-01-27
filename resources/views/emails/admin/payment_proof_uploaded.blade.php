<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; }
        .header { background: #004d40; color: white; padding: 15px; text-align: center; border-radius: 8px 8px 0 0; }
        .content { padding: 20px; }
        .details { background: #f9f9f9; padding: 15px; border-radius: 5px; margin: 15px 0; }
        .btn { display: inline-block; padding: 10px 20px; background: #004d40; color: white; text-decoration: none; border-radius: 5px; font-weight: bold; }
        .footer { text-align: center; font-size: 12px; color: #777; margin-top: 20px; border-top: 1px solid #eee; padding-top: 10px; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>💰 Bukti Pembayaran Baru</h2>
        </div>
        
        <div class="content">
            <p>Halo Admin Mahira Tour,</p>
            <p>Seorang jamaah baru saja mengupload bukti pembayaran. Mohon segera dicek dan diverifikasi.</p>

            <div class="details">
                <p><strong>Nama Jamaah:</strong> {{ $registration->full_name }}</p>
                <p><strong>No. Registrasi:</strong> {{ $registration->registration_number }}</p>
                <p><strong>Jenis Pembayaran:</strong> {{ strtoupper($payment->payment_type) }}</p>
                <p><strong>Nominal (Estimasi):</strong> Rp {{ number_format($payment->amount, 0, ',', '.') }}</p>
                <p><strong>Metode:</strong> {{ ucfirst($payment->payment_method) }}</p>
                <p><strong>Waktu Upload:</strong> {{ $payment->updated_at->format('d M Y H:i') }}</p>
            </div>

            <p>Silakan login ke dashboard admin untuk melihat file bukti transfer:</p>
            <p style="text-align: center;">
                <a href="{{ route('admin.registrations.show', $registration->id) }}" class="btn">Lihat Data & Verifikasi</a>
            </p>
        </div>

        <div class="footer">
            <p>&copy; {{ date('Y') }} Mahira Tour System</p>
        </div>
    </div>
</body>
</html>
