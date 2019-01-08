=== GravityView - Advanced Filter Extension ===
Tags: gravityview
Requires at least: 3.3
Tested up to: 4.9.7
Stable tag: trunk
Contributors: katzwebservices
License: GPL 3 or higher

Filter which entries are shown in a View based on their values.

== Installation ==

1. Upload plugin files to your plugins folder, or install using WordPress' built-in Add New Plugin installer
2. Activate the plugin
3. Follow the instructions

== Changelog ==

= 1.3 on July 11, 2018 =

* Added: Filter entries by the role of the entry creator - big thanks to [Naomi C. Bush from gravity+](https://gravityplus.pro)!
* Added: Filter by the roles of the currently logged-in user
* Added: Filter by entry Approval Status without needing the Approval form field - [Learn how to filter by approval status](https://docs.gravityview.co/article/470-filtering-by-entry-approval-status)

= 1.2 on May 23, 2018 =

**Important update - please update as soon as possible.**

Fixed: With Gravity Forms 2.3, when using "Created By" filters, the search mode was allowed to be "Any". For Views with the "Any" setting, searches were able to be performed without filters applied.

= 1.1 on May 2, 2018 =

* Fixed: Filtering by Entry ID not working in Gravity Forms 2.3
* Fixed: Filtering by relative date `today` was showing yesterday's entries on GMT websites
* Changed option names:
    - From "Logged-in User" to "Currently Logged-in User"
    - From "Logged-in User" to "Currently Logged-in User (Disabled for Administrators)"
* Updated Dutch translations—thank you, Erik van Beek!

= 1.0.20 on February 28, 2017 =

* Fixed: Filtering by "Entry ID" not saving
* Fixed: Filtering by a checkbox or multiselect field can prevent viewing a single entry
* Updated translations: Danish, Spanish (Mexico), French, Norwegian, Portuguese (Brazil)

= 1.0.19 on January 5, 2017 =

* Fixed: Fatal error in the Dashboard if `GravityView_View` is not set
* Fixed: Prevent accessing plugin file directly

= 1.0.18 on December 14, 2016 =
* Fixed: Issue with "Any form field" filters preventing access to single entries
* New translations: Spanish translation by Joaquin Rodriguez, German translation by Hubert Test. Thank you!

= 1.0.17 on June 20, 2016 =
* __Important update__: Fixed security issue introduced in 1.0.16 where logged-in users can see all entries.
* Changed "Created by (or admin)" filter to use `gravityview_edit_others_entries` capability instead of `gravityview_view_others_entries`

= 1.0.16 on May 13, 2016 =
* Fixed: If a View has an empty "Any field has" filter, it prevents accessing single entries
* Updated: "Created by (or admin)" filter now also allows users with the `gravityview_view_others_entries` capability to see entries
* Now requires GravityView 1.15 or newer
* Added additional logging

= 1.0.15 on May 7, 2016 =
* Fixed: Allow comparing against empty field values
* Fixed: Properly replace Merge Tags when using using "Any form field" filter
* Added: Chinese translation (Thanks, Edi Weigh!)

= 1.0.14 on February 27, 2016 =
* Fixed: When saving a filter condition using a product field the operator "is" disappears
* Fixed: When searching by an option field there were no results

= 1.0.12 & 1.0.13 on January 21, 2016 =
* Fixed: Post Category filters
    - Dropdown not populated with categories
    - Added "Is Not" option
* Fixed: Date Created filter not working properly
* Tweak: Increase the number of users displayed in the Advanced Filter "Created By" dropdown
* Updated: Translation textdomain from `gravity-view-advanced-filter` to `gravityview-advanced-filter`
    - Included updater library in translation strings

= 1.0.11 on November 13 =
* New: Add "is not" option to GravityView Approval fields. Now you can show only unapproved entries.
* Tweak: Make it clearer in the logs when the extension is preventing displaying results for security
* Updated: Extension updater script

= 1.0.10 on September 13 =
* Fixed: Not able to enter relative dates (like `now` or `two weeks ago`) in date field filters
* Updated: Extension updater script

= 1.0.9 on August 4 =
* Added: New filter to disable the entries' filter "created by the current logged-in user" when user is administrator
* Updated: French translation

= 1.0.8 on June 23 =
* Fixed: Error on WordPress Dashboard preventing Gravity Forms widget from displaying

= 1.0.7 on June 22 =
* Fixed: Filtering by date fields when using PHP `strtotime()` values like `-3 days` or `+3 weeks`
* Added: Prevent showing anything if the View ID isn't set when filtering results
* Updated: Hungarian translation by [dbalage](https://www.transifex.com/accounts/profile/dbalage/) and Dutch translation by [@erikvanbeek](https://www.transifex.com/accounts/profile/erikvanbeek/)

= 1.0.6 on December 22 =
* Fixed: Entries were being shown for users who were not logged in

= 1.0.5 on December 12 =
* Fixed: not filtering if only one filter is defined.

= 1.0.4 on December 11 =
* Fixed: Do not show entries for non logged users when the 'Created By' field value is 'Logged-in user'
* Tweak: Added `gravityview/adv_filter/view_filters` filter to allow modifying the filters generated by the Extension
* Fixed: Auto-upgrade for Multisite sites
* Added: Dutch translation (thanks, [@erikvanbeek](https://www.transifex.com/accounts/profile/erikvanbeek/)!)

= 1.0.3 on November 7 =
* Added: Support for relative dates ("now" or "-3 days") for date type fields
* Added: Support Gravity Forms Merge Tags. Example: "`{user:display_name}` IS `Ellen Ripley`"
* Fixed: Conflicts with non-Latin UTF-8 characters like "ß"
* Added: Romanian translation (thanks, [@ArianServ](https://www.transifex.com/accounts/profile/ArianServ/)!) and Dutch translation (thanks, [@erikvanbeek](https://www.transifex.com/accounts/profile/erikvanbeek/)!)
* Updated: Bengali, Turkish, and Spanish translations (thanks, [@tareqhi](https://www.transifex.com/accounts/profile/tareqhi/), [@suhakaralar](https://www.transifex.com/accounts/profile/suhakaralar/), and [@jorgepelaez](https://www.transifex.com/accounts/profile/jorgepelaez/))

= 1.0.2 on September 9 =
* Fixed: Conflict with other GravityView search parameters
* Updated: Bengali, Turkish, and Spanish translations (thanks, [@tareqhi](https://www.transifex.com/accounts/profile/tareqhi/), [@suhakaralar](https://www.transifex.com/accounts/profile/suhakaralar/), and [@jorgepelaez](https://www.transifex.com/accounts/profile/jorgepelaez/))
* Fixes fatal error on Views screen when deleting a View

= 1.0.1 on August 5 =
* Fixed: Scripts not being added in No-Conflict mode
* Added: Romanian translation - thanks, [ArianServ](https://www.transifex.com/accounts/profile/ArianServ/)!

= 1.0.0 on August 4 =
* Liftoff!
