<?php
/**
 * Amalie Customizer functionality
 *
 * @package Amalie
 * @since Amalie 1.0
 */

/**
 * Add postMessage support for site title and description for the Customizer.
 *
 * @since Amalie 1.0
 *
 * @param WP_Customize_Manager $wp_customize Customizer object.
 */
function amalie_customize_register( $wp_customize ) {

	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	
	$wp_customize->add_section( 'amalie_theme_options', array(
		'title'    => __( 'Front Page Featured Page', 'amalie' ),
		'priority' => 131,
	) );
     
	/* Front Page: Featured Page One */
	$wp_customize->add_setting( 'amalie_featured_page_one_front_page_first_block', array(
		'default'           => '',
		'sanitize_callback' => 'amalie_sanitize_dropdown_pages',
	) );
	$wp_customize->add_control( 'amalie_featured_page_one_front_page_first_block', array(
		'label'             => __( 'Featured Page', 'amalie' ),
		'section'           => 'amalie_theme_options',
		'priority'          => 8,
		'type'              => 'dropdown-pages',
	) );	


	// Add an additional description to the header image section.
	$wp_customize->get_section( 'header_image' )->description = __( 'Applied to the header on small screens and the sidebar on wide screens.', 'amalie' );
	
  /**
   * Adds the individual sections for custom logo
   */
   $wp_customize->add_section( 'amalie_logo_section' , array(
    'title'       => __( 'Logo', 'amalie' ),
    'priority'    => 30,
    'description' => __( 'Upload a logo to replace the default site name and description in the header', 'amalie' )
   ) );
   $wp_customize->add_setting( 'amalie_logo', array(
	 'sanitize_callback' => 'esc_url_raw',
   ) );
   $wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'amalie_logo', array(
	 'label'    => __( 'Logo', 'amalie' ),
	 'section'  => 'amalie_logo_section',
	 'settings' => 'amalie_logo',
   ) ) );
}
add_action( 'customize_register', 'amalie_customize_register', 11 );

/**
 * Sanitization
 */
//Checkboxes
function amalie_sanitize_checkbox( $input ) {
	if ( $input == 1 ) {
		return 1;
	} else {
		return '';
	}
}

//Integers
function amalie_sanitize_int( $input ) {
    if( is_numeric( $input ) ) {
        return intval( $input );
    }
}

//Text
function amalie_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}

//No sanitize - empty function for options that do not require sanitization -> to bypass the Theme Check plugin
function amalie_no_sanitize( $input ) {
}

/**
 * Sanitize the dropdown pages.
 *
 * @param interger $input.
 * @return interger.
 */
function amalie_sanitize_dropdown_pages( $input ) {
	if ( is_numeric( $input ) ) {
		return intval( $input );
	}
}

/**
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 *
 * @since Amalie 1.0
 */
function amalie_customize_preview_js() {
	wp_enqueue_script( 'amalie-customize-preview', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '20141216', true );
}
add_action( 'customize_preview_init', 'amalie_customize_preview_js' );