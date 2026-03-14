// Custom Cursor - Marathon Sci-Fi Light
(function() {
  if (document.querySelector('.freelancer-form')) return;
  if ('ontouchstart' in window) return;
  
  const cursorHTML = `
    <div class="cursor">
      <div class="cursor__ball cursor__ball--big">
        <svg height="30" width="30">
          <circle cx="15" cy="15" r="12" stroke-width="0"></circle>
        </svg>
      </div>
      <div class="cursor__ball cursor__ball--small">
        <svg height="10" width="10">
          <circle cx="5" cy="5" r="4" stroke-width="0"></circle>
        </svg>
      </div>
    </div>
  `;
  
  document.body.insertAdjacentHTML('beforeend', cursorHTML);
  
  const $bigBall = document.querySelector('.cursor__ball--big');
  const $smallBall = document.querySelector('.cursor__ball--small');
  const $hoverables = document.querySelectorAll('a, button, input, textarea, select, [role="button"]');
  
  document.body.addEventListener('mousemove', onMouseMove);
  
  $hoverables.forEach(el => {
    el.addEventListener('mouseenter', onMouseHover);
    el.addEventListener('mouseleave', onMouseHoverOut);
  });
  
  function onMouseMove(e) {
    gsap.to($bigBall, { duration: 0.4, x: e.clientX - 15, y: e.clientY - 15 });
    gsap.to($smallBall, { duration: 0.1, x: e.clientX - 5, y: e.clientY - 5 });
  }
  
  function onMouseHover() {
    gsap.to($bigBall, { duration: 0.3, scale: 2, opacity: 0.5 });
  }
  
  function onMouseHoverOut() {
    gsap.to($bigBall, { duration: 0.3, scale: 1, opacity: 1 });
  }
})();
