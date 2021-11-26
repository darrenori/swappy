<?php
session_start();

if(isset($_POST['type']) && $_POST['type']=='ajax'){
    if((time()-$_SESSION['LAST_ACTIVE_TIME'])>4){
        echo "logout";
    }
}
else{
    if(isset($_SESSION['LAST_ACTIVE_TIME'])){
        if((time()-$_SESSION['LAST_ACTIVE_TIME'])>10){
            header("location: ../swapproj/login");
            die();
        }
    }
    $_SESSION['LAST_ACTIVE_TIME']=time();
}




?>