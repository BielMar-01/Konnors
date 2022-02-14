<!-- search popup -->
<div class="searchPopup js-target-search">
    <span class="searchPopup__close js-shutdown-search">X</span>
    <div class="searchPopup__form">
        <form action="<?php echo get_home_url(); ?>" method="get">
            <input type="text" name="s" id="search" value="" placeholder="<?php echo _e("Buscar", LANG_DOMAIN); ?>" onkeyup="this.value=this.value.replace(/[<>~;{}(\[\]):=]/g,'')" required>
            <button type="submit"><img src="<?php bloginfo('template_directory') ?>/img/icons/search_popup.svg" alt="<?php echo _e("Buscar", LANG_DOMAIN); ?>"></button>
        </form>
    </div>
</div>
<!-- ./search popup -->