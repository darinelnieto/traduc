   
<?php
/**
 * 
 * Template Name: traduc-page
 * 
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
get_header();
?>
<main id="traduc-page-template-bcc979">
    <?php get_template_part( 'partials/home/hero' ); ?>
    <?php get_template_part('partials/home/marquee-bar'); ?>
    <?php get_template_part('partials/home/section-sm'); ?>
    <?php get_template_part('partials/home/section--cream'); ?>
    <?php get_template_part('partials/home/section-services'); ?>
    <?php get_template_part('partials/home/metricas'); ?>
    <?php get_template_part('partials/home/about'); ?>
    <?php get_template_part('partials/home/testimonial'); ?>
    <?php get_template_part('partials/home/contact'); ?>
    <?php get_template_part('partials/home/faqs'); ?>
    <?php get_template_part('partials/home/cta-band'); ?>
</main>
<?php get_footer(); ?>
                    