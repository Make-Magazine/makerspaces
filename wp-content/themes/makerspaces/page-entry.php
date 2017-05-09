<?php
/**
 * Template Name: Entry
 *
 * @package _makerspaces
 */

  global $wp_query;
  $entryId = $wp_query->query_vars['eid'];
  $entry = GFAPI::get_entry($entryId);
  //entry not found
  if(isset($entry->errors)) {
    $entry=array();
    $faire = '';
  } else {
    //find outwhich faire this entry is for to set the 'look for more makers link'
    $faire =$slug=$faireID=$show_sched=$faire_end='';
  }

  $a = (isset($entry['1']) ? $entry['1']:'');
  $b = (isset($entry['2']) ? $entry['2']:'');
  $c = (isset($entry['3']) ? $entry['3']:'');

get_header(); ?>

<div class="makerspace-entry">

  <div class="container">

    <div class="row padbottom">

      <div class="col-xs-12">

        <span class="text-mutted">Last updated Feburary 3.2017 <a href="#">Update this listing</a></span>

      </div>

    </div>

    <div class="row">

      <div class="col-xs-12 col-sm-5 col-md-6">

        <img src="/wp-content/themes/makerspaces/img/demo-entry-image.png" alt="Makerspace entry featured image" class="img-responsive" />

      </div>

      <div class="col-xs-12 col-sm-7 col-md-6 m-enty-header">

        <div class="m-entry-headertop">

          <h1>Be a Maker @ Betty Brinn Children's Museum</h1>

        </div>

        <div class="m-entry-headerbot">

          <a href="#" class="btn btn-lt-blue" target="_blank">WEBSITE</a>

          <div class="social-network-container">
            <ul class="social-network social-circle">
              <li><a href="https://www.facebook.com/makemagazine?_rdr" class="icoFacebook" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>
              <li><a href="https://twitter.com/make" class="icoTwitter" title="Twitter"><i class="fa fa-twitter" target="_blank"></i></a></li>
              <li><a href="https://instagram.com/makemagazine/" class="icoInstagram" title="Instagram"><i class="fa fa-instagram" target="_blank"></i></a></li>
              <li><a href="https://plus.google.com/communities/107377046073638428310" class="icoGoogle-plus" title="Google+"><i class="fa fa-google-plus" target="_blank"></i></a></li>
            </ul>    
          </div>

          <div>
            <hr />
          </div>

          <div class="row">

            <div class="col-xs-6">

              <h2><strong>Community Center Work</strong></h2>
              <p><strong>Address:</strong> 123 Apple St.</br>San Francisco, CA 90210</p>
              <p><strong>Phone:</strong> (415) 123-4567</p>

            </div>

            <div class="col-xs-6">

              <img class="img-responsive pull-right" src="http://lorempixel.com/output/transport-q-g-100-100-10.jpg" />

            </div>

          </div>

        </div><!-- m-entry-headerbot -->

      </div><!-- .m-enty-header -->

    </div>

    <div class="row m-entry-info-area">

      <div class="col-xs-12">

        <div class="m-entry-4col-no-bg">

          <div class="m-entry-4col-item">info 1</div>
          <div class="m-entry-4col-item">info 2</div>
          <div class="m-entry-4col-item">info 3</div>
          <div class="m-entry-4col-item">info 4</div>
          <div class="m-entry-4col-item">info 5</div>
          <div class="m-entry-4col-item">info 6</div>
          <div class="m-entry-4col-item">info 7</div>
          <div class="m-entry-4col-item">info 8</div>
          <div class="m-entry-4col-item">info 9</div>

        </div>

      </div>

    </div>

    <div class="row m-entry-info-area">

      <div class="col-xs-12">

        <h4>Basic Tools</h4>

        <div class="m-entry-4col-alt-bg">

          <div class="m-entry-4col-item">info 1</div>
          <div class="m-entry-4col-item">info 2</div>
          <div class="m-entry-4col-item">info 3</div>
          <div class="m-entry-4col-item">info 4</div>
          <div class="m-entry-4col-item">info 5</div>
          <div class="m-entry-4col-item">info 6</div>
          <div class="m-entry-4col-item">info 7</div>
          <div class="m-entry-4col-item">info 8</div>
          <div class="m-entry-4col-item">info 9</div>

        </div>

      </div>

    </div>

    <div class="row m-entry-info-area">

      <div class="col-xs-12">

        <h4>Activity Areas</h4>

        <div class="m-entry-4col-alt-bg">

          <div class="m-entry-4col-item">info 1</div>
          <div class="m-entry-4col-item">info 2</div>
          <div class="m-entry-4col-item">info 3</div>
          <div class="m-entry-4col-item">info 4</div>
          <div class="m-entry-4col-item">info 5</div>
          <div class="m-entry-4col-item">info 6</div>
          <div class="m-entry-4col-item">info 7</div>
          <div class="m-entry-4col-item">info 8</div>
          <div class="m-entry-4col-item">info 9</div>

        </div>

      </div>

    </div>

    <div class="row m-entry-info-area">

      <div class="col-xs-12">

        <h4>Members and Community</h4>

        <div class="m-entry-2col-alt-bg">

          <div class="m-entry-4col-item">info 1</div>
          <div class="m-entry-4col-item">info 2</div>
          <div class="m-entry-4col-item">info 3</div>
          <div class="m-entry-4col-item">info 4</div>
          <div class="m-entry-4col-item">info 5</div>
          <div class="m-entry-4col-item">info 6</div>
          <div class="m-entry-4col-item">info 7</div>
          <div class="m-entry-4col-item">info 8</div>
          <div class="m-entry-4col-item">info 9</div>

        </div>

      </div>

    </div>

    <div class="row m-entry-info-area">

      <div class="col-xs-12">

        <h4>Classes</h4>

        <div class="m-entry-2col-alt-bg">

          <div class="m-entry-4col-item">info 1</div>
          <div class="m-entry-4col-item">info 2</div>
          <div class="m-entry-4col-item">info 3</div>
          <div class="m-entry-4col-item">info 4</div>
          <div class="m-entry-4col-item">info 5</div>
          <div class="m-entry-4col-item">info 6</div>
          <div class="m-entry-4col-item">info 7</div>
          <div class="m-entry-4col-item">info 8</div>
          <div class="m-entry-4col-item">info 9</div>

        </div>

      </div>

    </div>

    <div class="row m-entry-info-area">

      <div class="col-xs-12">

        <h4>Safety</h4>

        <div class="m-entry-2col-alt-bg">

          <div class="m-entry-4col-item">info 1</div>
          <div class="m-entry-4col-item">info 2</div>
          <div class="m-entry-4col-item">info 3</div>
          <div class="m-entry-4col-item">info 4</div>
          <div class="m-entry-4col-item">info 5</div>
          <div class="m-entry-4col-item">info 6</div>
          <div class="m-entry-4col-item">info 7</div>
          <div class="m-entry-4col-item">info 8</div>
          <div class="m-entry-4col-item">info 9</div>

        </div>

      </div>

    </div>

  </div>

</div>

<?php get_footer(); ?>