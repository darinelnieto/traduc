<?php
// $script_handle = 'content-table-js';
// wp_enqueue_script(
//     $script_handle,
//     get_template_directory_uri() . '/js/partials-min/content-table.min.js',
//     array('jquery'),
//     null,
//     true
// );
/**
 * 
 * Partial Name: content-table
 * 
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
$t_content = get_sub_field('table_section');
if($t_content['table']):
?>
<section class="content-table-partial-b0c8c4 section section--cream">
    <div class="wrap">
        <?php if(!empty($t_content['title'])): ?>
            <h2 class="section__h2"><?= $t_content['title']; ?></h2>
        <?php endif; ?>
        <div class="table-scroll" role="region" aria-label="Tabla con desplazamiento horizontal">
            <table class="table full-width table-striped table-hover">
                <?php if(!empty($t_content['thead'])): ?>
                    <thead>
                        <tr>
                            <?php foreach($t_content['thead'] as $th): ?>
                                <th scope="<?= $th['scope'] ?? 'col'; ?>"><?= $th['th']; ?></th>
                            <?php endforeach; ?>
                        </tr>
                    </thead>
                <?php endif; ?>
                <tbody>
                    <?php foreach($t_content['table'] as $tr): ?>
                        <tr>
                            <?php foreach($tr['tbody'] as $td): ?>
                                <td scope="<?= $td['scope'] ?? 'col'; ?>"><?= $td['td']; ?></td>
                            <?php endforeach; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php if(!empty($t_content['call_to_action'])): $cat = $t_content['call_to_action']; ?>
            <a href="<?= $cat['url']; ?>" target="<?= $cat['target']; ?>" class="call-to-action primary mt-4">
                <?= $cat['title']; ?>
            </a>
        <?php endif; ?>
    </div>
</section>
<?php endif; ?>