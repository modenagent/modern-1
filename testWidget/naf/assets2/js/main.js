$(document).ready(function(){

//==================== Localscroll ========================//
$('.navigation li').localScroll();

//==================== Mobilemenu ========================//
$('.navigation').mobileMenu({
	defaultText: 'Navigation',
	className: 'select-menu',
	subMenuDash: '&ndash;'
});

//==================== Flexslider ========================//
$('#main-slider').flexslider({
    animation: "fade",
    slideshowSpeed: 3500,
    controlNav: false,
	directionNav: false
});

$('.flexslider').flexslider({
    animation: "slide",
    controlNav: "thumbnails",
    directionNav: true
});

//==================== Carousel ========================//

$("#owl-example").owlCarousel();

$('.navigation').onePageNav();

//==================== Extras ========================//

$(window).scroll( function() {
    var value = $(this).scrollTop();
    if ( value > 350 )
        $(".header").css("padding", "0px 0px 3px");
    else
        $(".header").css("padding", "15px 0px 15px");
});

 $(".backtotop").click(function(){

    $('html,body').animate({scrollTop:0},700);
    return false;

  });

 
//==================== Prettyphoto ========================//

$("a[class^='prettyPhoto']").prettyPhoto({theme:'pp_default'});

//==================== Twitterfeed ========================//

$('#tweets').tweetable({
	username: 'envato', 
	time: true,
	rotate: true,
	speed: 6000, 
	limit: 5,
	replies: false,
	position: 'append',
	failed: "Sorry, twitter is currently unavailable for this user.",
	html5: true,
	onComplete:function($ul){
	$('time').timeago();
	}
});

}); 
