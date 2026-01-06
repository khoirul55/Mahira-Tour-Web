// Initialize AOS
AOS.init({ duration: 800, once: true });

// Global variables
let allSchedules = {};
let titles = [];
let provinces = [];
let currentStep = 1;
let selectedScheduleId = null;

// Initialize function
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
    
    // Initialize mobile features
    initializeMobileFeatures();
}

// ========== MOBILE FEATURES ==========

function initializeMobileFeatures() {
    // FAB scroll behavior
    let lastScroll = 0;
    const fab = document.getElementById('fabFlyer');
    const stickyMini = document.getElementById('stickyMini');
    
    if (!fab || !stickyMini) return;
    
    window.addEventListener('scroll', () => {
        const currentScroll = window.pageYOffset;
        
        // Show FAB when scrolled down and package is selected
        if (selectedScheduleId && currentScroll > 300) {
            fab.classList.add('show');
        } else {
            fab.classList.remove('show');
        }
        
        lastScroll = currentScroll;
    });
    
    // Update offcanvas content when opened
    const offcanvasElement = document.getElementById('flyerOffcanvas');
    if (offcanvasElement) {
        offcanvasElement.addEventListener('show.bs.offcanvas', function () {
            updateOffcanvasContent();
        });
    }
}

function updateOffcanvasContent() {
    if (!selectedScheduleId || !allSchedules[selectedScheduleId]) return;
    
    const pkg = allSchedules[selectedScheduleId];
    
    // Update offcanvas content
    const elements = {
        offcanvasFlyerImg: document.getElementById('offcanvasFlyerImg'),
        offcanvasPackageName: document.getElementById('offcanvasPackageName'),
        offcanvasDepartDate: document.getElementById('offcanvasDepartDate'),
        offcanvasReturnDate: document.getElementById('offcanvasReturnDate'),
        offcanvasRoute: document.getElementById('offcanvasRoute'),
        offcanvasAirline: document.getElementById('offcanvasAirline'),
        offcanvasPrice: document.getElementById('offcanvasPrice')
    };
    
    if (elements.offcanvasFlyerImg) elements.offcanvasFlyerImg.src = `/storage/flyers/${pkg.flyer_image}`;
    if (elements.offcanvasPackageName) elements.offcanvasPackageName.textContent = pkg.package_name;
    if (elements.offcanvasDepartDate) elements.offcanvasDepartDate.textContent = formatDate(pkg.departure_date);
    if (elements.offcanvasReturnDate) elements.offcanvasReturnDate.textContent = formatDate(pkg.return_date);
    if (elements.offcanvasRoute) elements.offcanvasRoute.textContent = pkg.departure_route;
    if (elements.offcanvasAirline) elements.offcanvasAirline.textContent = pkg.airline;
    if (elements.offcanvasPrice) elements.offcanvasPrice.textContent = formatPrice(pkg.price);
}

// ========== PACKAGE LOADING (FIXED) ==========

function loadPackageDetails(packageId) {
    if (!packageId || !allSchedules[packageId]) {
        // Hide all preview elements
        const flyerOverlay = document.getElementById('flyerOverlay');
        const quickInfo = document.getElementById('quickInfo');
        const btnStep1 = document.getElementById('btnStep1');
        const stickyMini = document.getElementById('stickyMini');
        
        if (flyerOverlay) flyerOverlay.style.display = 'flex';
        if (quickInfo) quickInfo.style.display = 'none';
        if (btnStep1) btnStep1.disabled = true;
        if (stickyMini) {
            stickyMini.style.display = 'none';
            stickyMini.style.visibility = 'hidden';
            stickyMini.style.opacity = '0';
        }
        
        return;
    }
    
    const pkg = allSchedules[packageId];
    selectedScheduleId = packageId;
    
    // Update desktop sidebar (dengan null check)
    const desktopElements = {
        flyerImage: document.getElementById('flyerImage'),
        flyerOverlay: document.getElementById('flyerOverlay'),
        packageNameDisplay: document.getElementById('packageNameDisplay'),
        quickDepart: document.getElementById('quickDepart'),
        quickAirline: document.getElementById('quickAirline'),
        quickPrice: document.getElementById('quickPrice'),
        quickInfo: document.getElementById('quickInfo'),
        btnStep1: document.getElementById('btnStep1')
    };
    
    if (desktopElements.flyerImage) desktopElements.flyerImage.src = `/storage/flyers/${pkg.flyer_image}`;
    if (desktopElements.flyerOverlay) desktopElements.flyerOverlay.style.display = 'none';
    if (desktopElements.packageNameDisplay) desktopElements.packageNameDisplay.textContent = pkg.package_name;
    if (desktopElements.quickDepart) desktopElements.quickDepart.textContent = formatDate(pkg.departure_date);
    if (desktopElements.quickAirline) desktopElements.quickAirline.textContent = pkg.airline;
    if (desktopElements.quickPrice) desktopElements.quickPrice.textContent = formatPrice(pkg.price);
    if (desktopElements.quickInfo) desktopElements.quickInfo.style.display = 'block';
    if (desktopElements.btnStep1) desktopElements.btnStep1.disabled = false;
    
    // ✅ FIX: Update mobile sticky mini (FORCE SHOW)
    const stickyMini = document.getElementById('stickyMini');
    const miniThumb = document.getElementById('miniThumb');
    const miniPackageName = document.getElementById('miniPackageName');
    const miniPrice = document.getElementById('miniPrice');
    
    if (stickyMini && window.innerWidth < 992) {
        // Force display with all styles
        stickyMini.style.display = 'flex';
        stickyMini.style.visibility = 'visible';
        stickyMini.style.opacity = '1';
        
        // Add animation class
        stickyMini.classList.add('show-animated');
        
        // Update content
        if (miniThumb) miniThumb.src = `/storage/flyers/${pkg.flyer_image}`;
        if (miniPackageName) miniPackageName.textContent = pkg.package_name;
        if (miniPrice) miniPrice.textContent = formatPrice(pkg.price);
        
        console.log('✅ Sticky mini card shown for mobile'); // Debug log
    }
    
    // Update offcanvas
    updateOffcanvasContent();
}

// ========== NAVIGATION ==========

function nextStep(step) {
    // Validation before moving to next step
    if (step === 1) {
        const packageSelect = document.getElementById('packageSelect');
        const numPeople = document.getElementById('numPeople');
        
        if (!packageSelect.value) {
            alert('Silakan pilih paket umrah terlebih dahulu');
            return;
        }
        
        if (!numPeople.value || numPeople.value < 1) {
            alert('Silakan masukkan jumlah jamaah');
            return;
        }
    }
    
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

// ========== JAMAAH FORMS ==========

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

// ========== HELPERS ==========

function formatDate(dateStr) {
    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
    const d = new Date(dateStr);
    return `${d.getDate()} ${months[d.getMonth()]} ${d.getFullYear()}`;
}

function formatPrice(price) {
    return 'Rp ' + price.toLocaleString('id-ID');
}

// ========== FORM SUBMIT ==========

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('registrationForm');
    if (form) {
        form.addEventListener('submit', function() {
            const btn = document.getElementById('btnSubmit');
            if (btn) {
                const btnText = btn.querySelector('.btn-text');
                const btnLoading = btn.querySelector('.btn-loading');
                if (btnText) btnText.style.display = 'none';
                if (btnLoading) btnLoading.style.display = 'inline-block';
                btn.disabled = true;
            }
        });
    }
});