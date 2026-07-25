<?php
$script_handle = 'global_hero-js';
wp_enqueue_script(
    $script_handle,
    get_template_directory_uri() . '/js/partials-min/global_hero.min.js',
    array('jquery'),
    null,
    true
);
/**
 * 
 * Partial Name: global_hero
 * 
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
$hero = get_sub_field('global_hero');
?>
<section class="global-hero-partial-549988 hero">
    <div class="blog-head__grid"></div>
    <div class="blog-head__deco">¶</div>
    <div class="wrap blog-head__inner">
      <span class="eyebrow" data-aos="fade-down"><span class="eyebrow-rule"></span><?= $hero['eyebrow'] ?? ''; ?></span>
      <h1 class="blog-head__h1" data-aos="fade-right"><?= $hero['title'] ?? the_title(); ?></h1>
      <p class="blog-head__sub" data-aos="fade-up"><?= $hero['description'] ?? ''; ?></p>
    </div>
</section>
                    