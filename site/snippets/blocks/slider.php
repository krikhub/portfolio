<?php
$images = $block->images()->toFiles();
if ($images->isEmpty()) return;

$autoplay = $block->autoplay()->toBool();
$duration = $block->duration()->or(5)->toInt();
$sliderId = 'slider-' . uniqid();
?>

<div class="slider" id="<?= $sliderId ?>" data-autoplay="<?= $autoplay ? 'true' : 'false' ?>" data-duration="<?= $duration ?>">
  <div class="slider-wrapper">
    <?php $slideIndex = 0; foreach ($images as $image): ?>
      <div class="slider-slide <?= $slideIndex === 0 ? 'active' : '' ?>">
        <img src="<?= $image->url() ?>" alt="<?= $image->alt()->esc() ?>">
        <?php if ($image->caption()->isNotEmpty()): ?>
          <div class="slider-caption"><?= $image->caption()->esc() ?></div>
        <?php endif ?>
      </div>
    <?php $slideIndex++; endforeach ?>
  </div>
  
  <?php if ($images->count() > 1): ?>
    <button class="slider-prev" aria-label="Previous slide">‹</button>
    <button class="slider-next" aria-label="Next slide">›</button>
    
    <div class="slider-dots">
      <?php $i = 0; foreach ($images as $image): ?>
        <button class="slider-dot <?= $i === 0 ? 'active' : '' ?>" data-index="<?= $i ?>" aria-label="Go to slide <?= $i + 1 ?>"></button>
      <?php $i++; endforeach ?>
    </div>
  <?php endif ?>
</div>
