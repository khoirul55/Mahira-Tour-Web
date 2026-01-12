// Initialize AOS
AOS.init({
    duration: 800,
    once: true,
    offset: 100
});

// ===== SCHEDULE DATA =====
const schedulesData = {
    1: {
        id: 1,
        package_name: 'Paket Berkah - Special Promo',
        departure_date: '2026-01-24',
        return_date: '2026-02-04',
        departure_route: 'Start Padang',
        price: 28900000,
        airline: 'Padang - Kull - Jeddah',
        flyer_image: 'flyer-umrah-januari-2026.jpg',
        quota: 45,
        seats_taken: 12,
        status: 'available'
    },
    2: {
        id: 2,
        package_name: 'Paket Mahabbah - Special Promo',
        departure_date: '2026-01-24',
        return_date: '2026-02-04',
        departure_route: 'Start Padang',
        price: 31500000,
        airline: 'Padang - Kull - Jeddah',
        flyer_image: 'flyer-umrah-januari-2026.jpg',
        quota: 40,
        seats_taken: 18,
        status: 'available'
    },
    3: {
        id: 3,
        package_name: 'Paket Gold - Special Promo',
        departure_date: '2026-01-24',
        return_date: '2026-02-04',
        departure_route: 'Start Padang',
        price: 35500000,
        airline: 'Padang - Kull - Jeddah',
        flyer_image: 'flyer-umrah-januari-2026.jpg',
        quota: 35,
        seats_taken: 8,
        status: 'available'
    },
    4: {
        id: 4,
        package_name: 'Umrah Awal Ramadhan',
        departure_date: '2026-02-23',
        return_date: '2026-03-06',
        departure_route: 'Start Padang',
        price: 38900000,
        airline: 'PDG - JED (Terbang Langsung)',
        flyer_image: 'flyer-umrah-ramadhan-2026.jpg',
        quota: 45,
        seats_taken: 28,
        status: 'almost_full'
    },
    5: {
        id: 5,
        package_name: 'Paket Reguler - Keberangkatan Syawal',
        departure_date: '2026-02-23',
        return_date: '2026-03-04',
        departure_route: 'Start Padang',
        price: 29900000,
        airline: 'Batik Air',
        flyer_image: 'flyer-umrah-syawal-2026.jpg',
        quota: 40,
        seats_taken: 8,
        status: 'available'
    },
    6: {
        id: 6,
        package_name: 'Paket Gold 5⭐ - Keberangkatan Syawal',
        departure_date: '2026-02-23',
        return_date: '2026-03-04',
        departure_route: 'Start Padang',
        price: 35900000,
        airline: 'Batik Air',
        flyer_image: 'flyer-umrah-syawal-2026.jpg',
        quota: 35,
        seats_taken: 15,
        status: 'available'
    }
};


// ===== DETAIL MODAL SYSTEM =====
function openDetailModal(scheduleId) {
    const schedule = schedulesData[scheduleId];
    if (!schedule) {
        console.error('Schedule not found:', scheduleId);
        return;
    }
    
    const modal = document.getElementById('detailModal');
    
    // Populate modal content
    document.getElementById('modalPackageName').textContent = schedule.package_name;
    document.getElementById('modalFlyerImage').src = `/storage/flyers/${schedule.flyer_image}`;
    document.getElementById('modalFlyerImage').alt = schedule.package_name;
    
    // Format dates
    const departureDate = formatDate(schedule.departure_date);
    const returnDate = formatDate(schedule.return_date);
    
    document.getElementById('modalDepartureDate').textContent = departureDate;
    document.getElementById('modalReturnDate').textContent = returnDate;
    document.getElementById('modalRoute').textContent = schedule.departure_route;
    document.getElementById('modalAirline').textContent = schedule.airline;
    document.getElementById('modalPrice').textContent = formatPrice(schedule.price);
    
    // Availability
    const available = schedule.quota - schedule.seats_taken;
    const statusText = schedule.status === 'full' 
        ? '❌ Kuota Penuh' 
        : `✅ ${available} Kursi Tersedia`;
    document.getElementById('modalAvailability').textContent = statusText;
    
    // Update register buttons
    const registerUrl = `/register?schedule_id=${scheduleId}`;
    document.getElementById('modalRegisterBtn').href = registerUrl;
    document.getElementById('modalRegisterBtnBottom').href = registerUrl;
    
    // Show modal
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
    
    // Add click listener to flyer for zoom
    const flyerImg = document.getElementById('modalFlyerImage');
    flyerImg.onclick = function() {
        this.classList.toggle('zoomed');
    };
}

function closeDetailModal() {
    const modal = document.getElementById('detailModal');
    modal.classList.remove('active');
    document.body.style.overflow = 'auto';
}

// ===== HELPER FUNCTIONS =====
function formatDate(dateString) {
    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
    const date = new Date(dateString);
    const day = date.getDate();
    const month = months[date.getMonth()];
    const year = date.getFullYear();
    return `${day} ${month} ${year}`;
}

function formatPrice(price) {
    return 'Rp ' + price.toLocaleString('id-ID');
}

// ===== KEYBOARD SHORTCUTS =====
document.addEventListener('keydown', function(e) {
    const modal = document.getElementById('detailModal');
    
    // ESC to close
    if (e.key === 'Escape' && modal.classList.contains('active')) {
        closeDetailModal();
    }
});

// ===== SMOOTH SCROLL =====
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
        e.preventDefault();
        const target = document.querySelector(this.getAttribute('href'));
        if (target) {
            target.scrollIntoView({
                behavior: 'smooth',
                block: 'start'
            });
        }
    });
});