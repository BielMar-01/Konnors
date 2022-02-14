<?php
    $map = get_sub_field("dynamicMap");

    if($map){ ?>
        <div class="wpContent--dynamicMap">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 map">
                        <?php
                            $selectedMap = $map["map"];
                            get_template_part("partials/editorOptions/maps/$selectedMap");
                        ?>
                    </div>
                    <div class="col-xl-4 contents">
                        <?php
                            foreach($map["stateContents"] as $content){
                                $initials = $content["initials"];

                                echo <<<STATE
                                    <div class="stateContent" state="{$content["state"]["value"]}" initials="$initials">
                                        <h3 class="name">{$content["state"]["label"]}</h3>
                                        {$content["content"]}
                                    </div>
                                STATE;
                            }
                        ?>
                    </div>
                </div>
            </div>
            <script>
                document.querySelectorAll(".wpContent--dynamicMap .map svg path").forEach(function(state){
                    var contentId = state.getAttribute("id");
                    var stateContent = document.querySelector('.stateContent[state="'+ contentId +'"]');

                    var statePosition = state.getBBox();

                    if(stateContent){
                        var stateInitials = stateContent.getAttribute("initials");
                        var stateLabel = document.createElementNS("http://www.w3.org/2000/svg", "text");

                        stateLabel.textContent = stateInitials;
                        
                        state.setAttribute("initials", stateInitials);
                        state.parentElement.appendChild(stateLabel);

                        stateLabel.setAttribute("x", statePosition.x + (statePosition.width / 2) - (stateLabel.getBBox().width / 2));
                        stateLabel.setAttribute("y", statePosition.y + (statePosition.height / 2) + (stateLabel.getBBox().height / 2));

                        state.addEventListener("click", function(e){
                            this.classList.toggle("active");
                            document.querySelector('.stateContent[state="'+ contentId +'"]').classList.toggle("active");
                        });
                    }
                });
            </script>
        </div>
<?php
    }
?>