<?php
$script_handle = 'contact-js';
wp_enqueue_script(
    $script_handle,
    get_template_directory_uri() . '/js/partials-min/contact.min.js',
    array('jquery'),
    null,
    true
);
/**
 * 
 * Partial Name: flexible_contact
 * 
 */
if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}
$hubspot_portal_id = get_field( 'hubspot_portal_id', 'option' );
$hubspot_form_id = get_field( 'hubspot_form_id', 'option' );
$hubspot_region = get_field( 'hubspot_region', 'option' );

$hubspot_portal_id = $hubspot_portal_id ? $hubspot_portal_id : '51136954';
$hubspot_form_id = $hubspot_form_id ? $hubspot_form_id : '8cb046c1-a274-4e58-a4a9-8524d01c2ade';
$hubspot_region = $hubspot_region ? $hubspot_region : 'na1';
$contact = get_sub_field('contact_group');
$form_txt = $contact['form'];
$panel_r = $contact['contact_panel'];
?>
<section class="flexible-contact-partial-322307" id="contacto" style="overflow:hidden;position:relative">
    <div class="wrap" style="position:relative">
      <div class="rev in">
        <?php if(!empty($contact['eyebrow'])): ?>
          <span class="eyebrow" data-aos="fade-right">
            <span class="eyebrow-rule"></span>
            <?= $contact['eyebrow']; ?>
          </span>
        <?php endif; if(!empty($contact['title'])): ?>
          <h2 class="section__h2" data-aos="fade-right"><?= $contact['title']; ?></h2>
        <?php endif; if(!empty($contact['subtitle'])): ?>
          <p class="section__sub" data-aos="fade-up"><?= $contact['subtitle'] ?></p>
        <?php endif; ?>
      </div>
      <div class="contact-layout">
        <div class="rev in">
          <?php if(!empty($form_txt['title'])): ?>
          <h3 class="form-h3" data-aos="fade-up"><?= $form_txt['title']; ?></h3>
          <?php endif; if(!empty($form_txt['subtitle'])): ?>
            <p class="form-sub" data-aos="fade-up"><?= $form_txt['subtitle']; ?></p>
          <?php endif; ?>
          <div
            id="hsQuoteForm"
            class="form-grid"
            data-portal-id="<?php echo esc_attr( $hubspot_portal_id ); ?>"
            data-form-id="<?php echo esc_attr( $hubspot_form_id ); ?>"
            data-region="<?php echo esc_attr( $hubspot_region ); ?>"
            data-aos="fade-up"
          ></div>
          <?php if(!empty($form_txt['answer'])): ?>
            <div>
              <span class="text-12" data-aos="fade-up"><?= $form_txt['answer']; ?></span>
            </div>
          <?php endif; if(!empty($form_txt['requite_sms'])): ?>
            <p class="text-11" data-aos="fade-up"><?= $form_txt['requite_sms']; ?></p>
          <?php endif; ?>
        </div>
        <div class="contact-panel rev rev-d1 in" data-aos="fade-up">
          <?php if(!empty($panel_r['title'])): ?>
            <h3 class="contact-panel__title"><?= $panel_r['title']; ?></h3>
          <?php endif; if(!empty($panel_r['subtitle'])): ?>
          <p class="contact-panel__sub"><?= $panel_r['subtitle']; ?></p>
          <?php endif; if(!empty($panel_r['list'])): foreach($panel_r['list'] as $item): ?>
            <div class="c-detail">
              <p class="c-detail__label"><?= $item['label'] ?? ''; ?></p>
              <p class="c-detail__val"><?= $item['description'] ?? ''; ?></p>
            </div>
          <?php endforeach; endif; if(!empty($panel_r['promise'])): ?>
          <div class="promise">
            <span class="promise-dot"></span>
            <span class="promise-text"><?= $panel_r['promise']; ?></span>
          </div>
          <?php endif; ?>
        </div>
      </div>
    </div>
</section>
                    