<?php get_header(); ?>

<div class="hero">

    <?php
        $args_related_photos = array(
            'post_type' => 'photo', 
            'posts_per_page' => 1,
            'orderby' => 'rand', 
        );
        $related_photos_query = new WP_Query($args_related_photos);

        while ($related_photos_query->have_posts()) :
            $related_photos_query->the_post();
            $post_permalink = get_permalink();
    ?>
    <a href="<?php echo esc_url($post_permalink); ?>">

            <div class="hero-image" style="background-image: url('<?php echo get_the_post_thumbnail_url(); ?>');">
                <img src="<?php echo get_template_directory_uri(); ?>/img_logo/Titre header.png" alt="Titre Accueil">
            </div>

    </a>

        <?php endwhile; ?>

        <?php wp_reset_postdata(); ?>
</div>


<div id="photo-container">
    <?php include ( 'templates_part/liste_photo.php')?>
</div>

<?php get_footer(); ?>