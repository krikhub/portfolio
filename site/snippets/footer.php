<?php
/*
  Snippets are a great way to store code snippets for reuse
  or to keep your templates clean.

  This footer snippet is reused in all templates.

  More about snippets:
  https://getkirby.com/docs/guide/templates/snippets
*/
?>
  </main>

  <footer class="footer">
    <nav class="footer-nav">
      <a href="<?= page('impressum')?->url() ?? '#' ?>">Impressum</a>
      <a href="<?= page('datenschutz')?->url() ?? '#' ?>">Datenschutz</a>
    </nav>
  </footer>

  <script src="https://cdn.jsdelivr.net/npm/gsap@3.12.5/dist/gsap.min.js"></script>
  <?= js([
    'assets/js/prism.js',
    'assets/js/lightbox.js',
    'assets/js/slider.js',
    'assets/js/index.js',
    '@auto'
  ]) ?>

</body>
</html>
