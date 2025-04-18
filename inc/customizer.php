<?php
function advancedcare_customize_register($wp_customize) {

    // === GENERAL SETTINGS ===
    $wp_customize->add_section('advancedcare_general_settings', [
        'title'    => __('General Settings', 'advancedcare'),
        'priority' => 30,
    ]);

    // Header Logo
    $wp_customize->add_setting('advancedcare_header_logo', [
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'advancedcare_header_logo', [
        'label'    => __('Header Logo', 'advancedcare'),
        'section'  => 'advancedcare_general_settings',
    ]));

    // Footer Logo
    $wp_customize->add_setting('advancedcare_footer_logo', [
        'sanitize_callback' => 'esc_url_raw',
    ]);
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'advancedcare_footer_logo', [
        'label'    => __('Footer Logo', 'advancedcare'),
        'section'  => 'advancedcare_general_settings',
    ]));

    // Font choices
    $fonts = [
        'Arial, sans-serif' => 'Arial',
        'Georgia, serif' => 'Georgia',
        'Helvetica, sans-serif' => 'Helvetica',
        'Times New Roman, serif' => 'Times New Roman',
        'Verdana, sans-serif' => 'Verdana',
    ];

    $wp_customize->add_setting('advancedcare_font_family', [
        'default' => 'Roboto, sans-serif',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('advancedcare_font_family', [
        'label'   => __('Body Font Family', 'advancedcare'),
        'section' => 'advancedcare_general_settings',
        'type'    => 'select',
        'choices' => $fonts,
    ]);

    $wp_customize->add_setting('advancedcare_heading_font_family', [
        'default' => 'Arial, sans-serif',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('advancedcare_heading_font_family', [
        'label'   => __('Heading Font Family', 'advancedcare'),
        'section' => 'advancedcare_general_settings',
        'type'    => 'select',
        'choices' => $fonts,
    ]);

    $wp_customize->add_setting('advancedcare_font_weight', [
        'default' => '400',
        'sanitize_callback' => 'absint',
    ]);
    $wp_customize->add_control('advancedcare_font_weight', [
        'label'   => __('Body Font Weight', 'advancedcare'),
        'section' => 'advancedcare_general_settings',
        'type'    => 'number',
    ]);

    $wp_customize->add_setting('advancedcare_heading_font_weight', [
        'default' => '700',
        'sanitize_callback' => 'absint',
    ]);
    $wp_customize->add_control('advancedcare_heading_font_weight', [
        'label'   => __('Heading Font Weight', 'advancedcare'),
        'section' => 'advancedcare_general_settings',
        'type'    => 'number',
    ]);

    $wp_customize->add_setting('advancedcare_layout_width', [
        'default' => '1100px',
        'sanitize_callback' => 'sanitize_text_field',
    ]);
    $wp_customize->add_control('advancedcare_layout_width', [
        'label' => __('Max Content Width (alignwide)', 'advancedcare'),
        'section' => 'advancedcare_general_settings',
        'type' => 'text',
        'description' => __('E.g., 960px or 90%', 'advancedcare'),
    ]);

    // Dark Mode Toggle (✨ Optional Feature ✨)
    $wp_customize->add_setting('advancedcare_dark_mode', [
        'default' => false,
        'sanitize_callback' => 'rest_sanitize_boolean',
    ]);
    $wp_customize->add_control('advancedcare_dark_mode', [
        'label' => __('Enable Dark Mode', 'advancedcare'),
        'section' => 'advancedcare_general_settings',
        'type' => 'checkbox',
    ]);


    // === COLOR SETTINGS ===
    $wp_customize->add_section('advancedcare_color_settings', [
        'title'    => __('Color Settings', 'advancedcare'),
        'priority' => 35,
    ]);

    $colors = [
        'advancedcare_header_bg' => ['#282b35', __('Header Background Color', 'advancedcare')],
        'advancedcare_header_font_color' => ['#ffffff', __('Header Font Color', 'advancedcare')],
        'advancedcare_footer_bg' => ['#282b35', __('Footer Background Color', 'advancedcare')],
        'advancedcare_link_hover_color' => ['#03678e', __('Link Hover Color', 'advancedcare')],
        'advancedcare_body_bg_color' => ['#ffffff', __('Body Background Color', 'advancedcare')],
    ];

    foreach ($colors as $id => [$default, $label]) {
        $wp_customize->add_setting($id, [
            'default'           => $default,
            'sanitize_callback' => 'sanitize_hex_color',
        ]);
        $wp_customize->add_control(new WP_Customize_Color_Control($wp_customize, $id, [
            'label'   => $label,
            'section' => 'advancedcare_color_settings',
        ]));
    }


    // === ACCESSIBILITY SETTINGS ===
    $wp_customize->add_section('advancedcare_accessibility', [
        'title' => __('Accessibility Settings', 'advancedcare'),
        'priority' => 40,
    ]);

    $wp_customize->add_setting('advancedcare_font_scale', [
        'default' => '1',
        'sanitize_callback' => 'floatval',
    ]);
    $wp_customize->add_control('advancedcare_font_scale', [
        'label' => __('Font Size Scale Multiplier', 'advancedcare'),
        'section' => 'advancedcare_accessibility',
        'type' => 'number',
        'input_attrs' => [
            'step' => 0.1,
            'min' => 0.8,
            'max' => 2.0,
        ],
        'description' => __('1 = default size, 1.2 = 20% larger fonts.', 'advancedcare'),
    ]);

    $wp_customize->add_setting('advancedcare_reduce_motion', [
        'default' => false,
        'sanitize_callback' => 'rest_sanitize_boolean',
    ]);
    $wp_customize->add_control('advancedcare_reduce_motion', [
        'label' => __('Reduce Motion / Disable Animations', 'advancedcare'),
        'section' => 'advancedcare_accessibility',
        'type' => 'checkbox',
    ]);
}
add_action('customize_register', 'advancedcare_customize_register');


/**
 * Output the Customizer styles in the <head>
 */
function advancedcare_customizer_styles() {
?>
<style type="text/css">
    :root {
        font-size: calc(1rem * <?php echo esc_attr(get_theme_mod('advancedcare_font_scale', 1)); ?>);
    }
    body {
        background-color: <?php echo esc_attr(get_theme_mod('advancedcare_body_bg_color', '#ffffff')); ?>;
        font-family: <?php echo esc_attr(get_theme_mod('advancedcare_font_family', 'Roboto, sans-serif')); ?>;
        font-weight: <?php echo esc_attr(get_theme_mod('advancedcare_font_weight', 400)); ?>;
    }
    h1, h2, h3, h4, h5, h6 {
        font-family: <?php echo esc_attr(get_theme_mod('advancedcare_heading_font_family', 'Arial, sans-serif')); ?>;
        font-weight: <?php echo esc_attr(get_theme_mod('advancedcare_heading_font_weight', 700)); ?>;
    }
    .site-header {
        background-color: <?php echo esc_attr(get_theme_mod('advancedcare_header_bg', '#282b35')); ?>;
        color: <?php echo esc_attr(get_theme_mod('advancedcare_header_font_color', '#ffffff')); ?>;
    }
    .site-footer {
        background-color: <?php echo esc_attr(get_theme_mod('advancedcare_footer_bg', '#282b35')); ?>;
    }
    a:hover {
        color: <?php echo esc_attr(get_theme_mod('advancedcare_link_hover_color', '#03678e')); ?>;
    }
    .o-container {
        max-width: <?php echo esc_attr(get_theme_mod('advancedcare_layout_width', '1100px')); ?>;
    }
    <?php if (get_theme_mod('advancedcare_reduce_motion')) : ?>
    html {
        scroll-behavior: auto !important;
    }
    *, *::before, *::after {
        animation: none !important;
        transition: none !important;
    }
    <?php endif; ?>

    <?php if (get_theme_mod('advancedcare_dark_mode')) : ?>
    body { background: #121212; color: #e0e0e0; }
    .site-header, .site-footer { background: #1f1f1f; }
    a { color: #bb86fc; }
    a:hover { color: #3700b3; }
    <?php endif; ?>
</style>
<?php
}
add_action('wp_head', 'advancedcare_customizer_styles');
