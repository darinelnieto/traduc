<?php
// $script_handle = 'single-blog-hero-js';
// wp_enqueue_script(
//     $script_handle,
//     get_template_directory_uri() . '/js/partials-min/single-blog-hero.min.js',
//     array('jquery'),
//     null,
//     true
// );
/**
 * 
 * Partial Name: single-blog-hero
 * 
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
$b = get_post_type();
?>
<section class="single-blog-hero-partial-d51aa9">
    <div class="blog-head__grid"></div>
    <div class="blog-head__deco">¶</div>
    <div class="wrap blog-head__inner">
      <span class="eyebrow" data-aos="fade-down"><span class="eyebrow-rule"></span><?= $b; ?></span>
      <h1 class="blog-head__h1" data-aos="fade-right"><?= the_title(); ?></h1>
      <p class="blog-head__sub" data-aos="fade-up"><?= get_field('short_description') ?? ''; ?></p>
    </div>
</section>
                    