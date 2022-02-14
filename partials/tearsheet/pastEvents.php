<?php global $sectionIndex; ?>
<div class="wpContent--upcomingEvents">
    <div class="evento-realizado mt-5">
        <h2><?php _e("Past Events", LANG_DOMAIN);?></h2>
        <form id="lAnoLink" class="forms select ano">
            <select name="fano" id="fano"></select>
        </form>

        <div class="table-responsive">
            <table class="custom-table table-show" cellpadding="0" cellspacing="0" id="eventos-realizados-<?php echo $sectionIndex; ?>" style="width:100%">
                <thead>
                    <tr>
                        <th class="data"><?php _e("Data", LANG_DOMAIN);?></th>
                        <th><?php _e("Evento", LANG_DOMAIN);?></th>
                        <!-- <th class="tabelatt"><?php _e("Local", LANG_DOMAIN);?></th> -->
                    </tr>
                </thead>
                <tbody></tbody>
            </table>
        </div>
    </div>

    <script type="text/javascript">
    $(function(){
        var tables = [{
            tableId: '#eventos-realizados-<?php echo $sectionIndex; ?>',
            headerId: '#h2-eventos-realizados'
        }];
        new MZiQPastEventsBlock('#fano', tables).init();
    });
    </script>
</div>