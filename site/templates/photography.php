<?php
/*
  Photography/Portfolio template - Fine-line Design
*/
?>
<?php snippet('header') ?>

<header class="work-header">
  <h1 class="work-title"><?= $page->headline()->or($page->title())->esc() ?></h1>
  <?php if ($page->subheadline()->isNotEmpty()): ?>
    <p class="work-subtitle"><?= $page->subheadline()->esc() ?></p>
  <?php endif ?>
</header>

<ul class="work-list">
  <?php foreach ($page->children()->listed() as $project): ?>
  <li class="work-item">
    <a href="<?= $project->url() ?>">
      <div class="work-item-info">
        <span class="work-item-index"><?= str_pad($project->indexOf() + 1, 2, '0', STR_PAD_LEFT) ?></span>
        <div class="work-item-text">
          <span class="work-item-title"><?= $project->title()->esc() ?></span>
          <?php if ($project->subheadline()->isNotEmpty()): ?>
            <span class="work-item-desc"><?= $project->subheadline()->esc() ?></span>
          <?php endif ?>
        </div>
        <?php if ($project->tags()->isNotEmpty()): ?>
          <span class="work-item-tags"><?= $project->tags()->esc() ?></span>
        <?php endif ?>
      </div>
      <?php if ($thumb = $project->image()): ?>
      <div class="work-item-thumb">
        <img src="<?= $thumb->url() ?>" alt="<?= $project->title()->esc() ?>" loading="lazy">
      </div>
      <?php endif ?>
    </a>
  </li>
  <?php endforeach ?>
</ul>

<?php snippet('footer') ?>
