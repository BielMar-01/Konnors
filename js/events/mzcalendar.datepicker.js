function formatEventTooltip(item) {
    var arr = item.split('¨');
    if ($("html").hasClass("en")) {
        var ul = '<h5>Events</h5><ul>';
    } else {
        var ul = '<h5>Lista de Eventos</h5><ul>';
    }
    for (i = 0; i < arr.length; i++) {
        if (arr[i] == '') continue;
        ul += '<li>' + arr[i] + '</li>';
    }
    ul += '</ul>';
    return ul;
}
var groupedEvents = [];
function groupEvents(eventos) {
    eventos =  _.groupBy(eventos, function (x) {
        var dt = moment(x.data, 'MM/DD/YYYY')
        return dt.toDate();
    });

    console.log(eventos);
    for(key in eventos) {
        let event = eventos[key];

        var newEvent = {
            data: '',
            descricao: ''
        };

        for (var j = 0; j < event.length; j++) {
            newEvent.data = new Date(event[j].data).toString();
            newEvent.type = event[j].type;
            newEvent.descricao += event[j].descricao + '¨';
        }

        if (event.length > 1) {
            newEvent.type = 'mais-de-um-evento';
        }
        newEvent.descricao.slice(0, -1);
        groupedEvents.push(newEvent);
    }

    console.log(groupedEvents);
}

function onBeforeShowDay(date) {
    let eventOptions = [false, '', ''];
    groupedEvents.forEach(function(event){
        if (event.data == date) {
            console.log(event.data, ' | '+ date);
            eventOptions = [false, 'has-event ' + event.type, formatEventTooltip(event.descricao)];
        }
    });
    
    return eventOptions;
}

var toolTipConfig = {
    items: "td[title]",
    position: {
        my: "center bottom-20",
        at: "center top",
        using: function (position, feedback) {
            $(this).css(position);
            $("<div>")
                .addClass("arrow")
                .addClass(feedback.vertical)
                .addClass(feedback.horizontal)
                .appendTo(this);
        }
    },
    delay: 4000,
    effect: 'slide',
    content: function () {
        var element = $(this);
        if (element.is("td[title]")) {
            // console.log('element : ' + element.html());
            var ret = element.attr('title');
            if (ret == '') {
                return element;
            } else {
                return '<div>' + ret + '</div>';
            }
        } else {
            console.log('NOT!');
        }
    }
};

function onSelectDate(dateText, inst) {
    //TODO: Implement if date filter is requested, otherwise remove it
};