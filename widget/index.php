<!DOCTYPE html>
<html>
<head>
    <title>Widget</title>
        <script type="text/javascript">
        var error_page = "https://<?php echo $_SERVER['HTTP_HOST'];?>/error.php";
        
        if (window.parent) {
            var error_page_1 = error_page+"?error_no=1";
            try{
                if (localStorage === null) {
                    
                   window.location.href = error_page_1; 
                   // return false;
                }
                else {
                    console.log('All okay');

                }
                
            }
            catch(err) {
              window.location.href = error_page_1;
              
            }
        }
        if ( window.location !== window.parent.location ) {
            var error_page_2 = error_page+"?error_no=2&url=<?php echo'https://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']?>";
            <?php if(strpos($_SERVER['HTTP_USER_AGENT'], 'Safari') && !strpos($_SERVER['HTTP_USER_AGENT'], 'Chrome')) { ?>
                    window.location.href = error_page_2;
                <?php } ?>
        }
    </script>
</head>
<body>
    <script type="text/javascript">
        var urlParams;

        (window.onpopstate = function () {
            var match,
                pl     = /\+/g,  // Regex for replacing addition symbol with a space
                search = /([^&=]+)=?([^&]*)/g,
                decode = function (s) { return decodeURIComponent(s.replace(pl, " ")); },
                query  = window.location.search.substring(1);
                console.log(query);

                var widget_url = "https://<?php echo $_SERVER['HTTP_HOST'];?>/widget.php?"+query;
                window.location.href = (widget_url);
           
        })();
    </script>
</body>
</html>
