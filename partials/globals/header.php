<?php
$script_handle = 'header-js';
$script_version = filemtime(get_template_directory() . '/js/partials-min/header.min.js');
wp_enqueue_script(
    $script_handle,
    get_template_directory_uri() . '/js/partials-min/header.min.js',
    array('jquery'),
    $script_version,
    true
);
/**
 * 
 * Partial Name: header
 * 
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
?>
<div class="header-partial-b3c1ef">
    <div class="container">
        <div class="row justify-content-between align-items-center">
            <div class="col-4 col-md-3 col-lg-2">
                <a href="<?= home_url(); ?>" class="custom-logo">
                    Tradu<span>C</span>.
                </a>
            </div>
            <div class="col-2 d-block d-md-none">
                <button class="bar-menu-movil">
                    <span class="hr top"></span>
                    <span class="hr center"></span>
                    <span class="hr bottom"></span>
                </button>
            </div>
            <nav class="col-8 col-md-9 col-lg-10 header-nav">
                <?php wp_nav_menu([
                    "menu" => "Menu 1",
                ]) ?>
            </nav>
        </div>
    </div>
</div>
                    