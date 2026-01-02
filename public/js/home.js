// ===== GALLERY MODAL SYSTEM (FIXED) =====
const galleryImages = [
    { src: '/images/gallery/gallery-1.webp', alt: 'Jamaah di Masjid Nabawi' },
    { src: '/images/gallery/gallery-2.webp', alt: 'Jamaah di Jabal Rahmah' },
    { src: '/images/gallery/gallery-3.webp', alt: 'Jamaah di Masjidil Haram' },
    { src: '/images/gallery/gallery-4.webp', alt: 'Jamaah di Makkah' },
    { src: '/images/gallery/gallery-5.webp', alt: 'Jamaah di Madinah' },
    { src: '/images/gallery/gallery-6.webp', alt: 'Jamaah Mahira Tour' },
    { src: '/images/gallery/gallery-7.webp', alt: 'Jamaah Mahira Tour' },
    { src: '/images/gallery/gallery-8.webp', alt: 'Jamaah Mahira Tour' },
    { src: '/images/gallery/gallery-9.webp', alt: 'Jamaah Mahira Tour' },
    { src: '/images/gallery/gallery-10.webp', alt: 'Jamaah Mahira Tour' },
    { src: '/images/gallery/gallery-11.webp', alt: 'Jamaah Mahira Tour' },
    { src: '/images/gallery/gallery-12.webp', alt: 'Jamaah Mahira Tour' },
    { src: '/images/gallery/gallery-13.webp', alt: 'Jamaah Mahira Tour' },
    { src: '/images/gallery/gallery-14.webp', alt: 'Jamaah Mahira Tour' }
];

let currentGalleryIndex = 0;

// FIXED: Open Modal with Proper Image Loading
function openGalleryModal(index) {
    currentGalleryIndex = index;
    const modal = document.getElementById('galleryModal');
    const img = document.getElementById('galleryModalImg');
    const counter = document.getElementById('galleryCounter');
    
    if (!modal || !img || !counter) {
        console.error('Modal elements not found');
        return;
    }
    
    // Force reset styles
    img.style.display = 'block';
    img.style.visibility = 'visible';
    img.style.opacity = '0';
    
    // Show modal immediately
    modal.classList.add('active');
    document.body.style.overflow = 'hidden';
    
    // Load image
    img.onload = function() {
        img.style.transition = 'opacity 0.3s ease';
        img.style.opacity = '1';
    };
    
    img.onerror = function() {
        console.error('Failed to load image:', galleryImages[index].src);
        img.alt = 'Gagal memuat gambar';
    };
    
    img.src = galleryImages[index].src;
    img.alt = galleryImages[index].alt;
    counter.textContent = `${index + 1} / ${galleryImages.length}`;
}

// Close Modal
function closeGalleryModal() {
    const modal = document.getElementById('galleryModal');
    if (!modal) return;
    
    modal.classList.remove('active');
    document.body.style.overflow = 'auto';
    
    // Reset image
    const img = document.getElementById('galleryModalImg');
    if (img) {
        img.style.opacity = '0';
    }
}

// Change Gallery (Previous/Next)
function changeGallery(direction) {
    currentGalleryIndex += direction;
    
    if (currentGalleryIndex < 0) {
        currentGalleryIndex = galleryImages.length - 1;
    } else if (currentGalleryIndex >= galleryImages.length) {
        currentGalleryIndex = 0;
    }
    
    const img = document.getElementById('galleryModalImg');
    const counter = document.getElementById('galleryCounter');
    
    if (!img || !counter) return;
    
    // Smooth transition
    img.style.opacity = '0';
    img.style.transition = 'opacity 0.2s ease';
    
    setTimeout(() => {
        img.onload = function() {
            img.style.opacity = '1';
        };
        
        img.src = galleryImages[currentGalleryIndex].src;
        img.alt = galleryImages[currentGalleryIndex].alt;
        counter.textContent = `${currentGalleryIndex + 1} / ${galleryImages.length}`;
    }, 200);
}

