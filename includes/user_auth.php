<?php

session_start();
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/auth/pages.php';

if(isset($_COOKIE['jwt'])){
    $token = $_COOKIE['jwt'];
    $info = jwtdecrypt($token);
    $iat  = $info['iat'];
    $exp = $info['exp'];
    echo "expiry time ".$exp;
    echo "<br>" . "now time " .  time();

    if(isset($_POST['type']) && $_POST['type']=='ajax'){
    
        if(time()>$exp){
            echo "logout";
        }
    }



} else {
    echo "logout";
}







// if(isset($_POST['type']) && $_POST['type']=='ajax'){
//     if((time()-$_SESSION['LAST_ACTIVE_TIME'])>40000000000){
//         echo "logout";
//     }
// }


// else{
//     if(isset($_SESSION['LAST_ACTIVE_TIME'])){
//         if((time()-$_SESSION['LAST_ACTIVE_TIME'])>1000000){
//             echo "dead" . "wowww";
//             //header("location: ../swapproj/login");
//             session_destroy();
//         }
//     }
//     $_SESSION['LAST_ACTIVE_TIME']=time();
// }













