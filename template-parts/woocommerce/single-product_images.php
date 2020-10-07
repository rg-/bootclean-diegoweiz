<div class="images">
	<?php
	global $product;
 
	$slick = array(
		'dots' => false,
		'arrows' => true, 
		'infinite' => true,
		'speed' => 600,
		'autoplay' => false, 
	);
	$slick = json_encode($slick); 

	if($product->get_image_id()){
		$post_thumbnail_id = $product->get_image_id();
	?>

	<div class="theme-slick-slider" data-slick='<?php echo $slick; ?>' data-disable-affix-offset="true" >

		<div class="item">
			<?php
			$img_hi = wp_get_attachment_image_src($post_thumbnail_id,'large');
			$img_low = wp_get_attachment_image_src($post_thumbnail_id,'medium');
			?>
			<img src="<?php echo $img_hi[0]; ?>" alt=""/>
		</div>

		<?php if ($product->get_gallery_image_ids()){ 
			$attachment_ids = $product->get_gallery_image_ids();
			foreach ( $attachment_ids as $attachment_id ) {
				?>
				<div class="item">
					<?php
					$img_hi = wp_get_attachment_image_src($attachment_id,'large');
					$img_low = wp_get_attachment_image_src($attachment_id,'medium');
					?>
					<img src="<?php echo $img_hi[0]; ?>" alt=""/>
				</div>
				<?php
			}
			?>
		<?php } ?>

	</div>

	<?php } ?>

</div>