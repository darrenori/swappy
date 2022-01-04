<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/auth/pages.php';
require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/phpmailer/verification2fa.php';

$jwtarray = jwtdecrypt();
if (isset($jwtarray) && $jwtarray == true) {



    ## use $jwtinformation["key"] to retrieve the values 
    ## keys and values can be viewed on campus.php page
    $jwtarrayinformation = $jwtarray['array'];
    foreach ($jwtarrayinformation as $key => $val)
        if (gettype($val) != "array") {
            echo $key . " " . $val . "<br/>";
        }
    
    
   


    if (!isset($jwtarrayinformation['loginstate'])) {
        header("location: https://www.swapamc.com/swapproj/login");
        exit();
    } elseif ($jwtarrayinformation['loginstate'] === "B") {
        header("location: https://www.swapamc.com/swapproj/googleauthentication");
        exit();
    } elseif ($jwtarrayinformation['loginstate'] === "OK"  and isset($jwtarrayinformation['username'])) {
        header("location: https://www.swapamc.com/swapproj/campus");
        exit();
    } elseif (!$jwtarrayinformation['loginstate'] === "A") {
        header("location: https://www.swapamc.com/swapproj/logout");
        exit();
    }
    
    
    if(isset($_SESSION['variable']) && $_SESSION['variable'] === "hi"){
        $vc = new VerificationCode($jwtarrayinformation["useremail"]);
        $vc->sendMail(); // MAIL SENT SUCCESSFULLY
        session_destroy();
    }
   

    echo "Current OTP pass is unavailable cos JWT LAGGGGGG T^T check your email bruddah"; //. $jwtarrayinformation["emailotp"]
    echo "you are" . $jwtarrayinformation["username"];
    echo "<br>";
    date_default_timezone_set('Asia/Singapore');
    echo $date = date('m/d/Y h:i:s a', time());
?>



    <script type="text/javascript">
        function preventBack() {
            window.history.forward();
        }
        setTimeout("preventBack()", 0);
        window.onunload = function() {
            null
        };
    </script>
    <section class="signup-form">

        <h2>Email OTP</h2>

        <form action="/swapproj/emailverificationinc" method="POST">
            <br><label for="emailotp"> Input your verification code</label><br>
            <input type="text" id="emailotp" name="emailotp" placeholder="Verification code...">
            <button type="submit" name="submit">Submit</button>
            <button type="submit" name="resend">Resend Email</button>

        </form>

    </section>


<?php
    if (isset($_GET["error"])) {
        $error=htmlentities($_GET["error"]);

        if ($error == "badotp") {
            echo "<p>Badotp</p>";
        }
        elseif ($error == "expiredotp") {
            echo "<p>Otp has Expired. Please click on resend. </p>";
        }
    }
    // display resend otp
    if (isset($_GET["resend"])) {
        $getresend=htmlspecialchars($_GET["resend"]);

        if ($getresend == "resend") {
            echo "resending otp";
        }
    }
} else {

    header("location: https://www.swapamc.com/swapproj/logout");
    exit();
}

?>