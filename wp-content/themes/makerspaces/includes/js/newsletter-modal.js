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
  //header desktop
  $(document).on('submit', '.whatcounts-signup', function (e) {
    e.preventDefault();
    $.post('https://secure.whatcounts.com/bin/listctrl', $('.whatcounts-signup').serialize());
    $('.nl-thx').trigger('click');
  });
  //footer desktop
  $(document).on('submit', '.whatcounts-signup1f', function (e) {
    e.preventDefault();
    $.post('https://secure.whatcounts.com/bin/listctrl', $('.whatcounts-signup1f').serialize());
    $('.nl-thx').trigger('click');
  });
  //footer mobile
  $(document).on('submit', '.whatcounts-signup1m', function (e) {
    e.preventDefault();
    $.post('https://secure.whatcounts.com/bin/listctrl', $('.whatcounts-signup1m').serialize());
    $('.nl-thx').trigger('click');
  });
  //playbook page
  $(document).on('submit', '.playbook-sub-form', function (e) {
    e.preventDefault();
    $.post('https://secure.whatcounts.com/bin/listctrl', $('.playbook-sub-form').serialize());
    $('.nl-thx').trigger('click');
  });
});