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

<!-- Registration Form -->
<section class="py-5 registration-section">
    <div class="container-fluid px-lg-5">
        
        @if($errors->any())
        <div class="alert alert-danger alert-dismissible fade show mb-4">
            <strong>Error!</strong>
            <ul class="mb-0 mt-2">
                @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        @endif
        
        <div class="row g-4">
            
            <!-- Sidebar -->
            <div class="col-lg-4">
                <div class="sidebar-sticky">
                    <div class="flyer-preview-card" id="flyerPreview">
                        <div class="flyer-header">
                            <span class="flyer-badge">Paket Terpilih</span>
                        </div>
                        
                        <div class="flyer-image-wrapper">
                            <img id="flyerImage" 
                                 src="{{ isset($selectedSchedule) ? asset('storage/flyers/' . $selectedSchedule['flyer_image']) : asset('images/placeholder.png') }}" 
                                 alt="Flyer" class="flyer-img">
                            <div class="flyer-overlay" id="flyerOverlay" style="{{ isset($selectedSchedule) ? 'display:none;' : '' }}">
                                <i class="bi bi-box-seam"></i>
                                <p>Pilih paket untuk melihat detail</p>
                            </div>
                        </div>
                        
                        <h4 class="package-name" id="packageNameDisplay">
                            {{ isset($selectedSchedule) ? $selectedSchedule['package_name'] : 'Belum Dipilih' }}
                        </h4>
                        
                        <div class="quick-info" id="quickInfo" style="{{ isset($selectedSchedule) ? '' : 'display:none;' }}">
                            <div class="quick-info-item">
                                <i class="bi bi-calendar-check"></i>
                                <div>
                                    <small>Keberangkatan</small>
                                    <strong id="quickDepart">{{ isset($selectedSchedule) ? date('d M Y', strtotime($selectedSchedule['departure_date'])) : '-' }}</strong>
                                </div>
                            </div>
                            <div class="quick-info-item">
                                <i class="bi bi-airplane-fill"></i>
                                <div>
                                    <small>Maskapai</small>
                                    <strong id="quickAirline">{{ isset($selectedSchedule) ? $selectedSchedule['airline'] : '-' }}</strong>
                                </div>
                            </div>
                            <div class="quick-info-item highlight">
                                <i class="bi bi-tag-fill"></i>
                                <div>
                                    <small>Harga Paket</small>
                                    <strong id="quickPrice" class="text-gold">{{ isset($selectedSchedule) ? 'Rp ' . number_format($selectedSchedule['price'], 0, ',', '.') : '-' }}</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Form -->
            <div class="col-lg-8">
                <div class="form-modern-card" data-aos="fade-up">
                    
                    <form action="{{ route('register.submit') }}" method="POST" id="registrationForm">
                        @csrf
                        
                        <!-- Progress Steps -->
                        <div class="progress-steps">
                            <div class="step-item active" data-step="1">
                                <div class="step-circle">
                                    <span class="step-number">1</span>
                                    <i class="bi bi-check-lg step-check"></i>
                                </div>
                                <span>Pilih Paket</span>
                            </div>
                            <div class="step-line"></div>
                            <div class="step-item" data-step="2">
                                <div class="step-circle">
                                    <span class="step-number">2</span>
                                    <i class="bi bi-check-lg step-check"></i>
                                </div>
                                <span>Data Pendaftar</span>
                            </div>
                            <div class="step-line"></div>
                            <div class="step-item" data-step="3">
                                <div class="step-circle">
                                    <span class="step-number">3</span>
                                    <i class="bi bi-check-lg step-check"></i>
                                </div>
                                <span>Data Jamaah</span>
                            </div>
                        </div>
                        
                        <!-- STEP 1: Pilih Paket -->
                        <div id="step1" class="form-step active">
                            <div class="step-header">
                                <h3><i class="bi bi-box-seam"></i> Pilih Paket Umrah</h3>
                                <p>Pilih paket yang sesuai dengan kebutuhan Anda</p>
                            </div>
                            
                            <div class="form-group-modern">
                                <label>Paket Umrah <span class="required">*</span></label>
                                <select class="form-select-modern" name="schedule_id" id="packageSelect" required 
                                        {{ isset($selectedSchedule) ? 'disabled' : '' }}
                                        onchange="loadPackageDetails(this.value)">
                                    <option value="">-- Pilih Paket --</option>
                                    @foreach($packages as $id => $name)
                                    <option value="{{ $id }}" {{ (isset($selectedSchedule) && $selectedSchedule['id'] == $id) ? 'selected' : '' }}>
                                        {{ $name }}
                                    </option>
                                    @endforeach
                                </select>
                                @if(isset($selectedSchedule))
                                <input type="hidden" name="schedule_id" value="{{ $selectedSchedule['id'] }}">
                                @endif
                            </div>
                            
                            <div class="form-group-modern">
                                <label>Jumlah Jamaah <span class="required">*</span></label>
                                <input type="number" class="form-control-modern" name="num_people" id="numPeople" 
                                       min="1" max="10" value="1" required onchange="updateJamaahForms()">
                                <small class="text-muted">Maksimal 10 orang per pendaftaran</small>
                            </div>
                            
                            <div class="form-actions mt-4">
                                <button type="button" class="btn-next-modern" onclick="nextStep(1)" id="btnStep1">
                                    Lanjut ke Data Pendaftar <i class="bi bi-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                        
                        <!-- STEP 2: Data Pendaftar (PIC) -->
                        <div id="step2" class="form-step">
                            <div class="step-header">
                                <h3><i class="bi bi-person-circle"></i> Data Pendaftar</h3>
                                <p>Data orang yang mendaftarkan (bisa beda dengan jamaah)</p>
                            </div>
                            
                            <div class="row g-3">
                                <div class="col-md-3">
                                    <div class="form-group-modern">
                                        <label>Gelar <span class="required">*</span></label>
                                        <select class="form-select-modern" name="pic_title" required>
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
                                        <input type="text" class="form-control-modern" name="pic_full_name" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-group-modern">
                                        <label>Email <span class="required">*</span></label>
                                        <input type="email" class="form-control-modern" name="pic_email" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-modern">
                                        <label>No. WhatsApp <span class="required">*</span></label>
                                        <input type="tel" class="form-control-modern" name="pic_phone" required>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group-modern">
                                <label>Alamat</label>
                                <textarea class="form-control-modern" name="pic_address" rows="2"></textarea>
                            </div>
                            
                            <div class="row g-3">
                                <div class="col-md-6">
                                    <div class="form-group-modern">
                                        <label>Provinsi</label>
                                        <select class="form-select-modern" name="pic_province">
                                            <option value="">Pilih</option>
                                            @foreach($provinces as $prov)
                                            <option value="{{ $prov }}">{{ $prov }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group-modern">
                                        <label>Kota/Kabupaten</label>
                                        <input type="text" class="form-control-modern" name="pic_city">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group-modern">
                                <label>Catatan</label>
                                <textarea class="form-control-modern" name="notes" rows="2" placeholder="Pertanyaan atau permintaan khusus (opsional)"></textarea>
                            </div>
                            
                            <div class="form-actions-step2 mt-4">
                                <button type="button" class="btn-back-modern" onclick="prevStep(2)">
                                    <i class="bi bi-arrow-left"></i> Kembali
                                </button>
                                <button type="button" class="btn-next-modern" onclick="nextStep(2)">
                                    Lanjut ke Data Jamaah <i class="bi bi-arrow-right"></i>
                                </button>
                            </div>
                        </div>
                        
                        <!-- STEP 3: Data Jamaah (Loop) -->
                        <div id="step3" class="form-step">
                            <div class="step-header">
                                <h3><i class="bi bi-people-fill"></i> Data Jamaah</h3>
                                <p>Isi data lengkap setiap jamaah yang berangkat</p>
                            </div>
                            
                            <div id="jamaahFormsContainer">
                                <!-- Jamaah forms will be generated by JS -->
                            </div>
                            
                            <div class="terms-box mt-4">
                                <input type="checkbox" id="terms" required>
                                <label for="terms">
                                    Saya menyetujui <a href="{{ route('terms') }}" target="_blank">syarat dan ketentuan</a> yang berlaku dan data yang saya isi adalah benar
                                </label>
                            </div>
                            
                            <div class="form-actions-step2 mt-4">
                                <button type="button" class="btn-back-modern" onclick="prevStep(3)">
                                    <i class="bi bi-arrow-left"></i> Kembali
                                </button>
                                <button type="submit" class="btn-submit-modern" id="btnSubmit">
                                    <span class="btn-text">
                                        <i class="bi bi-send"></i> Kirim Pendaftaran
                                    </span>
                                    <span class="btn-loading" style="display: none;">
                                        <span class="spinner-border spinner-border-sm"></span> Memproses...
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

<!-- Floating WA -->
<a href="https://wa.me/6282184515310?text=Assalamualaikum,%20saya%20ingin%20konsultasi" 
   class="floating-wa" target="_blank">
    <i class="bi bi-whatsapp"></i>
</a>

@endsection

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
AOS.init({ duration: 800, once: true });

const allSchedules = @json($allSchedules);
const titles = @json($titles);
const provinces = @json($provinces);

let currentStep = 1;

@if(isset($selectedSchedule))
window.addEventListener('DOMContentLoaded', () => {
    loadPackageDetails({{ $selectedSchedule['id'] }});
    updateJamaahForms();
});
@endif

function loadPackageDetails(packageId) {
    if (!packageId || !allSchedules[packageId]) {
        document.getElementById('flyerOverlay').style.display = 'flex';
        document.getElementById('quickInfo').style.display = 'none';
        document.getElementById('btnStep1').disabled = true;
        return;
    }
    
    const pkg = allSchedules[packageId];
    
    document.getElementById('flyerImage').src = `/storage/flyers/${pkg.flyer_image}`;
    document.getElementById('flyerOverlay').style.display = 'none';
    document.getElementById('packageNameDisplay').textContent = pkg.package_name;
    document.getElementById('quickDepart').textContent = formatDate(pkg.departure_date);
    document.getElementById('quickAirline').textContent = pkg.airline;
    document.getElementById('quickPrice').textContent = formatPrice(pkg.price);
    document.getElementById('quickInfo').style.display = 'block';
    document.getElementById('btnStep1').disabled = false;
}

function nextStep(step) {
    document.getElementById(`step${step}`).classList.remove('active');
    document.getElementById(`step${step + 1}`).classList.add('active');
    document.querySelector(`[data-step="${step}"]`).classList.add('completed');
    document.querySelector(`[data-step="${step + 1}"]`).classList.add('active');
    currentStep = step + 1;
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function prevStep(step) {
    document.getElementById(`step${step}`).classList.remove('active');
    document.getElementById(`step${step - 1}`).classList.add('active');
    document.querySelector(`[data-step="${step}"]`).classList.remove('active');
    document.querySelector(`[data-step="${step - 1}"]`).classList.remove('completed');
    currentStep = step - 1;
    window.scrollTo({ top: 0, behavior: 'smooth' });
}

function updateJamaahForms() {
    const numPeople = parseInt(document.getElementById('numPeople').value) || 1;
    const container = document.getElementById('jamaahFormsContainer');
    container.innerHTML = '';
    
    for (let i = 0; i < numPeople; i++) {
        container.innerHTML += generateJamaahForm(i);
    }
}

function generateJamaahForm(index) {
    return `
        <div class="jamaah-form-card" data-jamaah="${index}">
            <div class="jamaah-form-header">
                <h5><i class="bi bi-person-badge"></i> Data Jamaah ${index + 1}</h5>
            </div>
            
            <div class="row g-3">
                <div class="col-md-3">
                    <label>Gelar <span class="required">*</span></label>
                    <select class="form-select-modern" name="jamaah[${index}][title]" required>
                        <option value="">Pilih</option>
                        ${titles.map(t => `<option value="${t}">${t}</option>`).join('')}
                    </select>
                </div>
                <div class="col-md-9">
                    <label>Nama Lengkap (Sesuai KTP) <span class="required">*</span></label>
                    <input type="text" class="form-control-modern" name="jamaah[${index}][full_name]" required>
                </div>
            </div>
            
            <div class="row g-3">
                <div class="col-md-6">
                    <label>NIK <span class="required">*</span></label>
                    <input type="text" class="form-control-modern" name="jamaah[${index}][nik]" maxlength="16" required>
                </div>
                <div class="col-md-3">
                    <label>Jenis Kelamin <span class="required">*</span></label>
                    <select class="form-select-modern" name="jamaah[${index}][gender]" required>
                        <option value="">Pilih</option>
                        <option value="L">Laki-laki</option>
                        <option value="P">Perempuan</option>
                    </select>
                </div>
                <div class="col-md-3">
                    <label>Gol. Darah</label>
                    <select class="form-select-modern" name="jamaah[${index}][blood_type]">
                        <option value="">-</option>
                        <option value="A">A</option>
                        <option value="B">B</option>
                        <option value="AB">AB</option>
                        <option value="O">O</option>
                    </select>
                </div>
            </div>
            
            <div class="row g-3">
                <div class="col-md-6">
                    <label>Tempat Lahir <span class="required">*</span></label>
                    <input type="text" class="form-control-modern" name="jamaah[${index}][birth_place]" required>
                </div>
                <div class="col-md-6">
                    <label>Tanggal Lahir <span class="required">*</span></label>
                    <input type="date" class="form-control-modern" name="jamaah[${index}][birth_date]" required>
                </div>
            </div>
            
            <div class="row g-3">
                <div class="col-md-6">
                    <label>Status Pernikahan <span class="required">*</span></label>
                    <select class="form-select-modern" name="jamaah[${index}][marital_status]" required>
                        <option value="">Pilih</option>
                        <option value="single">Belum Menikah</option>
                        <option value="married">Menikah</option>
                        <option value="divorced">Cerai</option>
                        <option value="widowed">Duda/Janda</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label>Nama Ayah Kandung <span class="required">*</span></label>
                    <input type="text" class="form-control-modern" name="jamaah[${index}][father_name]" required>
                    <small class="text-muted">Untuk keperluan passport</small>
                </div>
            </div>
            
            <div class="form-group-modern">
                <label>Pekerjaan <span class="required">*</span></label>
                <input type="text" class="form-control-modern" name="jamaah[${index}][occupation]" required>
            </div>
            
            <div class="form-group-modern">
                <label>Alamat Lengkap <span class="required">*</span></label>
                <textarea class="form-control-modern" name="jamaah[${index}][address]" rows="2" required></textarea>
            </div>
            
            <div class="row g-3">
                <div class="col-md-6">
                    <label>Provinsi</label>
                    <select class="form-select-modern" name="jamaah[${index}][province]">
                        <option value="">Pilih</option>
                        ${provinces.map(p => `<option value="${p}">${p}</option>`).join('')}
                    </select>
                </div>
                <div class="col-md-6">
                    <label>Kota/Kabupaten</label>
                    <input type="text" class="form-control-modern" name="jamaah[${index}][city]">
                </div>
            </div>
            
            <div class="emergency-contact-section">
                <h6><i class="bi bi-telephone-fill"></i> Kontak Darurat</h6>
                <div class="row g-3">
                    <div class="col-md-4">
                        <label>Nama <span class="required">*</span></label>
                        <input type="text" class="form-control-modern" name="jamaah[${index}][emergency_name]" required>
                    </div>
                    <div class="col-md-4">
                        <label>Hubungan <span class="required">*</span></label>
                        <select class="form-select-modern" name="jamaah[${index}][emergency_relation]" required>
                            <option value="">Pilih</option>
                            <option value="ayah">Ayah</option>
                            <option value="ibu">Ibu</option>
                            <option value="suami">Suami</option>
                            <option value="istri">Istri</option>
                            <option value="anak">Anak</option>
                            <option value="saudara">Saudara</option>
                        </select>
                    </div>
                    <div class="col-md-4">
                        <label>No. Telepon <span class="required">*</span></label>
                        <input type="tel" class="form-control-modern" name="jamaah[${index}][emergency_phone]" required>
                    </div>
                </div>
            </div>
        </div>
    `;
}

document.getElementById('registrationForm').addEventListener('submit', function() {
    const btn = document.getElementById('btnSubmit');
    btn.querySelector('.btn-text').style.display = 'none';
    btn.querySelector('.btn-loading').style.display = 'inline-block';
    btn.disabled = true;
});

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