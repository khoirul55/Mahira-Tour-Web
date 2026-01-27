<!DOCTYPE html>
<html>
<head>
    <style>
        body { font-family: sans-serif; line-height: 1.6; color: #333; }
        .container { max-width: 600px; margin: 0 auto; padding: 20px; border: 1px solid #ddd; border-radius: 8px; }
        .header { background: #D4AF37; color: white; padding: 10px 20px; border-radius: 8px 8px 0 0; }
        .content { padding: 20px; }
        .details { background: #f9f9f9; padding: 15px; border-radius: 5px; margin: 15px 0; }
        .btn { display: inline-block; padding: 10px 20px; background: #000; color: #fff; text-decoration: none; border-radius: 5px; }
        .footer { margin-top: 20px; font-size: 12px; color: #666; text-align: center; }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Pendaftaran Baru Masuk</h2>
        </div>
        <div class="content">
            <p>Halo Admin Mahira Tour,</p>
            <p>Ada pendaftaran baru dari website. Berikut detailnya:</p>
            
            <div class="details">
                <table style="width: 100%;">
                    <tr>
                        <td><strong>No. Registrasi:</strong></td>
                        <td>{{ $registration->registration_number }}</td>
                    </tr>
                    <tr>
                        <td><strong>Nama Jamaah:</strong></td>
                        <td>{{ $registration->full_name }}</td>
                    </tr>
                    <tr>
                        <td><strong>Paket:</strong></td>
                        <td>{{ $registration->schedule->package_name }}</td>
                    </tr>
                    <tr>
                        <td><strong>Keberangkatan:</strong></td>
                        <td>{{ \Carbon\Carbon::parse($registration->schedule->departure_date)->format('d M Y') }}</td>
                    </tr>
                    <tr>
                        <td><strong>Jumlah Pax:</strong></td>
                        <td>{{ $registration->num_people }} Orang</td>
                    </tr>
                    <tr>
                        <td><strong>Total Harga:</strong></td>
                        <td>Rp {{ number_format($registration->total_price, 0, ',', '.') }}</td>
                    </tr>
                     <tr>
                        <td><strong>Nominal DP:</strong></td>
                        <td>Rp {{ number_format($registration->dp_amount, 0, ',', '.') }}</td>
                    </tr>
                </table>
            </div>
            
            <p>Silakan login ke Admin Panel untuk memverifikasi pembayaran DP jika jamaah sudah melakukan transfer.</p>
            
            <p style="text-align: center;">
                <a href="{{ route('admin.registrations.show', $registration->id) }}" class="btn">Lihat Detail Pendaftaran</a>
            </p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Mahira Tour System</p>
        </div>
    </div>
</body>
</html>
