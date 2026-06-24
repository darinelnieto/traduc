<?php
// $script_handle = 'section-services-js';
// wp_enqueue_script(
//     $script_handle,
//     get_template_directory_uri() . '/js/partials-min/section-services.min.js',
//     array('jquery'),
//     null,
//     true
// );
/**
 * 
 * Partial Name: section-services
 * 
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
$services = get_field('services_group');
$top = $services['top_content'];
$service_list = $services['services'];
if($service_list):
$key = 0;
?>
<section class="section-services-partial-0884b5" id="servicios" style="overflow:hidden;position:relative">
    <div class="section-bignum" style="right:-50px;top:0">02</div>
    <div class="wrap" style="position:relative">
      <div class="rev in">
        <span class="eyebrow" data-aos="fade-right"><span class="eyebrow-rule"></span><?= $top['eyebrow'] ?? ''; ?></span>
        <h2 class="section__h2" data-aos="fade-right"><?= $top['title'] ?? ''; ?></h2>
        <p class="section__sub" data-aos="fade-up"><?= $top['subtitle'] ?? ''; ?></p>
      </div>
      <div class="services-grid">
        <?php foreach($service_list as $item): $key++; ?>
            <div class="service-card <?= $item['card_style'] ?? 'service-card--med rev in'; ?>" data-aos="fade-up">
            <div class="service-card__header">
                <span class="
                    chip 
                    <?php if($item['card_style'] === 'service-card--med rev in'): ?>chip--med<?php elseif($item['card_style'] === 'service-card--leg rev rev-d1 in'): ?>chip--leg<?php elseif($item['card_style'] === 'service-card--cert rev rev-d2'): ?>chip--verde<?php else: ?>chip--verde<?php endif; ?>">
                    <?= $item['chip'] ?? ''; ?>
                </span>
                <div class="service-card__num"><?= $key < 10 ? '0' . $key : $key; ?></div>
            </div>
            <div class="service-card__content">
                <h3 class="service-card__title"><?= $item['title'] ?? ''; ?></h3>
                <p class="service-card__body"><?= $item['description'] ?? ''; ?></p>
                <?php if(!empty($item['list'])): ?>
                    <ul class="service-card__list">
                        <?php foreach($item['list'] as $li):  ?>
                            <li><?= $li['item']; ?></li>
                        <?php endforeach ?>
                    </ul>
                <?php endif; if(!empty($item['call_to_action'])): $cta = $item['call_to_action']; ?>
                    <div class="service-card__cta">
                        <a href="<?= $cta['url'] ?? '#contacto'; ?>" target="<?= $cta['target'] ?? '_self'; ?>" class="btn btn--outline btn-arrow">
                            <?= $cta['title'] ?? 'Solicitar este servicio' ?>
                        </a>
                    </div>
                <?php endif; ?>
            </div>
            </div>
        <?php endforeach; ?>
      </div>
    </div>
</section>
<?php endif; ?>