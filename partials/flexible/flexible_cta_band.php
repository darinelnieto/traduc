<?php
// $script_handle = 'flexible_cta_band-js';
// wp_enqueue_script(
//     $script_handle,
//     get_template_directory_uri() . '/js/partials-min/flexible_cta_band.min.js',
//     array('jquery'),
//     null,
//     true
// );
/**
 * 
 * Partial Name: flexible_cta_band
 * 
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
$band = get_sub_field('cta_band_group');

if (empty($band)) {
    $posts_page_id = (int) get_option('page_for_posts');
    if ($posts_page_id > 0) {
        $band = get_sub_field('cta_band_group', $posts_page_id);
    }
}
?>
<section class="flexible-cta-band-partial-f9847c">
    <div class="wrap">
      <div class="cta-band rev in" data-aos="fade-up">
        <div class="cta-band__left">
            <?php if(!empty($band['title'])): ?>
                <h2 class="cta-band__h2" data-aos="fade-right"><?= $band['title']; ?></h2>
            <?php endif; if(!empty($band['intro'])): ?>
            <p class="cta-band__sub" data-aos="fade-right"><?= $band['intro']; ?></p>
            <?php endif; ?>
        </div>
        <?php if(!empty($band['link'])): ?>
            <div class="cta-band__right" data-aos="fade-left">
                <a href="<?= $band['link']['url']; ?>" target="<?= $band['link']['target'] ?? '_self'; ?>" class="btn btn--terra btn--lg btn-arrow"><?= $band['link']['title'] ?? 'Solicitar cotización'; ?></a>
            </div>
        <?php endif; ?>
      </div>
    </div>
</section>
                    