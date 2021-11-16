<?php

session_start();
echo "<h3> PHP List All Session Variables</h3>";
foreach ($_SESSION as $key => $val)
echo $key . " " . $val . "<br/>";
require_once 'includes/dbh.inc.php';
require_once 'includes/functions.inc.php';
require 'googleauth/vendor/autoload.php';

$username = $_SESSION['username'];

$uidExists = uidExists($conn, $username, $username);

//GOOGLE AUTH QR CODE GENERATED
$_SESSION['usersecret'] = $uidExists['user_secret'];
$randomsecret = $_SESSION['usersecret'];

//Generates the qr code and puts it in html
$link = \Sonata\GoogleAuthenticator\GoogleQrUrl::generate($uidExists['user_username'], $randomsecret, 'swapamc.com');



?>
<section class="signup-form">
    <h2>OTP</h2>

    <form action="/swapproj/googleauthenticationinc" method="post">
        <center>
            <img src="<?= $link; ?>">
            <br>
            <label for="googleautotp">Enter Code Here:</label><br>
            <input type="text" id="googleauthotp" name="googleauthotp" placeholder="Enter Code">
            <br><br>
            <input type="submit" value="submit" name="submit">
        </center>
    </form>

</section>