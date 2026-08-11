<?php
// $script_handle = 'manifest-content-js';
// wp_enqueue_script(
//     $script_handle,
//     get_template_directory_uri() . '/js/partials-min/manifest-content.min.js',
//     array('jquery'),
//     null,
//     true
// );
/**
 * 
 * Partial Name: manifest-content
 * 
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
$manifest = get_sub_field('manifest_content');
?>
<section class="home-marquee-bar-partial-03a0a5">
    <div class="wrap" data-aos="fade-up">
      <div class="manifesto-block rev in">
        <h2 class="manifesto-block__text" data-aos="fade-right"><?= $manifest['title'] ?? ''; ?></h2>
        <p class="manifesto-block__attr" data-aos="fade-right"><?= $manifest['description'] ?? ''; ?></p>
      </div>
    </div>
</section>
                    