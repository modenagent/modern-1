location.href = app_main_url;
// jQuery(document).ready(function() {
//     loadWidget();
// });

// function loadWidget()
// {
//     // var custom_css = "<style>#cma-widget-container {background: url("+base_url+"/../assets/images-2/home/->ReplaceImage<-) no-repeat 0 0;background-attachment: scroll; background-color:black; background-size: auto auto;background-size: cover;background-attachment: fixed;}</style>";
//     var custom_css = "<style>#cma-widget-container {background-attachment: scroll; background-color:black; background-size: auto auto;background-size: cover;background-attachment: fixed;}</style>";

//     $.ajax({
//         url: app_main_url,
//         type: "POST",//type of posting the data
//         // data: {
//         //     user_id: user_id
//         // },
//         xhrFields: { withCredentials: true },
//         crossDomain: true,
//         dataType: "json",
//         success: function (response) {
//         console.log(response);    
//           $('#cma-widget-container').html(custom_css+response.res);
//         },
//         error: function(xhr, ajaxOptions, thrownError){
          
//         },
//     });
// }