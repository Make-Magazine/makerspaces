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
//!! includes/js/newsletter-modal.js
jQuery(document).ready( function( $ ) {
  var recaptchaKey = '6Lf_-kEUAAAAAHtDfGBAleSvWSynALMcgI1hc_tP';
  var recaptchaFootDesk;
  var recaptchaFooterMob;
  var recaptchaHeader;
  var recaptchaPlaybook;
  onloadCallback = function() {
    if ( jQuery('#recapcha-footer-desktop').length ) {
      recaptchaFootDesk = grecaptcha.render('recapcha-footer-desktop', {
        'sitekey' : recaptchaKey
      });
    }
    if ( jQuery('#recapcha-footer-mobile').length ) {
      recaptchaFooterMob = grecaptcha.render('recapcha-footer-mobile', {
        'sitekey' : recaptchaKey
      });
    }
    if ( jQuery('#recapcha-header').length ) {
      recaptchaHeader = grecaptcha.render('recapcha-header', {
        'sitekey' : recaptchaKey
      });
    }
    if ( jQuery('#recapcha-playbook').length ) {
      recaptchaPlaybook = grecaptcha.render('recapcha-playbook', {
        'sitekey' : recaptchaKey
      });
    }
  };

  $(".nl-thx").fancybox({
    autoSize : false,
    width  : 400,
    autoHeight : true,
    padding : 0,
    afterLoad   : function() {
      this.content = this.content.html();
    }
  });
  $(".nl-modal-error").fancybox({
    autoSize : false,
    width  : 250,
    autoHeight : true,
    padding : 0,
    afterLoad   : function() {
      this.content = this.content.html();
    }
  });
  
  //header desktop
  $(document).on('submit', '.whatcounts-signup', function (e) {
    e.preventDefault();
    if ( grecaptcha.getResponse(recaptchaHeader) != "" ) {
      $.post('https://secure.whatcounts.com/bin/listctrl', $('.whatcounts-signup').serialize());
      $('.nl-thx').trigger('click');
    } else {
      $('.nl-modal-error').trigger('click');
    }
  });
  //footer desktop
  $(document).on('submit', '.whatcounts-signup1f', function (e) {
    e.preventDefault();
    if ( grecaptcha.getResponse(recaptchaFootDesk) != "" ) {
      $.post('https://secure.whatcounts.com/bin/listctrl', $('.whatcounts-signup1f').serialize());
      $('.nl-thx').trigger('click');
    } else {
      $('.nl-modal-error').trigger('click');
    }
  });
  //footer mobile
  $(document).on('submit', '.whatcounts-signup1m', function (e) {
    e.preventDefault();
    if ( grecaptcha.getResponse(recaptchaFooterMob) != "" ) {
      $.post('https://secure.whatcounts.com/bin/listctrl', $('.whatcounts-signup1m').serialize());
      $('.nl-thx').trigger('click');
    } else {
      $('.nl-modal-error').trigger('click');
    }
  });
  //playbook page
  $(document).on('submit', '.playbook-sub-form', function (e) {
    e.preventDefault();
    if ( grecaptcha.getResponse(recaptchaPlaybook) != "" ) {
      $.post('https://secure.whatcounts.com/bin/listctrl', $('.playbook-sub-form').serialize());
      $('.nl-thx').trigger('click');
    } else {
      $('.nl-modal-error').trigger('click');
    }
  });
});;//!!
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