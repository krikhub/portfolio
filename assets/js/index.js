// Clean GSAP Animations
(function () {
  gsap.registerPlugin(ScrollTrigger);

  // Defaults
  const ease = 'power3.out';
  const dur = 0.8;

  // --- Header: fade in on load ---
  gsap.from('.header', {
    y: -20,
    opacity: 0,
    duration: 0.6,
    ease: ease
  });

  // --- Hero section ---
  const hero = document.querySelector('.hero');
  if (hero) {
    const tl = gsap.timeline({ defaults: { ease: ease, duration: dur } });

    tl.from('.hero-tag', { y: 20, opacity: 0 })
      .from('.hero-title', { y: 30, opacity: 0 }, '-=0.5')
      .from('.hero-subtitle', { y: 20, opacity: 0 }, '-=0.5')
      .from('.hero-actions', { y: 20, opacity: 0 }, '-=0.4')
      .from('.hero-stats .hero-stat', {
        y: 15,
        opacity: 0,
        stagger: 0.1
      }, '-=0.3')
      .from('.hero-hud', {
        scale: 0.8,
        opacity: 0,
        duration: 1.2
      }, 0.2);
  }

  // --- Video divider ---
  const video = document.querySelector('.home-video');
  if (video) {
    gsap.from(video, {
      scrollTrigger: {
        trigger: video,
        start: 'top 85%'
      },
      opacity: 0,
      duration: 1,
      ease: ease
    });
  }

  // --- Grid items (portfolio, notes, about columns) ---
  gsap.utils.toArray('.grid > .column').forEach(function (col, i) {
    gsap.from(col, {
      scrollTrigger: {
        trigger: col,
        start: 'top 90%'
      },
      y: 30,
      opacity: 0,
      duration: 0.6,
      delay: i % 3 * 0.1,
      ease: ease
    });
  });

  // --- Note excerpts ---
  gsap.utils.toArray('.note-excerpt').forEach(function (el) {
    gsap.from(el, {
      scrollTrigger: {
        trigger: el,
        start: 'top 90%'
      },
      y: 20,
      opacity: 0,
      duration: 0.6,
      ease: ease
    });
  });

  // --- Portfolio grid on home ---
  gsap.utils.toArray('.home-grid li').forEach(function (li, i) {
    gsap.from(li, {
      scrollTrigger: {
        trigger: li,
        start: 'top 90%'
      },
      opacity: 0,
      scale: 0.97,
      duration: 0.5,
      delay: i * 0.05,
      ease: ease
    });
  });

  // --- Album gallery images ---
  gsap.utils.toArray('.album-gallery li').forEach(function (li, i) {
    gsap.from(li, {
      scrollTrigger: {
        trigger: li,
        start: 'top 90%'
      },
      y: 25,
      opacity: 0,
      duration: 0.5,
      delay: i * 0.08,
      ease: ease
    });
  });

  // --- HUD labels ---
  gsap.utils.toArray('.hud-label').forEach(function (el) {
    gsap.from(el, {
      scrollTrigger: {
        trigger: el,
        start: 'top 92%'
      },
      x: -15,
      opacity: 0,
      duration: 0.5,
      ease: ease
    });
  });

  // --- Intro text blocks ---
  gsap.utils.toArray('.intro').forEach(function (el) {
    gsap.from(el, {
      scrollTrigger: {
        trigger: el,
        start: 'top 88%'
      },
      y: 20,
      opacity: 0,
      duration: 0.7,
      ease: ease
    });
  });

  // --- Box / card elements ---
  gsap.utils.toArray('.box').forEach(function (el) {
    gsap.from(el, {
      scrollTrigger: {
        trigger: el,
        start: 'top 88%'
      },
      y: 20,
      opacity: 0,
      duration: 0.6,
      ease: ease
    });
  });

  // --- Footer ---
  gsap.from('.footer', {
    scrollTrigger: {
      trigger: '.footer',
      start: 'top 95%'
    },
    y: 15,
    opacity: 0,
    duration: 0.6,
    ease: ease
  });

  // --- Form animations ---
  const form = document.querySelector('.freelancer-form');
  if (form) {
    gsap.from('.freelancer-form .intro', {
      y: 20,
      opacity: 0,
      duration: 0.7,
      ease: ease
    });

    gsap.from('.form-progress', {
      y: 15,
      opacity: 0,
      duration: 0.5,
      delay: 0.2,
      ease: ease
    });

    gsap.from('.progress-step', {
      y: 10,
      opacity: 0,
      stagger: 0.1,
      duration: 0.4,
      delay: 0.3,
      ease: ease
    });

    // Animate form fields when stage becomes active
    animateFormStage();
  }

  function animateFormStage() {
    var activeStage = document.querySelector('.form-stage.active');
    if (!activeStage) return;

    var fields = activeStage.querySelectorAll('.form-field, .form-stage-title, .form-actions');
    gsap.from(fields, {
      y: 15,
      opacity: 0,
      stagger: 0.06,
      duration: 0.4,
      ease: ease
    });
  }

  // Patch nextStep/prevStep to trigger form animations
  var origNext = window.nextStep;
  if (origNext) {
    window.nextStep = function (step) {
      origNext(step);
      setTimeout(animateFormStage, 50);
    };
  }
  var origPrev = window.prevStep;
  if (origPrev) {
    window.prevStep = function (step) {
      origPrev(step);
      setTimeout(animateFormStage, 50);
    };
  }

  // --- Skills categories (about page) ---
  gsap.utils.toArray('.skills-category').forEach(function (el, i) {
    gsap.from(el, {
      scrollTrigger: {
        trigger: el,
        start: 'top 90%'
      },
      y: 20,
      opacity: 0,
      duration: 0.5,
      delay: i * 0.08,
      ease: ease
    });
  });

  // --- Contact section ---
  var contact = document.querySelector('.contact');
  if (contact) {
    gsap.from(contact, {
      scrollTrigger: {
        trigger: contact,
        start: 'top 85%'
      },
      y: 25,
      opacity: 0,
      duration: 0.7,
      ease: ease
    });
  }

  // --- Album navigation ---
  var albumNav = document.querySelector('.album-navigation');
  if (albumNav) {
    gsap.from(albumNav.children, {
      scrollTrigger: {
        trigger: albumNav,
        start: 'top 92%'
      },
      y: 15,
      opacity: 0,
      stagger: 0.15,
      duration: 0.5,
      ease: ease
    });
  }

})();
