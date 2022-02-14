<div id="loading_calendar" class="loading">
    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: transparent; display: block;" width="96px" height="96px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
        <circle cx="50" cy="50" r="24" stroke-width="6" stroke="#d40000" stroke-dasharray="37.69911184307752 37.69911184307752" fill="none" stroke-linecap="round">
            <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" keyTimes="0;1" values="0 50 50;360 50 50"></animateTransform>
        </circle>
    </svg>
</div>

<div class="datepicker" id="div_calendar">
	<div id="prev" class="nav-event prev"></div>
	<div id="next" class="nav-event next"></div>
</div>

<div id="legenda_eventos">
    <div class="legenda_texto"><?php _e("Legenda", LANG_DOMAIN); ?>:</div>
    <div class="legenda_item">
        <div class="cor cor-01"></div>
        <div class="label"><?php _e("Divulgação de Resultados", LANG_DOMAIN); ?></div>
    </div>
    <div class="legenda_item">
        <div class="cor cor-02"></div>
        <div class="label"><?php _e("Webcast", LANG_DOMAIN); ?></div>
    </div>
    <!-- <div class="legenda_item">
        <div class="cor cor-03"></div>
        <div class="label"><?php _e("Mais de um evento", LANG_DOMAIN); ?></div>
    </div> -->
    <div class="legenda_item">
        <div class="cor cor-04"></div>
        <div class="label"><?php _e("Conferências", LANG_DOMAIN); ?></div>
    </div>
    <div class="legenda_item">
        <div class="cor cor-05"></div>
        <div class="label"><?php _e("Outros Eventos", LANG_DOMAIN); ?></div>
    </div>
</div>

<script>
    $.get(ajaxurlCalendar,function(res){
        const eventosCal = JSON.parse(res);
        groupEvents(eventosCal);

        const calendar = {
            init: function () {
                $(".datepicker").datepicker({
                    inline: true,
                    numberOfMonths: 3,
                    onSelect: onSelectDate,
                    beforeShowDay: onBeforeShowDay
                });

                $('#next, #prev').on('click', function(e) {
                    $('.ui-datepicker-'+e.target.id).trigger("click");
                });
            }
        };
                
        $(function () {
            calendar.init();
            $(document).tooltip(toolTipConfig);
            
            loading_calendar.classList.add("finished");
        });
    });
</script>