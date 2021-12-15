<?php
session_start();
session_unset();
session_destroy();
setcookie('jwt', '', time()-36000, '/' . '; samesite=' . 'Strict', 'www.swapamc.com', true, true);


header("location: ../swapproj/login");
exit();