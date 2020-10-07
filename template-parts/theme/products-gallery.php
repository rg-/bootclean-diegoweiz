<div id="ui-products-gallery" class="ui-products-gallery position-relative gmt-1 gmb-6">

	<nav id="navbar-products" class="navbar bg-light"  data-toggle="nav-affix" data-affix-position="top" data-affix-breakpoint="xs" data-affix-target="#ui-products-gallery" data-affix-simulate="true" data-affix-scrollify="true" >

		<div class="container aside-expand-content">
  	
	  	<div class="w-100">
	  		<?php 

	  		$child_of = WPBC_get_theme_settings('woo_gallery_cat');

				$args = array(
					'taxonomy'=> 'product_cat',
					'orderby'=> 'name',
					'order' => 'ASC', 
					'hide_empty' => 0,
					'child_of' => $child_of
				);
				$tax = get_categories($args);

	  		//_print_code($tax);
	  		?>
	    	<ul class="navbar-nav flex-row justify-content-center flex-wrap align-items-center">
	    		<?php foreach($tax as $term){ ?> 
						<li class="menu-item nav-item"><a href="<?php echo get_term_link($term);?>" class="nav-link"><?php echo $term->name;?></a></li>
					<?php } ?> 
				</ul>		
			</div>
				
  	</div>
	  
	</nav>

	<?php 
	$_paged = ( get_query_var('paged') ) ? get_query_var('paged') : 1; 
	$_WP_Query_args = array(
		'post_status' => 'publish',
		'post_type' => 'product',
		'posts_per_page' => 15, 
		'paged' => $_paged, 
	); 
	$loop = new WP_Query( $_WP_Query_args );
	$_total = $loop->max_num_pages; 
	?>
	<div class="container gmy-1">

		<?php if ( $loop->have_posts() ) { ?>
			<div class="row row-no-gutters">
				<?php while ( $loop->have_posts() ) {
					$loop->the_post(); 
					WPBC_get_template_part('woocommerce/product', array(
						'item_class' => 'col-md-6 col-lg-4'
					));
					} 
				?>
			</div>
		<?php } 
		wp_reset_postdata();
		?>

	</div>


	<!-- 

	<div class="container gmy-1">
		<div id="ajax-products-loader" class="row row-no-gutters ajax-load-holder">
			
		</div>
	</div>

	<p class="text-center"><button data-ajax-load="<?php echo admin_url( 'admin-ajax.php' ); ?>?action=get_template&name=ajax/get_products" data-ajax-target="#ajax-products-loader" data-ajax-load-method="append" class="btn btn-primary gmt-1">Cargar más</button></p>

	-->

</div>