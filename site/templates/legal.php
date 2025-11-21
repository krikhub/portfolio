<?php snippet('header') ?>

<article class="text">
  <h1><?= $page->title()->esc() ?></h1>
  <?= $page->text()->kirbytext() ?>
</article>

<?php snippet('footer') ?>
