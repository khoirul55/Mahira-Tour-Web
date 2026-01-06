// Initialize AOS
AOS.init({ duration: 800, once: true });

// Global variables - akan diisi dari blade
let allSchedules = {};
let titles = [];
let provinces = [];
let currentStep = 1;
let selectedScheduleId = null;

// Initialize function untuk dipanggil dari blade
function initializeRegisterForm(schedulesData, titlesData, provincesData, preSelectedScheduleId = null) {
    allSchedules = schedulesData;
    titles = titlesData;
    provinces = provincesData;
    selectedScheduleId = preSelectedScheduleId;
    
    // Jika ada pre-selected schedule
    if (preSelectedScheduleId) {
        loadPackageDetails(preSelectedScheduleId);
        updateJamaahForms();
    }
}

// Load package details
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

// Navigation functions
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

// Update jamaah forms based on number of people
function updateJamaahForms() {
    const numPeople = parseInt(document.getElementById('numPeople').value) || 1;
    const container = document.getElementById('jamaahFormsContainer');
    container.innerHTML = '';
    
    for (let i = 0; i < numPeople; i++) {
        container.innerHTML += generateJamaahForm(i);
    }
}

// Generate jamaah form HTML
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

// Format date helper
function formatDate(dateStr) {
    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
    const d = new Date(dateStr);
    return `${d.getDate()} ${months[d.getMonth()]} ${d.getFullYear()}`;
}

// Format price helper
function formatPrice(price) {
    return 'Rp ' + price.toLocaleString('id-ID');
}

// Form submit handler
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('registrationForm');
    if (form) {
        form.addEventListener('submit', function() {
            const btn = document.getElementById('btnSubmit');
            btn.querySelector('.btn-text').style.display = 'none';
            btn.querySelector('.btn-loading').style.display = 'inline-block';
            btn.disabled = true;
        });
    }
});