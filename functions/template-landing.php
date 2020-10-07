<?php

include('template-landing/functions.php');


/*

	Template Landing custom child settings

*/ 


add_filter('wpbc/filter/layout/main-navbar/defaults', 'wpbc_child_main_navbar_template_landing',10,1);
function wpbc_child_main_navbar_template_landing($args){
	if(is_page_template('_template_landing_builder.php')){
		// $args['affix'] = true; 
		// $args['affix_defaults']['simulate'] = false;
	}
	return $args;
}



/*

	Add new section, needs template-parts/template-landing/section-1.php file

*/

add_filter('wpbc/filter/template-landing/build_sections', function($build_sections){

	$section_class = '';
	$comp_layouts_icon = '';

	$build_sections[] = array(
		'id' => 'section-1',
		'attrs'=>'',
		'class' => 'template-landing--section-1 '.$section_class,
		'acf' => array(
			'group_id' => 'section-1',
			'label' => $comp_layouts_icon.__('Section title','bootclean'),
			'sub_fields' => array(),
		),
	);

	return $build_sections;
},10,1);


/*
	
	Add fields into existing sectinons by group_id.

*/

add_filter('wpbc/filter/template-landing/sub_fields/?group=page_header', function($sub_fields){
	$sub_fields[] = array(
		'key' => 'field_page_header_gallery',
		'label' => 'Background image/s',
		'name' => 'azar_page_header_gallery',
		'type' => 'gallery',
		'instructions' => '',
		'required' => 0,
		'conditional_logic' => 0,
		'wrapper' => array(
			'width' => '',
			'class' => '',
			'id' => '',
		),
		'min' => '',
		'max' => '',
		'insert' => 'append',
		'library' => 'all',
		'min_width' => '',
		'min_height' => '',
		'min_size' => '',
		'max_width' => '',
		'max_height' => '',
		'max_size' => '',
		'mime_types' => '',
	);
	return $sub_fields;
},10,1);