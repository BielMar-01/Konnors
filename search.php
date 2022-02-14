<?php
    get_header();
    get_template_part('partials/content', 'top');
    
    $s = filter_var($s, FILTER_SANITIZE_FULL_SPECIAL_CHARS);
?>
<div id="loading" class="loading">
    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: transparent; display: block;" width="96px" height="96px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
        <circle cx="50" cy="50" r="24" stroke-width="6" stroke="#d40000" stroke-dasharray="37.69911184307752 37.69911184307752" fill="none" stroke-linecap="round">
            <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" keyTimes="0;1" values="0 50 50;360 50 50"></animateTransform>
        </circle>
    </svg>
</div>
<section class="wpContent--search">
    <div class="iqFiles">
        <table class="searchFiles table-search">
            <thead>
                <tr>
                    <th colspan="3"><?php _e("Arquivos", LANG_DOMAIN); ?></th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>

        <div class="btns">
            <button variant="prev" class="btn arrow files-prev" disabled><?php _e("Anterior", LANG_DOMAIN); ?></button>
            <button variant="next" class="btn arrow files-next"><?php _e("Próximo", LANG_DOMAIN); ?></button>
        </div>
    </div>
    
    <div class="wpContents">
        <table class="searchContent table-search">
            <thead>
                <tr>
                    <th colspan="3"><?php _e("Conteúdos", LANG_DOMAIN); ?></th>
                </tr>
            </thead>
            <tbody>
                <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
                <tr>
                    <td>
                        <div class="circle"></div>
                    </td>
                    <td>
                        <a href="<?php the_permalink() ?>"><?php the_title(); ?></a>
                    </td>
                </tr>
                <?php endwhile; else : ?>
                    <td colspan="3"><?php _e("Nenhuma página encontrada!", LANG_DOMAIN); ?></td>
                <?php endif; ?>
            </tbody>
        </table>

        <div class="btns">
            <button variant="prev" class="btn arrow files-prev" disabled><?php _e("Anterior", LANG_DOMAIN); ?></button>
            <button variant="next" class="btn arrow files-next"><?php _e("Próximo", LANG_DOMAIN); ?></button>
        </div>
    </div>
</section>

<script src="<?php bloginfo('template_directory'); ?>/js/search/search.js"></script>
<script>
    getFilesList("<?php echo $s; ?>", filingLang, fmId,"<?php echo get_bloginfo("template_directory") .'/img/search/pdf.svg'; ?>");
</script>

<?php
    get_template_part('partials/content', 'bottom');
    get_footer();
?>