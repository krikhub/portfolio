<?php
/*
  Album template - Marathon Sci-Fi Design
*/
?>
<?php snippet('header') ?>
<article>
  <div class="hud-label" style="margin-bottom: 0.75rem;">Projekt</div>
  <?php snippet('intro') ?>
  <div class="grid">
    <div class="column" style="--columns: 4">
      <div class="text">
        <?= $page->text() ?>
      </div>
    </div>
    <div class="column" style="--columns: 8">
      <ul class="album-gallery">
        <?php foreach ($gallery as $image): ?>
        <li>
          <a href="<?= $image->url() ?>" data-lightbox>
            <figure class="img" style="--w:<?= $image->width() ?>;--h:<?= $image->height() ?>">
              <img src="<?= $image->resize(800)->url() ?>" alt="<?= $image->alt()->esc() ?>">
            </figure>
          </a>
        </li>
        <?php endforeach ?>
      </ul>
    </div>
  </div>

  <nav class="album-navigation">
    <?php if ($prev = $page->prev()): ?>
    <a href="<?= $prev->url() ?>" class="album-nav-prev">
      <span>← Vorheriges</span>
      <small><?= $prev->title()->esc() ?></small>
    </a>
    <?php else: ?>
    <span></span>
    <?php endif ?>

    <?php if ($next = $page->next()): ?>
    <a href="<?= $next->url() ?>" class="album-nav-next">
      <span>Nächstes →</span>
      <small><?= $next->title()->esc() ?></small>
    </a>
    <?php endif ?>
  </nav>
</article>

<script>
document.addEventListener('keydown', function(e) {
  if (e.key === 'ArrowLeft') {
    const prevLink = document.querySelector('.album-nav-prev');
    if (prevLink && prevLink.href) window.location.href = prevLink.href;
  }
  if (e.key === 'ArrowRight') {
    const nextLink = document.querySelector('.album-nav-next');
    if (nextLink && nextLink.href) window.location.href = nextLink.href;
  }
});
</script>

<?php snippet('footer') ?>
