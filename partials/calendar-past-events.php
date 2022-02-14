<div id="loading_past" class="loading">
    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" style="margin: auto; background: transparent; display: block;" width="96px" height="96px" viewBox="0 0 100 100" preserveAspectRatio="xMidYMid">
        <circle cx="50" cy="50" r="24" stroke-width="6" stroke="#d40000" stroke-dasharray="37.69911184307752 37.69911184307752" fill="none" stroke-linecap="round">
            <animateTransform attributeName="transform" type="rotate" repeatCount="indefinite" dur="1s" keyTimes="0;1" values="0 50 50;360 50 50"></animateTransform>
        </circle>
    </svg>
</div>
<div class="evento-realizado my-5">
    <div class="row mb-3">
        <div class="col-sm-6">
            <h2 style="margin: 0;"><?php _e("Eventos passados", LANG_DOMAIN); ?></h2>
        </div>
        <div class="col-sm-6 filters">
            <select name="fano" id="fano" class="year"></select>
        </div>
    </div>

    <div class="table-responsive">
        <table class="custom-table table-show table-calendario past" cellpadding="0" cellspacing="0" id="eventos_realizados" style="width:100%">
            <thead>
                <tr>
                    <th class="data"><?php _e("Data", LANG_DOMAIN); ?></th>
                    <th><?php _e("Evento", LANG_DOMAIN); ?></th>
                </tr>
            </thead>
            <tbody></tbody>
        </table>
    </div>
</div>

<script type="text/javascript">
    $(function() {
        new MZiQPastEvents(fano, eventos_realizados, loading_past).init();
    });
</script>