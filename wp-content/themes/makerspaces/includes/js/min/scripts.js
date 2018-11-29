// Compiled file - any changes will be overwritten by grunt task
//!!
//!! includes/js/auth0-variables.js
var AUTH0_CLIENT_ID    = 'fTi1CY51C4mP7cWid8IpxJsAmk7uJS7i';
var AUTH0_DOMAIN       = 'makermedia.auth0.com';

if (typeof templateUrl === 'undefined') {
  var templateUrl = window.location.origin;
}
var AUTH0_CALLBACK_URL = templateUrl + "/authenticate-redirect/";
var AUTH0_REDIRECT_URL = templateUrl;;//!!
//!! includes/js/auth0.js
window.addEventListener('load', function() {
  // buttons and event listeners
  /*    If the login button, logout button or profile view elements do not exist
   *    (such as on the admin and login pages) default to a 'fake' element
   */
  if ( !jQuery( "#newLoginBtn" ).length ) {
    var loginBtn = document.createElement('div');
    loginBtn.setAttribute("id", "newLoginBtn");
  }else{
    var loginBtn    = document.getElementById('newLoginBtn');
  }

  if ( !jQuery( "#newLogoutBtn" ).length ) {
    var logoutBtn = document.createElement('div');
    logoutBtn.setAttribute("id", "newLogoutBtn");
  }else{
    var logoutBtn    = document.getElementById('newLogoutBtn');
  }

  if ( !jQuery( "#profile-view" ).length ) {
    var profileView = document.createElement('div');
    profileView.setAttribute("id", "profile-view");
  }else{
    var profileView    = document.getElementById('profile-view');
  }

  //default profile view to hidden
  loginBtn.style.display    = 'none';
  profileView.style.display = 'none';

  var userProfile;
  var webAuth = new auth0.WebAuth({
    domain: AUTH0_DOMAIN,
    clientID: AUTH0_CLIENT_ID,
    redirectUri: AUTH0_CALLBACK_URL,
    audience: 'https://' + AUTH0_DOMAIN + '/userinfo',
    responseType: 'token id_token',
    scope: 'openid profile email',
    leeway: 60
  });

  loginBtn.addEventListener('click', function(e) {
    e.preventDefault();
    localStorage.setItem('redirect_to',location.href);
    webAuth.authorize(); //login to auth0
  });

  logoutBtn.addEventListener('click', function(e) {
    e.preventDefault();

    // Remove tokens and expiry time from localStorage
    localStorage.removeItem('access_token');
    localStorage.removeItem('id_token');
    localStorage.removeItem('expires_at');

    //hide logged in button and logout of wp and auth0
    displayButtons();
  });
    
  function loginRedirect() {
      if ( jQuery( '#authenticated-redirect' ).length ) { //are we on the authentication page?
          if( localStorage.getItem( 'redirect_to' ) ){
            jQuery( '.redirect-message' ).text( "You will be redirected to the page you were trying to access shortly." );
            var redirect_url = localStorage.getItem( 'redirect_to' ); //retrieve redirect URL
            localStorage.removeItem( 'redirect_to' ); //unset after retrieved
            location.href = redirect_url;
          }else{ 
            // this is what's sometimes when the page redirects to the homepage instead of to the url
            location.href = templateUrl;
          }
      }
  }

  function setSession(authResult) {
    // Set the time that the access token will expire at
    var expiresAt = JSON.stringify(
      authResult.expiresIn * 1000 + new Date().getTime()
    );
    localStorage.setItem('access_token', authResult.accessToken);
    localStorage.setItem('id_token', authResult.idToken);
    localStorage.setItem('expires_at', expiresAt);
  }

  function isAuthenticated() {
    // Check whether the current time is past the access token's expiry time
    if(localStorage.getItem('expires_at')){
      var expiresAt = JSON.parse(localStorage.getItem('expires_at'));
      return new Date().getTime() < expiresAt;
    }else{
      return false;
    }
  }

  function displayButtons() {
    if (isAuthenticated()) {
      loginBtn.style.display = 'none';

      //get user profile from auth0
      profileView.style.display = 'flex';
      getProfile();

      //login to wordpress if not already
      //check for wordpress cookie
      if ( !jQuery( '.logged-in' ).length ) { // is the user logged in?
        //wait .5 second for auth0 data to be returned from getProfile
        setTimeout(function(){ WPlogin(); }, 0500); //login to wordpress
      } else {
          loginRedirect();
      }
    } else {
      loginBtn.style.display = 'flex';
      profileView.style.display = 'none';

      if ( jQuery( '.logged-in' ).length ) { // is the user logged in?
        //logout of wordpress if not already
        WPlogout();//login to wordpress
      } else {
        loginRedirect();
      }
    }
  }

  function getProfile() {
    var accessToken = localStorage.getItem('access_token');

    if (!accessToken) {
      console.log('Access token must exist to fetch profile');
    }

    webAuth.client.userInfo(accessToken, function(err, profile) {
      if (profile) {
        userProfile = profile;
        // display the avatar
        document.querySelector('#profile-view img').src = userProfile.picture;
        document.querySelector('#profile-view img').style.display = "block";
		  document.querySelector('#profile-view .profile-email').innerHTML = userProfile.email; 
      }
    });
  }

  function WPlogin(){
    if (typeof userProfile !== 'undefined') {
      var user_id      = userProfile.sub;
      var access_token = localStorage.getItem('access_token');
      var id_token     = localStorage.getItem('id_token');

      //login to wordpress
      var data = {
        'action'              : 'mm_wplogin',
        'auth0_userProfile'   : userProfile,
        'auth0_access_token'  : access_token,
        'auth0_id_token'      : id_token
      };
      jQuery.post(ajax_object.ajax_url, data, function(response) {
          
      	loginRedirect(); // everything went according to plan

      }).fail(function() {
        alert( "I'm sorry. We had an issue logging you into our system. Please try the login again." );
        if ( jQuery( '#authenticated-redirect' ).length ) { 
            jQuery( ".redirect-message" ).text("I'm sorry. We had an issue logging you into our system. Please try the login again.");
            location.href=templateUrl;
        }
      });
    }else{
       if ( jQuery( '#authenticated-redirect' ).length ) {
          console.log('undefined');
          alert("We're having trouble logging you in and ran out of time. Refresh the page and we'll try harder.");
		    jQuery(".redirect-message").html("<a href='javascript:location.reload();'>Reload page</a>");
      }
    }
  }

  function WPlogout(){
    //logout of wordpress
    var data = {
      'action': 'mm_wplogout'
    };
    if ( jQuery( '#wpadminbar' ).length ) {
        jQuery( 'body' ).removeClass( 'adminBar' ).removeClass( 'logged-in' );
        jQuery( '#wpadminbar' ).remove();
        jQuery( '#mm-preview-settings-bar' ).remove();
    }

    jQuery.post(ajax_object.ajax_url, data, function(response) {
      window.location.href = 'https://makermedia.auth0.com/v2/logout?returnTo='+templateUrl+ '&client_id='+AUTH0_CLIENT_ID;
    });
  }

  //check if logged in another place
  webAuth.checkSession({},
    function(err, result) {
      if (err) {
        // Remove tokens and expiry time from localStorage
        localStorage.removeItem('access_token');
        localStorage.removeItem('id_token');
        localStorage.removeItem('expires_at');
        if(err.error!=='login_required'){
          console.log(err);
        }
      } else {
        setSession(result);
      }
      displayButtons();
    }
  );

});;//!!
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
});


