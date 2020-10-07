<?php
  $footer_copyright = WPBC_get_theme_settings('footer_copyright');  
  
  $footer_background_image = '';
  if( WPBC_get_theme_settings('footer_background_image') ){
    $footer_background_image = WPBC_get_theme_settings('footer_background_image'); 
    $img_med = wp_get_attachment_image_src($footer_background_image['id'], 'medium', false );
    $img_full = wp_get_attachment_image_src($footer_background_image['id'], 'full', false ); 
    $footer_background_image = $img_full[0];
  } 
?>
<div id="contacto"></div>
<footer id="main-footer" class="image-cover text-white gpt-6 gpb-2 " style="background-image: url(<?php echo $footer_background_image; ?>); background-attachment: fixed;"> 

  <div class="container">

    <?php if( WPBC_get_theme_settings('footer_title') ){ ?>
    <div class="row">
      <div class="col-12 text-center">
        <h2 class="section-title sm"><?php echo WPBC_get_theme_settings('footer_title') ; ?></h2>
      </div>
    </div>
    <?php } ?>
    <?php if( WPBC_get_theme_settings('footer_form') ){ ?>
    <div class="row">
      <div class="col-12 form-controls-transparent ui-footer_form">
        <?php echo do_shortcode('[contact-form-7 id="'.WPBC_get_theme_settings('footer_form').'" title="Formulario de contacto"]'); ?>
      </div>
    </div>
    <?php } ?>

    <div class="row gpt-4"> 

      <div class="col-12">
        <div class="text-center">
          <p class="small footer_copyright"><?php echo $footer_copyright;?></p>
          <p class="small footer_nomade">Design & development <a href="http://nomadeweb.com" target="_blank"><img src="<?php echo CHILD_THEME_URI; ?>/images/theme/nomade.png" width="28" alt=" "></a></p>
        </div>
      </div>

    </div>

  </div>

</footer>