// Branch data with coordinates
const branchesWithCoords = [
    {id: 1, name: "Sungai Penuh", region: "Jambi", address: "Jl. Muradi, Desa Koto Keras, Kecamatan Pesisir Bukit", phone: "082184515310", coordinates: [-2.0621, 101.3953], isMain: true},
    {id: 2, name: "Padang", region: "Sumatera Barat", address: "Jl. Raya Taruko 1 / Manunggal 3 No 66 A", coordinates: [-0.9471, 100.4172], isMain: false},
    {id: 3, name: "Jambi", region: "Jambi", address: "Jl. Sunan Gunung Djati RT.28, Kenali Asam", coordinates: [-1.6101, 103.6131], isMain: false},
    {id: 4, name: "Jakarta", region: "DKI Jakarta", address: "Jl. Regal Amba No 8, Jakarta Timur", coordinates: [-6.2088, 106.8456], isMain: false},
    {id: 5, name: "Padang Utara", region: "Sumatera Barat", address: "Jl. Peloponegon, Gang L No. 4", coordinates: [-0.9199, 100.3543], isMain: false},
    {id: 6, name: "Bengkulu", region: "Bengkulu", address: "Jl. Sentang 4, Tanah Patah", coordinates: [-3.7928, 102.2608], isMain: false},
    {id: 7, name: "Merangin", region: "Jambi", address: "Muara Panas Rantai, Tanah Hombun", coordinates: [-2.0833, 101.6833], isMain: false}
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
            ${branch.phone ? `
                <div class="popup-actions">
                    <a href="tel:${branch.phone}" class="popup-btn primary">
                        <i class="bi bi-telephone-fill"></i> Hubungi
                    </a>
                    <a href="https://www.google.com/maps/dir/?api=1&destination=${branch.coordinates[0]},${branch.coordinates[1]}" 
                       target="_blank" class="popup-btn secondary">
                        <i class="bi bi-compass"></i> Rute
                    </a>
                </div>
            ` : `
                <div class="popup-actions">
                    <a href="https://www.google.com/maps/dir/?api=1&destination=${branch.coordinates[0]},${branch.coordinates[1]}" 
                       target="_blank" class="popup-btn primary">
                        <i class="bi bi-compass"></i> Lihat Rute
                    </a>
                </div>
            `}
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