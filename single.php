<?php
/**
 * 
 * Default single.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( 'blog' === get_post_type() ) {
	require get_template_directory() . '/templates/single-blog-template.php';
	return;
}
?>