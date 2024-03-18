<?php get_header(); ?>

<!-- Lightbox Photo -->
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

<!-- Single -->
<main id="main" class="content-area">
    <div class="zone-contenu mobile-first">
        <div class="left-container">
            <div class="left-contenu">
                <h2><?php the_title(); ?></h2>
                <?php
                // Réf photo
                $reference_photo = get_field('reference');
                if ($reference_photo) {
                    echo '<p>Référence : ' . esc_html($reference_photo) . '</p>';
                }

                // Catégories photo
                $categories = get_the_terms(get_the_ID(), 'categorie');
                $current_category_slugs = array();

                if ($categories) {
                    foreach ($categories as $category) {
                        $current_category_slugs[] = $category->slug;
                    }
                }

                if ($categories) {
                    echo '<p>Catégorie : ';
                    $category_names = array();
                    foreach ($categories as $category) {
                        $category_names[] = esc_html($category->name);
                    }
                    echo implode(', ', $category_names); 
                    echo '</p>';
                }

                // Format photo
                $format_terms = get_the_terms(get_the_ID(), 'format');
                if ($format_terms) {
                    echo '<p>Format : ';
                    $format_names = array();
                    foreach ($format_terms as $format_term) {
                        $format_names[] = esc_html($format_term->name);
                    }
                    echo implode(', ', $format_names); 
                    echo '</p>';
                }

                // Type photo
                $type_de_photo = get_field('type');
                if ($type_de_photo) {
                    echo '<p>Type : ' . esc_html($type_de_photo) . '</p>';
                }

                // Année photo
                $date_capture = get_the_date('Y'); 
                if ($date_capture) {
                    echo '<p>Année : ' . esc_html($date_capture) . '</p>';
                }
                ?>
            </div>
        </div>
        <div class="right-container">
            <?php if (has_post_thumbnail()) : ?>
                <a data-href="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id(), 'large')[0]; ?>" class="photo">
                    <?php the_post_thumbnail(); ?>
                </a>
            <?php endif; ?>
        </div>
    </div>

    <div class="zone-contact">
        <div class="left-contact">
            <div class="texte-contact">
                <p>Cette photo vous intéresse ?</p>
            </div>

            <div class="bouton-contact">
                <?php include ( 'templates_part/modal-photo.php')?>

                <?php
                    $reference_photo = get_field('reference');
                    if ($reference_photo) {
                        echo '<script type="text/javascript">';
                        echo 'var acfreference = "' . esc_js($reference) . '";';
                        echo '</script>';
                    }
                ?>
            </div>
        </div> 

        <div class="right-contact">
            <?php
            
                $current_post_id = get_the_ID();

                
                $args = array(
                    'post_type' => 'photo',
                    'posts_per_page' => -1,
                    'order' => 'ASC',
                );
                $all_photo_posts = get_posts($args);

                $current_post_index = array_search($current_post_id, array_column($all_photo_posts, 'ID'));

                $prev_post_index = $current_post_index - 1;
                $next_post_index = $current_post_index + 1;

                $prev_post = ($prev_post_index >= 0) ? $all_photo_posts[$prev_post_index] : end($all_photo_posts);
                $next_post = ($next_post_index < count($all_photo_posts)) ? $all_photo_posts[$next_post_index] : reset($all_photo_posts);

                $prev_permalink = get_permalink($prev_post);
                $next_permalink = get_permalink($next_post);

                $prev_thumbnail = get_the_post_thumbnail($prev_post, 'thumbnail');
                $next_thumbnail = get_the_post_thumbnail($next_post, 'thumbnail');
            ?>

            <div class="thumbnail-container">
                <div class="thumbnail-wrapper">
                </div>
                
                <a href="<?php echo esc_url($prev_permalink); ?>" class="arrow-link" data-thumbnail="<?php echo esc_url(get_the_post_thumbnail_url($prev_post, 'thumbnail')); ?>" id="prev-arrow-link">
                    <img src="<?php echo get_template_directory_uri(); ?>/img_logo/fleche-gauche.png" alt="Précédent" class="arrow-img-gauche" id="prev-arrow" />
                </a>
                <a href="<?php echo esc_url($next_permalink); ?>" class="arrow-link" data-thumbnail="<?php echo esc_url(get_the_post_thumbnail_url($next_post, 'thumbnail')); ?>" id="next-arrow-link">
                    <img src="<?php echo get_template_directory_uri(); ?>/img_logo/fleche-droite.png" alt="Suivant" class="arrow-img-droite" id="next-arrow" />
                </a>
            </div>
        </div>
    </div>

    <!-- Photos Apparentées -->
    <div class="related-images">
        <h3>VOUS AIMEREZ AUSSI</h3>
        <?php include ( 'templates_part/photo_block.php')?>
    </div>
      
</main>
<script src="<?php echo get_template_directory_uri(); ?>/js/modal-photo.js"></script>

<?php get_footer(); ?>