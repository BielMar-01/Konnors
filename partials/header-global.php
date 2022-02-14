<header>
    <div class="container">
        <input type="checkbox" id="menuToggle" class="hiddenToggle">
        <input type="checkbox" id="searchToggle" class="hiddenToggle">
        <div class="top">
            <a href="<?php echo get_home_url(); ?>" class="logo"></a>
            <div class="quotes"></div>
            <div class="right">
                <div class="lang">
                    <?php wpmziq_get_language_switcher(); ?>
                </div>
                <?php
                    $defaults = array(
                        'container' => false,
                        'theme_location'  => 'top-menu',
                        'menu_class'  => 'top-menu',
                    );
                    wp_nav_menu($defaults);
                ?>
                <label for="menuToggle" class="menuToggle"></label>
            </div>
        </div>
        <div class="bottom">
            <label for="menuToggle" class="close"></label>
            <span class="title"><?php _e('Menu', LANG_DOMAIN); ?></span>
            <form action="<?php echo get_home_url(); ?>/" class="searchField">
                <fieldset>
                    <input type="search" name="s" placeholder="<?php _e('Digite sua busca', LANG_DOMAIN); ?>">
                    <input type="submit" value="">
                </fieldset>
            </form>
            <nav class="menu">
                <?php
                    $defaults = array(
                        'container' => false,
                        'theme_location'  => 'primary-menu',
                        'menu_class'  => 'primary-menu',
                    );
                    wp_nav_menu($defaults);
                ?>
            </nav>
        </div>
    </div>
</header>