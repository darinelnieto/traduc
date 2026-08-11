<?php
// $script_handle = 'global_hero-js';
// wp_enqueue_script(
//     $script_handle,
//     get_template_directory_uri() . '/js/partials-min/global_hero.min.js',
//     array('jquery'),
//     null,
//     true
// );
/**
 * 
 * Partial Name: global_hero
 * 
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
$hero = get_sub_field('global_hero');
$ctas = $hero['call_to_actions'];
$enable_bg_img = $hero['enable_bg_image'];
if($enable_bg_img === true){
    $bg_img = $hero['banner_image'];
}
?>
<section class="global-hero-partial-549988 hero">
    <div class="wrap head__inner">
        <?php if(!empty($hero['eyebrow'])): ?>
            <span class="eyebrow" data-aos="fade-down"><span class="eyebrow-rule"></span><?= $hero['eyebrow']; ?></span>
        <?php endif; ?>
        <h1 class="head__h1" data-aos="fade-right"><?= $hero['title'] ?? the_title(); ?></h1>
        <p class="head__sub" data-aos="fade-up"><?= $hero['description'] ?? ''; ?></p>
        <?php if(!empty($ctas['main_cta']) || !empty($ctas['secondary_cta'])): ?>
            <ul class="call-to-actions">
                <?php if(!empty($ctas['main_cta'])): ?>
                    <li>
                        <a href="<?= $ctas['main_cta']['url']; ?>" data-aos="fade-right" target="<?= $ctas['main_cta']['target'] ?? '_self'; ?>" class="call-to-action primary">
                            <?= $ctas['main_cta']['title']; ?>
                        </a>
                    </li>
                <?php endif; if(!empty($ctas['secondary_cta'])): ?>
                    <li>
                        <a href="<?= $ctas['secondary_cta']['url']; ?>" data-aos="fade-left" target="<?= $ctas['secondary_cta']['target'] ?? '_self'; ?>" class="call-to-action secondary">
                            <?= $ctas['secondary_cta']['title']; ?>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        <?php endif; if(!empty($hero['secondary_text'])): ?>
            <p class="p-description"><?= $hero['secondary_text']; ?></p>
        <?php endif; ?>
    </div>
    <?= wp_get_attachment_image($bg_img ?? '', 'large', false, array(
        'class' => 'bg-image',
        'loading' => 'eager',
        'fetchpriority' => 'high',
        'decoding' => 'async',
    )) ?>
    <div class="head__grid"></div>
    <div class="head__deco">¶</div>
</section>
                    