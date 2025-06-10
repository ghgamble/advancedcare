<?php
// Theme Support
function advancedcare_theme_setup() {
    add_theme_support('title-tag');
    add_theme_support('custom-logo');
    add_theme_support('post-thumbnails');
    add_theme_support('align-wide');
    register_nav_menus([
        'primary' => __('Primary Menu', 'advancedcare'),
    ]);
}
add_action('after_setup_theme', 'advancedcare_theme_setup');

// Enqueue Styles and Scripts
function advancedcare_scripts() {
    wp_enqueue_style('advancedcare-style', get_template_directory_uri() . '/dist/style.min.css', array(), '1.0');
    wp_enqueue_script('advancedcare-js', get_template_directory_uri() . '/dist/main.min.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'advancedcare_scripts');

// Enqueue Google Fonts and apply to frontend
function advancedcare_enqueue_google_fonts() {
    wp_enqueue_style(
        'google-fonts',
        'https://fonts.googleapis.com/css2?family=Barlow:wght@400;600;700&family=Barlow+Condensed:wght@400;600;700&family=Cormorant+Garamond:wght@400;500;700&family=Crimson+Pro:wght@400;600;700&family=Domine:wght@400;700&family=Nunito+Sans:wght@300;400;600;700&family=IBM+Plex+Sans+Condensed:wght@300;400;600;700&family=PT+Sans:wght@400;700&family=Quicksand:wght@300;400;600;700&family=Fira+Sans+Condensed:wght@300;400;500;600;700&family=Fraunces:wght@400;500;700&family=Poppins:wght@300;400;600;700&display=swap',
        false
    );

    $body_font = "'Nunito Sans', sans-serif";
    $heading_font = "'Cormorant Garamond', serif";
    $body_weight = get_theme_mod('advancedcare_font_weight', '400');
    $heading_weight = get_theme_mod('advancedcare_heading_font_weight', '700');

    $custom_css = "
        body, p, li, a, .img-label, .wp-block-button__link.wp-element-button {
            font-family: {$body_font};
            font-weight: {$body_weight};
        }

        .site-main span,
        .site-main p,
        .site-main li,
        .site-main a,
        .site-main .img-label,
        .site-main .wp-block-button__link.wp-element-button {
            font-family: {$body_font};
            font-weight: {$body_weight};
        }

        h1, h2, h3, h4, h5, h6 {
            font-family: {$heading_font};
            font-weight: {$heading_weight};
        }

        .wp-block {
            font-family: {$body_font};
        }

        .wp-block-heading {
            font-family: {$heading_font};
        }
    ";
    wp_add_inline_style('advancedcare-style', $custom_css);
}
add_action('wp_enqueue_scripts', 'advancedcare_enqueue_google_fonts');

// Apply fonts in Gutenberg block editor
function advancedcare_editor_fonts() {
    wp_enqueue_style(
        'google-fonts-editor',
        'https://fonts.googleapis.com/css2?family=Barlow:wght@400;600;700&family=Barlow+Condensed:wght@400;600;700&family=Cormorant+Garamond:wght@400;500;700&family=Crimson+Pro:wght@400;600;700&family=Domine:wght@400;700&family=Nunito+Sans:wght@300;400;600;700&family=IBM+Plex+Sans+Condensed:wght@300;400;600;700&family=PT+Sans:wght@400;700&family=Quicksand:wght@300;400;600;700&family=Fira+Sans+Condensed:wght@300;400;500;600;700&family=Fraunces:wght@400;500;700&family=Poppins:wght@300;400;600;700&display=swap',
        false
    );

    $body_font = "'Nunito Sans', sans-serif";
    $heading_font = "'Cormorant Garamond', serif";

    $editor_css = "
        body, .editor-styles-wrapper {
            font-family: {$body_font} !important;
        }

        .editor-styles-wrapper h1,
        .editor-styles-wrapper h2,
        .editor-styles-wrapper h3,
        .editor-styles-wrapper h4,
        .editor-styles-wrapper h5,
        .editor-styles-wrapper h6 {
            font-family: {$heading_font} !important;
        }

        .wp-block {
            font-family: {$body_font} !important;
        }

        .wp-block-heading {
            font-family: {$heading_font} !important;
        }
    ";
    wp_add_inline_style('wp-edit-blocks', $editor_css);
}
add_action('enqueue_block_editor_assets', 'advancedcare_editor_fonts');

// Enqueue Button Styles for Block Editor
add_action('enqueue_block_editor_assets', function () {
    wp_enqueue_script(
        'theme-editor-button-styles',
        get_template_directory_uri() . '/dist/button-styles.min.js',
        ['wp-blocks', 'wp-dom-ready', 'wp-edit-post'],
        filemtime(get_template_directory() . '/dist/button-styles.min.js'),
        true
    );
});

// Register custom block category
function advancedcare_register_block_category($categories, $post) {
    $custom_category = array(
        array(
            'slug'  => 'advancedcare-blocks',
            'title' => __('Advanced Care Blocks', 'advancedcare'),
            'icon'  => null,
        ),
    );
    return array_merge($custom_category, $categories);
}
add_filter('block_categories_all', 'advancedcare_register_block_category', 10, 2);

// Include theme components
require get_template_directory() . '/inc/customizer.php';
require get_template_directory() . '/inc/custom-walker.php';

// Register Footer Widgets
function advancedcare_register_footer_widgets() {
    register_sidebar([
        'name'          => __('Footer Social Links', 'advancedcare'),
        'id'            => 'footer-social-links',
        'before_widget' => '<div class="footer-social-links-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="footer-social-title">',
        'after_title'   => '</h3>',
    ]);

    register_sidebar([
        'name'          => __('Footer Address', 'advancedcare'),
        'id'            => 'footer-address',
        'before_widget' => '<div class="footer-address-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="footer-address-title">',
        'after_title'   => '</h3>',
    ]);

    register_sidebar([
        'name'          => __('Footer Menu Links', 'advancedcare'),
        'id'            => 'footer-menu-links',
        'before_widget' => '<div class="footer-menu-links-widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h3 class="footer-menu-title">',
        'after_title'   => '</h3>',
    ]);
}
add_action('widgets_init', 'advancedcare_register_footer_widgets');

// Allow SVG uploads for admins only
function acb_allow_svg_uploads($mimes) {
    if (current_user_can('administrator')) {
        $mimes['svg'] = 'image/svg+xml';
    }
    return $mimes;
}
add_filter('upload_mimes', 'acb_allow_svg_uploads');
