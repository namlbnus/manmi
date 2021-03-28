jQuery(document).ready(function($){

	let tel = '<a id="header-tel" href="tel:0358551245"><img src="/wp-content/uploads/2021/03/Group-5-1.png"></a>';
	$('div#masthead .logo-left').append(tel);

});
jQuery(document).ready(function($){ //hr1 slider
	var slider_hr1 = tns({
		"items": 2,
		"container": ".hr1-container",
		"fixedWidth": 400,
		"controls": true,
		"gutter": 25,
		"navPosition":"bottom",
	});

});
jQuery(document).ready(function($){ //hr3 slider
	var slider_hr3 = tns({
		"items": 5,
		"container": ".hr3-container",
		"controls": true,
		"gutter": 25,
		"navPosition":"bottom",
	});

});
jQuery(document).ready(function($){ //hr5 slider
	var slider_hr5 = tns({
		"items": 3,
		"container": ".hr5-container",
		"controls": true,
		"gutter": 25,
		"navPosition":"bottom",
	});
	$( "div#hr5-slide" ).each(function( index ) {
		$( this ).find(".tns-slide-active:eq(1)").toggleClass('item-center');
	});
	$('div#hr5-slide').on("click","button",function(){
		$( "div#hr5-slide" ).each(function( index ) {
			$( this ).find(".tns-slide-active").removeClass('item-center');
			$( this ).find(".tns-slide-active:eq(1)").toggleClass('item-center');
		});
	});
});

jQuery(document).ready(function($){ //change slider controls image

	let prev = "<img src='/wp-content/uploads/2021/03/Stroke-1.png'/>";
	let next = "<img src='/wp-content/uploads/2021/03/Stroke-1-1.png'/>";

	$('.tns-controls button[data-controls="prev"]').html(prev);
	$('.tns-controls button[data-controls="next"]').html(next);

});