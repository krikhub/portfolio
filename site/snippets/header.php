<?php
/*
  Snippets are a great way to store code snippets for reuse
  or to keep your templates clean.

  This header snippet is reused in all templates.
  It fetches information from the `site.txt` content file
  and contains the site navigation.

  More about snippets:
  https://getkirby.com/docs/guide/templates/snippets
*/
?>
<!DOCTYPE html>
<html lang="en">
<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">

  <?php
  // SEO Meta Tags
  $metaTitle = $page->metaTitle()->isNotEmpty() 
    ? $page->metaTitle()->esc() 
    : $page->title()->esc() . ' | ' . $site->title()->esc();
  
  $metaDescription = $page->metaDescription()->isNotEmpty() 
    ? $page->metaDescription()->esc() 
    : $site->title()->esc();
  
  $ogImage = $page->ogImage()->toFile() 
    ? $page->ogImage()->toFile()->url() 
    : null;
  ?>

  <title><?= $metaTitle ?></title>
  <meta name="description" content="<?= $metaDescription ?>">

  <!-- Open Graph / Facebook -->
  <meta property="og:type" content="website">
  <meta property="og:url" content="<?= $page->url() ?>">
  <meta property="og:title" content="<?= $metaTitle ?>">
  <meta property="og:description" content="<?= $metaDescription ?>">
  <?php if ($ogImage): ?>
  <meta property="og:image" content="<?= $ogImage ?>">
  <?php endif ?>

  <!-- Twitter -->
  <meta property="twitter:card" content="summary_large_image">
  <meta property="twitter:url" content="<?= $page->url() ?>">
  <meta property="twitter:title" content="<?= $metaTitle ?>">
  <meta property="twitter:description" content="<?= $metaDescription ?>">
  <?php if ($ogImage): ?>
  <meta property="twitter:image" content="<?= $ogImage ?>">
  <?php endif ?>

  <?php
  /*
    Stylesheets can be included using the `css()` helper.
    Kirby also provides the `js()` helper to include script file.
    More Kirby helpers: https://getkirby.com/docs/reference/templates/helpers
  */
  ?>
  <?= css([
    'assets/css/prism.css',
    'assets/css/lightbox.css',
    'assets/css/slider.css',
    'assets/css/index.css',
    '@auto'
  ]) ?>

  <?php
  /*
    The `url()` helper is a great way to create reliable
    absolute URLs in Kirby that always start with the
    base URL of your site.
  */
  ?>
  <link rel="shortcut icon" type="image/x-icon" href="<?= url('favicon.ico') ?>?v=4">
</head>
<body>

  <header class="header">
    <a class="logo" href="<?= $site->url() ?>">
      <?= $site->title()->esc() ?>
    </a>

    <button class="burger" aria-label="Menu" aria-expanded="false">
      <span></span>
      <span></span>
      <span></span>
    </button>

    <nav class="menu">
      <div class="menu-links">
        <?php foreach ($site->children()->listed() as $item): ?>
        <a <?php e($item->isOpen(), 'aria-current="page"') ?> href="<?= $item->url() ?>"><?= $item->title()->esc() ?></a>
        <?php endforeach ?>
      </div>
      <div class="menu-social">
        <?php snippet('social') ?>
      </div>
      <div class="menu-mobile-icons">
        <a href="https://github.com/krikhub" class="menu-icon-link" aria-label="Github">
          <?= svg('assets/icons/github.svg') ?>
        </a>
        <a href="https://de.linkedin.com/in/alexander-krikun-905a24231" class="menu-icon-link" aria-label="LinkedIn">
          <?= svg('assets/icons/linkedin.svg') ?>
        </a>
      </div>
    </nav>
  </header>

  <main class="main">
