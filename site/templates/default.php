<?php snippet('header') ?>

<article>
  <div class="hud-label" style="margin-bottom: 0.75rem;">Page</div>
  <h1 class="h1"><?= $page->title()->esc() ?></h1>
  <div class="text">
    <?= $page->text()->kt() ?>
  </div>
</article>

<?php snippet('footer') ?>
