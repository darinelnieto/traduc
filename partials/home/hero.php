<?php
$script_handle = 'hero-js';
wp_enqueue_script(
    $script_handle,
    get_template_directory_uri() . '/js/partials-min/hero.min.js',
    array('jquery'),
    null,
    true
);
/**
 * 
 * Partial Name: hero
 * 
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
$hero = get_field('hero_content');
$ctas = $hero['call_to_actions'];
?>
<section class="hero-partial-b94fa3" id="inicio">
    <?php if(!empty($hero['video'])): ?>
        <video id="customVideo" autoplay muted loop playsinline preload="auto" style="width: 100%; height: auto; object-fit: cover;">
            <source src="<?= $hero['video']; ?>" type="video/mp4">
            Tu navegador no soporta video HTML5.
        </video>
    <?php endif; ?>
    <div class="container">
      <div class="row">
        <div class="col-12 col-md-10 hero_texts">
          <?php if(!empty($hero['legal_label'])): ?>
            <span class="legal-label">
              <span class="inner"></span>
              <span class="text chip" data-aos="fade-down"><?= $hero['legal_label']; ?></span>
            </span>
          <?php endif; if(!empty($hero['title'])): ?>
            <h1 class="title headding-1" data-aos="fade-up"><?= $hero['title']; ?></h1>
          <?php endif; if(!empty($hero['description'])): ?>
            <div class="decription" data-aos="fade-right"><?= $hero['description']; ?></div>
          <?php endif; if(!empty($ctas['main_cta']) || !empty($ctas['secondary_cta'])): ?>
            <ul class="call-to-actions">
              <li>
                <a href="<?= $ctas['main_cta']['url']; ?>" data-aos="fade-right" target="<?= $ctas['main_cta']['target'] ?? '_self'; ?>" class="call-to-action primary">
                  <?= $ctas['main_cta']['title']; ?>
                </a>
              </li>
              <li>
                <a href="<?= $ctas['secondary_cta']['url']; ?>" data-aos="fade-left" target="<?= $ctas['secondary_cta']['target'] ?? '_self'; ?>" class="call-to-action secondary">
                  <?= $ctas['secondary_cta']['title']; ?>
                </a>
              </li>
            </ul>
          <?php endif; if(!empty($hero['docs'])): ?>
            <div class="docs">
              <?php foreach($hero['docs'] as $item): ?>
                <div class="doc-item" data-aos="fade-up">
                  <p class="doc-label"><?= $item['label']; ?></p>
                  <p class="doc-desc"><?= $item['description']; ?></p>
                </div>
              <?php endforeach; ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
    <!-- scroll -->
    <div class="hero__scroll" aria-hidden="true">
      <span>Scroll</span>
      <span class="hero__scroll-line"></span>
    </div>
    <!-- Background grid -->
    <div class="hero__bg-grid"></div>
    <!-- Deco -->
    <div class="hero__deco-num">20</div>
    <span class="hero__glyph hero__glyph--1 d-none">¶</span>
    <span class="hero__glyph hero__glyph--2 d-none">§</span>
    <span class="hero__glyph hero__glyph--3 d-none">&</span>
    <!-- Doc card -->
    <div class="hero__doc d-none" aria-hidden="true" style="transform: translateY(calc(-50% + 2.06398px)) translateX(1.675px);">
      <div class="hero__doc-card">
        <div class="hero__doc-header">
          <span class="hero__doc-stamp"><?= $hero['hero_header']['stamp'] ?? ''; ?></span>
          <span class="hero__doc-flag"><?= $hero['hero_header']['flag'] ?? ''; ?></span>
        </div>
        <div class="hero__doc-title"><?= $hero['doc_title'] ?? '' ?></div>
        <div class="hero__doc-lines">
          <span style="width:92%"></span>
          <span style="width:78%"></span>
          <span style="width:88%"></span>
          <span style="width:64%"></span>
          <span style="width:80%"></span>
          <span style="width:70%"></span>
        </div>
        <div class="hero__doc-seal">
          <svg viewBox="0 0 80 80" width="80" height="80">
            <circle cx="40" cy="40" r="36" fill="none" stroke="currentColor" stroke-width="1.2"></circle>
            <circle cx="40" cy="40" r="28" fill="none" stroke="currentColor" stroke-width=".8" stroke-dasharray="2 3"></circle>
            <text class="text-playfair" x="40" y="38" text-anchor="middle" font-family="Playfair Display, serif" font-size="11" font-style="italic" fill="currentColor">SMK</text>
            <text x="40" y="52" text-anchor="middle" font-family="Inter, sans-serif" font-size="6" letter-spacing="1.5" fill="currentColor">CERTIFICADO</text>
          </svg>
        </div>
        <div class="hero__doc-footer">
          <?= $hero['footer'] ?? ''; ?>
        </div>
      </div>
      <div class="hero__doc-card hero__doc-card--back"></div>
      <span class="hero__tag hero__tag--1"><?= $hero['tags']['main_tag'] ?? ''; ?></span>
      <span class="hero__tag hero__tag--2"><?= $hero['tags']['secondary_tag'] ?? ''; ?></span>
      <span class="hero__tag hero__tag--3"><?= $hero['tags']['third_tag'] ?? ''; ?></span>
    </div>
</section>          