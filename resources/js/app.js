// resources/js/app.js

import './bootstrap';
import Alpine from 'alpinejs';

// CRITICAL: Set Alpine BEFORE start
window.Alpine = Alpine;

// Start Alpine
Alpine.start();

// ==================== PAGE TRANSITION LOADING BAR ====================
(function() {
    const loader = document.getElementById('page-loader');
    const bar = document.getElementById('page-loader-bar');
    if (!loader || !bar) return;

    let progress = 0;
    let interval = null;

    function startLoader() {
        progress = 0;
        bar.style.width = '0%';
        loader.style.opacity = '1';
        
        interval = setInterval(() => {
            // Fast at first, slows near 90%
            if (progress < 60) progress += 8;
            else if (progress < 80) progress += 3;
            else if (progress < 90) progress += 0.5;
            bar.style.width = progress + '%';
            bar.style.transition = 'width 0.3s ease';
        }, 100);
    }

    function finishLoader() {
        clearInterval(interval);
        bar.style.width = '100%';
        bar.style.transition = 'width 0.2s ease';
        setTimeout(() => {
            loader.style.opacity = '0';
            setTimeout(() => { bar.style.width = '0%'; }, 200);
        }, 300);
    }

    // Intercept internal link clicks
    document.addEventListener('click', (e) => {
        const link = e.target.closest('a[href]');
        if (!link) return;
        
        const href = link.getAttribute('href');
        if (!href) return;
        
        // Skip external links, anchors, new tabs, javascript:, mailto:
        if (link.target === '_blank' || 
            link.hasAttribute('download') ||
            href.startsWith('#') || 
            href.startsWith('javascript:') || 
            href.startsWith('mailto:') || 
            href.startsWith('tel:') ||
            href.startsWith('http') && !href.includes(window.location.hostname)) {
            return;
        }
        
        startLoader();
    });

    // Form submissions
    document.addEventListener('submit', () => startLoader());

    // Finish when page loads (for browser back/forward)
    window.addEventListener('pageshow', finishLoader);

    // Finish on load
    window.addEventListener('load', finishLoader);
})();

// ==================== IMAGE SKELETON LOADING ====================
(function() {
    function setupImageLoading() {
        const images = document.querySelectorAll('img:not([data-skeleton-init])');
        
        images.forEach(img => {
            img.setAttribute('data-skeleton-init', 'true');
            
            // Skip tiny images (icons, avatars)
            if (img.width > 0 && img.width < 40) return;
            
            if (img.complete && img.naturalHeight > 0) {
                // Already loaded
                img.classList.add('img-loaded');
            } else {
                // Not yet loaded — add skeleton
                img.classList.add('img-skeleton');
                
                img.addEventListener('load', function() {
                    this.classList.remove('img-skeleton');
                    this.classList.add('img-loaded');
                }, { once: true });
                
                img.addEventListener('error', function() {
                    this.classList.remove('img-skeleton');
                }, { once: true });
            }
        });
    }

    // Run on DOM ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', setupImageLoading);
    } else {
        setupImageLoading();
    }

    // Re-run after Alpine updates (for dynamic content like gallery)
    document.addEventListener('alpine:initialized', () => {
        // Watch for DOM changes (Alpine re-renders)
        const observer = new MutationObserver(() => {
            requestAnimationFrame(setupImageLoading);
        });
        observer.observe(document.body, { childList: true, subtree: true });
    });
})();