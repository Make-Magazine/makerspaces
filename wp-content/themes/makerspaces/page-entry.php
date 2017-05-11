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

  $title    = (isset($entry['1']) ? $entry['1']:'');
  $website      = (isset($entry['2']) ? $entry['2']:'');
  $contact_email    = (isset($entry['9']) ? $entry['9']:'');
  $contact_phone = (isset($entry['10']) ? $entry['10']:'');
  $city = (isset($entry['11']) ? $entry['11']:'');
  $state = (isset($entry['12']) ? $entry['12']:'');
  $zip = (isset($entry['13']) ? $entry['13']:'');
  $space_type = (isset($entry['14']) ? $entry['14']:''); //checkboxes
  $days_open = (isset($entry['15']) ? $entry['15']:''); //checkboxes
  $open_hours = (isset($entry['16']) ? $entry['16']:'');
  $membership = (isset($entry['17']) ? $entry['17']:''); //checkbox
  $offer_tours = (isset($entry['18']) ? $entry['18']:'');
  $under_18 = (isset($entry['19']) ? $entry['19']:''); //checkbox
  $offer_classes = (isset($entry['20']) ? $entry['20']:''); //checkbox
  $equip_classes = (isset($entry['23']) ? $entry['23']:''); //checkbox
  $required_classes = (isset($entry['24']) ? $entry['24']:''); //checkbox
  $skill_classes = (isset($entry['25']) ? $entry['25']:'');
  $minor_classes = (isset($entry['26']) ? $entry['26']:''); //checkboxes
  $class_price = (isset($entry['27']) ? $entry['27']:''); //checkboxes
  $class_quantity = (isset($entry['28']) ? $entry['28']:''); //checkboxes
  $finding_instructors = (isset($entry['29']) ? $entry['29']:''); //checkboxes
  $feedback = (isset($entry['30']) ? $entry['30']:''); //checkboxes
  $safty_waiver = (isset($entry['32']) ? $entry['32']:''); //checkboxes
  $safty_equip = (isset($entry['33']) ? $entry['33']:''); //checkboxes
  $safty_training = (isset($entry['34']) ? $entry['34']:''); //checkboxes
  $safty_informal = (isset($entry['35']) ? $entry['35']:''); //checkboxes
  $members = (isset($entry['37']) ? $entry['37']:''); //checkboxes
  $busiest = (isset($entry['38']) ? $entry['38']:''); //checkboxes
  $non_members = (isset($entry['39']) ? $entry['39']:''); //checkboxes
  $recruit = (isset($entry['40']) ? $entry['40']:''); //checkboxes
  $minor_members = (isset($entry['41']) ? $entry['41']:'');
  $membership_packages = (isset($entry['42']) ? $entry['42']:''); //checkboxes
  $student_discount = (isset($entry['43']) ? $entry['43']:''); //checkboxes
  $member_spaces = (isset($entry['44']) ? $entry['44']:''); //checkboxes
  $member_events = (isset($entry['45']) ? $entry['45']:''); //checkboxes
  $kitchen = (isset($entry['46']) ? $entry['46']:''); //checkboxes
  $event_space = (isset($entry['47']) ? $entry['47']:''); //checkboxes
  $community_engagement = (isset($entry['48']) ? $entry['48']:''); //checkboxes
  $community_building = (isset($entry['49']) ? $entry['49']:''); //checkboxes
  $space_age = (isset($entry['51']) ? $entry['51']:''); //checkboxes
  $area_type = (isset($entry['52']) ? $entry['52']:''); //checkboxes
  $zoned = (isset($entry['53']) ? $entry['53']:''); //checkboxes
  $space_size = (isset($entry['54']) ? $entry['54']:'');
  $management = (isset($entry['55']) ? $entry['55']:''); //checkboxes
  $board = (isset($entry['56']) ? $entry['56']:''); //checkboxes
  $incorporated = (isset($entry['57']) ? $entry['57']:''); //checkboxes
  $nonprofit = (isset($entry['58']) ? $entry['58']:''); //checkboxes
  $associated = (isset($entry['59']) ? $entry['59']:''); //checkboxes
  $associated_co = (isset($entry['60']) ? $entry['60']:''); //checkboxes
  $funding = (isset($entry['61']) ? $entry['61']:''); //checkboxes

  //Basic tools
  $hand_tools = (isset($entry['63']) ? $entry['63']:''); //checkboxes
  $power_tools = (isset($entry['64']) ? $entry['64']:''); //checkboxes
  $elec_tools = (isset($entry['65']) ? $entry['65']:''); //checkboxes
  $computers = (isset($entry['66']) ? $entry['66']:''); //checkboxes
  $cnc = (isset($entry['69']) ? $entry['69']:''); //checkboxes
  $printing3d = (isset($entry['70']) ? $entry['70']:''); //checkboxes
  $lasercutter = (isset($entry['71']) ? $entry['71']:''); //checkboxes
  $vinylcutter = (isset($entry['72']) ? $entry['72']:''); //checkboxes
  $waterjet = (isset($entry['73']) ? $entry['73']:''); //checkboxes
  $pcrtools = (isset($entry['77']) ? $entry['77']:''); //checkboxes

  //Activity Ares
  $woodworking = (isset($entry['68']) ? $entry['68']:''); //checkboxes
  $metalworking = (isset($entry['67']) ? $entry['67']:''); //checkboxes
  $textiles = (isset($entry['74']) ? $entry['74']:''); //checkboxes
  $silkscreening = (isset($entry['75']) ? $entry['75']:''); //checkboxes
  $autoshop = (isset($entry['76']) ? $entry['76']:''); //checkboxes
  $blacksmithing = (isset($entry['78']) ? $entry['78']:''); //checkboxes
  $ceramics = (isset($entry['79']) ? $entry['79']:''); //checkboxes
  $audio_visual = (isset($entry['80']) ? $entry['80']:''); //checkboxes
  $others_facilities = (isset($entry['81']) ? $entry['81']:''); //checkboxes


  $sell_consumables = (isset($entry['82']) ? $entry['82']:''); //checkboxes
  $contact_name = (isset($entry['84']) ? $entry['84']:''); //checkboxes
  $contact_role = (isset($entry['85']) ? $entry['85']:''); //checkboxes
  $contact_email = (isset($entry['86']) ? $entry['86']:''); //checkboxes
  $survey_feedback = (isset($entry['87']) ? $entry['87']:''); //checkboxes
  $gotoentry = (isset($entry['88']) ? $entry['88']:''); //checkboxes


