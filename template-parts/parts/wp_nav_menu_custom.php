<div id="collapse-custom" class="hidden collapse-custom">

		<div class="collapse-custom-wrapper">
			<div class="collapse-custom-action">
				<?php
				$navbar_toggler = array(
					'class' => 'toggler-primary',
					'target' => 'collapse-custom',
					'expanded' => true,
					'label' => __('Toggle navigation', 'bootclean'), 
					'type' => 'animate', /* default | animate */
					'effect' => 'close-arrow', /* rotate | collapsable | cross | asdot */ 
					'attrs' => '',
					'data_toggle' => 'data-toggle="collapse-custom"',
				);
				WPBC_get_partial('navbar-toggler', $navbar_toggler);
				?></div>
				<div class="collapse-custom-animate gpy-2">
				<?php 
					$wp_nav_menu = array(
							'theme_location'  => 'primary',
							'depth'	          => 2, // 1 = no dropdowns, 2 = with dropdowns.
							'container'       => 'div',
							'container_class' => '',
							'container_id'    => '',
							'menu_class'      => 'navbar-nav ',
							'fallback_cb'     => 'WP_Bootstrap_Navwalker::fallback',
							'walker'          => new WP_Bootstrap_Navwalker(), 
							'before_menu'			=> '',
							'after_menu'			=> '',
						);
					wp_nav_menu( $wp_nav_menu ); 
					?>
				</div>
	</div>
</div>
<div id="collapse-custom-overlay" class="hidden collapse-custom-overlay"></div>