<?php if ($page->showSkills()->toBool() && $skills = $page->skills()->toStructure()): ?>
<section class="skills-section">
  <div class="hud-label" style="margin-bottom: 1rem;">Capabilities</div>
  <div class="skills-grid">
    <?php foreach ($skills as $category): ?>
    <div class="skills-category hud-corner">
      <h3 class="skills-category-title"><?= $category->category()->esc() ?></h3>
      <ul class="skills-list">
        <?php foreach ($category->items()->toStructure() as $skill): ?>
        <li class="skill-item">
          <div class="skill-name"><?= $skill->name()->esc() ?></div>
          <div class="skill-bar-container">
            <div class="skill-bar" data-level="<?= ($skill->level()->toInt() / 5) * 100 ?>"></div>
          </div>
        </li>
        <?php endforeach ?>
      </ul>
    </div>
    <?php endforeach ?>
  </div>
</section>

<script>
const observerOptions = { threshold: 0.2, rootMargin: '0px 0px -50px 0px' };
const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      entry.target.querySelectorAll('.skill-bar').forEach(bar => {
        setTimeout(() => { bar.style.width = bar.getAttribute('data-level') + '%'; }, 100);
      });
      observer.unobserve(entry.target);
    }
  });
}, observerOptions);
document.querySelectorAll('.skills-section').forEach(s => observer.observe(s));
</script>
<?php endif ?>
