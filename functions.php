<?php
function sajo_cache_version() {
  $version = get_option('sajo_cache_version');
  if (!$version) {
    $version = (string) time();
    update_option('sajo_cache_version', $version, false);
  }
  return (string) $version;
}

function sajo_register_partial_script($file) {
    $partial = basename($file, '.php');
    $js_file = get_template_directory() . "/js/partials-min/{$partial}.min.js";
    $js_url  = get_template_directory_uri() . "/js/partials-min/{$partial}.min.js";

    if (file_exists($js_file)) {
        // Cargar siempre en el footer
        add_action('wp_footer', function() use ($partial, $js_url) {
        wp_enqueue_script("partial-{$partial}", $js_url, [], sajo_cache_version(), true);
        wp_script_add_data("partial-{$partial}", 'strategy', 'defer');
        });
    }
}

if ( ! defined( 'ABSPATH' ) ) {
  exit; // Exit if accessed directly.
}

/**
 * Register Theme Styles
 * https://developer.wordpress.org/reference/hooks/wp_enqueue_scripts/
 */
function sajo_styles() {
  $ver = sajo_cache_version();
  wp_enqueue_style( 'core', get_template_directory_uri() . '/style.css', array(), $ver );
  wp_enqueue_style( 'main-styles', get_template_directory_uri() . '/css/main.bundle.css', array(), $ver );
  wp_enqueue_style( 'bootstrap.css', get_template_directory_uri() . '/css/bootstrap.min.css', array(), $ver );
  wp_enqueue_style('owl-carousel.css', get_template_directory_uri() . '/css/owl.carousel.min.css', array(), $ver);
  // wp_enqueue_style('font-awesome.css', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css');
}
add_action('wp_enqueue_scripts', 'sajo_styles');

function sajo_defer_noncritical_styles($html, $handle, $href, $media) {
  if (is_admin()) return $html;

  $non_critical = array('bootstrap.css', 'owl-carousel.css');
  $is_google_fonts = strpos($href, 'fonts.googleapis.com') !== false;

  if (!$is_google_fonts && !in_array($handle, $non_critical, true)) {
    return $html;
  }

  return '<link rel="preload" as="style" href="' . esc_url($href) . '" onload="this.onload=null;this.rel=\'stylesheet\'">'
    . '<noscript><link rel="stylesheet" href="' . esc_url($href) . '"></noscript>';
}
add_filter('style_loader_tag', 'sajo_defer_noncritical_styles', 10, 4);

/**
 * Register Theme Scripts
 * https://developer.wordpress.org/reference/hooks/wp_enqueue_scripts/
 */
function sajo_scripts() {
  $ver = sajo_cache_version();
  wp_enqueue_script('jquery');
  wp_enqueue_script( 'main-scripts', get_template_directory_uri() . '/js/main.bundle.js', array( 'jquery' ), $ver, true );
  // wp_enqueue_script('font-awesome.js', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/js/all.min.js', array(), null, true);
  wp_enqueue_script( 'bootstrap.js', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ), $ver, true );
  wp_enqueue_script('owl-carousel.js', get_template_directory_uri() . '/js/owl.carousel.min.js', array('jquery'), $ver, true);

  wp_script_add_data('jquery', 'strategy', 'defer');
  wp_script_add_data('main-scripts', 'strategy', 'defer');
  wp_script_add_data('bootstrap.js', 'strategy', 'defer');
  wp_script_add_data('owl-carousel.js', 'strategy', 'defer');

  $inline_js = 'const _sajoURI_ = "' . esc_js(get_template_directory_uri()) . '", _sajoURL_ = "' . esc_js(get_site_url()) . '";';
  wp_add_inline_script('main-scripts', $inline_js, 'before');
}
add_action('wp_enqueue_scripts', 'sajo_scripts');

function sajo_defer_noncritical_scripts($tag, $handle, $src) {
  if (is_admin()) return $tag;

  $defer_handles = array('jquery', 'main-scripts', 'bootstrap.js', 'owl-carousel.js');
  $is_partial = strpos($handle, 'partial-') === 0;
  $is_partial_src = strpos((string) $src, '/js/partials-min/') !== false;

  if (!$is_partial && !$is_partial_src && !in_array($handle, $defer_handles, true)) {
    return $tag;
  }

  if (strpos($tag, ' defer') !== false) {
    return $tag;
  }

  return str_replace('<script ', '<script defer ', $tag);
}
add_filter('script_loader_tag', 'sajo_defer_noncritical_scripts', 10, 3);

function sajo_resource_hints($urls, $relation_type) {
  if ('preconnect' !== $relation_type) return $urls;

  $urls[] = array('href' => 'https://fonts.googleapis.com');
  $urls[] = array('href' => 'https://fonts.gstatic.com', 'crossorigin' => 'anonymous');
  return $urls;
}
add_filter('wp_resource_hints', 'sajo_resource_hints', 10, 2);

/**
 * Register Navigation Menus
 * https://developer.wordpress.org/reference/functions/register_nav_menus/
 */
function sajo_navigation_menus() {
  $locations = array(
    'main_menu' => __( 'Main Menu', 'text_domain' )
  );
  register_nav_menus( $locations );
}
add_action( 'init', 'sajo_navigation_menus' );

/**
 * Theme support
 * https://developer.wordpress.org/reference/functions/add_theme_support/
 */
add_theme_support( 'custom-logo' );

/**
 * Install latest jQuery version 3.5.1
 */
