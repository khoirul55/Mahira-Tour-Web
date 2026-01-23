@extends('layouts.app')

@section('title', 'Booking Cepat - Mahira Tour')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/registration.css?v=2.0') }}">
@endpush

@section('content')
<section class="quick-booking-section">
    <div class="container booking-container">
        
        <!-- Header -->
        <div class="booking-header">
            <h1>Formulir Pendaftaran Umrah</h1>
            <p>Amankan kursi keberangkatan Anda dengan mudah dan cepat</p>
        </div>
        
        <!-- Booking Card -->
        <div class="booking-card">
            
            <!-- Error Messages -->
            @if($errors->any())
            <div class="alert-custom alert-danger">
                <strong><i class="bi bi-exclamation-circle"></i> Terjadi Kesalahan:</strong>
                <ul style="margin: 0.5rem 0 0 1.5rem; padding: 0;">
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            
            <!-- Package Summary -->
            @if($selectedSchedule)
            <div class="package-summary">
                <h3>{{ $selectedSchedule['package_name'] }}</h3>
                <div class="package-info">
                    <div class="package-info-item">
                        <i class="bi bi-calendar-check"></i>
                        <span>{{ date('d M Y', strtotime($selectedSchedule['departure_date'])) }}</span>
                    </div>
                    <div class="package-info-item">
                        <i class="bi bi-geo-alt-fill"></i>
                        <span>{{ $selectedSchedule['departure_route'] }}</span>
                    </div>
                    <div class="package-info-item">
                        <i class="bi bi-airplane-fill"></i>
                        <span>{{ $selectedSchedule['airline'] }}</span>
                    </div>
                </div>
                <div class="package-price">
                    Rp {{ number_format($selectedSchedule['price'], 0, ',', '.') }} <small style="font-size: 0.6em; opacity: 0.7;">/ orang</small>
                </div>
            </div>
            @endif
            
            <!-- Form -->
            <form action="{{ route('register.submit') }}" method="POST" id="quickBookingForm">
                @csrf
                
                <!-- Hidden Schedule ID -->
                @if($selectedSchedule)
                    <input type="hidden" name="schedule_id" value="{{ $selectedSchedule['id'] }}">
                @else
                    <!-- Dropdown jika belum pilih paket -->
                    <div class="form-group-quick">
                        <label>Pilih Paket Keberangkatan <span class="required">*</span></label>
                        <select name="schedule_id" class="form-select-quick" required>
                            <option value="">-- Silakan Pilih Paket --</option>
                            @foreach($schedules as $schedule)
                            <option value="{{ $schedule->id }}" {{ old('schedule_id') == $schedule->id ? 'selected' : '' }}>
                                {{ $schedule->package_name }} - Rp {{ number_format($schedule->price, 0, ',', '.') }}
                            </option>
                            @endforeach
                        </select>
                    </div>
                @endif
                
                <!-- Nama Lengkap -->
                <div class="form-group-quick">
                    <label>Nama Lengkap (Sesuai KTP) <span class="required">*</span></label>
                    <input 
                        type="text" 
                        name="full_name" 
                        class="form-control-quick @error('full_name') is-invalid @enderror" 
                        placeholder="Contoh: Siti Aminah"
                        value="{{ old('full_name') }}"
                        required
                        minlength="3"
                    >
                </div>
                
                <!-- No. WhatsApp -->
                <div class="form-group-quick">
                    <label>Nomor WhatsApp Aktif <span class="required">*</span></label>
                    <input 
                        type="tel" 
                        name="phone" 
                        class="form-control-quick @error('phone') is-invalid @enderror" 
                        placeholder="Contoh: 081234567890"
                        value="{{ old('phone') }}"
                        required
                        pattern="08[0-9]{9,11}"
                    >
                    <small style="color: #6B7280; font-size: 0.85rem; margin-top: 0.25rem; display: block;">
                        Masuk tanpa tanda baca atau spasi. Nomor ini akan digunakan untuk login.
                    </small>
                </div>
                
                <!-- Email -->
                <div class="form-group-quick">
                    <label>Alamat Email <span class="required">*</span></label>
                    <input 
                        type="email" 
                        name="email" 
                        class="form-control-quick @error('email') is-invalid @enderror" 
                        placeholder="Contoh: nama@email.com"
                        value="{{ old('email') }}"
                        required
                    >
                </div>
                
                <!-- Jumlah Jamaah -->
                <div class="form-group-quick">
                    <label>Jumlah Jamaah yang Didaftarkan <span class="required">*</span></label>
                    <select name="num_people" class="form-select-quick" required>
                        @for($i = 1; $i <= 10; $i++)
                        <option value="{{ $i }}" {{ old('num_people', 1) == $i ? 'selected' : '' }}>
                            {{ $i }} Orang
                        </option>
                        @endfor
                    </select>
                </div>
                
                <!-- Catatan (Optional) -->
                <div class="form-group-quick">
                    <label>Catatan Tambahan (Opsional)</label>
                    <textarea 
                        name="notes" 
                        class="form-control-quick" 
                        rows="3" 
                        placeholder="Tuliskan permintaan khusus jika ada..."
                    >{{ old('notes') }}</textarea>
                </div>
                
                <!-- Submit Button -->
                <button type="submit" class="btn-booking" id="btnSubmit">
                    Daftar Sekarang <i class="bi bi-arrow-right-circle"></i>
                </button>
                
            </form>
            
            <!-- Info Note -->
            <div class="info-note">
                <i class="bi bi-info-circle-fill"></i>
                <div class="info-note-content">
                    <strong>Langkah Selanjutnya:</strong>
                    <p>
                        Setelah pendaftaran berhasil, Anda akan diarahkan ke Dashboard Jamaah untuk melengkapi data paspor dan mengunggah bukti pembayaran DP.
                    </p>
                </div>
            </div>
            
        </div>
        
    </div>
</section>
@endsection

@push('scripts')
<script>
// Form submit handling
document.getElementById('quickBookingForm').addEventListener('submit', function() {
    const btn = document.getElementById('btnSubmit');
    btn.disabled = true;
    btn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Memproses...';
});

// Phone validation
document.querySelector('input[name="phone"]').addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, ''); // Remove non-digits
    if (value.length > 13) {
        value = value.substring(0, 13);
    }
    e.target.value = value;
});
</script>
@endpush