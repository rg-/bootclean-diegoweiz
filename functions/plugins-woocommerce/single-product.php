<?php

add_filter('wpbc/filter/woocommerce/config', function($wpbc_woocommerce_config){

	$wpbc_woocommerce_config['layout']['product'] = array(
		'class' => 'col-images-md-9 col-summary-md-3',
		'tab_class' => 'col-md-9',
		'upsell_class' => 'col-12',
		'related_class' => 'col-12',
	);

	return $wpbc_woocommerce_config;

},10,1);


/*

	TEMPLATE CUSTOMS

*/





/**
	 * Hook: woocommerce_before_single_product_summary.
	 *
	 * @hooked woocommerce_show_product_sale_flash - 10
	 * @hooked woocommerce_show_product_images - 20
	 */
add_action( 'woocommerce_before_single_product_summary', function(){

	remove_action('woocommerce_before_single_product_summary','woocommerce_show_product_images',20);

	add_action('woocommerce_before_single_product_summary', function(){ 
		WPBC_get_template_part('woocommerce/single-product_images');  
	}, 20);

}, 0 );

/**
		 * Hook: woocommerce_single_product_summary.
		 *
		 * @hooked woocommerce_template_single_title - 5
		 * @hooked woocommerce_template_single_rating - 10
		 * @hooked woocommerce_template_single_price - 10
		 * @hooked woocommerce_template_single_excerpt - 20
		 * @hooked woocommerce_template_single_add_to_cart - 30
		 * @hooked woocommerce_template_single_meta - 40
		 * @hooked woocommerce_template_single_sharing - 50
		 * @hooked WC_Structured_Data::generate_product_data() - 60
		 */ 

add_action( 'woocommerce_single_product_summary', function(){  

	global $product; 

	remove_action('woocommerce_single_product_summary','woocommerce_template_single_title',5); 
	remove_action('woocommerce_single_product_summary','woocommerce_template_single_meta',40); 

	if( $product->get_type() == 'variable' ){
		remove_action('woocommerce_single_product_summary','woocommerce_template_single_price',10); 
		?>
		<h2 class="section-title md gpt-lg-2 gpr-lg-2">Select the product variables</h2>
		<?php
		// remove_action('woocommerce_single_product_summary','woocommerce_template_single_add_to_cart',30);
		// WPBC_get_template_part('woocommerce/single-product_summary', $product); 
	}  

}, 0);


add_filter( 'woocommerce_reset_variations_link', function($link){
	$link = '<a class="reset_variations" href="#"><u>' . esc_html__( 'Reset', 'woocommerce' ) . ' variations</u></a>';
	return $link;
},10,1 );

add_action( 'woocommerce_before_single_variation', function(){  
	global $product; 
	if( $product->get_type() == 'variable' ){
		?>
		<p>Frames only for Uruguay shipping.</p>
		<?php
	}
}, 10);
/**
	 * Hook: woocommerce_after_single_product_summary.
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */

remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_upsell_display', 15 );
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );


add_action('woocommerce_after_single_product_summary',function(){
	global $product; 
	if( $product->get_type() == 'variable' ){ 

		WPBC_get_template_part('woocommerce/single-product_content', $product); 
	} 
},5);

add_filter('woocommerce_product_single_add_to_cart_text',function($text,$class){
	$text = 'BUY';
	return $text;
},10,2);

/*

	ACF FOR SINGLE PRODUCT & VARIABLE

*/

add_action('add_meta_boxes','WPBC_woo_grouped_meta_boxes', 50);

function WPBC_woo_grouped_meta_boxes(){
	$get_screen = get_current_screen();
    $current_screen = $get_screen->post_type; 
    if ($current_screen == 'product' && isset($_GET['post']) ) {  
    		$product = wc_get_product( $_GET['post'] );
    		if($product->get_type() == 'variable'){
					remove_meta_box( 'postexcerpt' , 'product' , 'normal' );
					remove_meta_box( 'commentsdiv' , 'product' , 'normal' );
					//remove_meta_box( 'woocommerce-product-images' , 'product' , 'side' );
					//remove_meta_box( 'postimagediv' , 'product' , 'side' );
					//remove_meta_box( 'product_catdiv' , 'product' , 'side' );
					//remove_meta_box( 'tagsdiv-product_tag' , 'product' , 'side' );
				}
	    }  
}

add_action( 'current_screen', 'WPBC_woo_grouped_editor_support' );
function WPBC_woo_grouped_editor_support() { 
    $get_screen = get_current_screen();
    $current_screen = $get_screen->post_type; 
    if ($current_screen == 'product' && isset($_GET['post']) ) {  
    		$product = wc_get_product( $_GET['post'] );
    		if( is_object($product) && $product->get_type() == 'variable'){
        	remove_post_type_support( $current_screen, 'editor' );   
        }
    }  
}

add_action('admin_init',function(){

	if( function_exists('acf_add_local_field_group') ):

	$group_woo_acf_single_variable = array();
		
		$sub_fields = array();

			$group_woo_acf_single_variable[] = WPBC_acf_make_textarea_field(array(
				'name' => 'woo_single_variable_copias',
				'label' => 'Copias', 
			));
			$group_woo_acf_single_variable[] = WPBC_acf_make_textarea_field(array(
				'name' => 'woo_single_variable_papel',
				'label' => 'Papel', 
			));

			$sub_fields[] = WPBC_acf_make_text_field(array(
				'name' => 'info_title',
				'label' => 'Title',
			));
			$sub_fields[] = WPBC_acf_make_textarea_field(array(
				'name' => 'info_content',
				'label' => 'Content',
			));
 
		$group_woo_acf_single_variable[] = WPBC_acf_make_repeater_field(array(
			'name' => 'woo_single_variable_information',
			'label' => 'Extra Title & Content',
			'sub_fields' => $sub_fields,
			'button_label' => 'Add Content'
		));

	acf_add_local_field_group(array(
		'key' => 'group_woo_acf_single_variable',
		'title' => 'Product Information',
		'fields' => $group_woo_acf_single_variable,
		'location' => array(
			array(
				array(
					'param' => 'post_type',
					'operator' => '==',
					'value' => 'product',
				),
				array(
					'param' => 'post_taxonomy',
					'operator' => '==',
					'value' => 'product_type:variable',
				),
			),
		),
		'menu_order' => 0,
		'position' => 'normal',
		'style' => 'default',
		'label_placement' => 'top',
		'instruction_placement' => 'label',
		'hide_on_screen' => '',
		'active' => true,
		'description' => '',
	));

	endif;

});