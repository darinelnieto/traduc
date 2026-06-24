<?php
/**
 * 
 * Default archive.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$post_type = get_query_var( 'post_type' );
if ( is_array( $post_type ) ) $post_type = reset( $post_type );

if ( empty( $post_type ) && is_post_type_archive() ) {
	$archive_obj = get_queried_object();
	$post_type = ! empty( $archive_obj->name ) ? $archive_obj->name : '';
}

$templates_by_post_type = array(
	'blog' => 'templates/blog-page-template.php',
);

$templates_by_post_type = apply_filters( 'sajo_archive_templates_by_post_type', $templates_by_post_type );

if ( ! empty( $post_type ) ) {
	$template = isset( $templates_by_post_type[ $post_type ] )
		? $templates_by_post_type[ $post_type ]
		: 'templates/' . $post_type . '-page-template.php';

	if ( locate_template( $template, false, false ) ) {
		locate_template( $template, true, true );
		return;
	}
}

locate_template( 'index.php', true, true );

?>