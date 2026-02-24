// Branch data with coordinates
const branchesWithCoords = [
    {id: 1, name: "Sungai Penuh", region: "Jambi", address: "Jl. Muradi, Desa Koto Keras, Kecamatan Pesisir Bukit", phone: "082184515310", coordinates: [-2.0621, 101.3953], isMain: true, mapLink: ""},
    {id: 2, name: "Padang", region: "Sumatera Barat", address: "Taruko I, Jl. Raya No.66 A, Korong Gadang", coordinates: [-0.9155963, 100.4001498], isMain: false, mapLink: "https://maps.app.goo.gl/bN6zG5ds5Ynutf3k9?g_st=aw"},
    {id: 3, name: "Jambi", region: "Jambi", address: "Gg. Nuri 1, RT.25/RW.no 16, Jelutung", coordinates: [-1.6116861, 103.6184803], isMain: false, mapLink: "https://maps.app.goo.gl/DZ4fU5dQsnxJXg3L8"},
    {id: 4, name: "Bungo", region: "Jambi", address: "Suka Jaya, Kabupaten Bungo", coordinates: [-1.507646, 102.061605], isMain: false, mapLink: "https://maps.app.goo.gl/CUKHXVoTSiyZyNif6?g_st=aw"},
    {id: 5, name: "Tebo", region: "Jambi", address: "Jl. Padang Lamo, Tlk. Kuali, Kec. Tebo Ulu", coordinates: [-1.21661, 102.195169], isMain: false, mapLink: "https://maps.app.goo.gl/sBNookviKWUfWY1bA?g_st=aw"},
    {id: 6, name: "Merangin", region: "Jambi", address: "Muara Panco Barat, Kec. Renah Pembarap", coordinates: [-2.0833, 101.6833], isMain: false, mapLink: ""}
];

// Initialize map with interaction disabled initially
const map = L.map('map', {
    scrollWheelZoom: false,
    dragging: !L.Browser.mobile,
    tap: false
}).setView([-1.5, 102], 6);

L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '© OpenStreetMap contributors',
    maxZoom: 19
}).addTo(map);

// Enable interaction on click/focus
map.on('click', function() {
    if (L.Browser.mobile) {
        map.dragging.enable();
        map.tap && map.tap.enable();
    }
    map.scrollWheelZoom.enable();
});

map.on('mouseout', function() {
    map.scrollWheelZoom.disable();
});

const markers = {};

// SVG icons (no Bootstrap Icons dependency)
const svgIcons = {
    building: '<svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M4 4a2 2 0 012-2h8a2 2 0 012 2v12a1 1 0 110 2h-3a1 1 0 01-1-1v-2a1 1 0 00-1-1H9a1 1 0 00-1 1v2a1 1 0 01-1 1H4a1 1 0 110-2V4zm3 1h2v2H7V5zm2 4H7v2h2V9zm2-4h2v2h-2V5zm2 4h-2v2h2V9z" clip-rule="evenodd"/></svg>',
    pin: '<svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M5.05 4.05a7 7 0 119.9 9.9L10 18.9l-4.95-4.95a7 7 0 010-9.9zM10 11a2 2 0 100-4 2 2 0 000 4z" clip-rule="evenodd"/></svg>',
    phone: '<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z"/></svg>',
    map: '<svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M12 1.586l-4 4v12.828l4-4V1.586zM3.707 3.293A1 1 0 002 4v10a1 1 0 00.293.707L6 18.414V5.586L3.707 3.293zM17.707 5.293L14 1.586v12.828l2.293 2.293A1 1 0 0018 16V6a1 1 0 00-.293-.707z" clip-rule="evenodd"/></svg>'
};

function createCustomIcon(isMain) {
    const size = isMain ? 44 : 36;
    const bg = isMain ? '#D4AF37' : '#10B981';
    return L.divIcon({
        className: '',
        html: `<div style="
            width:${size}px; height:${size}px;
            background:${bg}; border-radius:50%;
            display:flex; align-items:center; justify-content:center;
            color:white; box-shadow:0 4px 12px rgba(0,0,0,0.3);
            border:3px solid white;
        ">${isMain ? svgIcons.building : svgIcons.pin}</div>`,
        iconSize: [size, size],
        iconAnchor: [size/2, size],
        popupAnchor: [0, -size]
    });
}

