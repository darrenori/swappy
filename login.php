<html>

<head>
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>
</head>

</html>
<?php

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
    ///////////CAPTCHA////////////
    if (isset($_POST['submit'])) {
        if (!isset($_POST['g-recaptcha-response']) || empty($_POST['g-recaptcha-response'])) {
            echo 'reCAPTHCA verification failed, please try again.';
        } else {
            $secret = '6LceTzMdAAAAAOpz-EsYoCKZGnAXCzF3lv-FsFfF';

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $_POST['g-recaptcha-response']);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);
            $response = json_decode($response);

            if ($response->success) {
                // What happens when the CAPTCHA was entered incorrectly
                echo 'Successful login.';
            } else {
                // Your code here to handle a successful verification
                echo 'reCAPTHCA verification failed, please try again.';
            }
        }
    }

    if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
            echo "<p>Fill in all fields!</p>";
        } else if ($_GET["error"] == "wronglogin") {
            echo "<p>Incorrect login information!</p>";
        }
    }

    ?>

</section>