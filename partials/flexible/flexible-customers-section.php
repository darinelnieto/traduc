<?php
// $script_handle = 'flexible-customers-section-js';
// wp_enqueue_script(
//     $script_handle,
//     get_template_directory_uri() . '/js/partials-min/flexible-customers-section.min.js',
//     array('jquery'),
//     null,
//     true
// );
/**
 * 
 * Partial Name: flexible-customers-section
 * 
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
$custmers = get_sub_field('customers_group');
$c_list = $custmers['customer_list'];
if(!empty($c_list)):
?>
<section class="flexible-customers-section-partial-cefff8">
    <div class="wrap">
        <div class="rev in">
            <?php if(!empty($custmers['label'])): ?>
                <span class="eyebrow" data-aos="fade-right">
                    <span class="eyebrow-rule"></span>
                    <?= $custmers['label']; ?>
                </span>
            <?php endif; if(!empty($custmers['title'])): ?>
                <h2 class="section__h2" data-aos="fade-right"><?= $custmers['title']; ?></h2>
            <?php endif; if(!empty($custmers['subtitle'])): ?>
                <p class="section__sub" data-aos="fade-up"><?= $custmers['subtitle']; ?></p>
            <?php endif; ?>
        </div>
        <div class="customers-grid">
            <?php foreach($c_list as $item): ?>
                <div class="item-img">
                    <?php if(!empty($item['link'])): ?>
                        <a href="<?= $item['link']['url']; ?>" target="_blank">
                            <?= wp_get_attachment_image($item['image'] ?? '', 'large', false, array(
                                'class' => 'customer-logo',
                                'loading' => 'lazy',
                                'decoding' => 'async',
                                'data-aos' =>"zoom-in"
                            )) ?>
                        </a>
                    <?php else: ?>
                        <?= wp_get_attachment_image($item['image'] ?? '', 'large', false, array(
                            'class' => 'customer-logo',
                            'loading' => 'lazy',
                            'decoding' => 'async',
                            'data-aos' =>"zoom-in"
                        )) ?>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>