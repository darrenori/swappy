<!-- This page is to ensure that user is authorized to be Logged In only -->

<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/auth/pages.php';
regenerateJWT();
$jwtarray = jwtdecrypt();
// echo gettype($jwtarray);
// echo $jwtarray ? 'true': 'false';


###ZEPH###
//For LOGGING purposes
$filename=basename(__FILE__, '.php');// filename variable is now set as allstores for example
$ipadd=$_SERVER['REMOTE_ADDR']; //not sure if this works from another machine ://

if (isset($jwtarray) && $jwtarray == true) {

    ## use $jwtinformation["key"] to retrieve the values 
    ## keys and values can be viewed on campus.php page
    $jwtarrayinformation = $jwtarray['array'];
    // var_dump($jwtarrayinformation);



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



//strip the url because str_contains cannot take specail characters.
$currenturlstripped = preg_replace('/[^a-zA-Z0-9]+/', '', $_SERVER['REQUEST_URI']);


//array of not allowed urls
$notallowedauthuser = [];
$role = $jwtarrayinformation['role'];
if ((int)$role < 0 || (int)$role > 6) {
    //if user role does not exist... logout   
    header("location: https://www.swapamc.com/swapproj/logout");
    exit;
}

///changes the allowed urls depending on the role number
if ($role === (int)0) {
    //if user is authorised user.. 
    $notallowedauthuser = ['allstores', 'employeemanager',/*employee tasks page */];
} else if ($role === (int)1) {
    //if user is employee.. currently unable to access tasks from homepage
    $notallowedauthuser = ['allstores', 'employeemanager'];
} else if ($role === (int)2) {
    //if user is Employeemanager.. currently unable to access tasks from homepage
    $notallowedauthuser = ['allstores', ];
} else if ($role === (int)3) {
    //if user is Store Front Manager.. currently unable to access tasks from homepage
    $notallowedauthuser = ['employeemanager'];
} else if ($role === (int)4) {
    //if user is Booking Manager.. currently unable to access tasks from homepage
    $notallowedauthuser = [ 'employeemanager'];
} else if ($role === (int)5) {
    //if user is Overall Manager.. I CAN DO ANYTHING TOO FOR NOW
} else if ($role === (int)6) {
    //if user is server admin I CAN DO ANYTHING
}

//helps cater for lower versions of php that do not contain the function
if (!function_exists('str_contains')) {
    function str_contains(string $haystack, string $needle): bool{
        return '' === $needle || false !== strpos($haystack, $needle);
    }
}
//if url contains any text from the unallowed urls, the user is considered unauthorized
foreach ($notallowedauthuser as $key => $val) {
    $unauthorised = str_contains($currenturlstripped, $val);
    if ($unauthorised !== false) {
        // echo "u are unauthorised!";
        header("location: https://www.swapamc.com/swapproj/campus?error=unauthorized");
        exit;
    } else {
        echo "you are authorised:)";
    }
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
<?php

// I reopened it so it wouldn't create errors (i think)