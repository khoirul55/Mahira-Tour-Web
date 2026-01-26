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

