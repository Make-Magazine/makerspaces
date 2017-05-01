(function(angular) {
  'use strict';
  angular.module('makerSpacesApp').controller('MapCtrl', ['$http', '$rootScope', '$filter', 'FaireMapsSharedData',
    function($http, $rootScope, $filter, FaireMapsSharedData) {
      var ctrl = this;
      var faireFilters = {
        filters: ['Flagship', 'Featured', 'Mini'],
        search: ''
      };

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
        faireFilters.search = ctrl.filterText;
        var newModel = [];

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

        FaireMapsSharedData.gmarkers1.map(function(marker) {
          var rowData = marker.dataRowSrc;
          if (containsString(rowData) && isTypeToggled(rowData)) {
            newModel.push(rowData);
            marker.setVisible(true);
          } else {
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
