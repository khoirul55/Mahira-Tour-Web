@extends('layouts.app')

@section('title', 'Pendaftaran Jamaah - Mahira Tour')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
<link rel="stylesheet" href="https://unpkg.com/aos@2.3.1/dist/aos.css">
@endpush

@section('content')
<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <div class="page-header-content text-center">
            <div class="breadcrumb-custom">
                <a href="{{ route('home') }}"><i class="bi bi-house-door"></i> Beranda</a>
                <span class="mx-2">/</span>
                <span>Pendaftaran</span>
            </div>
            <h1 class="display-3 fw-bold mb-3" data-aos="fade-up">Pendaftaran Jamaah Umrah</h1>
            <p class="lead" data-aos="fade-up" data-aos-delay="100">
                Daftar sekarang, kami akan hubungi Anda dalam 1x24 jam
            </p>
        </div>
    </div>
</section>

<!-- Registration Form with Sidebar -->
<section class="py-5 registration-section">
    <div class="container-fluid px-lg-5">
        
        @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4 success-alert" role="alert">
            <div class="d-flex align-items-center">
                <i class="bi bi-check-circle-fill me-3" style="font-size: 2rem;"></i>
                <div>
                    <strong style="font-size: 1.2rem;">Pendaftaran Berhasil!</strong><br>
                    {{ session('success') }}
                </div>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
        
        <div class="row g-4">
            
            <!-- 🎨 SIDEBAR KIRI: Package Info -->
            <div class="col-lg-4">
                <div class="sidebar-sticky">
                    
                    <!-- Flyer Display -->
                    <div class="flyer-preview-card" id="flyerPreview">
                        <div class="flyer-header">
                            <span class="flyer-badge">Paket Terpilih</span>
                        </div>
                        
                        <!-- Flyer with Lightbox -->
                        <div class="flyer-image-wrapper" id="flyerImageContainer" onclick="openLightbox()">
                            <img id="flyerImage" 
                                 src="{{ isset($selectedSchedule) ? asset('storage/flyers/' . $selectedSchedule['flyer_image']) : asset('images/placeholder-flyer.png') }}" 
                                 alt="Flyer Paket"
                                 class="flyer-img">
                            <div class="flyer-overlay" id="flyerOverlay">
                                <i class="bi bi-box-seam"></i>
                                <p>Pilih paket untuk melihat detail</p>
                            </div>
                            <div class="flyer-zoom-hint">
                                <i class="bi bi-zoom-in"></i> Klik untuk perbesar
                            </div>
                        </div>
                        
                        <h4 class="package-name" id="packageNameDisplay">
                            {{ isset($selectedSchedule) ? $selectedSchedule['package_name'] : 'Belum Dipilih' }}
                        </h4>
                        
                        <!-- Quick Info (Always Visible) -->
                        <div class="quick-info" id="quickInfo" style="display: none;">
                            <div class="quick-info-item">
                                <i class="bi bi-calendar-check"></i>
                                <div>
                                    <small>Keberangkatan</small>
                                    <strong id="quickDepart">-</strong>
                                </div>
                            </div>
                            <div class="quick-info-item">
                                <i class="bi bi-airplane-fill"></i>
                                <div>
                                    <small>Maskapai</small>
                                    <strong id="quickAirline">-</strong>
                                </div>
                            </div>
                            <div class="quick-info-item highlight">
                                <i class="bi bi-tag-fill"></i>
                                <div>
                                    <small>Harga Paket</small>
                                    <strong id="quickPrice" class="text-gold">-</strong>
                                </div>
                            </div>
                            <div class="quick-info-item">
                                <i class="bi bi-people-fill"></i>
                                <div>
                                    <small>Ketersediaan</small>
                                    <strong id="quickQuota">-</strong>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Accordion Details (Collapsed by default) -->
                        <div class="accordion accordion-flush" id="packageAccordion" style="display: none;">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#detailFasilitas">
                                        <i class="bi bi-list-check me-2"></i> Lihat Semua Fasilitas
                                    </button>
                                </h2>
                                <div id="detailFasilitas" class="accordion-collapse collapse" data-bs-parent="#packageAccordion">
                                    <div class="accordion-body">
                                        <ul class="facility-list" id="facilityList">
                                            <li>Pilih paket untuk melihat fasilitas</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Contact CTA -->
                        <div class="sidebar-cta">
                            <a href="https://wa.me/6282184515310?text=Assalamualaikum,%20saya%20ingin%20konsultasi%20paket%20umrah" target="_blank" class="btn-wa-sidebar">
                                <i class="bi bi-whatsapp"></i>
                                Konsultasi via WhatsApp
                            </a>
                        </div>
                        
                    </div>
                    
                </div>
            </div>
            
            <!-- 📝 FORM KANAN -->
            <div class="col-lg-8">
                <div class="form-modern-card" data-aos="fade-up">
                    
                    <form action="{{ route('register.submit') }}" method="POST" id="registrationForm">
                        @csrf
                        
                        <!-- Progress Indicator -->
                        <div class="progress-steps">
                            <div class="step-item active completed" data-step="1">
                                <div class="step-circle">
                                    <i class="bi bi-check-lg step-check"></i>
                                    <span class="step-number">1</span>
                                </div>
                                <span>Pilih Paket</span>
                            </div>
                            <div class="step-line"></div>
                            <div class="step-item" data-step="2">
                                <div class="step-circle">
                                    <i class="bi bi-check-lg step-check"></i>
                                    <span class="step-number">2</span>
                                </div>
                                <span>Data Pribadi</span>
                            </div>
                        </div>
                        
                        <!-- STEP 1 -->
                        <div id="step1" class="form-step active">
                            
                            <div class="step-header">
                                <h3><i class="bi bi-box-seam"></i> Pilih Paket Umrah</h3>
                                <p>Pilih paket yang sesuai dengan kebutuhan spiritual Anda</p>
                            </div>
                            
                            <div class="form-group-modern">
                                <label>Paket Umrah <span class="required">*</span></label>
                                <div class="select-wrapper">
                                    <select class="form-select-modern" name="package_id" id="packageSelect" required 
                                            {{ isset($selectedSchedule) ? 'disabled' : '' }}
                                            onchange="loadPackageDetails(this.value)">
                                        <option value="">-- Pilih Paket Umrah --</option>
                                        @foreach($packages as $id => $package)
                                        <option value="{{ $id }}" 
                                            {{ (isset($selectedSchedule) && $selectedSchedule['id'] == $id) || old('package_id') == $id ? 'selected' : '' }}>
                                            {{ $package }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <div class="loading-spinner" id="loadingSpinner">
                                        <div class="spinner"></div>
                                    </div>
                                </div>
                                @if(isset($selectedSchedule))
                                <input type="hidden" name="package_id" value="{{ $selectedSchedule['id'] }}">
                                <input type="hidden" name="schedule_id" value="{{ $selectedSchedule['id'] }}">
                                <input type="hidden" name="departure_route" value="{{ $selectedSchedule['departure_route'] }}">
                                <input type="hidden" name="departure_date" value="{{ $selectedSchedule['departure_date'] }}">
                                @endif
                            </div>
                            
                            <!-- Additional Fields -->
                            <div id="additionalFields" style="{{ isset($selectedSchedule) ? 'display: none;' : '' }}">
                                <div class="row g-3">
                                    <div class="col-md-4">
                                        <div class="form-group-modern">
                                            <label>Jalur Keberangkatan <span class="required">*</span></label>
                                            <select class="form-select-modern" name="departure_route" {{ isset($selectedSchedule) ? 'disabled' : 'required' }}>
                                                <option value="">Pilih Jalur</option>
                                                @foreach($departure_routes as $route)
                                                <option value="{{ $route }}">{{ $route }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group-modern">
                                            <label>Tanggal Keberangkatan <span class="required">*</span></label>
                                            <input type="date" class="form-control-modern" name="departure_date" 
                                                   min="{{ date('Y-m-d') }}" {{ isset($selectedSchedule) ? 'readonly' : 'required' }}>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group-modern">
                                            <label>Jumlah Jamaah <span class="required">*</span>
                                                <span class="tooltip-icon" data-bs-toggle="tooltip" title="Maksimal 10 orang per booking">ⓘ</span>
                                            </label>
                                            <input type="number" class="form-control-modern" name="num_people" 
                                                   min="1" max="10" value="1" required>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-actions">
                                <button type="button" class="btn-next-modern" id="btnNext" onclick="nextStep()" disabled>
                                    Lanjut ke Data Pribadi <i class="bi bi-arrow-right"></i>
                                </button>
                            </div>
                            
                        </div>
                        
                        <!-- STEP 2 -->
                        <div id="step2" class="form-step">
                            
                            <div class="step-header">
                                <h3><i class="bi bi-person-circle"></i> Data Pribadi</h3>
                                <p>Isi data dengan lengkap dan benar sesuai identitas</p>
                            </div>
                            
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <div class="form-group-modern">
                                        <label>Gelar <span class="required">*</span></label>
                                        <select class="form-select-modern" name="title" required>
                                            <option value="">Pilih</option>
                                            @foreach($titles as $title)
                                            <option value="{{ $title }}">{{ $title }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="form-group-modern">
                                        <label>Nama Lengkap <span class="required">*</span></label>
                                        <input type="text" class="form-control-modern" name="full_name" 
                                               placeholder="Sesuai KTP/Paspor" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-group-modern">
                                        <label>Email <span class="required">*</span></label>
                                        <div class="input-with-icon">
                                            <input type="email" class="form-control-modern" name="email" id="emailInput"
                                                   placeholder="contoh@email.com" required>
                                            <span class="input-icon" id="emailIcon"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-modern">
                                        <label>No. WhatsApp <span class="required">*</span></label>
                                        <div class="input-with-icon">
                                            <input type="tel" class="form-control-modern" name="phone" id="phoneInput"
                                                   placeholder="08xxxxxxxxxx" required>
                                            <span class="input-icon" id="phoneIcon"></span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group-modern">
                                <label>Alamat Lengkap</label>
                                <textarea class="form-control-modern" name="address" rows="3" 
                                          placeholder="Alamat sesuai KTP"></textarea>
                            </div>
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-group-modern">
                                        <label>Provinsi</label>
                                        <select class="form-select-modern" name="province">
                                            <option value="">Pilih Provinsi</option>
                                            @foreach($provinces as $province)
                                            <option value="{{ $province }}">{{ $province }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-modern">
                                        <label>Kota/Kabupaten</label>
                                        <input type="text" class="form-control-modern" name="city" 
                                               placeholder="Nama Kota/Kabupaten">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group-modern">
                                <label>Catatan Tambahan</label>
                                <textarea class="form-control-modern" name="message" rows="3" 
                                          placeholder="Pertanyaan atau permintaan khusus (opsional)"></textarea>
                            </div>
                            
                            <div class="terms-box">
                                <input type="checkbox" id="terms" required>
                                <label for="terms">
                                    Saya menyetujui <a href="{{ route('terms') }}" target="_blank">syarat dan ketentuan</a> yang berlaku
                                </label>
                            </div>
                            
                            <div class="form-actions-step2">
                                <button type="button" class="btn-back-modern" onclick="prevStep()">
                                    <i class="bi bi-arrow-left"></i> Kembali
                                </button>
                                <button type="submit" class="btn-submit-modern" id="btnSubmit">
                                    <span class="btn-text">
                                        <i class="bi bi-send"></i> Kirim Pendaftaran
                                    </span>
                                    <span class="btn-loading" style="display: none;">
                                        <span class="spinner-border spinner-border-sm"></span> Mengirim...
                                    </span>
                                </button>
                            </div>
                            
                        </div>
                        
                    </form>
                    
                </div>
            </div>
            
        </div>
    </div>
</section>

<!-- Lightbox Modal -->
<div class="lightbox" id="lightbox" onclick="closeLightbox()">
    <span class="lightbox-close">&times;</span>
    <img class="lightbox-content" id="lightboxImage">
</div>

<!-- Floating WhatsApp Button -->
<a href="https://wa.me/6282184515310?text=Assalamualaikum,%20saya%20ingin%20konsultasi%20paket%20umrah" 
   class="floating-wa" target="_blank">
    <i class="bi bi-whatsapp"></i>
</a>

@endsection

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
AOS.init({ duration: 800, once: true });

// Bootstrap tooltips
const tooltipTriggerList = document.querySelectorAll('[data-bs-toggle="tooltip"]')
const tooltipList = [...tooltipTriggerList].map(tooltipTriggerEl => new bootstrap.Tooltip(tooltipTriggerEl))

const allSchedules = @json($allSchedules);

@if(isset($selectedSchedule))
window.addEventListener('DOMContentLoaded', () => {
    loadPackageDetails({{ $selectedSchedule['id'] }});
});
@endif

function loadPackageDetails(packageId) {
    if (!packageId || !allSchedules[packageId]) {
        resetSidebar();
        document.getElementById('btnNext').disabled = true;
        return;
    }
    
    // Show loading
    document.getElementById('loadingSpinner').style.display = 'flex';
    
    setTimeout(() => {
        const pkg = allSchedules[packageId];
        
        // Update Flyer
        document.getElementById('flyerImage').src = `/storage/flyers/${pkg.flyer_image}`;
        document.getElementById('flyerOverlay').style.display = 'none';
        
        // Update Package Name
        document.getElementById('packageNameDisplay').textContent = pkg.package_name;
        
        // Update Quick Info
        document.getElementById('quickDepart').textContent = formatDate(pkg.departure_date);
        document.getElementById('quickAirline').textContent = pkg.airline;
        document.getElementById('quickPrice').textContent = formatPrice(pkg.price);
        const available = pkg.quota - pkg.seats_taken;
        document.getElementById('quickQuota').textContent = `${available} kursi tersedia`;
        
        // Update Facilities
        const facilityList = document.getElementById('facilityList');
        facilityList.innerHTML = pkg.facilities.map(f => `<li><i class="bi bi-check-circle-fill"></i> ${f}</li>`).join('');
        
        // Show content
        document.getElementById('quickInfo').style.display = 'block';
        document.getElementById('packageAccordion').style.display = 'block';
        document.getElementById('flyerPreview').classList.add('active');
        document.getElementById('loadingSpinner').style.display = 'none';
        
        // Enable next button
        document.getElementById('btnNext').disabled = false;
    }, 500);
}

function resetSidebar() {
    document.getElementById('flyerOverlay').style.display = 'flex';
    document.getElementById('packageNameDisplay').textContent = 'Belum Dipilih';
    document.getElementById('quickInfo').style.display = 'none';
    document.getElementById('packageAccordion').style.display = 'none';
    document.getElementById('flyerPreview').classList.remove('active');
}

function nextStep() {
    const packageId = document.getElementById('packageSelect').value;
    if (!packageId) {
        alert('Silakan pilih paket terlebih dahulu');
        return;
    }
    
    document.getElementById('step1').classList.remove('active');
    document.getElementById('step2').classList.add('active');
    
    document.querySelector('[data-step="1"]').classList.add('completed');
    document.querySelector('[data-step="2"]').classList.add('active');
    
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function prevStep() {
    document.getElementById('step2').classList.remove('active');
    document.getElementById('step1').classList.add('active');
    
    document.querySelector('[data-step="2"]').classList.remove('active');
    document.querySelector('[data-step="1"]').classList.remove('completed');
    
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

// Inline validation
document.getElementById('emailInput')?.addEventListener('input', function(e) {
    const icon = document.getElementById('emailIcon');
    const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    
    if (emailRegex.test(e.target.value)) {
        icon.innerHTML = '<i class="bi bi-check-circle-fill text-success"></i>';
    } else if (e.target.value.length > 0) {
        icon.innerHTML = '<i class="bi bi-x-circle-fill text-danger"></i>';
    } else {
        icon.innerHTML = '';
    }
});

document.getElementById('phoneInput')?.addEventListener('input', function(e) {
    const icon = document.getElementById('phoneIcon');
    let value = e.target.value.replace(/\D/g, '');
    
    // Auto-format: 0821 8451 5310
    if (value.length > 4) {
        value = value.slice(0, 4) + ' ' + value.slice(4);
    }
    if (value.length > 9) {
        value = value.slice(0, 9) + ' ' + value.slice(9, 13);
    }
    e.target.value = value;
    
    if (value.replace(/\s/g, '').length >= 10) {
        icon.innerHTML = '<i class="bi bi-check-circle-fill text-success"></i>';
    } else if (value.length > 0) {
        icon.innerHTML = '<i class="bi bi-x-circle-fill text-danger"></i>';
    } else {
        icon.innerHTML = '';
    }
});

// Submit loading state
document.getElementById('registrationForm').addEventListener('submit', function() {
    const btn = document.getElementById('btnSubmit');
    btn.querySelector('.btn-text').style.display = 'none';
    btn.querySelector('.btn-loading').style.display = 'inline-block';
    btn.disabled = true;
});

// Lightbox functions
function openLightbox() {
    const imgSrc = document.getElementById('flyerImage').src;
    if (!imgSrc.includes('placeholder')) {
        document.getElementById('lightboxImage').src = imgSrc;
        document.getElementById('lightbox').style.display = 'flex';
    }
}

function closeLightbox() {
    document.getElementById('lightbox').style.display = 'none';
}

function formatDate(dateStr) {
    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
    const d = new Date(dateStr);
    return `${d.getDate()} ${months[d.getMonth()]} ${d.getFullYear()}`;
}

function formatPrice(price) {
    return 'Rp ' + price.toLocaleString('id-ID');
}
</script>
@endpush