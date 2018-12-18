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


function playbookSignup() {

	jQuery.post('https://secure.whatcounts.com/bin/listctrl', jQuery('.playbook-sub-form').serialize());

   jQuery('.nl-thx').trigger('click');

}

jQuery(document).on('submit', '.playbook-sub-form', function (e) {
  e.preventDefault();
  grecaptcha.execute();
});
