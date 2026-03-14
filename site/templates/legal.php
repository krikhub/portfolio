<?php snippet('header') ?>

<article class="text" style="max-width: 42rem;">
  <div class="hud-label" style="margin-bottom: 0.75rem;">Legal</div>
  <h1 class="h1"><?= $page->title()->esc() ?></h1>
  <?= $page->text()->kirbytext() ?>
</article>

<?php snippet('footer') ?>
