<?php
    session_start();
    
    //check if the session is started/destroyed. if destroyed will redirect to login page
    if (!isset($_SESSION["username"])) { 
        header("location: ../swapproj/login");
    }
    else {
        $now = time(); // Checking the time now when home page starts.
        echo "Welcome ";
        echo $_SESSION["username"];
        echo "<br>";

        //destroying the session when the time limit passes
        if ($now > $_SESSION['expire']) {
            session_destroy();
            echo "Your session has been expired pls login again to continue";
        }
    }
    // to refresh the webpage and ask the user to login again
    // refresh time should always be longer than session expire time
    header("Refresh:13");
        ?>
<html>
    <body>

    </body>
</html>