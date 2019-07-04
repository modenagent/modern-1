var is_inspect = false;
// Unique ID for the className.
var MOUSE_VISITED_CLASSNAME = 'ui-draggable';
// Previous dom, that we want to track, so we can remove the previous styling.
var prevDOM = null;

// document.addEventListener('mousemove', function (e) {
//     console.log('hi');
//     var srcElement = e.srcElement;



//         if (prevDOM != null) {
//             prevDOM.classList.remove(MOUSE_VISITED_CLASSNAME);
//         }

//         // Add a visited class name to the element. So we can style it.
//         srcElement.classList.add(MOUSE_VISITED_CLASSNAME);

//         // The current element is now the previous. So we can remove the class
//         // during the next iteration.
//         prevDOM = srcElement;
//         // }    
    

// }, false);

var isMouseDown=null;
var isMouseUP=null;
var isMouseMove=null;
var elementSelected=null;

$(document).ready(function() {

    $(".flyer-body").append("<div class='editor-overlay'><i class='fa fa-spin fa-spinner fa-2x'></i></div>")
    // summornote customize
    $('.summernote').rishig({
        // height: 600,
        tabsize: 2,
        toolbar: [
            //['style', ['style']], // no style button
            ['style', ['bold', 'italic', 'underline']],
            ["fontname",["fontname"]],
            ['fontsize', ['fontsize']],
            ['color', ['color']],
            ['para', [ 'paragraph']],
            //['height', ['height']],
            ['insert', ['picture', 'link']], // no insert buttons
            //['table', ['table']], // no table button
            //['help', ['help']] //no help button
          ]
    });
 
  
    $('.flyer-body').on('mouseover',function(e){
        var srcElement = e.target;
        // console.log("sadsad");
        if (prevDOM != null) {
            // prevDOM.classList.remove(MOUSE_VISITED_CLASSNAME);
            $(prevDOM).removeClass(MOUSE_VISITED_CLASSNAME);
        }

        if(srcElement!=prevDOM){
            $(srcElement).addClass(MOUSE_VISITED_CLASSNAME);            
             $(prevDOM).draggable();
             $(prevDOM).draggable('disable');
        }
        
        $(srcElement).draggable();
         $(prevDOM).draggable('enable');

        prevDOM = srcElement;
    });

    $(document).on('mousedown','.flyer-body',function(e){
        var srcElement = e.target;
        console.log("mousedown");
        
        $(srcElement).draggable();
        $(srcElement).draggable('enable');

         prevDOM = srcElement;
    });
    
    $(document).on('mouseup','.flyer-body',function(e){
        var srcElement = e.target;
        console.log("mouseup");
        $(srcElement).draggable();
         $(srcElement).draggable('destroy');

         $(srcElement).draggable();
        $(srcElement).draggable('disable');
        
    });
    
    $(document).on('mousemove','.flyer-body',function(e){
        var srcElement = e.target;
        console.log("mouseup");
        $(srcElement).draggable();
         $(srcElement).draggable('destroy');

         $(srcElement).draggable();
        $(srcElement).draggable('disable');
        
    });
    

    $(document).on('click', '.flyer-body', function(e){

    })
   

    // $(document).keypress(function( event ) {
    //     console.log('Enter Pressed ' + event.which);
    //     if ( event.which == 13 ) {
    //        $('.flyer-body').find('.ui-draggable').removeClass('ui-draggable');
    //     }
    // });


    // color box select   
    // $(".color-list li a").on('click', function() {
    //     $(".color-box-list .color-box-lg").text($(this).text());
    //     $(".color-box-list .color-box-lg").val($(this).text());
    // });
    
    //   $(".flyer-body > div").mouseup(function(){
    //     $(this).css({
    //         'outline', '1px solid #ccc',
    //          'outline-offset', '5px'
    //     });
    // });
    // $(".flyer-body > div").mousedown(function(){
    //   $(this).css('outline', 'none');
    // });

    // $('#color_select li a').on('click', function() {
    //     $('#selected_color').attr('class', 'color-box color-box-lg bg-' + $(this).text());
    //     $('#selected_color_text').html($(this).text());
    //     $('#theme_' + $(this).text()).show();
    //     var filterval = $(this).text();
    //     $(".intro-themes").each(function(index) {
    //         var id = $(this).attr('id');
    //         $(this).toggle(id.indexOf(filterval) !== -1);
    //     });
    // });

    $('#picture').click(function() {
        $('[data-event="showImageDialog"]').trigger("click");
    });

$('#logo').click(function() {
        $('[data-event="showlogodialog"]').trigger("click");
    });


    // // color code change
    // $(document).on('click','.dochagecolor', function(){      
    //     var ele = this;        
    //     $('.note-editable h1').css({"color": $(ele).find('.h1color').css('background-color')});
    //     $('.note-editable h2').css("color", $(ele).find('.h2color').css('background-color'));
    //     $('.note-editable p').css("color", $(ele).find('.pcolor').css('background-color'));
    //     $('.note-editable ul li a').css("color", $(ele).find('.ulliacolor').css('background-color'));
    //     $('.note-editable .flyer-body').css("background-color", $(ele).find('.flyerbodycolor').css('background-color'));
    // });
// document ends here 
});
