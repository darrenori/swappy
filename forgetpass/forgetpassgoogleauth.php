<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/googleauth/vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/auth/pages.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';

session_start();
session_regenerate_id();    
$csrf = generateCSRF();

$email = $_SESSION['forgetpassemail'];
$randomsecret = $_SESSION['newsecret'];

if (!empty($_SESSION['newsecret'])) {

    //select userinfo based on email
    try {
        $query = $conn->prepare("SELECT user_id,user_username FROM mydb.users WHERE username_email=?");
        $query->bind_param("s", $email);
        if ($query === false) {
            throw new Exception("Statement Preparation failed (forgetpassgoogleauth)");
            error_log("TPAMC:FORGETPASS:2:$ip:failed statement", 0);
            exit();
        }
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
        header("location: https://www.swapamc.com/swapproj/forgetpassword?error=stmtallerror");
        error_log("TPAMC:FORGETPASS:0:$ip:Error(stmtallerror)", 0);
        exit;
    }


    try {
        $execute = $query->execute();
        if ($execute === false) {
            throw new Exception("Statement Execution failed (forgetpassgoogleauth)");
            error_log("TPAMC:FORGETPASS:2:$ip:failed statement", 0);
            exit();
        }
    } catch (Exception $e) {
        header("location: https://www.swapamc.com/swapproj/forgetpassword?error=badstatement");
        error_log("TPAMC:FORGETPASS:0:$ip:Error(badstatement)", 0);
        exit;
    }
    $query->store_result();
    $query->bind_result($userid, $username);
    $query->fetch();
    $query->close();



    //generate qr code
    $link = \Sonata\GoogleAuthenticator\GoogleQrUrl::generate($username, $randomsecret, 'swapamc.com');




    //form
    echo "<h2>Google OTP for user </h2>";
    echo " <form action='/swapproj/forgetpassword/googleauthinc' method='post'>";
    echo "<center>";
    echo "<img src=$link><br>";
    echo "<label for='googleautotp'>Enter Code Here:</label><br>";
    echo "<input type='text' id='googleauthotp' name='googleauthotp' placeholder='Enter Code'>";
    echo "<br><br>";
    echo "<input type='submit' value='submit' name='submit'>";
    echo "<input type='hidden' name='csrf' value='$csrf'>";
    echo "</center>";
    echo "</form>";
} else {
    header("location: https://www.swapamc.com/swapproj/forgetpassword?error=invalidgoogleauth");
    error_log("TPAMC:FORGETPASS:0:$ip:Error(invalidgoogleauth)", 0);
}





if (isset($_GET["error"])) {
    $error = htmlentities($_GET["error"]);
    if ($error == "badotp") {
        echo "<p>BadOtp!</p>";
    }
}
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