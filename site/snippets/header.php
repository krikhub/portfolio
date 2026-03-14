<?php
/*
  Header snippet - Clean Design
*/
?>
<!DOCTYPE html>
<html lang="de">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0">
  <meta name="theme-color" content="#ffffff">

  <?php
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

  <meta property="og:type" content="website">
  <meta property="og:url" content="<?= $page->url() ?>">
  <meta property="og:title" content="<?= $metaTitle ?>">
  <meta property="og:description" content="<?= $metaDescription ?>">
  <?php if ($ogImage): ?>
  <meta property="og:image" content="<?= $ogImage ?>">
  <?php endif ?>

  <meta property="twitter:card" content="summary_large_image">
  <meta property="twitter:url" content="<?= $page->url() ?>">
  <meta property="twitter:title" content="<?= $metaTitle ?>">
  <meta property="twitter:description" content="<?= $metaDescription ?>">
  <?php if ($ogImage): ?>
  <meta property="twitter:image" content="<?= $ogImage ?>">
  <?php endif ?>

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&family=JetBrains+Mono:wght@400;500;600&display=swap" rel="stylesheet">

  <?= css([
    'assets/css/prism.css',
    'assets/css/lightbox.css',
    'assets/css/slider.css',
    'assets/css/index.css',
    '@auto'
  ]) ?>

  <link rel="shortcut icon" type="image/x-icon" href="<?= url('favicon.ico') ?>?v=4">
</head>
<body>

<!-- Mobile overlay menu — outside site-wrapper for correct z-index -->
<nav class="menu-overlay" id="mobileMenu" role="navigation">
  <div class="menu-overlay-inner">
    <div class="menu-links">
      <?php foreach ($site->children()->listed() as $item): ?>
      <a <?php e($item->isOpen(), 'aria-current="page"') ?> href="<?= $item->url() ?>"><?= $item->title()->esc() ?></a>
      <?php endforeach ?>
    </div>
    <div class="menu-mobile-icons">
      <a href="https://github.com/krikhub" class="menu-icon-link" aria-label="Github">
        <?= svg('assets/icons/github.svg') ?>
      </a>
      <a href="https://de.linkedin.com/in/alexander-krikun-905a24231" class="menu-icon-link" aria-label="LinkedIn">
        <?= svg('assets/icons/linkedin.svg') ?>
      </a>
    </div>
  </div>
</nav>

<div class="site-wrapper">

  <header class="header">
    <a class="logo" href="<?= $site->url() ?>">
      <?= $site->title()->esc() ?>
    </a>

    <button class="burger" aria-label="Menu" aria-expanded="false">
      <span></span>
      <span></span>
      <span></span>
    </button>

    <nav class="menu" role="navigation">
      <div class="menu-links">
        <?php foreach ($site->children()->listed() as $item): ?>
        <a <?php e($item->isOpen(), 'aria-current="page"') ?> href="<?= $item->url() ?>"><?= $item->title()->esc() ?></a>
        <?php endforeach ?>
      </div>
      <div class="menu-social">
        <?php snippet('social') ?>
      </div>
    </nav>
  </header>

  <main class="main">
