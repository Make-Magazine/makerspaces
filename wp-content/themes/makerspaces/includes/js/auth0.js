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

      //login redirect
      if ( jQuery( '#authenticated-redirect' ).length ) { //are we on the authentication page?
        if(localStorage.getItem('redirect_to')){    //redirect
          var redirect_url = localStorage.getItem('redirect_to'); //retrieve redirect URL
          localStorage.removeItem('redirect_to'); //unset after retrieved
          location.href=redirect_url;
        }else{  //redirect to home page
          location.href=templateUrl;
        }
      }
    } else {
      loginBtn.style.display = 'flex';
      profileView.style.display = 'none';
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

});