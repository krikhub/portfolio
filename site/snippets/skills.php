<?php if ($page->showSkills()->toBool() && $skills = $page->skills()->toStructure()): ?>
<section class="skills-section">
  <div class="skills-grid">
    <?php foreach ($skills as $category): ?>
    <div class="skills-category">
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
// Animate skill bars when they come into view
const observerOptions = {
  threshold: 0.2,
  rootMargin: '0px 0px -50px 0px'
};

const observer = new IntersectionObserver((entries) => {
  entries.forEach(entry => {
    if (entry.isIntersecting) {
      const bars = entry.target.querySelectorAll('.skill-bar');
      bars.forEach(bar => {
        const level = bar.getAttribute('data-level');
        setTimeout(() => {
          bar.style.width = level + '%';
        }, 100);
      });
      observer.unobserve(entry.target);
    }
  });
}, observerOptions);

document.querySelectorAll('.skills-section').forEach(section => {
  observer.observe(section);
});
</script>
<?php endif ?>
