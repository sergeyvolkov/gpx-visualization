require(['async!http://maps.google.com/maps/api/js?sensor=false', 'blockUI'], function(){
    var $mapCanvas = $('#map-canvas'),
        mapOptions = {},
        map;

    mapOptions = {
        center: new google.maps.LatLng(50, 36),
        zoom: 12,
        mapTypeId: google.maps.MapTypeId.SATELLITE
    };
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
});
