// Burger Menu
const burger = document.querySelector('.burger');
const menuOverlay = document.getElementById('mobileMenu');

if (burger && menuOverlay) {
  burger.addEventListener('click', function () {
    const isOpen = menuOverlay.classList.toggle('is-open');
    burger.setAttribute('aria-expanded', isOpen);
    document.body.style.overflow = isOpen ? 'hidden' : '';
  });

  // Close on link click
  menuOverlay.querySelectorAll('a').forEach(function (link) {
    link.addEventListener('click', function () {
      menuOverlay.classList.remove('is-open');
      burger.setAttribute('aria-expanded', 'false');
      document.body.style.overflow = '';
    });
  });
}
