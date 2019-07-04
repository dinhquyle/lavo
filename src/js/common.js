/* for gNavi PC */
$(window).resize(function(){
	$(".navSub").css('display','none');
	$(".gNavi .hasSub").removeClass('active');
});

function gNaviHover() {
	var btn = $(".gNavi .hasSub");
	var submenu = $(".navSub");
	$(btn).hover(function() {
		var shownav = $(this).find(".navSub");
		browserWidth = $(window).width();
		if (browserWidth > 767) {
			if($(shownav).css("display") == "none") {
				$(shownav).stop().slideDown(200);
				$(this).addClass('active');
			}else{
				$(shownav).stop().slideUp(0);
				$(this).removeClass('active');
			}
		}
	},
	function() {
		var shownav = $(this).find(".navSub");
		browserWidth = $(window).width();
		if (browserWidth > 767) {
			$(shownav).stop().slideUp(0);
			$(this).removeClass('active');
		}
	});
}

gNaviHover();

$('.closeSub').click(function(){
	$(this).parent(".navSub").stop().slideUp(200);
	$(this).parents(".hasSub").removeClass('active');
});
/* end gNavi PC */


/* menu header SP */
$('.hamberger').click(function(){
	$(this).toggleClass("active");
	$("body").toggleClass("layerOn");
});

$('.close_layer, .gNavi li a').click(function(){
	$('.hamberger').removeClass("active");
	$("body").toggleClass("layerOn");
});

$('.gNavi .hasSub .plus').click(function(){
	$(this).parent('.hasSub').toggleClass("active");
	$(this).next('.navSub').stop().slideToggle(200);
});