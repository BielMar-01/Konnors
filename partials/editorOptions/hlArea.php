<?php
    $hlArea = get_sub_field('hlArea');
    $bgImage = $hlArea['bgImage'];
    $content = $hlArea['content'];

    $customClass = get_sub_field('customClass') . ($bgImage ? ' masked' : '');

    echo <<<HIGHLIGHT_AREA
        <section class="wpContent--hlArea hlArea $customClass" style="background-image: url($bgImage);">
            <div class="container">$content</div>
        </section>
    HIGHLIGHT_AREA;
?>