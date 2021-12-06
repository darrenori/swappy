<?php

session_start();

//checks if user has begun login process and that session is stable. 

if (!isset($_SESSION['loginstate'])) {
    header("location: ../swapproj/login");
    exit();
} elseif ($_SESSION['loginstate'] === "A") {
    header("location: ../swapproj/emailverification");
    exit();
} elseif ($_SESSION['loginstate'] === "OK") {
    header("location: ../swapproj/campus");
    exit();
} elseif ($_SESSION['loginstate'] === "Z") {
    ////Here is the code for right after sign up
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
<!-- here's code to prevent back button -->
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
        <h2>OTP for user <?php $username ?></h2>

        <form action="/swapproj/googleauthenticationinc" method="post">
            <center>
                <img src="<?= $link; ?>"><br>
                <label for="googleautotp">Enter Code Here:</label><br>
                <input type="text" id="googleauthotp" name="googleauthotp" placeholder="Enter Code">
                <br><br>
                <input type="submit" value="submit" name="submit">
            </center>
        </form>



    </section>
<?php



    exit();
} elseif (!$_SESSION['loginstate'] === "B") {
    header("location: ../swapproj/logout");
    exit();
}



echo "<h3> PHP List All Session Variables</h3>";
// foreach ($_SESSION as $key => $val)
// echo $key . " " . $val . "<br/>";
require_once 'includes/dbh.inc.php';
require_once 'includes/functions.inc.php';
require 'googleauth/vendor/autoload.php';

$username = $_SESSION['username'];

$uidExists = uidExists($conn, $username, $username);

//GOOGLE AUTH QR CODE GENERATED
$_SESSION['usersecret'] = $uidExists['user_secret'];
$randomsecret = $_SESSION['usersecret'];



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
    <h2>OTP for user <?php $username ?></h2>

    <form action="/swapproj/googleauthenticationinc" method="post">
        <center>
            <label for="googleautotp">Enter Code Here:</label><br>
            <input type="text" id="googleauthotp" name="googleauthotp" placeholder="Enter Code">
            <br><br>
            <input type="submit" value="submit" name="submit">
        </center>
    </form>



</section>