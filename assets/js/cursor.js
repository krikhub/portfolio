// Custom Cursor with GSAP and Blend Mode
(function() {
  // Create cursor HTML
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
  
  // Add cursor to body
  document.body.insertAdjacentHTML('beforeend', cursorHTML);
  
  const $bigBall = document.querySelector('.cursor__ball--big');
  const $smallBall = document.querySelector('.cursor__ball--small');
  const $hoverables = document.querySelectorAll('a, button, input, textarea, select, [role="button"]');
  
  // Move cursor on mouse move
  document.body.addEventListener('mousemove', onMouseMove);
  
  // Add hover listeners
  $hoverables.forEach(el => {
    el.addEventListener('mouseenter', onMouseHover);
    el.addEventListener('mouseleave', onMouseHoverOut);
  });
  
  // Move the cursor
  function onMouseMove(e) {
    gsap.to($bigBall, {
      duration: 0.4,
      x: e.clientX - 15,
      y: e.clientY - 15
    });
    gsap.to($smallBall, {
      duration: 0.1,
      x: e.clientX - 5,
      y: e.clientY - 5
    });
  }
  
  // Hover an element
  function onMouseHover() {
    gsap.to($bigBall, {
      duration: 0.3,
      scale: 2
    });
  }
  
  function onMouseHoverOut() {
    gsap.to($bigBall, {
      duration: 0.3,
      scale: 1
    });
  }
})();
