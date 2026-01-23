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
        'description' => __("This image will be used for blog posts that don't have a featured image", 'badewatheme'),
        'section' => 'badewatheme_blog',
        'settings' => 'smk_blog_default_image',
    ]));

    // Floating WhatsApp Button Section
    $wp_customize->add_section('badewatheme_floating_whatsapp', [
        'title' => __('Floating WhatsApp Button', 'badewatheme'),
        'description' => __('Configure the floating WhatsApp button', 'badewatheme'),
        'priority' => 28.6,
    ]);

    $wp_customize->add_setting('smk_floating_whatsapp_enable', [
        'default' => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ]);
    $wp_customize->add_control('smk_floating_whatsapp_enable', [
        'label' => __('Enable Floating WhatsApp Button', 'badewatheme'),
        'section' => 'badewatheme_floating_whatsapp',
        'type' => 'checkbox',
    ]);

    $wp_customize->add_setting('smk_floating_whatsapp_number', [
        'default' => '+6281234567890',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('smk_floating_whatsapp_number', [
        'label' => __('WhatsApp Number', 'badewatheme'),
        'description' => __('Format: +62XXXXXXXXXX', 'badewatheme'),
        'section' => 'badewatheme_floating_whatsapp',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('smk_floating_whatsapp_message', [
        'default' => 'Hello! I would like to get more information.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control('smk_floating_whatsapp_message', [
        'label' => __('Default Message', 'badewatheme'),
        'description' => __('Pre-filled message when chat opens', 'badewatheme'),
        'section' => 'badewatheme_floating_whatsapp',
        'type' => 'textarea',
    ]);

    $wp_customize->add_setting('smk_floating_whatsapp_position', [
        'default' => 'right',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('smk_floating_whatsapp_position', [
        'label' => __('Button Position', 'badewatheme'),
        'section' => 'badewatheme_floating_whatsapp',
        'type' => 'select',
        'choices' => [
            'left' => __('Bottom Left', 'badewatheme'),
            'right' => __('Bottom Right', 'badewatheme'),
        ],
    ]);

    // Header Section
    $wp_customize->add_section('badewatheme_header', [
        'title' => __('Header Settings', 'badewatheme'),
        'priority' => 29,
    ]);

    $wp_customize->add_setting('smk_header_phone', [
        'default' => '+6281234567890',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('smk_header_phone', [
        'label' => __('Phone Number', 'badewatheme'),
        'section' => 'badewatheme_header',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('smk_header_email', [
        'default' => 'info@email.com',
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

    // Number of Kompetensi items
    $wp_customize->add_setting('smk_kompetensi_count', [
        'default' => 2,
        'sanitize_callback' => 'absint',
        'transport' => 'refresh',
    ]);
    $wp_customize->add_control('smk_kompetensi_count', [
        'label' => __('Number of Program Items', 'badewatheme'),
        'description' => __('How many program items to display (1-10)', 'badewatheme'),
        'section' => 'badewatheme_kompetensi',
        'type' => 'number',
        'input_attrs' => [
            'min' => 1,
            'max' => 10,
            'step' => 1,
        ],
    ]);

    $default_kompetensi_titles = [
        1 => 'Software Engineering',
        2 => 'Business Management',
        3 => 'Digital Marketing',
        4 => 'Graphic Design',
        5 => 'Accounting & Finance',
        6 => 'Hospitality & Tourism',
        7 => 'Multimedia Production',
        8 => 'Office Administration',
        9 => 'Web Development',
        10 => 'Data Analytics',
    ];
    $default_kompetensi_texts = [
        1 => 'Learn programming, application development, and software engineering principles to build modern digital solutions.',
        2 => 'Master business planning, management strategies, and entrepreneurship skills for effective organizational leadership.',
        3 => 'Develop expertise in online marketing, social media strategy, content creation, and digital campaign management.',
        4 => 'Create visual communications, branding materials, and digital designs using industry-standard tools and techniques.',
        5 => 'Gain proficiency in financial management, bookkeeping, taxation, and accounting practices for various industries.',
        6 => 'Prepare for careers in hotel management, tourism services, event planning, and customer experience excellence.',
        7 => 'Produce engaging multimedia content including video, audio, animation, and interactive media for various platforms.',
        8 => 'Develop administrative skills, office management techniques, and business communication for professional environments.',
        9 => 'Build responsive websites and web applications using modern frameworks, databases, and development practices.',
        10 => 'Analyze data, create insights, and make data-driven decisions using statistical tools and visualization techniques.',
    ];

    for ($i = 1; $i <= 10; $i++) {
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

    // Section Kicker
    $wp_customize->add_setting('smk_keunggulan_kicker', [
        'default' => 'Mengapa Kami',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('smk_keunggulan_kicker', [
        'label' => __('Section Kicker', 'badewatheme'),
        'description' => __('Small text above the title', 'badewatheme'),
        'section' => 'badewatheme_keunggulan',
        'type' => 'text',
    ]);

    // Section Title
    $wp_customize->add_setting('smk_keunggulan_title', [
        'default' => 'Keunggulan SMK Kesehatan Bali Dewata',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('smk_keunggulan_title', [
        'label' => __('Section Title', 'badewatheme'),
        'section' => 'badewatheme_keunggulan',
        'type' => 'text',
    ]);

    // Section Description
    $wp_customize->add_setting('smk_keunggulan_intro', [
        'default' => 'Lingkungan belajar yang formal, profesional, dan adaptif dengan kebutuhan dunia kesehatan.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control('smk_keunggulan_intro', [
        'label' => __('Section Description', 'badewatheme'),
        'section' => 'badewatheme_keunggulan',
        'type' => 'textarea',
    ]);

    // Number of Keunggulan items
    $wp_customize->add_setting('smk_keunggulan_count', [
        'default' => 4,
        'sanitize_callback' => 'absint',
        'transport' => 'refresh',
    ]);
    $wp_customize->add_control('smk_keunggulan_count', [
        'label' => __('Number of Keunggulan Items', 'badewatheme'),
        'description' => __('How many keunggulan items to display (1-8)', 'badewatheme'),
        'section' => 'badewatheme_keunggulan',
        'type' => 'number',
        'input_attrs' => [
            'min' => 1,
            'max' => 8,
            'step' => 1,
        ],
    ]);

    $default_keunggulan_titles = [
        1 => 'Kurikulum Industri',
        2 => 'Fasilitas Modern',
        3 => 'Pengajar Profesional',
        4 => 'Jalur Karier',
        5 => 'Program Magang',
        6 => 'Sertifikasi Kompetensi',
        7 => 'Dukungan Karir',
        8 => 'Komunitas Alumni',
    ];
    $default_keunggulan_texts = [
        1 => 'Materi dirancang bersama mitra kesehatan untuk membekali kompetensi nyata.',
        2 => 'Laboratorium praktik dan ruang simulasi yang mendukung pembelajaran aktif.',
        3 => 'Tenaga pendidik berpengalaman di bidang kesehatan dan pendidikan vokasi.',
        4 => 'Program pendampingan alumni dan kerja sama industri untuk penempatan kerja.',
        5 => 'Pengalaman kerja langsung di institusi kesehatan mitra untuk praktik nyata.',
        6 => 'Pelatihan dan ujian sertifikasi profesi sesuai standar industri kesehatan.',
        7 => 'Bimbingan karir dan job placement untuk mempersiapkan lulusan memasuki dunia kerja.',
        8 => 'Jaringan alumni aktif yang saling mendukung dalam pengembangan karir.',
    ];

    for ($i = 1; $i <= 8; $i++) {
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

    // Our Team Section
    $wp_customize->add_section('badewatheme_team', [
        'title' => __('Our Team', 'badewatheme'),
        'description' => __('Customize Our Team section on About page', 'badewatheme'),
        'priority' => 41,
    ]);

    $wp_customize->add_setting('smk_team_title', [
        'default' => 'Our Team',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('smk_team_title', [
        'label' => __('Section Title', 'badewatheme'),
        'section' => 'badewatheme_team',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('smk_team_description', [
        'default' => 'Meet our dedicated team of professionals committed to providing quality education.',
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control('smk_team_description', [
        'label' => __('Section Description', 'badewatheme'),
        'section' => 'badewatheme_team',
        'type' => 'textarea',
    ]);

    // Team Image
    $wp_customize->add_setting('smk_team_image', [
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'smk_team_image',
        [
            'label' => __('Team Photo', 'badewatheme'),
            'description' => __('Upload a group photo of your team', 'badewatheme'),
            'section' => 'badewatheme_team',
        ]
    ));

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

    // Number of Fasilitas items
    $wp_customize->add_setting('smk_fasilitas_count', [
        'default' => 4,
        'sanitize_callback' => 'absint',
        'transport' => 'refresh',
    ]);
    $wp_customize->add_control('smk_fasilitas_count', [
        'label' => __('Number of Fasilitas Items', 'badewatheme'),
        'description' => __('How many fasilitas items to display (1-20)', 'badewatheme'),
        'section' => 'badewatheme_fasilitas',
        'type' => 'number',
        'input_attrs' => [
            'min' => 1,
            'max' => 20,
            'step' => 1,
        ],
    ]);

    // Fasilitas Items (up to 20 facilities)
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

    for ($i = 1; $i <= 20; $i++) {
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

    // Galeri Page Section
    $wp_customize->add_section('badewatheme_galeri', [
        'title' => __('Galeri Page', 'badewatheme'),
        'description' => __('Customize Galeri page content', 'badewatheme'),
        'priority' => 42,
    ]);

    // Galeri Hero Settings
    $wp_customize->add_setting('smk_galeri_hero_image', [
        'default' => get_template_directory_uri() . '/assets/images/hero-default.jpg',
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'smk_galeri_hero_image', [
        'label' => __('Galeri Hero Image', 'badewatheme'),
        'section' => 'badewatheme_galeri',
        'settings' => 'smk_galeri_hero_image',
    ]));

    $wp_customize->add_setting('smk_galeri_hero_title', [
        'default' => 'Galeri',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('smk_galeri_hero_title', [
        'label' => __('Galeri Hero Title', 'badewatheme'),
        'section' => 'badewatheme_galeri',
        'type' => 'text',
    ]);

    $wp_customize->add_setting('smk_galeri_hero_text', [
        'default' => 'Dokumentasi kegiatan dan momen berharga di SMK Kesehatan Bali Dewata',
        'sanitize_callback' => 'sanitize_textarea_field',
    ]);
    $wp_customize->add_control('smk_galeri_hero_text', [
        'label' => __('Galeri Hero Text', 'badewatheme'),
        'section' => 'badewatheme_galeri',
        'type' => 'textarea',
    ]);

    // Number of Gallery items
    $wp_customize->add_setting('smk_galeri_count', [
        'default' => 12,
        'sanitize_callback' => 'absint',
        'transport' => 'refresh',
    ]);
    $wp_customize->add_control('smk_galeri_count', [
        'label' => __('Number of Gallery Images', 'badewatheme'),
        'description' => __('How many gallery images to display (1-30)', 'badewatheme'),
        'section' => 'badewatheme_galeri',
        'type' => 'number',
        'input_attrs' => [
            'min' => 1,
            'max' => 30,
            'step' => 1,
        ],
    ]);

    // Gallery Images (up to 30 images)
    for ($i = 1; $i <= 30; $i++) {
        $wp_customize->add_setting("smk_galeri_image_{$i}", [
            'default' => '',
            'sanitize_callback' => 'esc_url_raw',
        ]);
        $wp_customize->add_control(new WP_Customize_Image_Control(
            $wp_customize,
            "smk_galeri_image_{$i}",
            [
                'label' => sprintf(__('Gallery Image %d', 'badewatheme'), $i),
                'section' => 'badewatheme_galeri',
            ]
        ));

        $wp_customize->add_setting("smk_galeri_alt_{$i}", [
            'default' => "Galeri {$i}",
            'sanitize_callback' => 'sanitize_text_field',
        ]);
        $wp_customize->add_control("smk_galeri_alt_{$i}", [
            'label' => sprintf(__('Gallery Image %d - Alt Text', 'badewatheme'), $i),
            'section' => 'badewatheme_galeri',
            'type' => 'text',
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
        'default' => '+6281234567890',
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

// Register Program Custom Post Type
function badewatheme_register_program_cpt() {
    $labels = [
        'name'               => __('Programs', 'badewatheme'),
        'singular_name'      => __('Program', 'badewatheme'),
        'menu_name'          => __('Programs', 'badewatheme'),
        'add_new'            => __('Add New', 'badewatheme'),
        'add_new_item'       => __('Add New Program', 'badewatheme'),
        'edit_item'          => __('Edit Program', 'badewatheme'),
        'new_item'           => __('New Program', 'badewatheme'),
        'view_item'          => __('View Program', 'badewatheme'),
        'search_items'       => __('Search Programs', 'badewatheme'),
        'not_found'          => __('No programs found', 'badewatheme'),
        'not_found_in_trash' => __('No programs found in Trash', 'badewatheme'),
    ];

    $args = [
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => ['slug' => 'program'],
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => 5,
        'menu_icon'          => 'dashicons-welcome-learn-more',
        'supports'           => ['title', 'editor', 'thumbnail'],
    ];

    register_post_type('program', $args);
}
add_action('init', 'badewatheme_register_program_cpt');

// Flush rewrite rules on theme activation
function badewatheme_rewrite_flush() {
    badewatheme_register_program_cpt();
    flush_rewrite_rules();
}
add_action('after_switch_theme', 'badewatheme_rewrite_flush');

// Also flush when CPT is first registered (one-time)
function badewatheme_flush_rewrite_once() {
    if (get_option('badewatheme_flush_rewrite') !== 'done') {
        flush_rewrite_rules();
        update_option('badewatheme_flush_rewrite', 'done');
    }
}
add_action('init', 'badewatheme_flush_rewrite_once', 20);

// Add Meta Boxes for Program
function badewatheme_program_meta_boxes() {
    add_meta_box(
        'program_hero_settings',
        __('Hero Section Settings', 'badewatheme'),
        'badewatheme_program_hero_callback',
        'program',
        'normal',
        'high'
    );

    add_meta_box(
        'program_sections_settings',
        __('Content Sections (Alternating Layout)', 'badewatheme'),
        'badewatheme_program_sections_callback',
        'program',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'badewatheme_program_meta_boxes');

// Hero Section Meta Box Callback
function badewatheme_program_hero_callback($post) {
    wp_nonce_field('badewatheme_program_meta', 'badewatheme_program_nonce');

    $hero_image = get_post_meta($post->ID, '_program_hero_image', true);
    $hero_title = get_post_meta($post->ID, '_program_hero_title', true);
    $hero_text = get_post_meta($post->ID, '_program_hero_text', true);
    ?>
    <table class="form-table">
        <tr>
            <th><label for="program_hero_image"><?php _e('Hero Image URL', 'badewatheme'); ?></label></th>
            <td>
                <input type="text" id="program_hero_image" name="program_hero_image" value="<?php echo esc_attr($hero_image); ?>" class="large-text">
                <p class="description"><?php _e('Enter the URL of the hero background image or use Media Library.', 'badewatheme'); ?></p>
                <button type="button" class="button program-upload-image" data-target="program_hero_image"><?php _e('Upload Image', 'badewatheme'); ?></button>
            </td>
        </tr>
        <tr>
            <th><label for="program_hero_title"><?php _e('Hero Title', 'badewatheme'); ?></label></th>
            <td>
                <input type="text" id="program_hero_title" name="program_hero_title" value="<?php echo esc_attr($hero_title); ?>" class="large-text">
                <p class="description"><?php _e('Leave empty to use the post title.', 'badewatheme'); ?></p>
            </td>
        </tr>
        <tr>
            <th><label for="program_hero_text"><?php _e('Hero Subtitle/Text', 'badewatheme'); ?></label></th>
            <td>
                <textarea id="program_hero_text" name="program_hero_text" rows="3" class="large-text"><?php echo esc_textarea($hero_text); ?></textarea>
            </td>
        </tr>
    </table>
    <?php
}

// Sections Meta Box Callback
function badewatheme_program_sections_callback($post) {
    $section_count = get_post_meta($post->ID, '_program_section_count', true);
    $section_count = $section_count ? intval($section_count) : 3;
    ?>
    <p>
        <label for="program_section_count"><strong><?php _e('Number of Sections:', 'badewatheme'); ?></strong></label>
        <select id="program_section_count" name="program_section_count">
            <?php for ($i = 1; $i <= 10; $i++): ?>
                <option value="<?php echo $i; ?>" <?php selected($section_count, $i); ?>><?php echo $i; ?></option>
            <?php endfor; ?>
        </select>
        <span class="description"><?php _e('Select how many content sections to display (max 10).', 'badewatheme'); ?></span>
    </p>
    <p class="description" style="margin-bottom: 20px;">
        <?php _e('Sections will automatically alternate: Section 1 = Text Left / Image Right, Section 2 = Image Left / Text Right, and so on.', 'badewatheme'); ?>
    </p>
    <hr>

    <div id="program-sections-container">
        <?php for ($i = 1; $i <= 10; $i++):
            $section_image = get_post_meta($post->ID, "_program_section_image_{$i}", true);
            $section_title = get_post_meta($post->ID, "_program_section_title_{$i}", true);
            $section_text = get_post_meta($post->ID, "_program_section_text_{$i}", true);
            $display = $i <= $section_count ? '' : 'display: none;';
        ?>
            <div class="program-section-item" data-section="<?php echo $i; ?>" style="<?php echo $display; ?> margin-bottom: 30px; padding: 20px; background: #f9f9f9; border-left: 4px solid #007e41;">
                <h3 style="margin-top: 0;">
                    <?php printf(__('Section %d', 'badewatheme'), $i); ?>
                    <span style="font-weight: normal; font-size: 13px; color: #666;">
                        (<?php echo $i % 2 === 1 ? __('Text Left / Image Right', 'badewatheme') : __('Image Left / Text Right', 'badewatheme'); ?>)
                    </span>
                </h3>
                <table class="form-table" style="margin: 0;">
                    <tr>
                        <th style="width: 150px;"><label><?php _e('Section Image URL', 'badewatheme'); ?></label></th>
                        <td>
                            <input type="text" name="program_section_image_<?php echo $i; ?>" value="<?php echo esc_attr($section_image); ?>" class="large-text">
                            <button type="button" class="button program-upload-image" data-target="program_section_image_<?php echo $i; ?>"><?php _e('Upload Image', 'badewatheme'); ?></button>
                        </td>
                    </tr>
                    <tr>
                        <th><label><?php _e('Section Title', 'badewatheme'); ?></label></th>
                        <td>
                            <input type="text" name="program_section_title_<?php echo $i; ?>" value="<?php echo esc_attr($section_title); ?>" class="large-text">
                        </td>
                    </tr>
                    <tr>
                        <th><label><?php _e('Section Content', 'badewatheme'); ?></label></th>
                        <td>
                            <textarea name="program_section_text_<?php echo $i; ?>" rows="5" class="large-text"><?php echo esc_textarea($section_text); ?></textarea>
                            <p class="description"><?php _e('HTML is allowed.', 'badewatheme'); ?></p>
                        </td>
                    </tr>
                </table>
            </div>
        <?php endfor; ?>
    </div>

    <script>
    jQuery(document).ready(function($) {
        // Toggle section visibility based on count
        $('#program_section_count').on('change', function() {
            var count = parseInt($(this).val());
            $('.program-section-item').each(function() {
                var sectionNum = parseInt($(this).data('section'));
                if (sectionNum <= count) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });

        // Media uploader for images
        $('.program-upload-image').on('click', function(e) {
            e.preventDefault();
            var button = $(this);
            var targetInput = $('input[name="' + button.data('target') + '"]');
            if (!targetInput.length) {
                targetInput = $('#' + button.data('target'));
            }

            var frame = wp.media({
                title: '<?php _e('Select or Upload Image', 'badewatheme'); ?>',
                button: { text: '<?php _e('Use this image', 'badewatheme'); ?>' },
                multiple: false
            });

            frame.on('select', function() {
                var attachment = frame.state().get('selection').first().toJSON();
                targetInput.val(attachment.url);
            });

            frame.open();
        });
    });
    </script>
    <?php
}

// Save Program Meta
function badewatheme_save_program_meta($post_id) {
    // Verify nonce
    if (!isset($_POST['badewatheme_program_nonce']) || !wp_verify_nonce($_POST['badewatheme_program_nonce'], 'badewatheme_program_meta')) {
        return;
    }

    // Check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Save hero settings
    if (isset($_POST['program_hero_image'])) {
        update_post_meta($post_id, '_program_hero_image', esc_url_raw($_POST['program_hero_image']));
    }
    if (isset($_POST['program_hero_title'])) {
        update_post_meta($post_id, '_program_hero_title', sanitize_text_field($_POST['program_hero_title']));
    }
    if (isset($_POST['program_hero_text'])) {
        update_post_meta($post_id, '_program_hero_text', sanitize_textarea_field($_POST['program_hero_text']));
    }

    // Save section count
    if (isset($_POST['program_section_count'])) {
        $section_count = absint($_POST['program_section_count']);
        if ($section_count < 1) $section_count = 1;
        if ($section_count > 10) $section_count = 10;
        update_post_meta($post_id, '_program_section_count', $section_count);
    }

    // Save section content
    for ($i = 1; $i <= 10; $i++) {
        if (isset($_POST["program_section_image_{$i}"])) {
            update_post_meta($post_id, "_program_section_image_{$i}", esc_url_raw($_POST["program_section_image_{$i}"]));
        }
        if (isset($_POST["program_section_title_{$i}"])) {
            update_post_meta($post_id, "_program_section_title_{$i}", sanitize_text_field($_POST["program_section_title_{$i}"]));
        }
        if (isset($_POST["program_section_text_{$i}"])) {
            update_post_meta($post_id, "_program_section_text_{$i}", wp_kses_post($_POST["program_section_text_{$i}"]));
        }
    }
}
add_action('save_post_program', 'badewatheme_save_program_meta');

// Enqueue media uploader for program edit page
function badewatheme_program_admin_scripts($hook) {
    global $post_type;
    if (($hook === 'post-new.php' || $hook === 'post.php') && $post_type === 'program') {
        wp_enqueue_media();
    }
}
add_action('admin_enqueue_scripts', 'badewatheme_program_admin_scripts');
