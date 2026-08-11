<?php
// $script_handle = 'list-content-js';
// wp_enqueue_script(
//     $script_handle,
//     get_template_directory_uri() . '/js/partials-min/list-content.min.js',
//     array('jquery'),
//     null,
//     true
// );
/**
 * 
 * Partial Name: list-content
 * 
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
$list = get_sub_field('list_section');
if(!empty($list['list'])):
?>
<section class="list-content-partial-c0e7ac section section--cream">
    <div class="wrap">
        <?php if(!empty($list['title'])): ?>
            <h2 class="section__h2" data-aos="fade-up"><?= $list['title']; ?></h2>
        <?php endif; ?>
        <div class="grid">
            <?php foreach($list['list'] as $item): ?>
                <div class="pstep is-done" data-aos="zoom-in">
                    <?php if(!empty($item['label'])): ?>
                        <h3 class="pstep__title">
                            <?= $item['label']; ?>
                        </h3>
                    <?php endif; if(!empty($item['description'])): ?>
                        <p class="pstep__body">
                            <?= $item['description']; ?>
                        </p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</section>
<?php endif; ?>                    