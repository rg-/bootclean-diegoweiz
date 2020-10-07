<?php 
global $product;
$image_id = $product->get_image_id(); 
$img_hi = wp_get_attachment_image_src($image_id,'large');  
?>
<?php if(empty($args['item_no_wrap'])){?>
<div class="<?php echo !empty($args['item_class']) ? $args['item_class'] : 'col-md-6 col-lg-4'; ?>">
<?php } ?>
	<div class="ui-product-item" data-is-inview="detect">
		<a href="<?php echo get_permalink( $product->get_id() ); ?>">
			<img src="<?php echo $img_hi[0]; ?>" alt=" "/>
			<div class="overlay">
				<h3 class="title"><?php echo $product->get_name(); ?></h3>
			</div>
		</a>
	</div>
<?php if(empty($args['item_no_wrap'])){?>
</div>
<?php } ?>