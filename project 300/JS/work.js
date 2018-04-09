var mapLat = null;
var mapLng = null;
var mapZoom = null;

$(document).ready(function () {

    var rcb = $('#report_cb');
    var ncb = $('#news_cb');
    var acb = $('#all_cb');
    var cat = $('#cat');

    ncb.trigger('click');
    Render();

    rcb.click(function () {
        console.log('Report checkbox clicked -> ' + rcb.is(':checked'));
        Render();
    });
    ncb.click(function () {
        console.log('News checkbox clicked -> ' + ncb.is(':checked'));
        Render();
        ;
    });
    acb.click(function () {
        console.log('All checkbox clicked -> ' + acb.is(':checked'));
        Render();
    });

    cat.change(function () {
        var end = this.value;
        console.log(end);
    });

    function Render() {
        var a = rcb.is(':checked');
        var b = ncb.is(':checked');
        var c = acb.is(':checked');
        var data = [];

        if (c == true || (a && b)) {
            data = getNewsPoints();
            data = data.concat(getReportPoints());
        }
        else if (a == true) {
            data = data.concat(getReportPoints());
        }
        else if (b == true) {
            data = getNewsPoints();
        }
        else {
            ;
        }
        initMap(data);
        // oldoot();

    }
});