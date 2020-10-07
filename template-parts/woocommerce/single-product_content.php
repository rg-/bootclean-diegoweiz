<?php
global $product;
?>

<div class="gpb-4 woo_single_variable_summary">
	<h2 class="section-title gmb-3"><?php echo $product->get_name(); ?></h2>
	<?php
	$product_id = $product->get_id();

	$woo_single_variable_copias = get_post_meta($product_id, 'woo_single_variable_copias', true);
	if(!empty($woo_single_variable_copias)){
	?>
	<div class="woo_single_variable_information">
			<h3 class="section-subtitle">Copias</h3>
			<div class="woo_single_variable_information_content">
				<p><?php echo $woo_single_variable_copias; ?></p>
			</div>
		</div>
	<?php 
	}
	$woo_single_variable_papel = get_post_meta($product_id, 'woo_single_variable_papel', true);
	if(!empty($woo_single_variable_papel)){
	?>
	<div class="woo_single_variable_information">
			<h3 class="section-subtitle">Papel</h3>
			<div class="woo_single_variable_information_content">
				<p><?php echo $woo_single_variable_papel; ?></p>
			</div>
		</div>
	<?php 
	}
	
	$woo_single_variable_information = get_post_meta($product_id, 'woo_single_variable_information', true); 
	for ($i=0; $i<$woo_single_variable_information; $i++) {
		$info_title = get_post_meta($product_id, 'woo_single_variable_information_'.$i.'_info_title', true);
		$info_content = get_post_meta($product_id, 'woo_single_variable_information_'.$i.'_info_content', true);
		?>
		<div class="woo_single_variable_information">
			<h3 class="section-subtitle"><?php echo $info_title; ?></h3>
			<div class="woo_single_variable_information_content">
				<p><?php echo $info_content; ?></p>
			</div>
		</div>
		<?php
	}
	?>

	<?php 
	$social_defaults = array( 
		
		array(
			'id' => 'facebook',
			'icon_html' => '<i class="fab fa-facebook"></i>', 
			'title'=> 'Facebook',
			'item_class' => 'btn'
		),
		array(
			'id' => 'twitter',
			'icon_html' => '<i class="fab fa-twitter"></i>', 
			'title'=> 'Twitter',
			'item_class' => 'btn'
		),
		array(
			'id' => 'delicious',
			'icon_html' => '<i class="fab fa-delicious"></i>',  
			'title'=> 'Delicious',
			'item_class' => 'btn'
		),
		array(
			'id' => 'digg',
			'icon_html' => '<i class="fab fa-digg"></i>',
			'title'=> 'Digg',
			'item_class' => 'btn'
		), 
		array(
			'id' => 'stumbleupon',
			'icon_html' => '<i class="fab fa-stumbleupon"></i>',
			'title'=> 'Stumble',
			'item_class' => 'btn'
		), 
		array(
			'id' => 'pinterest',
			'icon_html' => '<i class="fab fa-pinterest"></i>',
			'title'=> 'Pinterest',
			'item_class' => 'btn'
		), 

		array(
			'id' => 'email',
			'icon_html' => '<i class="fab fa-envelope"></i>', 
			'title'=> 'Email',
			'item_class' => 'btn'
		),

	);
	$share_args = array( 
		'type' => 'modal',
		'class' => 'd-flex',
		'modal_title' => __('Share', 'bootclean') . ' ' . $product->get_name(),
		'modal_class' => 'modal fade', 
		'modal_dialog_class' => 'modal-dialog modal-dialog-centered',
		'modal_header_class' => 'text-center',
		'modal_body_class' => 'modal-body gpb-2 text-center',
		'switch_label' => __('Share', 'bootclean'), 
		'switch_icon' => '<i class="fa fa-share-alt"></i>', 
		'switch_class' => 'ml-auto btn btn-transparent',
		'social_defaults' => $social_defaults, 
	);  

	add_filter('wpbc/filter/post/share/button/before', function($before, $id){
		if($id=='email'){
			$before = '<p class="gmy-1">- or -</p>';
		}
		return $before;
	},10,2);

	WPBC_post_share( $share_args ); 
	?>
</div>