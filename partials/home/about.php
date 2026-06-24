<?php
// $script_handle = 'about-js';
// wp_enqueue_script(
//     $script_handle,
//     get_template_directory_uri() . '/js/partials-min/about.min.js',
//     array('jquery'),
//     null,
//     true
// );
/**
 * 
 * Partial Name: about
 * 
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
$about_content = get_field('about_content');
$about = $about_content['about'];
$mision = $about_content['mision'];
$pillars = get_field('pillars');
?>
<section class="about-partial-7662a5 section section--cream" id="nosotros" style="overflow:hidden;position:relative">
    <div class="section-bignum" style="right:-40px;bottom:-60px">¶</div>
    <div class="wrap" style="position:relative">
      <div class="rev in about-content">
        <div>
          <span class="eyebrow" data-aos="fade-right">
            <span class="eyebrow-rule"></span>
            <?= $about['label'] ?? ''; ?>
          </span>
          <h2 class="section__h2" data-aos="fade-up"><?= $about['title'] ?? ''; ?></h2>
          <div data-aos="fade-right">
            <?= $about['about_description'] ?? ''; ?>
          </div>
        </div>
        <?php if(!empty($mision['description'] )): ?>
          <div class="bg-blue" data-aos="fade-left">
            <div class="gradient"></div>
            <div class="overflow">"</div>
            <p class="description"><?= $mision['description']; ?></p>
            <?php if(!empty($mision['label'])): ?>
              <div class="hr"></div>
              <div class="label"><?= $mision['label']; ?></div>
            <?php endif; ?>
          </div>
        <?php endif; ?>
      </div>
      <?php if(!empty($pillars['pillars_items'])): $key = 0; ?>
        <div style="margin-top:96px">
          <span class="eyebrow rev in" data-aos="fade-right">
            <span class="eyebrow-rule"></span>
            <?= $pillars['label'] ?? ''; ?>
          </span>
          <h2 class="section__h2 rev in" data-aos="fade-right"><?= $pillars['title'] ?? ''; ?></h2>
        </div>
        <div class="pillars">
          <?php foreach($pillars['pillars_items'] as $pillar): $key++; ?>
            <div class="pillar rev in" data-aos="fade-up">
              <span class="pillar__num"><?= $key < 10 ? '0' . $key : $key; ?></span>
              <div class="pillar__accent"></div>
              <h3 class="pillar__title"><?= $pillar['title'] ?? ''; ?></h3>
              <p class="pillar__body"><?= $pillar['description'] ?? ''; ?></p>
            </div>
          <?php endforeach; ?>
        </div>
      <?php endif; ?>
    </div>
</section>
                    