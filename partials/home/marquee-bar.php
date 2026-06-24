<?php
// $script_handle = 'marquee-bar-js';
// wp_enqueue_script(
//     $script_handle,
//     get_template_directory_uri() . '/js/partials-min/marquee-bar.min.js',
//     array('jquery'),
//     null,
//     true
// );
/**
 * 
 * Partial Name: marquee-bar
 * 
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
$marquee = get_field('marquee_bar_content');
if(!empty($marquee)):
?>
<section class="marquee-bar-partial-15e65e">
    <div class="marquee-bar" aria-hidden="true">
        <div class="marquee">
            <?php foreach($marquee as $item): ?>
                <div class="marquee-item">
                    <?= $item['item']; ?>
                    <span class="marquee-sep"></span>
                </div>
            <?php endforeach; ?>
            <?php foreach($marquee as $item): ?>
                <div class="marquee-item">
                    <?= $item['item']; ?>
                    <span class="marquee-sep"></span>
                </div>
            <?php endforeach; ?>
        </div>
  </div>
</section>
<?php endif; ?>      