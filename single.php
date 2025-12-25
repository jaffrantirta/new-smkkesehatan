<?php
get_header();
?>

<main class="section-pad">
    <div class="container">
        <div class="row g-5">
            <div class="col-lg-8">
                <?php if (have_posts()) : ?>
                    <?php while (have_posts()) : the_post(); ?>
                        <article class="single-post">
                            <header class="section-header">
                                <p class="section-kicker">Artikel</p>
                                <h1><?php the_title(); ?></h1>
                                <p class="post-meta">
                                    <?php echo esc_html(get_the_date()); ?>
                                    <span class="meta-sep">•</span>
                                    <?php echo esc_html(get_the_author()); ?>
                                </p>
                            </header>

                            <?php if (has_post_thumbnail()) : ?>
                                <div class="page-hero-image mb-4">
                                    <?php the_post_thumbnail('large', ['class' => 'img-fluid rounded-4']); ?>
                                </div>
                            <?php endif; ?>

                            <div class="content-body">
                                <?php the_content(); ?>
                            </div>
                        </article>
                    <?php endwhile; ?>
                <?php else : ?>
                    <div class="empty-state">
                        <h2>Artikel tidak ditemukan</h2>
                        <p>Konten ini belum tersedia.</p>
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
