jQuery(document).ready( function( $ ) {
  $(".fancybox-thx").fancybox({
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
});