=== GravityView - Maps ===
Tags: gravityview
Requires at least: 3.8
Tested up to: 4.5
Stable tag: trunk
Contributors: katzwebservices, luistinygod
License: GPL 3 or higher

Displays entries over a map using markers

== Description ==

### To set up:

* Use existing View connected to a form with an Address field
* Switch View Type, select Maps
* Add Address parent field to the Address zone
* Save the View
* Voilà

### Map Icons

GravityView Maps uses map icons from the [Maps Icons Collection by Nicolas Mollet](http://mapicons.nicolasmollet.com/). By default, a pre-selection of about 100 icons (from more than 700 available icons) has been added to the plugin.

== Installation ==

1. Upload plugin files to your plugins folder, or install using WordPress' built-in Add New Plugin installer
2. Activate the plugin
3. Configure "Maps" via the Maps metabox when editing a View

== Changelog ==

= 1.4.1 on April 7, 2016 =

* New: Configure info boxes to display additional information when clicking a map marker. [Learn how here!](http://docs.gravityview.co/article/345-how-to-configure-info-boxes)
* Fixed: "Undefined index" PHP warning on frontend when saving a new Map View for the first time
* No longer in beta!

__Developer Notes:__

* Added: Filter `gravityview/maps/field/icon_picker/button_text` to modify the text of the Icon Picker button (Default: "Select Icon")
* Added: Use the `gravityview/maps/marker/url` hook to filter the marker single entry view link url
* Added: Use the `gravityview/maps/render/options` hook to change the marker link target attribute (marker_link_target`). [Read more](http://docs.gravityview.co/article/339-how-can-i-make-the-marker-link-to-open-in-a-new-tab)

= 1.3-beta & 1.3.1-beta on November 13 =
* Added: Option to set map zoom, separate from maximum and minimum zoom levels. Note: this will only affect Entry Map field maps or maps with a single marker.
* Fixed: Don't show a map if longitude or latitude is empty
* Fixed: If entry has an icon already set, show it as selected in the icon picker

= 1.2-beta on September 25 =
* Fixed: Google Maps geocoding requires HTTPS connection
* Fixed: Support all WordPress HTTP connections, not just `cURL`
* Added: Custom filters to allow the usage of different fields containing the address value [Read more](http://docs.gravityview.co/article/292-how-can-i-pull-the-address-from-a-field-type-that-is-not-address)
* Added: Filter to enable marker position based on the latitude and longitude stored in the form fields [Read more](http://docs.gravityview.co/article/300-how-can-i-use-the-latitude-and-longitude-form-fields-to-position-map-markers)
* Added: Entry Map field on the Multiple Entries view
* Added: How-to articles showing how to sign up for Google, Bing, and MapQuest API keys
* Fixed: Map layers not working for multiple maps on same page
* Fixed: `GRAVITYVIEW_GOOGLEMAPS_KEY` constant not properly set
* Fixed: Error when `zoomControl` disabled and `zoomControlOptions` not default
* Modified: Check whether other plugins or themes have registered a Google Maps script. If it exists, use it instead to avoid conflicts.
* Tweak: Update CSS to prevent icon picker from rendering until Select Icon button is clicked
* Tweak: Update Google Maps script URL from `maps.google.com` to `maps.googleapis.com`

= 1.1-beta on September 10 =
* Added: Lots of map configuration options
    - Map Layers (traffic, transit, bike path options)
    - Minimum/Maximum Zoom
    - Zoom Control (none, small, large, let Google decide)
    - Draggable Map (on/off)
    - Double-click Zoom (on/off)
    - Scroll to Zoom (on/off)
    - Pan Control (on/off)
    - Street View (on/off)
    - Custom Map Styles (via [SnazzyMaps.com](http://snazzymaps.com)
* Fixed: Single entry map not rendering properly
* Fixed: Reversed `http` and `https` logic for Google Maps script
* Fixed: Only attempt to geocode an address if the address exists (!)
* Fixed: Only render map if there are map markers to display
* Tweak: Added support for using longitude & latitude fields instead of an Address field [learn how](http://docs.gravityview.co/article/300-how-can-i-use-the-latitude-and-longitude-form-fields-to-position-map-markers)
* Tweak: Hide illogical field settings
* Tweak: Improved translation file fetching support

= 1.0.3-beta on August 4 =
* Added: Ability to prevent the icon from bouncing on the map when hovering over an entry [see sample code](https://gist.github.com/zackkatz/635638dc761f6af8920f)
* Modified: Set a `maxZoom` default of `16` so that maps on the single entry screen aren't too zoomed in
* Fixed: Map settings filtering out `false` values, which caused the `gravityview/maps/render/options` filter to not work properly
* Fixed: Map settings conflicting with Edit Entry feature for subscribers
* Fixed: `Fatal error: Call to undefined method GFCommon::is_entry_detail_edit()`
* Updated: French, Turkish, Hungarian, and Danish translations. Thanks to all the translators!

= 1.0.2-beta on May 15 =
* Added: New Gravity Forms field type: Map Icon. You can choose different map markers per entry.
* Added: Middle field zone in View Configuration
* Tweak: Improved styling of the map using CSS
* Updated Translations

= 1.0.1-beta =
* Fixed missing Geocoding library
* Updated translations

= 1.0-beta =
* Initial release