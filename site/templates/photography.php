<?php
/*
  Photography/Portfolio template - Marathon Sci-Fi Design
*/
?>
<?php snippet('header') ?>

<div class="hud-label" style="margin-bottom: 0.75rem;">Portfolio</div>
<?php snippet('intro') ?>

<ul class="grid" style="--gutter: 1px">
  <?php foreach ($page->children()->listed() as $project): ?>
  <li class="column" style="--columns: 4">
    <a href="<?= $project->url() ?>" style="display: block; position: relative; overflow: hidden; border: 1px solid var(--color-border);">
      <figure>
        <span class="img" style="--w:1;--h:1">
          <?php if ($cover = $project->cover()): ?>
            <img src="<?= $cover->crop(400, 400)->url() ?>" alt="<?= $cover->alt()->esc() ?>">
          <?php endif ?>
        </span>
        <figcaption style="padding: 1rem; background: var(--color-bg-card); border-top: 1px solid var(--color-border);">
          <span style="font-size: 0.8rem; color: var(--color-text); letter-spacing: 0.03em;"><?= $project->title()->esc() ?></span>
        </figcaption>
      </figure>
    </a>
  </li>
  <?php endforeach ?>
</ul>

<?php snippet('footer') ?>
