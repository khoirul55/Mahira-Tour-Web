<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; line-height: 1.6; }
        .box { padding: 20px; border: 1px solid #ddd; background: #f9f9f9; }
    </style>
</head>
<body>
    <h3>Notifikasi Subscriber Baru</h3>
    <div class="box">
        <p>Halo Admin,</p>
        <p>Ada pengguna baru yang berlangganan newsletter website Mahiratour.id:</p>
        <p><strong>Email:</strong> {{ $email }}</p>
        <p><strong>Waktu:</strong> {{ now()->format('d M Y H:i') }}</p>
    </div>
    <p>Silakan cek database untuk daftar lengkap.</p>
</body>
</html>
