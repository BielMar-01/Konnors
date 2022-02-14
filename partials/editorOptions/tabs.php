<section class="wpContent--tabs tabs">
    <div class="container">
        <nav id="tabs<?= $args['index'] ?>" class="tabs">
            <?php
                $checked = 'checked';
                while(have_rows('tabs')) { the_row();
                    $title = get_sub_field('title');
                    $slug = $title . $args['index'];

                    echo <<<TAB
                        <label for="$slug" class="tab $checked">$title</label>
                    TAB;

                    $checked = '';
                }
            ?>
        </nav>
        <script>
            const tabs = document.getElementById('tabs<?= $args['index'] ?>').querySelectorAll('.tab');
            tabs.forEach(function(tab){
                tab.addEventListener('click', function(e){
                    tabs.forEach(function(tempTab){
                        tempTab.classList.remove('checked');
                    });

                    e.target.classList.add('checked');
                });
            });
        </script>
    </div>
    <div class="navContents">
        <?php
            $checked = 'checked';
            while(have_rows('tabs')) { the_row();
                $title = get_sub_field('title');
                $slug = $title . $args['index'];

                echo <<<THEiNPUT
                    <input type="radio" name="tabs{$args['index']}" id="$slug" class="hiddenToggle" $checked>
                THEiNPUT;
                ?>
                    <div class="content">
                        <?php get_template_part('partials/content', 'editor'); ?>
                    </div>
                <?php
                $checked = '';
            }
        ?>
    </div>
</section>