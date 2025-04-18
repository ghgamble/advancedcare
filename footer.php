<?php // Skip link placed early in the body ?>
<a href="#content" class="skip-to-content" aria-label="Skip to content">
  <span class="screen-reader-text">Skip to content</span>
  <span class="skip-arrow" aria-hidden="true">
    <svg width="24" height="24" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
      <path d="M18 15l-6-6-6 6"/>
    </svg>
  </span>
</a>

<footer style="background-color: <?php echo esc_attr(get_theme_mod('advancedcare_footer_bg', '#282b35')); ?>; color: #fff;">
  <div class="o-container footer-inner">
    
    <!-- Logo and Social Icons -->
    <div class="footer-logo-social">
      <div class="footer-logo">
        <?php if (get_theme_mod('advancedcare_footer_logo')) : ?>
          <a href="<?php echo esc_url(home_url('/')); ?>" aria-label="Home - <?php bloginfo('name'); ?>">
            <img src="<?php echo esc_url(get_theme_mod('advancedcare_footer_logo')); ?>" alt="<?php bloginfo('name'); ?>">
          </a>
        <?php else : ?>
          <a href="<?php echo esc_url(home_url('/')); ?>" aria-label="Home - <?php bloginfo('name'); ?>"><?php bloginfo('name'); ?></a>
        <?php endif; ?>
      </div>

      <!-- Social Links Widget Area -->
      <div class="footer-social">
        <?php if (is_active_sidebar('footer-social-links')) : ?>
          <?php dynamic_sidebar('footer-social-links'); ?>
        <?php endif; ?>
      </div>
    </div>

    <!-- Footer Information -->
    <div class="footer-info">
      <!-- Footer Address Widget Area -->
      <div class="footer-address">
        <?php if (is_active_sidebar('footer-address')) : ?>
          <?php dynamic_sidebar('footer-address'); ?>
        <?php endif; ?>
      </div>
      
      <!-- Footer Menu Links Widget Area -->
      <div class="footer-menu">
        <?php if (is_active_sidebar('footer-menu-links')) : ?>
          <?php dynamic_sidebar('footer-menu-links'); ?>
        <?php endif; ?>
      </div>
    </div>
  </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
