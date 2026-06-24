<?php
// $script_handle = 'blog-hero-js';
// wp_enqueue_script(
//     $script_handle,
//     get_template_directory_uri() . '/js/partials-min/blog-hero.min.js',
//     array('jquery'),
//     null,
//     true
// );
/**
 * 
 * Partial Name: blog-hero
 * 
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
$hero = get_field('hero_blog');
if (empty($band)) {
    $posts_page_id = (int) get_option('page_for_posts');
    if ($posts_page_id > 0) {
        $hero = get_field('hero_blog', $posts_page_id);
    }
}
?>
<section class="blog-hero-partial-aaf252 blog-hero">
    <div class="blog-head__grid"></div>
    <div class="blog-head__deco">¶</div>
    <div class="wrap blog-head__inner">
      <span class="eyebrow" data-aos="fade-down"><span class="eyebrow-rule"></span><?= $hero['eyebrow'] ?? ''; ?></span>
      <h1 class="blog-head__h1" data-aos="fade-right"><?= $hero['title'] ?? the_title(); ?></h1>
      <p class="blog-head__sub" data-aos="fade-up"><?= $hero['description'] ?? ''; ?></p>
    </div>
</section>
                    