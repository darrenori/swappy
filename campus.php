<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/user_auth.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/auth/pages.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';




echo "<br><br><a href='https://www.swapamc.com/swapproj/employeemanager'><input type=button name=employeemanager value=Employee_Manager></a>";
echo "<a href='https://www.swapamc.com/swapproj/allproducts'><input type=button name=allproducts value=Storefront></a>";
echo "<a href='https://www.swapamc.com/swapproj/allproducts/product/viewcart'><input type=button name=viewcart value='View Cart'></a>";
echo "<a href='https://www.swapamc.com/swapproj/allstores'><input type=button name=allstores value='All Stores'></a>";
echo "<a href='https://www.swapamc.com/swapproj/employeemanager'><input type=button name=employeemanager value='Tasks need to be accessed thru employee manager'></a>";


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

echo "<h4><a href='https://www.swapamc.com/swapproj/viewnotifications'>Notification</a></h4>";
echo "<h4><a href='https://www.swapamc.com/swapproj/viewfavorites'>Favorites</a></h4>";
echo "<h4><a href='https://www.swapamc.com/swapproj/viewpurchases'>Purchases</a></h4>";





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