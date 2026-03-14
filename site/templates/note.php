<?php
/*
  Note (single post) template - Marathon Sci-Fi Design
*/
?>
<?php snippet('header') ?>

<?php if ($cover = $page->cover()): ?>
<a href="<?= $cover->url() ?>" data-lightbox class="img" style="--w:2; --h:1; border: 1px solid var(--color-border);">
  <img src="<?= $cover->crop(1200, 600)->url() ?>" alt="<?= $cover->alt()->esc() ?>">
</a>
<?php endif ?>

<article class="note">
  <header class="note-header h1">
    <div class="hud-label" style="margin-bottom: 0.75rem;">Article</div>
    <h1 class="note-title"><?= $page->title()->esc() ?></h1>
    <?php if ($page->subheading()->isNotEmpty()): ?>
    <p class="note-subheading"><small><?= $page->subheading()->esc() ?></small></p>
    <?php endif ?>
  </header>
  <div class="note text">
    <?= $page->text()->toBlocks() ?>
  </div>
  <footer class="note-footer">
    <?php if (!empty($tags)): ?>
    <ul class="note-tags">
      <?php foreach ($tags as $tag): ?>
      <li>
        <a href="<?= $page->parent()->url(['params' => ['tag' => $tag]]) ?>"><?= esc($tag) ?></a>
      </li>
      <?php endforeach ?>
    </ul>
    <?php endif ?>
    <time class="note-date" datetime="<?= $page->date()->toDate('c') ?>"><?= $page->date()->esc() ?></time>
  </footer>

  <?php snippet('prevnext') ?>
</article>

<?php snippet('footer') ?>
