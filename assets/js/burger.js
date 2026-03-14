// Burger Menu — supports multiple burger buttons
const burgers = document.querySelectorAll('.burger');
const menuOverlay = document.getElementById('mobileMenu');

if (burgers.length && menuOverlay) {
  burgers.forEach(function (burger) {
    burger.addEventListener('click', function () {
      const isOpen = menuOverlay.classList.toggle('is-open');
      // Sync all burger buttons
      burgers.forEach(function (b) {
        b.setAttribute('aria-expanded', isOpen);
      });
      document.body.style.overflow = isOpen ? 'hidden' : '';
    });
  });

  // Close on link click
  menuOverlay.querySelectorAll('a').forEach(function (link) {
    link.addEventListener('click', function () {
      menuOverlay.classList.remove('is-open');
      burgers.forEach(function (b) {
        b.setAttribute('aria-expanded', 'false');
      });
      document.body.style.overflow = '';
    });
  });
}
