<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package _makerspaces The mailing list for makerspaces is makerpro
 */
?>
<?php
   $context = null;
   if(UNIVERSAL_ASSET_USER && UNIVERSAL_ASSET_PASS) {
      $context = stream_context_create(array(
            'http' => array(
               'header'  => "Authorization: Basic " . base64_encode(UNIVERSAL_ASSET_USER.':'.UNIVERSAL_ASSET_PASS)
            )
      ));
   }
   echo file_get_contents( UNIVERSAL_ASSET_URL_PREFIX . '/wp-content/themes/memberships/universal-nav/universal-footer.html', false, $context);
?>

<!-- END new-footer -->

  <div class="fancybox-thx" style="display:none;">
    <div class="col-sm-4 hidden-xs nl-modal">
      <span class="fa-stack fa-4x">
      <i class="fa fa-circle-thin fa-stack-2x"></i>
      <i class="fa fa-thumbs-o-up fa-stack-1x"></i>
      </span>
    </div>
    <div class="col-sm-8 col-xs-12 nl-modal">
      <h3>Awesome!</h3>
      <p>Thanks for signing up.</p>
    </div>
    <div class="clearfix"></div>
  </div>

</div> <!-- .main-content -->

<div class="nl-thx" style="display:none;">
  <div class="col-sm-4 hidden-xs nl-modal">
    <span class="fa-stack fa-4x">
    <i class="fa fa-circle-thin fa-stack-2x"></i>
    <i class="fa fa-thumbs-o-up fa-stack-1x"></i>
    </span>
  </div>
  <div class="col-sm-8 col-xs-12 nl-modal">
    <h3>Your download should start automatically.</h3>
  </div>
  <div class="clearfix"></div>
</div>
<div class="nl-modal-error" style="display:none;">
    <div class="col-xs-12 nl-modal padtop">
        <p class="lead">The reCAPTCHA box was not checked. Please try again.</p>
    </div>
    <div class="clearfix"></div>
</div>

<?php wp_footer(); ?>

<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>

</body>
</html>