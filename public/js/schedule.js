// Initialize AOS
AOS.init({
    duration: 800,
    once: true,
    offset: 100
});

// ===== DYNAMIC DATA FROM DOM (NO HARDCODE) =====
let schedulesData = {};

document.addEventListener('DOMContentLoaded', function() {
    const scheduleCards = document.querySelectorAll('[data-schedule-id]');
    
    scheduleCards.forEach(card => {
        const id = card.getAttribute('data-schedule-id');
        
        // ✅ Build data dari DOM
        schedulesData[id] = {
            id: parseInt(id),
            package_name: card.querySelector('.flyer-title').textContent.trim(),
            departure_date: card.getAttribute('data-departure-date'),
            return_date: card.getAttribute('data-return-date'),
            departure_route: card.getAttribute('data-route'),
            airline: card.getAttribute('data-airline'),
            duration: card.getAttribute('data-duration'),
            price: parseInt(card.getAttribute('data-price')),
            quota: parseInt(card.getAttribute('data-quota')),
            seats_taken: parseInt(card.getAttribute('data-seats-taken')),
            status: card.getAttribute('data-status'),
            flyer_image: card.querySelector('.flyer-image').src // ✅ Full URL dari browser
        };
    });
    
    console.log('✅ Schedule data loaded:', schedulesData);
});

// ===== MODAL FUNCTIONS =====
function openDetailModal(scheduleId) {
    const schedule = schedulesData[scheduleId];
    if (!schedule) {
        console.error('❌ Schedule not found:', scheduleId);
        return;
    }
    
    const modal = document.getElementById('detailModal');
    
    // Populate modal
    document.getElementById('modalPackageName').textContent = schedule.package_name;
    document.getElementById('modalFlyerImage').src = schedule.flyer_image;
    document.getElementById('modalFlyerImage').alt = schedule.package_name;
    
    document.getElementById('modalDepartureDate').textContent = formatDate(schedule.departure_date);
    document.getElementById('modalReturnDate').textContent = formatDate(schedule.return_date);
    document.getElementById('modalRoute').textContent = schedule.departure_route;
    document.getElementById('modalAirline').textContent = schedule.airline;
    document.getElementById('modalPrice').textContent = formatPrice(schedule.price);
    
    const available = schedule.quota - schedule.seats_taken;
    document.getElementById('modalAvailability').textContent = 
        schedule.status === 'full' ? '❌ Kuota Penuh' : `✅ ${available} Kursi Tersedia`;
    
    // Update buttons
    const registerUrl = `/register?schedule_id=${scheduleId}`;
    document.getElementById('modalRegisterBtn').href = registerUrl;
    document.getElementById('modalRegisterBtnBottom').href = registerUrl;
    
    // Show modal
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
    
    // Zoom flyer on click
    const flyerImg = document.getElementById('modalFlyerImage');
    flyerImg.onclick = () => flyerImg.classList.toggle('zoomed');
}

function closeDetailModal() {
    const modal = document.getElementById('detailModal');
    modal.classList.remove('active');
    document.body.style.overflow = 'auto';
}

// Helper functions
function formatDate(dateString) {
    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Agu', 'Sep', 'Okt', 'Nov', 'Des'];
    const date = new Date(dateString);
    return `${date.getDate()} ${months[date.getMonth()]} ${date.getFullYear()}`;
}

function formatPrice(price) {
    return 'Rp ' + price.toLocaleString('id-ID');
}

// Keyboard shortcuts
document.addEventListener('keydown', (e) => {
    if (e.key === 'Escape' && document.getElementById('detailModal').classList.contains('active')) {
        closeDetailModal();
    }
});

function openDetailModal(scheduleId) {
    const schedule = schedulesData[scheduleId];
    if (!schedule) {
        console.error('Schedule not found:', scheduleId);
        return;
    }
    
    const modal = document.getElementById('detailModal');
    
    // Populate modal
    document.getElementById('modalPackageName').textContent = schedule.package_name;
    document.getElementById('modalFlyerImage').src = schedule.flyer_image;
    document.getElementById('modalFlyerImage').alt = schedule.package_name;
    
    document.getElementById('modalDepartureDate').textContent = formatDate(schedule.departure_date);
    document.getElementById('modalReturnDate').textContent = formatDate(schedule.return_date);
    // HAPUS 2 baris ini - element tidak ada di HTML:
    // document.getElementById('modalRoute').textContent = schedule.departure_route;
    // document.getElementById('modalDuration').textContent = schedule.duration;
    
    document.getElementById('modalAirline').textContent = schedule.airline;
    document.getElementById('modalDuration').textContent = schedule.duration; // INI SUDAH ADA
    document.getElementById('modalPrice').textContent = formatPrice(schedule.price);
    
    const available = schedule.quota - schedule.seats_taken;
    document.getElementById('modalAvailability').textContent = 
        schedule.status === 'full' ? 'Kuota Penuh' : `${available} dari ${schedule.quota} Jamaah`;
    
    // Update button
    const registerUrl = `/register?schedule_id=${scheduleId}`;
    document.getElementById('modalRegisterBtnBottom').href = registerUrl;
    
    // Show modal
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
}