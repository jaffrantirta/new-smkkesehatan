<?php
$footer_about = get_theme_mod('smk_footer_about', 'Sekolah vokasi kesehatan yang berfokus pada pendidikan profesional, berintegritas, dan siap kerja.');
$footer_contact = get_theme_mod('smk_footer_contact', "Jl. Raya Pendidikan No. 10, Denpasar, Bali\nTelp: (0361) 123-456\nEmail: info@badewathemebd.sch.id");
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

<?php
// Floating WhatsApp Button
$floating_whatsapp_enable = get_theme_mod('smk_floating_whatsapp_enable', true);
if ($floating_whatsapp_enable):
    $floating_whatsapp_number = get_theme_mod('smk_floating_whatsapp_number', '+6281234567890');
    $floating_whatsapp_message = get_theme_mod('smk_floating_whatsapp_message', 'Hello! I would like to get more information.');
    $floating_whatsapp_position = get_theme_mod('smk_floating_whatsapp_position', 'right');

    // Clean phone number
    $clean_number = str_replace([' ', '-', '(', ')'], '', $floating_whatsapp_number);
    $whatsapp_url = 'https://wa.me/' . $clean_number . '?text=' . urlencode($floating_whatsapp_message);
    ?>
    <a href="<?php echo esc_url($whatsapp_url); ?>"
       class="floating-whatsapp floating-whatsapp-<?php echo esc_attr($floating_whatsapp_position); ?>"
       target="_blank"
       rel="noopener noreferrer"
       aria-label="Chat on WhatsApp">
        <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
            <path d="M16 0C7.164 0 0 7.164 0 16C0 18.844 0.812 21.5 2.216 23.788L0.688 30.312L7.416 28.812C9.62 30.112 12.22 30.84 16 30.84C24.836 30.84 32 23.676 32 14.84C32 6.004 24.836 0 16 0ZM16 2.4C23.528 2.4 29.6 8.472 29.6 16C29.6 23.528 23.528 29.6 16 29.6C12.844 29.6 9.98 28.612 7.684 26.912L7.408 26.724L3.788 27.612L4.708 24.1L4.492 23.8C2.668 21.42 1.6 18.444 1.6 16C1.6 8.472 7.672 2.4 16 2.4ZM10.932 8.8C10.692 8.8 10.276 8.892 9.932 9.26C9.588 9.628 8.6 10.556 8.6 12.444C8.6 14.332 9.964 16.156 10.156 16.412C10.348 16.668 12.836 20.668 16.708 22.268C19.924 23.628 20.58 23.372 21.276 23.308C21.972 23.244 23.556 22.38 23.9 21.484C24.244 20.588 24.244 19.82 24.148 19.66C24.052 19.5 23.796 19.404 23.42 19.212C23.044 19.02 21.156 18.092 20.812 17.964C20.468 17.836 20.212 17.772 19.956 18.148C19.7 18.524 19.004 19.404 18.78 19.66C18.556 19.916 18.332 19.948 17.956 19.756C17.58 19.564 16.372 19.164 14.932 17.884C13.804 16.892 13.052 15.66 12.828 15.284C12.604 14.908 12.804 14.7 12.996 14.508C13.172 14.332 13.372 14.06 13.564 13.836C13.756 13.612 13.82 13.452 13.948 13.196C14.076 12.94 14.012 12.716 13.916 12.524C13.82 12.332 13.084 10.428 12.772 9.676C12.46 8.924 12.148 9.036 11.924 9.02C11.7 9.004 11.444 9 11.188 9C10.932 9 10.556 9.1 10.212 9.476C9.868 9.852 8.94 10.78 8.94 12.668C8.94 14.556 10.244 16.38 10.436 16.636C10.628 16.892 13.052 20.508 16.708 22.268C19.924 23.628 20.58 23.372 21.276 23.308C21.972 23.244 23.556 22.38 23.9 21.484C24.244 20.588 24.244 19.82 24.148 19.66C24.052 19.5 23.796 19.404 23.42 19.212C23.044 19.02 21.156 18.092 20.812 17.964C20.468 17.836 20.212 17.772 19.956 18.148C19.7 18.524 19.004 19.404 18.78 19.66C18.556 19.916 18.332 19.948 17.956 19.756C17.58 19.564 16.372 19.164 14.932 17.884C13.804 16.892 13.052 15.66 12.828 15.284C12.604 14.908 12.804 14.7 12.996 14.508C13.172 14.332 13.372 14.06 13.564 13.836C13.756 13.612 13.82 13.452 13.948 13.196C14.076 12.94 14.012 12.716 13.916 12.524C13.82 12.332 13.084 10.428 12.772 9.676C12.46 8.924 12.148 9.036 11.924 9.02L10.932 8.8Z" fill="white"/>
        </svg>
    </a>
<?php endif; ?>

<?php wp_footer(); ?>
</body>
</html>
