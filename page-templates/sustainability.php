<?php /* Template Name: MZ - Sustentabilidade */ ?>
<?php
    get_header();
    get_template_part('partials/content', 'top');

    the_content();
?>
    <div class="wpContent--sustainability">
        <div class="tabs">
            <?php
                $isFirst = "active";
                while(have_rows("tabs")) { the_row();
                    $tabName = get_sub_field("tabName");
                    $tabSlug = sanitize_title($tabName);

                    echo <<<TAB
                        <label for="tab_$tabSlug" class="tab $isFirst">$tabName</label>
                    TAB;

                    $isFirst = "";
                }
            ?>
        </div>
        <div class="contents">
            <?php
                $isFirst = "checked";
                while(have_rows("tabs")) { the_row();
                    $tabName = get_sub_field("tabName");
                    $tabSlug = sanitize_title($tabName);

                    $content = get_sub_field("tabContent");

                    echo <<<TAB
                        <input type="radio" name="sustainabilityTabs" id="tab_$tabSlug" class="hiddenToggle" $isFirst>
                        <div class="content">$content</div>
                    TAB;

                    $isFirst = "";
                }
            ?>
        </div>

        <script>
            const tabs = document.querySelectorAll(".tabs .tab");
            tabs.forEach(function(tab){
                tab.addEventListener("click", function(){
                    document.querySelectorAll(".tabs .tab.active").forEach(function(activeTab){
                        activeTab.classList.remove("active");
                    });

                    tab.classList.toggle("active");
                });
            });
        </script>
    </div>
<?php
    get_template_part('partials/content', 'bottom');
    get_footer();
?>