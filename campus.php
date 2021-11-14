<?php
    session_start();

    echo $_SESSION["username"];
    

    if (!isset($_SESSION["username"])) {
        echo "Please Login again";
        echo "LOGIN AGAIN";
    }
    else {
        $now = time(); // Checking the time now when home page starts.

        if ($now > $_SESSION['expire']) {
            session_destroy();
            echo "UR ARE SO SMART";
        }
    }
        ?>
<html>
    <body>
        Congratulations for logging in
    </body>
</html>