// ===== EVENT LISTENERS (ADD IN DOMContentLoaded) =====
document.addEventListener('DOMContentLoaded', function() {
    
    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        const modal = document.getElementById('galleryModal');
        if (modal && modal.classList.contains('active')) {
            if (e.key === 'ArrowLeft') changeGallery(-1);
            if (e.key === 'ArrowRight') changeGallery(1);
            if (e.key === 'Escape') closeGalleryModal();
        }
    });

    // Close modal when clicking outside
    const galleryModal = document.getElementById('galleryModal');
    if (galleryModal) {
        galleryModal.addEventListener('click', function(e) {
            if (e.target === this) {
                closeGalleryModal();
            }
        });
    }
    
    // Prevent body scroll when modal is open
    if (galleryModal) {
        galleryModal.addEventListener('wheel', function(e) {
            e.preventDefault();
        }, { passive: false });
    }
    
    // ===== SMOOTH SCROLL =====
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            const target = document.querySelector(this.getAttribute('href'));
            if (target) {
                const headerOffset = 80;
                const elementPosition = target.getBoundingClientRect().top;
                const offsetPosition = elementPosition + window.pageYOffset - headerOffset;
                
                window.scrollTo({
                    top: offsetPosition,
                    behavior: 'smooth'
                });
            }
        });
    });
    
  // ===== SEAMLESS VIDEO LOOP - WEB ANIMATIONS API =====
const heroVideo = document.querySelector('.hero-video');

