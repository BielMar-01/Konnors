<input type="checkbox" name="footer" id="updatesToggle" class="hiddenToggle">
<div class="lastUpdates item">
    <label for="updatesToggle" class="title"><?php _e("Últimas Atualizações", LANG_DOMAIN); ?></label>
    <div class="modal">
        <label for="updatesToggle" class="close"></label>
        <span class="title"><?php the_field("footerUpdatesTitle", "options"); ?></span>
        <div id="loading_footer_updates" class="loading">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: rgb(241, 242, 243); display: block;" width="64px" height="64px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                <circle cx="50" cy="50" r="32" stroke-width="8" stroke="#d40000" stroke-dasharray="50.26548245743669 50.26548245743669" fill="none" stroke-linecap="round">
                    <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" keyTimes="0;1" values="0 50 50;360 50 50"></animateTransform>
                </circle>
            </svg>
        </div>
        <div id="footerFiles" class="files table"></div>
        <a href="<?php the_field("footerUpdatesLink", "options"); ?>" class="allItems"><?php _e("Ver todos os resultados", LANG_DOMAIN); ?></a>
    </div>
</div>

<script>
    /*--------------------------------------------------------------
    ## Footer - Atualizações
    --------------------------------------------------------------*/
    const footerUpdatesCategory = [
        {
            title: '',
            internal_name: '<?php the_field('footerUpdatesCategory', 'option'); ?>',
            icon: '<?php the_field('footerUpdatesCategoryIcon', 'option'); ?>'
        }
    ];

    const footerUpdatesConfig = {
        categories: footerUpdatesCategory,
        isSpecific: false,
        groupByYear: false,
        groupByQuarter: false,
        getAllYears: true,
        yearsFieldId: '',
        getByCompanies: false,
        companyId: fmId,
        tables: ['footerFiles'],
        loadingElement: loading_footer_updates,
        clearCallback: clearTables,
        fillCallback: fillFooterUpdates,
        language: '<?php echo getI18NLanguageCodeForApi(); ?>',
        baseUrl: fmBase,
        enableDebug: true
    };

    const footerUpdates = new mzcms(footerUpdatesConfig);
    footerUpdates.init();
</script>