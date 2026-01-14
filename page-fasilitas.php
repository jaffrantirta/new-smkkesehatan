<?php

/**
 * Template Name: Fasilitas Page
 * Description: Facilities page with hero and alternating content layout
 */
get_header();

// Get Fasilitas Hero Section Settings
$fasilitas_hero_image = get_theme_mod('smk_fasilitas_hero_image', get_template_directory_uri() . '/assets/images/hero-default.jpg');
$fasilitas_hero_title = get_theme_mod('smk_fasilitas_hero_title', 'Fasilitas');
$fasilitas_hero_text = get_theme_mod('smk_fasilitas_hero_text', 'Fasilitas modern dan lengkap untuk mendukung pembelajaran vokasi kesehatan');

// Get fasilitas count (dynamic, 1-20)
$fasilitas_count = absint(get_theme_mod('smk_fasilitas_count', 4));
if ($fasilitas_count < 1) $fasilitas_count = 1;
if ($fasilitas_count > 20) $fasilitas_count = 20;

// Default values for facilities
$default_fasilitas_titles = [
    1 => 'Ruang Kelas',
    2 => 'Laboratorium Praktik',
    3 => 'Perpustakaan',
    4 => 'Ruang Simulasi Medis',
    5 => 'Fasilitas 5',
    6 => 'Fasilitas 6',
    7 => 'Fasilitas 7',
    8 => 'Fasilitas 8',
    9 => 'Fasilitas 9',
    10 => 'Fasilitas 10',
    11 => 'Fasilitas 11',
    12 => 'Fasilitas 12',
    13 => 'Fasilitas 13',
    14 => 'Fasilitas 14',
    15 => 'Fasilitas 15',
    16 => 'Fasilitas 16',
    17 => 'Fasilitas 17',
    18 => 'Fasilitas 18',
    19 => 'Fasilitas 19',
    20 => 'Fasilitas 20',
];
$default_fasilitas_texts = [
    1 => 'Ruang kelas yang luas dan nyaman sehingga proses pembelajaran dapat berlangsung dengan baik. Dilengkapi dengan fasilitas proyektor dan komputer.',
    2 => 'Laboratorium dengan peralatan modern untuk praktik langsung, memastikan siswa mendapatkan pengalaman hands-on yang berkualitas.',
    3 => 'Perpustakaan dengan koleksi buku dan jurnal kesehatan terlengkap, mendukung pembelajaran dan penelitian siswa.',
    4 => 'Ruang simulasi medis dengan manekin dan peralatan medis standar industri untuk melatih keterampilan klinis siswa.',
    5 => 'Deskripsi fasilitas 5.',
    6 => 'Deskripsi fasilitas 6.',
    7 => 'Deskripsi fasilitas 7.',
    8 => 'Deskripsi fasilitas 8.',
    9 => 'Deskripsi fasilitas 9.',
    10 => 'Deskripsi fasilitas 10.',
    11 => 'Deskripsi fasilitas 11.',
    12 => 'Deskripsi fasilitas 12.',
    13 => 'Deskripsi fasilitas 13.',
    14 => 'Deskripsi fasilitas 14.',
    15 => 'Deskripsi fasilitas 15.',
    16 => 'Deskripsi fasilitas 16.',
    17 => 'Deskripsi fasilitas 17.',
    18 => 'Deskripsi fasilitas 18.',
    19 => 'Deskripsi fasilitas 19.',
    20 => 'Deskripsi fasilitas 20.',
];

// Get Facilities Content based on dynamic count
$facilities = [];
for ($i = 1; $i <= $fasilitas_count; $i++) {
    $facilities[$i] = [
        'title' => get_theme_mod("smk_fasilitas_title_{$i}", isset($default_fasilitas_titles[$i]) ? $default_fasilitas_titles[$i] : ''),
        'text' => get_theme_mod("smk_fasilitas_text_{$i}", isset($default_fasilitas_texts[$i]) ? $default_fasilitas_texts[$i] : ''),
        'image' => get_theme_mod("smk_fasilitas_image_{$i}", 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=800&q=80'),
    ];
}
?>

<!-- Fasilitas Hero Section -->
<section class="fasilitas-hero-section">
    <div class="fasilitas-hero-container">
        <img src="<?php echo esc_url($fasilitas_hero_image); ?>" class="fasilitas-hero-image" alt="<?php echo esc_attr($fasilitas_hero_title); ?>">
        <div class="fasilitas-hero-overlay"></div>
        <div class="fasilitas-hero-content">
            <div class="container">
                <div class="fasilitas-hero-text-wrapper">
                    <h1 class="fasilitas-hero-title"><?php echo esc_html($fasilitas_hero_title); ?></h1>
                    <p class="fasilitas-hero-text"><?php echo esc_html($fasilitas_hero_text); ?></p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Fasilitas Content Section -->
<section class="fasilitas-content-section section-pad">
    <div class="container">
        <?php
        foreach ($facilities as $index => $facility):
            $is_even = ($index % 2 == 0);
            ?>
            <div class="fasilitas-item <?php echo $is_even ? 'fasilitas-item-reverse' : ''; ?>" data-aos="fade-up">
                <div class="row align-items-center g-5 <?php echo $is_even ? 'flex-row-reverse' : ''; ?>">
                    <div class="col-lg-6">
                        <div class="fasilitas-content">
                            <h2 class="fasilitas-title"><?php echo esc_html($facility['title']); ?></h2>
                            <div class="fasilitas-text">
                                <?php echo wp_kses_post(wpautop($facility['text'])); ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="fasilitas-image">
                            <img src="<?php echo esc_url($facility['image']); ?>" alt="<?php echo esc_attr($facility['title']); ?>">
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</section>

<script>
document.addEventListener('DOMContentLoaded', function() {
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

    // Observe elements
    const fasilitasItems = document.querySelectorAll('.fasilitas-item');
    fasilitasItems.forEach(item => observer.observe(item));
});
</script>

<?php
get_footer();
