<?php
$script_handle = 'footer-js';
wp_enqueue_script(
  $script_handle,
  get_template_directory_uri() . '/js/partials-min/footer.min.js',
  array('jquery'),
  null,
  true
);
/**
 * 
 * Partial Name: footer
 * 
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
$logo = get_field('logo', 'option');
$nav_menu = get_field('nav_menu', 'option');
$intro = get_field('intro', 'option');
$copy = get_field('copyright', 'option');
$brand = get_field('brand', 'option');
$cta = get_field('sticky_link', 'option');
?>
<section class="footer-partial-aaa9ba">
    <div class="wrap">
      <div class="footer__grid">
        <div>
          <div class="footer__logo"><?= $logo ?? ''; ?></div>
          <p class="footer__tagline"><?= $intro ?? ''; ?></p>
          <a href="<?= $cta['url'] ?? '#contacto'; ?>" class="btn btn--terra" style="font-size:13px;padding:10px 20px">
            <?= $cta['title'] ?? 'Solicitar cotización'; ?> →
          </a>
        </div>
        <?php if(!empty($nav_menu)): foreach($nav_menu as $item): ?>
            <div>
            <div class="footer__col-title"><?= $item['label'] ?? '' ?></div>
                <ul class="footer__links">
                <?php foreach($item['links'] as $li): ?>
                    <li>
                        <a href="<?= $li['link']['url']; ?>" target="<?= $li['link']['target'] ?? '_self'; ?>">
                            <?= $li['link']['title'] ?? 'Inicio'; ?>
                        </a>
                    </li>
                <?php endforeach; ?>
                </ul>
            </div>
        <?php endforeach; endif; ?>
      </div>
      <div class="footer__divider"></div>
      <div class="footer__bottom">
        <p class="footer__copy">© 2026 TraduC. Todos los derechos reservados.</p>
        <p class="footer__copy">Brand Book V1.0 · Bogotá, Colombia · traduc.co</p>
      </div>
    </div>
</section>
<div class="sticky-cta show" id="stickyCta">
    <a href="#contacto"><span class="sticky-dot"></span>Solicitar cotización</a>
</div>    