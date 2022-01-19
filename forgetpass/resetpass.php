<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
session_start();
session_regenerate_id();
if (!isset($_SESSION["forgetpasskey"])) {
    header("location: https://www.swapamc.com/swapproj/forgetpassword?email=expired");
    exit();
} else {
    if (isset($_GET["key"]) ==  $_SESSION["forgetpasskey"]) {
        unset($_SESSION["forgetpasskey"]);
        if (isset($_GET["email"]) == $_SESSION["forgetpassemail"]) {
            if (isset($_GET["action"]) == "reset") {
                $currenttime = $_SERVER["REQUEST_TIME"];
                if ($currenttime -  $_SESSION["forgetpassexpiry"] > 300) {
                    echo "Invalid Link.Link have expired.";
                    header("location: https://www.swapamc.com/swapproj/forgetpassword?email=expired");
                    exit();
                } else {
                    echo "<form method='post' action='resetpasswordinc'>";
                    echo "<label><strong>Enter New Password:</strong></label><br>";
                    echo "<input type='password' name='newpass'  required>";
                    echo "<input type='submit' value='Reset Password' onclick='this.disabled=true; this.value='Sending, please wait...'; this.form.submit(); >";
                    echo "</form>";
                }
            }
        } else {
            header("location: https://www.swapamc.com/swapproj/forgetpassword?error=invalidurl");

        }
    }
}