if (heroVideo) {
    let isTransitioning = false;
    
    // Preload video
    heroVideo.load();
    
    // Start playing
    heroVideo.play().catch(err => console.log('Autoplay prevented:', err));
    
    // Smooth loop with Web Animations API
    heroVideo.addEventListener('timeupdate', function() {
        // Start fade out 1.2 seconds before video ends
        const fadeStartTime = this.duration - 1.2;
        
        if (this.currentTime >= fadeStartTime && !isTransitioning) {
            isTransitioning = true;
            
            // Fade Out Animation (Native Web Animations API)
            const fadeOut = this.animate([
                { opacity: 1 },
                { opacity: 0 }
            ], {
                duration: 1000, // 1 second fade out
                easing: 'ease-in-out',
                fill: 'forwards'
            });
            
            // When fade out completes
            fadeOut.onfinish = () => {
                // Reset video to start
                this.currentTime = 0;
                this.play();
                
                // Fade In Animation
                const fadeIn = this.animate([
                    { opacity: 0 },
                    { opacity: 1 }
                ], {
                    duration: 800, // 0.8 second fade in
                    easing: 'ease-in-out',
                    fill: 'forwards'
                });
                
                // Reset transition flag
                fadeIn.onfinish = () => {
                    isTransitioning = false;
                };
            };
        }
    });
    
    // Fallback for 'ended' event
    heroVideo.addEventListener('ended', function() {
        if (!isTransitioning) {
            this.currentTime = 0;
            this.play();
        }
    });
}

    
    // ===== STATS COUNTER ANIMATION =====
    const counters = document.querySelectorAll('.stat-number');
    
    const observerOptions = {
        threshold: 0.5,
        rootMargin: '0px'
    };
    
    const counterObserver = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                const counter = entry.target;
                const originalText = counter.textContent;
                const target = originalText.replace(/[^0-9]/g, '');
                const isPercentage = originalText.includes('%');
                const hasPlus = originalText.includes('+');
                
                let count = 0;
                const speed = 50;
                const increment = target / speed;
                
                const updateCount = () => {
                    if (count < target) {
                        count += increment;
                        let displayValue = Math.ceil(count);
                        
                        if (displayValue >= 1000) {
                            displayValue = displayValue.toLocaleString('id-ID');
                        }
                        
                        if (isPercentage) {
                            counter.textContent = displayValue + '%';
                        } else if (hasPlus) {
                            counter.textContent = displayValue + '+';
                        } else {
                            counter.textContent = displayValue;
                        }
                        
                        requestAnimationFrame(updateCount);
                    } else {
                        counter.textContent = originalText;
                    }
                };
                
                updateCount();
                counterObserver.unobserve(counter);
            }
        });
    }, observerOptions);
    
    counters.forEach(counter => counterObserver.observe(counter));
    
    // ===== SCROLL ANIMATIONS FOR CARDS =====
    const animatedElements = document.querySelectorAll(
        '.package-card, .why-card, .testimonial-card, .gallery-item, .stat-card'
    );
    
    const cardObserver = new IntersectionObserver((entries) => {
        entries.forEach((entry, index) => {
            if (entry.isIntersecting) {
                setTimeout(() => {
                    entry.target.style.opacity = '1';
                    entry.target.style.transform = 'translateY(0)';
                }, index * 100);
                
                cardObserver.unobserve(entry.target);
            }
        });
    }, {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    });
    
    animatedElements.forEach(element => {
        element.style.opacity = '0';
        element.style.transform = 'translateY(30px)';
        element.style.transition = 'opacity 0.6s ease, transform 0.6s ease';
        cardObserver.observe(element);
    });
    
    // ===== INQUIRY FORM HANDLER =====
    const inquiryForm = document.getElementById('inquiryForm');
    if (inquiryForm) {
        inquiryForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            const formData = new FormData(this);
            const name = formData.get('name');
            const email = formData.get('email');
            const phone = formData.get('phone');
            const packageType = formData.get('package');
            const message = formData.get('message') || 'Saya ingin konsultasi paket umrah';
            
            let cleanPhone = phone.replace(/\D/g, '');
            if (cleanPhone.startsWith('0')) {
                cleanPhone = '62' + cleanPhone.substring(1);
            } else if (!cleanPhone.startsWith('62')) {
                cleanPhone = '62' + cleanPhone;
            }
            
            const waMessage = `
*Assalamualaikum Mahira Tour* 🕌

*KONSULTASI PAKET UMRAH*

📋 *Data Calon Jamaah:*
- Nama: ${name}
- Email: ${email}
- No. HP: ${phone}

📦 *Paket Diminati:*
${packageType}

💬 *Pesan:*
${message}

Mohon informasi lebih lanjut terkait paket yang saya minati. Terima kasih 🙏
            `.trim();
            
            const waNumber = '6282184515310';
            const waURL = `https://wa.me/${waNumber}?text=${encodeURIComponent(waMessage)}`;
            
            const modal = bootstrap.Modal.getInstance(document.getElementById('inquiryModal'));
            if (modal) {
                modal.hide();
            }
            
            setTimeout(() => {
                window.open(waURL, '_blank');
            }, 300);
            
            this.reset();
            showNotification('Terima kasih! Anda akan diarahkan ke WhatsApp...', 'success');
        });
    }
    

    
    // ===== PACKAGE CARDS HOVER EFFECT =====
    const packageCards = document.querySelectorAll('.package-card');
    packageCards.forEach(card => {
        card.addEventListener('mouseenter', function() {
            this.style.zIndex = '10';
        });
        
        card.addEventListener('mouseleave', function() {
            this.style.zIndex = '1';
        });
    });
    
    // ===== VIDEO TESTIMONIALS PLAY ON HOVER =====
    const testimonialVideos = document.querySelectorAll('.testimonial-video video');
    testimonialVideos.forEach(video => {
        const parent = video.closest('.testimonial-card');
        
        parent.addEventListener('mouseenter', function() {
            video.play();
        });
        
        parent.addEventListener('mouseleave', function() {
            video.pause();
            video.currentTime = 0;
        });
    });
    
    // ===== NAVBAR BACKGROUND ON SCROLL =====
    const navbar = document.querySelector('.navbar');
    if (navbar) {
        window.addEventListener('scroll', function() {
            if (window.scrollY > 100) {
                navbar.classList.add('scrolled');
            } else {
                navbar.classList.remove('scrolled');
            }
        });
    }
    
    // ===== NOTIFICATION HELPER =====
    function showNotification(message, type = 'info') {
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
            setTimeout(() => {
                notification.remove();
            }, 300);
        }, 3000);
    }
    
    // Add animation keyframes
    if (!document.querySelector('#notificationStyles')) {
        const style = document.createElement('style');
        style.id = 'notificationStyles';
        style.textContent = `
            @keyframes slideInRight {
                from {
                    transform: translateX(400px);
                    opacity: 0;
                }
                to {
                    transform: translateX(0);
                    opacity: 1;
                }
            }
            
            @keyframes slideOutRight {
                from {
                    transform: translateX(0);
                    opacity: 1;
                }
                to {
                    transform: translateX(400px);
                    opacity: 0;
                }
            }
        `;
        document.head.appendChild(style);
    }
});