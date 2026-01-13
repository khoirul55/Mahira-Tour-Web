<!-- FILE: resources/views/emails/pelunasan-rejected.blade.php -->
<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { background: #EF4444; color: white; padding: 30px; text-align: center; }
    </style>
</head>
<body>
    <div class="header">
        <h1>⚠️ Bukti Pelunasan Ditolak</h1>
    </div>
    <div style="padding: 30px;">
        <p>Assalamualaikum <strong>{{ $registration->full_name }}</strong>,</p>
        <p>Bukti pelunasan Anda ditolak oleh admin.</p>
        <p><strong>Alasan:</strong> {{ $reason ?? 'Bukti tidak valid' }}</p>
        <p>Silakan upload ulang bukti pembayaran yang benar.</p>
        <a href="{{ $dashboardUrl }}" style="display:inline-block;padding:15px 30px;background:#EF4444;color:white;text-decoration:none;border-radius:50px;">Upload Ulang</a>
    </div>
</body>
</html>