
<?php
###ZEPH ###
//see arnd line77, if user is not logged in, they get sent to logout page which directs them to homepage,
//if we want to allow public user access, this will have to change. 



function checkAuthorization(string $url, array $notallowedauthuser, array $allowedauthuser)
{
    $unauthorised=false;
    $authorised=false;

    //if url contains any text from the unallowed urls, the user is considered unauthorized
    foreach ($notallowedauthuser as $key => $val) {
        // the unauthorised var will return false if the user is accessed unauthorised files 
        $unauthorised = str_contains($url, $val);
        if ($unauthorised === true) {
            break;
        }
    }
    foreach ($allowedauthuser as $key => $value) {
        // the unauthorised var will return true if the user is accessing whitelisted exemption files 
        $authorised = str_contains($url, $value);
        if ($authorised === true) {
            break;
        }
    }
    if ($unauthorised && !$authorised) {
        return "unauthorized";
    } else {
        //if url does not exist in both the unauthorised and the authorised array, allow
        //if url exists in the unauthorised array but exists in the authorised array, allow
        //if url exists in both the unauthorised and the authorised array (which it wouldn't at the moment), allow
        return "authorized";
    }
}




require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/auth/pages.php';
regenerateJWT();
$jwtarray = jwtdecrypt();
// echo gettype($jwtarray);
// echo $jwtarray ? 'true': 'false';


###ZEPH###
//For LOGGING purposes
$filename = basename(__FILE__, '.php'); // filename variable is now set as allstores for example
$ipadd = $_SERVER['REMOTE_ADDR']; //not sure if this works from another machine ://

if (isset($jwtarray) && $jwtarray == true) {

    ## use $jwtinformation["key"] to retrieve the values 
    ## keys and values can be viewed on campus.php page
    $jwtarrayinformation = $jwtarray['array'];
    // var_dump($jwtarrayinformation);


//strip the url because str_contains cannot take specail characters.
$currenturlstripped = preg_replace('/[^a-zA-Z0-9]+/', '', $_SERVER['REQUEST_URI']);


    if (!isset($jwtarrayinformation['loginstate'])) {
        header("location: https://www.swapamc.com/swapproj/login");
        exit();
    } elseif ($jwtarrayinformation['loginstate'] === "A") {
        header("location: https://www.swapamc.com/swapproj/emailverification");
        exit();
    } elseif ($jwtarrayinformation['loginstate'] === "B") {
        header("location: https://www.swapamc.com/swapproj/googleauthentication");
        exit();
    } elseif ($jwtarrayinformation['loginstate'] === "Z") {
        header("location: https://www.swapamc.com/swapproj/signup");
        exit();
    } elseif (!$jwtarrayinformation['loginstate'] === "OK") {
        header("location: https://www.swapamc.com/swapproj/logout");
        exit();
    }
} else {

    header("location: https://www.swapamc.com/swapproj/logout");
    exit();
}



//array of not allowed urls
$notallowedauthuser = [];
//array of allowed urls
$allowedauthuser = [];
$role = $jwtarrayinformation['role'];
// var_dump($role);exit;
if ((int)$role < 0 || (int)$role > 6) {
    //if user role does not exist... (public user)
    $role=7;
}

///changes the allowed urls depending on the role number
if ($role == (int)0) {
    //if user is authorised user.. 
    $notallowedauthuser = ['employeemanager', 'productmanager', 'addnotification', 'storemanage', 'logs','storeoverview'];
} else if ($role == (int)1) {
    //if user is employee.. currently unable to access tasks from homepage
    $notallowedauthuser = ['employeemanager', 'productmanager', 'addnotification', 'storemanage', 'logs','storeoverview'];
} else if ($role == (int)2) {
    //if user is Employeemanager.. currently unable to access tasks from homepage
    $notallowedauthuser = ['viewtask', 'updatestatus', 'storemanage', 'productmanage', 'logs','storeoverview'];
    $allowedauthuser = ['taskmanager'];
} else if ($role == (int)3) {
    //if user is Store Front Manager.. currently unable to access tasks from homepage
    $notallowedauthuser = ['employeemanager', 'viewtask', 'updatestatus', 'employeemanage', 'logs','storeoverview'];
    $allowedauthuser = ['taskmanager'];
} else if ($role == (int)4) {
    //if user is Booking Manager.. currently unable to access tasks from homepage
    $notallowedauthuser = ['employeemanager', 'viewtask', 'updatestatus', 'logs','storeoverview'];
    $allowedauthuser = ['taskmanager'];
} else if ($role == (int)5) {
    //if user is Overall Manager.. I CAN DO ANYTHING TOO FOR NOW
} else if ($role == (int)6) {
    //if user is server admin I CAN DO ANYTHING
}else {
    // searching a string for an empty string will always return true, so any user without roles from 0-6 will be considered unauthorized, or public users
    $notallowedauthuser=[''];
    //public users do have access to the products and home page
    $allowedauthuser= ['allstores','allproducts'];
}

//helps cater for lower versions of php that do not contain the function
if (!function_exists('str_contains')) {
    function str_contains(string $haystack, string $needle): bool
    {
        return '' === $needle || false !== strpos($haystack, $needle);
    }
}
if (checkAuthorization($currenturlstripped, $notallowedauthuser, $allowedauthuser) === "unauthorized") {
    // echo "u are unauthorised!";
    header("location: https://www.swapamc.com/swapproj/campus?error=unauthorized");
    exit;
} else {
    // allow a user to advance forward if they are not unauthorised
}


?>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    setInterval(function() {
        check_user();
    }, 10000);

    function check_user() {
        jQuery.ajax({
            url: 'https://www.swapamc.com/swapproj/check',
            type: 'post',
            data: 'type=ajax',
            success: function(result) {
                //console.log(result);
                let text = result.includes("logout");
                if (text == true) {
                    window.location.href = "https://www.swapamc.com/swapproj/logout";
                }
            }

        });
    }
</script>
<html>
    <head><title>TPAMC</title></head>
</html>
<?php

// I reopened it so it wouldn't create errors (i think)