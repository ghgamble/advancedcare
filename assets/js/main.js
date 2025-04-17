import '../scss/style.scss';

document.addEventListener('DOMContentLoaded', () => {
  const menuToggle = document.querySelector('.menu-toggle');
  const mobileMenu = document.querySelector('.main-mobile-menu');
  const siteHeader = document.querySelector('.site-header');
  const skipLink = document.querySelector('.skip-to-content');

  // Toggle mobile menu visibility
  if (menuToggle && mobileMenu) {
    menuToggle.addEventListener('click', () => {
      const isOpen = mobileMenu.classList.contains('open');
      mobileMenu.classList.toggle('open');
      siteHeader.classList.toggle('menu-open');
      menuToggle.setAttribute('aria-expanded', isOpen ? 'false' : 'true');
    });
  }

  // ✅ Mobile sub-menu toggle ONLY
  if (window.innerWidth <= 768) {
    document.querySelectorAll('.dropdown-arrow').forEach(arrow => {
      arrow.addEventListener('click', (e) => {
        e.preventDefault();
        const parentLi = arrow.closest('li');
        const subMenu = parentLi.querySelector('.sub-menu');
        if (subMenu) {
          subMenu.classList.toggle('open');
          const isExpanded = subMenu.classList.contains('open');
          const menuItemLink = parentLi.querySelector('a');
          // Update aria-expanded attribute for screen readers
          menuItemLink.setAttribute('aria-expanded', isExpanded ? 'true' : 'false');
        }
      });
    });
  }

  // Skip to content link visibility
  window.addEventListener('scroll', () => {
    if (window.scrollY > 100) { // Show after user scrolls down 100px
      skipLink.classList.add('visible');
    } else {
      skipLink.classList.remove('visible');
    }
  });
});