function createPopupContent(branch) {
    const mapUrl = branch.mapLink ? branch.mapLink : `https://www.google.com/maps/dir/?api=1&destination=${branch.coordinates[0]},${branch.coordinates[1]}`;
    
    return `
        <div style="padding:12px 14px; min-width:220px;">
            ${branch.isMain ? '<div style="display:inline-block; background:#D4AF37; color:white; padding:2px 10px; border-radius:50px; font-size:0.7rem; font-weight:700; margin-bottom:8px; text-transform:uppercase;">Kantor Pusat</div>' : ''}
            <h4 style="margin:0 0 4px 0; font-size:1.1rem; font-weight:700; color:#001D5F;">${branch.name}</h4>
            <p style="margin:0 0 10px 0; font-size:0.85rem; color:#6B7280; display:flex; align-items:flex-start; gap:6px; line-height:1.5;">
                ${svgIcons.pin} ${branch.address}
            </p>
            <div style="display:flex; gap:8px; flex-wrap:wrap;">
                ${branch.phone ? `
                    <a href="tel:${branch.phone}" style="display:inline-flex; align-items:center; gap:5px; padding:6px 14px; background:#001D5F; color:white; border-radius:6px; text-decoration:none; font-size:0.8rem; font-weight:600; transition:all 0.3s;">
                        ${svgIcons.phone} Hubungi
                    </a>
                ` : ''}
                <a href="${mapUrl}" target="_blank" style="display:inline-flex; align-items:center; gap:5px; padding:6px 14px; background:${branch.phone ? '#F3F4F6' : '#001D5F'}; color:${branch.phone ? '#001D5F' : 'white'}; border-radius:6px; text-decoration:none; font-size:0.8rem; font-weight:600; transition:all 0.3s;">
                    ${svgIcons.map} Google Maps
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

// Render branch cards with Tailwind styles
function renderBranchCards() {
    const container = document.getElementById('branchCardsContainer');
    if (!container) return;
    
    const cardsHTML = branchesWithCoords.map(branch => {
        const isMain = branch.isMain;
        // Tailwind classes based on branch type
        const cardClasses = isMain 
            ? 'bg-gradient-to-br from-[#D4AF37] to-[#C5A028] text-white hover:border-white/50' 
            : 'bg-white hover:border-[#10B981] text-[#1F2937]';
            
        const iconContainerClasses = isMain
            ? 'bg-white/20 text-white'
            : 'bg-[#10B981]/15 text-[#10B981]';
            
        const regionColorClass = isMain ? 'text-white/90' : 'text-gray-500';
        const addressColorClass = isMain ? 'text-white/95' : 'text-gray-500';
        const borderColorClass = isMain ? 'border-white/20' : 'border-gray-200';
        
        return `
        <div class="branch-card relative min-w-[280px] rounded-2xl p-5 cursor-pointer transition-all duration-300 border-2 border-transparent shadow-[0_4px_15px_rgba(0,29,95,0.08)] hover:-translate-y-1 hover:shadow-[0_8px_25px_rgba(0,29,95,0.12)] group ${cardClasses}" 
             data-id="${branch.id}" 
             onclick="focusBranch(${branch.id})">
             
            <div class="flex items-center gap-3 mb-3">
                <div class="w-12 h-12 rounded-xl flex items-center justify-center shrink-0 ${iconContainerClasses}">
                    ${isMain ? svgIcons.building : svgIcons.pin}
                </div>
                <div>
                    <h4 class="text-[1.1rem] font-bold m-0 mb-0.5 leading-tight">${branch.name}</h4>
                    <p class="text-[0.8rem] m-0 ${regionColorClass}">${branch.region}</p>
                </div>
            </div>
            
            <div class="pt-3 border-t ${borderColorClass}">
                <div class="text-[0.85rem] leading-relaxed flex gap-2 ${addressColorClass}">
                    <span class="shrink-0 mt-0.5 ${isMain ? 'text-white' : 'text-[#10B981]'}">${svgIcons.pin}</span>
                    <span>${branch.address}</span>
                </div>
                ${isMain ? `<div class="inline-block bg-white/30 text-white px-3 py-1 rounded-full text-[0.7rem] font-bold uppercase mt-2.5">Kantor Pusat</div>` : ''}
            </div>
        </div>`;
    }).join('');
    
    container.innerHTML = cardsHTML;
}

// Focus on branch when card clicked
function focusBranch(branchId) {
    const branch = branchesWithCoords.find(b => b.id === branchId);
    if (!branch) return;
    
    map.flyTo(branch.coordinates, 13, {duration: 1.5});
    
    // Reset all cards
    document.querySelectorAll('.branch-card').forEach(card => {
        card.style.transform = '';
        card.style.borderColor = 'transparent';
    });
    
    // Highlight clicked card
    const clickedCard = event.target.closest('.branch-card');
    if (clickedCard) {
        clickedCard.style.transform = 'translateY(-5px)';
        clickedCard.style.borderColor = branch.isMain ? '#D4AF37' : '#10B981';
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