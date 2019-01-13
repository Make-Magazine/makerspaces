<?php
/**
 * Template Name: Angular Map
 *
 * @package _makerspaces
 */

get_header(); ?>
<div class="container">
   <div class="row">
      <div class="col-md-12">
         <h1>Makerspaces Directory</h1>
      </div>
   </div>
   <div class="row">
      <div class="col-md-12">
         <form action="">
            <label for="">Find a Makerspace
               <input type="search">
            </label>
            <button>Search</button>
         </form>
         <div id="map" style="height: 768px;"></div>
      </div>
   </div>
   <div class="row">
      <div class="col-md-12">
         Table
      </div>
   </div>
</div>





<script>


function detectBrowser() {
  var useragent = navigator.userAgent;
  var mapdiv = document.getElementById("map");

  if (useragent.indexOf('iPhone') != -1 || useragent.indexOf('Android') != -1 ) {
    mapdiv.style.width = '100%';
    mapdiv.style.height = '400px';
  } else {
    mapdiv.style.width = '100%';
    mapdiv.style.height = '800px';
  }
}

detectBrowser();
      // Note: This example requires that you consent to location sharing when
      // prompted by your browser. If you see the error "The Geolocation service
      // failed.", it means you probably did not give permission for the browser to
      // locate you.
      var map, infoWindow;
      function initMap() {
        map = new google.maps.Map(document.getElementById('map'), {
          center: {lat: 29.1070772, lng: -24.2299966},
          zoom: 2
        });
        infoWindow = new google.maps.InfoWindow;

        // Try HTML5 geolocation.
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
            var pos = {
              lat: position.coords.latitude,
              lng: position.coords.longitude
            };

            // infoWindow.setPosition(pos);
            // infoWindow.setContent('Location found.');
            // infoWindow.open(map);
            map.setCenter(pos);
            map.setZoom(8);
          }, function() {
            handleLocationError(true, infoWindow, map.getCenter());
          });
        } else {
          // Browser doesn't support Geolocation
          handleLocationError(false, infoWindow, map.getCenter());
          
        }
      }

      function handleLocationError(browserHasGeolocation, infoWindow, pos) {
      //   infoWindow.setPosition(pos);
      //   infoWindow.setContent(browserHasGeolocation ?
      //                         'Error: The Geolocation service failed.' :
      //                         'Error: Your browser doesn\'t support geolocation.');
      //   infoWindow.open(map);
         console.log(browserHasGeolocation, infoWindow, pos);
      }

      var detailWindow = '<h4>test</h4>';

        // Create an array of alphabetical characters used to label the markers.
        var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';

      jQuery.get( "/wp-json/makemap/v1/mapdata/2", function( data ) {
         //console.log(data);
         //$( ".result" ).html( data );
         //alert( "Load was performed." );
         // jQuery.each(data.Locations, function(idx, el){
         //    console.log(idx,el);
         // var latLng = new google.maps.LatLng(el.mmap_lat,el.mmap_lng);
         // var marker = new google.maps.Marker({
         //    position: latLng,
         //    label: labels[idx % labels.length],
         //    map: map
         // });

         var markers = data.Locations.map(function(location, i) {
            console.log(location);
            var latLng = {lat: parseFloat(location.mmap_lat), lng: parseFloat(location.mmap_lng)};
          var marker =  new google.maps.Marker({
            position: latLng,
            label: ''//labels[i % labels.length]
          });
          marker.addListener('click', function() {
            //console.log(location.mmap_eventname);
            var myWindow = new google.maps.InfoWindow({
               content: '<div style=""><h4>'+location.mmap_eventname+'</h4><p><a href="'+location.mmap_url+'">'+location.mmap_url+'</a></p><p>'+location.mmap_type+'</p></div>'
            });

            myWindow.open(map, marker);
         });
          return marker;
        });


        // Add a marker clusterer to manage the markers.
        var markerCluster = new MarkerClusterer(map, markers,
            {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});

         // });
      });




      </script>
    <script src="https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/markerclusterer.js">
    </script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDtWsCdftU2vI9bkZcwLxGQwlYmNRnT2VM&callback=initMap"></script>

<?php get_footer(); ?>

