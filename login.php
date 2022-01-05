
<html>

<head>
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>
</head>

</html>
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/auth/pages.php';

//session started
$jwtarray = jwtdecrypt();

if (isset($jwtarray) && $jwtarray == true) {
    ## use $jwtinformation["key"] to retrieve the values 
    ## keys and values can be viewed on campus.php page
    $jwtarrayinformation = $jwtarray['array'];
    if (isset($jwtarray) && $jwtarray == true) {

        ## use $jwtinformation["key"] to retrieve the values 
        ## keys and values can be viewed on campus.php page
        $jwtarrayinformation = $jwtarray['array'];

        if (isset($jwtarrayinformation['loginstate'])) {
            if ($jwtarrayinformation['loginstate'] === "A") {
                header("location: https://www.swapamc.com/swapproj/emailverification");
                exit();
            } elseif ($jwtarrayinformation['loginstate'] === "B" || $jwtarrayinformation['loginstate'] === "Z") {
                header("location: https://www.swapamc.com/swapproj/googleauthentication");
                exit();
            } elseif ($jwtarrayinformation['loginstate'] === "OK" and isset($jwtarrayinformation['username'])) {
                header("location: https://www.swapamc.com/swapproj/campus");
                exit();
            } else {
                header("location: https://www.swapamc.com/swapproj/logout");
                exit();
            }
        }
    }
} // include_once 'header.php';
// print_r(apache_request_headers());



?>

<section class="signup-form">
    <h2>Login</h2>

    <form action="/swapproj/logininc" method="POST">
        <br><label for="uid"> Email or Username:</label><br>
        <input type="text" id="uid" name="uid" placeholder="Email/Username...">
        <br><label for="pwd">Password:</label><br>
        <input type="password" id="pwd" name="pwd" placeholder="Password...">
        <br><input type="checkbox" name="remember" label for="remember-me"> Remember me
        <div ><a href= "https://www.swapamc.com/swapproj/forgetpassword">Forget Password</a></div>
        <div class="g-recaptcha" data-sitekey="6LceTzMdAAAAAMmsVPxewTs4O4ujsgATF5_otzYu"></div>
        <button type="submit" name="submit">Login</button>
    </form>

    <?php #are you sure you want to use get..?

    if (isset($_GET["error"])) {
        $error=htmlentities($_GET["error"]);
        if ($error == "emptyinput") {
            echo "<p>Fill in all fields!</p>";
        } else if ($error == "wronglogin") {
            echo "<p>Incorrect login information!</p>";
        } else if ($error == "emptycaptcha") {
            echo "<p>reCAPTHCA verification empty, please click the captcha.</p>";
        } else if ($error == "badcaptcha") {
            echo "<p>reCAPTHCA verification failed, please try again.</p>";
        } else if ($error == "goodcaptcha") {
            echo "<p>reCAPTHCA verification failed, please try again.</p>";
        }
    }




    ?>

</section>