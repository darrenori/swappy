<?php

session_start();


if(isset($_POST['type']) && $_POST['type']=='ajax'){
    if((time()-$_SESSION['LAST_ACTIVE_TIME'])>1000000){
        echo "logout";
    }
}
else{
    if(isset($_SESSION['LAST_ACTIVE_TIME'])){
        if((time()-$_SESSION['LAST_ACTIVE_TIME'])>1000000){
            echo "dead" . "wowww";
            //header("location: ../swapproj/login");
            session_destroy();
        }
    }
    $_SESSION['LAST_ACTIVE_TIME']=time();
}