<?php
/*
  Home template - Clean Minimal Design
  Video as visual divider after hero
*/
?>
<?php snippet('header') ?>

  <!-- Hero Section -->
  <section class="hero">
    <div class="hero-content">
      <div class="hero-tag">Freelance Webentwickler</div>
      <h1 class="hero-title">
        <?= $page->headline()->or('Flexibel, zuverlässig, einsatzbereit')->esc() ?>
      </h1>
      <p class="hero-subtitle">
        <?= $page->subheadline()->or('Unterstützung für Webprojekte auf Abruf oder über mehrere Wochen – PHP, React, WordPress & mehr.')->esc() ?>
      </p>
      <div class="hero-actions">
        <a href="<?= url('freelancer-anfrage') ?>" class="cta">Freelancer buchen</a>
        <a href="<?= url('website-projekt-anfragen') ?>" class="hero-cta-secondary">Website-Projekt anfragen</a>
      </div>

      <div class="hero-stats">
        <div class="hero-stat">
          <span class="hero-stat-value">PHP / Laravel</span>
          <span class="hero-stat-label">Primary Stack</span>
        </div>
        <div class="hero-stat">
          <span class="hero-stat-value">React / Next.js</span>
          <span class="hero-stat-label">Frontend</span>
        </div>
        <div class="hero-stat">
          <span class="hero-stat-value">WordPress / Kirby / Statamic</span>
          <span class="hero-stat-label">CMS</span>
        </div>
      </div>
    </div>

    <!-- HUD decorative element -->
    <div class="hero-hud" aria-hidden="true">
      <div class="hud-circle"></div>
    </div>
  </section>

</main>

<main class="main">

<?php snippet('footer') ?>
