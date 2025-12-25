<?php
get_header();
?>

<main>
    <?php
    $hero_defaults = [
        [
            'image' => 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?auto=format&fit=crop&w=1600&q=80',
            'kicker' => 'SMK Kesehatan Bali Dewata',
            'title' => 'Mencetak Tenaga Kesehatan Profesional',
            'text' => 'Kurikulum berbasis industri, guru berpengalaman, dan fasilitas praktik modern.',
        ],
        [
            'image' => 'https://images.unsplash.com/photo-1526256262350-7da7584cf5eb?auto=format&fit=crop&w=1600&q=80',
            'kicker' => 'Fasilitas Lengkap',
            'title' => 'Laboratorium Farmasi & Keperawatan',
            'text' => 'Simulasi klinis dan peralatan terbaru untuk pengalaman belajar nyata.',
        ],
        [
            'image' => 'https://images.unsplash.com/photo-1504439468489-c8920d796a29?auto=format&fit=crop&w=1600&q=80',
            'kicker' => 'Berbasis Karier',
            'title' => 'Siap Kerja, Siap Kuliah',
            'text' => 'Kemitraan dengan fasilitas kesehatan dan alumni yang sukses di berbagai institusi.',
        ],
    ];

    $hero_slides = [];
    for ($i = 1; $i <= 3; $i++) {
        $hero_slides[] = [
            'image' => get_theme_mod("smk_hero_image_{$i}", $hero_defaults[$i - 1]['image']),
            'kicker' => get_theme_mod("smk_hero_kicker_{$i}", $hero_defaults[$i - 1]['kicker']),
            'title' => get_theme_mod("smk_hero_title_{$i}", $hero_defaults[$i - 1]['title']),
            'text' => get_theme_mod("smk_hero_text_{$i}", $hero_defaults[$i - 1]['text']),
        ];
    }
    ?>

    <section id="hero" class="hero-section">
        <div id="heroCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="6500">
            <div class="carousel-indicators">
                <?php foreach ($hero_slides as $index => $slide) : ?>
                    <button type="button" data-bs-target="#heroCarousel" data-bs-slide-to="<?php echo esc_attr($index); ?>" class="<?php echo $index === 0 ? 'active' : ''; ?>" aria-current="<?php echo $index === 0 ? 'true' : 'false'; ?>" aria-label="<?php echo esc_attr(sprintf(__('Slide %d', 'smkkesehatan'), $index + 1)); ?>"></button>
                <?php endforeach; ?>
            </div>
            <div class="carousel-inner">
                <?php foreach ($hero_slides as $index => $slide) : ?>
                    <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                        <img src="<?php echo esc_url($slide['image']); ?>" class="d-block w-100 hero-image" alt="<?php echo esc_attr($slide['title']); ?>">
                        <div class="carousel-caption">
                            <div class="hero-card">
                                <?php if (!empty($slide['kicker'])) : ?>
                                    <p class="hero-kicker"><?php echo esc_html($slide['kicker']); ?></p>
                                <?php endif; ?>
                                <?php if (!empty($slide['title'])) : ?>
                                    <?php if ($index === 0) : ?>
                                        <h1 class="hero-title"><?php echo esc_html($slide['title']); ?></h1>
                                    <?php else : ?>
                                        <h2 class="hero-title"><?php echo esc_html($slide['title']); ?></h2>
                                    <?php endif; ?>
                                <?php endif; ?>
                                <?php if (!empty($slide['text'])) : ?>
                                    <p class="hero-text"><?php echo esc_html($slide['text']); ?></p>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#heroCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden"><?php esc_html_e('Previous', 'smkkesehatan'); ?></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#heroCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden"><?php esc_html_e('Next', 'smkkesehatan'); ?></span>
            </button>
        </div>
    </section>

    <section id="kompetensi" class="section-pad">
        <div class="container">
            <div class="section-header">
                <p class="section-kicker">Program Unggulan</p>
                <h2>Kompetensi Keahlian</h2>
                <p><?php echo esc_html(get_theme_mod('smk_kompetensi_intro', 'Jalur pembelajaran spesifik dengan sertifikasi dan praktik industri untuk karier masa depan.')); ?></p>
            </div>
            <div class="row g-4">
                <div class="col-md-6">
                    <div class="card kompetensi-card h-100">
                        <div class="card-body">
                            <p class="card-kicker"><?php echo esc_html(get_theme_mod('smk_kompetensi_kicker_1', 'Farmasi')); ?></p>
                            <h3 class="card-title"><?php echo esc_html(get_theme_mod('smk_kompetensi_title_1', 'Asisten Tenaga Kefarmasian')); ?></h3>
                            <p class="card-text"><?php echo esc_html(get_theme_mod('smk_kompetensi_text_1', 'Fokus pada peracikan obat, pelayanan farmasi, dan manajemen logistik obat.')); ?></p>
                            <ul class="kompetensi-list">
                                <?php
                                $list_items = preg_split('/\r\n|\r|\n/', (string) get_theme_mod('smk_kompetensi_list_1', "Praktik laboratorium formulasi obat.\nSimulasi layanan apotek modern.\nMagang di klinik dan rumah sakit."));
                                foreach ($list_items as $item) :
                                    $item = trim($item);
                                    if ($item === '') {
                                        continue;
                                    }
                                    ?>
                                    <li><?php echo esc_html($item); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card kompetensi-card h-100">
                        <div class="card-body">
                            <p class="card-kicker"><?php echo esc_html(get_theme_mod('smk_kompetensi_kicker_2', 'Perawat')); ?></p>
                            <h3 class="card-title"><?php echo esc_html(get_theme_mod('smk_kompetensi_title_2', 'Asisten Keperawatan')); ?></h3>
                            <p class="card-text"><?php echo esc_html(get_theme_mod('smk_kompetensi_text_2', 'Pembelajaran keterampilan klinis dasar, komunikasi pasien, dan etika profesi.')); ?></p>
                            <ul class="kompetensi-list">
                                <?php
                                $list_items = preg_split('/\r\n|\r|\n/', (string) get_theme_mod('smk_kompetensi_list_2', "Simulasi tindakan keperawatan harian.\nPendampingan guru klinis berpengalaman.\nKegiatan praktik di fasilitas kesehatan."));
                                foreach ($list_items as $item) :
                                    $item = trim($item);
                                    if ($item === '') {
                                        continue;
                                    }
                                    ?>
                                    <li><?php echo esc_html($item); ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="keunggulan" class="section-pad section-accent">
        <div class="container">
            <div class="section-header">
                <p class="section-kicker">Mengapa Kami</p>
                <h2>Keunggulan SMK Kesehatan Bali Dewata</h2>
                <p><?php echo esc_html(get_theme_mod('smk_keunggulan_intro', 'Lingkungan belajar yang formal, profesional, dan adaptif dengan kebutuhan dunia kesehatan.')); ?></p>
            </div>
            <div class="row g-4">
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card h-100">
                        <span class="feature-number">01</span>
                        <h3><?php echo esc_html(get_theme_mod('smk_keunggulan_title_1', 'Kurikulum Industri')); ?></h3>
                        <p><?php echo esc_html(get_theme_mod('smk_keunggulan_text_1', 'Materi dirancang bersama mitra kesehatan untuk membekali kompetensi nyata.')); ?></p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card h-100">
                        <span class="feature-number">02</span>
                        <h3><?php echo esc_html(get_theme_mod('smk_keunggulan_title_2', 'Fasilitas Modern')); ?></h3>
                        <p><?php echo esc_html(get_theme_mod('smk_keunggulan_text_2', 'Laboratorium praktik dan ruang simulasi yang mendukung pembelajaran aktif.')); ?></p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card h-100">
                        <span class="feature-number">03</span>
                        <h3><?php echo esc_html(get_theme_mod('smk_keunggulan_title_3', 'Pengajar Profesional')); ?></h3>
                        <p><?php echo esc_html(get_theme_mod('smk_keunggulan_text_3', 'Tenaga pendidik berpengalaman di bidang kesehatan dan pendidikan vokasi.')); ?></p>
                    </div>
                </div>
                <div class="col-md-6 col-lg-3">
                    <div class="feature-card h-100">
                        <span class="feature-number">04</span>
                        <h3><?php echo esc_html(get_theme_mod('smk_keunggulan_title_4', 'Jalur Karier')); ?></h3>
                        <p><?php echo esc_html(get_theme_mod('smk_keunggulan_text_4', 'Program pendampingan alumni dan kerja sama industri untuk penempatan kerja.')); ?></p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="blog" class="section-pad">
        <div class="container">
            <div class="section-header">
                <p class="section-kicker">Informasi Sekolah</p>
                <h2>Latest Blog</h2>
                <p>Ikuti berita, kegiatan, dan prestasi terbaru dari SMK Kesehatan Bali Dewata.</p>
            </div>
            <div class="row g-4">
                <?php
                $latest_posts = new WP_Query([
                    'posts_per_page' => 5,
                    'post_status' => 'publish',
                ]);
                if ($latest_posts->have_posts()) :
                    while ($latest_posts->have_posts()) :
                        $latest_posts->the_post();
                        ?>
                        <div class="col-md-6 col-lg-4">
                            <article class="card blog-card h-100">
                                <?php if (has_post_thumbnail()) : ?>
                                    <?php the_post_thumbnail('medium_large', ['class' => 'card-img-top']); ?>
                                <?php else : ?>
                                    <div class="blog-thumb-placeholder"></div>
                                <?php endif; ?>
                                <div class="card-body">
                                    <p class="card-kicker"><?php echo esc_html(get_the_date()); ?></p>
                                    <h3 class="card-title">
                                        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                    </h3>
                                    <p class="card-text"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 18)); ?></p>
                                </div>
                                <div class="card-footer">
                                    <a class="btn btn-link" href="<?php the_permalink(); ?>">Baca selengkapnya</a>
                                </div>
                            </article>
                        </div>
                        <?php
                    endwhile;
                    wp_reset_postdata();
                else :
                    ?>
                    <div class="col-12">
                        <div class="empty-state">
                            <h3>Belum ada artikel</h3>
                            <p>Berita sekolah akan segera diperbarui.</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </section>

</main>

<?php
get_footer();
