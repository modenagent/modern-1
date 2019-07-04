$(function() {
  "use strict";
  var window_width = $(window).width();
  /*Preloader*/
  $(window).load(function() {
    setTimeout(function() {
      $('body').addClass('loaded');      
    }, 200);
  });
  
   $('.backtotop').on('click', function(e) {
            e.preventDefault();

            var target = this.hash,
                $target = $(target);

            $('html, body').stop().animate({
                'scrollTop': $target.offset().top
            }, 900, 'swing', function() {
                window.location.hash = target;
            });
        });
	
	$(window).scroll( function() {
		var value = $(this).scrollTop();
		if ( value > 350 )
			$(".navbar-fixed-top").css("padding", "0 0 3px").addClass("scrolledup");
		else
			$(".navbar-fixed-top").css("padding", "15px 0").removeClass("scrolledup");
		});
		
});