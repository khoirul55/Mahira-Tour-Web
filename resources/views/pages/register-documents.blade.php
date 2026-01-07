@extends('layouts.app')
@section('title', 'Upload Dokumen - Mahira Tour')
@push('styles')
<style>
.doc-section{min-height:100vh;background:linear-gradient(180deg,#F8F9FF 0%,#fff 100%);padding:80px 0}
.doc-header{text-align:center;margin-bottom:3rem}
.doc-header h1{color:#001D5F;font-weight:800}
.jamaah-card{background:#fff;border-radius:20px;padding:2rem;margin-bottom:2rem;box-shadow:0 10px 40px rgba(0,29,95,.1)}
.jamaah-card h3{color:#001D5F;font-weight:700;margin-bottom:1.5rem;padding-bottom:1rem;border-bottom:2px solid #E8EBF3}
.upload-group{margin-bottom:1.5rem}
.upload-group label{display:block;font-weight:700;color:#001D5F;margin-bottom:.5rem}
.required{color:#EF4444}
.file-input-wrapper{position:relative;display:inline-block;width:100%}
.file-input{display:none}
.file-label{display:flex;align-items:center;gap:1rem;padding:1rem;border:2px dashed #E8EBF3;border-radius:12px;cursor:pointer;transition:all .3s}
.file-label:hover{border-color:#001D5F;background:#F8F9FF}
.file-label i{font-size:2rem;color:#001D5F}
.file-info{flex:1}
.file-info small{color:#6B7280}
.uploaded-file{display:flex;align-items:center;gap:1rem;padding:1rem;background:#E8F5E9;border-radius:12px;margin-top:.5rem}
.uploaded-file i{color:#10B981}
.btn-upload{background:#001D5F;color:#fff;padding:12px 30px;border-radius:50px;border:none;font-weight:700;cursor:pointer;transition:all .3s}
.btn-upload:hover{transform:translateY(-2px);box-shadow:0 8px 20px rgba(0,29,95,.3)}
.btn-next-payment{background:linear-gradient(135deg,#10B981,#059669);color:#fff;padding:18px 40px;border-radius:50px;border:none;font-weight:700;font-size:1.1rem;display:block;margin:3rem auto 0;cursor:pointer;transition:all .3s}
.btn-next-payment:hover{transform:translateY(-3px);box-shadow:0 12px 35px rgba(16,185,129,.3)}
.progress-bar{background:#E8EBF3;height:8px;border-radius:10px;overflow:hidden;margin:1rem 0}
.progress-fill{background:linear-gradient(90deg,#10B981,#059669);height:100%;transition:width .5s}
</style>
@endpush
@section('content')
<section class="doc-section">
    <div class="container">
        <div class="doc-header">
            <h1>Upload Dokumen Jamaah</h1>
            <p class="text-muted">Nomor Registrasi: <strong>{{ $registration->registration_number }}</strong></p>
        </div>
        
        @foreach($registration->jamaah as $index => $jamaah)
        <div class="jamaah-card" id="jamaah-{{ $jamaah->id }}">
            <h3><i class="bi bi-person-badge"></i> {{ $jamaah->full_name }}</h3>
            
            @php
                $docs = $jamaah->documents->pluck('document_type')->toArray();
                $required = ['ktp', 'kk', 'photo'];
                if($jamaah->marital_status === 'married') $required[] = 'buku_nikah';
                $uploaded = count(array_intersect($required, $docs));
                $total = count($required);
                $progress = ($uploaded / $total) * 100;
            @endphp
            
            <div class="progress-bar">
                <div class="progress-fill" style="width:{{ $progress }}%"></div>
            </div>
            <small>Dokumen: {{ $uploaded }}/{{ $total }}</small>
            
            {{-- KTP --}}
            <div class="upload-group">
                <label>KTP (Scan/Foto) <span class="required">*</span></label>
                @if(in_array('ktp', $docs))
                    <div class="uploaded-file">
                        <i class="bi bi-check-circle-fill"></i>
                        <span>KTP sudah terupload</span>
                    </div>
                @else
                    <form action="{{ route('register.documents', $registration->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="jamaah_id" value="{{ $jamaah->id }}">
                        <input type="hidden" name="document_type" value="ktp">
                        <div class="file-input-wrapper">
                            <input type="file" name="document" class="file-input" id="ktp-{{ $jamaah->id }}" accept="image/*,application/pdf" required>
                            <label for="ktp-{{ $jamaah->id }}" class="file-label">
                                <i class="bi bi-cloud-upload"></i>
                                <div class="file-info">
                                    <strong>Pilih File KTP</strong>
                                    <small>JPG, PNG, PDF (Max 2MB)</small>
                                </div>
                            </label>
                        </div>
                        <button type="submit" class="btn-upload mt-2">Upload KTP</button>
                    </form>
                @endif
            </div>
            
            {{-- KK --}}
            <div class="upload-group">
                <label>Kartu Keluarga <span class="required">*</span></label>
                @if(in_array('kk', $docs))
                    <div class="uploaded-file">
                        <i class="bi bi-check-circle-fill"></i>
                        <span>KK sudah terupload</span>
                    </div>
                @else
                    <form action="{{ route('register.documents', $registration->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="jamaah_id" value="{{ $jamaah->id }}">
                        <input type="hidden" name="document_type" value="kk">
                        <div class="file-input-wrapper">
                            <input type="file" name="document" class="file-input" id="kk-{{ $jamaah->id }}" accept="image/*,application/pdf" required>
                            <label for="kk-{{ $jamaah->id }}" class="file-label">
                                <i class="bi bi-cloud-upload"></i>
                                <div class="file-info">
                                    <strong>Pilih File KK</strong>
                                    <small>JPG, PNG, PDF (Max 2MB)</small>
                                </div>
                            </label>
                        </div>
                        <button type="submit" class="btn-upload mt-2">Upload KK</button>
                    </form>
                @endif
            </div>
            
            {{-- Photo --}}
            <div class="upload-group">
                <label>Pas Foto 4x6 (Background Putih) <span class="required">*</span></label>
                @if(in_array('photo', $docs))
                    <div class="uploaded-file">
                        <i class="bi bi-check-circle-fill"></i>
                        <span>Foto sudah terupload</span>
                    </div>
                @else
                    <form action="{{ route('register.documents', $registration->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="jamaah_id" value="{{ $jamaah->id }}">
                        <input type="hidden" name="document_type" value="photo">
                        <div class="file-input-wrapper">
                            <input type="file" name="document" class="file-input" id="photo-{{ $jamaah->id }}" accept="image/*" required>
                            <label for="photo-{{ $jamaah->id }}" class="file-label">
                                <i class="bi bi-cloud-upload"></i>
                                <div class="file-info">
                                    <strong>Pilih File Foto</strong>
                                    <small>JPG, PNG (Max 2MB)</small>
                                </div>
                            </label>
                        </div>
                        <button type="submit" class="btn-upload mt-2">Upload Foto</button>
                    </form>
                @endif
            </div>
            
            {{-- Buku Nikah (Conditional) --}}
            @if($jamaah->marital_status === 'married')
            <div class="upload-group">
                <label>Buku Nikah <span class="required">*</span></label>
                @if(in_array('buku_nikah', $docs))
                    <div class="uploaded-file">
                        <i class="bi bi-check-circle-fill"></i>
                        <span>Buku Nikah sudah terupload</span>
                    </div>
                @else
                    <form action="{{ route('register.documents', $registration->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="jamaah_id" value="{{ $jamaah->id }}">
                        <input type="hidden" name="document_type" value="buku_nikah">
                        <div class="file-input-wrapper">
                            <input type="file" name="document" class="file-input" id="nikah-{{ $jamaah->id }}" accept="image/*,application/pdf" required>
                            <label for="nikah-{{ $jamaah->id }}" class="file-label">
                                <i class="bi bi-cloud-upload"></i>
                                <div class="file-info">
                                    <strong>Pilih File Buku Nikah</strong>
                                    <small>JPG, PNG, PDF (Max 2MB)</small>
                                </div>
                            </label>
                        </div>
                        <button type="submit" class="btn-upload mt-2">Upload Buku Nikah</button>
                    </form>
                @endif
            </div>
            @endif
        </div>
        @endforeach
        
        <a href="{{ route('register.payment', $registration->id) }}" class="btn-next-payment">
            <i class="bi bi-credit-card"></i> Lanjut ke Pembayaran
        </a>
    </div>
</section>
@endsection
@push('scripts')
<script>
document.querySelectorAll('.file-input').forEach(input => {
    input.addEventListener('change', function() {
        const label = this.nextElementSibling;
        const fileName = this.files[0]?.name || 'Pilih File';
        label.querySelector('strong').textContent = fileName;
    });
});
</script>
@endpush