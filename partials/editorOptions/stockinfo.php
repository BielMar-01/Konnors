<?php global $sectionIndex; ?>
<div class="wpContent--stockinfo">
    <div class="container">
<?php 
    $i = 0;
    while (have_rows('stockinfo_template_repetidor')) : the_row(); 
        $type = get_sub_field("model");
        $ID = $type ."_". $i ."_". $sectionIndex;

        $ticker = get_sub_field("ticker");
    ?>
        <div class="graph"> 
            <h2><?php the_sub_field("title"); ?></h2>
            <div id="<?php echo $ID; ?>" class="stockinfo-chart" style="width: 100%;" ticker="<?php the_sub_field("ticker"); ?>"></div>
        </div>

        <script>
            var options_<?php echo $ID; ?> = {
                <?php 
                    if ($type == 'chart') {
                        while (have_rows('chart')){ the_row();
                            // Loop dos índices do gráfico 
                            $indexes = [];
                            
                            while (have_rows('indexes')){ the_row();
                                array_push($indexes, get_sub_field('index'));
                            }

                            $indexes_joined = join(",", $indexes);

                            // Loop das cores do gráfico
                            $colors = [];
                            while (have_rows('colors')){ the_row();
                                array_push($colors, get_sub_field('color'));
                            }
                            $colors_joined = join("', '", $colors);
                            
                            echo $ticker .": {
                                language: langCodeFormatted,
                                stockinfoId: stockInfoId,
                                template: {
                                    type: 'chart'
                                },
                                tickers: '$ticker',
                                indexes: '$indexes_joined',
                                chartType: '". get_sub_field('kind') ."',
                                chartPeriod: '". (get_sub_field('period') ? get_sub_field('period') : "1m") ."',
                                currencySymbol: '". (get_sub_field('currency') ? get_sub_field('currency') : "R$") ."',
                                decimalPlaces: ". get_sub_field('decimals') .",
                                shortMode: ". (get_sub_field('shortmode') ? 'true' : 'false') .",
                                chartColors: ['$colors_joined']
                            },";
                        }
                    } else {
                        while (have_rows('history')){ the_row();
                            // Loop das colunas do histórico
                            $colunas = [];
                            while (have_rows('columns')){ the_row();
                                array_push($colunas, get_sub_field('column'));
                            }
                            $colunas_joined = join("', '", $colunas);
                        
                            echo $ticker ." : {
                                language: langCodeFormatted,
                                stockinfoId: stockInfoId,
                                tickers: '$ticker',
                                currencySymbol: '". get_sub_field('currency') ."',
                                decimalPlaces: ". get_sub_field('decimals') .",
                                shortMode: ". (get_sub_field('shortmode') ? 'true' : 'false') .",
                                template: {
                                    type: 'history',
                                    columns: ['$colunas_joined']
                                }
                            },";
                        }
                    }
                ?>
            };
            
            const tickerTabs_<?php echo $ID; ?> = document.querySelectorAll(".tickerTab");
            tickerTabs_<?php echo $ID; ?>.forEach(function(btn){
                btn.addEventListener("click", function(e){
                    var MZStockInfo = new MZIQ_StockInfo;
                    document.getElementById('<?php echo $ID; ?>').innerHTML = '';
                    MZStockInfo.initialize(options_<?php echo $ID; ?>[btn.getAttribute("ticker")], '#<?php echo $ID; ?>');
                    
                    document.querySelectorAll(".tickerTab.active").forEach(function(activeBtn){
                        activeBtn.classList.remove("active");
                    });
                    btn.classList.add("active");
                });
            });
            const MZStockInfo_<?php echo $ID; ?> = new MZIQ_StockInfo;
            MZStockInfo_<?php echo $ID; ?>.initialize(options_<?php echo $ID; ?>["<?php echo $ticker ?>"], '#<?php echo $ID; ?>');
        </script>
<?php
        $i++;
    endwhile;
?>
    </div>
</div>