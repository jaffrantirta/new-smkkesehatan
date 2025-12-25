<?php
get_header();
?>

<main class="section-pad">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">
                <header class="section-header">
                    <p class="section-kicker">Kategori</p>
                    <h1><?php single_cat_title(); ?></h1>
                    <?php if (category_description()) : ?>
                        <p><?php echo esc_html(wp_strip_all_tags(category_description())); ?></p>
                    <?php endif; ?>
                </header>

                <?php if (have_posts()) : ?>
                    <div class="row g-4">
                        <?php while (have_posts()) : the_post(); ?>
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
                        the_posts_pagination([
                            'mid_size' => 1,
                            'prev_text' => __('Sebelumnya', 'smkkesehatan'),
                            'next_text' => __('Berikutnya', 'smkkesehatan'),
                        ]);
                        ?>
                    </div>
                <?php else : ?>
                    <div class="empty-state">
                        <h2>Belum ada artikel</h2>
                        <p>Konten kategori ini akan segera diperbarui.</p>
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
get_footer();
