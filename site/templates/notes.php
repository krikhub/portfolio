<?php
/*
  Notes listing template - Marathon Sci-Fi Design
*/
?>
<?php snippet('header') ?>

<?php if (empty($tag) === false): ?>
<header class="h1">
  <h1>
    <small style="color: var(--color-text-dim);">Tag:</small> <?= esc($tag) ?>
    <a href="<?= $page->url() ?>" aria-label="All Notes" style="color: var(--color-text);">&times;</a>
  </h1>
</header>
<?php else: ?>
  <div class="hud-label" style="margin-bottom: 0.75rem;">Notes</div>
  <?php snippet('intro') ?>
<?php endif ?>

<ul class="grid" style="--gutter: 1.5rem;">
  <?php foreach ($notes as $note): ?>
  <li class="column" style="--columns: 4">
    <?php snippet('note', ['note' => $note]) ?>
  </li>
  <?php endforeach ?>
</ul>

<?php snippet('pagination', ['pagination' => $notes->pagination()]) ?>
<?php snippet('footer') ?>
