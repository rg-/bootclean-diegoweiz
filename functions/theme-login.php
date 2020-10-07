<?php

// Disable option page for this addon
add_filter('wpbc/filter/custom_login/options_page/enable','__return_false',10,1);

// Enable adddon
add_filter('wpbc/filter/custom_login/enable','__return_true',10,1);

// Set arguments by default
add_filter('wpbc/filter/custom_login/default_args', function($args){
	/* EX */
	$args['login_brand'] = array(
		'background-image' => get_stylesheet_directory_uri().'/images/theme/logo-diegoweiz-negro.png',
		'background-size' => '78px auto',
		'width' => '78px',
		'height' => '78px',
	);
	
	return $args;

},10,1); 

add_action( 'login_head', function(){

	$args = WPBC_get_theme_settings_custom_login_default_args(); 
	// _print_code($args);
	$theme_uri = CHILD_THEME_URI.'/fonts/theme/';

	$primary = '#000000';
	$color_primary = '#ffffff';
?>

<style>
	.wp-core-ui .button, .wp-core-ui .button-secondary{
		color: <?php echo $primary; ?>;
    border-color: <?php echo $primary; ?>;
	}
	.wp-core-ui .button-primary{
		background-color: <?php echo $primary; ?>;
		border-color: <?php echo $primary; ?>;
		color: <?php echo $color_primary; ?>;
		font-size: 0.938rem;
    line-height: 1.5;
    border-radius: 0;
    padding: 6px 15px; 
	}
	.wp-core-ui .button.button-large{
		min-height: auto;
		line-height: 1.5;
		padding: 6px 15px; 
	}
	.wp-core-ui .button-primary:hover{
		background-color: <?php echo $primary; ?>;
    border-color: <?php echo $primary; ?>;
	}
	input[type=checkbox]:focus, input[type=color]:focus, input[type=date]:focus, input[type=datetime-local]:focus, input[type=datetime]:focus, input[type=email]:focus, input[type=month]:focus, input[type=number]:focus, input[type=password]:focus, input[type=radio]:focus, input[type=search]:focus, input[type=tel]:focus, input[type=text]:focus, input[type=time]:focus, input[type=url]:focus, input[type=week]:focus, select:focus, textarea:focus {
		    border-color: <?php echo $primary; ?>;
		    box-shadow: 0 0 0 1px <?php echo $primary; ?>;
		    outline: 2px solid transparent;
		} 

</style>

<?php

} );