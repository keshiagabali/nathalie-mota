<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Nathalie Mota</title>
    <?php wp_head(); ?>
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body>

<header>
    <div class="header-logo">
        <?php
        $custom_logo_id = get_theme_mod('custom_logo');
        $logo = wp_get_attachment_image_src($custom_logo_id, 'full');
        ?>
        <a href="<?php echo home_url(); ?>">
            <img src="<?php echo get_template_directory_uri(); ?>/img_logo/Logo.png" alt="Site Logo">
        </a>
    </div>

    <nav class="header-menu">
        <?php
        wp_nav_menu([
            'theme_location' => 'header-menu',
            'container'      => false
        ]);
        ?>
        <button id="open-modal-button-header">CONTACT</button>

        <!-- Modal -->
        <?php include ( 'templates_part/modal.php')?>
    </nav>
</header>
