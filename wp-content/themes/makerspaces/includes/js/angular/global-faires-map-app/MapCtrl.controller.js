(function(angular) {
  'use strict';
  angular.module('faireMapsApp').controller('MapCtrl', ['$http', '$rootScope', '$filter', 'FaireMapsSharedData',
    function($http, $rootScope, $filter, FaireMapsSharedData) {
      var ctrl = this;
      var faireFilters = {
        filters: ['Flagship', 'Featured', 'Mini'],
        search: '',
        pastEvents: false
      };
      ctrl.pastEvents = false;

      $rootScope.$on('toggleMapFilter', function(event, args) {
        var index = faireFilters.filters.indexOf(args.filter);
        if (args.state && index < 0) {
          faireFilters.filters.push(args.filter);
        } else if (!args.state && index > -1) {
          faireFilters.filters.splice(index, 1);
        }
        ctrl.applyMapFilters();
      });
      ctrl.toggleBox = function(type) {
        jQuery('.filters faires-map-filter').each(function(index,obj){
          var filter = jQuery(obj).attr( "filter");
          var index = faireFilters.filters.indexOf(filter);
          //if the filter is not the same as the selected type
          if(filter!==type){
            //uncheck and remove from the faireFilters Object
            jQuery(obj).find('input').prop( "checked", false );
            if (index > -1) {
              faireFilters.filters.splice(index, 1);
            }
          }else{
            //make sure it is checked and add to the faireFilters Object if it's not there
            jQuery(obj).find('input').prop( "checked", true );
            if (index < 0) {
              faireFilters.filters.push(filter);
            }
          }
        });

        ctrl.applyMapFilters();
      }
      ctrl.applyMapFilters = function() {
        FaireMapsSharedData.infowindow.close();
        ctrl.pastPresent = {
          past: 0,
          present: 0
        };
        faireFilters.search = ctrl.filterText;
        faireFilters.pastEvents = ctrl.pastEvents;
        var newModel = [];
        var todaysDate = new Date();
        // check if "sorting.search" string exists in marker object:
        function containsString(marker) {
          if (!faireFilters.search) {
            return true;
          }
          function checkForValue(json, value) {
            for (var key in json) {
              if (typeof(json[key]) === 'object') {
                checkForValue(json[key], value);
              } else if (typeof(json[key]) === 'string' && json[key].toLowerCase().match(value)) {
                return true;
              }

            }
            return false;

          }
          return checkForValue(marker, faireFilters.search.toLowerCase());
        }
        // check if type matches ok:
        function isTypeToggled(marker) {
          return (faireFilters.filters.indexOf(marker.category) > -1);
        }
        // check if date is ok:
        function isDateOk(marker) {
          var eventDate;

          if (Object.prototype.toString.call(marker.event_end_dt) === "[object Date]" &&
              !isNaN(marker.event_end_dt.getTime()) ) { // is end date valid and not set to 0's
            eventDate = marker.event_end_dt; // use end date
          } else if (Object.prototype.toString.call(marker.event_start_dt) === "[object Date]" &&
              !isNaN(marker.event_start_dt.getTime()) ) { // is start date valid and not set to 0's
            eventDate = marker.event_start_dt; // use start date
          } else {
            ctrl.pastPresent.present++;
            return true;
          }

          //set event_date to midnight on the following day so we don't display a faire as being passed until the following day
          var event_date = new Date(eventDate);
          event_date.setDate(event_date.getDate() + 1); //END DATE + 1 day
          event_date.setHours(0,0,0,0);  //event ends at midnight
          var isInPast = event_date.getTime() < todaysDate.getTime();

          if (isInPast) {
            ctrl.pastPresent.past++;
          } else {
            ctrl.pastPresent.present++;
          }
          return (faireFilters.pastEvents == isInPast);
        }
        FaireMapsSharedData.gmarkers1.map(function(marker) {
          var rowData = marker.dataRowSrc;
          if (containsString(rowData) && isTypeToggled(rowData) && isDateOk(rowData)) {
            newModel.push(rowData);
            marker.setVisible(true);
          } else {
            ctrl.pastPresent.past++;
            marker.setVisible(false);
          }
        });
        ctrl.faireMarkers = newModel;
      };

      $http.get('/wp-content/themes/makerspaces/demo-map-data-from-makerfaire.json')
        .then(function successCallback(response) {
          ctrl.faireMarkers = response && response.data && response.data.Locations;
          FaireMapsSharedData.mapDone().then(null, null, function() {
            ctrl.applyMapFilters();
          });
        }, function errorCallback() {
          // error
        });
    }
  ]);
})(window.angular);
