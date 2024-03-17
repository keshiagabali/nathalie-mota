<?php

//MENU
function register_header_menu() {
    register_nav_menu( 'header-menu', __( 'Menu principal', 'text-domain' ) );
}
add_action( 'after_setup_theme', 'register_header_menu' );

function register_footer_menu() {
    register_nav_menu( 'footer-menu', __( 'Footer Menu', 'text-domain' ) );
}
add_action( 'after_setup_theme', 'register_footer_menu' );


/* STYLE  */
function enqueue_custom_styles() {
    wp_enqueue_style('custom-theme-css', get_template_directory_uri() . '/style.css', array(), '1.0', 'all');
    wp_enqueue_style('custom-theme-css', get_template_directory_uri() . '/css/fonts.css', array(), '1.0', 'all');
    wp_enqueue_style('custom-theme-css', get_template_directory_uri() . '/css/header.css', array(), '1.0', 'all');
    wp_enqueue_style('custom-theme-css', get_template_directory_uri() . '/css/footer.css', array(), '1.0', 'all');
    wp_enqueue_style('custom-theme-css', get_template_directory_uri() . '/css/single.css', array(), '1.0', 'all');
    wp_enqueue_style('custom-theme-css', get_template_directory_uri() . '/css/index.css', array(), '1.0', 'all');
    wp_enqueue_style('custom-theme-css', get_template_directory_uri() . '/css/liste-photo.css', array(), '1.0', 'all');
}
add_action('wp_enqueue_scripts', 'enqueue_custom_styles');

/* SCRIPT */

function enqueue_custom_scripts() {
    wp_enqueue_script('custom-scripts', get_template_directory_uri() . '/js/scripts.js', array('jquery'), '1.0', true);
}
add_action('wp_enqueue_scripts', 'enqueue_custom_scripts');

/* IMG MIS EN AVANT */

add_theme_support( 'post-thumbnails' );

/* FONTAWESOME */

function enqueue_font_awesome() {
    wp_enqueue_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css');
}
add_action('wp_enqueue_scripts', 'enqueue_font_awesome');

/* CHARGER PLUS / FILTRE */

function load_more_posts() {
    $page = $_GET['page'];

    $args_custom_posts = array(
        'post_type' => 'photo', 
        'posts_per_page' => 16, 
    );

    if( 
        $_GET['category'] != NULL && 
        $_GET['category'] != 'ALL' &&
        $_GET['format'] != NULL &&
        $_GET['format'] != 'ALL'
    ){

        $args_custom_posts['tax_query'] = array(
            'relation' => 'AND', 
            array(
                'taxonomy' => 'categorie',
                'field'    => 'slug',
                'terms'    => $_GET['category']
            ),
            array(
                'taxonomy' => 'format',
                'field'    => 'slug',
                'terms'    => $_GET['format']
            )
        );
    }else{

        if( 
            $_GET['category'] != NULL && 
            $_GET['category'] != 'ALL'
        ){
            
            $args_custom_posts['tax_query'] = array(
                array(
                    'taxonomy' => 'categorie',
                    'field'    => 'slug',
                    'terms'    => $_GET['category']
                )
            );
        }
        
        if(
            $_GET['format'] != NULL &&
            $_GET['format'] != 'ALL' 
        ){
            
            $args_custom_posts['tax_query'] = array(
                array(
                    'taxonomy' => 'format',
                    'field'    => 'slug',
                    'terms'    => $_GET['format']
                )
            );
        }
    }
    $args_custom_posts['orderby'] = 'date'; 
    $args_custom_posts['order'] = $_GET['dateSort'] != 'ALL' ? $_GET['dateSort'] : 'DESC'; 
    $args_custom_posts['paged'] = $page; 

    $custom_posts_query = new WP_Query($args_custom_posts); 

    if ($custom_posts_query->have_posts()) {
        while ($custom_posts_query->have_posts()) :
            $custom_posts_query->the_post();
             
            ?>
            <div class="custom-post-thumbnail">
                <a href="<?php the_permalink(); ?>">
                    <?php if (has_post_thumbnail()) : ?>
                        <div class="thumbnail-wrapper">
                            <a href="<?php the_permalink(); ?>">
                                <?php the_post_thumbnail(); ?>
                                <!-- OVERLAY -->
                                <div class="thumbnail-overlay">
                                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/icon_eye.png" alt="Icône de l'œil"> 
                                    <i class="fas fa-expand-arrows-alt fullscreen-icon"></i>
                                    <?php
                                    
                                    $related_reference_photo = get_field('reference_photo');
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
        <?php
            
        endwhile;
        wp_reset_postdata(); 
    } else {
        
    }
    die();
}

add_action('wp_ajax_load_more_posts', 'load_more_posts'); 
add_action('wp_ajax_nopriv_load_more_posts', 'load_more_posts');

?>