<?php
// $script_handle = 'section-sm-js';
// wp_enqueue_script(
//     $script_handle,
//     get_template_directory_uri() . '/js/partials-min/section-sm.min.js',
//     array('jquery'),
//     null,
//     true
// );
/**
 * 
 * Partial Name: section-sm
 * 
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
$manifest = get_field('manifest_content')
?>
<section class="section-sm-partial-cca987">
    <div class="wrap" data-aos="fade-up">
      <div class="manifesto-block rev in">
        <p class="manifesto-block__text" data-aos="fade-right"><?= $manifest['description'] ?? ''; ?></p>
        <p class="manifesto-block__attr" data-aos="fade-right"><?= $manifest['attr'] ?? ''; ?></p>
      </div>
    </div>
</section>
                    