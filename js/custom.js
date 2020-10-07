+function(t){ 
 	

	

	if($('.variations select').length>0){
		$('.variations select').selectpicker(
			{ 
				showTick : true,
				style: 'btn-transparent'
			}
		);
	} 

 /*
	
		[data-ajax-load]

	*/

	$(document).on('click', '[data-ajax-load]', function(ev){

 		var me = $(this);
 		var url = me.attr('data-ajax-load');
 		var target = me.attr('data-ajax-target');
 		var holder = me.parent();

 		AjaxLoad_start(me);

 		$.ajax({ type: "GET",   
		     url: url,   
		     success : function(text)
		     {
		         // $( target ).append(text);
		         AjaxLoad_success(me, text);
		         if( me.attr('data-href') ){
		         	var new_url = me.attr('data-href');
		         	var new_object = me.attr('data-href-id');
		         	console.log(new_object);
		         	window.history.pushState({id: new_object}, 'Title', new_url);
		         }
		         
		     }
		}); 
 	}); 

 	window.onpopstate = function (e) {
	  var id = e.state.id;
	  if(id && $('[data-ajax-load][data-href-id='+id+']').length>0 ){
	  	console.log(id);
	  	$('[data-ajax-load][data-href-id='+id+']').trigger('click');
	  } 
	};

 	function AjaxLoad_error(me){
 		var msg = "Sorry but there was an error: ";
		$( "#error" ).html( msg + xhr.status + " " + xhr.statusText );
 	}
 	function AjaxLoad_start(me){
 		var target = me.attr('data-ajax-target');
 		$( target ).removeClass('ajax-loaded');
 		$( target ).addClass('ajax-loading');  

 		if( me.attr('data-ajax-scroll') ){

 			// bs_scroll_to(me.attr('data-ajax-scroll'),0,me);
 			scrollto_offset = $(me.attr('data-ajax-scroll')).offset().top; 
 			$('html, body').animate({
				scrollTop: scrollto_offset
				} );

 		}

 	}
 	function AjaxLoad_success(me, items){
 		var target = me.attr('data-ajax-target');
 		$( target ).fadeOut(0);
  	$( target ).removeClass('ajax-loading');
  	$( target ).addClass('ajax-loaded');
  	 
  	if(me.attr('data-ajax-load-remove') == 'me'){
	  	me.remove();
	  }

	  if(me.attr('data-ajax-load-method') == 'append'){
	  	$( target ).append(items);
	  }
	  if(me.attr('data-ajax-load-method') == 'replace' || !me.attr('data-ajax-load-method') ){
	  	$( target ).html(items); 
	  }
	  $( target ).fadeIn(300,function(){
	  	//$( target ).find('[data-is-inview]').is_inview();
	  });
	  
	  
 	}

}(jQuery); 