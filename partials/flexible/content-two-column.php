<?php
// $script_handle = 'content-two-column-js';
// wp_enqueue_script(
//     $script_handle,
//     get_template_directory_uri() . '/js/partials-min/content-two-column.min.js',
//     array('jquery'),
//     null,
//     true
// );
/**
 * 
 * Partial Name: content-two-column
 * 
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
$about_content = get_sub_field('content_two_column');
$about = $about_content['about'];
$mision = $about_content['mision'];
?>
<section class="content-two-column-partial-dc1ddf section section--cream" style="overflow:hidden;position:relative">
  <div class="section-bignum" style="right:-40px;bottom:-60px">¶</div>
  <div class="wrap" style="position:relative">
    <div class="rev in about-content">
      <div>
        <?php if(!empty($about['label'])): ?>
          <span class="eyebrow" data-aos="fade-right">
              <span class="eyebrow-rule"></span>
              <?= $about['label']; ?>
          </span>
        <?php endif; ?>
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
  </div>
</section>
                    