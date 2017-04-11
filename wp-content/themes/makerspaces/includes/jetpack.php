<?php
/**
 * Jetpack Compatibility File
 * See: http://jetpack.me/
 *
 * @package _makerspaces
 */

/**
 * Add theme support for Infinite Scroll.
 * See: http://jetpack.me/support/infinite-scroll/
 */
function _makerspaces_jetpack_setup() {
	if ( function_exists( 'add_theme_support' ) ) {
		add_theme_support( 'infinite-scroll', array(
			'container' => 'content',
			'footer'    => 'page',
		) );
	}
}
add_action( 'after_setup_theme', '_makerspaces_jetpack_setup' );
