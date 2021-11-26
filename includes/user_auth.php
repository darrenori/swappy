<?php
session_start();
///ZEPH NOT SURE WHAT THIS CODE DOES  SEEMS TO LOOP AROUND
if(isset($_POST['type']) && $_POST['type']=='ajax'){
    if((time()-$_SESSION['LAST_ACTIVE_TIME'])>4){
        echo "logout";
    }
}
else{
    if(isset($_SESSION['LAST_ACTIVE_TIME'])){
        if((time()-$_SESSION['LAST_ACTIVE_TIME'])>10){

            //following code seems to be causing routing error
            // header("location: ../swapproj/logout");
            // exit();
                }
    }
    $_SESSION['LAST_ACTIVE_TIME']=time();
}
