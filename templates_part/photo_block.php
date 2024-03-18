    <div class="image-container">
        <?php
        // photos meme category
        $args_related_photos = array(
            'post_type' => 'photo',
            'posts_per_page' => 2,
            'orderby' => 'rand',
            'tax_query' => array(
                array(
                    'taxonomy' => 'categorie',
                    'field' => 'slug',
                    'terms' => $current_category_slugs,
                ),
            ),
        );

        $related_photos_query = new WP_Query($args_related_photos);

        while ($related_photos_query->have_posts()) :
            $related_photos_query->the_post();
        ?>
            <div class="related-image">
                <a href="<?php the_permalink(); ?>">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="image-wrapper">
                            <?php the_post_thumbnail(); ?>
                            <!-- Overlay -->
                            <div class="thumbnail-overlay-single">
                                <img src="<?php echo get_template_directory_uri(); ?>/img_logo/Icon_eye.png" alt="Icône de l'œil">
                                <div class="fullscreen-icon">
                                    <img src="<?php echo get_template_directory_uri(); ?>/img_logo/Icon_fullscreen.png" alt="fullscreen-icon">
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
                        </div>
                    <?php endif; ?>
                </a>
            </div>
        <?php endwhile; ?>
        <?php wp_reset_postdata(); ?>
    </div>

    

    
