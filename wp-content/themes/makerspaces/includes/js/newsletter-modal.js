jQuery(document).ready( function( $ ) {
  var recaptchaKey = '6Lffo0EUAAAAABhGRLPk751JrmCLqR5bvUR9RYZJ';
  var recaptchaFooterDesk;
  var recaptchaFooterMob;
  var recaptchaHeader;
  var recaptchaPlaybook;
  onloadCallback = function() {
    if ( jQuery('#recapcha-footer-desktop').length ) {
      recaptchaFooterDesk = grecaptcha.render('recapcha-footer-desktop', {
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
});