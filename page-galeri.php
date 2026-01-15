<?php

/**
 * Template Name: Galeri Page
 * Description: Gallery page with hero and lightbox image viewer
 */
get_header();

// Get Gallery Hero Section Settings
$galeri_hero_image = get_theme_mod('smk_galeri_hero_image', get_template_directory_uri() . '/assets/images/hero-default.jpg');
$galeri_hero_title = get_theme_mod('smk_galeri_hero_title', 'Galeri');
$galeri_hero_text = get_theme_mod('smk_galeri_hero_text', 'Dokumentasi kegiatan dan momen berharga di SMK Kesehatan Bali Dewata');

// Get gallery count (dynamic, 1-30)
$galeri_count = absint(get_theme_mod('smk_galeri_count', 12));
if ($galeri_count < 1) $galeri_count = 1;
if ($galeri_count > 30) $galeri_count = 30;

// Get Gallery Images
$gallery_images = [];
for ($i = 1; $i <= $galeri_count; $i++) {
    $image = get_theme_mod("smk_galeri_image_{$i}", '');
    if (!empty($image)) {
        $gallery_images[] = [
            'url' => $image,
            'alt' => get_theme_mod("smk_galeri_alt_{$i}", "Galeri " . $i),
        ];
    }
}
?>

<!-- Galeri Hero Section -->
<section class="galeri-hero-section">
    <div class="galeri-hero-container">
        <img src="<?php echo esc_url($galeri_hero_image); ?>" class="galeri-hero-image" alt="<?php echo esc_attr($galeri_hero_title); ?>">
        <div class="galeri-hero-overlay"></div>
        <div class="galeri-hero-content">
            <div class="container">
                <div class="galeri-hero-text-wrapper">
                    <h1 class="galeri-hero-title"><?php echo esc_html($galeri_hero_title); ?></h1>
                    <p class="galeri-hero-text"><?php echo esc_html($galeri_hero_text); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Gallery Grid Section -->
<section class="galeri-content-section section-pad">
    <div class="container">
        <?php if (!empty($gallery_images)): ?>
            <div class="galeri-grid">
                <?php foreach ($gallery_images as $index => $image): ?>
                    <div class="galeri-item" data-aos="fade-up">
                        <div class="galeri-item-inner" data-lightbox="<?php echo esc_url($image['url']); ?>">
                            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" loading="lazy">
                            <div class="galeri-item-overlay">
                                <span class="galeri-zoom-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <circle cx="11" cy="11" r="8"></circle>
                                        <path d="M21 21l-4.35-4.35"></path>
                                        <path d="M11 8v6"></path>
                                        <path d="M8 11h6"></path>
                                    </svg>
                                </span>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="galeri-empty">
                <p>Belum ada gambar di galeri. Silakan tambahkan gambar melalui Customizer.</p>
            </div>
        <?php endif; ?>
    </div>
</section>

<!-- Lightbox Modal -->
<div class="galeri-lightbox" id="galeriLightbox">
    <div class="galeri-lightbox-overlay"></div>
    <div class="galeri-lightbox-content">
        <button class="galeri-lightbox-close" aria-label="Close">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M18 6L6 18"></path>
                <path d="M6 6l12 12"></path>
            </svg>
        </button>
        <button class="galeri-lightbox-nav galeri-lightbox-prev" aria-label="Previous">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M15 18l-6-6 6-6"></path>
            </svg>
        </button>
        <button class="galeri-lightbox-nav galeri-lightbox-next" aria-label="Next">
            <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <path d="M9 18l6-6-6-6"></path>
            </svg>
        </button>
        <div class="galeri-lightbox-image-wrapper">
            <img src="" alt="" class="galeri-lightbox-image" id="lightboxImage">
        </div>
        <div class="galeri-lightbox-counter" id="lightboxCounter"></div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const lightbox = document.getElementById('galeriLightbox');
    const lightboxImage = document.getElementById('lightboxImage');
    const lightboxCounter = document.getElementById('lightboxCounter');
    const closeBtn = document.querySelector('.galeri-lightbox-close');
    const prevBtn = document.querySelector('.galeri-lightbox-prev');
    const nextBtn = document.querySelector('.galeri-lightbox-next');
    const overlay = document.querySelector('.galeri-lightbox-overlay');

    const galleryItems = document.querySelectorAll('[data-lightbox]');
    let currentIndex = 0;
    const images = [];

    // Collect all images
    galleryItems.forEach((item, index) => {
        images.push({
            url: item.getAttribute('data-lightbox'),
            alt: item.querySelector('img').getAttribute('alt')
        });

        item.addEventListener('click', function() {
            currentIndex = index;
            openLightbox();
        });
    });

    function openLightbox() {
        if (images.length === 0) return;

        lightboxImage.src = images[currentIndex].url;
        lightboxImage.alt = images[currentIndex].alt;
        lightboxCounter.textContent = (currentIndex + 1) + ' / ' + images.length;
        lightbox.classList.add('active');
        document.body.style.overflow = 'hidden';

        // Show/hide navigation buttons
        prevBtn.style.display = images.length > 1 ? 'flex' : 'none';
        nextBtn.style.display = images.length > 1 ? 'flex' : 'none';
    }

    function closeLightbox() {
        lightbox.classList.remove('active');
        document.body.style.overflow = '';
    }

    function showPrev() {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        updateImage();
    }

    function showNext() {
        currentIndex = (currentIndex + 1) % images.length;
        updateImage();
    }

    function updateImage() {
        lightboxImage.style.opacity = '0';
        setTimeout(() => {
            lightboxImage.src = images[currentIndex].url;
            lightboxImage.alt = images[currentIndex].alt;
            lightboxCounter.textContent = (currentIndex + 1) + ' / ' + images.length;
            lightboxImage.style.opacity = '1';
        }, 200);
    }

    // Event listeners
    closeBtn.addEventListener('click', closeLightbox);
    overlay.addEventListener('click', closeLightbox);
    prevBtn.addEventListener('click', showPrev);
    nextBtn.addEventListener('click', showNext);

    // Keyboard navigation
    document.addEventListener('keydown', function(e) {
        if (!lightbox.classList.contains('active')) return;

        if (e.key === 'Escape') closeLightbox();
        if (e.key === 'ArrowLeft') showPrev();
        if (e.key === 'ArrowRight') showNext();
    });

    // Touch swipe support
    let touchStartX = 0;
    let touchEndX = 0;

    lightbox.addEventListener('touchstart', function(e) {
        touchStartX = e.changedTouches[0].screenX;
    }, { passive: true });

    lightbox.addEventListener('touchend', function(e) {
        touchEndX = e.changedTouches[0].screenX;
        handleSwipe();
    }, { passive: true });

    function handleSwipe() {
        const swipeThreshold = 50;
        const diff = touchStartX - touchEndX;

        if (Math.abs(diff) > swipeThreshold) {
            if (diff > 0) {
                showNext();
            } else {
                showPrev();
            }
        }
    }

    // Intersection Observer for scroll animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    const galeriItems = document.querySelectorAll('.galeri-item');
    galeriItems.forEach(item => observer.observe(item));
});
</script>

<?php
get_footer();
