<?php

/**
 * Widget to display page links
 *
 * @extends GravityView_Widget
 */
class GravityView_Maps_View_Widget extends GravityView_Widget {

	protected $show_on_single = false;

	function __construct() {

		$this->widget_description = __( 'Display the visible entries in a map', 'gravityview-maps' );

		$default_values = array( 'header' => 1, 'footer' => 1 );

		$settings = array();

		parent::__construct( __( 'Multiple Entries Map', 'gravityview-maps' ) , 'map', $default_values, $settings );

	}

	public function render_frontend( $widget_args, $content = '', $context = '') {
		do_action( 'gravityview_map_render_div' );
	}

}