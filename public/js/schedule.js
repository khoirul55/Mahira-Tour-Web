// Initialize AOS
AOS.init({
    duration: 800,
    once: true,
    offset: 100
});

// ===== FILTER FUNCTIONALITY =====
document.querySelectorAll('.filter-btn').forEach(btn => {
    btn.addEventListener('click', function() {
        // Update active state
        document.querySelectorAll('.filter-btn').forEach(b => b.classList.remove('active'));
        this.classList.add('active');
        
        const filter = this.dataset.filter;
        const items = document.querySelectorAll('.package-item');
        
        items.forEach(item => {
            if (filter === 'all' || item.dataset.type === filter) {
                item.style.display = 'block';
                setTimeout(() => {
                    item.style.opacity = '1';
                    item.style.transform = 'scale(1)';
                }, 10);
            } else {
                item.style.opacity = '0';
                item.style.transform = 'scale(0.9)';
                setTimeout(() => {
                    item.style.display = 'none';
                }, 300);
            }
        });
    });
});

// ===== FLYER MODAL SYSTEM =====
function openFlyerModal(imageSrc, title, meta) {
    const modal = document.getElementById('flyerModal');
    const img = document.getElementById('flyerModalImg');
    const titleEl = document.getElementById('flyerModalTitle');
    const metaEl = document.getElementById('flyerModalMeta');
    
    if (!modal || !img) {
        console.error('Modal elements not found');
        return;
    }
    
    // Show modal
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
    
    // Set content
    img.src = imageSrc;
    img.alt = title;
    
    if (titleEl) titleEl.textContent = title;
    if (metaEl) metaEl.textContent = meta;
}

function closeFlyerModal() {
    const modal = document.getElementById('flyerModal');
    if (!modal) return;
    
    modal.classList.remove('active');
    document.body.style.overflow = 'auto';
}

// Close modal with Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        const modal = document.getElementById('flyerModal');
        if (modal && modal.classList.contains('active')) {
            closeFlyerModal();
        }
    }
});

// Close when clicking outside
document.getElementById('flyerModal')?.addEventListener('click', function(e) {
    if (e.target === this) {
        closeFlyerModal();
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