function sajo_register_jquery() {
  if (!is_admin()) {
    wp_deregister_script('jquery');
    wp_register_script('jquery', get_template_directory_uri() . '/js/jquery-3.5.1.min.js', array(), sajo_cache_version(), true);
  }
}
add_action('wp_enqueue_scripts', 'sajo_register_jquery', 1);

function sajo_clear_cache_integrations() {
  if (function_exists('wp_cache_flush')) {
    wp_cache_flush();
  }
  if (function_exists('rocket_clean_domain')) {
    rocket_clean_domain();
  }
  if (function_exists('w3tc_flush_all')) {
    w3tc_flush_all();
  }
  if (function_exists('wpfc_clear_all_cache')) {
    wpfc_clear_all_cache();
  }
  if (function_exists('sg_cachepress_purge_everything')) {
    sg_cachepress_purge_everything();
  }
  if (function_exists('do_action')) {
    do_action('litespeed_purge_all');
  }
}

function sajo_cache_menu() {
  add_theme_page(
    'Sajo Cache',
    'Sajo Cache',
    'manage_options',
    'sajo-cache',
    'sajo_cache_page'
  );
}
add_action('admin_menu', 'sajo_cache_menu');

function sajo_cache_page() {
  if (!current_user_can('manage_options')) return;

  $cleared = false;
  if (
    isset($_POST['sajo_clear_cache']) &&
    isset($_POST['sajo_cache_nonce']) &&
    wp_verify_nonce($_POST['sajo_cache_nonce'], 'sajo_clear_cache_action')
  ) {
    update_option('sajo_cache_version', (string) time(), false);
    sajo_clear_cache_integrations();
    $cleared = true;
  }

  $version = sajo_cache_version();
  ?>
  <div class="wrap">
    <h1>Sajo Cache</h1>
    <?php if ($cleared) : ?>
      <div class="notice notice-success is-dismissible"><p>Cache limpiada correctamente.</p></div>
    <?php endif; ?>
    <p>Version actual de assets: <strong><?php echo esc_html($version); ?></strong></p>
    <form method="post">
      <?php wp_nonce_field('sajo_clear_cache_action', 'sajo_cache_nonce'); ?>
      <input type="hidden" name="sajo_clear_cache" value="1">
      <button type="submit" class="button button-primary">Limpiar cache</button>
    </form>
  </div>
  <?php
}

// Options page
if (function_exists('acf_add_options_page')){
  acf_add_options_page(array(
    'page_title'    => 'Theme Settings',
    'menu_title'    => 'Theme Settings',
    'menu_slug'     => 'theme-settings',
    'capability'    => 'edit_posts',
    'redirect'      =>  true
  ));
  acf_add_options_sub_page(array(
    'page_title'     => 'Globals styles',
    'menu_title'     => 'Globals styles',
    'parent_slug'   => 'theme-settings',
  ));
  acf_add_options_sub_page(array(
    'page_title'     => 'HubSpot form',
    'menu_title'     => 'HubSpot form',
    'parent_slug'   => 'theme-settings',
  ));
  acf_add_options_sub_page(array(
    'page_title'     => 'Footer',
    'menu_title'     => 'Footer',
    'parent_slug'   => 'theme-settings',
  ));
  acf_add_options_sub_page(array(
    'page_title'     => 'SEO',
    'menu_title'     => 'SEO',
    'parent_slug'   => 'theme-settings',
  ));
}
// Testimonials
add_theme_support('post-thumbnails');
add_post_type_support( 'testimonials', 'thumbnail' );
function services_post(){
  /*====== Argument post type =====*/
  $services = array(
    'public' => true,
    'has_archive' => true,
    'label'  => 'Testimonials',
    'menu_icon' => 'dashicons-star-filled',
    'supports' => ['title', 'editor', 'thumbnail'],
  );
  /*============ Register post type ============*/
  register_post_type('testimonials', $services);
}
add_action('init', 'services_post', 3);
// blog
add_theme_support('post-thumbnails');
add_post_type_support( 'services', 'thumbnail' );
function blog_post(){
  /*====== Argument post type =====*/
  $services = array(
    'public' => true,
    'has_archive' => true,
    'label'  => 'Blog',
    'menu_icon' => 'dashicons-megaphone',
    'supports' => ['title', 'editor', 'thumbnail'],
  );
  /*============ Register post type ============*/
  register_post_type('blog', $services);
  /*============ Argument taxonimy ============*/
   $labels = array(
    'name' => _x('Blog category', 'taxonomy general name'),
    'singular_name' => _x('Blog category', 'taxonomy singular name'),
    'search_items' =>  __('Search Blog category'),
    'all_items' => __('All Blog category'),
    'parent_item' => __('Parent Blog category'),
    'parent_item_colon' => __('Parent Blog category:'),
    'edit_item' => __('Edit Blog category'),
    'update_item' => __('Update Blog category'),
    'add_new_item' => __('Add New Blog category'),
    'new_item_name' => __('New Blog category Name'),
    'menu_name' => __('Blog category'),
  );
  /*========== Register taxonomi ==========*/
  register_taxonomy('blog_cat', array('blog'), array(
    'hierarchical' => true,
    'labels' => $labels,
    'show_ui' => true,
    'show_in_rest' => true,
    'show_admin_column' => true,
    'query_var' => true,
    'rewrite' => array('slug' => 'blog_cat'),
  ));
}
add_action('init', 'blog_post', 3);