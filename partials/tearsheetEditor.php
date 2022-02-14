<?php 
    global $sectionIndex;
    
    while(have_rows('sections')){ the_row();
        $bgColor = get_sub_field('bgColor');
        $bgColor = $bgColor ? "background-color: $bgColor;" : "";

        $bgImage = get_sub_field('bgImage');
        $bgImage = $bgImage ? "background-image: url($bgImage);" : "";

        $customStyle = get_sub_field('customStyle');
        $customClass = get_sub_field('customClass');

        $enablePrinting = get_sub_field('enablePrintControl');

        $visible = "";
        if($enablePrinting !== true) {
            $visible = get_sub_field('alwaysVisible') === true ? "printable" : "";
        }

        while(have_rows("layout")) { the_row();
            $sectionName = get_row_layout();
            
            echo "<section id=\"$sectionIndex\" class=\"tearsheetSection $sectionName $customClass $visible\" style=\"$bgColor $bgImage $customStyle\">";
                if($enablePrinting && $sectionName != 'flexbox'){
                    echo "<button for=\"$sectionIndex\" class=\"tearsheetSectionPrint\"></button>";
                }
                get_template_part("partials/tearsheet/$sectionName");
            echo "</section>";

            $sectionIndex += "1";
        }
    }
?>