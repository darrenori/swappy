<?php

if (isset($_POST["submit"])) {
    

    $username = $_POST["uid"];
    echo $username;
    $pwd = $_POST["pwd"];
    echo $pwd;
    require_once 'dbh.inc.php';
    require_once 'functions.inc.php';

    $loginempty=emptyInputLogin($username, $pwd);
    echo $loginempty;
    // THE FOLLOWING IF LOOPS ARE FOR ERRORHANDLING
    // the ?error=emptyinput will be used later to identify errors
    if ( $loginempty !== false) {
        header("location: ../swapproj/login.php?error=emptyinput");
        exit();
    }else{
        echo "got problem uh";
    }

    loginUser($conn,$username, $pwd);


}
else{
    header("location: ../login.php");
    exit();
}