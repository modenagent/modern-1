$(document).ready(function() {

    $('.trees-slick-wrapper').slick({
      dots: true,
      speed: 300,
      slidesToShow: 1,
      arrows: false
    });


    $('.testimonial-slick-cont').slick({
      dots: true,
      speed: 800,
      autoplay: true,
      autoplaySpeed: 5000,
      slidesToShow: 1,
      arrows: false,
      fade: true
    });


    $('.tcon').click(function(){
      $(this).toggleClass('tcon-transform');
      $('.menu-wrapper').toggleClass('menu-show');
    });



    $('#login-toggle').click(function(){
        $('#loginForm').toggleClass('show');
    });    

    /*$('#loginForm').click(function(e){
        e.preventDefault();
        return false;     
    });*/

    $('.signin-overlay').click(function() {
            $('#loginForm').removeClass('show');   
    });

    

    new WOW().init();


    $('.menu-wrapper ul li a').click(function(e){
        e.preventDefault();
    });

    /*var button = $('.login');
    var box = $('#loginBox');
    var form = $('#loginForm');
    button.removeAttr('href');
    button.mouseup(function(login) {
        box.toggle();
        button.toggleClass('active');
    });
    form.mouseup(function() { 
        return false;
    });
    $(this).mouseup(function(login) {
        if(!($(login.target).parent('#loginButton').length > 0)) {
            button.removeClass('active');
            box.hide();
        }
    });*/


});

$(window).scroll(function(){

    var scrollPos = $(document).scrollTop(); 
    //console.log(scrollPos);

    if (scrollPos > 200) {
      $('.header-upper').addClass('hide-header');
      //$('.header-lower').addClass('adjust');
      
    } else {
      $('.header-upper').removeClass('hide-header');
      //$('.header-lower').removeClass('adjust');


    }

});


