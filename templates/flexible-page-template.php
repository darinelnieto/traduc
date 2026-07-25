   
<?php
/**
 * 
 * Template Name: flexible-page
 * 
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
get_header();
$term_id = isset( $args['term_id'] ) ? $args['term_id'] : null;
$prefix = $term_id ? 'term_' . $term_id : '';
?>
<main id="flexible-page-template-a5084d">
    <?php
        if ( have_rows( 'flexible_content', $prefix ) ):
            while ( have_rows( 'flexible_content', $prefix ) ): the_row();
                $layout = get_row_layout();
                get_template_part( 'partials/flexible/' . $layout );
            endwhile;
        endif;
    ?>
</main>
<?php get_footer(); ?>