<?php


require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/auth/pages.php';

if (isset($_COOKIE['jwt'])) {
    $token = $_COOKIE['jwt'];
    $info = jwtdecrypt();
    $iat  = $info['iat'];
    $exp = $info['exp'];
    // echo "expiry time " . $exp;
    // echo "<br>" . "now time " .  time();

    if (isset($_POST['type']) && $_POST['type'] == 'ajax') {

        if (time() > $exp) {
            // var_dump($_COOKIE);
            // exit;        
            echo "logout";
        }
    }
} else {
    // var_dump($_COOKIE);
    // exit;
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
//             //header("location: https://www.swapamc.com/swapproj/login");
//             session_destroy();
//         }
//     }
//     $_SESSION['LAST_ACTIVE_TIME']=time();
// }
