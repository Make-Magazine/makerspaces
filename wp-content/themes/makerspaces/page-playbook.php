<?php
/**
 * Template Name: Playbook
 *
 * @package _makerspaces
 */

get_header(); ?>

<div class="playbook-page">

  <div class="container">

    <div class="row">

      <div class="col-xs-12">

        <h1><?php echo get_the_title(); ?></h1>        

      </div>

    </div>

  </div>

  <div class="playbook-page-hero" style="background: url(/wp-content/themes/makerspaces/img/home-header.png) no-repeat center center;"></div>

  <div class="container playbook-page-body">

    <div class="playbook-cover">
      <img src="/wp-content/themes/makerspaces/img/Playbook-cover.png" alt="Makerspace playbook PDF cover" />
    </div>

    <div class="row">

      <div class="col-xs-12 col-sm-6 playbook-page-body-l">

        <p class="lead">The Makerspace Playbook guides those who are hoping to start a Makerspace at their school or in their community.</p>
        <p class="lead playbook-cyan">Submit your name and email and we send you a free Makerspace Playbook PDF.</p>

        <?php
          $isSecure = "http://";
          if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
            $isSecure = "https://";
          }
        ?>
        <form class="playbook-sub-form" action="http://whatcounts.com/bin/listctrl" method="POST">
          <input type="hidden" name="slid_1" value="6B5869DC547D3D46BAC2803C6034F0BE" /><!-- MakerSpaces Newsletter -->
          <input type="hidden" name="slid_2" value="6B5869DC547D3D46941051CC68679543" /><!-- Maker Media Newsletter -->
          <input type="hidden" name="multiadd" value="1" />
          <input type="hidden" name="cmd" value="subscribe" />
          <input type="hidden" name="custom_source" value="makerspace-playbook" />
          <input type="hidden" name="custom_incentive" value="playbookPDF" />
          <input type="hidden" name="custom_url" value="<?php echo $_SERVER["HTTP_HOST"] . $_SERVER["REQUEST_URI"]; ?>" />
          <input type="hidden" id="format_mime" name="format" value="mime" />
          <input type="hidden" name="custom_host" value="<?php echo $_SERVER["HTTP_HOST"]; ?>" />
          <input name="name" placeholder="YOUR NAME" required type="name"><br>
          <input name="email" placeholder="YOUR EMAIL" required type="email"><br>
          <input value="REQUEST A FREE COPY" class="btn btn-lt-blue btn-block" type="submit">
        </form>

      </div>

      <div class="col-xs-12 col-sm-6 playbook-page-body-r">

        <p>CONTENTS</p>
        <p><strong>Beginnings</strong><br />
          what we're doing and why, orgins of the Maker movement</p>

        <p><strong>Places</strong><br />
          making a space more conducive to a community that makes together</p>

        <p><strong>Tools & Materials</strong><br />
          inventory, budgets, and strategies (see also High School Makerspace Tools & Materials: a companion document detailing the uses and costs of a fully stocked inventory for an in-school Makerspace.)</p>

        <p><strong>Safety</strong><br />
          planning for safety, signage, and common rules</p>

        <p><strong>Roles</strong><br />
          what teachers, students, shop managers, and mentors do in a Makerspace</p>

        <p><strong>Practices</strong><br />
          pedagogical approaches experienced makers use to support emerging makers</p>

        <p><strong>A Year of Making</strong><br />
          teacher Aaron Vanderwerff describes his experience making with students</p>

        <p><strong>Projects</strong><br />
          guiding novice makers as they build their skill set; sources for projects</p>

        <p><strong>Startup</strong><br />
          nuts and bolts of getting involved with the Makerspace network</p>

        <p><strong>Documenting</strong><br />
          sharing projects … and the stories behind their making</p>

        <p><strong>Snapshots</strong><br />
          four school-based Makerspaces in action</p>

        <p><strong>Resources</strong><br />
          helpful lists, forms, and templates</p>

        <p class="small">We welcome your <a href="#" target="_blank">feedback</a> on the kinds of things we should add to this Playbook, what you think we get right and wrong, and any changes you'd make in general.</p>
      </div>

    </div>

  </div>

</div>

<?php get_footer(); ?>
