<?php global $sectionIndex; ?>
<div class="wpContent--directors <?php the_sub_field("customClass") ?>">
    <div class="container">
        <?php
            while(have_rows("directors")): the_row();
        ?>
                <div class="group" id="group<?php echo $sectionIndex; ?>">
                    <div class="members">
                    <?php
                        while(have_rows("sectionMembers")) { the_row();
                            $picture = get_sub_field('memberPicture');
                            $popupPicture = get_sub_field('popupPicture');

                            $name = get_sub_field("memberName");
                            $job = get_sub_field("memberPosition");
                            $resume = get_sub_field("memberResume");

                            echo <<<MEMBER
                                <a class="member" href="#" memberPicture="$popupPicture" memberName="$name" memberJob="$job" memberResume="$resume">
                                    <div class="memberPicture" style="background-image: url($picture)"></div>
                                    <h5 class="memberName">$name</h5>
                                    <span class="memberJob">$job</span>
                                </a>
                            MEMBER;
                        }
                    ?>
                    </div>
                </div>
        <?php
            endwhile;
        ?>
    </div>
    <div class="membersPopup" id="membersPopup<?php echo $sectionIndex; ?>">
        <div class="box">
            <button class="close"></button>
            <div class="memberPicture"></div>
            <div class="content">
                <h4 class="memberName"></h4>
                <span class="memberJob"></span>
                <div class="memberResume"></div>
            </div>
        </div>
    </div>
</div>
<script>
    const membersPopup = document.getElementById("membersPopup<?php echo $sectionIndex; ?>");

    const popupPicture = membersPopup.querySelector(".memberPicture");
    const popupName = membersPopup.querySelector(".memberName");
    const popupJob = membersPopup.querySelector(".memberJob");
    const popupDescription = membersPopup.querySelector(".memberResume");

    const popupCloseButton = membersPopup.querySelector(".close");
    popupCloseButton.addEventListener("click", function(e){
        membersPopup.classList.remove("active");
    });

    document.querySelectorAll("#group<?php echo $sectionIndex; ?> .member").forEach(function(member){
        member.addEventListener("click", function(e){
            popupPicture.setAttribute('style', 'background-image: url('+ member.getAttribute("memberPicture") +')');
            popupName.innerHTML = member.getAttribute("memberName");
            popupJob.innerHTML = member.getAttribute("memberJob");
            popupDescription.innerHTML = member.getAttribute("memberResume");

            membersPopup.classList.add("active");
        });
    });

    document.addEventListener("keydown", function(e){
        if(e.keyCode === 27 && membersPopup.classList.contains("active")) {
            membersPopup.classList.remove("active");
        }
    });
</script>