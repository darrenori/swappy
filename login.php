<html>
<!-- Hello  -->
<!-- hello ryannnn :D -->
<head>
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>
</head>

</html>
<?php
//session started
session_start();
if (isset($_SESSION['loginstate'])) {
    if ($_SESSION['loginstate'] === "A") {
        header("location: ../swapproj/emailverification");
        exit();
    } elseif ($_SESSION['loginstate'] === "B") {
        header("location: ../swapproj/googleauthentication");
        exit();
    } elseif ($_SESSION['loginstate'] === "OK") {
        header("location: ../swapproj/campus");
        exit();
    }else {
        header("location: ../swapproj/logout");
        exit();
    }
}

// include_once 'header.php';


// print_r(apache_request_headers());
echo "<h3> PHP List All Session Variables</h3>";    
foreach ($_SESSION as $key => $val)
echo $key . " " . $val . "<br/>";


?>

<section class="signup-form">
    <h2>Login</h2>

    <form action="/swapproj/logininc" method="POST">
    <br><label for="uid"> Email or Username:</label><br>
        <input type="text" id="uid" name="uid" placeholder="Email/Username..."  >
        <br><label for="pwd">Password:</label><br>
        <input type="password" id="pwd" name="pwd" placeholder="Password...">
        <br><input type ="checkbox" name="remember" label for="remember-me" > Remember me
        <div class="g-recaptcha" data-sitekey="6LceTzMdAAAAAMmsVPxewTs4O4ujsgATF5_otzYu"></div>
        <button type="submit" name="submit">Login</button>
    </form>

    <?php #are you sure you want to use get..?

    if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
            echo "<p>Fill in all fields!</p>";
        } else if ($_GET["error"] == "wronglogin") {
            echo "<p>Incorrect login information!</p>";
        } else if ($_GET["error"] == "emptycaptcha") {
            echo "<p>reCAPTHCA verification empty, please click the captcha.</p>";
        } else if ($_GET["error"] == "badcaptcha") {
            echo "<p>reCAPTHCA verification failed, please try again.</p>";
        } else if ($_GET["error"] == "goodcaptcha") {
            echo "<p>reCAPTHCA verification failed, please try again.</p>";
        }
    }

    ?>

</section>