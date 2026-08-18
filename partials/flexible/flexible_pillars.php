<?php
// $script_handle = 'flexible_pillars-js';
// wp_enqueue_script(
//     $script_handle,
//     get_template_directory_uri() . '/js/partials-min/flexible_pillars.min.js',
//     array('jquery'),
//     null,
//     true
// );
/**
 * 
 * Partial Name: flexible_pillars
 * 
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
$pillars = get_sub_field('pillars');
?>
<section class="flexible-pillars-partial-297096">
    <div class="section-bignum" style="right:-40px;bottom:-60px">¶</div>
    <div class="wrap" style="position:relative">
        <?php if(!empty($pillars['pillars_items'])): $key = 0; ?>
            <div>
                <?php if(!empty($pillars['label'])): ?>
                    <span class="eyebrow rev in" data-aos="fade-right">
                        <span class="eyebrow-rule"></span>
                        <?= $pillars['label'] ?? ''; ?>
                    </span>
                <?php endif; ?>
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
                    