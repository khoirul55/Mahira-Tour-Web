// ===== MAHIRA TOUR - HOME.JS ULTRA OPTIMIZED =====
// Phase 1: Core functionality only, Alpine handles UI

(function() {
    'use strict';
    
    // ===== 1. SMOOTH SCROLL (Passive Listeners) =====
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                const href = this.getAttribute('href');
                if (href === '#') return;
                
                e.preventDefault();
                const target = document.querySelector(href);
                if (!target) return;
                
                const headerOffset = 80;
                const elementPosition = target.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
                
                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            }, { passive: false });
        });
    });
    
    // ===== 2. HERO VIDEO - Optimized Loop =====
    const initHeroVideo = () => {
        const heroVideo = document.querySelector('.hero-video');
        if (!heroVideo) return;
        
        let isTransitioning = false;
        
        // Preload and play
        heroVideo.load();
        const playPromise = heroVideo.play();
        if (playPromise !== undefined) {
            playPromise.catch(() => console.log('Autoplay prevented'));
        }
        
        // Seamless loop with fade
        heroVideo.addEventListener('timeupdate', function() {
            if (isTransitioning || !this.duration) return;
            
            const fadeStartTime = this.duration - 1.2;
            if (this.currentTime >= fadeStartTime) {
                isTransitioning = true;
                
                this.animate([{ opacity: 1 }, { opacity: 0 }], {
                    duration: 1000,
                    easing: 'ease-in-out',
                    fill: 'forwards'
                }).onfinish = () => {
                    this.currentTime = 0;
                    this.play();
                    
                    this.animate([{ opacity: 0 }, { opacity: 1 }], {
                        duration: 800,
                        easing: 'ease-in-out',
                        fill: 'forwards'
                    }).onfinish = () => {
                        isTransitioning = false;
                    };
                };
            }
        }, { passive: true });
        
        // Fallback
        heroVideo.addEventListener('ended', function() {
            if (!isTransitioning) {
                this.currentTime = 0;
                this.play();
            }
        }, { passive: true });
    };
    
    // ===== 3. STATS COUNTER - Debounced =====
    const initStatsCounter = () => {
        const counters = document.querySelectorAll('.stat-number');
        if (!counters.length) return;
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (!entry.isIntersecting) return;
                
                const counter = entry.target;
                const originalText = counter.textContent;
                const target = parseInt(originalText.replace(/\D/g, ''));
                if (!target) return;
                
                const isPercentage = originalText.includes('%');
                const hasPlus = originalText.includes('+');
                
                let count = 0;
                const increment = target / 50;
                
                const updateCount = () => {
                    if (count < target) {
                        count += increment;
                        let value = Math.ceil(count);
                        
                        if (value >= 1000) {
                            value = value.toLocaleString('id-ID');
                        }
                        
                        counter.textContent = value + (isPercentage ? '%' : hasPlus ? '+' : '');
                        requestAnimationFrame(updateCount);
                    } else {
                        counter.textContent = originalText;
                    }
                };
                
                updateCount();
                observer.unobserve(counter);
            });
        }, { threshold: 0.5, rootMargin: '0px' });
        
        counters.forEach(counter => observer.observe(counter));
    };
    
    // ===== 4. SCROLL ANIMATIONS - Batch Processing =====
    const initScrollAnimations = () => {
        const elements = document.querySelectorAll(
            '.package-card, .why-card, .testimonial-card, .stat-card'
        );
        if (!elements.length) return;
        
        const observer = new IntersectionObserver((entries) => {
            entries.forEach((entry, index) => {
                if (entry.isIntersecting) {
                    setTimeout(() => {
                        entry.target.style.opacity = '1';
                        entry.target.style.transform = 'translateY(0)';
                    }, index * 100);
                    observer.unobserve(entry.target);
                }
            });
        }, { threshold: 0.1, rootMargin: '0px 0px -50px 0px' });
        
        elements.forEach(element => {
            element.style.opacity = '0';
            element.style.transform = 'translateY(30px)';
            element.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
            observer.observe(element);
        });
    };
    
    // ===== 5. WHATSAPP FORM - Optimized =====
    const initWhatsAppForm = () => {
        const form = document.getElementById('inquiryForm');
        if (!form) return;
        
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const data = {
                name: formData.get('name'),
                email: formData.get('email'),
                phone: formData.get('phone'),
                package: formData.get('package'),
                message: formData.get('message') || 'Saya ingin konsultasi paket umrah'
            };
            
            // Clean phone number
            let cleanPhone = data.phone.replace(/\D/g, '');
            if (cleanPhone.startsWith('0')) {
                cleanPhone = '62' + cleanPhone.substring(1);
            } else if (!cleanPhone.startsWith('62')) {
                cleanPhone = '62' + cleanPhone;
            }
            
            const waMessage = `*Assalamualaikum Mahira Tour* 🕌

*KONSULTASI PAKET UMRAH*

📋 *Data Calon Jamaah:*
- Nama: ${data.name}
- Email: ${data.email}
- No. HP: ${data.phone}

📦 *Paket Diminati:*
${data.package}

💬 *Pesan:*
${data.message}

Mohon informasi lebih lanjut terkait paket yang saya minati. Terima kasih 🙏`;
            
            const waURL = `https://wa.me/6282184515310?text=${encodeURIComponent(waMessage)}`;
            
            // Close modal if exists
            const modal = bootstrap?.Modal?.getInstance(document.getElementById('inquiryModal'));
            if (modal) modal.hide();
            
            setTimeout(() => window.open(waURL, '_blank'), 300);
            this.reset();
            
            if (window.showNotification) {
                showNotification('Terima kasih! Anda akan diarahkan ke WhatsApp...', 'success');
            }
        });
    };
    
    // ===== 6. NAVBAR SCROLL - Throttled =====
    const initNavbarScroll = () => {
        const navbar = document.querySelector('.navbar');
        if (!navbar) return;
        
        let ticking = false;
        
        window.addEventListener('scroll', function() {
            if (ticking) return;
            
            window.requestAnimationFrame(() => {
                navbar.classList.toggle('scrolled', window.scrollY > 100);
                ticking = false;
            });
            
            ticking = true;
        }, { passive: true });
    };
    
    // ===== 7. PAGE VISIBILITY - Pause video when hidden =====
    const initPageVisibility = () => {
        document.addEventListener('visibilitychange', function() {
            const heroVideo = document.querySelector('.hero-video');
            if (!heroVideo) return;
            
            if (document.hidden) {
                heroVideo.pause();
            } else {
                heroVideo.play().catch(() => {});
            }
        });
    };
    
    // ===== 8. NOTIFICATION HELPER =====
    window.showNotification = function(message, type = 'info') {
        const notification = document.createElement('div');
        notification.className = `notification notification-${type}`;
        notification.style.cssText = `
            position: fixed;
            top: 100px;
            right: 30px;
            background: ${type === 'success' ? '#10B981' : '#0D9488'};
            color: white;
            padding: 16px 24px;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.2);
            z-index: 10000;
            animation: slideInRight 0.3s ease;
            max-width: 300px;
            font-weight: 500;
        `;
        
        notification.textContent = message;
        document.body.appendChild(notification);
        
        setTimeout(() => {
            notification.style.animation = 'slideOutRight 0.3s ease';
            setTimeout(() => notification.remove(), 300);
        }, 3000);
    };
    
    // Notification animations
    if (!document.querySelector('#notificationStyles')) {
        const style = document.createElement('style');
        style.id = 'notificationStyles';
        style.textContent = `
            @keyframes slideInRight {
                from { transform: translateX(400px); opacity: 0; }
                to { transform: translateX(0); opacity: 1; }
            }
            @keyframes slideOutRight {
                from { transform: translateX(0); opacity: 1; }
                to { transform: translateX(400px); opacity: 0; }
            }
        `;
        document.head.appendChild(style);
    }
    
    // ===== INITIALIZATION =====
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', init);
    } else {
        init();
    }
    
    function init() {
        initHeroVideo();
        initStatsCounter();
        initScrollAnimations();
        initWhatsAppForm();
        initNavbarScroll();
        initPageVisibility();
    }
    
    // ===== CLEANUP - Prevent memory leaks =====
    window.addEventListener('beforeunload', function() {
        // Observers will auto-cleanup when page unloads
        const heroVideo = document.querySelector('.hero-video');
        if (heroVideo) {
            heroVideo.pause();
            heroVideo.removeAttribute('src');
            heroVideo.load();
        }
    });
    // Navbar scroll effect
window.addEventListener('scroll', () => {
    const navbar = document.querySelector('.navbar-zen');
    if (window.scrollY > 50) {
        navbar.classList.add('scrolled');
    } else {
        navbar.classList.remove('scrolled');
    }
});
    
})();