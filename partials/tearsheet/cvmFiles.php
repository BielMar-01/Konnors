<?php global $sectionIndex; ?>
<div class="wpContent--upcomingEvents">
    <div class="container">
        <div id="data_<?php echo $sectionIndex; ?>" class="inativo">
            <?php
                $i = 0;
                while(have_rows("cvmCategories")){ the_row();
                    $name = get_sub_field( 'name' );

                    $dateTitle = __("Publication Date", LANG_DOMAIN);
                    $type = __("Type", LANG_DOMAIN);
                    $name = __("Document Name", LANG_DOMAIN);

                    echo <<<CATEGORY
                        <div id="table$i" class="arquivos">
                            <div class="table-responsive">
                                <table class="table table-arquivos" id="tabela_$sectionIndex-$i">
                                    <thead>
                                        <tr>
                                            <th class="data">$dateTitle</th>
                                            <th class="icone">$type</th>
                                            <th class="link">$name</th>
                                        </tr>
                                    </thead>
                                    <tbody><tbody>
                                </table>
                            </div>
                        </div>
                    CATEGORY;
                    $i++;
                }
            ?>
        </div>

        <script>
            const categories_<?php echo $sectionIndex; ?> = [];
            <?php while ( have_rows('cvmCategories') ) : the_row(); ?>
                categories_<?php echo $sectionIndex; ?>.push({
                    title: '<?php the_sub_field('nanme'); ?>',
                    internal_name: '<?php the_sub_field('slug'); ?>',
                    icon: '<?php the_sub_field('icon'); ?>'
                });
            <?php  endwhile; ?>

            var getAllYears = true;
            var yearsFieldId = "";
            var fillCallback = fillModuleNoYear;

            var configPage_<?php echo $sectionIndex; ?> = {
                categories: categories_<?php echo $sectionIndex; ?>,
                isSpecific: false,
                groupByYear: false,
                groupByQuarter: false,
                getAllYears: getAllYears,
                yearsFieldId: yearsFieldId,
                tableIdPrefix: "tabela_<?php echo $sectionIndex; ?>-",
                getByCompanies: false,
                companiesFieldId: "",
                clearCallback: clearTables,
                fillCallback: fillCallback,
                loadingCallback: startLoading,
                loadedCallback: stopLoading,
                language: '<?php echo getI18NLanguageCodeForApi(); ?>',
                baseUrl: '<?php echo get_template_directory_uri();?>',
                enableDebug: true,
                mount: 5
            };

            $(document).ready(function () {
                const cms_<?php echo $sectionIndex; ?> = new mzcms(configPage_<?php echo $sectionIndex; ?>);
                cms_<?php echo $sectionIndex; ?>.init();
            });
        </script>
    </div>
</div>