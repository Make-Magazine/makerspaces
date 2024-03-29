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

  //Header info
  $title = (isset($entry['1']) ? $entry['1']:'');
  $website = (isset($entry['2']) ? $entry['2']:'');
  $contact_email = (isset($entry['9']) ? $entry['9']:'');
  $contact_phone = (isset($entry['10']) ? $entry['10']:'');
  $city = (isset($entry['11']) ? $entry['11']:'');
  $state = (isset($entry['12']) ? $entry['12']:'');
  $zip = (isset($entry['13']) ? $entry['13']:'');
  $gmap_address = $city . $state . $zip;
  $gmap_address = str_replace(' ', '+', $gmap_address);

  //About Space
  $space_type = (isset($entry['14']) ? $entry['14']:''); //checkboxes
  $days_open = (isset($entry['15']) ? $entry['15']:''); //checkboxes
  $open_hours = (isset($entry['16']) ? $entry['16']:'');
  $membership = (isset($entry['17']) ? $entry['17']:''); //checkbox
  $offer_tours = (isset($entry['18']) ? $entry['18']:'');
  $under_18 = (isset($entry['19']) ? $entry['19']:''); //checkbox
  $sell_consumables = (isset($entry['82']) ? $entry['82']:''); //checkboxes

  //Members and Community
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

  //Classes
  $offer_classes = (isset($entry['20']) ? $entry['20']:''); //checkbox
  $equip_classes = (isset($entry['23']) ? $entry['23']:''); //checkbox
  $required_classes = (isset($entry['24']) ? $entry['24']:''); //checkbox
  $skill_classes = (isset($entry['25']) ? $entry['25']:'');
  $minor_classes = (isset($entry['26']) ? $entry['26']:''); //checkboxes
  $class_price = (isset($entry['27']) ? $entry['27']:''); //checkboxes
  $class_quantity = (isset($entry['28']) ? $entry['28']:''); //checkboxes
  $finding_instructors = (isset($entry['29']) ? $entry['29']:''); //checkboxes
  $feedback = (isset($entry['30']) ? $entry['30']:''); //checkboxes

  //Safety
  $safty_waiver = (isset($entry['32']) ? $entry['32']:''); //checkboxes
  $safty_equip = (isset($entry['33']) ? $entry['33']:''); //checkboxes
  $safty_training = (isset($entry['34']) ? $entry['34']:''); //checkboxes
  $safty_informal = (isset($entry['35']) ? $entry['35']:''); //checkboxes

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

  //Activity Areas
  $woodworking = (isset($entry['68']) ? $entry['68']:''); //checkboxes
  $metalworking = (isset($entry['67']) ? $entry['67']:''); //checkboxes
  $textiles = (isset($entry['74']) ? $entry['74']:''); //checkboxes
  $silkscreening = (isset($entry['75']) ? $entry['75']:''); //checkboxes
  $autoshop = (isset($entry['76']) ? $entry['76']:''); //checkboxes
  $blacksmithing = (isset($entry['78']) ? $entry['78']:''); //checkboxes
  $ceramics = (isset($entry['79']) ? $entry['79']:''); //checkboxes
  $audio_visual = (isset($entry['80']) ? $entry['80']:''); //checkboxes
  $others_facilities = (isset($entry['81']) ? $entry['81']:''); //checkboxes

  //Contact info
  $contact_person_name = (isset($entry['84']) ? $entry['84']:''); //checkboxes
  $contact_person_role = (isset($entry['85']) ? $entry['85']:''); //checkboxes
  $contact_person_email = (isset($entry['86']) ? $entry['86']:''); //checkboxes
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

        <iframe
          width="100%"
          height="250"
          frameborder="0" style="border:0"
          src="https://www.google.com/maps/embed/v1/place?key=AIzaSyA8KtBVyg7JjpNP683fbd-9x7inmdbV-4M&q=<?php echo $gmap_address; ?>" allowfullscreen>
        </iframe>

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

            <div class="col-xs-11">

              <!-- <h2><strong>Community Center Work</strong></h2> -->
              <p><strong>Address: </strong><?php echo $city; ?>, <?php echo $state; ?> <?php echo $zip; ?></p>
              <?php if ($contact_phone != ''){?><p><strong>Phone:</strong> <?php echo $contact_phone; ?></p><?php } ?>
              <?php if ($contact_email != ''){?><p><strong>Email:</strong> <?php echo $contact_email; ?></p><?php } ?>

            </div>

            <div class="col-xs-1">


            </div>

          </div>

        </div><!-- m-entry-headerbot -->

      </div><!-- .m-enty-header -->

    </div>

    <div class="row m-entry-info-area">

      <div class="col-xs-12">

        <div class="m-entry-4col-no-bg">

          <?php if ($space_type != ''){?><div class="m-entry-4col-item">How would you best classify the physical context of the Makerspace?<br /><p><?php echo $space_type; ?></p></div><?php } ?>
          <?php if ($days_open != ''){?><div class="m-entry-4col-item">What days is the Makerspace open?<br /><p><?php echo $days_open; ?></p></div><?php } ?>
          <?php if ($open_hours != ''){?><div class="m-entry-4col-item">What are the Makerspace's hours of operation?<br /><p><?php echo $open_hours; ?></p></div><?php } ?>
          <?php if ($membership != ''){?><div class="m-entry-4col-item"><?php echo $membership; ?></div><?php } ?>
          <?php if ($offer_tours != ''){?><div class="m-entry-4col-item">Do you offer tours or host any regular "open to the public" events?<br /><p><?php echo $offer_tours; ?></p></div><?php } ?>
          <?php if ($under_18 != ''){?><div class="m-entry-4col-item">Under 18 allowed?<br /><p><?php echo $under_18; ?></p></div><?php } ?>
          <?php if ($sell_consumables != ''){?><div class="m-entry-4col-item">Do you offer or sell consumables?<br /><p><?php echo $sell_consumables; ?></p></div><?php } ?>
          <?php if ($members != ''){?><div class="m-entry-4col-item">How many members or users do you have at this time?<br /><p><?php echo $members; ?></p></div><?php } ?>
          <?php if ($busiest != ''){?><div class="m-entry-4col-item">When is your Makerspace the busiest?<br /><p><?php echo $busiest; ?></p></div><?php } ?>
          <?php if ($non_members != ''){?><div class="m-entry-4col-item">Is your space ever open to non-members?<br /><p><?php echo $non_members; ?></p></div><?php } ?>
          <?php if ($recruit != ''){?><div class="m-entry-4col-item">Do you actively recruit new members?<br /><p><?php echo $recruit; ?></p></div><?php } ?>
          <?php if ($minor_members != ''){?><div class="m-entry-4col-item">Can a member be under the age of 18?<br /><p><?php echo $minor_members; ?></p></div><?php } ?>
          <?php if ($membership_packages != ''){?><div class="m-entry-4col-item">Do you have different membership packages or only one level of membership?<br /><p><?php echo $membership_packages; ?></p></div><?php } ?>
          <?php if ($student_discount != ''){?><div class="m-entry-4col-item">Do you offer a discounted student membership?<br /><p><?php echo $student_discount; ?></p></div><?php } ?>
          <?php if ($member_spaces != ''){?><div class="m-entry-4col-item">Can members rent office or work space within the Makerspace to run a small business?<br /><p><?php echo $member_spaces; ?></p></div><?php } ?>
          <?php if ($member_events != ''){?><div class="m-entry-4col-item">Can members use the space to host an event?<br /><p><?php echo $member_events; ?></p></div><?php } ?>
          <?php if ($kitchen != ''){?><div class="m-entry-4col-item">Does the Makerspace have a kitchen?<br /><p><?php echo $kitchen; ?></p></div><?php } ?>
          <?php if ($event_space != ''){?><div class="m-entry-4col-item">Does the Makerspace have any kind of designated event space?<br /><p><?php echo $event_space; ?></p></div><?php } ?>
          <?php if ($community_engagement != ''){?><div class="m-entry-4col-item">Do you have any kind of outreach program to encourage growth in membership and community engagement?<br /><p><?php echo $community_engagement; ?></p></div><?php } ?>
          <?php if ($community_building != ''){?><div class="m-entry-4col-item">What kind of community building events (if any) do you offer?<br /><p><?php echo $community_building; ?></p></div><?php } ?>
          <?php if ($space_age != ''){?><div class="m-entry-4col-item">How long has your Makerspace been in operation?<br /><p><?php echo $space_age; ?></p></div><?php } ?>
          <?php if ($area_type != ''){?><div class="m-entry-4col-item">Is the location of your shop urban, suburban or rural?<br /><p><?php echo $area_type; ?></p></div><?php } ?>
          <?php if ($zoned != ''){?><div class="m-entry-4col-item">How is your Makerspace location zoned?<br /><p><?php echo $zoned; ?></p></div><?php } ?>
          <?php if ($space_size != ''){?><div class="m-entry-4col-item">How big is your current space?<br /><p><?php echo $space_size; ?></p></div><?php } ?>
          <?php if ($management != ''){?><div class="m-entry-4col-item">Who controls the management and maintenance of the space?<br /><p><?php echo $management; ?></p></div><?php } ?>
          <?php if ($board != ''){?><div class="m-entry-4col-item">If you have a board of directors, how many directors do you have?<br /><p><?php echo $board; ?></p></div><?php } ?>
          <?php if ($incorporated != ''){?><div class="m-entry-4col-item">Is your Makerspace incorporated?<br /><p><?php echo $incorporated; ?></p></div><?php } ?>
          <?php if ($nonprofit != ''){?><div class="m-entry-4col-item">If your Makerspace is a non-profit, are you a separate 501(c)3 or do you have a fiscal sponsor?<br /><p><?php echo $nonprofit; ?></p></div><?php } ?>
          <?php if ($associated != ''){?><div class="m-entry-4col-item">Is the makerspace associated with or hosted by a separate organization?<br /><p><?php echo $associated; ?></p></div><?php } ?>
          <?php if ($associated_co != ''){?><div class="m-entry-4col-item">If yes, what type of organization?<br /><p><?php echo $associated_co; ?></p></div><?php } ?>
          <?php if ($funding != ''){?><div class="m-entry-4col-item">Do you have sources of funding for the makerspace in addition to member or usage fees?<br /><p><?php echo $funding; ?></p></div><?php } ?>

        </div>

      </div>

    </div>

    <div class="row m-entry-info-area">

      <div class="col-xs-12">

        <h4>Basic Tools</h4>

        <div class="m-entry-4col-alt-bg">

          <div class="m-entry-4col-item <?php if($hand_tools=='Yes'){echo 'col4-item-check';} ?>">Basic Hand Tools</div>
          <div class="m-entry-4col-item <?php if($power_tools=='Yes'){echo 'col4-item-check';} ?>">Basic Power Tools</div>
          <div class="m-entry-4col-item <?php if($elec_tools=='Yes'){echo 'col4-item-check';} ?>">Basic Electric Tools</div>
          <div class="m-entry-4col-item <?php if($computers=='Yes'){echo 'col4-item-check';} ?>">Computers</div>
          <div class="m-entry-4col-item <?php if($cnc=='Yes'){echo 'col4-item-check';} ?>">CNC</div>
          <div class="m-entry-4col-item <?php if($printing3d=='Yes'){echo 'col4-item-check';} ?>">3D Printing</div>
          <div class="m-entry-4col-item <?php if($lasercutter=='Yes'){echo 'col4-item-check';} ?>">Laser Cutter</div>
          <div class="m-entry-4col-item <?php if($vinylcutter=='Yes'){echo 'col4-item-check';} ?>">Vinyl Cutter</div>
          <div class="m-entry-4col-item <?php if($waterjet=='Yes'){echo 'col4-item-check';} ?>">Waterjet</div>
          <div class="m-entry-4col-item <?php if($pcrtools=='Yes'){echo 'col4-item-check';} ?>">PCR Tools (Biotech)</div>

        </div>

      </div>

    </div>

    <div class="row m-entry-info-area">

      <div class="col-xs-12">

        <h4>Activity Areas</h4>

        <div class="m-entry-4col-alt-bg">

          <div class="m-entry-4col-item <?php if($woodworking=='Yes'){echo 'col4-item-check';} ?>">Woodworking</div>
          <div class="m-entry-4col-item <?php if($metalworking=='Yes'){echo 'col4-item-check';} ?>">Metalworking</div>
          <div class="m-entry-4col-item <?php if($textiles=='Yes'){echo 'col4-item-check';} ?>">Textiles</div>
          <div class="m-entry-4col-item <?php if($silkscreening=='Yes'){echo 'col4-item-check';} ?>">Silkscreening</div>
          <div class="m-entry-4col-item <?php if($autoshop=='Yes'){echo 'col4-item-check';} ?>">Autoshop</div>
          <div class="m-entry-4col-item <?php if($blacksmithing=='Yes'){echo 'col4-item-check';} ?>">Blacksmithing</div>
          <div class="m-entry-4col-item <?php if($ceramics=='Yes'){echo 'col4-item-check';} ?>">Ceramics/Glass</div>
          <div class="m-entry-4col-item <?php if($audio_visual=='Yes'){echo 'col4-item-check';} ?>">Audio/Visual </div>
          <?php if ($others_facilities != ''){?><div class="m-entry-4col-item col4-item-none"><?php echo $others_facilities; ?></div><?php } ?>

        </div>

      </div>

    </div>

    <div class="row m-entry-info-area">

      <div class="col-xs-12">

        <h4>Members and Community</h4>

        <div class="m-entry-2col-alt-bg">

          <?php if ($members != ''){ ?>
            <div class="m-entry-2col-item">
              <span class="col2-item-l">How many members or users do you have at this time?</span>
              <span class="col2-item-r"><?php echo $members; ?></span>
            </div>
          <?php } ?>
          <?php if ($busiest != ''){ ?>
            <div class="m-entry-2col-item">
              <span class="col2-item-l">When is your Makerspace the busiest?</span>
              <span class="col2-item-r"><?php echo $busiest; ?></span>
            </div>
          <?php } ?>
          <?php if ($non_members != ''){ ?>
            <div class="m-entry-2col-item">
              <span class="col2-item-l">Is your space ever open to non-members?</span>
              <span class="col2-item-r"><?php echo $non_members; ?></span>
            </div>
          <?php } ?>
          <?php if ($recruit != ''){ ?>
            <div class="m-entry-2col-item">
              <span class="col2-item-l">Do you actively recruit new members?</span>
              <span class="col2-item-r"><?php echo $recruit; ?></span>
            </div>
          <?php } ?>
          <?php if ($minor_members != ''){ ?>
            <div class="m-entry-2col-item">
              <span class="col2-item-l">Can a member be under the age of 18?</span>
              <span class="col2-item-r"><?php echo $minor_members; ?></span>
            </div>
          <?php } ?>
          <?php if ($membership_packages != ''){ ?>
            <div class="m-entry-2col-item">
              <span class="col2-item-l">Do you have different membership packages or only one level of membership?</span>
              <span class="col2-item-r"><?php echo $membership_packages; ?></span>
            </div>
          <?php } ?>
          <?php if ($student_discount != ''){ ?>
            <div class="m-entry-2col-item">
              <span class="col2-item-l">Do you offer a discounted student membership?</span>
              <span class="col2-item-r"><?php echo $student_discount; ?></span>
            </div>
          <?php } ?>
          <?php if ($member_spaces != ''){ ?>
            <div class="m-entry-2col-item">
              <span class="col2-item-l">Can members rent office or work space within the Makerspace to run a small business?</span>
              <span class="col2-item-r"><?php echo $member_spaces; ?></span>
            </div>
          <?php } ?>
          <?php if ($kitchen != ''){ ?>
            <div class="m-entry-2col-item">
              <span class="col2-item-l">Does the Makerspace have a kitchen?</span>
              <span class="col2-item-r"><?php echo $kitchen; ?></span>
            </div>
          <?php } ?>
          <?php if ($member_events != ''){ ?>
            <div class="m-entry-2col-item">
              <span class="col2-item-l">Can members use the space to host an event?</span>
              <span class="col2-item-r"><?php echo $member_events; ?></span>
            </div>
          <?php } ?>
          <?php if ($event_space != ''){ ?>
            <div class="m-entry-2col-item">
              <span class="col2-item-l">Does the Makerspace have any kind of designated event space?</span>
              <span class="col2-item-r"><?php echo $event_space; ?></span>
            </div>
          <?php } ?>
          <?php if ($community_engagement != ''){ ?>
            <div class="m-entry-2col-item">
              <span class="col2-item-l">Do you have any kind of outreach program to encourage growth in membership and community engagement?</span>
              <span class="col2-item-r"><?php echo $community_engagement; ?></span>
            </div>
          <?php } ?>
          <?php if ($community_building != ''){ ?>
            <div class="m-entry-2col-item">
              <span class="col2-item-l">What kind of community building events (if any) do you offer?</span>
              <span class="col2-item-r"><?php echo $community_building; ?></span>
            </div>
          <?php } ?>
          <?php if ($space_age != ''){ ?>
            <div class="m-entry-2col-item">
              <span class="col2-item-l">How long has your Makerspace been in operation?</span>
              <span class="col2-item-r"><?php echo $space_age; ?></span>
            </div>
          <?php } ?>
          <?php if ($area_type != ''){ ?>
            <div class="m-entry-2col-item">
              <span class="col2-item-l">Is the location of your shop urban, suburban or rural?</span>
              <span class="col2-item-r"><?php echo $area_type; ?></span>
            </div>
          <?php } ?>
          <?php if ($zoned != ''){ ?>
            <div class="m-entry-2col-item">
              <span class="col2-item-l">How is your Makerspace location zoned?</span>
              <span class="col2-item-r"><?php echo $zoned; ?></span>
            </div>
          <?php } ?>
          <?php if ($space_size != ''){ ?>
            <div class="m-entry-2col-item">
              <span class="col2-item-l">How big is your current space?</span>
              <span class="col2-item-r"><?php echo $space_size; ?></span>
            </div>
          <?php } ?>
          <?php if ($management != ''){ ?>
            <div class="m-entry-2col-item">
              <span class="col2-item-l">Who controls the management and maintenance of the space?</span>
              <span class="col2-item-r"><?php echo $management; ?></span>
            </div>
          <?php } ?>
          <?php if ($board != ''){ ?>
            <div class="m-entry-2col-item">
              <span class="col2-item-l">If you have a board of directors, how many directors do you have?</span>
              <span class="col2-item-r"><?php echo $board; ?></span>
            </div>
          <?php } ?>
          <?php if ($incorporated != ''){ ?>
            <div class="m-entry-2col-item">
              <span class="col2-item-l">Is your Makerspace incorporated?</span>
              <span class="col2-item-r"><?php echo $incorporated; ?></span>
            </div>
          <?php } ?>
          <?php if ($nonprofit != ''){ ?>
            <div class="m-entry-2col-item">
              <span class="col2-item-l">If your Makerspace is a non-profit, are you a separate 501(c)3 or do you have a fiscal sponsor?</span>
              <span class="col2-item-r"><?php echo $nonprofit; ?></span>
            </div>
          <?php } ?>
          <?php if ($associated != ''){ ?>
            <div class="m-entry-2col-item">
              <span class="col2-item-l">Is the makerspace associated with or hosted by a separate organization?</span>
              <span class="col2-item-r"><?php echo $associated; ?></span>
            </div>
          <?php } ?>
          <?php if ($associated_co != ''){ ?>
            <div class="m-entry-2col-item">
              <span class="col2-item-l">If yes, what type of organization?</span>
              <span class="col2-item-r"><?php echo $associated_co; ?></span>
            </div>
          <?php } ?>
          <?php if ($funding != ''){ ?>
            <div class="m-entry-2col-item">
              <span class="col2-item-l">Do you have sources of funding for the makerspace in addition to member or usage fees?</span>
              <span class="col2-item-r"><?php echo $funding; ?></span>
            </div>
          <?php } ?>


        </div>

      </div>

    </div>

    <div class="row m-entry-info-area">

      <div class="col-xs-12">

        <h4>Classes</h4>

        <div class="m-entry-2col-alt-bg">

          <?php if ($offer_classes != ''){ ?>
            <div class="m-entry-2col-item">
              <span class="col2-item-l">Does the Makerspace offer classes?</span>
              <span class="col2-item-r"><?php echo $offer_classes; ?></span>
            </div>
          <?php } ?>
          <?php if ($equip_classes != ''){ ?>
            <div class="m-entry-2col-item">
              <span class="col2-item-l">Does the Makerspace offer classes on how to use its equipment?Are classes required in order to use the equipment in the Makerspace?</span>
              <span class="col2-item-r"><?php echo $equip_classes; ?></span>
            </div>
          <?php } ?>
          <?php if ($required_classes != ''){ ?>
            <div class="m-entry-2col-item">
              <span class="col2-item-l">Are classes required in order to use the equipment in the Makerspace?</span>
              <span class="col2-item-r"><?php echo $required_classes; ?></span>
            </div>
          <?php } ?>
          <?php if ($skill_classes != ''){ ?>
            <div class="m-entry-2col-item">
              <span class="col2-item-l">Does the Makerspace offer skill building workshops or classes outside of equipment aptitude?</span>
              <span class="col2-item-r"><?php echo $skill_classes; ?></span>
            </div>
          <?php } ?>
          <?php if ($minor_classes != ''){ ?>
            <div class="m-entry-2col-item">
              <span class="col2-item-l">Are classes available for young adults under the age of 18?</span>
              <span class="col2-item-r"><?php echo $minor_classes; ?></span>
            </div>
          <?php } ?>
          <?php if ($class_price != ''){ ?>
            <div class="m-entry-2col-item">
              <span class="col2-item-l">What is the price range for classes?</span>
              <span class="col2-item-r"><?php echo $class_price; ?></span>
            </div>
          <?php } ?>
          <?php if ($class_quantity != ''){ ?>
            <div class="m-entry-2col-item">
              <span class="col2-item-l">How many classes does your Makerspace offer on average per month?</span>
              <span class="col2-item-r"><?php echo $class_quantity; ?></span>
            </div>
          <?php } ?>
          <?php if ($finding_instructors != ''){ ?>
            <div class="m-entry-2col-item">
              <span class="col2-item-l">Do you find it difficult to find instructors (or instructors of appropriate caliber)?</span>
              <span class="col2-item-r"><?php echo $finding_instructors; ?></span>
            </div>
          <?php } ?>
          <?php if ($feedback != ''){ ?>
            <div class="m-entry-2col-item">
              <span class="col2-item-l">Based on feedback you have received how would you rate customer satisfaction in the classes and/or workshops offered by the Makerspace?</span>
              <span class="col2-item-r"><?php echo $feedback; ?></span>
            </div>
          <?php } ?>


        </div>

      </div>

    </div>

    <div class="row m-entry-info-area">

      <div class="col-xs-12">

        <h4>Safety</h4>

        <div class="m-entry-2col-alt-bg">

          <?php if ($safty_waiver != ''){ ?>
            <div class="m-entry-2col-item">
              <span class="col2-item-l">Does your Makerspace have a required safety waiver?</span>
              <span class="col2-item-r"><?php echo $safty_waiver; ?></span>
            </div>
          <?php } ?>
          <?php if ($safty_equip != ''){ ?>
            <div class="m-entry-2col-item">
              <span class="col2-item-l">Who provides safety equipment (goggles, welding gloves & jackets, ear protection, etc.) for each area of your makerspace?</span>
              <span class="col2-item-r"><?php echo $safty_equip; ?></span>
            </div>
          <?php } ?>
          <?php if ($safty_training != ''){ ?>
            <div class="m-entry-2col-item">
              <span class="col2-item-l">Does the Makerspace provide basic safety training or orientation for new users?</span>
              <span class="col2-item-r"><?php echo $safty_training; ?></span>
            </div>
          <?php } ?>
          <?php if ($safty_informal != ''){ ?>
            <div class="m-entry-2col-item">
              <span class="col2-item-l">How formalized would you consider the safety training for the Makerspace?</span>
              <span class="col2-item-r"><?php echo $safty_informal; ?></span>
            </div>
          <?php } ?>

        </div>

      </div>

    </div>

  </div>

</div>

<?php get_footer(); ?>