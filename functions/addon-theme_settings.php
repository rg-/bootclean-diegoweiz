<?php

/*

	Show helpers on fields on admin, that is
	front end function to get the field like 

*/

add_filter('wpbc/filter/theme_settigs/show_helpers', '__return_true');


/*

	Remove tabs and fields from Theme Settings Groups

	Defaults are:

			'fields-general',
			'fields-header',
			'fields-footer',
			'fields-typography',
			'fields-custom-code',

*/ 

add_filter('wpbc/filter/theme_settings/file_path', function($file_path, $key){

	$excluded_groups = array(
		'fields-header',
		// 'fields-typography'
	);

	if( in_array($key, $excluded_groups) ){
		$file_path = '';
	}

	return $file_path;

},10,2);


/*

	Filter arguments for option page and default group

*/

add_filter('wpbc/filter/theme_settings/args',function($args){
	$args['options_page']['page_title'] = 'Weisz settings';
	$args['options_page']['menu_title'] = 'Weisz settings';
	$args['options_page']['icon_url'] = '';

	$args['options_page']['menu_color'] = '#eaab00'; // admin menu color

		$args['options_page']['menu_background_active'] = '#eaab00';  
		$args['options_page']['menu_color_active'] = '#fff'; 

	return $args;
},11,1);



/*

	ADDING CUSTOM OPTION FIELDS

*/

/*
	Add General options
*/

add_filter('wpbc/filter/theme_settings/fields/general', 'WPBC_child_custom_theme_settings__general', 10, 1);

function WPBC_child_custom_theme_settings__general($fields){ 

	$fields[] = WPBC_acf_make_taxonomy_field(array(
		'name' => 'woo_gallery_cat',
		'label' => 'Categoría Principal para Fotos', 
		'taxonomy' => 'product_cat', 
	));

	$fields[] = WPBC_acf_make_taxonomy_field(array(
		'name' => 'woo_presets_cat',
		'label' => 'Categoría Principal para Presets', 
		'taxonomy' => 'product_cat', 
	));

	$fields[] = WPBC_acf_make_social_items_group_field(array(
		'name' => 'general_social',
		'label' => 'Redes Sociales', 
	));

	return $fields;

}

/*
	Add Footer options
*/

add_filter('wpbc/filter/theme_settings/fields/footer', 'WPBC_child_custom_theme_settings__footer', 10, 1);

function WPBC_child_custom_theme_settings__footer($fields){ 
$fields[] =  WPBC_acf_make_image_field(
		array( 
			'name' => 'footer_background_image',
			'label' => 'Imagen de fondo',  
		)
	);  
	$fields[] =  WPBC_acf_make_text_field(
		array( 
			'name' => 'footer_title',
			'label' => 'Título de sección',  
		)
	); 
	$fields[] =  WPBC_acf_make_post_object_wpcf7_field(
		array( 
			'name' => 'footer_form',
			'label' => 'Formulario de contacto',  
		)
	); 
	return $fields;
} 