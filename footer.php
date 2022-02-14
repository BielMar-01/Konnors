<input type="checkbox" id="sitemapToggle" class="hiddenToggle">
<footer class="footer">
    <div class="container">
        <label for="sitemapToggle" class="sitemapToggle">
            <?php _e('Mapa do site', LANG_DOMAIN); ?>
            <i class="icon"></i>
        </label>
        
        <?php
            wp_nav_menu(array(
                'container' => false,
                'theme_location'  => 'footer-menu',
                'menu_class'  => 'footer-menu',
            ));
        ?>

        <a class="poweredBy" href="https://mzgroup.com" target="_blank" rel="noopener noreferrer">Powered by MZ</a>
    </div>
</footer>
<section class="sitemap">
    <div class="container">
        <h2><?php _e('Mapa do Site', LANG_DOMAIN); ?></h2>
        <?php
            wp_nav_menu(
                array(
                    'container' => false,
                    'theme_location'  => 'primary-menu',
                    'menu_class'  => 'primary-menu',
                )
            );
        ?>
    </div>
</section>

<?php wp_footer(); ?>
</body>
</html>