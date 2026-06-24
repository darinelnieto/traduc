   
<?php
/**
 * 
 * Template Name: single-blog
 * 
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
get_header();
?>
<main id="single-blog-template-da86d4">
    <?php get_template_part('partials/single-blog/single-blog-hero'); ?>
    <?php get_template_part('partials/single-blog/single-blog-content'); ?>
    <?php get_template_part('partials/blog/blog-list'); ?>
    <?php get_template_part('partials/home/cta-band'); ?>
</main>
<?php get_footer(); ?>
                    