<?php
// $script_handle = 'single-blog-content-js';
// wp_enqueue_script(
//     $script_handle,
//     get_template_directory_uri() . '/js/partials-min/single-blog-content.min.js',
//     array('jquery'),
//     null,
//     true
// );
/**
 * 
 * Partial Name: single-blog-content
 * 
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

$terms = get_the_terms(get_the_ID(), 'blog_cat');
if (empty($terms) || is_wp_error($terms)) {
  $terms = get_the_terms(get_the_ID(), 'services_cat');
}

$term = (!empty($terms) && !is_wp_error($terms)) ? reset($terms) : null;
$chip_text = $term ? $term->name : '';
$chip_color = $term ? get_field('chip_color', 'term_' . $term->term_id) : '';
$published_date = get_the_date('j M Y');
$published_ago = human_time_diff(get_the_time('U'), current_time('timestamp'));
$content = apply_filters('the_content', get_the_content());
$toc_items = array();

$content = preg_replace_callback('/<img[^>]*>/i', static function ($matches) {
  $img_tag = $matches[0];
  $attachment_id = 0;

  if (preg_match('/wp-image-(\d+)/', $img_tag, $class_match)) {
    $attachment_id = (int) $class_match[1];
  } elseif (preg_match('/data-id=["\'](\d+)["\']/', $img_tag, $data_id_match)) {
    $attachment_id = (int) $data_id_match[1];
  }

  if (!$attachment_id) {
    return $img_tag;
  }

  $class_name = '';
  if (preg_match('/class=["\']([^"\']+)["\']/', $img_tag, $class_attr_match)) {
    $class_name = $class_attr_match[1];
  }

  $alt_text = get_post_meta($attachment_id, '_wp_attachment_image_alt', true);

  return wp_get_attachment_image($attachment_id, 'full', false, array(
    'class' => $class_name,
    'loading' => 'lazy',
    'decoding' => 'async',
    'alt' => $alt_text,
  ));
}, $content);

$used_heading_ids = array();
$content = preg_replace_callback('/<h([2-6])([^>]*)>(.*?)<\/h\1>/is', static function ($matches) use (&$toc_items, &$used_heading_ids) {
  $level = (int) $matches[1];
  $attrs = $matches[2];
  $inner_html = $matches[3];
  $heading_text = trim(wp_strip_all_tags($inner_html));

  if ($heading_text === '') {
    return $matches[0];
  }

  $heading_id = '';
  if (preg_match('/\sid=["\']([^"\']+)["\']/i', $attrs, $id_match)) {
    $heading_id = $id_match[1];
  }

  if ($heading_id === '') {
    $heading_id = sanitize_title($heading_text);
  }

  if ($heading_id === '') {
    $heading_id = 'section';
  }

  $base_id = $heading_id;
  $suffix = 2;
  while (in_array($heading_id, $used_heading_ids, true)) {
    $heading_id = $base_id . '-' . $suffix;
    $suffix++;
  }
  $used_heading_ids[] = $heading_id;

  $toc_items[] = array(
    'id' => $heading_id,
    'text' => $heading_text,
    'level' => $level,
  );

  $attrs_without_id = preg_replace('/\sid=["\'][^"\']+["\']/i', '', $attrs);

  return '<h' . $level . $attrs_without_id . ' id="' . esc_attr($heading_id) . '">' . $inner_html . '</h' . $level . '>';
}, $content);
?>
<section class="single-blog-content-partial-06587d">
    <div class="wrap proto-grid">
      <article class="proto-article" data-aos="fade-up">
        <div class="proto-cover-wrap">
          <?php if ( has_post_thumbnail() ) : ?>
            <?php the_post_thumbnail('large', array(
                'class' => 'proto-cover',
                'fetchpriority' => 'high',
                'decoding' => 'async',
            )); ?>
          <?php endif; ?>
          <?php if ($term) : ?>
            <div class="proto-cover-meta">
              <span class="chip <?= $chip_color; ?>"><?= $chip_text; ?></span>
            </div>
          <?php endif; ?>
        </div>
        <div class="proto-content">
          <div class="proto-meta">
            <span><?= $published_date; ?></span>
            <span class="dot"></span>
            <span>hace <?= $published_ago; ?></span>
          </div>
          <div class="content">
            <?= $content; ?>
          </div>
        </div>
      </article>

      <aside class="proto-side" data-aos="fade-up">
        <div class="proto-card">
          <h3>Tabla de contenidos</h3>
          <ol class="proto-list">
            <?php if (!empty($toc_items)) : ?>
              <?php foreach ($toc_items as $toc_item) : ?>
                <li>
                  <a href="#<?= $toc_item['id']; ?>"><?= $toc_item['text']; ?></a>
                </li>
              <?php endforeach; ?>
            <?php endif; ?>
          </ol>
        </div>
      </aside>
    </div>
</section>
                    