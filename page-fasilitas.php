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

// Default values for facilities
$default_fasilitas_titles = [
    1 => 'Ruang Kelas',
    2 => 'Laboratorium Praktik',
    3 => 'Perpustakaan',
    4 => 'Ruang Simulasi Medis',
];
$default_fasilitas_texts = [
    1 => 'Ruang kelas yang luas dan nyaman sehingga proses pembelajaran dapat berlangsung dengan baik. Dilengkapi dengan fasilitas proyektor dan komputer.',
    2 => 'Laboratorium dengan peralatan modern untuk praktik langsung, memastikan siswa mendapatkan pengalaman hands-on yang berkualitas.',
    3 => 'Perpustakaan dengan koleksi buku dan jurnal kesehatan terlengkap, mendukung pembelajaran dan penelitian siswa.',
    4 => 'Ruang simulasi medis dengan manekin dan peralatan medis standar industri untuk melatih keterampilan klinis siswa.',
];

// Get Facilities Content
$facilities = [];
for ($i = 1; $i <= 4; $i++) {
    $facilities[$i] = [
        'title' => get_theme_mod("smk_fasilitas_title_{$i}", $default_fasilitas_titles[$i]),
        'text' => get_theme_mod("smk_fasilitas_text_{$i}", $default_fasilitas_texts[$i]),
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

<?php
get_footer();
