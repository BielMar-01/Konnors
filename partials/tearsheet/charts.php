<?php global $sectionIndex; ?>
<div class="wpContent--chart">
    <section id="<?php the_sub_field("chartID"); ?>"></section>
    <?php
        $graph = get_sub_field("chart");
        for ($i = 0; $i < count($graph["series"]); $i++) {
            $data = array();

            for ($s = 0; $s < count($graph["series"][$i]["data"]); $s++) {
                for ($v = 0; $v < count($graph["series"][$i]["data"][$s]); $v++) {
                    $value = array();
                    for ($d = 0; $d < count($graph["series"][$i]["data"][$s]["values"]); $d++) {
                        array_push($value, $graph["series"][$i]["data"][$s]["values"][$d]["value"]);
                    }

                    if(count($value) === 1){
                        array_push($data, $value[0]);
                    }else {
                        array_push($data, $value);
                    }
                }
            }

            if(count($data) === 1){
                $data = $data[0];
            }
    
            $graph["series"][$i]["data"] = $data;
        }

        $x = 0;

        foreach($graph["xAxis"] as &$xAxis) {
            if(!$xAxis["top"]) unset($xAxis["top"]);
            if(!$xAxis["height"]) unset($xAxis["height"]);

            if($xAxis["linkedTo"] === $x || !$xAxis["linkedTo"]){
                unset($xAxis["linkedTo"]);
            }

            $tempCategories = array();
            foreach($xAxis["categories"] as $category) {
                array_push($tempCategories, $category["name"]);
            }
            
            $xAxis["categories"] = $tempCategories;

            if(!$xAxis["max"]) unset($xAxis["max"]);
            if(!$xAxis["min"]) unset($xAxis["min"]);

            $x++;
        }

        $y = 0;
        foreach($graph["yAxis"] as &$yAxis) {
            if(!$yAxis["top"]) unset($yAxis["top"]);
            if(!$yAxis["height"]) unset($yAxis["height"]);

            if($yAxis["linkedTo"] === $y || !$yAxis["linkedTo"]){
                unset($yAxis["linkedTo"]);
            }

            if(!$yAxis["max"]) unset($yAxis["max"]);
            if(!$yAxis["min"]) unset($yAxis["min"]);

            $y++;
        }

        // unset($graph["xAxis"][0]["linkedTo"]);
        // unset($graph["yAxis"][0]["linkedTo"]);
        
    ?>
    <script>
        <?php 
            $colors = array();
            while(have_rows("colors")){
                the_row();
                array_push($colors, get_sub_field("color"));
            }
        ?>
        Highcharts.setOptions({
            colors: <?php echo json_encode($colors); ?>
        });
        
        var <?php echo "chartOptions_$sectionIndex"; ?> = JSON.parse('<?php echo json_encode($graph, JSON_NUMERIC_CHECK); ?>');

        Highcharts.chart('<?php the_sub_field("chartID"); ?>', <?php echo "chartOptions_$sectionIndex"; ?>);
    </script>
</div>