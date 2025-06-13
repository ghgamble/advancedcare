<?php get_header(); ?>

<main id="primary" class="site-main" role="main" style="padding: 4rem 1rem; text-align: center; background-color: #fff;">

    <div style="max-width: 700px; margin: 0 auto; padding: 2rem;">
        <h1 style="font-size: 2.5rem; color: #2c3e50; margin-bottom: 1rem;">Page Not Found</h1>
        <p style="font-size: 1.25rem; color: #555; line-height: 1.6; margin-bottom: 2rem;">
            We're sorry, but the page you were looking for isn’t here.<br>
            It may have been moved, or perhaps the address was typed incorrectly.
        </p>
        <a href="<?php echo esc_url(home_url('/')); ?>" 
           style="display: inline-block; margin-top: 1rem; padding: 0.75rem 1.5rem; background-color: #fff; border: 2px solid #000; color: #000; text-decoration: none; border-radius: 4px; font-size: 1rem;">
            Back to Home
        </a>
    </div>

</main>

<?php get_footer(); ?>
