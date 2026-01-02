{{-- File: resources/views/components/testimonial-card.blade.php --}}
{{-- 
    Komponen Card Testimoni (Foto Only - No Video)
    Props: $testimonial (array dengan keys: name, location, package, rating, comment, date, image)
--}}

<div class="testimonial-card-premium">
    <!-- Card Header dengan Foto Besar -->
    <div class="card-image-wrapper">
        <img src="{{ $testimonial['image'] }}" alt="{{ $testimonial['name'] }}" class="card-main-image">
        <div class="image-overlay"></div>
        
    </div>
    
    <!-- Card Body -->
    <div class="card-content">
        <!-- Quote Icon Decorative -->
        <div class="quote-decoration">
            <i class="bi bi-quote"></i>
        </div>
        
        <!-- Testimonial Text dengan Typography Menarik -->
        <blockquote class="testimonial-text">
            "{{ $testimonial['comment'] }}"
        </blockquote>
        
        <!-- Divider Decorative -->
        <div class="divider-decorative">
            <span class="divider-dot"></span>
            <span class="divider-line"></span>
            <span class="divider-dot"></span>
        </div>
        
        <!-- Author Info -->
        <div class="author-info">
            <div class="author-avatar-small">
                <img src="{{ $testimonial['image'] }}" alt="{{ $testimonial['name'] }}">
            </div>
            <div class="author-details">
                <h3 class="author-name">{{ $testimonial['name'] }}</h3>
                <p class="author-meta">
                    <i class="bi bi-geo-alt-fill"></i>
                    <span>{{ $testimonial['location'] }}</span>
                    <span class="separator">•</span>
                    <i class="bi bi-calendar3"></i>
                    <span>{{ \Carbon\Carbon::parse($testimonial['date'])->locale('id')->format('M Y') }}</span>
                </p>
            </div>
        </div>
        
        <!-- Package Tag -->
        <div class="package-tag">
            <i class="bi bi-box-seam"></i>
            {{ $testimonial['package'] }}
        </div>
    </div>
    
    <!-- Decorative Corner -->
    <div class="corner-decoration corner-top-right"></div>
    <div class="corner-decoration corner-bottom-left"></div>
</div>

