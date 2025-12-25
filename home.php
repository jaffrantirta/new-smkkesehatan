<?php
get_header();

$paged = max(1, get_query_var('paged'));
$news_query = new WP_Query([
    'post_status' => 'publish',
    'category_name' => 'berita',
    'paged' => $paged,
]);
?>

<main class="section-pad">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">
                <header class="section-header">
                    <p class="section-kicker">Blog Sekolah</p>
                    <h1>Berita</h1>
                    <p>Informasi terbaru, kegiatan, dan prestasi dari SMK Kesehatan Bali Dewata.</p>
                </header>

                <?php if ($news_query->have_posts()) : ?>
                    <div class="row g-4">
                        <?php while ($news_query->have_posts()) : $news_query->the_post(); ?>
                            <div class="col-md-6">
                                <article class="card blog-card h-100">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <?php the_post_thumbnail('medium_large', ['class' => 'card-img-top']); ?>
                                    <?php else : ?>
                                        <div class="blog-thumb-placeholder"></div>
                                    <?php endif; ?>
                                    <div class="card-body">
                                        <p class="card-kicker"><?php echo esc_html(get_the_date()); ?></p>
                                        <h2 class="card-title">
                                            <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                                        </h2>
                                        <p class="card-text"><?php echo esc_html(wp_trim_words(get_the_excerpt(), 18)); ?></p>
                                    </div>
                                    <div class="card-footer">
                                        <a class="btn btn-link" href="<?php the_permalink(); ?>">Baca selengkapnya</a>
                                    </div>
                                </article>
                            </div>
                        <?php endwhile; ?>
                    </div>

                    <div class="mt-5">
                        <?php
                        echo paginate_links([
                            'total' => $news_query->max_num_pages,
                            'current' => $paged,
                            'prev_text' => __('Sebelumnya', 'smkkesehatan'),
                            'next_text' => __('Berikutnya', 'smkkesehatan'),
                        ]);
                        ?>
                    </div>
                <?php else : ?>
                    <div class="empty-state">
                        <h2>Belum ada artikel</h2>
                        <p>Konten berita akan segera diperbarui.</p>
                    </div>
                <?php endif; ?>
            </div>
            <div class="col-lg-4">
                <?php get_sidebar(); ?>
            </div>
        </div>
    </div>
</main>

<?php
wp_reset_postdata();
get_footer();
