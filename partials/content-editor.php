<?php
    global $sectionIndex;
    
    if (have_rows('content')){
        if($sectionIndex)
            $sectionIndex++;
        else
            $sectionIndex = 1;
        
        while(have_rows('content')){ the_row();
            $contentType = get_sub_field('content_type');
            get_template_part("partials/editorOptions/$contentType", null, array("index" => $sectionIndex));
            
            $sectionIndex++;
        }
    }
?>