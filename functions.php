<?php

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

function badewatheme_theme_setup()
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
        'primary' => __('Primary Menu', 'badewatheme'),
    ]);
}

add_action('after_setup_theme', 'badewatheme_theme_setup');

function badewatheme_assets()
{
    wp_enqueue_style(
        'badewatheme-fonts',
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
        'badewatheme-style',
        get_stylesheet_uri(),
        ['bootstrap', 'badewatheme-fonts'],
        '1.0.0'
    );
    wp_enqueue_script(
        'bootstrap-bundle',
        'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js',
        [],
        '5.3.3',
        true
    );
    wp_enqueue_script(
        'badewatheme-menu',
        get_template_directory_uri() . '/js/menu.js',
        ['bootstrap-bundle'],
        '1.0.0',
        true
    );
}

add_action('wp_enqueue_scripts', 'badewatheme_assets');

function badewatheme_customize_register($wp_customize)
{
    // Theme Colors Section
    $wp_customize->add_section('badewatheme_colors', [
        'title' => __('Theme Colors', 'badewatheme'),
        'description' => __('Customize the color scheme of your website', 'badewatheme'),
        'priority' => 28,
    ]);

    // Primary Color
    $wp_customize->add_setting('smk_color_primary', [
        'default' => '#007e41',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'smk_color_primary', [
        'label' => __('Primary Color', 'badewatheme'),
        'description' => __('Main brand color used for buttons, links, and highlights', 'badewatheme'),
        'section' => 'badewatheme_colors',
    ]));

    // Primary Dark Color
    $wp_customize->add_setting('smk_color_primary_dark', [
        'default' => '#28a828',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'smk_color_primary_dark', [
        'label' => __('Primary Dark Color', 'badewatheme'),
        'description' => __('Darker shade of primary color for hover states', 'badewatheme'),
        'section' => 'badewatheme_colors',
    ]));

    // Accent Color
    $wp_customize->add_setting('smk_color_accent', [
        'default' => '#4cd44c',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'smk_color_accent', [
        'label' => __('Accent Color', 'badewatheme'),
        'description' => __('Secondary accent color for highlights and badges', 'badewatheme'),
        'section' => 'badewatheme_colors',
    ]));

    // Cream Color
    $wp_customize->add_setting('smk_color_cream', [
        'default' => '#f5f7fb',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'smk_color_cream', [
        'label' => __('Cream/Background Color', 'badewatheme'),
        'description' => __('Light background color for sections', 'badewatheme'),
        'section' => 'badewatheme_colors',
    ]));

    // Ink Color
    $wp_customize->add_setting('smk_color_ink', [
        'default' => '#0b1b36',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'smk_color_ink', [
        'label' => __('Ink/Text Color', 'badewatheme'),
        'description' => __('Main text color for headings and body text', 'badewatheme'),
        'section' => 'badewatheme_colors',
    ]));

    // Muted Color
    $wp_customize->add_setting('smk_color_muted', [
        'default' => '#5c6b86',
        'sanitize_callback' => 'sanitize_hex_color',
        'transport' => 'refresh',
    ]);
    $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, 'smk_color_muted', [
        'label' => __('Muted Text Color', 'badewatheme'),
        'description' => __('Secondary text color for descriptions and meta information', 'badewatheme'),
        'section' => 'badewatheme_colors',
    ]));

    // Blog Settings Section
    $wp_customize->add_section('badewatheme_blog', [
        'title' => __('Blog Settings', 'badewatheme'),
        'description' => __('Customize blog appearance', 'badewatheme'),
        'priority' => 28.5,
    ]);

    $wp_customize->add_setting('smk_blog_default_image', [
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'smk_blog_default_image', [
        'label' => __('Default Blog Image', 'badewatheme'),
        'description' => __('This image will be used for blog posts that don\'t have a featured image', 'badewatheme'),
        'section' => 'badewatheme_blog',
        'settings' => 'smk_blog_default_image',
    ]));

    // Header Section
    $wp_customize->add_section('badewatheme_header', [
        'title' => __('Header Settings', 'badewatheme'),
        'priority' => 29,
    ]);

    $wp_customize->add_setting('smk_header_phone', [
        'default' => '+6282227535136',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('smk_header_phone', [
        'label' => __('Phone Number', 'badewatheme'),
        'section' => 'badewatheme_header',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('smk_header_email', [
        'default' => 'info@merdeka-tc.id',
        'sanitize_callback' => 'sanitize_email',
    ]);
    $wp_customize->add_control('smk_header_email', [
        'label' => __('Email Address', 'badewatheme'),
        'section' => 'badewatheme_header',
        'type' => 'email',
    ]);

    $wp_customize->add_setting('smk_header_instagram', [
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control('smk_header_instagram', [
        'label' => __('Instagram URL', 'badewatheme'),
        'section' => 'badewatheme_header',
        'type' => 'url',
    ]);

    $wp_customize->add_setting('smk_header_facebook', [
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control('smk_header_facebook', [
        'label' => __('Facebook URL', 'badewatheme'),
        'section' => 'badewatheme_header',
        'type' => 'url',
    ]);

    $wp_customize->add_setting('smk_header_youtube', [
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control('smk_header_youtube', [
        'label' => __('YouTube URL', 'badewatheme'),
        'section' => 'badewatheme_header',
        'type' => 'url',
    ]);

    $wp_customize->add_setting('smk_header_tiktok', [
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control('smk_header_tiktok', [
        'label' => __('TikTok URL', 'badewatheme'),
        'section' => 'badewatheme_header',
        'type' => 'url',
    ]);

    $wp_customize->add_setting('smk_header_cta_text', [
        'default' => 'Ayo Daftar !',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('smk_header_cta_text', [
        'label' => __('CTA Button Text', 'badewatheme'),
        'section' => 'badewatheme_header',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('smk_header_cta_url', [
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control('smk_header_cta_url', [
        'label' => __('CTA Button URL', 'badewatheme'),
        'section' => 'badewatheme_header',
        'type' => 'url',
    ]);

    // Hero Section
    $wp_customize->add_section('badewatheme_hero', [
        'title' => __('Hero Section', 'badewatheme'),
        'priority' => 30,
    ]);

    $wp_customize->add_setting('smk_hero_image', [
        'default' => 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?auto=format&fit=crop&w=1600&q=80',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'smk_hero_image',
        [
            'label' => __('Hero Image', 'badewatheme'),
            'section' => 'badewatheme_hero',
        ]
    ));

    $wp_customize->add_setting('smk_hero_title', [
        'default' => 'Mencetak Tenaga Kesehatan Profesional',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('smk_hero_title', [
        'label' => __('Hero Title', 'badewatheme'),
        'section' => 'badewatheme_hero',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('smk_hero_text', [
        'default' => 'Kurikulum berbasis industri, guru berpengalaman, dan fasilitas praktik modern.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control('smk_hero_text', [
        'label' => __('Hero Text', 'badewatheme'),
        'section' => 'badewatheme_hero',
        'type' => 'textarea',
    ]);

    $wp_customize->add_setting('smk_hero_button_text', [
        'default' => 'Daftar Sekarang',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('smk_hero_button_text', [
        'label' => __('Button Text', 'badewatheme'),
        'section' => 'badewatheme_hero',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('smk_hero_button_url', [
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control('smk_hero_button_url', [
        'label' => __('Button URL', 'badewatheme'),
        'section' => 'badewatheme_hero',
        'type' => 'url',
    ]);

    // Sambutan Section
    $wp_customize->add_section('badewatheme_sambutan', [
        'title' => __('Sambutan Kepala Sekolah', 'badewatheme'),
        'priority' => 31,
    ]);

    $wp_customize->add_setting('smk_sambutan_kicker', [
        'default' => 'Sambutan',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('smk_sambutan_kicker', [
        'label' => __('Kicker', 'badewatheme'),
        'section' => 'badewatheme_sambutan',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('smk_sambutan_title', [
        'default' => 'Sambutan Kepala Sekolah',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('smk_sambutan_title', [
        'label' => __('Judul', 'badewatheme'),
        'section' => 'badewatheme_sambutan',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('smk_sambutan_text', [
        'default' => 'Selamat datang di website SMK Kesehatan Bali Dewata. Kami berkomitmen untuk mencetak tenaga kesehatan profesional yang kompeten dan berakhlak mulia.<br><br>Dengan kurikulum berbasis industri, fasilitas modern, dan tenaga pengajar berpengalaman, kami siap membantu siswa meraih masa depan cerah di bidang kesehatan.',
        'sanitize_callback' => 'wp_kses_post',
    ]);
    $wp_customize->add_control('smk_sambutan_text', [
        'label' => __('Teks Sambutan (HTML allowed)', 'badewatheme'),
        'section' => 'badewatheme_sambutan',
        'type' => 'textarea',
    ]);

    $wp_customize->add_setting('smk_sambutan_name', [
        'default' => 'Dr. Ahmad Hidayat, M.Pd',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('smk_sambutan_name', [
        'label' => __('Nama Kepala Sekolah', 'badewatheme'),
        'section' => 'badewatheme_sambutan',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('smk_sambutan_position', [
        'default' => 'Kepala Sekolah SMK Kesehatan Bali Dewata',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('smk_sambutan_position', [
        'label' => __('Jabatan', 'badewatheme'),
        'section' => 'badewatheme_sambutan',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('smk_sambutan_image', [
        'default' => 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=800&q=80',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'smk_sambutan_image',
        [
            'label' => __('Foto Kepala Sekolah', 'badewatheme'),
            'section' => 'badewatheme_sambutan',
        ]
    ));

    // Kompetensi Section
    $wp_customize->add_section('badewatheme_kompetensi', [
        'title' => __('Kompetensi Keahlian', 'badewatheme'),
        'priority' => 32,
    ]);

    $wp_customize->add_setting('smk_kompetensi_intro', [
        'default' => 'Jalur pembelajaran spesifik dengan sertifikasi dan praktik industri untuk karier masa depan.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control('smk_kompetensi_intro', [
        'label' => __('Deskripsi Section', 'badewatheme'),
        'section' => 'badewatheme_kompetensi',
        'type' => 'textarea',
    ]);

    $default_kompetensi_titles = [
        1 => 'Asisten Keperawatan',
        2 => 'Farmasi Klinis',
    ];
    $default_kompetensi_texts = [
        1 => 'Memberikan perawatan dasar pasien, membantu dokter dan perawat dalam prosedur medis, serta memastikan kenyamanan dan keselamatan pasien.',
        2 => 'Mengelola dan menyiapkan obat-obatan, memberikan konseling kepada pasien tentang penggunaan obat yang tepat dan aman.',
    ];

    for ($i = 1; $i <= 2; $i++) {
        $wp_customize->add_setting("smk_kompetensi_image_{$i}", [
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        ]);
        $wp_customize->add_control(new WP_Customize_Image_Control(
            $wp_customize,
            "smk_kompetensi_image_{$i}",
            [
                'label' => sprintf(__('Image Program %d', 'badewatheme'), $i),
                'section' => 'badewatheme_kompetensi',
            ]
        ));

        $wp_customize->add_setting("smk_kompetensi_title_{$i}", [
            'default' => $default_kompetensi_titles[$i],
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control("smk_kompetensi_title_{$i}", [
            'label' => sprintf(__('Judul Program %d', 'badewatheme'), $i),
            'section' => 'badewatheme_kompetensi',
            'type' => 'text',
        ]);

        $wp_customize->add_setting("smk_kompetensi_text_{$i}", [
            'default' => $default_kompetensi_texts[$i],
            'sanitize_callback' => 'sanitize_textarea_field',
        ]);
        $wp_customize->add_control("smk_kompetensi_text_{$i}", [
            'label' => sprintf(__('Deskripsi Program %d', 'badewatheme'), $i),
            'section' => 'badewatheme_kompetensi',
            'type' => 'textarea',
        ]);
    }

    $wp_customize->add_section('badewatheme_keunggulan', [
        'title' => __('Keunggulan', 'badewatheme'),
        'priority' => 33,
    ]);

    $wp_customize->add_setting('smk_keunggulan_intro', [
        'default' => 'Lingkungan belajar yang formal, profesional, dan adaptif dengan kebutuhan dunia kesehatan.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control('smk_keunggulan_intro', [
        'label' => __('Deskripsi Section', 'badewatheme'),
        'section' => 'badewatheme_keunggulan',
        'type' => 'textarea',
    ]);

    $default_keunggulan_titles = [
        1 => 'Kurikulum Industri',
        2 => 'Fasilitas Modern',
        3 => 'Pengajar Profesional',
        4 => 'Jalur Karier',
    ];
    $default_keunggulan_texts = [
        1 => 'Materi dirancang bersama mitra kesehatan untuk membekali kompetensi nyata.',
        2 => 'Laboratorium praktik dan ruang simulasi yang mendukung pembelajaran aktif.',
        3 => 'Tenaga pendidik berpengalaman di bidang kesehatan dan pendidikan vokasi.',
        4 => 'Program pendampingan alumni dan kerja sama industri untuk penempatan kerja.',
    ];

    for ($i = 1; $i <= 4; $i++) {
        $wp_customize->add_setting("smk_keunggulan_image_{$i}", [
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        ]);
        $wp_customize->add_control(new WP_Customize_Image_Control(
            $wp_customize,
            "smk_keunggulan_image_{$i}",
            [
                'label' => sprintf(__('Image Keunggulan %d', 'badewatheme'), $i),
                'section' => 'badewatheme_keunggulan',
            ]
        ));

        $wp_customize->add_setting("smk_keunggulan_title_{$i}", [
            'default' => $default_keunggulan_titles[$i],
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control("smk_keunggulan_title_{$i}", [
            'label' => sprintf(__('Judul %d', 'badewatheme'), $i),
            'section' => 'badewatheme_keunggulan',
            'type' => 'text',
        ]);

        $wp_customize->add_setting("smk_keunggulan_text_{$i}", [
            'default' => $default_keunggulan_texts[$i],
            'sanitize_callback' => 'sanitize_textarea_field',
        ]);
        $wp_customize->add_control("smk_keunggulan_text_{$i}", [
            'label' => sprintf(__('Deskripsi %d', 'badewatheme'), $i),
            'section' => 'badewatheme_keunggulan',
            'type' => 'textarea',
        ]);
    }

    $wp_customize->add_section('badewatheme_sidebar', [
        'title' => __('Sidebar', 'badewatheme'),
        'priority' => 31,
    ]);

    $wp_customize->add_setting('smk_sidebar_location_title', [
        'default' => 'Lokasi Kami',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('smk_sidebar_location_title', [
        'label' => __('Judul Lokasi', 'badewatheme'),
        'section' => 'badewatheme_sidebar',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('smk_sidebar_map_url', [
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control('smk_sidebar_map_url', [
        'label' => __('URL Embed Google Maps', 'badewatheme'),
        'section' => 'badewatheme_sidebar',
        'type' => 'url',
    ]);

    $wp_customize->add_setting('smk_sidebar_contact_title', [
        'default' => 'Hubungi Kami',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('smk_sidebar_contact_title', [
        'label' => __('Judul Kontak', 'badewatheme'),
        'section' => 'badewatheme_sidebar',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('smk_sidebar_phone', [
        'default' => '',
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control('smk_sidebar_phone', [
        'label' => __('Telepon / Fax', 'badewatheme'),
        'section' => 'badewatheme_sidebar',
        'type' => 'textarea',
    ]);

    $wp_customize->add_setting('smk_sidebar_email', [
        'default' => '',
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control('smk_sidebar_email', [
        'label' => __('Email', 'badewatheme'),
        'section' => 'badewatheme_sidebar',
        'type' => 'textarea',
    ]);

    $wp_customize->add_setting('smk_sidebar_facebook', [
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('smk_sidebar_facebook', [
        'label' => __('Facebook', 'badewatheme'),
        'section' => 'badewatheme_sidebar',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('smk_sidebar_instagram', [
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('smk_sidebar_instagram', [
        'label' => __('Instagram', 'badewatheme'),
        'section' => 'badewatheme_sidebar',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('smk_sidebar_youtube', [
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control('smk_sidebar_youtube', [
        'label' => __('YouTube URL', 'badewatheme'),
        'section' => 'badewatheme_sidebar',
        'type' => 'url',
    ]);

    $wp_customize->add_setting('smk_sidebar_tiktok', [
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control('smk_sidebar_tiktok', [
        'label' => __('TikTok URL', 'badewatheme'),
        'section' => 'badewatheme_sidebar',
        'type' => 'url',
    ]);

    $wp_customize->add_setting('smk_sidebar_button_text', [
        'default' => 'Kirim Pesan',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('smk_sidebar_button_text', [
        'label' => __('Teks Tombol', 'badewatheme'),
        'section' => 'badewatheme_sidebar',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('smk_sidebar_button_url', [
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control('smk_sidebar_button_url', [
        'label' => __('URL Tombol', 'badewatheme'),
        'section' => 'badewatheme_sidebar',
        'type' => 'url',
    ]);

    $wp_customize->add_section('badewatheme_footer', [
        'title' => __('Footer', 'badewatheme'),
        'priority' => 40,
    ]);

    $wp_customize->add_setting('smk_footer_about', [
        'default' => 'Sekolah vokasi kesehatan yang berfokus pada pendidikan profesional, berintegritas, dan siap kerja.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control('smk_footer_about', [
        'label' => __('Deskripsi Sekolah', 'badewatheme'),
        'section' => 'badewatheme_footer',
        'type' => 'textarea',
    ]);

    $wp_customize->add_setting('smk_footer_contact', [
        'default' => "Jl. Raya Pendidikan No. 10, Denpasar, Bali\nTelp: (0361) 123-456\nEmail: info@badewathemebd.sch.id",
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control('smk_footer_contact', [
        'label' => __('Kontak (1 per baris)', 'badewatheme'),
        'section' => 'badewatheme_footer',
        'type' => 'textarea',
    ]);

    $wp_customize->add_setting('smk_footer_links_title', [
        'default' => 'Tautan Cepat',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('smk_footer_links_title', [
        'label' => __('Judul Tautan', 'badewatheme'),
        'section' => 'badewatheme_footer',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('smk_footer_links', [
        'default' => "Kompetensi Keahlian|#kompetensi\nKeunggulan|#keunggulan\nLatest Blog|#blog",
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control('smk_footer_links', [
        'label' => __('Tautan (Label|URL per baris)', 'badewatheme'),
        'section' => 'badewatheme_footer',
        'type' => 'textarea',
    ]);

    // About Us Page Section
    $wp_customize->add_section('badewatheme_about', [
        'title' => __('About Us Page', 'badewatheme'),
        'description' => __('Customize About Us page content', 'badewatheme'),
        'priority' => 41,
    ]);

    // About Hero Settings
    $wp_customize->add_setting('smk_about_hero_image', [
        'default' => get_template_directory_uri() . '/assets/images/hero-default.jpg',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'smk_about_hero_image', [
        'label' => __('About Hero Image', 'badewatheme'),
        'section' => 'badewatheme_about',
        'settings' => 'smk_about_hero_image',
    ]));

    $wp_customize->add_setting('smk_about_hero_title', [
        'default' => 'Tentang Kami',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('smk_about_hero_title', [
        'label' => __('About Hero Title', 'badewatheme'),
        'section' => 'badewatheme_about',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('smk_about_hero_text', [
        'default' => 'Mengenal lebih dekat SMK Kesehatan Bali Dewata',
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control('smk_about_hero_text', [
        'label' => __('About Hero Text', 'badewatheme'),
        'section' => 'badewatheme_about',
        'type' => 'textarea',
    ]);

    // About Content Settings
    $wp_customize->add_setting('smk_about_title', [
        'default' => 'Sejarah dan Profil Sekolah',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('smk_about_title', [
        'label' => __('About Title', 'badewatheme'),
        'section' => 'badewatheme_about',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('smk_about_text', [
        'default' => 'SMK Kesehatan Bali Dewata didirikan dengan visi untuk mencetak tenaga kesehatan profesional yang kompeten dan berakhlak mulia. Dengan pengalaman lebih dari 10 tahun dalam pendidikan vokasi kesehatan, kami telah menghasilkan ribuan lulusan yang tersebar di berbagai fasilitas kesehatan di seluruh Indonesia.<br><br>Kami berkomitmen untuk memberikan pendidikan berkualitas tinggi melalui kurikulum yang disesuaikan dengan kebutuhan industri, didukung oleh tenaga pengajar berpengalaman dan fasilitas praktik yang modern. Setiap siswa dibimbing untuk tidak hanya menguasai kompetensi teknis, tetapi juga mengembangkan karakter profesional dan etika kerja yang kuat.',
        'sanitize_callback' => 'wp_kses_post',
    ]);
    $wp_customize->add_control('smk_about_text', [
        'label' => __('About Text (HTML allowed)', 'badewatheme'),
        'section' => 'badewatheme_about',
        'type' => 'textarea',
    ]);

    $wp_customize->add_setting('smk_about_image', [
        'default' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=800&q=80',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'smk_about_image', [
        'label' => __('About Image', 'badewatheme'),
        'section' => 'badewatheme_about',
        'settings' => 'smk_about_image',
    ]));

    // Vision Settings
    $wp_customize->add_setting('smk_vision_title', [
        'default' => 'Visi',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('smk_vision_title', [
        'label' => __('Vision Title', 'badewatheme'),
        'section' => 'badewatheme_about',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('smk_vision_text', [
        'default' => 'Menjadi lembaga pendidikan vokasi kesehatan terkemuka yang menghasilkan tenaga kesehatan profesional, kompeten, dan berakhlak mulia untuk memajukan dunia kesehatan Indonesia.',
        'sanitize_callback' => 'wp_kses_post',
    ]);
    $wp_customize->add_control('smk_vision_text', [
        'label' => __('Vision Text (HTML allowed)', 'badewatheme'),
        'section' => 'badewatheme_about',
        'type' => 'textarea',
    ]);

    // Mission Settings
    $wp_customize->add_setting('smk_mission_title', [
        'default' => 'Misi',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('smk_mission_title', [
        'label' => __('Mission Title', 'badewatheme'),
        'section' => 'badewatheme_about',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('smk_mission_items', [
        'default' => "Menyelenggarakan pendidikan vokasi kesehatan berkualitas tinggi dengan kurikulum berbasis industri\nMengembangkan kompetensi siswa melalui pembelajaran teori dan praktik yang seimbang\nMembentuk karakter profesional dan etika kerja yang kuat pada setiap siswa\nMenjalin kerja sama dengan institusi kesehatan untuk program magang dan penempatan kerja\nMeningkatkan kualitas tenaga pengajar dan fasilitas pembelajaran secara berkelanjutan",
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control('smk_mission_items', [
        'label' => __('Mission Items (one per line)', 'badewatheme'),
        'section' => 'badewatheme_about',
        'type' => 'textarea',
    ]);

    // Fasilitas Page Section
    $wp_customize->add_section('badewatheme_fasilitas', [
        'title' => __('Fasilitas Page', 'badewatheme'),
        'description' => __('Customize Fasilitas page content', 'badewatheme'),
        'priority' => 42,
    ]);

    // Fasilitas Hero Settings
    $wp_customize->add_setting('smk_fasilitas_hero_image', [
        'default' => get_template_directory_uri() . '/assets/images/hero-default.jpg',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'smk_fasilitas_hero_image', [
        'label' => __('Fasilitas Hero Image', 'badewatheme'),
        'section' => 'badewatheme_fasilitas',
        'settings' => 'smk_fasilitas_hero_image',
    ]));

    $wp_customize->add_setting('smk_fasilitas_hero_title', [
        'default' => 'Fasilitas',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('smk_fasilitas_hero_title', [
        'label' => __('Fasilitas Hero Title', 'badewatheme'),
        'section' => 'badewatheme_fasilitas',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('smk_fasilitas_hero_text', [
        'default' => 'Fasilitas modern dan lengkap untuk mendukung pembelajaran vokasi kesehatan',
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control('smk_fasilitas_hero_text', [
        'label' => __('Fasilitas Hero Text', 'badewatheme'),
        'section' => 'badewatheme_fasilitas',
        'type' => 'textarea',
    ]);

    // Fasilitas Items (4 facilities)
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

    for ($i = 1; $i <= 4; $i++) {
        $wp_customize->add_setting("smk_fasilitas_image_{$i}", [
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        ]);
        $wp_customize->add_control(new WP_Customize_Image_Control(
            $wp_customize,
            "smk_fasilitas_image_{$i}",
            [
                'label' => sprintf(__('Fasilitas %d - Image', 'badewatheme'), $i),
                'section' => 'badewatheme_fasilitas',
            ]
        ));

        $wp_customize->add_setting("smk_fasilitas_title_{$i}", [
            'default' => $default_fasilitas_titles[$i],
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control("smk_fasilitas_title_{$i}", [
            'label' => sprintf(__('Fasilitas %d - Title', 'badewatheme'), $i),
            'section' => 'badewatheme_fasilitas',
            'type' => 'text',
        ]);

        $wp_customize->add_setting("smk_fasilitas_text_{$i}", [
            'default' => $default_fasilitas_texts[$i],
            'sanitize_callback' => 'wp_kses_post',
        ]);
        $wp_customize->add_control("smk_fasilitas_text_{$i}", [
            'label' => sprintf(__('Fasilitas %d - Description (HTML allowed)', 'badewatheme'), $i),
            'section' => 'badewatheme_fasilitas',
            'type' => 'textarea',
        ]);
    }

    // Contact Us Page Section
    $wp_customize->add_section('badewatheme_contact', [
        'title' => __('Contact Us Page', 'badewatheme'),
        'description' => __('Customize Contact Us page content', 'badewatheme'),
        'priority' => 43,
    ]);

    // Contact Hero Settings
    $wp_customize->add_setting('smk_contact_hero_image', [
        'default' => get_template_directory_uri() . '/assets/images/hero-default.jpg',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'smk_contact_hero_image', [
        'label' => __('Contact Hero Image', 'badewatheme'),
        'section' => 'badewatheme_contact',
        'settings' => 'smk_contact_hero_image',
    ]));

    $wp_customize->add_setting('smk_contact_hero_title', [
        'default' => 'Hubungi Kami',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('smk_contact_hero_title', [
        'label' => __('Contact Hero Title', 'badewatheme'),
        'section' => 'badewatheme_contact',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('smk_contact_hero_text', [
        'default' => 'Kami siap membantu menjawab pertanyaan Anda',
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control('smk_contact_hero_text', [
        'label' => __('Contact Hero Text', 'badewatheme'),
        'section' => 'badewatheme_contact',
        'type' => 'textarea',
    ]);

    // Contact Information Settings
    $wp_customize->add_setting('smk_contact_address', [
        'default' => 'Jl. Ahmad Yani Utara No. 331 Peguyangan, Denpasar Utara, Denpasar - Bali 80115',
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control('smk_contact_address', [
        'label' => __('Address', 'badewatheme'),
        'section' => 'badewatheme_contact',
        'type' => 'textarea',
    ]);

    $wp_customize->add_setting('smk_contact_whatsapp', [
        'default' => '+6282227535136',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('smk_contact_whatsapp', [
        'label' => __('WhatsApp Number', 'badewatheme'),
        'description' => __('Format: +62XXXXXXXXXX', 'badewatheme'),
        'section' => 'badewatheme_contact',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('smk_contact_email', [
        'default' => 'info@badewatheme.sch.id',
        'sanitize_callback' => 'sanitize_email',
    ]);
    $wp_customize->add_control('smk_contact_email', [
        'label' => __('Email Address', 'badewatheme'),
        'section' => 'badewatheme_contact',
        'type' => 'email',
    ]);

    $wp_customize->add_setting('smk_contact_map_url', [
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control('smk_contact_map_url', [
        'label' => __('Google Maps Embed URL', 'badewatheme'),
        'description' => __('Paste the embed URL from Google Maps', 'badewatheme'),
        'section' => 'badewatheme_contact',
        'type' => 'url',
    ]);

    // Contact Social Media Settings
    $wp_customize->add_setting('smk_contact_instagram', [
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control('smk_contact_instagram', [
        'label' => __('Instagram URL', 'badewatheme'),
        'section' => 'badewatheme_contact',
        'type' => 'url',
    ]);

    $wp_customize->add_setting('smk_contact_facebook', [
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control('smk_contact_facebook', [
        'label' => __('Facebook URL', 'badewatheme'),
        'section' => 'badewatheme_contact',
        'type' => 'url',
    ]);

    $wp_customize->add_setting('smk_contact_youtube', [
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control('smk_contact_youtube', [
        'label' => __('YouTube URL', 'badewatheme'),
        'section' => 'badewatheme_contact',
        'type' => 'url',
    ]);

    $wp_customize->add_setting('smk_contact_tiktok', [
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control('smk_contact_tiktok', [
        'label' => __('TikTok URL', 'badewatheme'),
        'section' => 'badewatheme_contact',
        'type' => 'url',
    ]);

    // FAQ Page Section
    $wp_customize->add_section('badewatheme_faq', [
        'title' => __('FAQ Page', 'badewatheme'),
        'description' => __('Customize FAQ page hero and questions', 'badewatheme'),
        'priority' => 44,
    ]);

    // FAQ Hero Settings
    $wp_customize->add_setting('smk_faq_hero_image', [
        'default' => get_template_directory_uri() . '/assets/images/hero-default.jpg',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'smk_faq_hero_image', [
        'label' => __('FAQ Hero Image', 'badewatheme'),
        'section' => 'badewatheme_faq',
        'settings' => 'smk_faq_hero_image',
    ]));

    $wp_customize->add_setting('smk_faq_hero_title', [
        'default' => 'Frequently Asked Questions',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('smk_faq_hero_title', [
        'label' => __('FAQ Hero Title', 'badewatheme'),
        'section' => 'badewatheme_faq',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('smk_faq_hero_text', [
        'default' => 'Temukan jawaban atas pertanyaan yang sering diajukan seputar SMK Kesehatan',
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control('smk_faq_hero_text', [
        'label' => __('FAQ Hero Text', 'badewatheme'),
        'section' => 'badewatheme_faq',
        'type' => 'textarea',
    ]);

    // FAQ Items (10 items)
    for ($i = 1; $i <= 10; $i++) {
        $wp_customize->add_setting("smk_faq_question_{$i}", [
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control("smk_faq_question_{$i}", [
            'label' => sprintf(__('FAQ %d - Question', 'badewatheme'), $i),
            'section' => 'badewatheme_faq',
            'type' => 'text',
        ]);

        $wp_customize->add_setting("smk_faq_answer_{$i}", [
            'default' => '',
            'sanitize_callback' => 'wp_kses_post',
        ]);
        $wp_customize->add_control("smk_faq_answer_{$i}", [
            'label' => sprintf(__('FAQ %d - Answer', 'badewatheme'), $i),
            'section' => 'badewatheme_faq',
            'type' => 'textarea',
        ]);
    }
}

add_action('customize_register', 'badewatheme_customize_register');

// Output custom colors as CSS variables
function badewatheme_custom_colors()
{
    $primary = get_theme_mod('smk_color_primary', '#007e41');
    $primary_dark = get_theme_mod('smk_color_primary_dark', '#28a828');
    $accent = get_theme_mod('smk_color_accent', '#4cd44c');
    $cream = get_theme_mod('smk_color_cream', '#f5f7fb');
    $ink = get_theme_mod('smk_color_ink', '#0b1b36');
    $muted = get_theme_mod('smk_color_muted', '#5c6b86');

    ?>
    <style type="text/css">
        :root {
            --primary: <?php echo esc_attr($primary); ?>;
            --primary-dark: <?php echo esc_attr($primary_dark); ?>;
            --accent: <?php echo esc_attr($accent); ?>;
            --cream: <?php echo esc_attr($cream); ?>;
            --ink: <?php echo esc_attr($ink); ?>;
            --muted: <?php echo esc_attr($muted); ?>;
        }
    </style>
    <?php
}
add_action('wp_head', 'badewatheme_custom_colors');

function badewatheme_nav_menu_css_class($classes, $item, $args, $depth)
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

add_filter('nav_menu_css_class', 'badewatheme_nav_menu_css_class', 10, 4);

function badewatheme_nav_menu_link_attributes($atts, $item, $args, $depth)
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

add_filter('nav_menu_link_attributes', 'badewatheme_nav_menu_link_attributes', 10, 4);

function badewatheme_nav_menu_submenu_css_class($classes, $args, $depth)
{
    if (!isset($args->theme_location) || $args->theme_location !== 'primary') {
        return $classes;
    }

    $classes[] = 'dropdown-menu';
    return $classes;
}

add_filter('nav_menu_submenu_css_class', 'badewatheme_nav_menu_submenu_css_class', 10, 3);
