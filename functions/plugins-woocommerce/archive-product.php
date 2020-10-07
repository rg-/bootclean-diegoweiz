<?php

add_filter('woocommerce_show_page_title', function(){
	return false;
},10,1);

/**
	 * Hook: woocommerce_before_shop_loop.
	 *
	 * @hooked woocommerce_output_all_notices - 10
	 * @hooked woocommerce_result_count - 20
	 * @hooked woocommerce_catalog_ordering - 30
	 */
add_action( 'woocommerce_before_shop_loop', function(){

	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20);
	remove_action( 'woocommerce_before_shop_loop', 'woocommerce_catalog_ordering', 30);

},0 );


add_filter( 'woocommerce_product_loop_start', function(){
	echo '<ul class="row row-no-gutters p-0">';
},10,1 );

add_filter( 'woocommerce_product_loop_end', function(){
	echo '</ul>';
},10,1 );


add_filter( 'woocommerce_post_class', function($classes, $product){
	if( is_shop() || is_product_taxonomy() ) {
		$classes[] = 'col-md-6 col-lg-4';
	}
	return $classes; 
},10,2 );

  

/**
	 * Hook: woocommerce_before_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_open - 10
	 */
	
	remove_action('woocommerce_before_shop_loop_item','woocommerce_template_loop_product_link_open',10);

	add_action( 'woocommerce_before_shop_loop_item',function(){

		WPBC_get_template_part('woocommerce/product', array(
			'item_no_wrap' => true,
		));

		//echo '<div class="ui-product-item" data-is-inview="detect">';
	},5 );

		/**
	 * Hook: woocommerce_after_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_close - 5
	 * @hooked woocommerce_template_loop_add_to_cart - 10
	 */
	add_action( 'woocommerce_after_shop_loop_item',function(){
		//echo '</div>';
	},6 );

 /**
	 * Hook: woocommerce_before_shop_loop_item_title.
	 *
	 * @hooked woocommerce_show_product_loop_sale_flash - 10
	 * @hooked woocommerce_template_loop_product_thumbnail - 10
	 */


 /* WPBC @hooked WPBC_woo_product_thumbnail */

 add_action('woocommerce_before_shop_loop_item_title', function(){ 
 	remove_action('woocommerce_before_shop_loop_item_title','WPBC_woo_product_thumbnail',10); 
 },0); 

	/**
	 * Hook: woocommerce_shop_loop_item_title.
	 *
	 * @hooked woocommerce_template_loop_product_title - 10
	 */

	remove_action('woocommerce_shop_loop_item_title','woocommerce_template_loop_product_title',10);

	add_action( 'woocommerce_shop_loop_item_title', function(){

	},0);

/**
	 * Hook: woocommerce_after_shop_loop_item_title.
	 *
	 * @hooked woocommerce_template_loop_rating - 5
	 * @hooked woocommerce_template_loop_price - 10
	 */

	remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_rating',5);
	remove_action('woocommerce_after_shop_loop_item_title','woocommerce_template_loop_price',10);
	
	add_action( 'woocommerce_after_shop_loop_item_title', function(){

	},0 );

/**
	 * Hook: woocommerce_after_shop_loop_item.
	 *
	 * @hooked woocommerce_template_loop_product_link_close - 5
	 * @hooked woocommerce_template_loop_add_to_cart - 10
	 */

	remove_action('woocommerce_after_shop_loop_item','woocommerce_template_loop_product_link_close',5);
	remove_action('woocommerce_after_shop_loop_item','woocommerce_template_loop_add_to_cart',10);

	add_action( 'woocommerce_after_shop_loop_item', function(){

	},0 );