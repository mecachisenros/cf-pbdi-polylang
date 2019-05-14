<?php
/**
 * Plugin Name: CF Phone Better Intl Polylang
 * Description: Adds a setting to CF's Phone Better field to set the initial country to Polylang's current language.
 * Version: 0.1
 * Author: Andrei Mondoc
 * Author URI: https://github.com/mecachisenros
 * Plugin URI: https://github.com/mecachisenros/cf-pbdi-polylang
 * GitHub Plugin URI: mecachisenros/cf-pbdi-polylang
 * Text Domain: content-views-civicrm
 * Domain Path: /languages
 */

add_action( 'caldera_forms_core_init', function() {

	// bail if no polylang
	if ( ! defined( 'POLYLANG' ) ) return;
	//include class
	include plugin_dir_path( __FILE__ ) . 'src/class-phone-better-intl-polylang.php';
	// init
	new CF_Phone_Better_Intl_Polylang;

});
