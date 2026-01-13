<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: Arial, sans-serif; }
        .header { background: #10B981; color: white; padding: 30px; text-align: center; }
        .content { padding: 30px; }
    </style>
</head>
<body>
    <div class="header">
        <h1>✅ DP Diverifikasi!</h1>
    </div>
    <div class="content">
        <p>Assalamualaikum <strong>{{ $registration->full_name }}</strong>,</p>
        <p>DP Anda sebesar <strong>Rp 5.000.000</strong> telah diverifikasi.</p>
        <p><strong>Langkah selanjutnya:</strong></p>
        <ul>
            <li>Lengkapi data jamaah</li>
            <li>Upload dokumen</li>
            <li>Pelunasan H-30 sebelum keberangkatan</li>
        </ul>
        <a href="{{ $dashboardUrl }}" style="display:inline-block;padding:15px 30px;background:#10B981;color:white;text-decoration:none;border-radius:50px;">Buka Dashboard</a>
    </div>
</body>
</html>