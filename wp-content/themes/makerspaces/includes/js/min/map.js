(function($){
    /**
     * Storage objects
     */
    var map, layer;
    var infowindow = new google.maps.InfoWindow();


    function gotoFeature(featureNum) {
        var feature = map.data.getFeatureById(features[featureNum].getId());
        if (!!feature) google.maps.event.trigger(feature, 'changeto', {feature: feature});
        else alert('feature not found!');
    }



    /**
     * Google Maps
     */
    function initMaps () {
        features=[];
        map = new google.maps.Map(document.getElementById('map-canvas'), {
            center: new google.maps.LatLng(37.65, -122.25),
            scrollwheel: false,
            zoom: 2,
            disableDefaultUI: true,
            zoomControl: true,
            zoomControlOptions: {
              style: google.maps.ZoomControlStyle.LARGE,
              position: google.maps.ControlPosition.TOP_RIGHT
            },
            streetViewControl: true
        });

        google.maps.event.addListener(map,'click',function() {
            infowindow.close();
        });

        var featureId = 0;

        var style = [
            {
                elementType: 'geometry',
                stylers: [
                    { saturation: -50 },
                    { weight: 0.4 }
                ]
            },
            {
                featureType: 'poi',
                stylers: [
                    { visibility: "off" }
                ]
            },
            {
                featureType: 'administrative.land_parcel',
                elementType: 'all',
                stylers: [
                    { visibility: 'off' }
                ]
            }
        ];

        var styledMapType = new google.maps.StyledMapType(style, {
            map: map,
            name: 'Styled Map'
        });

        map.mapTypes.set('map-style', styledMapType);
        map.setMapTypeId('map-style');

        layer = new google.maps.Data();

        layer.loadGeoJson('/wp-content/themes/makerspaces/example-map-points.json');

        layer.setMap(map);

        // global infowindow
        // When the user clicks, open an infowindow
        map.data.addListener('click', function(event) {
            var myHTML = event.feature.getProperty("Description");
            infowindow.setContent("<div class='map-infowindow' style='width:150px; text-align: center;'>"+myHTML+"</div>");
            infowindow.setPosition(event.feature.getGeometry().get());
            infowindow.setOptions({pixelOffset: new google.maps.Size(0,-30)});
            infowindow.open(map);
        });


        if (navigator && navigator.geolocation) {
           locateMe();
        }
    }

    function locateMe () {
      navigator.geolocation.getCurrentPosition(function(position) {
        var latlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
        map.setCenter(latlng);
        map.setZoom(3);
      });
    }
    

    /**
     * On load, init maps(phase 1) & start listening for search and filter events(phase 2)
     */
    //initMaps();
    google.maps.event.addDomListener(window, 'load', initMaps);

})(jQuery);