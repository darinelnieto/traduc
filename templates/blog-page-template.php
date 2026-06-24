   
<?php
/**
 * 
 * Template Name: blog-page
 * 
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
get_header();
?>
<main id="blog-page-template-a276d6">
    <?php get_template_part('partials/blog/blog-hero'); ?>
    <?php get_template_part('partials/blog/blog-list'); ?>
    <?php get_template_part('partials/home/cta-band'); ?>
</main>
<?php get_footer(); ?>
                    