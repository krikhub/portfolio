<?php
/*
  Snippets are a great way to store code snippets for reuse
  or to keep your templates clean.

  In this snippet the svg() helper is a great way to embed SVG
  code directly in your HTML. Pass the path to your SVG
  file to load it.

  More about snippets:
  https://getkirby.com/docs/guide/templates/snippets
*/
?>
<span class="social">
  <a href="https://github.com/krikhub" aria-label="Schau dir mein Github an">
    <?= svg('assets/icons/github.svg') ?>
  </a>
  <a href="https://de.linkedin.com/in/alexander-krikun-905a24231" aria-label="Connecte dich mit mir auf Linkedin">
    <?= svg('assets/icons/linkedin.svg') ?>
  </a>
</span>
