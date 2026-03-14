<?php
/*
  About template - Fine-line Design
*/
?>
<?php snippet('header') ?>

<article class="about">
  <header class="about-header">
    <h1 class="about-title"><?= $page->headline()->or($page->title())->esc() ?></h1>
    <?php if ($page->subheadline()->isNotEmpty()): ?>
      <p class="about-subtitle"><?= $page->subheadline()->esc() ?></p>
    <?php endif ?>
  </header>

  <?php foreach ($page->layout()->toLayouts() as $layout): ?>
  <section class="about-columns" id="<?= esc($layout->id(), 'attr') ?>">
    <?php foreach ($layout->columns() as $column): ?>
    <div class="about-col">
      <div class="text">
        <?= $column->blocks() ?>
      </div>
    </div>
    <?php endforeach ?>
  </section>
  <?php endforeach ?>

  <?php snippet('skills') ?>

  <?php if ($page->showContact()->toBool()): ?>
  <aside class="about-contact">
    <h2 class="about-section-label">Kontakt</h2>
    <div class="about-contact-grid">
      <?php if ($page->address()->isNotEmpty()): ?>
      <div class="about-contact-block text">
        <h3>Adresse</h3>
        <?= $page->address() ?>
      </div>
      <?php endif ?>
      <?php if ($page->email()->isNotEmpty() || $page->phone()->isNotEmpty()): ?>
      <div class="about-contact-block text">
        <?php if ($page->email()->isNotEmpty()): ?>
          <h3>E-Mail</h3>
          <p><?= Html::email($page->email()) ?></p>
        <?php endif ?>
        <?php if ($page->phone()->isNotEmpty()): ?>
          <h3>Telefon</h3>
          <p><?= Html::tel($page->phone()) ?></p>
        <?php endif ?>
      </div>
      <?php endif ?>
      <?php if ($page->social()->isNotEmpty()): ?>
      <div class="about-contact-block text">
        <h3>Web</h3>
        <ul>
          <?php foreach ($page->social()->toStructure() as $social): ?>
          <li><?= Html::a($social->url(), $social->platform()) ?></li>
          <?php endforeach ?>
        </ul>
      </div>
      <?php endif ?>
    </div>
  </aside>
  <?php endif ?>
</article>

<?php snippet('footer') ?>
