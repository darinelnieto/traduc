<?php
$script_handle = 'section--cream-js';
wp_enqueue_script(
    $script_handle,
    get_template_directory_uri() . '/js/partials-min/section--cream.min.js',
    array('jquery'),
    null,
    true
);
/**
 * 
 * Partial Name: section--cream
 * 
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
$cream = get_field('cream_group');
if(!empty($cream['process_steps'])):
$steps = $cream['process_steps'];
$key = 0;
?>
<section class="section-cream-partial-e8146e" id="como-funciona" style="overflow:hidden">
    <div class="section-bignum" style="left:-30px;top:40px">04</div>
    <div class="wrap" style="position:relative">
      <div class="rev in">
        <span class="eyebrow" data-aos="fade-right"><span class="eyebrow-rule"></span><?= $cream['eyebrow_rule'] ?? ''; ?></span>
        <h2 class="section__h2" data-aos="fade-right"><?= $cream['title'] ?? ''; ?></h2>
        <p class="section__sub" data-aos="fade-up"><?= $cream['subtitle'] ?? '' ?></p>
      </div>

      <div class="process rev in in-view" id="processBlock">
        <div class="process__track"></div>
        <div class="process__progress"></div>
        <div class="process__steps">
            <?php foreach($steps as $item): $key++; ?>
                <div class="pstep is-done" data-aos="zoom-in">
                    <div class="pstep__node">
                        <div class="pstep__node-ring"></div>
                        <div class="pstep__node-num" data-aos="fade-up">
                            <?= $key < 10 ? '0' . $key : $key; ?>
                        </div>
                        <div class="pstep__node-icon">
                            <?= $item['numb'] ?? '✓'; ?>
                        </div>
                    </div>
                    <span class="pstep__label">
                        <?= $item['label'] ?? ''; ?>
                    </span>
                    <h3 class="pstep__title">
                        <?= $item['item_title'] ?? ''; ?>
                    </h3>
                    <p class="pstep__body">
                        <?= $item['descripton'] ?? ''; ?>
                    </p>
                </div>
            <?php endforeach; ?>
        </div>
      </div>
    </div>
</section>
<?php endif; ?>