<?php

/*

 It's not recommended to add functions to this file, as it will be lost if you ever update this child theme.
 Instead, consider adding your function into a plugin using Pluginception: https://wordpress.org/plugins/pluginception/

 */

function ct_poet_load_scripts_styles() {
	wp_register_style( 'ct-poet-google-fonts', '//fonts.googleapis.com/css?family=Lora:400,700,400italic,700italic');
}
add_action('wp_enqueue_scripts', 'ct_poet_load_scripts_styles' );