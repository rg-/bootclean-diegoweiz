<?php
/* ################################################################################## */
/* ################################################################################## */
/**
 * Bootclean child custom functions
 *
 * @package Bootclean
 * @subpackage Child Theme
 * 
 */
/* ################################################################################## */
/* ################################################################################## */

/**
 * @subpackage Enable "theme_settings" options pages
 */

	add_filter('wpbc/filter/theme_settings/installed', '__return_true');
		
		/* Customs for theme settings here */
		
		include('functions/addon-theme_settings.php');

/* ################################################################################## */

/**
 * @subpackage Enable "swup" addon
 */

	// add_filter('wpbc/filter/swup/installed', '__return_true');
	// include('functions/addon-swup.php');

/* ################################################################################## */

/**
 * @subpackage Enable "private_areas" addon
 */

	// add_filter('wpbc/filter/private_areas/installed', '__return_true');
	// include('functions/addon-private_areas.php');

/* ################################################################################## */

/**
 * @subpackage "theme-*" customs
 */

	include('functions/theme-textdomain.php'); 
	include('functions/theme-login.php'); 
	include('functions/theme-options.php');
	include('functions/theme-under-construction.php'); 
	// include('functions/theme-options-page-settings.php');
	include('functions/theme-scripts.php');
	include('functions/theme-fonts.php');
	// include('functions/theme-widgets.php');

/* ################################################################################## */

/* core */
// include('functions/core-theme_support.php'); 

/* ################################################################################## */

/* front-end layout */ 
include('functions/layout.php');
include('functions/layout-navmenus.php');


add_filter('wpbc/filter/component/wp-footer/args', function($args){
	if(!empty($args['is_main'])){
		$args['default_content'] = '<p class="small text-center">'.$args['default_content'].'</p>';
		$args['default_content'] .= '<p class="small text-center">Diseño y Desarrollo by <a href="http://nomadeweb.com" target="_blank"><img src="'.CHILD_THEME_URI.'/images/theme/nomade.png" width="36" alt=" "></a></p>';
	}
	return $args;
},20,1);

/* ################################################################################## */

/**
 * @subpackage WooCommerce
 */
if( class_exists( 'WooCommerce' ) ){
	include('functions/plugins-woocommerce.php');
}

/* ################################################################################## */

/* Disable template landing builder */
add_filter('wpbc/filter/template-landing/installed', '__return_false');

// include('functions/template-landing.php');

/* ################################################################################## */


/* ################################################################################## */


/* ################################################################################## */

//add_action( 'wp_print_scripts', 'pp_deregister_javascript', 99 );
 
function pp_deregister_javascript() {
	if(!is_admin())
	{
		 wp_dequeue_script('wp-color-picker');
		 wp_deregister_script( 'jquery-ui-datepicker' );
		 wp_deregister_script( 'wp-color-picker-js-extra' );
		 wp_deregister_script( 'wp-color-picker' );

	}

} 