



jQuery(document).ready(function() {

   Vue.use(VueTables.ClientTable, theme = 'bootstrap3');
   Vue.use(VueTables.Event);
   //Vue.use(axios);

   var vm = new Vue({
      el: "#directory",
      data: {
         columns: ['mmap_eventname', 'physLoc', 'mmap_country'],
         tableData: [],
         options: {
            headings: {
               mmap_eventname: 'Name',
               physLoc: 'Location', 
               mmap_country: 'Country'//, 
               //siteLink: 'Link'
            },
            templates: {
               physLoc: function (h, row, index) {
                  return row.mmap_city + ', ' + row.mmap_state;
               }
            },
            columnsDisplay: {
               mmap_eventname: 'Name', 
               mmap_city: 'Location', 
               mmap_country: 'desktop'//, 
               //siteLink: 'Link'
            },
            columnsClasses: {
               mmap_eventname: 'col-name',
               physLoc: 'col-location', 
               mmap_country: 'col-country'//, 
               //siteLink: 'col-link'
            },
            // filterByColumn: true,
            // customFilters: [
            //    {
            //       name: 'physLoc',
            //       callback: function (row, query) {
            //          console.log(row, query);
            //          return /query/.test(row.physLoc);
            //          // return row.name[0] == query;
            //       }
            //    }
            // ],
            pagination: { chunk: 5 } // undocumented :(
         },
         filterVal: '',
         map: null,
         mapDefaultZoom: 2,
         mapDefaultPos: {
         lat: 29.1070772,
         lng: -24.2299966
         },
          markers: ''
      },
      created: function() {
         var _self = this;
         axios.get('/wp-json/makemap/v1/mapdata/2')
            .then(function (response) {
               //console.log(response);
               _self.tableData = response.data.Locations;
               _self.detectBrowser();
               _self.getLocation();
               _self.initMap();
            })
            .catch(function (error) {
               console.log(error);
               //_self.loading = false;
            });
      },
      computed: {

      },
      mounted: function() {
         //var _self = this;
         // jQuery.get( "/wp-json/makemap/v1/mapdata/2", function( data ) {
         //    _self.tableData = data.Locations;
         //    _self.detectBrowser();
         //    _self.getLocation();
         //    _self.initMap();
         // });
      },
      methods: {
         detectBrowser: function() {
            var useragent = navigator.userAgent;
            var mapdiv = document.getElementById("map");
          
            if (useragent.indexOf('iPhone') != -1 || useragent.indexOf('Android') != -1 ) {
              mapdiv.style.width = '100%';
              mapdiv.style.height = '200px';
            } else {
              mapdiv.style.width = '100%';
              mapdiv.style.height = '400px';
            }
         },
         initMap: function() {
            const element = document.getElementById('map')
            const options = {
               center: this.mapDefaultPos,
               zoom: this.mapDefaultZoom
            }
            this.map = new google.maps.Map(element, options);
            this.addMarkers();
         },
         getLocation: function() {

            var infoWindow = new google.maps.InfoWindow,
               _self = this;

            // Try HTML5 geolocation.
            if (navigator.geolocation) {
               navigator.geolocation.getCurrentPosition(
                  function(position) {
                     var pos = {
                        lat: position.coords.latitude,
                        lng: position.coords.longitude
                     };
                     // infoWindow.setPosition(pos);
                     // infoWindow.setContent('Location found.');
                     // infoWindow.open(map);
                     _self.map.setCenter(pos);
                     _self.map.setZoom(8);
                  },
                  function() {
                     _self.handleLocationError(true, infoWindow, _self.map.getCenter());
                  }
               );
            } else {
               // Browser doesn't support Geolocation
               _self.handleLocationError(false, infoWindow, _self.map.getCenter());
            }

         },
         handleLocationError: function(browserHasGeolocation, infoWindow, pos) {
            // NOTE (ts): handle this event in some other way? putting a popup on the map isn't very helpful
            // infoWindow.setPosition(pos);
            // infoWindow.setContent(browserHasGeolocation ? 'Error: The Geolocation service failed.' : 'Error: Your browser doesn\'t support geolocation.');
            // infoWindow.open(this.map);
         },
         doFilter: function(data) {
            //console.log(data);
            this.$refs.directoryGrid.setFilter(this.filterVal);
            //Event.$emit('vue-tables.filter::physLoc', this.filterVal);
            this.addMarkers();
         },
         filterOverride: function(data) {
            data.preventDefault();
         },
         onRowClick: function(data) {
            var pos = {
               lat: parseFloat(data.row.mmap_lat),
               lng: parseFloat(data.row.mmap_lng)
            };
            this.map.panTo(pos);
            this.map.setZoom(16);
         },
         addMarkers: function() {
            // an attempt to clear the markers first for filtering, but not so good
            // for (var i = 0; i < this.markers.length; i++) {
            //    this.markers[i].setMap(null);
            // }
            // this.markers = [];
            // Create an array of alphabetical characters used to label the markers.
            var labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            this.markers = this.tableData.map(function(location, i) {
               //console.log(location);
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

                  myWindow.open(this.map, marker);
               });
               return marker;
            });
            //Add a marker clusterer to manage the markers.
            var markerCluster = new MarkerClusterer(this.map, this.markers, {imagePath: 'https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m'});
         }

      }
  });

}); // end doc ready

