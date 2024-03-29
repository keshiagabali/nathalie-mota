<!-- Bouton pour ouvrir le modal de contact -->
<button id="open-modal-button-header">CONTACT</button>

<!-- Modal pour le contact -->
<div id="myModal" class="modal">

  <!-- Contenu du modal -->
  <div class="modal-content">
        <!-- Image en en-tête du modal -->
        <img src="<?php echo get_template_directory_uri(); ?>/img_logo/Contact header.png" alt="Image Modal">

        <!-- Insertion du formulaire de contact via un shortcode de Contact Form 7 -->
        <?php echo do_shortcode('[contact-form-7 id="2cc0601" title="Modal Contact 1"]'); ?>
  </div>
  
</div>
