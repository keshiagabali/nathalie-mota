    <div class="image-container">
        <?php
        // Query photos meme category
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
                        </div>
                    <?php endif; ?>
                </a>
            </div>
        <?php endwhile; ?>

        <?php wp_reset_postdata(); ?>
    </div>
