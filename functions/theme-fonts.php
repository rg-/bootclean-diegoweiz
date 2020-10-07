<?php 
/*

	- Custom font used, see https://transfonter.org/ to transform any font file into web font-family one

	- Use priority 0 to put code on very top position (load first of any other css used)
	- Notice the "body.using-theme-fonts" definition
	- Add body class
	- You could include here any kind of code in fact, but keep for fonts.

 */

add_filter('wpbc/body/class', 'wpbc_child_body_class__fonts',		0,	1);
add_action('wp_head', 				'wpbc_child_wp_head__fonts', 			0); 

function wpbc_child_body_class__fonts($body_class){
	$body_class .= ' using-theme-fonts';
	return $body_class;
}

function wpbc_child_wp_head__fonts() {
	$theme_uri = CHILD_THEME_URI.'/fonts/theme/';
 	echo "<style>

 		@font-face {
		    font-family: 'DMSans';
		    src: url('".$theme_uri."subset-DMSans-Regular.eot');
		    src: url('".$theme_uri."subset-DMSans-Regular.eot?#iefix') format('embedded-opentype'),
		         url('".$theme_uri."subset-DMSans-Regular.woff2') format('woff2'),
		         url('".$theme_uri."subset-DMSans-Regular.woff') format('woff'),
		         url('".$theme_uri."subset-DMSans-Regular.ttf') format('truetype'),
		         url('".$theme_uri."subset-DMSans-Regular.svg#gilroyeb') format('svg');
		    font-weight: normal;
		    font-style: normal;
		}

		body.using-theme-fonts{
			letter-spacing: 1px;
			font-family: 'DMSans', helvetica, arial, sans-serif; 
		}

		</style>";
}  

/* Embed Font Awesome */

add_filter('BC_enqueue_scripts__fonts', 'wpbc_child_enqueue_custom_font_awesome'); 

function wpbc_child_enqueue_custom_font_awesome($fonts){ 
	$fonts['fontawesome-all'] = array( 
		'src'=>'css/fontawesome/all.min.css'
	); 
	return $fonts; 
}

/* Remove default iconmoon fonts */
add_filter('wpbc/filter/enqueue/iconmoon/uri',function($iconmoon_uri){
	return false;
},10,1);

/* Add custom iconmoon fonts */
add_filter('WPBC_enqueue_scripts__head_styles', function($styles){
	$styles['iconmoon-weisz'] = array( 
		'src'=>'fonts/theme/iconmoon/style.css'
	);
	return $styles;
},10,1);