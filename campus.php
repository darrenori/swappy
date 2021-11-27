<?php
session_start();
require("includes/user_auth.php");

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



echo "<h3> PHP List All Session Variables</h3>";
foreach ($_SESSION as $key => $val)
    echo $key . " " . $val . "<br/>";

// if (!isset($_SESSION["username"])) {
//     echo "Please Login again";
//     echo "LOGIN AGAIN";
// }
// else {
//     $now = time(); // Checking the time now when home page starts.

//     if ($now > $_SESSION['expire']) {
//         session_destroy();
//         echo "UR ARE SO SMART";
//     }
// }
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
    Congratulations for logging in <?php echo $_SESSION['username'] . " Get hacked noob";
                                    ?>

    <form action="/swapproj/logout" method="POST">
        <input type="submit" value="submit" name="submit">
    </form>

</body>

</html>