<?php

function theme_register_menus() {
    register_nav_menus( array(
        'primary-menu' => __( 'Header', 'heder-rt' ),
        'footer-top' => __( 'Footer Top', 'ft-rt' ),
        'footer-bottom' => __( 'Footer Bottom', 'fb-rt' ),
    ) );
}
add_action( 'after_setup_theme', 'theme_register_menus' );


// ==================== Adding Component Function =============================
function is_using_component($component_name) {
    global $template;
    $template_content = file_get_contents($template);
    return strpos($template_content, "get_template_part( 'components/$component_name'" ) !== false;
}

// ================= Adding Style and Script ========================================

function my_custom_theme_scripts() {
    // wp_enqueue_script('tab-js', get_template_directory_uri() . '/src/dist/tab.min.js', [], null, true);
    wp_enqueue_style( 'main-style', get_template_directory_uri() . '/style.css' );
}
add_action('wp_enqueue_scripts', 'my_custom_theme_scripts');

// =========== changing the default "Template-Part Dir" to "Page Dir" ==============
add_filter('theme_page_templates', 'page_tem_kbp');

function page_tem_kbp($page_templates) {
    $custom_templates = array();
    $template_dir = get_template_directory() . 'pages/';
    
    if (is_dir($template_dir)) {
        $files = scandir($template_dir);
        foreach ($files as $file) {
            if (is_file($template_dir . $file) && pathinfo($file, PATHINFO_EXTENSION) == 'php') {
                $template_data = get_file_data($template_dir . $file, array('Template Name' => 'Template Name'));
                if (!empty($template_data['Template Name'])) {
                    $custom_templates['pages/' . $file] = $template_data['Template Name'];
                }
            }
        }
    }
    
    return array_merge($page_templates, $custom_templates);
}

// ====================== Desabling Gutenbug Editor ==============================

// Disable Gutenberg on the back end.
add_filter( 'use_block_editor_for_post', '__return_false' );

// Disable Gutenberg for widgets.
add_filter( 'use_widgets_block_editor', '__return_false' );

add_action( 'wp_enqueue_scripts', function() {
    // Remove CSS on the front end.
    wp_dequeue_style( 'wp-block-library' );

    // Remove Gutenberg theme.
    wp_dequeue_style( 'wp-block-library-theme' );

    // Remove inline global CSS on the front end.
    wp_dequeue_style( 'global-styles' );

    // Remove classic-themes CSS for backwards compatibility for button blocks.
    wp_dequeue_style( 'classic-theme-styles' );
}, 20 );

// ======= Supporting File formoates =======
function allow_custom_mime_types($mimes) {
    $mimes = array_merge($mimes, [
        'svg'  => 'image/svg+xml',
        // 'mp4'  => 'video/mp4',
        // 'webp' => 'image/webp',
        // 'ogg'  => 'audio/ogg',
        // 'wav'  => 'audio/wav',
        // 'webm' => 'video/webm',
        // 'json' => 'application/json',
        // 'zip'  => 'application/zip',
        // 'rar'  => 'application/x-rar-compressed',
        // '7z'   => 'application/x-7z-compressed',
    ]);
    
    return $mimes;
}
add_filter('upload_mimes', 'allow_custom_mime_types');


// ================= Adding Site Logo Support to the Theme Coustomizer =============================

function theme_customize_register($wp_customize) {
    // Add a section for the Side Logo
    $wp_customize->add_section('theme_side_logo_section', [
        'title'       => __('Side Logo', ''),
        'priority'    => 30,
        'description' => __('Upload a logo to display on the side.', ''),
    ]);

    // Add setting for Side Logo
    $wp_customize->add_setting('theme_side_logo', [
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ]);

    // Add control for Side Logo
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'theme_side_logo', [
        'label'    => __('Upload Side Logo', ''),
        'section'  => 'theme_side_logo_section',
        'settings' => 'theme_side_logo',
    ]));
}
add_action('customize_register', 'theme_customize_register');

// ================ Optmization for Code  ===============

function custom_dequeue_unnecessary_assets() {
    if ( is_admin() || current_user_can( 'manage_options' ) ) {
        return;
    }

    $scripts_to_remove = [
        'jquery-migrate',
        'jquery-ui-core',
        'jquery-ui-mouse',
        'jquery-ui-sortable',
        'jquery-ui-resizable',
        'wp-dom-ready',
        'wp-i18n',
        'wp-a11y',
        'acf-input',
        'acf-pro-ui-options-page',
        'select2',
        'jquery-ui-datepicker',
        'acf-timepicker',
        'jquery-ui-draggable',
        'jquery-ui-slider',
        'jquery-touch-punch',
        'iris',
        'wp-color-picker',
        'acf-color-picker-alpha',
    ];

    $styles_to_remove = [
        'dashicons',
        'wp-emoji-styles',
        'acf-global',
        'acf-input',
        'acf-pro-input',
        'select2',
        'acf-datepicker',
        'acf-timepicker',
        'wp-color-picker',
    ];

    foreach ( $scripts_to_remove as $script ) {
        wp_dequeue_script( $script );
        wp_deregister_script( $script );
    }

    foreach ( $styles_to_remove as $style ) {
        wp_dequeue_style( $style );
        wp_deregister_style( $style );
    }
}
add_action( 'wp_enqueue_scripts', 'custom_dequeue_unnecessary_assets', 999 );

