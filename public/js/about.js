// Branch data with coordinates
const branchesWithCoords = [
    {id: 1, name: "Sungai Penuh", region: "Jambi", address: "Jl. Muradi, Desa Koto Keras, Kecamatan Pesisir Bukit", phone: "082184515310", coordinates: [-2.0621, 101.3953], isMain: true, mapLink: ""},
    {id: 2, name: "Padang", region: "Sumatera Barat", address: "Taruko I, Jl. Raya No.66 A, Korong Gadang", coordinates: [-0.9155963, 100.4001498], isMain: false, mapLink: "https://maps.app.goo.gl/bN6zG5ds5Ynutf3k9?g_st=aw"},
    {id: 3, name: "Jambi", region: "Jambi", address: "Gg. Nuri 1, RT.25/RW.no 16, Jelutung", coordinates: [-1.6116861, 103.6184803], isMain: false, mapLink: "https://maps.app.goo.gl/DZ4fU5dQsnxJXg3L8"},
    {id: 4, name: "Bungo", region: "Jambi", address: "Suka Jaya, Kabupaten Bungo", coordinates: [-1.507646, 102.061605], isMain: false, mapLink: "https://maps.app.goo.gl/CUKHXVoTSiyZyNif6?g_st=aw"},
    {id: 5, name: "Tebo", region: "Jambi", address: "Jl. Padang Lamo, Tlk. Kuali, Kec. Tebo Ulu", coordinates: [-1.21661, 102.195169], isMain: false, mapLink: "https://maps.app.goo.gl/sBNookviKWUfWY1bA?g_st=aw"},
    {id: 6, name: "Merangin", region: "Jambi", address: "Muara Panco Barat, Kec. Renah Pembarap", coordinates: [-2.0833, 101.6833], isMain: false, mapLink: ""}
];

// Initialize map
const map = L.map('map').setView([-1.5, 102], 6);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors',
    maxZoom: 19
}).addTo(map);

const markers = {};

function createCustomIcon(isMain) {
    return L.divIcon({
        className: 'custom-div-icon',
        html: `<div class="custom-marker ${isMain ? 'main' : ''}">
                <i class="bi bi-${isMain ? 'building-fill' : 'geo-alt-fill'}"></i>
              </div>`,
        iconSize: isMain ? [50, 50] : [40, 40],
        iconAnchor: isMain ? [25, 50] : [20, 40],
        popupAnchor: [0, isMain ? -50 : -40]
    });
}

function createPopupContent(branch) {
    const mapUrl = branch.mapLink ? branch.mapLink : `https://www.google.com/maps/dir/?api=1&destination=${branch.coordinates[0]},${branch.coordinates[1]}`;
    
    return `
        <div class="popup-header ${branch.isMain ? 'featured' : ''}">
            ${branch.isMain ? '<div class="popup-badge">Kantor Pusat</div>' : ''}
            <h4>${branch.name}</h4>
        </div>
        <div class="popup-body">
            <div class="popup-info">
                <i class="bi bi-geo-alt-fill"></i>
                <span>${branch.address}</span>
            </div>
            <div class="popup-actions">
                ${branch.phone ? `
                    <a href="tel:${branch.phone}" class="popup-btn primary">
                        <i class="bi bi-telephone-fill"></i> Hubungi
                    </a>
                ` : ''}
                <a href="${mapUrl}" target="_blank" class="popup-btn ${branch.phone ? 'secondary' : 'primary'}">
                    <i class="bi bi-map-fill"></i> Google Maps
                </a>
            </div>
        </div>
    `;
}

// Add markers to map
branchesWithCoords.forEach(branch => {
    const marker = L.marker(branch.coordinates, {
        icon: createCustomIcon(branch.isMain)
    }).addTo(map);
    
    marker.bindPopup(createPopupContent(branch), {
        maxWidth: 300,
        className: 'custom-popup'
    });
    
    markers[branch.id] = marker;
});

// Render branch cards
function renderBranchCards() {
    const container = document.getElementById('branchCardsContainer');
    if (!container) return;
    
    const cardsHTML = branchesWithCoords.map(branch => `
        <div class="branch-card ${branch.isMain ? 'main' : ''}" onclick="focusBranch(${branch.id})">
            <div class="branch-card-header">
                <div class="branch-card-icon">
                    <i class="bi bi-${branch.isMain ? 'building-fill' : 'geo-alt-fill'}"></i>
                </div>
                <div class="branch-card-title">
                    <h4>${branch.name}</h4>
                    <p>${branch.region}</p>
                </div>
            </div>
            <div class="branch-card-body">
                <div class="branch-card-address">
                    <i class="bi bi-geo-alt-fill"></i>
                    <span>${branch.address}</span>
                </div>
                ${branch.isMain ? '<div class="branch-badge-card">Kantor Pusat</div>' : ''}
            </div>
        </div>
    `).join('');
    
    container.innerHTML = cardsHTML;
}

// Focus on branch when card clicked
function focusBranch(branchId) {
    const branch = branchesWithCoords.find(b => b.id === branchId);
    if (!branch) return;
    
    map.flyTo(branch.coordinates, 13, {duration: 1.5});
    
    // Highlight card
    document.querySelectorAll('.branch-card').forEach(card => {
        card.style.transform = '';
        card.style.borderColor = 'transparent';
    });
    
    const clickedCard = event.target.closest('.branch-card');
    if (clickedCard) {
        clickedCard.style.transform = 'translateY(-5px)';
        clickedCard.style.borderColor = branch.isMain ? 'var(--accent)' : 'var(--success)';
    }
    
    setTimeout(() => {
        markers[branchId].openPopup();
    }, 1500);
}

// Initialize
renderBranchCards();

// Auto focus on main branch after load
setTimeout(() => {
    focusBranch(1);
}, 1000);

// Lazy load backgrounds
const lazyBackgrounds = document.querySelectorAll('.lazy-bg');
const bgObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.classList.add('loaded');
            bgObserver.unobserve(entry.target);
        }
    });
});
lazyBackgrounds.forEach(bg => bgObserver.observe(bg));

// Section fade animation
const sections = document.querySelectorAll('section');
const fadeObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity = '1';
            entry.target.style.transform = 'translateY(0)';
        }
    });
}, { threshold: 0.1 });

sections.forEach(section => {
    section.style.opacity = '0';
    section.style.transform = 'translateY(30px)';
    section.style.transition = 'all 0.8s ease';
    fadeObserver.observe(section);
});