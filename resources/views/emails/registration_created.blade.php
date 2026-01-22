<!DOCTYPE html>
<html>
<head>
    <title>Pendaftaran Berhasil</title>
</head>
<body style="font-family: Arial, sans-serif; line-height: 1.6; color: #333;">
    <div style="max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 10px;">
        <h2 style="color: #001D5F;">Terima Kasih, {{ $registration->full_name }}!</h2>
        <p>Alhamdulillah, pendaftaran Umrah Anda telah berhasil kami terima.</p>
        
        <table style="width: 100%; margin-bottom: 20px;">
            <tr>
                <td><strong>No. Registrasi:</strong></td>
                <td>{{ $registration->registration_number }}</td>
            </tr>
            <tr>
                <td><strong>Paket:</strong></td>
                <td>{{ $registration->schedule->package_name }}</td>
            </tr>
            <tr>
                <td><strong>Jamaah:</strong></td>
                <td>{{ $registration->num_people }} Orang</td>
            </tr>
        </table>
        
        <p>Silakan akses dashboard Anda untuk melengkapi data jamaah dan upload bukti pembayaran (DP).</p>
        
        <div style="text-align: center; margin: 30px 0;">
            <a href="{{ $dashboardUrl }}" style="background-color: #10B981; color: white; padding: 12px 24px; text-decoration: none; border-radius: 5px; font-weight: bold;">Akses Dashboard</a>
        </div>
        
        <p>Jika tombol di atas tidak berfungsi, silakan copy link berikut:</p>
        <p><a href="{{ $dashboardUrl }}">{{ $dashboardUrl }}</a></p>
        
        <hr style="border: 0; border-top: 1px solid #eee; margin: 20px 0;">
        
        <p style="font-size: 0.9em; color: #666;">
            <strong>Mahira Tour & Travel</strong><br>
            Melayani dengan Hati, Membimbing dengan Ilmu.
        </p>
    </div>
</body>
</html>
