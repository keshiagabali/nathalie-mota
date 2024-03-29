<!-- Lightbox -->

<div id="myLightbox" class="lightbox">

    <button class="lightbox__close">
        <img src="<?php echo get_template_directory_uri(); ?>/img_logo/close-lightbox.png" alt="Croix">
    </button>

    <div class="lightbox__navigation">

        <button class="lightbox__prev">
            <p>Précédente</p>
        </button>

        <button class="lightbox__next">
            <p>Suivante</p>
        </button>

    </div>

    <div class="lightbox__container">

    <?php
        $related_categories = get_the_terms(get_the_ID(), 'categorie');
        $related_category_names = array();
        if ($related_categories) {
            foreach ($related_categories as $category) {
                $related_category_names[] = esc_html($category->name);
            }
        } 
    ?>  
    <?php if (has_post_thumbnail()) : ?>
        <?php $thumbnail_id = get_post_thumbnail_id(); ?>
        <?php $thumbnail_src = wp_get_attachment_image_src($thumbnail_id, 'large')[0]; ?>
        <?php $reference_photo = get_field('reference', $thumbnail_id); ?>
        <a data-href="<?php echo $thumbnail_src; ?>" data-reference="<?php echo $reference_photo; ?>" data-category="<?php echo implode(',', $related_category_names); ?>" class="photo-lightbox">
            <?php the_post_thumbnail(); ?>
        </a>
    <?php endif; ?>

    </div>

    <div class="photo-info-lightbox">

        <div class="photo-info-left-lightbox">
            <!-- reference -->

        </div>

        <div class="photo-info-right-lightbox">
            <!-- categorie -->

        </div>

    </div>

</div>
