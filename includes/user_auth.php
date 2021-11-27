<?php

session_start();


if(isset($_POST['type']) && $_POST['type']=='ajax'){
    if((time()-$_SESSION['LAST_ACTIVE_TIME'])>10){
        echo "logout";
    }
}
else{
    if(isset($_SESSION['LAST_ACTIVE_TIME'])){
        if((time()-$_SESSION['LAST_ACTIVE_TIME'])>30){
            echo "dead" . "wowww";
            //header("location: ../swapproj/login");
            session_destroy();
        }
    }
    $_SESSION['LAST_ACTIVE_TIME']=time();
}