<?php

require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/user_auth.php';
require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/auth/pages.php';


// deals with url stuff
if (!isset($jwtarrayinformation['loginstate'])) {
    header("location: https://www.swapamc.com/swapproj/login");
    exit();
} elseif ($jwtarrayinformation['loginstate'] === "A") {
    header("location: https://www.swapamc.com/swapproj/emailverification");
    exit();
} elseif ($jwtarrayinformation['loginstate'] === "B") {
    header("location: https://www.swapamc.com/swapproj/googleauthentication");
    exit();
} elseif (!$jwtarrayinformation['loginstate'] === "OK") {
    header("location: https://www.swapamc.com/swapproj/logout");
    exit();
}

echo "<br><br><a href='https://www.swapamc.com/swapproj/employeemanager'><input type=button name=employeemanager value=Employee_Manager></a>";
echo "<a href='https://www.swapamc.com/swapproj/allproducts'><input type=button name=allproducts value=Storefront></a>";

echo "<h3> PHP List All Session Variables</h3>";
foreach ($_SESSION as $key => $val)
    echo $key . " " . $val . "<br/>";


echo "<h3> PHP List All JWT Token Variables</h3>";
foreach ($jwtarray as $key => $val)
    if (gettype($val) != "array") {
        echo $key . " " . $val . "<br/>";
    }
foreach ($jwtarrayinformation as $key => $val)
    if (gettype($val) != "array") {
        echo $key . " " . $val . "<br/>";
    }




echo "<h3> You are logged in! :D</h3>";

if (isset($_COOKIE['jwt'])) {
    $token = $_COOKIE['jwt'];
    $info = jwtdecrypt();
}
// foreach ($jwtarrayinformation as $key => $val)
//     echo $key . " " . $val . "<br/>";



?>
<html>

<body><br><br>
    Congratulations for logging in <b><?php echo $jwtarrayinformation['username'];
                                        ?></b>

    <form method="POST">
        <input type="submit" value="logout" name="submit" formaction="/swapproj/logout">
        <input type="submit" value="profile" name="submit" formaction="/swapproj/userprofile">
    </form>

</body>

</html>