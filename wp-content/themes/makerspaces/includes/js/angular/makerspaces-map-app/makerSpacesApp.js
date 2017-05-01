(function(angular) {
  'use strict';
  angular.module('makerSpacesApp', ['angularUtils.directives.dirPagination', 'ordinal']);

  angular.module('makerSpacesApp').factory('FaireMapsSharedData', ['$q', function($q) {
      var defer = $q.defer();
      var FaireMapsSharedData = {
        gmarkers1: [],
        infowindow: undefined,
        mapDone: function() {
          return defer.promise;
        },
        setMapDone: function() {
          defer.notify(true);
        }
      };
      return FaireMapsSharedData;
    }]);
})(window.angular);
