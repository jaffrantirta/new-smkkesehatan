<?php

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

function smkkesehatan_theme_setup()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'gallery', 'caption']);
    add_theme_support('custom-logo', [
        'height' => 80,
        'width' => 80,
        'flex-height' => true,
        'flex-width' => true,
    ]);
    register_nav_menus([
        'primary' => __('Primary Menu', 'smkkesehatan'),
    ]);
}

add_action('after_setup_theme', 'smkkesehatan_theme_setup');

function smkkesehatan_assets()
{
    wp_enqueue_style(
        'smkkesehatan-fonts',
        'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;600;700&family=Source+Sans+3:wght@300;400;500;600;700&display=swap',
        [],
        null
    );
    wp_enqueue_style(
        'bootstrap',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css',
        [],
        '5.3.3'
    );
    wp_enqueue_style(
        'smkkesehatan-style',
        get_stylesheet_uri(),
        ['bootstrap', 'smkkesehatan-fonts'],
        '1.0.0'
    );
    wp_enqueue_script(
        'bootstrap-bundle',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js',
        [],
        '5.3.3',
        true
    );
}

add_action('wp_enqueue_scripts', 'smkkesehatan_assets');

function smkkesehatan_customize_register($wp_customize)
{
    $wp_customize->add_section('smkkesehatan_hero', [
        'title' => __('Hero Carousel', 'smkkesehatan'),
        'priority' => 30,
    ]);

    for ($i = 1; $i <= 3; $i++) {
        $wp_customize->add_setting("smk_hero_image_{$i}", [
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        ]);
        $wp_customize->add_control(new WP_Customize_Image_Control(
            $wp_customize,
            "smk_hero_image_{$i}",
            [
                'label' => sprintf(__('Hero Image %d', 'smkkesehatan'), $i),
                'section' => 'smkkesehatan_hero',
            ]
        ));

        $wp_customize->add_setting("smk_hero_kicker_{$i}", [
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control("smk_hero_kicker_{$i}", [
            'label' => sprintf(__('Hero Kicker %d', 'smkkesehatan'), $i),
            'section' => 'smkkesehatan_hero',
            'type' => 'text',
        ]);

        $wp_customize->add_setting("smk_hero_title_{$i}", [
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control("smk_hero_title_{$i}", [
            'label' => sprintf(__('Hero Title %d', 'smkkesehatan'), $i),
            'section' => 'smkkesehatan_hero',
            'type' => 'text',
        ]);

        $wp_customize->add_setting("smk_hero_text_{$i}", [
            'default' => '',
            'sanitize_callback' => 'sanitize_textarea_field',
        ]);
        $wp_customize->add_control("smk_hero_text_{$i}", [
            'label' => sprintf(__('Hero Text %d', 'smkkesehatan'), $i),
            'section' => 'smkkesehatan_hero',
            'type' => 'textarea',
        ]);
    }

    $wp_customize->add_section('smkkesehatan_kompetensi', [
        'title' => __('Kompetensi Keahlian', 'smkkesehatan'),
        'priority' => 32,
    ]);

    $wp_customize->add_setting('smk_kompetensi_intro', [
        'default' => 'Jalur pembelajaran spesifik dengan sertifikasi dan praktik industri untuk karier masa depan.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control('smk_kompetensi_intro', [
        'label' => __('Deskripsi Section', 'smkkesehatan'),
        'section' => 'smkkesehatan_kompetensi',
        'type' => 'textarea',
    ]);

    for ($i = 1; $i <= 2; $i++) {
        $wp_customize->add_setting("smk_kompetensi_kicker_{$i}", [
            'default' => $i === 1 ? 'Farmasi' : 'Perawat',
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control("smk_kompetensi_kicker_{$i}", [
            'label' => sprintf(__('Kicker %d', 'smkkesehatan'), $i),
            'section' => 'smkkesehatan_kompetensi',
            'type' => 'text',
        ]);

        $wp_customize->add_setting("smk_kompetensi_title_{$i}", [
            'default' => $i === 1 ? 'Asisten Tenaga Kefarmasian' : 'Asisten Keperawatan',
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control("smk_kompetensi_title_{$i}", [
            'label' => sprintf(__('Judul %d', 'smkkesehatan'), $i),
            'section' => 'smkkesehatan_kompetensi',
            'type' => 'text',
        ]);

        $wp_customize->add_setting("smk_kompetensi_text_{$i}", [
            'default' => $i === 1
                ? 'Fokus pada peracikan obat, pelayanan farmasi, dan manajemen logistik obat.'
                : 'Pembelajaran keterampilan klinis dasar, komunikasi pasien, dan etika profesi.',
            'sanitize_callback' => 'sanitize_textarea_field',
        ]);
        $wp_customize->add_control("smk_kompetensi_text_{$i}", [
            'label' => sprintf(__('Deskripsi %d', 'smkkesehatan'), $i),
            'section' => 'smkkesehatan_kompetensi',
            'type' => 'textarea',
        ]);

        $wp_customize->add_setting("smk_kompetensi_list_{$i}", [
            'default' => $i === 1
                ? "Praktik laboratorium formulasi obat.\nSimulasi layanan apotek modern.\nMagang di klinik dan rumah sakit."
                : "Simulasi tindakan keperawatan harian.\nPendampingan guru klinis berpengalaman.\nKegiatan praktik di fasilitas kesehatan.",
            'sanitize_callback' => 'sanitize_textarea_field',
        ]);
        $wp_customize->add_control("smk_kompetensi_list_{$i}", [
            'label' => sprintf(__('Poin (1 per baris) %d', 'smkkesehatan'), $i),
            'section' => 'smkkesehatan_kompetensi',
            'type' => 'textarea',
        ]);
    }

    $wp_customize->add_section('smkkesehatan_keunggulan', [
        'title' => __('Keunggulan', 'smkkesehatan'),
        'priority' => 33,
    ]);

    $wp_customize->add_setting('smk_keunggulan_intro', [
        'default' => 'Lingkungan belajar yang formal, profesional, dan adaptif dengan kebutuhan dunia kesehatan.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control('smk_keunggulan_intro', [
        'label' => __('Deskripsi Section', 'smkkesehatan'),
        'section' => 'smkkesehatan_keunggulan',
        'type' => 'textarea',
    ]);

    for ($i = 1; $i <= 4; $i++) {
        $default_titles = [
            1 => 'Kurikulum Industri',
            2 => 'Fasilitas Modern',
            3 => 'Pengajar Profesional',
            4 => 'Jalur Karier',
        ];
        $default_texts = [
            1 => 'Materi dirancang bersama mitra kesehatan untuk membekali kompetensi nyata.',
            2 => 'Laboratorium praktik dan ruang simulasi yang mendukung pembelajaran aktif.',
            3 => 'Tenaga pendidik berpengalaman di bidang kesehatan dan pendidikan vokasi.',
            4 => 'Program pendampingan alumni dan kerja sama industri untuk penempatan kerja.',
        ];

        $wp_customize->add_setting("smk_keunggulan_title_{$i}", [
            'default' => $default_titles[$i],
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control("smk_keunggulan_title_{$i}", [
            'label' => sprintf(__('Judul %d', 'smkkesehatan'), $i),
            'section' => 'smkkesehatan_keunggulan',
            'type' => 'text',
        ]);

        $wp_customize->add_setting("smk_keunggulan_text_{$i}", [
            'default' => $default_texts[$i],
            'sanitize_callback' => 'sanitize_textarea_field',
        ]);
        $wp_customize->add_control("smk_keunggulan_text_{$i}", [
            'label' => sprintf(__('Deskripsi %d', 'smkkesehatan'), $i),
            'section' => 'smkkesehatan_keunggulan',
            'type' => 'textarea',
        ]);
    }

    $wp_customize->add_section('smkkesehatan_sidebar', [
        'title' => __('Sidebar', 'smkkesehatan'),
        'priority' => 31,
    ]);

    $wp_customize->add_setting('smk_sidebar_location_title', [
        'default' => 'Lokasi Kami',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('smk_sidebar_location_title', [
        'label' => __('Judul Lokasi', 'smkkesehatan'),
        'section' => 'smkkesehatan_sidebar',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('smk_sidebar_map_url', [
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control('smk_sidebar_map_url', [
        'label' => __('URL Embed Google Maps', 'smkkesehatan'),
        'section' => 'smkkesehatan_sidebar',
        'type' => 'url',
    ]);

    $wp_customize->add_setting('smk_sidebar_contact_title', [
        'default' => 'Hubungi Kami',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('smk_sidebar_contact_title', [
        'label' => __('Judul Kontak', 'smkkesehatan'),
        'section' => 'smkkesehatan_sidebar',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('smk_sidebar_phone', [
        'default' => '',
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control('smk_sidebar_phone', [
        'label' => __('Telepon / Fax', 'smkkesehatan'),
        'section' => 'smkkesehatan_sidebar',
        'type' => 'textarea',
    ]);

    $wp_customize->add_setting('smk_sidebar_email', [
        'default' => '',
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control('smk_sidebar_email', [
        'label' => __('Email', 'smkkesehatan'),
        'section' => 'smkkesehatan_sidebar',
        'type' => 'textarea',
    ]);

    $wp_customize->add_setting('smk_sidebar_facebook', [
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('smk_sidebar_facebook', [
        'label' => __('Facebook', 'smkkesehatan'),
        'section' => 'smkkesehatan_sidebar',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('smk_sidebar_instagram', [
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('smk_sidebar_instagram', [
        'label' => __('Instagram', 'smkkesehatan'),
        'section' => 'smkkesehatan_sidebar',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('smk_sidebar_button_text', [
        'default' => 'Kirim Pesan',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('smk_sidebar_button_text', [
        'label' => __('Teks Tombol', 'smkkesehatan'),
        'section' => 'smkkesehatan_sidebar',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('smk_sidebar_button_url', [
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control('smk_sidebar_button_url', [
        'label' => __('URL Tombol', 'smkkesehatan'),
        'section' => 'smkkesehatan_sidebar',
        'type' => 'url',
    ]);

    $wp_customize->add_section('smkkesehatan_footer', [
        'title' => __('Footer', 'smkkesehatan'),
        'priority' => 40,
    ]);

    $wp_customize->add_setting('smk_footer_about', [
        'default' => 'Sekolah vokasi kesehatan yang berfokus pada pendidikan profesional, berintegritas, dan siap kerja.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control('smk_footer_about', [
        'label' => __('Deskripsi Sekolah', 'smkkesehatan'),
        'section' => 'smkkesehatan_footer',
        'type' => 'textarea',
    ]);

    $wp_customize->add_setting('smk_footer_contact', [
        'default' => "Jl. Raya Pendidikan No. 10, Denpasar, Bali\nTelp: (0361) 123-456\nEmail: info@smkkesehatanbd.sch.id",
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control('smk_footer_contact', [
        'label' => __('Kontak (1 per baris)', 'smkkesehatan'),
        'section' => 'smkkesehatan_footer',
        'type' => 'textarea',
    ]);

    $wp_customize->add_setting('smk_footer_links_title', [
        'default' => 'Tautan Cepat',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('smk_footer_links_title', [
        'label' => __('Judul Tautan', 'smkkesehatan'),
        'section' => 'smkkesehatan_footer',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('smk_footer_links', [
        'default' => "Kompetensi Keahlian|#kompetensi\nKeunggulan|#keunggulan\nLatest Blog|#blog",
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control('smk_footer_links', [
        'label' => __('Tautan (Label|URL per baris)', 'smkkesehatan'),
        'section' => 'smkkesehatan_footer',
        'type' => 'textarea',
    ]);
}

add_action('customize_register', 'smkkesehatan_customize_register');

function smkkesehatan_nav_menu_css_class($classes, $item, $args, $depth)
{
    if (!isset($args->theme_location) || $args->theme_location !== 'primary') {
        return $classes;
    }

    if ($depth === 0) {
        $classes[] = 'nav-item';
    }

    if (in_array('menu-item-has-children', $classes, true)) {
        $classes[] = 'dropdown';
    }

    return $classes;
}

add_filter('nav_menu_css_class', 'smkkesehatan_nav_menu_css_class', 10, 4);

function smkkesehatan_nav_menu_link_attributes($atts, $item, $args, $depth)
{
    if (!isset($args->theme_location) || $args->theme_location !== 'primary') {
        return $atts;
    }

    if ($depth > 0) {
        $atts['class'] = trim(($atts['class'] ?? '') . ' dropdown-item');
        return $atts;
    }

    $atts['class'] = trim(($atts['class'] ?? '') . ' nav-link');

    if (in_array('menu-item-has-children', $item->classes ?? [], true)) {
        $atts['class'] .= ' dropdown-toggle';
        $atts['data-bs-toggle'] = 'dropdown';
        $atts['role'] = 'button';
        $atts['aria-expanded'] = 'false';
    }

    return $atts;
}

add_filter('nav_menu_link_attributes', 'smkkesehatan_nav_menu_link_attributes', 10, 4);

function smkkesehatan_nav_menu_submenu_css_class($classes, $args, $depth)
{
    if (!isset($args->theme_location) || $args->theme_location !== 'primary') {
        return $classes;
    }

    $classes[] = 'dropdown-menu';
    return $classes;
}

add_filter('nav_menu_submenu_css_class', 'smkkesehatan_nav_menu_submenu_css_class', 10, 3);
