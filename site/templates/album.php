<?php
/*
  Templates render the content of your pages.

  They contain the markup together with some control structures
  like loops or if-statements. The `$page` variable always
  refers to the currently active page.

  To fetch the content from each field we call the field name as a
  method on the `$page` object, e.g. `$page->title()`.

  This example template makes use of the `$gallery` variable defined
  in the `album.php` controller (/site/controllers/album.php)

  Snippets like the header and footer contain markup used in
  multiple templates. They also help to keep templates clean.

  More about templates: https://getkirby.com/docs/guide/templates/basics
*/
?>
<?php snippet('header') ?>
<article>
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
  // Left arrow key
  if (e.key === 'ArrowLeft') {
    const prevLink = document.querySelector('.album-nav-prev');
    if (prevLink) {
      window.location.href = prevLink.href;
    }
  }
  // Right arrow key
  if (e.key === 'ArrowRight') {
    const nextLink = document.querySelector('.album-nav-next');
    if (nextLink) {
      window.location.href = nextLink.href;
    }
  }
});
</script>

<?php snippet('footer') ?>
