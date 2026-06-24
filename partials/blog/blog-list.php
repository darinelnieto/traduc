<?php
$script_handle = 'blog-list-js';
wp_enqueue_script(
    $script_handle,
    get_template_directory_uri() . '/js/partials-min/blog-list.min.js',
    array('jquery'),
    null,
    true
);
/**
 * 
 * Partial Name: blog-list
 * 
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

$post_type = get_query_var('post_type');
if (is_array($post_type)) {
    $post_type = reset($post_type);
}
if (empty($post_type)) {
    $post_type = 'post';
}

$blog_query = new WP_Query(array(
    'post_type' => $post_type,
    'post_status' => 'publish',
    'posts_per_page' => -1,
    'orderby' => 'date',
    'order' => 'DESC',
));

$slide_variants = array(
    array('slide' => 'slide--med', 'chip' => 'chip--med'),
    array('slide' => 'slide--leg', 'chip' => 'chip--leg'),
    array('slide' => 'slide--cert', 'chip' => 'chip--verde'),
);

?>
<section class="blog-list-partial-aca656">
    <div class="wrap">
        <div class="carousel" id="carousel" data-aos="fade-up">
            <div class="carousel__viewport">
                <div class="carousel__track" id="track">
                <?php if ($blog_query->have_posts()) : $i = 0; ?>
                    <?php while ($blog_query->have_posts()) : $blog_query->the_post();
                        $variant = $slide_variants[$i % count($slide_variants)];
                        $terms = get_the_terms(get_the_ID(), 'blog_cat');
                        if (empty($terms) || is_wp_error($terms)) {
                            $terms = get_the_terms(get_the_ID(), 'services_cat');
                        }

                        $term = (!empty($terms) && !is_wp_error($terms)) ? reset($terms) : null;
                        $chip_text = $term ? $term->name : 'Blog';
                        $chip_color = $term ? get_field('chip_color', 'term_' . $term->term_id) : '';
                        $chip_color_class = !empty($chip_color)
                            ? sanitize_html_class($chip_color)
                            : $variant['chip'];
                        $excerpt = get_field('short_description');
                        if (empty($excerpt)) {
                            $excerpt = wp_trim_words(get_the_content(), 34, '...');
                        }
                        $published_ago = human_time_diff(get_the_time('U'), current_time('timestamp'));
                        $reading_time = 'hace ' . $published_ago;
                        $image_id = get_post_thumbnail_id();
                    ?>
                    <article class="slide <?= $variant['slide']; ?>">
                        <div class="slide__body">
                            <span class="chip <?= $chip_color_class; ?>"><?php echo esc_html($chip_text); ?></span>
                            <h2 class="slide__title"><?= the_title(); ?></h2>
                            <p class="slide__excerpt"><?= $excerpt; ?></p>
                            <div class="slide__cta"><a href="<?= the_permalink(); ?>" class="btn btn--terra btn-arrow">Leer artículo</a></div>
                            <div class="slide__meta"><span><?= get_the_date('j M Y'); ?></span><span class="dot"></span><span><?php echo esc_html($reading_time); ?></span></div>
                        </div>
                        <div class="slide__panel">
                            <span class="slide__index"><?= str_pad((string) ($i + 1), 2, '0', STR_PAD_LEFT); ?></span>
                            <?php if ($image_id) : ?>
                                <?= wp_get_attachment_image($image_id, 'large', false, array('class' => 'slide__cover')); ?>
                            <?php endif; ?>
                        </div>
                    </article>
                    <?php $i++; endwhile; wp_reset_postdata(); ?>
                <?php else : ?>
                    <article class="slide slide--med">
                        <div class="slide__body">
                            <span class="chip chip--med">Blog</span>
                            <h2 class="slide__title">Pronto publicaremos nuevos artículos</h2>
                            <p class="slide__excerpt">Aún no hay contenido publicado en esta sección.</p>
                        </div>
                    </article>
                <?php endif; ?>
                </div>
            </div>

            <div class="carousel__nav">
                <span class="carousel__count" id="count"><strong>01</strong><em> / 01</em></span>
                <div class="carousel__progress"><span id="progress"></span></div>
                <div class="carousel__btns">
                <button class="carousel__arrow" id="prev" aria-label="Anterior">←</button>
                <button class="carousel__arrow" id="next" aria-label="Siguiente">→</button>
                </div>
            </div>
        </div>
    </div>
</section>
                    