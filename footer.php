<footer>
    <nav class="footer-menu">
        <?php
        wp_nav_menu([
            'theme_location' => 'footer-menu',
        ]);
        ?>
    </nav>
    <?php include ( 'templates_part/lightbox.php')?>

</footer>
<?php wp_footer(); ?>
</body>
</html>
