<?php
$index = $args["index"];
$FMOptions = array();
?>
<section class="wpContent--cvmFiles my-5">
    <div class="container">
        <?php
            $fmCompanies = (array) get_sub_field("companies");
            // if(count($fmCompanies) > 1){
            //     echo '<div class="companiesSelector">';
            //     foreach ($fmCompanies as $company) {
            //         echo <<<COMPANY
            //             <div>
            //                 <div class="company">{$company["name"]}</div>
            //             </div>
            //         COMPANY;
            //     }
            //     echo '</div>';
            // }
        ?>
        <div class="companiesFiles">
            <?php
            foreach ($fmCompanies as $company) {
                $slug = str_replace("-", "", sanitize_title($company["name"]));

                echo '<div><div class="company">';
                if ($company["allYears"] !== true) {
                    echo <<<FANO
                                <div class="filters">
                                    <select id="fano_$slug" class="yearsSelector"></select>
                                </div>
                            FANO;
                }

                echo <<<LOADING
                            <div id="loading_$slug" class="loading">
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: transparent; display: block;" width="96px" height="96px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
                                    <circle cx="50" cy="50" r="24" stroke-width="6" stroke="#d40000" stroke-dasharray="37.69911184307752 37.69911184307752" fill="none" stroke-linecap="round">
                                        <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" keyTimes="0;1" values="0 50 50;360 50 50"></animateTransform>
                                    </circle>
                                </svg>
                            </div>
                        LOADING;

                $filesTable = array();

                if ($company['isResultsCenter'] === true) {
                    $tableName = $slug . "_table_$i";
                    array_push($filesTable, $tableName);

                    echo <<<TABLE
                                <div id="$tableName" class="table-responsive">
                                    <table class="table tb-central ofContents"></table>
                                </div>
                            TABLE;
                } else {
                    if ($company["enableAccordion"]) {
                        echo '<div class="accordion files">';
                        foreach ($company['MZiQ']['categories'] as $i => $category) {
                            $name = $category["title"];
                            $tableName = $slug . "_table_$i";

                            array_push($filesTable, $tableName);

                            echo <<<FAQ
                                        <div id="$tableName" class="accordion__item files" style="display: none;">
                                            <input type="checkbox" class="hiddenToggle" id="toggle-$i">
                                            <div class="accordion__item__header">$name</div>
                                            <div class="accordion__item__content table-responsive">
                                                <table class="table table-arquivos ofContents"></table>
                                            </div>
                                        </div>
                                    FAQ;
                        }
                        echo '</div>';
                    } else {
                        foreach ($company['MZiQ']['categories'] as $i => $category) {
                            $name = $category["title"];
                            $tableName = $slug . "_table_$i";

                            array_push($filesTable, $tableName);

                            echo <<<FAQ
                                        <div id="$tableName" class="table-responsive">
                                            <table class="table table-arquivos ofContents"></table>
                                        </div>
                                    FAQ;
                        }
                    }
                }

                $FMOptions[$slug] = [
                    'companyId'         => $company['MZiQ']['companyID'] ? $company['MZiQ']['companyID'] : get_option('mziq_fm_company_id'),
                    'baseUrl'           => $company['MZiQ']['baseURL'] === 'custom' ? get_option( 'mziq_fm_base_uri' ) : $company['MZiQ']['baseURL'],
                    'categories'        => $company['MZiQ']['categories'],
                    //'groupByQuarter'    => $company['groupByQuarter'],
                    'groupByQuarter'    => false,
                    'getAllYears'       => $company['allYears'],
                    'yearsFieldId'      => "fano_$slug",
                    'tables'            => $filesTable,
                    'loadingElement'    => '',
                    'clearCallback'     => '',
                    'language'          => getI18NLanguageCodeForApi()
                ];
                $fillCallback = $company['isResultsCenter'] ? 'fillResultsCenter' : 'fillInternal';
                $jsOptions = json_encode($FMOptions[$slug], JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);

                echo <<<FM_OPTIONS
                            <script>
                                var fillingsOptions_$slug = $jsOptions;
                                fillingsOptions_$slug.loadingElement = loading_$slug;
                                fillingsOptions_$slug.fillCallback = $fillCallback;
                                fillingsOptions_$slug.clearCallback = clearTables;

                                var cms_$slug = new mzcms(fillingsOptions_$slug);
                                cms_$slug.init();
                            </script>
                        FM_OPTIONS;
                echo '</div></div>';
            }
            ?>
        </div>
        <script>
            $(function() {
                // $(".companiesSelector").slick({
                //     variableWidth: true,
                //     slidesToShow: 1,
                //     focusOnSelect: true,
                //     centerMode: true,
                //     infinite: false,
                //     dost: false,
                //     arrows: true,
                //     swipe: false,
                //     asNavFor: ".companiesFiles",
                //     prevArrow: '<button class="prev"></button>',
                //     nextArrow: '<button class="next"></button>'
                // });

                // $(".companiesFiles").slick({
                //     slidesToShow: 1,
                //     infinite: false,
                //     dost: false,
                //     arrows: false,
                //     fade: true,
                //     swipe: false,
                //     prevArrow: '<button class="prev"></button>',
                //     nextArrow: '<button class="next"></button>'
                // });
            });
        </script>
    </div>
</section>