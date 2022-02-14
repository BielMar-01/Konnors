<div class="evento-futuro mt-3">
    <h2><?php _e("Eventos futuros", LANG_DOMAIN);?></h2>

    <div class="table-responsive mt10">
        <table class="custom-table table-calendario" id="eventos-futuros" style="width:100%">
            <thead>
                <tr>
                    <th class="tabelatt data"><?php _e("Data", LANG_DOMAIN);?></th>
                    <th class="tabelatt"><?php _e("Evento", LANG_DOMAIN);?></th>
                    <th class="tabelatt"><?php _e("Hora", LANG_DOMAIN);?></th>
                    <th class="tabelatt"><?php _e("Exportar", LANG_DOMAIN);?></th>
                </tr>
            </thead>
        </table>
    </div>
</div>

<script>
    const table = document.getElementById("eventos-futuros");
    const tbdy = table.createTBody();
    
    var eventos = [];
    
    $.get(ajaxurlFuture, function (res) {
        eventos = JSON.parse(res);
        for (let i = 0; i < eventos.length; i++) {
            let item = eventos[i];
            let eventName = item.event_details === null ? item.event_name.slice(0,-4) + item.event_name.slice(-2) : item.event_name;

            let formatedDate = moment(item.event_date).format(i18nDateFormat);
            let formatedEndDate = ""
            if (item.event_end != "" && item.event_end != item.event_date) {
                formatedEndDate = " <?php echo _e("a ", LANG_DOMAIN)?> " + moment(item.event_end).format(i18nDateFormat);
            }

            let endTime = ""
            let startTime = item.event_starttime
            if (item.event_endtime.length > 4) {
                endTime = " <?php echo _e("às ", LANG_DOMAIN)?> " + item.event_endtime
                startTime = "<?php echo _e("das ", LANG_DOMAIN)?> " + startTime
            }

            let icsLink = baseEventsUrl + "/ics/" + item.event_id + "/" + lang
            let template_directory = "<?php echo get_template_directory_uri() ?>";
            let eventDownloadIcs = "<a href='" + icsLink + "'><img src='" + template_directory + "/img/icons/calendar.svg'/></a>"
            let googleCalLink = "<a target=\"_blank\" rel=\"noopener noreferrer\" href='" + item.google_cal_url.replace('\'', '%27') + "'><img src='" + template_directory + "/img/icons/google-calendar.svg'/></a>"

            let tds = [
                '<td>' + formatedDate + formatedEndDate + '</td>',
                '<td>' + eventName + '</td>',
                '<td>' + item.event_starttime + '</td>',
                '<td>' + eventDownloadIcs + '</td>'
            ];

            tbdy.insertRow().innerHTML += tds.join('');
        }
    });
</script>