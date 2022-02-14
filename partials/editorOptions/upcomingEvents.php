<div class="wpContent--upcomingEvents">
    <div class="container">
        <div class="evento-futuro mt-3">
            <h3><?php _e("Future Events", LANG_DOMAIN);?></h3>

            <div class="table-responsive mt10">
                <table class="custom-table table-calendario" id="eventos-futuros" style="width:100%">
                    <thead>
                        <tr>
                            <th class="tabelatt data"><?php _e("Data", LANG_DOMAIN);?></th>
                            <th class="tabelatt"><?php _e("Evento", LANG_DOMAIN);?></th>
                            <!-- <th class="tabelatt"><?php _e("Detalhes", LANG_DOMAIN);?></th> -->
                            <!-- <th class="tabelatt"><?php _e("Exportar", LANG_DOMAIN);?></th> -->
                        </tr>
                    </thead>
                </table>
            </div>
        </div>

        <script>
            var table = document.getElementById("eventos-futuros");
            var tbdy = document.createElement('tbody')
            var eventos = [];
            $.get(ajaxurlFuture, function (res) {
                eventos = JSON.parse(res);
                for (var i = 0; i < eventos.length; i++) {
                    var item = eventos[i];
                    var formatedDate = moment(item.event_date).format(i18nDateFormat);
                    var formatedEndDate = ""
                    if (item.event_end != "" && item.event_end != item.event_date) {
                        formatedEndDate = " <?php echo _e("a ", LANG_DOMAIN)?> " + moment(item.event_end).format(i18nDateFormat);
                    }
                    var endTime = ""
                    var startTime = item.event_starttime
                    if (item.event_endtime.length > 4) {
                        endTime = " <?php echo _e("às ", LANG_DOMAIN)?> " + item.event_endtime
                        startTime = "<?php echo _e("das ", LANG_DOMAIN)?> " + startTime
                    }
                    var icsLink = baseEventsUrl + "/ics/" + item.event_id + "/" + lang
                    var template_directory = "<?php echo get_template_directory_uri() ?>";
                    var eventDownloadIcs = "<a href='" + icsLink + "'><img src='" + template_directory + "/img/icons/outlook.svg'/></a>"
                    var googleCalLink = "<a target=\"_blank\" rel=\"noopener noreferrer\" href='" + item.google_cal_url.replace('\'', '%27') + "'><img src='" + template_directory + "/img/icons/google-calendar.svg'/></a>"
                    var tds = [
                        '<td>' + formatedDate + formatedEndDate + startTime + endTime + '</td>',
                        '<td>' + item.event_name + '</td>',
                        // '<td>' + item.event_details + '</td>',
                        // '<td>' + eventDownloadIcs + googleCalLink + '</td>'
                    ]
                    $('<tr>' + tds.join('')).appendTo(tbdy);
                }
                table.appendChild(tbdy)
            });
        </script>
    </div>
</div>