<?php
    require("user_auth.php");
        ?>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
setInterval(function(){
    check_user();
},2000);
function check_user(){
    jQuery.ajax({
        url:'https://www.swapamc.com/swapproj/check',
        type:'post',
        data:'type=ajax',
        success:function(result){
    
            let text = result.includes("logout");
            if(text==true){
                window.location.href="https://www.swapamc.com/swapproj/logout";
            }
        }

    });
}
</script>
<html>
    <body>

    </body>
</html>