// Slider with GSAP animations
(function() {
  if (typeof gsap === 'undefined') {
    console.warn('GSAP not loaded, slider will not work');
    return;
  }

  function initSliders() {
  const sliders = document.querySelectorAll('.slider');
  
  sliders.forEach(slider => {
    const slides = slider.querySelectorAll('.slider-slide');
    const dots = slider.querySelectorAll('.slider-dot');
    const prevBtn = slider.querySelector('.slider-prev');
    const nextBtn = slider.querySelector('.slider-next');
    const autoplay = slider.dataset.autoplay === 'true';
    const duration = parseInt(slider.dataset.duration) * 1000;
    
    let currentIndex = 0;
    let autoplayInterval;
    
    function goToSlide(index, direction = 1) {
      if (index === currentIndex) return;
      
      const currentSlide = slides[currentIndex];
      const nextSlide = slides[index];
      const currentDot = dots[currentIndex];
      const nextDot = dots[index];
      
      // GSAP animation
      const tl = gsap.timeline();
      
      tl.to(currentSlide, {
        x: direction * -100 + '%',
        opacity: 0,
        duration: 0.6,
        ease: 'power2.inOut',
        onComplete: () => {
          currentSlide.classList.remove('active');
          gsap.set(currentSlide, { x: 0 });
        }
      });
      
      gsap.set(nextSlide, { x: direction * 100 + '%', opacity: 0 });
      nextSlide.classList.add('active');
      
      tl.to(nextSlide, {
        x: 0,
        opacity: 1,
        duration: 0.6,
        ease: 'power2.inOut'
      }, 0);
      
      currentDot?.classList.remove('active');
      nextDot?.classList.add('active');
      
      currentIndex = index;
    }
    
    function nextSlide() {
      const next = (currentIndex + 1) % slides.length;
      goToSlide(next, 1);
    }
    
    function prevSlide() {
      const prev = (currentIndex - 1 + slides.length) % slides.length;
      goToSlide(prev, -1);
    }
    
    function startAutoplay() {
      if (autoplay) {
        autoplayInterval = setInterval(nextSlide, duration);
      }
    }
    
    function stopAutoplay() {
      clearInterval(autoplayInterval);
    }
    
    // Event listeners
    nextBtn?.addEventListener('click', () => {
      stopAutoplay();
      nextSlide();
      startAutoplay();
    });
    
    prevBtn?.addEventListener('click', () => {
      stopAutoplay();
      prevSlide();
      startAutoplay();
    });
    
    dots.forEach((dot, index) => {
      dot.addEventListener('click', () => {
        stopAutoplay();
        const direction = index > currentIndex ? 1 : -1;
        goToSlide(index, direction);
        startAutoplay();
      });
    });
    
    // Pause on hover
    slider.addEventListener('mouseenter', stopAutoplay);
    slider.addEventListener('mouseleave', startAutoplay);
    
    // Start autoplay
    startAutoplay();
  });
}

  // Auto-init on DOM ready
  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initSliders);
  } else {
    initSliders();
  }
})();
