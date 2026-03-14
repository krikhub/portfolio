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

  <?php if ($page->template()->name() === 'home'): ?>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/1.9.4/p5.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/matter-js/0.19.0/matter.min.js"></script>
  <script src="<?= url('assets/js/textures.js') ?>"></script>
  <script src="<?= url('assets/js/circ.js') ?>"></script>
  <script src="<?= url('assets/js/m_grfx.js') ?>"></script>
  <script src="<?= url('assets/js/m_ring.js') ?>"></script>
  <script src="<?= url('assets/js/m_cloud.js') ?>"></script>
  <script src="<?= url('assets/js/m_cosmic.js') ?>"></script>
  <script src="<?= url('assets/js/m_sphere.js') ?>"></script>
  <script src="<?= url('assets/js/update.js') ?>"></script>
  <script src="<?= url('assets/js/sketch_clutter.js') ?>"></script>
  <?php endif ?>

</body>
</html>
