<?php
$location_title = get_theme_mod('smk_sidebar_location_title', 'Lokasi Kami');
$map_url = get_theme_mod('smk_sidebar_map_url', '');
$contact_title = get_theme_mod('smk_sidebar_contact_title', 'Hubungi Kami');
$phone = get_theme_mod('smk_sidebar_phone', '');
$email = get_theme_mod('smk_sidebar_email', '');
$facebook = get_theme_mod('smk_sidebar_facebook', '');
$instagram = get_theme_mod('smk_sidebar_instagram', '');
$button_text = get_theme_mod('smk_sidebar_button_text', 'Kirim Pesan');
$button_url = get_theme_mod('smk_sidebar_button_url', '#');
?>

<aside class="sidebar">
    <div class="sidebar-card">
        <h3><?php echo esc_html($location_title); ?></h3>
        <div class="sidebar-divider"></div>
        <?php if (!empty($map_url)) : ?>
            <div class="map-embed">
                <iframe
                    src="<?php echo esc_url($map_url); ?>"
                    width="100%"
                    height="200"
                    style="border:0;"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        <?php else : ?>
            <p class="sidebar-muted">Tambahkan URL embed peta di Customizer.</p>
        <?php endif; ?>
    </div>

    <div class="sidebar-card">
        <h3><?php echo esc_html($contact_title); ?></h3>
        <div class="sidebar-divider"></div>
        <div class="sidebar-list">
            <?php if (!empty($phone)) : ?>
                <div class="sidebar-item">
                    <span class="sidebar-label">No.Telp / Fax :</span>
                    <span class="sidebar-value"><?php echo nl2br(esc_html($phone)); ?></span>
                </div>
            <?php endif; ?>
            <?php if (!empty($email)) : ?>
                <div class="sidebar-item">
                    <span class="sidebar-label">Email :</span>
                    <span class="sidebar-value"><?php echo nl2br(esc_html($email)); ?></span>
                </div>
            <?php endif; ?>
            <?php if (!empty($facebook)) : ?>
                <div class="sidebar-item">
                    <span class="sidebar-label">Facebook :</span>
                    <span class="sidebar-value"><?php echo esc_html($facebook); ?></span>
                </div>
            <?php endif; ?>
            <?php if (!empty($instagram)) : ?>
                <div class="sidebar-item">
                    <span class="sidebar-label">Instagram :</span>
                    <span class="sidebar-value"><?php echo esc_html($instagram); ?></span>
                </div>
            <?php endif; ?>
        </div>
        <?php if (!empty($button_text)) : ?>
            <a class="btn btn-outline-primary sidebar-button" href="<?php echo esc_url($button_url); ?>">
                <?php echo esc_html($button_text); ?>
            </a>
        <?php endif; ?>
    </div>
</aside>
