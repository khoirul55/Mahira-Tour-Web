@extends('layouts.app')

@section('title', 'Booking Cepat - Mahira Tour')

@push('styles')
<style>
/* Quick Booking Styles */
.quick-booking-section {
    min-height: 100vh;
    background: linear-gradient(135deg, #001D5F 0%, #002B8F 100%);
    padding: 100px 0;
    position: relative;
    overflow: hidden;
}

.quick-booking-section::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23ffffff" fill-opacity="0.05" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,112C672,96,768,96,864,112C960,128,1056,160,1152,160C1248,160,1344,128,1392,112L1440,96L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') bottom center no-repeat;
    opacity: 0.3;
}

.booking-container {
    max-width: 600px;
    margin: 0 auto;
    position: relative;
    z-index: 1;
}

.booking-header {
    text-align: center;
    color: white;
    margin-bottom: 3rem;
}

.booking-header h1 {
    font-size: 2.5rem;
    font-weight: 800;
    margin-bottom: 1rem;
    text-shadow: 0 2px 10px rgba(0,0,0,0.2);
}

.booking-header p {
    font-size: 1.1rem;
    opacity: 0.9;
}

.booking-card {
    background: white;
    border-radius: 24px;
    padding: 3rem;
    box-shadow: 0 20px 60px rgba(0,0,0,0.3);
}

