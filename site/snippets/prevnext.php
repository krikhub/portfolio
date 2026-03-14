<?php
/*
  Prev/Next navigation snippet - Marathon Sci-Fi Design
*/
?>
<nav class="blog-prevnext">
  <div class="hud-label" style="margin-bottom: 1rem;">Continue reading</div>

  <div class="autogrid" style="--gutter: 1.5rem">
    <?php if ($prev = $page->prevListed()): ?>
    <?php snippet('note', ['note' => $prev, 'excerpt' => false]) ?>
    <?php endif ?>

    <?php if ($next = $page->nextListed()): ?>
    <?php snippet('note', ['note' => $next, 'excerpt' => false]) ?>
    <?php endif ?>
  </div>
</nav>
