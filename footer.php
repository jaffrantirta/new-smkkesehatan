<?php
$footer_about = get_theme_mod('smk_footer_about', 'Sekolah vokasi kesehatan yang berfokus pada pendidikan profesional, berintegritas, dan siap kerja.');
$footer_contact = get_theme_mod('smk_footer_contact', "Jl. Raya Pendidikan No. 10, Denpasar, Bali\nTelp: (0361) 123-456\nEmail: info@smkkesehatanbd.sch.id");
$footer_links_title = get_theme_mod('smk_footer_links_title', 'Tautan Cepat');
$footer_links_raw = get_theme_mod('smk_footer_links', "Kompetensi Keahlian|#kompetensi\nKeunggulan|#keunggulan\nLatest Blog|#blog");
$footer_links = preg_split('/\r\n|\r|\n/', (string) $footer_links_raw);
?>

<footer class="site-footer">
    <div class="container">
        <div class="row g-4">
            <div class="col-md-6 col-lg-4">
                <div class="footer-brand">
                    <?php if (has_custom_logo()) : ?>
                        <div class="footer-logo"><?php the_custom_logo(); ?></div>
                    <?php endif; ?>
                    <h3><?php bloginfo('name'); ?></h3>
                </div>
                <p><?php echo esc_html($footer_about); ?></p>
            </div>
            <div class="col-md-6 col-lg-4">
                <h4>Kontak</h4>
                <ul class="footer-list">
                    <?php
                    $contact_lines = preg_split('/\r\n|\r|\n/', (string) $footer_contact);
                    foreach ($contact_lines as $line) :
                        $line = trim($line);
                        if ($line === '') {
                            continue;
                        }
                        ?>
                        <li><?php echo esc_html($line); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="col-md-6 col-lg-4">
                <h4><?php echo esc_html($footer_links_title); ?></h4>
                <ul class="footer-list">
                    <?php foreach ($footer_links as $link) :
                        $link = trim($link);
                        if ($link === '') {
                            continue;
                        }
                        $parts = array_map('trim', explode('|', $link));
                        $label = $parts[0] ?? '';
                        $url = $parts[1] ?? '#';
                        if ($label === '') {
                            continue;
                        }
                        ?>
                        <li><a href="<?php echo esc_url($url); ?>"><?php echo esc_html($label); ?></a></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; <?php echo esc_html(date_i18n('Y')); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>
</html>
