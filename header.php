<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
<header class="site-header">
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container">
            <a class="navbar-brand" href="<?php echo esc_url(home_url('/')); ?>">
                <?php if (has_custom_logo()) : ?>
                    <span class="navbar-logo"><?php the_custom_logo(); ?></span>
                <?php endif; ?>
                <span class="navbar-title"><?php bloginfo('name'); ?></span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#primaryNavbar" aria-controls="primaryNavbar" aria-expanded="false" aria-label="<?php esc_attr_e('Toggle navigation', 'smkkesehatan'); ?>">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="primaryNavbar">
                <?php
                $locations = get_nav_menu_locations();
                $primary_menu_id = $locations['primary'] ?? 0;
                if (!$primary_menu_id) {
                    $menus = wp_get_nav_menus();
                    if (!empty($menus)) {
                        $primary_menu_id = $menus[0]->term_id;
                    }
                }

                wp_nav_menu([
                    'theme_location' => 'primary',
                    'menu' => $primary_menu_id ?: null,
                    'container' => false,
                    'menu_class' => 'navbar-nav ms-auto align-items-lg-center',
                    'fallback_cb' => 'wp_page_menu',
                    'depth' => 2,
                ]);
                ?>
            </div>
        </div>
    </nav>
</header>
