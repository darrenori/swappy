<!-- This page is to ensure that user is authorized to be Logged In only -->


<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/auth/pages.php';

$jwtarray = jwtdecrypt();
// echo gettype($jwtarray);
// echo $jwtarray ? 'true': 'false';

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





?>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    setInterval(function() {
        check_user();
    }, 2000);

    function check_user() {
        jQuery.ajax({
            url: 'https://www.swapamc.com/swapproj/check',
            type: 'post',
            data: 'type=ajax',
            success: function(result) {
                console.log(result);
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