.package-summary {
    background: linear-gradient(135deg, #F8F9FF 0%, #E8EBF3 100%);
    border-radius: 16px;
    padding: 1.5rem;
    margin-bottom: 2rem;
    border: 2px solid #D4AF37;
}

.package-summary h3 {
    color: #001D5F;
    font-weight: 700;
    font-size: 1.3rem;
    margin-bottom: 1rem;
}

.package-info {
    display: grid;
    gap: 0.5rem;
}

.package-info-item {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    color: #001D5F;
}

.package-info-item i {
    color: #D4AF37;
    width: 20px;
}

.package-price {
    font-size: 1.8rem;
    font-weight: 800;
    color: #D4AF37;
    margin-top: 1rem;
}

.form-group-quick {
    margin-bottom: 1.5rem;
}

.form-group-quick label {
    display: block;
    font-weight: 700;
    color: #001D5F;
    margin-bottom: 0.5rem;
    font-size: 0.95rem;
}

.form-group-quick label .required {
    color: #EF4444;
}

.form-control-quick {
    width: 100%;
    padding: 14px 18px;
    border: 2px solid #E8EBF3;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s;
    font-family: inherit;
}

.form-control-quick:focus {
    outline: none;
    border-color: #001D5F;
    box-shadow: 0 0 0 3px rgba(0, 29, 95, 0.1);
}

.form-control-quick.is-invalid {
    border-color: #EF4444;
}

.form-select-quick {
    width: 100%;
    padding: 14px 18px;
    border: 2px solid #E8EBF3;
    border-radius: 12px;
    font-size: 1rem;
    transition: all 0.3s;
    background: white;
    cursor: pointer;
}

.form-select-quick:focus {
    outline: none;
    border-color: #001D5F;
    box-shadow: 0 0 0 3px rgba(0, 29, 95, 0.1);
}

.btn-booking {
    width: 100%;
    padding: 18px;
    background: linear-gradient(135deg, #10B981 0%, #059669 100%);
    color: white;
    border: none;
    border-radius: 50px;
    font-weight: 700;
    font-size: 1.1rem;
    cursor: pointer;
    transition: all 0.3s;
    box-shadow: 0 10px 30px rgba(16, 185, 129, 0.3);
}

.btn-booking:hover {
    transform: translateY(-2px);
    box-shadow: 0 15px 40px rgba(16, 185, 129, 0.4);
}

.btn-booking:disabled {
    opacity: 0.6;
    cursor: not-allowed;
}

.info-note {
    background: #FEF3C7;
    border: 2px solid #F59E0B;
    border-radius: 12px;
    padding: 1rem;
    margin-top: 1.5rem;
    display: flex;
    gap: 1rem;
}

.info-note i {
    color: #F59E0B;
    font-size: 1.5rem;
}

.info-note-content {
    flex: 1;
}

.info-note-content strong {
    color: #001D5F;
    display: block;
    margin-bottom: 0.5rem;
}

.info-note-content p {
    margin: 0;
    color: #6B7280;
    font-size: 0.9rem;
}

.alert-custom {
    padding: 1rem 1.5rem;
    border-radius: 12px;
    margin-bottom: 1.5rem;
}

.alert-danger {
    background: #FEE2E2;
    border: 2px solid #EF4444;
    color: #991B1B;
}

@media (max-width: 768px) {
    .booking-card {
        padding: 2rem 1.5rem;
    }
    
    .booking-header h1 {
        font-size: 2rem;
    }
}
</style>
@endpush

@section('content')
<section class="quick-booking-section">
    <div class="container booking-container">
        
        <!-- Header -->
        <div class="booking-header">
            <h1>🚀 Booking Cepat</h1>
            <p>Amankan slot Anda hanya dalam 30 detik!</p>
        </div>
        
        <!-- Booking Card -->
        <div class="booking-card">
            
            <!-- Error Messages -->
            @if($errors->any())
            <div class="alert-custom alert-danger">
                <strong>⚠️ Terjadi Kesalahan:</strong>
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
                <h3>📦 {{ $selectedSchedule['package_name'] }}</h3>
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
                        <label>Pilih Paket <span class="required">*</span></label>
                        <select name="schedule_id" class="form-select-quick" required>
                            <option value="">-- Pilih Paket Umrah --</option>
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
                    <label>Nama Lengkap <span class="required">*</span></label>
                    <input 
                        type="text" 
                        name="full_name" 
                        class="form-control-quick @error('full_name') is-invalid @enderror" 
                        placeholder="Contoh: Ibu Siti Aminah"
                        value="{{ old('full_name') }}"
                        required
                        minlength="3"
                    >
                </div>
                
                <!-- No. WhatsApp -->
                <div class="form-group-quick">
                    <label>No. WhatsApp <span class="required">*</span></label>
                    <input 
                        type="tel" 
                        name="phone" 
                        class="form-control-quick @error('phone') is-invalid @enderror" 
                        placeholder="Contoh: 082184515310"
                        value="{{ old('phone') }}"
                        required
                        pattern="08[0-9]{9,11}"
                    >
                    <small style="color: #6B7280; font-size: 0.85rem; margin-top: 0.25rem; display: block;">
                        Format: 08xxxxxxxxxx (tanpa +62 atau 62)
                    </small>
                </div>
                
                <!-- Email -->
                <div class="form-group-quick">
                    <label>Email <span class="required">*</span></label>
                    <input 
                        type="email" 
                        name="email" 
                        class="form-control-quick @error('email') is-invalid @enderror" 
                        placeholder="Contoh: siti@email.com"
                        value="{{ old('email') }}"
                        required
                    >
                </div>
                
                <!-- Jumlah Jamaah -->
                <div class="form-group-quick">
                    <label>Jumlah Jamaah <span class="required">*</span></label>
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
                    <label>Catatan / Pertanyaan (Opsional)</label>
                    <textarea 
                        name="notes" 
                        class="form-control-quick" 
                        rows="3" 
                        placeholder="Contoh: Saya ingin kamar dekat Masjid"
                    >{{ old('notes') }}</textarea>
                </div>
                
                <!-- Submit Button -->
                <button type="submit" class="btn-booking" id="btnSubmit">
                    <i class="bi bi-rocket-takeoff"></i> Booking Sekarang
                </button>
                
            </form>
            
            <!-- Info Note -->
            <div class="info-note">
                <i class="bi bi-info-circle-fill"></i>
                <div class="info-note-content">
                    <strong>Yang Terjadi Selanjutnya:</strong>
                    <p>
                        Setelah booking, Anda akan diarahkan ke dashboard pribadi untuk melengkapi data jamaah, upload DP, dan dokumen. Link dashboard juga akan kami kirim via WhatsApp.
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