<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="view-transition" content="same-origin">
    <?php wp_head(); ?>
</head>
<header class="container">
    <?php
        $side_logo = get_theme_mod('theme_side_logo');
        if (!empty($side_logo)): ?>
            <div class="side-logo">
                <img src="<?php echo esc_url($side_logo); ?>" alt="Side Logo">
            </div>
        <?php endif; ?>
        <nav class="header-navigation">
            <?php wp_nav_menu( array( 'primary-menu' => 'heder-rt' ) ); ?>
        </nav>
</header>

<body>
