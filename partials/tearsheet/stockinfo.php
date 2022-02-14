<?php
    global $sectionIndex;
    $ID = "stockinfo_$sectionIndex";
?>
<div class="wpContent--stockinfo">
    <div class="graph"> 
        <h2><?php the_sub_field("stockinfo_titulo"); ?></h2>
        <div id="<?php echo $ID; ?>" class="stockinfo-chart" style="width: 100%;"></div>
    </div>
    
    <?php 
        $chart = get_sub_field("stockinfo");
        $chart["language"] = ICL_LANGUAGE_CODE;
        $chart["stockinfoId"] = get_option('prices_key');

        // Tickers
        $tempTickers = array();
        foreach($chart["tickers"] as $ticker){
            array_push($tempTickers, $ticker["name"]);
        }
        $chart["tickers"] = implode(",",$tempTickers);

        // Indexes
        $tempIndexes = array();
        foreach($chart["indexes"] as $index){
            array_push($tempIndexes, $index["name"]);
        }
        $chart["indexes"] = implode(",",$tempIndexes);

        // Colunas do histórico
        $tempColumns = array();
        foreach($chart["template"]["columns"] as $column){
            array_push($tempColumns, $column["column"]);
        }
        $chart["template"]["columns"] = $tempColumns;

        // Colors
        $tempColors = array();
        foreach($chart["colors"] as $color){
            array_push($tempColors, $color["hex"]);
        }
        $chart["colors"] = $tempColors;
    ?>
    <script>
        const options_<?php echo $ID; ?> = JSON.parse('<?php echo json_encode($chart); ?>');

        const MZStockInfo_<?php echo $ID; ?> = new MZIQ_StockInfo;
        MZStockInfo_<?php echo $ID; ?>.initialize(options_<?php echo $ID; ?>, '#<?php echo $ID; ?>');
    </script>
</div>

<style>
    .tbPrices {
        display: none !important;
    }
</style>
