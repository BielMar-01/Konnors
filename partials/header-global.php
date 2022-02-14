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

            <label for="searchToggle" class="search"></label>
        </div>
        <form action="<?php echo get_home_url(); ?>/" class="searchField">
            <fieldset>
                <input type="search" id="search" name="s" placeholder="<?php _e('Digite sua busca', LANG_DOMAIN); ?>">
                <input type="submit" value="">
            </fieldset>
            <label for="searchToggle" class="close"></label>
        </form>
    </div>
</header>
<script>
    const headerTickers = document.querySelector(".quotes");
    const MZStockInfoHeader = new MZIQ_StockInfo;

    const decimalConfig = {
        minimumFractionDigits: 2,
        maximumFractionDigits: 2
    }

    const headerOptions = {
        language: langCodeFormatted,
        stockinfoId: stockInfoId,
        template: {
            type: 'raw'
        },
        rawInit: function(payload) {
            if(!payload) return;

            const tickers = payload.tickers.concat(payload.indexes);

            tickers.forEach(function(ticker) {
                let currency = ticker.info.marketCap === 0 ? '' : "R$";

                let item = document.createElement("div");

                let name = document.createElement("span");
                let price = document.createElement("span");
                let variation = document.createElement("span");

                item.classList.add("item");
                name.classList.add("ticker");
                price.classList.add("price");
                variation.classList.add("variation");

                name.innerHTML = ticker.ticker;
                price.innerHTML = currency ? currency + ticker.info.price.toLocaleString(langCode, decimalConfig) : ticker.info.price.toLocaleString(langCode);
                variation.innerHTML = ticker.info.var.toLocaleString(langCode, decimalConfig) + "%";

                variation.classList.remove("high", "stable", "low");
                if (ticker.info.var > 0)
                    variation.classList.add("high");
                else if (ticker.info.var < 0)
                    variation.classList.add("low");
                else
                    variation.classList.add("stable");

                item.appendChild(name);
                item.appendChild(price);
                item.appendChild(variation);

                headerTickers.appendChild(item);
            });
        }
    };

    MZStockInfoHeader.initialize(headerOptions);
</script>