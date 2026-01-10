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
    wp_enqueue_script(
        'smkkesehatan-menu',
        get_template_directory_uri() . '/js/menu.js',
        ['bootstrap-bundle'],
        '1.0.0',
        true
    );
}

add_action('wp_enqueue_scripts', 'smkkesehatan_assets');

function smkkesehatan_customize_register($wp_customize)
{
    // Header Section
    $wp_customize->add_section('smkkesehatan_header', [
        'title' => __('Header Settings', 'smkkesehatan'),
        'priority' => 29,
    ]);

    $wp_customize->add_setting('smk_header_phone', [
        'default' => '+6282227535136',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('smk_header_phone', [
        'label' => __('Phone Number', 'smkkesehatan'),
        'section' => 'smkkesehatan_header',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('smk_header_email', [
        'default' => 'info@merdeka-tc.id',
        'sanitize_callback' => 'sanitize_email',
    ]);
    $wp_customize->add_control('smk_header_email', [
        'label' => __('Email Address', 'smkkesehatan'),
        'section' => 'smkkesehatan_header',
        'type' => 'email',
    ]);

    $wp_customize->add_setting('smk_header_instagram', [
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control('smk_header_instagram', [
        'label' => __('Instagram URL', 'smkkesehatan'),
        'section' => 'smkkesehatan_header',
        'type' => 'url',
    ]);

    $wp_customize->add_setting('smk_header_facebook', [
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control('smk_header_facebook', [
        'label' => __('Facebook URL', 'smkkesehatan'),
        'section' => 'smkkesehatan_header',
        'type' => 'url',
    ]);

    $wp_customize->add_setting('smk_header_youtube', [
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control('smk_header_youtube', [
        'label' => __('YouTube URL', 'smkkesehatan'),
        'section' => 'smkkesehatan_header',
        'type' => 'url',
    ]);

    $wp_customize->add_setting('smk_header_cta_text', [
        'default' => 'Ayo Daftar !',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('smk_header_cta_text', [
        'label' => __('CTA Button Text', 'smkkesehatan'),
        'section' => 'smkkesehatan_header',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('smk_header_cta_url', [
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control('smk_header_cta_url', [
        'label' => __('CTA Button URL', 'smkkesehatan'),
        'section' => 'smkkesehatan_header',
        'type' => 'url',
    ]);

    // Hero Section
    $wp_customize->add_section('smkkesehatan_hero', [
        'title' => __('Hero Section', 'smkkesehatan'),
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
            'label' => __('Hero Image', 'smkkesehatan'),
            'section' => 'smkkesehatan_hero',
        ]
    ));

    $wp_customize->add_setting('smk_hero_title', [
        'default' => 'Mencetak Tenaga Kesehatan Profesional',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('smk_hero_title', [
        'label' => __('Hero Title', 'smkkesehatan'),
        'section' => 'smkkesehatan_hero',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('smk_hero_text', [
        'default' => 'Kurikulum berbasis industri, guru berpengalaman, dan fasilitas praktik modern.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control('smk_hero_text', [
        'label' => __('Hero Text', 'smkkesehatan'),
        'section' => 'smkkesehatan_hero',
        'type' => 'textarea',
    ]);

    $wp_customize->add_setting('smk_hero_button_text', [
        'default' => 'Daftar Sekarang',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('smk_hero_button_text', [
        'label' => __('Button Text', 'smkkesehatan'),
        'section' => 'smkkesehatan_hero',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('smk_hero_button_url', [
        'default' => '#',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control('smk_hero_button_url', [
        'label' => __('Button URL', 'smkkesehatan'),
        'section' => 'smkkesehatan_hero',
        'type' => 'url',
    ]);

    // Sambutan Section
    $wp_customize->add_section('smkkesehatan_sambutan', [
        'title' => __('Sambutan Kepala Sekolah', 'smkkesehatan'),
        'priority' => 31,
    ]);

    $wp_customize->add_setting('smk_sambutan_kicker', [
        'default' => 'Sambutan',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('smk_sambutan_kicker', [
        'label' => __('Kicker', 'smkkesehatan'),
        'section' => 'smkkesehatan_sambutan',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('smk_sambutan_title', [
        'default' => 'Sambutan Kepala Sekolah',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('smk_sambutan_title', [
        'label' => __('Judul', 'smkkesehatan'),
        'section' => 'smkkesehatan_sambutan',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('smk_sambutan_text', [
        'default' => 'Selamat datang di website SMK Kesehatan Bali Dewata. Kami berkomitmen untuk mencetak tenaga kesehatan profesional yang kompeten dan berakhlak mulia.<br><br>Dengan kurikulum berbasis industri, fasilitas modern, dan tenaga pengajar berpengalaman, kami siap membantu siswa meraih masa depan cerah di bidang kesehatan.',
        'sanitize_callback' => 'wp_kses_post',
    ]);
    $wp_customize->add_control('smk_sambutan_text', [
        'label' => __('Teks Sambutan (HTML allowed)', 'smkkesehatan'),
        'section' => 'smkkesehatan_sambutan',
        'type' => 'textarea',
    ]);

    $wp_customize->add_setting('smk_sambutan_name', [
        'default' => 'Dr. Ahmad Hidayat, M.Pd',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('smk_sambutan_name', [
        'label' => __('Nama Kepala Sekolah', 'smkkesehatan'),
        'section' => 'smkkesehatan_sambutan',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('smk_sambutan_position', [
        'default' => 'Kepala Sekolah SMK Kesehatan Bali Dewata',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('smk_sambutan_position', [
        'label' => __('Jabatan', 'smkkesehatan'),
        'section' => 'smkkesehatan_sambutan',
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
            'label' => __('Foto Kepala Sekolah', 'smkkesehatan'),
            'section' => 'smkkesehatan_sambutan',
        ]
    ));

    // Kompetensi Section
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
                'label' => sprintf(__('Image Program %d', 'smkkesehatan'), $i),
                'section' => 'smkkesehatan_kompetensi',
            ]
        ));

        $wp_customize->add_setting("smk_kompetensi_title_{$i}", [
            'default' => $default_kompetensi_titles[$i],
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control("smk_kompetensi_title_{$i}", [
            'label' => sprintf(__('Judul Program %d', 'smkkesehatan'), $i),
            'section' => 'smkkesehatan_kompetensi',
            'type' => 'text',
        ]);

        $wp_customize->add_setting("smk_kompetensi_text_{$i}", [
            'default' => $default_kompetensi_texts[$i],
            'sanitize_callback' => 'sanitize_textarea_field',
        ]);
        $wp_customize->add_control("smk_kompetensi_text_{$i}", [
            'label' => sprintf(__('Deskripsi Program %d', 'smkkesehatan'), $i),
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
                'label' => sprintf(__('Image Keunggulan %d', 'smkkesehatan'), $i),
                'section' => 'smkkesehatan_keunggulan',
            ]
        ));

        $wp_customize->add_setting("smk_keunggulan_title_{$i}", [
            'default' => $default_keunggulan_titles[$i],
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control("smk_keunggulan_title_{$i}", [
            'label' => sprintf(__('Judul %d', 'smkkesehatan'), $i),
            'section' => 'smkkesehatan_keunggulan',
            'type' => 'text',
        ]);

        $wp_customize->add_setting("smk_keunggulan_text_{$i}", [
            'default' => $default_keunggulan_texts[$i],
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

    $wp_customize->add_setting('smk_sidebar_youtube', [
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control('smk_sidebar_youtube', [
        'label' => __('YouTube URL', 'smkkesehatan'),
        'section' => 'smkkesehatan_sidebar',
        'type' => 'url',
    ]);

    $wp_customize->add_setting('smk_sidebar_tiktok', [
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control('smk_sidebar_tiktok', [
        'label' => __('TikTok URL', 'smkkesehatan'),
        'section' => 'smkkesehatan_sidebar',
        'type' => 'url',
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

    // About Us Page Section
    $wp_customize->add_section('smkkesehatan_about', [
        'title' => __('About Us Page', 'smkkesehatan'),
        'description' => __('Customize About Us page content', 'smkkesehatan'),
        'priority' => 41,
    ]);

    // About Hero Settings
    $wp_customize->add_setting('smk_about_hero_image', [
        'default' => get_template_directory_uri() . '/assets/images/hero-default.jpg',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'smk_about_hero_image', [
        'label' => __('About Hero Image', 'smkkesehatan'),
        'section' => 'smkkesehatan_about',
        'settings' => 'smk_about_hero_image',
    ]));

    $wp_customize->add_setting('smk_about_hero_title', [
        'default' => 'Tentang Kami',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('smk_about_hero_title', [
        'label' => __('About Hero Title', 'smkkesehatan'),
        'section' => 'smkkesehatan_about',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('smk_about_hero_text', [
        'default' => 'Mengenal lebih dekat SMK Kesehatan Bali Dewata',
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control('smk_about_hero_text', [
        'label' => __('About Hero Text', 'smkkesehatan'),
        'section' => 'smkkesehatan_about',
        'type' => 'textarea',
    ]);

    // About Content Settings
    $wp_customize->add_setting('smk_about_title', [
        'default' => 'Sejarah dan Profil Sekolah',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('smk_about_title', [
        'label' => __('About Title', 'smkkesehatan'),
        'section' => 'smkkesehatan_about',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('smk_about_text', [
        'default' => 'SMK Kesehatan Bali Dewata didirikan dengan visi untuk mencetak tenaga kesehatan profesional yang kompeten dan berakhlak mulia. Dengan pengalaman lebih dari 10 tahun dalam pendidikan vokasi kesehatan, kami telah menghasilkan ribuan lulusan yang tersebar di berbagai fasilitas kesehatan di seluruh Indonesia.<br><br>Kami berkomitmen untuk memberikan pendidikan berkualitas tinggi melalui kurikulum yang disesuaikan dengan kebutuhan industri, didukung oleh tenaga pengajar berpengalaman dan fasilitas praktik yang modern. Setiap siswa dibimbing untuk tidak hanya menguasai kompetensi teknis, tetapi juga mengembangkan karakter profesional dan etika kerja yang kuat.',
        'sanitize_callback' => 'wp_kses_post',
    ]);
    $wp_customize->add_control('smk_about_text', [
        'label' => __('About Text (HTML allowed)', 'smkkesehatan'),
        'section' => 'smkkesehatan_about',
        'type' => 'textarea',
    ]);

    $wp_customize->add_setting('smk_about_image', [
        'default' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=800&q=80',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'smk_about_image', [
        'label' => __('About Image', 'smkkesehatan'),
        'section' => 'smkkesehatan_about',
        'settings' => 'smk_about_image',
    ]));

    // Vision Settings
    $wp_customize->add_setting('smk_vision_title', [
        'default' => 'Visi',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('smk_vision_title', [
        'label' => __('Vision Title', 'smkkesehatan'),
        'section' => 'smkkesehatan_about',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('smk_vision_text', [
        'default' => 'Menjadi lembaga pendidikan vokasi kesehatan terkemuka yang menghasilkan tenaga kesehatan profesional, kompeten, dan berakhlak mulia untuk memajukan dunia kesehatan Indonesia.',
        'sanitize_callback' => 'wp_kses_post',
    ]);
    $wp_customize->add_control('smk_vision_text', [
        'label' => __('Vision Text (HTML allowed)', 'smkkesehatan'),
        'section' => 'smkkesehatan_about',
        'type' => 'textarea',
    ]);

    // Mission Settings
    $wp_customize->add_setting('smk_mission_title', [
        'default' => 'Misi',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('smk_mission_title', [
        'label' => __('Mission Title', 'smkkesehatan'),
        'section' => 'smkkesehatan_about',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('smk_mission_items', [
        'default' => "Menyelenggarakan pendidikan vokasi kesehatan berkualitas tinggi dengan kurikulum berbasis industri\nMengembangkan kompetensi siswa melalui pembelajaran teori dan praktik yang seimbang\nMembentuk karakter profesional dan etika kerja yang kuat pada setiap siswa\nMenjalin kerja sama dengan institusi kesehatan untuk program magang dan penempatan kerja\nMeningkatkan kualitas tenaga pengajar dan fasilitas pembelajaran secara berkelanjutan",
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control('smk_mission_items', [
        'label' => __('Mission Items (one per line)', 'smkkesehatan'),
        'section' => 'smkkesehatan_about',
        'type' => 'textarea',
    ]);

    // Fasilitas Page Section
    $wp_customize->add_section('smkkesehatan_fasilitas', [
        'title' => __('Fasilitas Page', 'smkkesehatan'),
        'description' => __('Customize Fasilitas page content', 'smkkesehatan'),
        'priority' => 42,
    ]);

    // Fasilitas Hero Settings
    $wp_customize->add_setting('smk_fasilitas_hero_image', [
        'default' => get_template_directory_uri() . '/assets/images/hero-default.jpg',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'smk_fasilitas_hero_image', [
        'label' => __('Fasilitas Hero Image', 'smkkesehatan'),
        'section' => 'smkkesehatan_fasilitas',
        'settings' => 'smk_fasilitas_hero_image',
    ]));

    $wp_customize->add_setting('smk_fasilitas_hero_title', [
        'default' => 'Fasilitas',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('smk_fasilitas_hero_title', [
        'label' => __('Fasilitas Hero Title', 'smkkesehatan'),
        'section' => 'smkkesehatan_fasilitas',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('smk_fasilitas_hero_text', [
        'default' => 'Fasilitas modern dan lengkap untuk mendukung pembelajaran vokasi kesehatan',
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control('smk_fasilitas_hero_text', [
        'label' => __('Fasilitas Hero Text', 'smkkesehatan'),
        'section' => 'smkkesehatan_fasilitas',
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
                'label' => sprintf(__('Fasilitas %d - Image', 'smkkesehatan'), $i),
                'section' => 'smkkesehatan_fasilitas',
            ]
        ));

        $wp_customize->add_setting("smk_fasilitas_title_{$i}", [
            'default' => $default_fasilitas_titles[$i],
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control("smk_fasilitas_title_{$i}", [
            'label' => sprintf(__('Fasilitas %d - Title', 'smkkesehatan'), $i),
            'section' => 'smkkesehatan_fasilitas',
            'type' => 'text',
        ]);

        $wp_customize->add_setting("smk_fasilitas_text_{$i}", [
            'default' => $default_fasilitas_texts[$i],
            'sanitize_callback' => 'wp_kses_post',
        ]);
        $wp_customize->add_control("smk_fasilitas_text_{$i}", [
            'label' => sprintf(__('Fasilitas %d - Description (HTML allowed)', 'smkkesehatan'), $i),
            'section' => 'smkkesehatan_fasilitas',
            'type' => 'textarea',
        ]);
    }

    // FAQ Page Section
    $wp_customize->add_section('smkkesehatan_faq', [
        'title' => __('FAQ Page', 'smkkesehatan'),
        'description' => __('Customize FAQ page hero and questions', 'smkkesehatan'),
        'priority' => 43,
    ]);

    // FAQ Hero Settings
    $wp_customize->add_setting('smk_faq_hero_image', [
        'default' => get_template_directory_uri() . '/assets/images/hero-default.jpg',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'smk_faq_hero_image', [
        'label' => __('FAQ Hero Image', 'smkkesehatan'),
        'section' => 'smkkesehatan_faq',
        'settings' => 'smk_faq_hero_image',
    ]));

    $wp_customize->add_setting('smk_faq_hero_title', [
        'default' => 'Frequently Asked Questions',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('smk_faq_hero_title', [
        'label' => __('FAQ Hero Title', 'smkkesehatan'),
        'section' => 'smkkesehatan_faq',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('smk_faq_hero_text', [
        'default' => 'Temukan jawaban atas pertanyaan yang sering diajukan seputar SMK Kesehatan',
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control('smk_faq_hero_text', [
        'label' => __('FAQ Hero Text', 'smkkesehatan'),
        'section' => 'smkkesehatan_faq',
        'type' => 'textarea',
    ]);

    // FAQ Items (10 items)
    for ($i = 1; $i <= 10; $i++) {
        $wp_customize->add_setting("smk_faq_question_{$i}", [
            'default' => '',
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control("smk_faq_question_{$i}", [
            'label' => sprintf(__('FAQ %d - Question', 'smkkesehatan'), $i),
            'section' => 'smkkesehatan_faq',
            'type' => 'text',
        ]);

        $wp_customize->add_setting("smk_faq_answer_{$i}", [
            'default' => '',
            'sanitize_callback' => 'wp_kses_post',
        ]);
        $wp_customize->add_control("smk_faq_answer_{$i}", [
            'label' => sprintf(__('FAQ %d - Answer', 'smkkesehatan'), $i),
            'section' => 'smkkesehatan_faq',
            'type' => 'textarea',
        ]);
    }
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