get_header(); ?>

<div class="makerspace-entry">

  <div class="container">

<!--     <div class="row padbottom">

      <div class="col-xs-12">

        <span class="text-mutted">Last updated Feburary 3.2017 <a href="#">Update this listing</a></span>

      </div>

    </div> -->

    <div class="row m-enty-header">

      <div class="col-xs-12 col-sm-5 col-md-6">

        <img src="/wp-content/themes/makerspaces/img/demo-entry-image.png" alt="Makerspace entry featured image" class="img-responsive" />

      </div>

      <div class="col-xs-12 col-sm-7 col-md-6 m-enty-header-r">

        <div class="m-entry-headertop">

          <h1><?php echo $title; ?></h1>

        </div>

        <div class="m-entry-headerbot">

          <a href="<?php echo $website; ?>" class="btn btn-lt-blue" target="_blank">WEBSITE</a>

<!--           <div class="social-network-container">
            <ul class="social-network social-circle">
              <li><a href="https://www.facebook.com/makemagazine?_rdr" class="icoFacebook" title="Facebook" target="_blank"><i class="fa fa-facebook"></i></a></li>
              <li><a href="https://twitter.com/make" class="icoTwitter" title="Twitter"><i class="fa fa-twitter" target="_blank"></i></a></li>
              <li><a href="https://instagram.com/makemagazine/" class="icoInstagram" title="Instagram"><i class="fa fa-instagram" target="_blank"></i></a></li>
              <li><a href="https://plus.google.com/communities/107377046073638428310" class="icoGoogle-plus" title="Google+"><i class="fa fa-google-plus" target="_blank"></i></a></li>
            </ul>    
          </div> -->

          <div>
            <hr />
          </div>

          <div class="row">

            <div class="col-xs-6">

              <!-- <h2><strong>Community Center Work</strong></h2> -->
              <p><strong>Address:</strong> ?street address?</br><?php echo $city; ?>, <?php echo $state; ?> <?php echo $zip; ?></p>
              <?php if ($contact_phone != ''){?><p><strong>Phone:</strong> <?php echo $contact_phone; ?></p><?php } ?>
              <?php if ($contact_email != ''){?><p><strong>Email:</strong> <?php echo $contact_email; ?></p><?php } ?>

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

          <?php if ($hand_tools=='Yes'){?><div class="m-entry-4col-item">Basic Hand Tools</div><?php } ?>
          <?php if ($power_tools=='Yes'){?><div class="m-entry-4col-item">Basic Power Tools</div><?php } ?>
          <?php if ($elec_tools=='Yes'){?><div class="m-entry-4col-item">Basic Electric Tools</div><?php } ?>
          <?php if ($computers=='Yes'){?><div class="m-entry-4col-item">Computers</div><?php } ?>
          <?php if ($cnc=='Yes'){?><div class="m-entry-4col-item">CNC</div><?php } ?>
          <?php if ($printing3d=='Yes'){?><div class="m-entry-4col-item">3D Printing</div><?php } ?>
          <?php if ($lasercutter=='Yes'){?><div class="m-entry-4col-item">Laser Cutter</div><?php } ?>
          <?php if ($vinylcutter=='Yes'){?><div class="m-entry-4col-item">Vinyl Cutter</div><?php } ?>
          <?php if ($waterjet=='Yes'){?><div class="m-entry-4col-item">Waterjet</div><?php } ?>
          <?php if ($pcrtools=='Yes'){?><div class="m-entry-4col-item">PCR Tools (Biotech)</div><?php } ?>

        </div>

      </div>

    </div>

    <div class="row m-entry-info-area">

      <div class="col-xs-12">

        <h4>Activity Areas</h4>

        <div class="m-entry-4col-alt-bg">

          <?php if ($woodworking=='Yes'){?><div class="m-entry-4col-item">Woodworking</div><?php } ?>
          <?php if ($metalworking=='Yes'){?><div class="m-entry-4col-item">Metalworking</div><?php } ?>
          <?php if ($textiles=='Yes'){?><div class="m-entry-4col-item">Textiles</div><?php } ?>
          <?php if ($silkscreening=='Yes'){?><div class="m-entry-4col-item">Silkscreening</div><?php } ?>
          <?php if ($autoshop=='Yes'){?><div class="m-entry-4col-item">Autoshop</div><?php } ?>
          <?php if ($blacksmithing=='Yes'){?><div class="m-entry-4col-item">Blacksmithing</div><?php } ?>
          <?php if ($ceramics=='Yes'){?><div class="m-entry-4col-item">Ceramics/Glass</div><?php } ?>
          <?php if ($audio_visual=='Yes'){?><div class="m-entry-4col-item">Audio/Visual </div><?php } ?>
          <?php if ($others_facilities != ''){?><div class="m-entry-4col-item"><?php echo $others_facilities; ?></div><?php } ?>

        </div>

      </div>

    </div>

    <div class="row m-entry-info-area">

      <div class="col-xs-12">

        <h4>Members and Community</h4>

        <div class="m-entry-2col-alt-bg">

          <div class="m-entry-2col-item">info 1</div>
          <div class="m-entry-2col-item">info 2</div>
          <div class="m-entry-2col-item">info 3</div>
          <div class="m-entry-2col-item">info 4</div>
          <div class="m-entry-2col-item">info 5</div>
          <div class="m-entry-2col-item">info 6</div>
          <div class="m-entry-2col-item">info 7</div>
          <div class="m-entry-2col-item">info 8</div>
          <div class="m-entry-2col-item">info 9</div>

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