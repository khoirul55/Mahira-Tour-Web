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
<script src="{{ asset('js/register.js') }}"></script>
<script>
// Pass data dari Laravel ke JavaScript
window.addEventListener('DOMContentLoaded', () => {
    initializeRegisterForm(
        @json($allSchedules),
        @json($titles),
        @json($provinces),
        {{ isset($selectedSchedule) ? $selectedSchedule['id'] : 'null' }}
    );
});
</script>
@endpush