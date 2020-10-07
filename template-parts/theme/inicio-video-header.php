<?php  

	$row_args = wpbc_get_template_part_row_args($args); 

 	$bg_img = '';
	if(!empty($row_args['bg-image'])){
		$img_med = wp_get_attachment_image_src($row_args['bg-image'], 'medium', false );
		$img_full = wp_get_attachment_image_src($row_args['bg-image'], 'full', false ); 
		$bg_img = $img_full[0];
	} 

	$heights = array(
		'xs' => array(
			'default'=>'100wh',
			'min'=>'340px',
			'max'=>'800px'
		)
	);
	$heights = json_encode($heights);
 
?>
<div data-responsive-heights='<?php echo $heights; ?>' class="ui-video-full image-cover" style="background-image: url('<?php echo $bg_img; ?>');">

	<?php if(!empty($row_args['video-mp4'])){ ?>
		<video class="ui-video-full--video" playsinline autoplay muted onplaying="this.controls=false;this.playbackRate=0.35;" loop>
	      <source src="<?php echo wp_get_attachment_url($row_args['video-mp4']); ?>" type='video/mp4; codecs="avc1.42E01E, mp4a.40.2"'>
	   </video>
	 <?php } ?>

	<div class="ui-video-full--overlay h-100 d-flex align-items-end justify-content-center">
		<div class="gpy-2 text-center">
			<?php
			if(!empty($row_args['logo'])){
				$img_med = wp_get_attachment_image_src($row_args['logo'], 'medium', false );
				$img_full = wp_get_attachment_image_src($row_args['logo'], 'full', false ); 
				$bg_img = $img_full[0];
				?>
				<p><img src="<?php echo $bg_img; ?>" width="280" alt=" "/></p>
				<?php
			}
			?>
			<p class="gpt-1">
				<a href="#gallery" class="scroll-to btn text-white btn-view-more">View more</a>
			</p>
		</div>
	</div>
</div>