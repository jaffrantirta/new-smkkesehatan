<?php
get_header();
?>

<main>
    <?php
    // Hero Section Data
    $hero_image = get_theme_mod('smk_hero_image', 'https://images.unsplash.com/photo-1503676260728-1c00da094a0b?auto=format&fit=crop&w=1600&q=80');
    $hero_title = get_theme_mod('smk_hero_title', 'Mencetak Tenaga Kesehatan Profesional');
    $hero_text = get_theme_mod('smk_hero_text', 'Kurikulum berbasis industri, guru berpengalaman, dan fasilitas praktik modern.');
    $hero_button_text = get_theme_mod('smk_hero_button_text', 'Daftar Sekarang');
    $hero_button_url = get_theme_mod('smk_hero_button_url', '#');
    ?>

    <section id="hero" class="hero-section">
        <div class="hero-container">
            <img src="<?php echo esc_url($hero_image); ?>" class="hero-image" alt="<?php echo esc_attr($hero_title); ?>">
            <div class="hero-overlay"></div>
            <div class="hero-content">
                <div class="container">
                    <div class="hero-text-wrapper">
                        <h1 class="hero-title"><?php echo esc_html($hero_title); ?></h1>
                        <p class="hero-text"><?php echo esc_html($hero_text); ?></p>
                        <a href="<?php echo esc_url($hero_button_url); ?>" class="btn btn-hero">
                            <?php echo esc_html($hero_button_text); ?>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section id="sambutan" class="section-pad bg-light">
        <div class="container">
            <div class="row align-items-center g-5">
                <div class="col-lg-6">
                    <div class="sambutan-content">
                        <p class="section-kicker"><?php echo esc_html(get_theme_mod('smk_sambutan_kicker', 'Sambutan')); ?></p>
                        <h2 class="sambutan-title"><?php echo esc_html(get_theme_mod('smk_sambutan_title', 'Sambutan Kepala Sekolah')); ?></h2>
                        <div class="sambutan-text">
                            <?php echo wpautop(wp_kses_post(get_theme_mod('smk_sambutan_text', 'Selamat datang di website SMK Kesehatan Bali Dewata. Kami berkomitmen untuk mencetak tenaga kesehatan profesional yang kompeten dan berakhlak mulia.<br><br>Dengan kurikulum berbasis industri, fasilitas modern, dan tenaga pengajar berpengalaman, kami siap membantu siswa meraih masa depan cerah di bidang kesehatan.'))); ?>
                        </div>
                        <?php if (get_theme_mod('smk_sambutan_name', '')): ?>
                            <div class="sambutan-signature">
                                <strong><?php echo esc_html(get_theme_mod('smk_sambutan_name', 'Dr. Ahmad Hidayat, M.Pd')); ?></strong>
                                <p class="text-muted"><?php echo esc_html(get_theme_mod('smk_sambutan_position', 'Kepala Sekolah SMK Kesehatan Bali Dewata')); ?></p>
                            </div>
                        <?php endif; ?>
                    </div>
                </div>
                <div class="col-lg-6">
                    <?php
                    $sambutan_image = get_theme_mod('smk_sambutan_image', 'https://images.unsplash.com/photo-1560250097-0b93528c311a?auto=format&fit=crop&w=800&q=80');
                    ?>
                    <?php if ($sambutan_image): ?>
                        <div class="sambutan-image">
                            <img src="<?php echo esc_url($sambutan_image); ?>" alt="<?php echo esc_attr(get_theme_mod('smk_sambutan_name', 'Kepala Sekolah')); ?>" loading="lazy">
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <section id="kompetensi" class="section-pad">
        <div class="container">
            <div class="section-header">
                <p class="section-kicker">Program Unggulan</p>
                <h2>Kompetensi Keahlian</h2>
                <p><?php echo esc_html(get_theme_mod('smk_kompetensi_intro', 'Jalur pembelajaran spesifik dengan sertifikasi dan praktik industri untuk karier masa depan.')); ?></p>
            </div>
            <?php
            $kompetensi_count = absint(get_theme_mod('smk_kompetensi_count', 2));
            if ($kompetensi_count < 1) $kompetensi_count = 1;
            if ($kompetensi_count > 10) $kompetensi_count = 10;

            $default_images = [
                1 => 'https://images.unsplash.com/photo-1517694712202-14dd9538aa97?auto=format&fit=crop&w=1200&q=80',
                2 => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=1200&q=80',
                3 => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?auto=format&fit=crop&w=1200&q=80',
                4 => 'https://images.unsplash.com/photo-1561070791-2526d30994b5?auto=format&fit=crop&w=1200&q=80',
                5 => 'https://images.unsplash.com/photo-1554224155-8d04cb21cd6c?auto=format&fit=crop&w=1200&q=80',
                6 => 'https://images.unsplash.com/photo-1551882547-ff40c63fe5fa?auto=format&fit=crop&w=1200&q=80',
                7 => 'https://images.unsplash.com/photo-1492619375914-88005aa9e8fb?auto=format&fit=crop&w=1200&q=80',
                8 => 'https://images.unsplash.com/photo-1497032628192-86f99bcd76bc?auto=format&fit=crop&w=1200&q=80',
                9 => 'https://images.unsplash.com/photo-1498050108023-c5249f4df085?auto=format&fit=crop&w=1200&q=80',
                10 => 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?auto=format&fit=crop&w=1200&q=80',
            ];
            $default_titles = [
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
            $default_texts = [
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
            $kompetensi_items = [];
            for ($i = 1; $i <= $kompetensi_count; $i++) {
                $kompetensi_items[] = [
                    'image' => get_theme_mod("smk_kompetensi_image_{$i}", isset($default_images[$i]) ? $default_images[$i] : ''),
                    'title' => get_theme_mod("smk_kompetensi_title_{$i}", isset($default_titles[$i]) ? $default_titles[$i] : ''),
                    'text' => get_theme_mod("smk_kompetensi_text_{$i}", isset($default_texts[$i]) ? $default_texts[$i] : ''),
                ];
            }
            ?>
            <div id="programCarousel" class="carousel slide program-carousel" data-bs-ride="carousel" data-bs-interval="5000">
                <div class="carousel-indicators">
                    <?php foreach ($kompetensi_items as $index => $item): ?>
                        <button type="button" data-bs-target="#programCarousel" data-bs-slide-to="<?php echo esc_attr($index); ?>" class="<?php echo $index === 0 ? 'active' : ''; ?>" aria-current="<?php echo $index === 0 ? 'true' : 'false'; ?>" aria-label="<?php echo esc_attr(sprintf(__('Program %d', 'badewatheme'), $index + 1)); ?>"></button>
                    <?php endforeach; ?>
                </div>
                <div class="carousel-inner">
                    <?php foreach ($kompetensi_items as $index => $item): ?>
                        <div class="carousel-item <?php echo $index === 0 ? 'active' : ''; ?>">
                            <div class="program-slide-card">
                                <div class="row g-0 align-items-center">
                                    <div class="col-lg-6">
                                        <?php if (!empty($item['image'])): ?>
                                            <div class="program-slide-image">
                                                <img src="<?php echo esc_url($item['image']); ?>" alt="<?php echo esc_attr($item['title']); ?>" loading="lazy">
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="program-slide-content">
                                            <div class="program-number"><?php echo esc_html(sprintf('%02d', $index + 1)); ?></div>
                                            <?php if (!empty($item['title'])): ?>
                                                <h3 class="program-slide-title"><?php echo esc_html($item['title']); ?></h3>
                                            <?php endif; ?>
                                            <?php if (!empty($item['text'])): ?>
                                                <p class="program-slide-text"><?php echo esc_html($item['text']); ?></p>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
                <button class="carousel-control-prev" type="button" data-bs-target="#programCarousel" data-bs-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="visually-hidden"><?php esc_html_e('Previous', 'badewatheme'); ?></span>
                </button>
                <button class="carousel-control-next" type="button" data-bs-target="#programCarousel" data-bs-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="visually-hidden"><?php esc_html_e('Next', 'badewatheme'); ?></span>
                </button>
            </div>
        </div>
    </section>

    <section id="keunggulan" class="section-pad section-accent">
        <div class="container">
            <div class="section-header">
                <p class="section-kicker"><?php echo esc_html(get_theme_mod('smk_keunggulan_kicker', 'Mengapa Kami')); ?></p>
                <h2><?php echo esc_html(get_theme_mod('smk_keunggulan_title', 'Keunggulan SMK Kesehatan Bali Dewata')); ?></h2>
                <p><?php echo esc_html(get_theme_mod('smk_keunggulan_intro', 'Lingkungan belajar yang formal, profesional, dan adaptif dengan kebutuhan dunia kesehatan.')); ?></p>
            </div>
            <?php
            $keunggulan_count = absint(get_theme_mod('smk_keunggulan_count', 4));
            if ($keunggulan_count < 1) $keunggulan_count = 1;
            if ($keunggulan_count > 8) $keunggulan_count = 8;

            $default_keunggulan_images = [
                1 => 'https://images.unsplash.com/photo-1454165804606-c3d57bc86b40?auto=format&fit=crop&w=600&q=80',
                2 => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1d?auto=format&fit=crop&w=600&q=80',
                3 => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?auto=format&fit=crop&w=600&q=80',
                4 => 'https://images.unsplash.com/photo-1522071820081-009f0129c71c?auto=format&fit=crop&w=600&q=80',
                5 => 'https://images.unsplash.com/photo-1552664730-d307ca884978?auto=format&fit=crop&w=600&q=80',
                6 => 'https://images.unsplash.com/photo-1523240795612-9a054b0db644?auto=format&fit=crop&w=600&q=80',
                7 => 'https://images.unsplash.com/photo-1556761175-4b46a572b786?auto=format&fit=crop&w=600&q=80',
                8 => 'https://images.unsplash.com/photo-1521737711867-e3b97375f902?auto=format&fit=crop&w=600&q=80',
            ];
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

            // Determine column class based on count
            $col_class = 'col-md-6 col-lg-3'; // Default for 4 items
            if ($keunggulan_count <= 2) {
                $col_class = 'col-md-6';
            } elseif ($keunggulan_count == 3) {
                $col_class = 'col-md-6 col-lg-4';
            } elseif ($keunggulan_count >= 5 && $keunggulan_count <= 6) {
                $col_class = 'col-md-6 col-lg-4';
            } elseif ($keunggulan_count >= 7) {
                $col_class = 'col-md-6 col-lg-3';
            }
            ?>
            <div class="row g-4">
                <?php for ($i = 1; $i <= $keunggulan_count; $i++): ?>
                    <div class="<?php echo esc_attr($col_class); ?>">
                        <div class="feature-card h-100">
                            <?php
                            $keunggulan_image = get_theme_mod("smk_keunggulan_image_{$i}", isset($default_keunggulan_images[$i]) ? $default_keunggulan_images[$i] : '');
                            ?>
                            <?php if ($keunggulan_image): ?>
                                <div class="feature-image">
                                    <img src="<?php echo esc_url($keunggulan_image); ?>" alt="<?php echo esc_attr(get_theme_mod("smk_keunggulan_title_{$i}", isset($default_keunggulan_titles[$i]) ? $default_keunggulan_titles[$i] : '')); ?>" loading="lazy">
                                </div>
                            <?php endif; ?>
                            <div class="feature-content">
                                <span class="feature-number"><?php echo esc_html(sprintf('%02d', $i)); ?></span>
                                <h3><?php echo esc_html(get_theme_mod("smk_keunggulan_title_{$i}", isset($default_keunggulan_titles[$i]) ? $default_keunggulan_titles[$i] : '')); ?></h3>
                                <p><?php echo esc_html(get_theme_mod("smk_keunggulan_text_{$i}", isset($default_keunggulan_texts[$i]) ? $default_keunggulan_texts[$i] : '')); ?></p>
                            </div>
                        </div>
                    </div>
                <?php endfor; ?>
            </div>
        </div>
    </section>

    <section id="blog" class="section-pad">
        <div class="container">
            <div class="section-header">
                <p class="section-kicker">Informasi Sekolah</p>
                <h2>Info Terbaru</h2>
                <p>Ikuti berita, kegiatan, dan prestasi terbaru dari SMK Kesehatan Bali Dewata.</p>
            </div>
            <div class="row g-4">
                <?php
                $latest_posts = new WP_Query([
                    'posts_per_page' => 5,
                    'post_status' => 'publish',
                ]);
                if ($latest_posts->have_posts()):
                    while ($latest_posts->have_posts()):
                        $latest_posts->the_post();
                        ?>
                        <div class="col-md-6 col-lg-4">
                            <article class="card blog-card h-100">
                                <?php if (has_post_thumbnail()): ?>
                                    <a href="<?php the_permalink(); ?>" class="blog-card-image-link">
                                        <?php the_post_thumbnail('medium', ['class' => 'card-img-top blog-card-image']); ?>
                                    </a>
                                <?php else:
                                    $default_image = get_theme_mod('smk_blog_default_image', '');
                                    if ($default_image): ?>
                                        <a href="<?php the_permalink(); ?>" class="blog-card-image-link">
                                            <img src="<?php echo esc_url($default_image); ?>" class="card-img-top blog-card-image" alt="<?php the_title_attribute(); ?>">
                                        </a>
                                    <?php endif;
                                endif; ?>
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
                else:
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

                // Animate children elements
                if (entry.target.classList.contains('row')) {
                    const children = entry.target.querySelectorAll('.col-md-6, .col-lg-3, .col-lg-4, .col-lg-6');
                    children.forEach(child => {
                        const card = child.querySelector('.feature-card, .blog-card');
                        if (card) {
                            card.classList.add('animate-in');
                        }
                    });
                }

                observer.unobserve(entry.target);
            }
        });
    }, observerOptions);

    // Observe elements
    const sambutanContent = document.querySelector('.sambutan-content');
    const sambutanImage = document.querySelector('.sambutan-image');
    const sectionHeaders = document.querySelectorAll('.section-header');
    const programCarousel = document.querySelector('.program-carousel');
    const featureRows = document.querySelectorAll('#keunggulan .row, #blog .row');

    if (sambutanContent) observer.observe(sambutanContent);
    if (sambutanImage) observer.observe(sambutanImage);
    if (programCarousel) observer.observe(programCarousel);

    sectionHeaders.forEach(header => observer.observe(header));
    featureRows.forEach(row => observer.observe(row));
});
</script>

<?php
get_footer();
