    </div>

    <?php
        $fmArray = array(
            'page-templates/file-manager.php',
            'page-templates/file-manager-faq.php',
            'page-templates/results-center.php',
        );

        if ( is_page_template($fmArray) ) {
            get_template_part('partials/fm', 'script');
        }
    ?>
</main>