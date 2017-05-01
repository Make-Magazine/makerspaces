<?php
/**
 * Template Name: Angular Map
 *
 * @package _makerspaces
 */

get_header(); ?>
<div class="makerspaces-map-wrp" ng-app="makerSpacesApp" ng-strict-di>
  <div class="container">
    <div class="row map-header">
      <div class="col-xs-12 col-md-9 col-lg-9">
        <h1>Makerspaces represent the democratization of design, engineering, fabrication, and education.</h1>
        <h2>We put together a world-wide directory for Makers to connect:</h2>
      </div>
      <div class="col-xs-12 col-md-3 col-lg-3">
        <a href="" class="btn btn-info btn-block">ADD YOUR OWN MAKERSPACE! <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
        <p>By adding your makerspace to this listing, you not only become part of our searchable database for Makers seeking like-minded people in their area but you also contribute to our study of the Makers Movement as a whole.</p>
      </div>
    </div>

    <div class="row">
      <div ng-controller="MapCtrl as $ctrl" class="col-xs-12 col-md-9 col-lg-9">
        <nav class="map-filters-wrp">
          <div class="searchbox">
            <h2>Find a Makerspace</h2>
            <input type="text"
              class="form-control input-sm"
              placeholder="Location, Name"
              ng-model="$ctrl.filterText"
              ng-model-options="{debounce: 500}"
              ng-change="$ctrl.applyMapFilters()" />
          </div>
          <!-- Commenting out checkboxes till we need them again -->
<!--           <div class="filters ng-cloak" ng-if="$ctrl.faireMarkers">
            <faires-map-filter default-state="false" filter="School">
              School <span class="hidden-sm hidden-xs">Maker Faires</span>
            </faires-map-filter>
            <faires-map-filter default-state="true" filter="Mini">
              Mini <span class="hidden-sm hidden-xs">Maker Faires</span>
            </faires-map-filter>
            <faires-map-filter default-state="true" filter="Featured">
              Featured <span class="hidden-sm hidden-xs">Faires</span>
            </faires-map-filter>
            <faires-map-filter default-state="true" filter="Flagship">
              Flagship <span class="hidden-sm hidden-xs">Faires</span>
            </faires-map-filter>
          </div> -->
        </nav>

        <div class="loading-spinner" ng-if="!$ctrl.faireMarkers">
          <i class="fa fa-circle-o-notch fa-spin"></i>
        </div>
        <!-- Map Angular Component -->
        <faires-google-map
          id="makerspaces-map"
          map-data="::$ctrl.faireMarkers"
          ng-if="$ctrl.faireMarkers">
        </faires-google-map>

        <!-- COmmenting out the filter button till we need them again -->
        <!-- Color Key -->
<!--         <div class="faire-key-boxes">
          <div class="flagship-key" ng-click="$ctrl.toggleBox('Flagship')">
            Flagship Maker Faires
            <p>Faires curated and produced by the Maker Media team</p>
          </div>
          <div class="featured-key" ng-click="$ctrl.toggleBox('Featured')">
            Featured Maker Faires
            <p>Larger-scale regional events</p>
          </div>
          <div class="mini-key" ng-click="$ctrl.toggleBox('Mini')">
            Mini Maker Faires
            <p>Community events</p>
          </div>
          <div class="school-key" ng-click="$ctrl.toggleBox('School')">
            School Maker Faires
            <p>K-12 Faires (closed to general public)</p>
          </div>
        </div> -->

        <!-- List of Faires -->
        <div class="faire-list-table table-responsive">
          <table class="table table-striped table-condensed">
            <tr></tr>
            <tr ng-init="sort='event_start_dt';reverse=false">
              <th class="cursor-pointer" ng-click="sort='annual';reverse=!reverse">
                <span ng-show="sort == 'annual'">
                  <span ng-show="!reverse">^</span>
                  <span ng-show="reverse">v</span>
                </span>
              </th>
              <th class="cursor-pointer" ng-click="sort='category';reverse=!reverse">TYPE
                <span ng-show="sort == 'category'">
                  <span ng-show="!reverse">^</span>
                  <span ng-show="reverse">v</span>
                </span>
              </th>
              <th class="cursor-pointer" ng-click="sort='name';reverse=!reverse">NAME
                <span ng-show="sort == 'name'">
                  <span ng-show="!reverse">^</span>
                  <span ng-show="reverse">v</span>
                </span>
              </th>
              <th>LOCATION</th>
              <th class="cursor-pointer" ng-click="sort='venue_address_country';reverse=!reverse">COUNTRY
                <span ng-show="sort == 'venue_address_country'">
                  <span ng-show="!reverse">^</span>
                  <span ng-show="reverse">v</span>
                </span>
              </th>
            </tr>
            <tr dir-paginate="(index, row) in $ctrl.faireMarkers | orderBy:sort:reverse | itemsPerPage: 20">
              <td></td>
              <td>{{row.category}}</td>
              <td>
                <a target="_blank" ng-if="row.faire_url" href="{{row.faire_url}}">{{row.name}}</a>
                <span ng-if="!row.faire_url">{{row.name}}</span>
              </td>
              <td>{{row.venue_address_city}}{{row.venue_address_state && ', '+row.venue_address_state || ''}}</td>
              <td>{{row.venue_address_country}}</td>
            </tr>
          </table>
          <div class="text-center">
            <dir-pagination-controls
              boundary-links="true"
              template-url="<?php echo get_template_directory_uri() ?>/bower_components/angularUtils-pagination/dirPagination.tpl.html">
            </dir-pagination-controls>
          </div>
        </div>
      </div>

      <div class="col-xs-12 col-sm-5 col-md-4 col-lg-3">

      </div>
    </div>
  </div>
</div>
<?php get_footer(); ?>

