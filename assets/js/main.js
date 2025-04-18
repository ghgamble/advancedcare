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
      menuToggle.setAttribute('aria-expanded', (!isOpen).toString());
      mobileMenu.setAttribute('aria-hidden', isOpen.toString());
    });
  }

  // Mobile sub-menu toggle ONLY
  if (window.innerWidth <= 768) {
    document.querySelectorAll('.dropdown-arrow').forEach((arrow) => {
      arrow.addEventListener('click', (e) => {
        e.preventDefault();
        const parentLi = arrow.closest('li');
        const subMenu = parentLi.querySelector('.sub-menu');
        if (subMenu) {
          const isOpen = subMenu.classList.contains('open');
          subMenu.classList.toggle('open');
          const menuItemLink = parentLi.querySelector('a');
          menuItemLink?.setAttribute('aria-expanded', (!isOpen).toString());
        }
      });
    });
  }

  // Skip to content link visibility
  window.addEventListener('scroll', () => {
    if (window.scrollY > 100) {
      skipLink.classList.add('visible');
    } else {
      skipLink.classList.remove('visible');
    }
  });
});
