<html>

<head>
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>
</head>

</html>
<?php
//session started
// session_start();


// include_once 'header.php';



?>

<section class="signup-form">
    <h2>Login</h2>

    <form action="/swapproj/logininc" method="POST">
        <br><label for="uid"> Email or Username:</label><br>
        <input type="text" id="uid" name="uid" placeholder="Email/Username...">
        <br><label for="pwd">Password:</label><br>
        <input type="password" id="pwd" name="pwd" placeholder="Password...">
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