<!-- Liste Photo -->

<div class="custom-post-thumbnail">

    <input type="hidden" name="page" value="1">

    <div class="thumbnail-container-accueil">
        <?php

        $args_custom_posts = array(
            'post_type' => 'photo', 
            'posts_per_page' => 8,
            'paged' => $paged,
            'orderby' => 'date', 
            'order' => 'DESC',
        );

        $custom_posts_query = new WP_Query($args_custom_posts);

        while ($custom_posts_query->have_posts()) :
            $custom_posts_query->the_post();

        ?>

            <div class="custom-post-thumbnail">
                <a href="<?php the_permalink(); ?>">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="thumbnail-wrapper">
                            <a href="<?php the_permalink(); ?>">
                            <?php the_post_thumbnail(); ?>

                            <!-- Overlay -->
                            <div class="thumbnail-overlay">
                                <img src="<?php echo get_template_directory_uri(); ?>/img_logo/Icon_eye.png" alt="Eye Icon">
                                <div class="fullscreen-icon">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img_logo/Icon_fullscreen.png" alt="fullscreen-icon" class="fullscreen-trigger">
                                </div>

                                <?php
                                
                                $related_reference_photo = get_field('reference');
                                $related_categories = get_the_terms(get_the_ID(), 'categorie');
                                $related_category_names = array();

                                if ($related_categories) {
                                    foreach ($related_categories as $category) {
                                        $related_category_names[] = esc_html($category->name);
                                    }
                                }
                                ?>
                                <div class="photo-info">
                                    <div class="photo-info-left">
                                        <p><?php echo esc_html($related_reference_photo); ?></p>
                                    </div>
                                    <div class="photo-info-right">
                                        <p><?php echo implode(', ', $related_category_names); ?></p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php endif; ?>
            </a>
        </div>

        <?php endwhile; ?>

        <?php wp_reset_postdata(); ?>
    </div>

    <!-- Lightbox -->
        <div class='modal-container'>
            <span class="btn-close">X</span>
            <div class="left-arrow"></div>
            <div>
                <img src="" class="middle-image" />
                <div class="info-photo">
                    <span id="modal-reference"></span>
                    <span id="modal-category"></span>
                </div>
            </div>
            <div class="right-arrow"></div>
        </div>

    <div class="view-all-button">
        <button id="load-more-posts"
                data-ajaxurl="<?php echo admin_url('admin-ajax.php'); ?>"
                data-nonce="<?php echo wp_create_nonce('load_more_posts_nonce'); ?>">
            Charger plus
        </button>
    </div>
</div>