<?php

/*

	Filter main-navbar settings

*/

function weisz_is_fixed_nav(){

	
	$fixed_nav = WPBC_if_has_page_header($post->ID);

	$fixed_nav = apply_filters('weisz/fixed_nav', $fixed_nav);

	return $fixed_nav;

}
	
add_filter('wpbc/filter/layout/main-navbar/defaults', function($args){
	
	global $post;

	$simulate_target = '#main-content';
	$affix = true;
	$simulate = true; 

	$logo_white = '[WPBC_get_stylesheet_directory_uri]/images/theme/logo-diegoweiz.png';
	$logo_black = '[WPBC_get_stylesheet_directory_uri]/images/theme/logo-diegoweiz-negro.png';

	$fixed_nav = weisz_is_fixed_nav();
	if(!$fixed_nav){
		$affix = false;
	}

	if( WPBC_if_has_page_header($post->ID) ){
 		$simulate = false; 
 		$logo = $logo_white;
 		$logo_alt = $logo_black;
 		$navbar_class = '';
 		$navbar_affix_addclass = 'bg-light';
 	}else{
 		$logo = $logo_black;
 		$logo_alt = false;
 		$navbar_class = 'bg-light';
 		$navbar_affix_addclass = '';
 	} 
 
 	if(!$logo_alt){
 		$brand_image = '<img width="78" src="'.$logo.'" alt="'.get_bloginfo('title').'" data-affix-addclass=""/>';
 	}else{
 		$brand_image = '<img data-affix-addclass="d-none" width="78" src="'.$logo.'" alt="'.get_bloginfo('title').'" data-affix-addclass=""/><img class="d-none my-1" data-affix-removeclass="d-none" width="60" src="'.$logo_alt.'" alt="'.get_bloginfo('title').'" data-affix-addclass=""/>';
 	}

	$args['class'] = 'navbar navbar-expand-aside collapse-right navbar-expand-lg '.$navbar_class; 
	$args['nav_attrs'] = ' data-affix-removeclass="" data-affix-addclass="'.$navbar_affix_addclass.' shadow" ';

	$args['container_class'] = 'container gpx-2 gpx-md-1';

	$args['navbar_brand']['class'] = 'gpy-1';
	$args['navbar_brand']['attrs'] = ' data-affix-removeclass="gpy-1" data-affix-addclass="py-1" ';  
 	 
	$args['navbar_brand']['title'] = $brand_image;

	// or just site name
	//$args['navbar_brand']['title'] = '<span class="h2">WPBC Woo<span class="d-none d-sm-inline-block">commerce</span></span>';

	$args['navbar_toggler']['class'] = 'toggler-primary toggler-open-primary ml-auto';
	$args['navbar_toggler']['type'] = 'animate';
	$args['navbar_toggler']['effect'] = 'close-arrow'; 
	//$args['navbar_toggler']['attrs'] = 'data-affix-addclass="toggler-white" data-affix-removeclass="toggler-white"'; 

	$args['wp_nav_menu']['container_class'] = 'collapse navbar-collapse flex-row-reverse mx-auto order-3';
	$args['wp_nav_menu']['menu_class'] = 'navbar-nav nav';  

	$args['affix'] = $affix;
	
	$args['affix_defaults']['simulate'] = $simulate;
	$args['affix_defaults']['simulate_target'] = $simulate_target;
	$args['affix_defaults']['breakpoint'] = 'xs';
	$args['affix_defaults']['scrollify'] = false;  
  

	// $args['nav_attrs'] = ' data-affix-target="#main-content-wrap" '; 

	//$args['nav_attrs'] .= ' data-affix-show="scroll-up" ';
	
	// $args['nav_attrs'] = ' data-toggle="nav-affix" data-affix-position="top" data-affix-breakpoint="xs" data-affix-target="#main-content-wrap" data-affix-simulate="false" data-affix-scrollify="true" data-affix-showXX="scroll-up" data-affix-addclassXX="bg-white" data-affix-removeclassXX="bg-transparent" ';
	 
	//$args['wp_nav_menu']['before_menu'] = '[WPBC_get_template name="parts/something"]'; 

	/* wp_nav_menu */
	//$args['wp_nav_menu'] = ''; // use this to replace wp_nav_menu with "collapse-custom" one
	//$args['wp_nav_menu_custom'] = '[WPBC_get_template name="parts/wp_nav_menu_custom"]';
	//$args['navbar_toggler']['data_toggle'] = 'data-toggle="collapse-custom"';
	//$args['navbar_toggler']['target'] = 'collapse-custom';

	return $args;
},10,1);  

/*
	Alter output html for menus
*/
function nav_replace_wpse_189788($item_output, $item) {  
	return $item_output; 
}
add_filter('walker_nav_menu_start_el','nav_replace_wpse_189788',10,2);


/*
	Disable main-navbar from templates
*/
add_filter('wpbc/filter/layout/main-navbar/defaults',function ($params){
	//$params['use_custom_template'] = 'none';
	return $params;
},10,1); 


/*
	Add items into menus
*/

function WPBC_my_search_form( $form ) {
  $form = '<form role="search" method="get" class="ui-search-form form-controls-transparent" action="' . home_url( '/' ) . '" >
  <div class="form-group m-0">
  <input class="form-control" placeholder="Search" type="text" value="' . get_search_query() . '" name="s" />
  <button type="submit" class="searchsubmit btn btn-icon"><i class="icon-w-search"></i></button> 
  </div>
  <input type="hidden" name="post_type" value="product">
  </form>'; 
  return $form;
}

add_filter('wp_nav_menu_items', 'add_admin_link', 10, 2);
function add_admin_link($items, $args){
  if( $args->theme_location == 'primary' ){
      $items .= '<li class="nav-item menu-item gpx-lg-1">'; 
  		$items .= WPBC_my_search_form('');
  		$items .= '</li>';
  		$items .= '<li class="nav-item menu-item">'; 
  		$items .= '<a href="#contacto" class="scroll-to btn btn-icon nav-link px-3"><i class="icon-w-envelope"></i></a>';
  		$items .= '</li>';
  		$items .= '<li class="nav-item menu-item">'; 
  		$items .= '<a href="" class="btn btn-icon nav-link px-3"><i class="icon-w-instagram"></i></a>';
  		$items .= '</li>';
  }
  return $items;
}

function wpbc_nav_menu_link_atts( $atts, $item, $args, $depth ){
	if( $args->theme_location == 'primary' ){
		unset($atts['title']);
	}
  return $atts;
}
add_filter( 'nav_menu_link_attributes', 'wpbc_nav_menu_link_atts', 100, 4 );
/* 
	Disable dropdown markup on BootstrapNavWalker 
*/
// add_filter('nav_menu_use_dropdown',function(){ return false; });