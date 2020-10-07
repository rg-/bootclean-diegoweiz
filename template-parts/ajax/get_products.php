<?php 
$_WP_Query_args = array(
	'post_status' => 'publish',
	'post_type' => 'product',
	'posts_per_page' => isset($_GET['posts_per_page']) ? $_GET['posts_per_page'] : 6, 
	'paged' => isset($_GET['v']) ? $_GET['v'] : 1,
); 
$loop = new WP_Query( $_WP_Query_args );
$_total = $loop->max_num_pages; 
?>
<?php if ( $loop->have_posts() ) { ?>
	<?php while ( $loop->have_posts() ) {
		$loop->the_post(); 
		global $product;
		$image_id = $product->get_image_id();
		$img_hi = "[WPBC_get_attachment_image_src id='".$image_id."']";
		$img_low = "[WPBC_get_attachment_image_src id='".$image_id."' size='medium']";
		$img_mini = "[WPBC_get_attachment_image_src id='".$image_id."' size='thumbnail']";
		?>
		<div class="col-md-6 col-lg-4" data-is-inview="detect">
			<div class="ui-product-item">
				<a href="<?php echo get_permalink( $product->get_id() ); ?>">
					<img src="<?php echo $img_hi; ?>" alt=" "/>
					<div class="overlay">
						<h3 class="title"><?php echo $product->get_name(); ?></h3>
					</div>
				</a>
			</div>
		</div>
	<?php } ?>
<?php }
wp_reset_postdata();
?>