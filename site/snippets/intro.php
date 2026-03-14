<?php
/*
  Intro snippet - Marathon Sci-Fi Design
*/
?>
<header class="h1">
  <h1><?= $page->headline()->or($page->title())->esc() ?></h1>
  <?php if ($page->subheadline()->isNotEmpty()): ?>
  <p style="color: var(--color-text-dim); font-size: 1rem; margin-top: 0.5rem;"><?= $page->subheadline()->esc() ?></p>
  <?php endif ?>
  <div class="hud-line"></div>
</header>
