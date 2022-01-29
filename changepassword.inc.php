<?php

require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/functions.inc.php';
session_start();
session_unset();
session_destroy();
if (isset($_COOKIE['jwt'])) {
    setCookieSameSite('jwt', '',time()-36000);
}


header("location: https://www.swapamc.com/swapproj/forgetpassword");
exit();


?>