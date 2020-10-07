<?php

	/*

		wpbc woocommerce config for Checkout pages

	*/
	add_filter('wpbc/filter/woocommerce/config', function ($wpbc_woocommerce_config){
		
		$wpbc_woocommerce_config['layout']['checkout'] = array(
			'class' => ' col-col2-flex-column ', // make columns as rows
		); 

		return $wpbc_woocommerce_config;

	},10,1); 

	add_filter('weisz/fixed_nav', function($fixed_nav){
		if( is_checkout() ){
			$fixed_nav = false;
		}
		return $fixed_nav;
	},10,1);

	add_filter('wpbc/filter/layout/main-navbar/defaults', function($args){  
		if( is_checkout() ){
			//$args['affix'] = false;
			//$args['class'] .= ' affix-absolute-top ';
		}
		return $args;
	},10,1);

	add_filter('WPBC_post_header_title_class', function($class){
	if( is_checkout() ){
		$class = 'section-title';
	}
	return $class; 
},10,1);
 
	 add_filter('wpbc/filter/layout/single/page/actions',function($use){
		if( is_checkout() ){
			$use = false;
		}
		return $use; 
	},10,1);  

	/*
	
	Change layout for login form and cart resume

	templates/checkout/form-checkout.php

	*/
	remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_login_form', 10 );
	remove_action( 'woocommerce_before_checkout_form', 'woocommerce_checkout_coupon_form', 10 );

	remove_action( 'woocommerce_checkout_order_review', 'woocommerce_order_review', 10 ); 
	remove_action( 'woocommerce_checkout_order_review', 'woocommerce_checkout_payment', 20 ); 

	add_action('woocommerce_before_checkout_form',function($checkout){
		?>
		<div id="affix-checkout-area" class="position-relative">
			<div class="col2-set">
				<div class="col-1">
					<div class="woo-custom-checkout-login-form">
						<?php woocommerce_checkout_coupon_form(); ?>
						<?php woocommerce_checkout_login_form(); ?>
					</div>
				</div>
			</div>
		<?php 
	},10,1);

	add_action('woocommerce_after_checkout_form',function($checkout){
		?>
		</div><!-- #affix-checkout-area END -->
		<?php 
	},10,1);

	add_action('woocommerce_checkout_before_customer_details', function(){  

	?>
	<!--<div id="checkout_wrapper" class="d-flex d-md-block flex-column">-->
	<?php 
}); 

add_action('woocommerce_checkout_after_customer_details', function(){  

	?> 

	<div id="payment_method" class="col2-set">
		<div class="col-1">

			<h3 class="woo-form-title gmb-1">Payment method</h3>
			<p class="font-size-14">Select your preferred payment method.</p>

			<?php woocommerce_checkout_payment(); ?>

		</div>
	</div> 

	<div id="affix-column" class="affix-container-absolute z-index-40" data-toggle="nav-affix" data-affix-position="top" data-affix-breakpoint="md" data-affix-target="#affix-checkout-area" data-affix-simulate="false" data-affix-scrollify="true" data-affix-detect="bottom" data-affix-inner-element=".affix-column">
		<div class="container affix-container"> 
			<!-- woo-custom-checkout-review-order column  -->
			<div class="col-md-6 order-md-2 ml-auto affix-column">
				<div class="woo-custom-checkout-review-order">
					<h3 class="woo-form-title gmt-1 gmb-1">Order summary</h3>
					<?php 
				 	woocommerce_order_review(); 
					?>
				</div>
			</div>
		</div>
	</div><!-- #affix-column end -->

<!--</div> #checkout_wrapper end -->

	<?php 

});


add_action( 'woocommerce_after_checkout_validation', 'wpbc_checkout_validation_one_err', 9999, 2);
 
function wpbc_checkout_validation_one_err( $fields, $errors ){ 
	// if any validation errors
	if( !empty( $errors->get_error_codes() ) ) { 
		// remove all of them
		foreach( $errors->get_error_codes() as $code ) {
			$errors->remove( $code );
		} 
		// add our custom one
		$errors->add( 'validation', 'Check the fields marked in red to continue.' ); 
	} 
}

add_action( 'woocommerce_review_order_after_order_total', function(){
	if(wpbc_if_cart_not_shippable()){
		
	}
});

/*

	Conditional shipping enable/disable by country and product variation

*/

add_filter( 'woocommerce_order_button_html', function($button_html){
	if(!wpbc_if_cart_not_shippable()){
		$button_html = '';
	}
 	return $button_html;
},10,1 );


add_action( 'woocommerce_review_order_after_submit', 'wpbc_products_not_shipable' );
add_action( 'woocommerce_after_cart_totals', 'wpbc_products_not_shipable' );

remove_action('woocommerce_proceed_to_checkout', 'woocommerce_button_proceed_to_checkout', 20);
add_action('woocommerce_proceed_to_checkout', function(){

	if(wpbc_if_cart_not_shippable()){
		woocommerce_button_proceed_to_checkout();
	}

}, 20);

function wpbc_products_not_shipable(){  
  if(!wpbc_if_cart_not_shippable()){
  	
  	?>
  	
  	<?php if(is_checkout()){ 
  		wc_print_notice( __( 'Order cannot be processed.', 'weisz' ), 'error' );
  		?>
  		<p>There is a product that cannot be sent to your country in your order.</p>
  		<p>Check the <a href="<?php echo wc_get_cart_url(); ?>">Cart</a> and / or your shipping addresses.</p>
  	<?php } ?>

  	<?php if(is_cart()){ 
  		wc_print_notice( __( 'Cart cannot be processed.', 'weisz' ), 'error' );
  		?>
  		<p>There is a product that cannot be sent to your country in your Cart.</p>
  		<p>Delete the Cart Items or Change your Shipping Address. <br>Remember that Frames with Glass is only shipped within Uruguay.</p>
  	<?php } ?>


  	<?php
  } 
}  

function wpbc_if_cart_not_shippable(){
	
	$country = WC()->session->get('customer')['shipping_country'];
  if( empty($country) ){
    $country = WC()->session->get('customer')['billing_country'];
  } 

	$enable_shipping = true;
  foreach ( WC()->cart->get_cart() as $cart_item ){
    if( $cart_item['variation_id'] > 0 ){ 
    	if( $country != 'UY' && $cart_item['variation']['attribute_pa_frames'] == 'with-glass' ){
    		$product = wc_get_product( $cart_item['product_id'] );
    		//_print_code($product->get_name());
    		$enable_shipping = false;
    		break;
    	} 
    }
  }
  return $enable_shipping;
}