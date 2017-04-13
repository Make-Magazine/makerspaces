// Compiled file - any changes will be overwritten by grunt task
//!!
//!! includes/js/bootstrap-wp.js
jQuery( document ).ready( function( $ ) {

  // here for each comment reply link of wordpress
  $( '.comment-reply-link' ).addClass( 'btn btn-primary' );

  // here for the submit button of the comment reply form
  $( '#commentsubmit' ).addClass( 'btn btn-primary' );

  // The WordPress Default Widgets
  // Now we'll add some classes for the wordpress default widgets - let's go


  // the search widget
  $( '.widget_search input.search-field' ).addClass( 'form-control' );
  $( '.widget_search input.search-submit' ).addClass( 'btn btn-default' );

  $( '.widget_rss ul' ).addClass( 'media-list' );

  $( '.widget_meta ul, .widget_recent_entries ul, .widget_archive ul, .widget_categories ul, .widget_nav_menu ul, .widget_pages ul' ).addClass( 'nav' );

  $( '.widget_recent_comments ul#recentcomments' ).css( 'list-style', 'none').css( 'padding-left', '0' );
  $( '.widget_recent_comments ul#recentcomments li' ).css( 'padding', '5px 15px');

  $( 'table#wp-calendar' ).addClass( 'table table-striped');
});
;//!!
//!! includes/js/skip-link-focus-fix.js
( function() {
  var is_webkit = navigator.userAgent.toLowerCase().indexOf( 'webkit' ) > -1,
      is_opera  = navigator.userAgent.toLowerCase().indexOf( 'opera' )  > -1,
      is_ie     = navigator.userAgent.toLowerCase().indexOf( 'msie' )   > -1;

  if ( ( is_webkit || is_opera || is_ie ) && 'undefined' !== typeof( document.getElementById ) ) {
    var eventMethod = ( window.addEventListener ) ? 'addEventListener' : 'attachEvent';
    window[ eventMethod ]( 'hashchange', function() {
      var element = document.getElementById( location.hash.substring( 1 ) );

      if ( element ) {
        if ( ! /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) )
          element.tabIndex = -1;

        element.focus();
      }
    }, false );
  }
})();