var recaptchaKey = '6Lf_-kEUAAAAAHtDfGBAleSvWSynALMcgI1hc_tP';
onloadCallback = function() {
  if ( jQuery('#recapcha-footer-desktop').length ) {
    grecaptcha.render('recapcha-footer-desktop', {
      'sitekey' : recaptchaKey,
      'callback' : onSubmitFooterDesk
    });
  }
  if ( jQuery('#recapcha-footer-mobile').length ) {
    grecaptcha.render('recapcha-footer-mobile', {
      'sitekey' : recaptchaKey,
      'callback' : onSubmitFooterMob
    });
  }
  if ( jQuery('#recapcha-header').length ) {
    grecaptcha.render('recapcha-header', {
      'sitekey' : recaptchaKey,
      'callback' : onSubmitHeader
    });
  }
  if ( jQuery('#recapcha-playbook').length ) {
    grecaptcha.render('recapcha-playbook', {
      'sitekey' : recaptchaKey,
      'callback' : onSubmitPlaybook
    });
  }
};
//header desktop
var onSubmitHeader = function(token) {
  jQuery.post('https://secure.whatcounts.com/bin/listctrl', jQuery('.whatcounts-signup').serialize());
  jQuery('.nl-thx').trigger('click');
}
jQuery(document).on('submit', '.whatcounts-signup', function (e) {
  e.preventDefault();
  onSubmitHeader();
});
//footer desktop
var onSubmitFooterDesk = function(token) {
  jQuery.post('https://secure.whatcounts.com/bin/listctrl', jQuery('.whatcounts-signup1f').serialize());
  jQuery('.nl-thx').trigger('click');
}
jQuery(document).on('submit', '.whatcounts-signup1f', function (e) {
  e.preventDefault();
  onSubmitFooterDesk();
});
//footer mobile
var onSubmitFooterMob = function(token) {
  jQuery.post('https://secure.whatcounts.com/bin/listctrl', jQuery('.whatcounts-signup1m').serialize());
  jQuery('.nl-thx').trigger('click');
}
jQuery(document).on('submit', '.whatcounts-signup1m', function (e) {
  e.preventDefault();
  onSubmitFooterMob();
});
//playbook page
var onSubmitPlaybook = function(token) {
  jQuery.post('https://secure.whatcounts.com/bin/listctrl', jQuery('.playbook-sub-form').serialize());
  jQuery('.nl-thx').trigger('click');
}
jQuery(document).on('submit', '.playbook-sub-form', function (e) {
  e.preventDefault();
  onSubmitPlaybook();
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