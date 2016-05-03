/**
 * Part of GravityView_Maps plugin. This script is enqueued from
 * front-end view that has Maps setting enabled.
 *
 * globals jQuery, GV_MAPS, google
 */

// make sure GV_MAPS exists
window.GV_MAPS = window.GV_MAPS || {};

(function($){

	"use strict";

	/**
	 * Passed by wp_localize_script() with some settings
	 * @type {object}
	 */
    var self = $.extend( {
        'didScroll': false,
        'mapOffset': 0,
        'mapStickyContainer': null,
        'mapEntriesContainerClass': '.gv-map-entries',
        'markers': [],
        "is_single_entry": false

    }, GV_MAPS );

	/**
	 * Google Map object, set up in `self.setup_map`
	 */
	var maps = [];

	var bounds = new google.maps.LatLngBounds();

    var infowindow = new google.maps.InfoWindow({
        content: '',
        maxWidth: parseInt( self.infowindow.max_width, 10 )
    });

	/**
	 * Set up the map functionality
	 * @return {[type]} [description]
	 */
	self.init = function() {

        var first_map = document.getElementById( self.map_id_prefix + '-0' );
        // Do we really need to process maps?
        if( null === first_map ) {
            return;
        }

        //check if it is a single entry view
        if( $('.gv-map-single-container').length > 0  ) {
            self.is_single_entry = true;
        }

        // convert multiple maps to a number
        self.multiple_maps = parseInt( self.multiple_maps, 10 );

        // make sure map canvas is less than 50% of the window height (default 400px)
        self.prepareStickyCanvas();

		self.setupMaps();
		self.processMarkers();

        // mobile behaviour
        self.initMobile();

        self.startScrollCheck();

        // bind markers animations
        self.initAnimateMarkers();
	};

	/**
	 * Initiate the map object, stored in map
	 * @return {void}
	 */
	self.setupMaps = function() {
        var m;

		self.MapOptions.zoom = parseInt( self.MapOptions.zoom, 10 );
		self.MapOptions.mapTypeId = google.maps.MapTypeId[ self.MapOptions.mapTypeId ];

		if( self.MapOptions.zoomControl ) {
			self.MapOptions.zoomControlOptions = self.zoomControlOptions();
		}

        var map_element;

        for( var i = 0; i <= self.multiple_maps; i++ ) {

            map_element = document.getElementById( self.map_id_prefix + '-' + i.toString() );

            if( null === map_element ) {
                if( console ) {
                    console.error( 'GravityView map DOM element not found at #' + self.map_id_prefix + '-' + i.toString() + '; map not created.' );
                }
                continue;
            }

	        var trafficLayer = new google.maps.TrafficLayer();
	        var transitLayer = new google.maps.TransitLayer();
	        var bicyclingLayer =  new google.maps.BicyclingLayer();

            m = new google.maps.Map( map_element, self.MapOptions );

            if( 1 === self.layers.bicycling ) {
                bicyclingLayer.setMap( m );
            }
            if( 1 === self.layers.transit ) {
                transitLayer.setMap( m );
            }
            if( 1 === self.layers.traffic ) {
                trafficLayer.setMap( m );
            }

            maps.push( m );

            self.setZoom( m );
        }

	};

	/**
     * Fixes issue where fitBounds() zooms in too far after adding markers
     *
     * @see http://stackoverflow.com/a/4065006/480856
     * @since 1.3
     * @param map Google map object
     */
    self.setZoom = function( map ) {
        google.maps.event.addListenerOnce( map, "idle", function() {
            if ( map.getZoom() > self.MapOptions.zoom) {
                map.setZoom(self.MapOptions.zoom);
            }
        });
    };

	/**
	 * Add markers to the maps
	 * @return {void}
	 */
	self.processMarkers = function() {
        for ( var i in self.markers_info ) {
            maps.forEach( self.add_marker, self.markers_info[ i ] );
        }
	};

    /**
     * Add marker to a map
     *
     * @param map google.maps.Map object
     * @param i array index
     * @param array
     *
     * 'this' gets the forEach thisArg (extra argument)
     *
     */
    self.add_marker = function( map, i, array ) {

        // For single Entry Maps, filter the markers to match the entry ID

        // Get the entry ID associated to the current map
        var entryID = document.getElementById( self.map_id_prefix + '-' + i.toString() ).getAttribute( 'data-entryid' );

        // If entry ID is is set and is different then the current marker (entry ID) do not add it to the map
        if ( entryID && entryID != this.entry_id ) {
            return;
        }

        var geo = new google.maps.LatLng( this.lat, this.long),
            icon = this.icon_url || self.icon;

        var marker = new google.maps.Marker({
            map: map,
            icon: icon,
            url: this.url,
            position: geo,
            entryId: this.entry_id,
            content: this.content
        });

        // If there's no entry ID, this is an aggregate map and we want to extend the global bounds
        if( ! entryID ) {
            bounds.extend( marker.position );
            maps[ i ].fitBounds( bounds );
        }
        // Otherwise, we want to set the bounds for a single-marker map
        else {
            maps[ i ].fitBounds( new google.maps.LatLngBounds().extend( marker.position ) );
        }

        self.addMarkerEvents( marker, map );

        self.markers.push( marker );
    };

	/**
	 * Add event listeners to Markers
	 *
	 * @param {object} marker google.maps.Marker
	 * @param {object} map google.maps.Map
	 */
	self.addMarkerEvents = function( marker, map ) {

        if( self.is_single_entry ) {
            return;
        }

		// The marker has been clicked.
        google.maps.event.addListener( marker, 'click', self.markerOnClick( marker ) );

		// on Mouse over
		google.maps.event.addListener( marker, 'mouseover', self.markerOnOver( marker ) );

		// on mouseout
		google.maps.event.addListener( marker, 'mouseout', self.markerOnMouseOut( marker ) );

		// Close infowindow when clicking the map
		google.maps.event.addListener( map, 'click', function() {
			infowindow.close();
		});

	};


    /**
     * Open the entry link when marker has been clicked
     *
     * @param {object} marker google.maps.Marker Google maps marker object
     * @param {string} marker.content Infowindow markup string
     * @param {object} marker.map A google.maps.Map object
     * @param {string} marker.url Full URL to the marker's single entry page
     * @param {object} marker.position A google.maps.LatLng object
     * @param {int|string} marker.entryId Entry ID # or slug
     *
     * @returns {Function} If there's an infowindow, show it. Otherwise, go to the marker.url URL
     */
    self.markerOnClick = function( marker ) {
        return function() {
            var content = self.getInfowindowContent( marker.content );
            if( content ) {
                infowindow.setContent( content );
                infowindow.open( marker.map, marker );
            } else {
                infowindow.close();
                window.open( marker.url, self.marker_link_target );
            }
        };
    };


    /**
     * Check if the infowindow content is empty and if so add a link to the single entry (by default)
     * @param {string} content Infowindow markup string
     * @returns {string} Prepared Infowindow HTML, with empty image tags removed and default text added to empty links
     */
    self.getInfowindowContent = function( content ) {

        /**
         * Do we accept empty infowindows?
         * @see \GravityView_Maps_Render_Map::parse_map_options
         */
        if( ! self.infowindow.no_empty ) {
            return content;
        }

	    var $content = $( content );

	    $content
		    .find( 'img[src=""]' ).remove() // Remove empty images
		    .end()
		    .addClass(function() {
		        if( 0 === $content.find('img').length ) {
			        return 'gv-infowindow-no-image';
		        }
		    })
		    .find( 'a.gv-infowindow-entry-link:not([allow-empty]):empty' ).text( self.infowindow.empty_text ); // Empty links get some text, unless "allow-empty" attribute is set

        return $content.prop('outerHTML');
    };

    /**
     * Highlights the assigned entry on mouse over a Marker
     *
     * @param marker google.maps.Marker Google maps marker object
     * @returns {Function}
     */
    self.markerOnOver = function( marker ) {
        return function() {
            $( '#gv_map_' + marker.entryId ).addClass('gv-highlight-entry');
        };
    };

    /**
     * Remove the highlight of the assigned entry on mouse out a Marker
     *
     * @param marker google.maps.Marker Google maps marker object
     * @returns {Function}
     */
    self.markerOnMouseOut = function( marker ) {
        return function() {
            $( '#gv_map_' + marker.entryId ).removeClass('gv-highlight-entry');
        };
    };



    // Animate markers when mouse is over an entry

    /**
     *  Bind events when mouse is over an entry
     */
    self.initAnimateMarkers = function () {
        if(  self.is_single_entry || '' === self.icon_bounce ) {
            return;
        }
        $('.gv-map-view').on( 'mouseenter', self.animateMarker );
    };

    /**
     * Starts and Stops the marker animation
     * @param e object Event
     */
    self.animateMarker = function ( e ) {

        var id = this.id.replace( 'gv_map_','' );

        self.markers.forEach( self.triggerAnimationMarker, id );
    };

    /**
     * Starts Bounce marker animation for the marker associated with the Entry
     *
     * @param marker google.maps.Marker Google maps marker object
     * @param i
     * @param array
     */
    self.triggerAnimationMarker = function( marker, i, array ) {
        if( marker.entryId === this ) {

	        // Don't interrupt something beautiful
	        if( marker.animating ) { return; }

	        marker.setAnimation( google.maps.Animation.BOUNCE );

            // stop the animation after one bounce
            setTimeout( self.stopAnimationMarker, 750, marker );
        }
    };

    /**
     * Stops all the marker animations
     *
     * @param marker google.maps.Marker Google maps marker object
     * @param i
     */
    self.stopAnimationMarker = function( marker, i ) {
        marker.setAnimation( null );
    };


    // sticky maps functions
    /**
     * Set properties for sticky map and make sure Map Canvas height is less than 50% of window height viewport
     * Default Canvas height = 400 px (@see assets/css/gv-maps.css )
     */
    self.prepareStickyCanvas = function() {
        // set map container (just for sticky purposes)
        self.mapStickyContainer = $( '.gv-map-sticky-container' );

        var windowHeight = $( window ).height(),
            doubleCanvasHeight = self.mapStickyContainer.height() * 2;

        // if viewport height is less than 2x 400 px
        if( windowHeight < doubleCanvasHeight ) {
            $( '.gv-map-canvas').height( windowHeight / 2 );
        }

    };

    self.initOffset = function() {
        self.mapOffset = self.mapStickyContainer.offset().top;
    };

    self.setScroll = function() {
      self.didScroll = true;
    };

    self.startScrollCheck = function() {
        if( self.mapStickyContainer.length > 0 ) {
            $(window).one( 'scroll', self.initOffset );
            setInterval( self.runOnScroll, 250 );
        }
    };

    self.runOnScroll = function() {
        if( self.didScroll ) {
            self.didScroll = false;
            var scroll = $(window).scrollTop();
            var canvasObj = self.mapStickyContainer.find( '.' + self.map_id_prefix );
            var listObj = $( self.mapEntriesContainerClass );
            var canvasWidth = canvasObj.width(),
                canvasHeight = canvasObj.height();
            if( scroll >= self.mapOffset ) {
                canvasObj.width( canvasWidth );
                self.mapStickyContainer.addClass('gv-sticky');
                if( self.template_layout === 'top' ) {
                    listObj.css( 'margin-top', canvasHeight+'px' );
                }

            } else {
                canvasObj.width( '100%' );
                self.mapStickyContainer.removeClass('gv-sticky');
                if( self.template_layout === 'top' ) {
                    listObj.css( 'margin-top', '' );
                }
            }

        }
    };

    // Mobile

    /**
     * Check if the page is being loaded in a tablet/mobile environment,
     *  and if yes, run special functions
     * $mobile-portrait: 320px;
     * $mobile-landscape: 480px;
     * $small-tablet: 600px;
     */
    self.initMobile = function() {
        // only apply this logic for the map template containing the sticky map (even if it is not pinned)
        if( self.mapStickyContainer.length <= 0 ) {
            return;
        }

        var viewPort = $( window ).width();

        if( viewPort <= 600 ) {
            self.mobileMapToTop();
        }

    };

    /**
     * Move the sticky map to the top, when aligned to the right.
     */
    self.mobileMapToTop = function() {
        var parent =  self.mapStickyContainer.parent(),
            grandPa = $('.gv-map-container');

        if( parent.hasClass('gv-grid-col-1-3') && 1 === parent.index() ) {
            parent.detach().prependTo( grandPa );
        }

    };

    // helpers


    /**
     * Convert map type setting into google.maps object
     *
     * With style and position keys.
     *
     * For the position value, see [Google V3 API grid of positions](https://developers.google.com/maps/documentation/javascript/reference#ControlPosition)
     * Options include: BOTTOM_CENTER, BOTTOM_LEFT, BOTTOM_RIGHT, LEFT_BOTTOM, LEFT_CENTER, LEFT_TOP, RIGHT_BOTTOM, RIGHT_CENTER, RIGHT_TOP, TOP_CENTER, TOP_LEFT, TOP_RIGHT
     *
     * @returns {*}
     */
    self.zoomControlOptions = function() {
        return {
            'style': google.maps.ZoomControlStyle[ self.MapOptions.zoomControlOptions.style ],
            'position': google.maps.ControlPosition[ self.MapOptions.zoomControlOptions.position ]
        };
    };

	// Init!
	$( self.init );

    // window scroll
    $(window).scroll( self.setScroll );

}(jQuery));