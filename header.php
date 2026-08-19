<?php
/**
 * 
 * Header.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
?>
<!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title><?php wp_title('|', true, 'right'); ?> <?php bloginfo('name'); ?></title>
  <meta name="description" content="">
  <?php 
    $custom_metadatos = get_field('metadatos', 'option');
    if(!empty($custom_metadatos)): foreach($custom_metadatos as $metadato):
  ?>
    <?= $metadato['item']; ?>
  <?php endforeach; endif; ?>
  <meta name="author" content="TraduC">
  <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
  <?php wp_head(); ?>
  <?php if ( have_rows('json_ld_scripts', 'option') ) : ?>
    <?php while ( have_rows('json_ld_scripts', 'option') ) : the_row(); ?>
      <?php
        $json_ld_item = get_sub_field('item', false);
        if ( empty($json_ld_item) ) {
          continue;
        }
        $json_ld_item = preg_replace('/^\s*<p>\s*(<script\b[\s\S]*?<\/script>)\s*<\/p>\s*$/i', '$1', $json_ld_item);
      ?>
      <?= $json_ld_item; ?>
    <?php endwhile; ?>
  <?php endif; ?>
  <?php if ( have_rows('json_ld_scripts_individual') ) : ?>
    <?php while ( have_rows('json_ld_scripts_individual') ) : the_row(); ?>
      <?php
        $json_ld_item = get_sub_field('item', false);
        if ( empty($json_ld_item) ) {
          continue;
        }
        $json_ld_item = preg_replace('/^\s*<p>\s*(<script\b[\s\S]*?<\/script>)\s*<\/p>\s*$/i', '$1', $json_ld_item);
      ?>
      <?= $json_ld_item; ?>
    <?php endwhile; ?>
  <?php endif; ?>
</head>

<body <?php body_class(); ?>>
<?php $analityc ?>
<div id="page"> <!-- +Page container -->

  <header id="header-wrapper" class="<?php if(is_front_page() === true): ?>home<?php endif; ?>">
    <?php get_template_part('/partials/globals/header'); ?>
  </header>