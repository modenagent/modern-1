(function($) {
    "use strict";
    
    /* COUNTDOWN */
	$("#countdown").countdown({
		date: "12 Nov 2017 00:00:00", // Put your date here
		format: "on"
	});
	
	/* BACKGROUND SLIDER */
    /*$.backstretch([
        './images/background1.jpg',
        './images/background2.jpg',
        './images/background3.jpg'
    ], {duration: 5000, fade: 750});*/
	/*$.backstretch('./images/background1.jpg');*/
    
    /* TOOLTIPS */
    $('.tool-tip').tooltip();
	
	/* NEWSLETTER FORM */
	$('#newsletter-form').ketchup().submit(function() {
		if ($(this).ketchup('isValid')) {
			$('#newsletter-submit').button('loading');
			var action = $(this).attr('action');
			$.ajax({
				url: action,
				type: 'POST',
				data: {
					newsletter_email: $('#newsletter-email').val()
				},
				success: function(data) {
					$('#newsletter-submit').button('reset');
                    $('#newsletter-error').fadeOut();
                    $('#newsletter-success').fadeOut();
                    $('#newsletter-success').html(data).fadeIn();
                },
                error: function() {
					$('#newsletter-submit').button('reset');
                    $('#newsletter-error').fadeOut();
                    $('#newsletter-success').fadeOut();
                    $('#newsletter-error').html('Sorry, an error occurred.').fadeIn();
                }
			});
		}
		return false;
	});
    
})(jQuery);