<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/auth/pages.php';

$jwtarray = jwtdecrypt();
if (isset($jwtarray) && $jwtarray == true) {

    ## use $jwtinformation["key"] to retrieve the values 
    ## keys and values can be viewed on campus.php page
    $jwtarrayinformation = $jwtarray['array'];


    //checks if user has begun login process and that session is stable. 

    if (!isset($jwtarrayinformation['loginstate'])) {
        header("location: https://www.swapamc.com/swapproj/login");
        exit();
    } elseif ($jwtarrayinformation['loginstate'] === "A") {
        header("location: https://www.swapamc.com/swapproj/emailverification");
        exit();
    } elseif ($jwtarrayinformation['loginstate'] === "OK" and isset($jwtarrayinformation['username'])) {
        header("location: https://www.swapamc.com/swapproj/campus");
        exit();
    } elseif ($jwtarrayinformation['loginstate'] === "Z") {
        ////Here is the code for right after sign up
        require_once 'includes/dbh.inc.php';
        require_once 'includes/functions.inc.php';
        require 'googleauth/vendor/autoload.php';

        $username = $jwtarrayinformation['username'];

        $uidExists = uidExists($conn, $username, $username);

        //GOOGLE AUTH QR CODE GENERATED
        $jwtarrayinformation['usersecret'] = $uidExists['user_secret'];
        $randomsecret = $jwtarrayinformation['usersecret'];
        jwtupdate($jwtarrayinformation);

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
    } elseif ($jwtarrayinformation['loginstate'] !== "B") {
        header("location: https://www.swapamc.com/swapproj/logout");
        exit();
    }

    /////THIS is the code if user accesses page through the login page


    echo "<h3> PHP List All JWT Session Variables</h3>";
    foreach ($jwtarrayinformation as $key => $val)
    echo $key . " " . $val . "<br/>";
    require_once 'includes/dbh.inc.php';
    require_once 'includes/functions.inc.php';
    require 'googleauth/vendor/autoload.php';

    //All is required for login is the username for user to identify code from google auth code.
    $username = $jwtarrayinformation['username'];

    $uidExists = uidExists($conn, $username, $username);

    //GOOGLE AUTH QR CODE GENERATED
    $jwtarrayinformation['usersecret'] = $uidExists['user_secret'];
    $randomsecret = $jwtarrayinformation['usersecret'];

    jwtupdate($jwtarrayinformation);
} else {

    header("location: https://www.swapamc.com/swapproj/logout");
    exit();
}



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