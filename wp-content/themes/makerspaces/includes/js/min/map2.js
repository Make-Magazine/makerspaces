var infowindow = new google.maps.InfoWindow();

function gotoFeature(featureNum) {
  var feature = map.data.getFeatureById(features[featureNum].getId());
  if (!!feature) google.maps.event.trigger(feature, 'changeto', {feature: feature});
  else alert('feature not found!');
}

function initialize() {
  // Create a simple map.
  features=[];
  map = new google.maps.Map(document.getElementById('map-canvas'), {
    zoom: 2,
    center: new google.maps.LatLng(37.65, -122.25),
    scrollwheel: false,
    disableDefaultUI: true,
    zoomControl: true,
    zoomControlOptions: {
      style: google.maps.ZoomControlStyle.LARGE,
      position: google.maps.ControlPosition.TOP_RIGHT
    },
    streetViewControl: true
  });

  // Map styles
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


  // Event listener for clicks to markers
  google.maps.event.addListener(map,'click',function() {
    infowindow.close();
  });
  map.data.setStyle({fillOpacity:.8});

  var featureId = 0;

  google.maps.event.addListener(map.data,'addfeature',function(e){
    if(e.feature.getGeometry().getType()==='Polygon'){
        features.push(e.feature);
        var bounds=new google.maps.LatLngBounds();
        
        e.feature.getGeometry().getArray().forEach(function(path){
          path.getArray().forEach(function(latLng){bounds.extend(latLng);})
        });
        e.feature.setProperty('bounds',bounds);
        e.feature.setProperty('featureNum',features.length-1);
      }
  });

  // When the user clicks, open an infowindow
  map.data.addListener('click', function(event) {
    var makerName = event.feature.getProperty("Name");
    var makerDesc = event.feature.getProperty("Description");
    var makerUrl = event.feature.getProperty("URL");
    infowindow.setContent("<div style='width:150px;'><h5>"+makerName+"</h5><p>"+makerDesc+"</p><a href='"+makerUrl+"' target='_blank'>"+makerUrl+"</a></div>");
    infowindow.setPosition(event.feature.getGeometry().get());
    infowindow.setOptions({pixelOffset: new google.maps.Size(0,-30)});
    infowindow.open(map);
  });    
  map.data.loadGeoJson('/wp-content/themes/makerspaces/example-map-points.json');  
}

google.maps.event.addDomListener(window, 'load', initialize);
