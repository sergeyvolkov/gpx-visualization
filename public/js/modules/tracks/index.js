require(['async!http://maps.google.com/maps/api/js?sensor=false', 'blockUI', 'fullScreen'], function(){
    var $mapCanvas = $('#map-canvas'),
        mapOptions = {},
        map;

    mapOptions = getMapsOptions();

    map = new google.maps.Map($mapCanvas[0], mapOptions);

    $.ajax({
        type: "GET",
        url: "/api/all-routes",
        dataType: "json",
        beforeSend: function() {
            $mapCanvas.block({
                message: '<h1><img src="/img/ajax-loader.gif"></h1><h1>Downloading tracks...</h1>',
                css: {border: 'none', textAlign: 'center', opacity: '0.5'}
            });
        },
        success: function(response) {
            $mapCanvas.unblock();

            if ('success' !== response.status) {
                return false;
            }

            $.each(response.routes, function() {
                var pointsCollection = this,
                    points = [],
                    poly,
                    bounds = new google.maps.LatLngBounds();

                $.each(pointsCollection, function() {
                    var lat = this.latitude,
                        lon = this.longitude,
                        p = new google.maps.LatLng(lat, lon);
                    points.push(p);
                    bounds.extend(p);
                });

                poly = new google.maps.Polyline({
                    // use your own style here
                    path: points,
//                    strokeColor: "#"+((1<<24)*Math.random()|0).toString(16), // random color
                    strokeColor: "#fff",
                    strokeOpacity: 1,
                    strokeWeight: 3
                });

                poly.setMap(map);
                map.fitBounds(bounds);

            });

            return true;

        }

    });

    // added size-switcher
    $mapCanvas.append('<div id="size-switcher" class="fa fa-arrows"></div>');
    $('body').on('click', '#size-switcher', function() {
        $mapCanvas.toggleFullScreen();
    });

    // save updated center to localStorage
    google.maps.event.addListener(map, 'dragend', function() {
        var mapCenter = [];

        mapCenter = map.getCenter();
        localStorage.setItem('mapCenter', JSON.stringify(mapCenter));
    });
    // save updated zoom to localStorage
    google.maps.event.addListener(map, 'zoom_changed', function() {
        var zoom = 0;

        zoom = map.getZoom();
        localStorage.setItem('mapZoom', zoom);
    });
    // save updated map type
    google.maps.event.addListener(map, 'maptypeid_changed', function() {
        var mapTypeId = '';

        mapTypeId = map.getMapTypeId();
        localStorage.setItem('mapTypeId', mapTypeId);
    } );

    function getMapsOptions()
    {
        var mapOptions = {},
            defaultCoordinates = [50.006067,36.228932],
            defaultZoom = 12,
            defaultTypeId = google.maps.MapTypeId.HYBRID,
            coordinates,
            zoom,
            typeId;

        if (localStorage.getItem('mapCenter')) {
            coordinates = JSON.parse(localStorage.getItem('mapCenter'));
            coordinates = [coordinates['k'], coordinates['B']];
        } else {
            coordinates = defaultCoordinates;
        }

        zoom = localStorage.getItem('mapZoom') ? localStorage.getItem('mapZoom') : defaultZoom;
        typeId = localStorage.getItem('mapTypeId') ? localStorage.getItem('mapTypeId') : defaultTypeId;

        mapOptions = {
            center:     new google.maps.LatLng(coordinates[0], coordinates[1]),
            zoom:       parseInt(zoom),
            mapTypeId:  typeId
        };

        return mapOptions;
    }

});