<!-- Premium Styles -->
<style>
    /* ==========================================
       PREMIUM TESTIMONIAL CARD DESIGN
       Modern, Aesthetic & Eye-catching
       ========================================== */
    
    .testimonial-card-premium {
        position: relative;
        background: white;
        border-radius: 24px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0, 29, 95, 0.08);
        transition: all 0.5s cubic-bezier(0.4, 0, 0.2, 1);
        height: 100%;
        display: flex;
        flex-direction: column;
    }
    
    .testimonial-card-premium:hover {
        transform: translateY(-15px) scale(1.02);
        box-shadow: 0 25px 60px rgba(0, 29, 95, 0.18);
    }
    
    /* === IMAGE SECTION === */
    .card-image-wrapper {
        position: relative;
        width: 100%;
        height: 320px;
        overflow: hidden;
    }
    
    .card-main-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s ease;
    }
    
    .testimonial-card-premium:hover .card-main-image {
        transform: scale(1.1);
    }
    
    .image-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(
            180deg,
            rgba(0, 29, 95, 0.1) 0%,
            rgba(0, 29, 95, 0.4) 70%,
            rgba(0, 29, 95, 0.7) 100%
        );
        transition: opacity 0.4s ease;
    }
    
    .testimonial-card-premium:hover .image-overlay {
        opacity: 0.8;
    }
    
    /* === RATING BADGE === */
    .rating-badge-float {
        position: absolute;
        top: 20px;
        right: 20px;
        background: rgba(255, 255, 255, 0.95);
        backdrop-filter: blur(15px);
        padding: 10px 16px;
        border-radius: 50px;
        display: flex;
        gap: 4px;
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.15);
        z-index: 5;
        animation: floatBadge 3s ease-in-out infinite;
    }
    
    @keyframes floatBadge {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-8px); }
    }
    
    .rating-badge-float i {
        color: #FFA500;
        font-size: 0.9rem;
    }
    
    /* === CARD CONTENT === */
    .card-content {
        padding: 2rem 1.75rem 1.75rem;
        flex: 1;
        display: flex;
        flex-direction: column;
        position: relative;
    }
    
    /* === QUOTE DECORATION === */
    .quote-decoration {
        position: absolute;
        top: -30px;
        left: 30px;
        width: 60px;
        height: 60px;
        background: linear-gradient(135deg, #001D5F 0%, #002875 100%);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 10px 30px rgba(0, 29, 95, 0.25);
        animation: pulseQuote 2s ease-in-out infinite;
    }
    
    @keyframes pulseQuote {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.05); }
    }
    
    .quote-decoration i {
        color: white;
        font-size: 2rem;
    }
    
    /* === TESTIMONIAL TEXT === */
    .testimonial-text {
        margin: 2rem 0 1.5rem;
        font-size: 1rem;
        line-height: 1.8;
        color: #374151;
        font-style: italic;
        font-weight: 400;
        position: relative;
        padding-left: 1rem;
        border-left: 3px solid #001D5F;
        font-family: 'Georgia', serif;
    }
    
    /* === DIVIDER === */
    .divider-decorative {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 12px;
        margin: 1.5rem 0;
    }
    
    .divider-line {
        flex: 1;
        height: 2px;
        background: linear-gradient(
            90deg,
            transparent 0%,
            #E5E7EB 50%,
            transparent 100%
        );
    }
    
    .divider-dot {
        width: 8px;
        height: 8px;
        background: #001D5F;
        border-radius: 50%;
    }
    
    /* === AUTHOR INFO === */
    .author-info {
        display: flex;
        align-items: center;
        gap: 1rem;
        margin-bottom: 1.25rem;
    }
    
    .author-avatar-small {
        width: 50px;
        height: 50px;
        border-radius: 50%;
        overflow: hidden;
        border: 3px solid #001D5F;
        box-shadow: 0 4px 15px rgba(0, 29, 95, 0.2);
        flex-shrink: 0;
    }
    
    .author-avatar-small img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    
    .author-details {
        flex: 1;
    }
    
    .author-name {
        font-size: 1.1rem;
        font-weight: 700;
        color: #001D5F;
        margin: 0 0 0.25rem 0;
        line-height: 1.2;
    }
    
    .author-meta {
        font-size: 0.8rem;
        color: #6B7280;
        margin: 0;
        display: flex;
        align-items: center;
        gap: 6px;
        flex-wrap: wrap;
    }
    
    .author-meta i {
        font-size: 0.75rem;
    }
    
    .separator {
        color: #D1D5DB;
        font-weight: 700;
    }
    
    /* === PACKAGE TAG === */
    .package-tag {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: linear-gradient(135deg, rgba(0, 29, 95, 0.1) 0%, rgba(0, 40, 117, 0.15) 100%);
        color: #001D5F;
        padding: 10px 18px;
        border-radius: 50px;
        font-size: 0.85rem;
        font-weight: 600;
        border: 2px solid rgba(0, 29, 95, 0.1);
        margin-top: auto;
        transition: all 0.3s ease;
        align-self: flex-start;
    }
    
    .package-tag:hover {
        background: linear-gradient(135deg, #001D5F 0%, #002875 100%);
        color: white;
        border-color: #001D5F;
        transform: translateX(5px);
    }
    
    .package-tag i {
        font-size: 1rem;
    }
    
    /* === DECORATIVE CORNERS === */
    .corner-decoration {
        position: absolute;
        width: 80px;
        height: 80px;
        opacity: 0.05;
        pointer-events: none;
    }
    
    .corner-top-right {
        top: -10px;
        right: -10px;
        background: radial-gradient(circle at top right, #001D5F 0%, transparent 70%);
    }
    
    .corner-bottom-left {
        bottom: -10px;
        left: -10px;
        background: radial-gradient(circle at bottom left, #001D5F 0%, transparent 70%);
    }
    
    /* === RESPONSIVE === */
    @media (max-width: 768px) {
        .card-image-wrapper {
            height: 280px;
        }
        
        .testimonial-text {
            font-size: 0.95rem;
        }
    }
</style>