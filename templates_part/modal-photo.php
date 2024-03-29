<button id="myBtn-photo" data-reference="<?php echo esc_attr($reference_photo); ?>">Contact</button>

<div id="myModal-photo" class="modal-photo">

    <div class="modal-content-photo">
        <img src="<?php echo get_template_directory_uri(); ?>/img_logo/Contact header.png" alt="Image Modal">
        <!-- Contact Form 7 Shortcode -->
        <?php echo do_shortcode('[contact-form-7 id="2cc0601" title="Modal Contact 1"]'); ?>
    </div>

</div>
