<?php

require("includes/user_auth.php");
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/auth/pages.php';


// deals with url stuff
if (!isset($_SESSION['loginstate'])) {
    header("location: ../swapproj/login");
    exit();
} elseif ($_SESSION['loginstate'] === "A") {
    header("location: ../swapproj/emailverification");
    exit();
} elseif ($_SESSION['loginstate'] === "B") {
    header("location: ../swapproj/googleauthentication");
    exit();
} elseif (!$_SESSION['loginstate'] === "OK") {
    header("location: ../swapproj/logout");
    exit();
}

echo "<br><br><a href='https://www.swapamc.com/swapproj/employeemanager'><input type=button name=employeemanager value=Employee_Manager></a>";
echo "<a href='https://www.swapamc.com/swapproj/allproducts'><input type=button name=allproducts value=Storefront></a>";

echo "<h3> PHP List All Session Variables</h3>";
foreach ($_SESSION as $key => $val)
echo $key . " " . $val . "<br/>";


echo "<h3> You are logged in! :D</h3>";

if(isset($_COOKIE['jwt'])){
    $token = $_COOKIE['jwt'];
    $info = jwtdecrypt($token);


    
}
// foreach ($_SESSION as $key => $val)
//     echo $key . " " . $val . "<br/>";



?>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
setInterval(function(){
    check_user();
},2000);
function check_user(){
    jQuery.ajax({
        url:'https://www.swapamc.com/swapproj/check',
        type:'post',
        data:'type=ajax',
        success:function(result){
            console.log(result);
            let text = result.includes("logout");
            if(text==true){
                window.location.href="https://www.swapamc.com/swapproj/logout";
            }
        }

    });
}
</script>
<html>

<body><br><br>
    Congratulations for logging in <b><?php echo $_SESSION['username'];
                                    ?></b>

    <form method="POST">
        <input type="submit" value="logout" name="submit" formaction="/swapproj/logout">
        <input type="submit" value="profile" name="submit" formaction="/swapproj/userprofile">
    </form>

</body>

</html>