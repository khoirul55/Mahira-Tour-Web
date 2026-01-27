@extends('layouts.admin')

@section('title', 'Pengaturan Akun')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1 class="mb-1">Pengaturan Akun</h1>
            <p class="text-muted mb-0">Kelola informasi profil dan keamanan akun Anda</p>
        </div>
    </div>
</div>

<div class="row">
    <!-- Profile Information -->
    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body p-4">
                <h5 class="card-title mb-4 fw-bold">
                    <i class="bi bi-person-circle text-primary me-2"></i> Informasi Profil
                </h5>
                
                <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="d-flex align-items-center mb-4">
                        <div class="me-4">
                            @if($user->avatar)
                                <img src="{{ Storage::url($user->avatar) }}" alt="Avatar" class="rounded-circle" style="width: 100px; height: 100px; object-fit: cover; border: 3px solid #f8f9fa; box-shadow: 0 2px 8px rgba(0,0,0,0.1);">
                            @else
                                <div class="rounded-circle bg-light d-flex align-items-center justify-content-center text-primary" style="width: 100px; height: 100px; font-size: 3rem;">
                                    <i class="bi bi-person-fill"></i>
                                </div>
                            @endif
                        </div>
                        <div>
                            <label for="avatar" class="form-label fw-bold">Foto Profil</label>
                            <input type="file" class="form-control" id="avatar" name="avatar" accept="image/*">
                            <div class="form-text">Format: JPG, PNG. Maks 2MB.</div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="name" class="form-label">Nama Lengkap</label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $user->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="email" class="form-label">Alamat Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $user->email) }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">
                            <i class="bi bi-save me-2"></i> Simpan Perubahan
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Change Password -->
    <div class="col-md-6 mb-4">
        <div class="card h-100">
            <div class="card-body p-4">
                <h5 class="card-title mb-4 fw-bold">
                    <i class="bi bi-shield-lock text-primary me-2"></i> Ganti Password
                </h5>
                
                <form action="{{ route('admin.profile.password') }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <div class="mb-3">
                        <label for="current_password" class="form-label">Password Saat Ini</label>
                        <div class="input-group">
                            <input type="password" class="form-control @error('current_password') is-invalid @enderror" id="current_password" name="current_password" required>
                            <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('current_password')"><i class="bi bi-eye"></i></button>
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password Baru</label>
                        <div class="input-group">
                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
                            <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password')"><i class="bi bi-eye"></i></button>
                            @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-text">Minimal 8 karakter.</div>
                    </div>

                    <div class="mb-4">
                        <label for="password_confirmation" class="form-label">Konfirmasi Password Baru</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                            <button class="btn btn-outline-secondary" type="button" onclick="togglePassword('password_confirmation')"><i class="bi bi-eye"></i></button>
                        </div>
                    </div>

                    <div class="d-grid">
                        <button type="submit" class="btn btn-warning text-white">
                            <i class="bi bi-key me-2"></i> Update Password
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
    function togglePassword(inputId) {
        const input = document.getElementById(inputId);
        const icon = input.nextElementSibling.querySelector('i');
        
        if (input.type === "password") {
            input.type = "text";
            icon.classList.remove('bi-eye');
            icon.classList.add('bi-eye-slash');
        } else {
            input.type = "password";
            icon.classList.remove('bi-eye-slash');
            icon.classList.add('bi-eye');
        }
    }
</script>
@endpush
@endsection
