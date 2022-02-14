<?php /* Template Name: MZ - Tearsheet */ ?>
<?php
    get_header();
    get_template_part('partials/content', 'top');
?>
<div class="tearsheet container">
    <nav class="downloadButtons">
        <button class="fullDownload"><span class="name"><?php _e("Standard PDF", LANG_DOMAIN); ?></span></button>
        <button class="tearedDownload"><span class="name"><?php _e("Custom PDF", LANG_DOMAIN); ?></span>
            <span class="amount"></span>
        </button>
    </nav>

    <div class="container">
        <div id="printPage"></div>
    </div>

    <main id="mainTearsheet">
        <?php 
            if(get_the_content()){
                $content = get_the_content();
                echo <<<CONTENT
                    <section class="container wp-content">$content</section>
                CONTENT;
            }
            
            $sectionIndex = "0";

            get_template_part("partials/tearsheetEditor");
        ?>
    </main>
    <script>
        const tearsheet = document.querySelector(".tearsheet");
        const downloadFull = document.querySelector(".fullDownload");
        const tearedDownload = document.querySelector(".tearedDownload");
        const partsSelected = tearedDownload.querySelector(".amount");

        var partsAmount = 0;
        partsSelected.innerHTML = partsAmount;
        
        const addButtons = document.querySelectorAll(".tearsheetSectionPrint");

        addButtons.forEach(function(button){
            button.addEventListener("click", function(e){
                if(button.classList.contains("active"))
                    partsAmount--;
                else
                    partsAmount++;
                
                partsSelected.innerHTML = partsAmount;

                button.classList.toggle("active");
                button.parentElement.classList.toggle("printable");
                var currentSize = button.parentElement.getBoundingClientRect().width;

                button.parentElement.style.width = currentSize +"px";
            });
        });

        tearedDownload.addEventListener("click", function(){
            tearsheet.classList.add("partial");
            setTimeout(function(){
                setDefaultHeight();
            }, 1000);

            printPage.innerHTML = "";
            addButtons.forEach(function(button){
                if(button.classList.contains("active")){
                    var newSection = document.createElement("div");
                    printPage.appendChild(newSection);

                    newSection.outerHTML = button.parentNode.outerHTML;
                }
            });

            print();
            tearsheet.classList.remove("partial");
        });

        downloadFull.addEventListener("click", function(){
            setDefaultHeight()
            print();
        });

        function setDefaultHeight() {
            document.querySelectorAll("section[data-highcharts-chart]").forEach(function(chart){
                var itemSize = chart.getBoundingClientRect();
                chart.style.minWidth = itemSize.width +"px";
                chart.style.minHeight = itemSize.height +"px";
            });
        }
    </script>
</div>
    
<?php
    get_template_part('partials/content', 'bottom');
    get_footer();
?>