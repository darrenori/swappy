<?php
    require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/auth/pages.php';
    require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/functions.inc.php';
    
    
    
    



    print_r(apache_request_headers());
    // $array['role'] = 'admin';
    // $array['name'] = 'darren'; 


    //set
    // $objpages = new Pages();
    // $encrypted = $objpages->auth($array);
    // $encrypted = $encrypted['token'];
    // setcookie("jwt",$encrypted);
    


    //read

    // $cookie = $_COOKIE['jwt'];
    // $decrypted = $objpages->read($cookie);
    // print_r($decrypted);

?>