$(document).ready(function() {
    $("[rel='tooltip']").tooltip();
    // for grid view abd list view===/
    $('#grid').click(function(event) {
        event.preventDefault();
        $('#items .jplist-list-view').removeClass('list-group-item');
        $('#items .jplist-list-view').addClass('grid-group-item');

    });
    $('#list').click(function(event) {
        event.preventDefault();
        $('#items .jplist-list-view').addClass('list-group-item');

    });
});
// back top
$(document).ready(function() {
    $('button[data-toggle=popover]').popover({
        html: true,
        //trigger: "click", // може да се смени
        content: function() {
            return $('#popover_content_wrapper').html();
        }
    });

    $('#back-top a').on('click', function(e) {
        e.preventDefault();

        var target = this.hash,
            $target = $(target);

        $('html, body').stop().animate({
            'scrollTop': $target.offset().top
        }, 900, 'swing', function() {
            window.location.hash = target;
        });
    });
});
// #back hide
$("#back-top").hide();
// fade in #back-top
$(document).ready(function() {
    $(window).scroll(function() {
        if ($(this).scrollTop() > 100) {
            $('#back-top').fadeIn();
        } else {
            $('#back-top').fadeOut();
        }
    });

    // $(window).scroll(function() {
    //     if ($(this).scrollTop() > 0) {
    //         $('.dbs-footer').removeClass("navbar-fixed-bottom");
    //     } else {
    //         $('.dbs-footer').addClass("navbar-fixed-bottom");
    //     }
    // });
});
// caption
$(document).ready(function() {
    $("[data-toggle='tooltip']").tooltip();
    $('.thumbnail').hover(
        function() {
            $(this).find('.caption').slideDown(250).css("opacity", "0"); //.fadeIn(250)

        },
        function() {
            $(this).find('.caption').slideUp(250).css("opacity", "1"); //.fadeOut(205)

        }
    );
});