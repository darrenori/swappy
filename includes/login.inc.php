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
        header("location: ../swapproj/login?error=emptyinput");
        exit();
    }else{
        echo "got problem uh";
    }
    //remember me codes
    if(!empty($_POST["remember"]))
    {
        setcookie("user_login",$_POST["uid"],time()+ (10 * 365 * 24 * 60 * 60));
        setcookie("user_pwd",$_POST["pwd"],time()+ (10 * 365 * 24 * 60 * 60));
    }
    else
    {
        if(isset($_COOKIE["user_login"]))
        {
            setcookie("user_login","");
        }
        if(isset($_COOKIE["user_pwd"]))
        {
            setcookie("user_pwd","");
        }
    }
    //end of remember me codes
    loginUser($conn,$username, $pwd);


}
else{
    header("location: ../swapproj/login");
    exit();
}