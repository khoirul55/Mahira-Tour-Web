@extends('layouts.app')

@section('title', 'Pendaftaran Jamaah - Mahira Tour')

@push('styles')
<link rel="stylesheet" href="{{ asset('css/register.css') }}">
<style>
    .selected-schedule-card {
        background: linear-gradient(135deg, #ffffff 0%, #f8f9ff 100%);
        border-radius: 25px;
        padding: 2.5rem;
        margin-bottom: 2.5rem;
        box-shadow: 0 15px 50px rgba(0, 29, 95, 0.12);
        border: 2px solid var(--gold);
    }
    
    .schedule-details {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 15px;
        margin-top: 20px;
    }
    
    .detail-item {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 16px;
        background: white;
        border-radius: 12px;
        font-size: 0.95rem;
        box-shadow: 0 4px 15px rgba(0, 29, 95, 0.06);
        transition: transform 0.3s;
    }
    
    .detail-item:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(0, 29, 95, 0.1);
    }
    
    .detail-item i {
        font-size: 1.3rem;
        flex-shrink: 0;
    }
    
    @media (max-width: 768px) {
        .selected-schedule-card {
            padding: 1.5rem;
        }
        
        .schedule-details {
            grid-template-columns: 1fr;
        }
    }
</style>
@endpush

@section('content')
<!-- Page Header -->
<section class="page-header">
    <div class="container">
        <div class="page-header-content text-center">
            <div class="breadcrumb-custom">
                <a href="{{ route('home') }}"><i class="bi bi-house-door"></i> Beranda</a>
                <span class="mx-2">/</span>
                <a href="{{ route('schedule') }}">Jadwal</a>
                <span class="mx-2">/</span>
                <span>Pendaftaran</span>
            </div>
            <h1 class="display-3 fw-bold mb-4" data-aos="fade-up">Pendaftaran Jamaah</h1>
            <p class="lead" style="max-width: 700px; margin: 0 auto; font-size: 1.25rem;" data-aos="fade-up" data-aos-delay="100">
                Lengkapi form di bawah ini untuk memulai perjalanan spiritual Anda
            </p>
        </div>
    </div>
</section>

