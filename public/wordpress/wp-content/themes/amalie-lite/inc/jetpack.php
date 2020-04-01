<?php
/**
 * Jetpack Compatibility File
 *
 * See: http://jetpack.me/
 *
 * @package Amalie
 * @since Amalie 1.0
 */

/**
 * Add theme support for responsive videos.
 */
function amalie_jetpack_setup() {
	add_theme_support( 'jetpack-responsive-videos' );
}
add_action( 'after_setup_theme', 'amalie_jetpack_setup' );