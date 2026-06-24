<?php
// $script_handle = 'metricas-js';
// wp_enqueue_script(
//     $script_handle,
//     get_template_directory_uri() . '/js/partials-min/metricas.min.js',
//     array('jquery'),
//     null,
//     true
// );
/**
 * 
 * Partial Name: metricas
 * 
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
$metrics = get_field('metrics_group');
if(!empty($metrics)):
?>
<section class="metricas-partial-8091d3">
    <div class="wrap">
        <div class="metrics rev in" data-aos="fade-up">
            <?php foreach($metrics as $item): ?>
                <div class="metric">
                    <div class="metric__num">
                        <?= $item['num'] ?? ''; ?>
                    </div>
                    <p class="metric__label"><?= $item['label'] ?? ''; ?></p>
                    <p class="metric__sub"><?= $item['label'] ?? ''; ?></p>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif ?>   