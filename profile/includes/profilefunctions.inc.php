<?php
## Originally profile.function

function notEmpty($array)
{
    for ($i = 0; $i < sizeof($array); $i++) {
        if ($array[$i] == "" || $array[$i] == null) {
            return false;
        }
    }

    return true;
}

function invalidUserEmail($email)
{
    $result = false;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;

    //false means good input
}



function usernameUserExists($conn, $username, $id)
{
    try {
        $query = $conn->prepare("SELECT user_id FROM mydb.users WHERE user_username = '$username'");
        if ($query === false) {
                //change filename accordingly
                throw new Exception("Statement Preparation failed(profilefunctions.inc)");
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
            //change header location accordingly
            header("location: https://www.swapamc.com/swapproj/userprofile?error=badstatement");
            exit;
        }
        // throws error "Statment Execution failed" when statement fails
        try {
            $execute = $query->execute();
            if ($execute === false) {
                throw new Exception("Statement Execution failed (profilefunctions.inc)");
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
            header("location: https://www.swapamc.com/swapproj/userprofile?error=badstatement"); //    echo mysqli_error($query);
        
            exit;
        }
        
    $uid = '';



        $query->bind_result($uid);
        if ($query->fetch()) {

            if (isset($uid)) {
                if ($uid != $id) {
                    return true;
                    //username already exists
                }
            }
        }
}


function emailUserExists($conn, $email, $id)
{
    try {
        $query = $conn->prepare("SELECT user_id FROM mydb.users WHERE username_email = '$email'");
        if ($query === false) {
                //change filename accordingly
                throw new Exception("Statement Preparation failed(profilefunctions.inc)");
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
            //change header location accordingly
            header("location: https://www.swapamc.com/swapproj/userprofile?error=badstatement");
            exit;
        }
        // throws error "Statment Execution failed" when statement fails
        try {
            $execute = $query->execute();
            if ($execute === false) {
                throw new Exception("Statement Execution failed (profilefunctions.inc)");
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
            header("location: https://www.swapamc.com/swapproj/userprofile?error=badstatement"); //    echo mysqli_error($query);
        
            exit;
        }
        
    $uid = '';


        $query->bind_result($uid);
        if ($query->fetch()) {

            if (isset($uid)) {
                if ($uid != $id) {
                    return true;
                    //username already exists
                }
            }
        }
}

function badUserInput($array)
{
    $pattern = "/^(?=.{1,30}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$/i";

    for ($i = 0; $i < sizeof($array); $i++) {
        $input = $array[$i];
        $a = !(preg_match($pattern, $input));

        if ($a == 1) {
            return true;
        }
    }

    return false;

    //0 is valid input


}
