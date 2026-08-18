<?php
$script_handle = 'faqs-js';
wp_enqueue_script(
    $script_handle,
    get_template_directory_uri() . '/js/partials-min/faqs.min.js',
    array('jquery'),
    null,
    true
);
/**
 * 
 * Partial Name: flexible_faqs
 * 
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
$faqs = get_sub_field('faqs_group');
if(!empty($faqs['faqs_list'])):
?>
<section class="flexible-faqs-partial-c03907 section">
    <div class="section-bignum" style="right:-20px;top:40px">?</div>
    <div class="wrap" style="position:relative">
        <div class="rev in">
            <?php if(!empty($faqs['eyebrow'])): ?>
                <span class="eyebrow" data-aos="fade-right">
                    <span class="eyebrow-rule"></span>
                    <?= $faqs['eyebrow']; ?>
                </span>
            <?php endif; if(!empty($faqs['title'])): ?>
                <h2 class="section__h2" data-aos="fade-right"><?= $faqs['title']; ?></h2>
            <?php endif; ?>
        </div>
        <div class="faq-list rev in">
            <?php foreach($faqs['faqs_list'] as $item): ?>
                <div class="faq-item" data-aos="fade-up">
                    <button class="faq-q" onclick="toggleFaq(this)"><?= $item['ask']; ?><span class="faq-icon">+</span></button>
                    <div class="faq-a">
                        <div class="faq-a__inner"><?= $item['answer']; ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>