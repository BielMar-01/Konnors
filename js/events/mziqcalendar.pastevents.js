var orderEvents = function (array) {
    return array.sort(function (a, b) {
        return moment.unix(b.event_date) - moment.unix(a.event_date);
    });
}

var MZiQPastEvents = function (yearsField, table, loading) {
    var THIS = this;

    const reqGetEventosRealizados = {
        action: 'wpmziq_get_eventos_realizados',
        year: 0
    };

    function getPastEvents() {
        jQuery.post(ajaxurlPast, reqGetEventosRealizados, function (response) {
            THIS.clearTables();

            var result = JSON.parse(response);
            loading.classList.add("finished");
            console.log('FINISHED');

            if (result === null) return;

            THIS.fillTable(result);
        });
    }

    yearsField.addEventListener('change', function(e) {
        var selectedYear = e.target.value;
        if (selectedYear == "ANO") return;

        reqGetEventosRealizados.year = selectedYear;

        loading.classList.remove("finished");
        console.log('started');

        getPastEvents();
    });

    this.clearTables = function () {
        table.tBodies[0].innerHTML = "";
    };

    this.fillTable = function (events) {
        events.forEach(function(item) {
            let eventName = item.event_details === null ? item.event_name.slice(0,-4) + item.event_name.slice(-2) : item.event_name;
            let formatedDate = new Date(item.event_date*1000).toLocaleString(lang, {day: '2-digit', month: '2-digit', year: 'numeric'});
            
            let tds = [
                '<td>' + formatedDate + '</td>',
                '<td>' + eventName + '</td>'
            ];

            let theRow = table.tBodies[0].insertRow();
            theRow.innerHTML = tds.join('');
        });
    };

    this.init = function () {
        var requestGetYears = {
            action: 'wpmziq_get_eventos_realizados_anos'
        };

        jQuery.post(ajaxurlPast, requestGetYears, function (response) {
            const years = JSON.parse(response);
            if (years === null) return;

            years.forEach(function(year, i) {
                let newYear = document.createElement('option');
                newYear.setAttribute('value', year);
                newYear.innerHTML = year;

                if (i === 0) {
                    newYear.setAttribute('selected', '');
                    reqGetEventosRealizados.year = year;
                }

                yearsField.appendChild(newYear);
                getPastEvents();
            });
        });
    }
}