<?php
## Originally updateprofile and outside includes


//echo "edit";
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/profile/includes/profilefunctions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/functions.inc.php';


$userid = $jwtarrayinformation["userid"];


foreach ($_POST as $key => $value) {
    //echo "$key = $value<br>";

    if ($key != "submit") {
        $postinformation[$key] = $value;
    }
}


//print_r($postinformation);

$username = $postinformation['username'];
$fname = $postinformation['fname'];
$lname = $postinformation['lname'];
$email = $postinformation['email'];
$number = $postinformation['number'];



$informationarray = [$username, $fname, $lname, $email, $number];

if (badUserInput([$username, $fname, $lname, $number])) {
    echo "stop trying to hack the website please!";
    //header
}





if (notEmpty($informationarray) == 1) {

    if (invalidEmail($email) == 0) {

        if (emailUserExists($conn, $email, $userid) == 0) {
            if (usernameUserExists($conn, $username, $userid) == 0) {

                try {
                        $query = $conn->prepare("UPDATE mydb.users SET user_username = '$username',
                            user_fname = '$fname',user_lname  = '$lname',user_number=  '$number',username_email = '$email' 
                            WHERE user_id =$userid;");
                        if ($query === false) {
                            //change filename accordingly
                            throw new Exception("Statement Preparation failed(updateprofile.inc)");
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
                            throw new Exception("Statement Execution failed (updateprofile.inc)");
                        }
                    } catch (Exception $e) {
                        echo 'Message: ' . $e->getMessage();
                        header("location: https://www.swapamc.com/swapproj/userprofile?error=badstatement"); //    echo mysqli_error($query);
                    
                        exit;
                    }
                    

                    header("location: https://www.swapamc.com/swapproj/userprofile?type=success");
            }
        }
    }
}
