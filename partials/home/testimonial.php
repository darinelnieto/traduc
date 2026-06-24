<?php
$script_handle = 'testimonial-js';
wp_enqueue_script(
    $script_handle,
    get_template_directory_uri() . '/js/partials-min/testimonial.min.js',
    array('jquery'),
    null,
    true
);
/**
 * 
 * Partial Name: testimonial
 * 
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
$testimonial = get_field('testimonial_group');
if($testimonial['get_manual'] === true){
    $testimony = $testimonial['testimonial_list'];
}else{
    $posts = new WP_Query(array(
        'post_type' => 'testimonials',
        'post_status' => 'publish',
        'posts_per_page' => 6,
        'order' => 'DESC'
    ));
    $testimony = [];
    if($posts->have_posts()){
        while($posts->have_posts()){
            $posts->the_post();
            $testimony[] = get_the_id();
        }
        wp_reset_postdata();
    }
}
?>
<section class="testimonial-partial-eee8b9 section">
    <div class="section-bignum" style="left:-20px;top:60px">★</div>
    <div class="wrap" style="position:relative">
      <div class="rev in">
        <span class="eyebrow" data-aos="fade-right"><span class="eyebrow-rule"></span><?= $testimonial['label'] ?? ''; ?></span>
        <h2 class="section__h2" data-aos="fade-up"><?= $testimonial['title'] ?? ''; ?></h2>
      </div>
      <div class="testi-grid">
        <?php foreach($testimony as $item): $a = get_field('qualification', $item); ?>
            <div class="testi rev in" data-aos="fade-up">
                <div class="testi__quote-mark">"</div>
                <div class="testi__stars">
                    <?php for($i = 0; $i < $a; $i++ ): ?>★<?php endfor; ?>
                </div>
                <p class="testi__text">"<?= get_field('testmony', $item); ?>"</p>
                <div class="testi__name"><?= get_the_title($item); ?></div>
                <div class="testi__role"><?= get_field('rol', $item); ?></div>
                <div class="testi__badge">
                    <span class="chip <?= get_field('chip', $item) ?? 'chip--med'; ?>"><?= get_field('sector', $item); ?></span>
                </div>
            </div>
        <?php endforeach; ?>
      </div>
    </div>
</section>
                    