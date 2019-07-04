// scroll bind
$(window).bind('scroll', function() {
   var navHeight = 30; // custom nav height
   ($(window).scrollTop() > navHeight) ? $('#sliding-header').addClass('navbar-fixed-top ') : $('#sliding-header').removeClass('navbar-fixed-top');
});

$(document).ready(function(){ 

    // reset
    // $("#modal-id .close").click(function(){        
    //     $('#login-form').trigger("reset");         
    // });
    // forgot html
    $("#forgot_show").click(function(){        
        $(".omb_login").slideToggle();
        $(".omb_signup").hide();
        $(".omb_forget").slideToggle();
        // $("#title-signup").html("Forgot Password?");
          
    });
    // signup html
    $("#signup_show").click(function() {
        $(".omb_login").slideToggle();
        $(".omb_signup").slideToggle();
        $(".omb_forget").hide();
        // $("#title-signup").html("Create New Account");
    });
    // login html
    $("#login_show").click(function(){

        $(".omb_login").slideToggle();
        $(".omb_signup").slideToggle();
        $(".omb_forget").hide(); 

        // $("#title-signup").html("Login");    
    });
    // default login show
    $("#default_login,#start_project, #start_project2").click(function(){
        $(".omb_login").show();
        $(".omb_signup").hide();
        $(".omb_forget").hide(); 
        // $("#title-signup").html("Login");
        // $('#login-form').trigger("reset");
    
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

// back yop hide
$("#back-top").hide();
// fade in #back-top
});

$(document).ready(function() {
    $(window).scroll(function() {
        if ($(this).scrollTop() > 100) {
            $('#back-top').fadeIn();
        } else {
            $('#back-top').fadeOut();
        }
    });
});
// caption
$( document ).ready(function() {
    $("[data-toggle='tooltip']").tooltip();
    $('.thumbnail').hover(
        function(){
            $(this).find('.caption').slideDown(250); //.fadeIn(250)
        },
        function(){
            $(this).find('.caption').slideUp(250); //.fadeOut(205)
        }
    ); 
});
// 


    $(function() {

        var $window = $(window)
        var $body = $(document.body)

        var navHeight = $('.navbar').outerHeight(true) + 10

        $body.scrollspy({
            target: '.bs-sidebar',
            offset: navHeight
        })

        $window.on('load', function() {
            $body.scrollspy('refresh')
        })

        $('.bs-docs-container [href=#]').click(function(e) {
            e.preventDefault()
        })
        setTimeout(function() {
            var $sideBar = $('.bs-sidebar')

            $sideBar.affix({
                offset: {
                    top: function() {
                        var offsetTop = $sideBar.offset().top
                        var sideBarMargin = parseInt($sideBar.children(0).css('margin-top'), 10)
                        var navOuterHeight = $('.bs-docs-nav').height()

                        return (this.top = offsetTop - navOuterHeight - sideBarMargin)
                    },
                    bottom: function() {
                        return (this.bottom = $('.bs-footer').outerHeight(true))
                    }
                }
            })
        }, 100)

        setTimeout(function() {
            $('.bs-top').affix()
        }, 100)

        // tooltip demo
        $('.tooltip-demo').tooltip({
            selector: "[data-toggle=tooltip]",
            container: "body"
        })

        $('.tooltip-test').tooltip()
        $('.popover-test').popover()

        $('.bs-docs-navbar').tooltip({
            selector: "a[data-toggle=tooltip]",
            container: ".bs-docs-navbar .nav"
        })

        // popover demo
        $("[data-toggle=popover]")
            .popover()

        // button state demo
        $('#fat-btn')
            .click(function() {
                var btn = $(this)
                btn.button('loading')
                setTimeout(function() {
                    btn.button('reset')
                }, 3000)
            })

        // carousel demo
        $('#carousel1').carousel()
        $('#carousel2').carousel()
    });

$(function() {
  $('a.nav-item[href*=#]:not([href=#])').click(function() {
    if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') && location.hostname == this.hostname) {
      var target = $(this.hash);
      target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
      if (target.length) {
        $('html,body').animate({
          scrollTop: target.offset().top
        }, 1000);
        return false;
      }
    }
  });
});