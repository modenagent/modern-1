location.href = app_main_url;
// jQuery(document).ready(function() {
//     loadWidget();
// });

// function loadWidget()
// {
//     // var custom_css = "<style>#cma-widget-container {background: url("+base_url+"/../assets/images-2/home/->ReplaceImage<-) no-repeat 0 0;background-attachment: scroll; background-color:black; background-size: auto auto;background-size: cover;background-attachment: fixed;}</style>";
//     var custom_css = "<style>#cma-widget-container {background-attachment: scroll; background-color:black; background-size: auto auto;background-size: cover;background-attachment: fixed; background-image: url('https://mcusercontent.com/b10d88eb10799345e0303a43d/images/7218d6f3-e7b7-4051-a604-9f43ceaaf4fc.jpg'); height:820px;}</style>";

//     $.ajax({
//         url: base_url+'/../getWidgetData',
//         type: "POST",//type of posting the data
//         data: {
//             user_id: user_id
//         },
//         dataType: "json",
//         success: function (response) {
//         console.log(response);    
//           $('#cma-widget-container').html(custom_css+response.res);
//         },
//         error: function(xhr, ajaxOptions, thrownError){
          
//         },
//     });
// }