<?php

/* 
	This will run if no Theme Settings or custom used. 
	Use it if no Theme Settings used, and to set defaults
*/
add_filter('wpbc/filter/layout/locations', function($locations){ 
	// $locations['page']['id'] = 'a1';
	$locations['search']['id'] = 'a2-ml';
	return $locations;  
}, 20, 1 );


/* 
	This will run at the last, last, last 
*/
add_filter('wpbc/filter/layout/location', function($layout, $template, $using_theme_settings, $using_page_settings){
	if($template == 'page'){
		//$layout = 'a2-ml';
	} 
	return $layout;
},10,4);
/* 
	And same thing for the container type
*/
add_filter('wpbc/filter/layout/container_type', function($container_type, $template, $using_theme_settings, $using_page_settings){
	if($template == 'page'){
		//$container_type = 'fixed-left';
	}
	return $container_type;
},10,4);


add_action('wpbc/layout/start', function(){?><?php
}, 40 );

add_filter('wpbc/filter/layout/start/defaults', function($args){  
	// $args['main_content']['wrap']['class'] = 'gpy-1'; 

	return $args;
}); 
add_filter('wpbc/filter/layout/class/?id=main-container-areas', function($class, $structure_id, $key){
	global $post;
	if(!WPBC_if_has_page_header($post->ID)){
		$class .= ' gpy-2 ';
	}
	return $class;
},10,3);

add_filter('WPBC_post_header_title_class', function($title_class){ 
	/*
	default
	$title_class = 'entry-title';
	*/
	// $title_class .= ' gmb-2';
	return $title_class;  
}, 20, 1 ); 