<!-- Registration Form -->
<section class="py-5" style="padding: 100px 0; background: var(--lighter-navy);">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-9">
                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert" style="border-radius: 15px; border-left: 5px solid #10B981;">
                    <div class="d-flex align-items-center">
                        <i class="bi bi-check-circle-fill me-3" style="font-size: 1.5rem;"></i>
                        <div>
                            <strong>Berhasil!</strong><br>
                            {{ session('success') }}
                        </div>
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
                @endif
                
                <!-- Selected Schedule Info (if exists) -->
                @if(isset($selectedSchedule) && $selectedSchedule)
                <div class="selected-schedule-card" data-aos="fade-up">
                    <div class="row align-items-center">
                        <div class="col-md-4">
                            <img src="{{ asset('storage/flyers/' . $selectedSchedule['flyer_image']) }}" 
                                 alt="{{ $selectedSchedule['package_name'] }}" 
                                 class="img-fluid rounded shadow">
                        </div>
                        <div class="col-md-8">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div>
                                    <h4 class="fw-bold mb-2" style="color: var(--primary-navy);">Paket Terpilih</h4>
                                    <h5 class="fw-bold" style="color: var(--gold);">{{ $selectedSchedule['package_name'] }}</h5>
                                </div>
                                <a href="{{ route('schedule') }}" class="btn btn-sm btn-outline-secondary">
                                    <i class="bi bi-arrow-left"></i> Ganti Paket
                                </a>
                            </div>
                            
                            <div class="schedule-details">
                                <div class="detail-item">
                                    <i class="bi bi-calendar-check text-primary"></i>
                                    <span><strong>Keberangkatan:</strong> {{ date('d F Y', strtotime($selectedSchedule['departure_date'])) }}</span>
                                </div>
                                <div class="detail-item">
                                    <i class="bi bi-calendar-x text-primary"></i>
                                    <span><strong>Kepulangan:</strong> {{ date('d F Y', strtotime($selectedSchedule['return_date'])) }}</span>
                                </div>
                                <div class="detail-item">
                                    <i class="bi bi-geo-alt-fill text-danger"></i>
                                    <span><strong>Jalur:</strong> {{ $selectedSchedule['departure_route'] }}</span>
                                </div>
                                <div class="detail-item">
                                    <i class="bi bi-airplane-fill text-info"></i>
                                    <span><strong>Maskapai:</strong> {{ $selectedSchedule['airline'] }}</span>
                                </div>
                                <div class="detail-item">
                                    <i class="bi bi-clock-fill text-warning"></i>
                                    <span><strong>Durasi:</strong> {{ $selectedSchedule['duration'] }}</span>
                                </div>
                                <div class="detail-item">
                                    <i class="bi bi-tag-fill text-success"></i>
                                    <span><strong>Harga:</strong> Rp {{ number_format($selectedSchedule['price'], 0, ',', '.') }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                
                <div class="form-card" data-aos="fade-up" data-aos-delay="100">
                    <div class="text-center mb-5">
                        <div class="form-header-icon">
                            <i class="bi bi-person-plus-fill"></i>
                        </div>
                        <h3 class="fw-bold mb-3" style="color: var(--primary-navy); font-size: 2rem;">Form Pendaftaran Umrah</h3>
                        <p class="text-muted" style="font-size: 1.05rem;">Isi data dengan lengkap dan benar</p>
                    </div>
                    
                    <div class="info-card">
                        <div class="d-flex align-items-start">
                            <i class="bi bi-info-circle-fill me-3"></i>
                            <div>
                                <strong style="color: var(--text-dark); font-size: 1.05rem;">Informasi Penting:</strong>
                                <p class="mb-0 mt-2" style="color: var(--text-gray);">
                                    Setelah mengisi form, tim Mahira Tour akan menghubungi Anda dalam <strong>1x24 jam</strong> untuk konfirmasi dan informasi pembayaran.
                                </p>
                            </div>
                        </div>
                    </div>
                    
                    <form action="{{ route('register.submit') }}" method="POST">
                        @csrf
                        
                        <!-- Hidden field untuk schedule_id jika ada -->
                        @if(isset($selectedSchedule) && $selectedSchedule)
                        <input type="hidden" name="schedule_id" value="{{ $selectedSchedule['id'] }}">
                        @endif
                        
                        <!-- Personal Info -->
                        <div class="mb-5">
                            <h5 class="fw-bold mb-4" style="color: var(--primary-navy); font-size: 1.4rem;">
                                <i class="bi bi-person-circle me-2"></i>Data Pribadi
                            </h5>
                            
                            <div class="row g-4">
                                <div class="col-md-3">
                                    <label class="form-label required">Gelar</label>
                                    <select class="form-select @error('title') is-invalid @enderror" name="title" required>
                                        <option value="">Pilih</option>
                                        @foreach($titles as $title)
                                        <option value="{{ $title }}" {{ old('title') == $title ? 'selected' : '' }}>{{ $title }}</option>
                                        @endforeach
                                    </select>
                                    @error('title')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-9">
                                    <label class="form-label required">Nama Lengkap</label>
                                    <input type="text" class="form-control @error('full_name') is-invalid @enderror" 
                                           name="full_name" placeholder="Sesuai KTP/Paspor" value="{{ old('full_name') }}" required>
                                    @error('full_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="row g-4 mt-1">
                                <div class="col-md-6">
                                    <label class="form-label required">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                           name="email" placeholder="contoh@email.com" value="{{ old('email') }}" required>
                                    @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label required">No. WhatsApp</label>
                                    <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                           name="phone" placeholder="08xxxxxxxxxx" value="{{ old('phone') }}" required>
                                    @error('phone')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="mt-4">
                                <label class="form-label">Alamat Lengkap</label>
                                <textarea class="form-control" name="address" rows="3" placeholder="Alamat sesuai KTP">{{ old('address') }}</textarea>
                            </div>
                            
                            <div class="row g-4 mt-1">
                                <div class="col-md-6">
                                    <label class="form-label">Provinsi</label>
                                    <select class="form-select" name="province">
                                        <option value="">Pilih Provinsi</option>
                                        @foreach($provinces as $province)
                                        <option value="{{ $province }}" {{ old('province') == $province ? 'selected' : '' }}>{{ $province }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="col-md-6">
                                    <label class="form-label">Kota/Kabupaten</label>
                                    <input type="text" class="form-control" name="city" placeholder="Nama Kota/Kabupaten" value="{{ old('city') }}">
                                </div>
                            </div>
                        </div>
                        
                        <div class="section-divider">
                            <span class="section-divider-text">PILIH PAKET</span>
                        </div>
                        
                        <!-- Package Selection -->
                        <div class="mb-5">
                            <h5 class="fw-bold mb-4" style="color: var(--primary-navy); font-size: 1.4rem;">
                                <i class="bi bi-box-seam me-2"></i>Informasi Paket
                            </h5>
                            
                            <div class="mb-4">
                                <label class="form-label required">Paket yang Dipilih</label>
                                <select class="form-select @error('package_id') is-invalid @enderror" name="package_id" required
                                        @if(isset($selectedSchedule)) disabled @endif>
                                    <option value="">-- Pilih Paket Umrah --</option>
                                    @foreach($packages as $id => $package)
                                    <option value="{{ $id }}" 
                                        {{ (isset($selectedSchedule) && $selectedSchedule['id'] == $id) || old('package_id') == $id ? 'selected' : '' }}>
                                        {{ $package }}
                                    </option>
                                    @endforeach
                                </select>
                                @if(isset($selectedSchedule))
                                <input type="hidden" name="package_id" value="{{ $selectedSchedule['id'] }}">
                                @endif
                                @error('package_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                            
                            <div class="row g-4">
                                <div class="col-md-4">
                                    <label class="form-label required">Jalur Keberangkatan</label>
                                    <select class="form-select @error('departure_route') is-invalid @enderror" name="departure_route" required
                                            @if(isset($selectedSchedule)) disabled @endif>
                                        <option value="">-- Pilih --</option>
                                        @foreach($departure_routes as $route)
                                        <option value="{{ $route }}"
                                            {{ (isset($selectedSchedule) && $selectedSchedule['departure_route'] == $route) || old('departure_route') == $route ? 'selected' : '' }}>
                                            {{ $route }}
                                        </option>
                                        @endforeach
                                    </select>
                                    @if(isset($selectedSchedule))
                                    <input type="hidden" name="departure_route" value="{{ $selectedSchedule['departure_route'] }}">
                                    @endif
                                    @error('departure_route')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-4">
                                    <label class="form-label required">Tanggal Keberangkatan</label>
                                    <input type="date" class="form-control @error('departure_date') is-invalid @enderror" 
                                           name="departure_date" min="{{ date('Y-m-d') }}" 
                                           value="{{ isset($selectedSchedule) ? $selectedSchedule['departure_date'] : old('departure_date') }}" 
                                           required
                                           @if(isset($selectedSchedule)) readonly @endif>
                                    @error('departure_date')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                
                                <div class="col-md-4">
                                    <label class="form-label required">Jumlah Jamaah</label>
                                    <input type="number" class="form-control @error('num_people') is-invalid @enderror" 
                                           name="num_people" min="1" max="10" value="{{ old('num_people', 1) }}" required>
                                    @error('num_people')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="mt-4">
                                <label class="form-label">Catatan Tambahan</label>
                                <textarea class="form-control" name="message" rows="4" 
                                          placeholder="Pertanyaan atau permintaan khusus (opsional)">{{ old('message') }}</textarea>
                            </div>
                        </div>
                        
                        <div class="form-check mb-4 p-4" style="background: var(--lighter-navy); border-radius: 15px;">
                            <input class="form-check-input" type="checkbox" id="terms" required style="width: 20px; height: 20px; margin-top: 2px;">
                            <label class="form-check-label ms-2" for="terms" style="color: var(--text-dark);">
                                Saya menyetujui <a href="{{ route('terms') }}" target="_blank" class="fw-bold" style="color: var(--primary-navy);">syarat dan ketentuan</a> yang berlaku
                            </label>
                        </div>
                        
                        <div class="row g-3">
                            <div class="col-md-8">
                                <button type="submit" class="btn-submit w-100">
                                    <i class="bi bi-send me-2"></i>Kirim Pendaftaran
                                </button>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('schedule') }}" class="btn-back w-100">
                                    <i class="bi bi-arrow-left me-2"></i>Kembali
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Next Steps -->
<section class="py-5" style="padding: 100px 0; background: var(--white);">
    <div class="container">
        <div class="text-center mb-5" data-aos="fade-up">
            <div class="section-subtitle" style="color: var(--gold); font-weight: 600; font-size: 0.9rem; text-transform: uppercase; letter-spacing: 2px; margin-bottom: 15px; display: inline-block; padding: 8px 20px; background: rgba(212, 175, 55, 0.1); border-radius: 50px;">
                PROSES SELANJUTNYA
            </div>
            <h2 class="fw-bold" style="font-size: 2.5rem; color: var(--primary-navy);">Langkah Setelah Pendaftaran</h2>
        </div>
        
        <div class="row g-4">
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                <div class="step-card">
                    <div class="step-number">
                        <span>1</span>
                    </div>
                    <h5 class="step-title">Konfirmasi Tim</h5>
                    <p class="step-text">Tim Mahira Tour akan menghubungi Anda untuk konfirmasi data dan informasi lebih lanjut</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                <div class="step-card">
                    <div class="step-number">
                        <span>2</span>
                    </div>
                    <h5 class="step-title">Pembayaran DP</h5>
                    <p class="step-text">Lakukan pembayaran DP minimal 30% dari total harga paket yang dipilih</p>
                </div>
            </div>
            
            <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                <div class="step-card">
                    <div class="step-number">
                        <span>3</span>
                    </div>
                    <h5 class="step-title">Persiapan Dokumen</h5>
                    <p class="step-text">Lengkapi dokumen persyaratan dan ikuti manasik persiapan keberangkatan</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init({
        duration: 1000,
        once: true,
        offset: 100
    });
</script>
@endpush