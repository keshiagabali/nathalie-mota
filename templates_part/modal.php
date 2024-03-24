<button id="open-modal-button-header">CONTACT</button>

<div id="myModal" class="modal">

  <div class="modal-content">
        <span class="close">x</span>
        <img src="<?php echo get_template_directory_uri(); ?>/img_logo/Contact header.png" alt="Image Modal">
        <!-- Contact Form 7 shortcode -->
        <?php echo do_shortcode('[contact-form-7 id="2cc0601" title="Modal Contact 1"]'); ?>
  </div>
  
</div>
