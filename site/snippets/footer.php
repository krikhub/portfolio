<?php
/*
  Footer snippet - Marathon Sci-Fi Design
*/
?>
  </main>

  <footer class="footer">
    <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 1rem;">
      <nav class="footer-nav">
        <a href="<?= page('impressum')?->url() ?? '#' ?>">Impressum</a>
        <a href="<?= page('datenschutz')?->url() ?? '#' ?>">Datenschutz</a>
      </nav>
      <span class="hud-label" style="color: var(--color-text-muted);">© <?= date('Y') ?></span>
    </div>
  </footer>

</div><!-- .site-wrapper -->

  <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/ScrollTrigger.min.js"></script>
  <?= js([
    'assets/js/burger.js',
    'assets/js/prism.js',
    'assets/js/lightbox.js',
    'assets/js/slider.js',
    'assets/js/cursor.js',
    'assets/js/index.js',
    '@auto'
  ]) ?>

</body>
</html>
