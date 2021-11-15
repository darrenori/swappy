<?php

//checks for empty boxes
function emptyInputSignup($name, $email, $username, $pwd, $pwdRepeat)
{
    $result = false;
    if (empty($name) || empty($email) || empty($username) || empty($pwd) || empty($pwdRepeat)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
//checks username input (im not sure what the error is here)
function invalidUid($username)
{
    $result = false;
    if (!preg_match("/^[a-zA-Z0-9]*$/", $username)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

//checks if an email exists
function invalidEmail($email)
{
    $result = false;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
//checks if passwords match
function pwdMatch($pwd, $pwdRepeat)
{
    $result = false;
    if ($pwd !== $pwdRepeat) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

// check if username already exists AND if it exists returns the values of the user
// creates prepared statements so it runs into the db without input?
function uidExists($conn, $username, $email)
{
    $sql = "SELECT * FROM users WHERE user_username =? OR username_email =?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../swapproj/signup?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ss", $username, $email);
    mysqli_stmt_execute($stmt);

    $resultData = mysqli_stmt_get_result($stmt);

    //RETURNS THE DATA FROM THE TABLE AND STORES IT IN $ROW
    //THIS WAY WE CAN USE IT FOR LOGGING IN
    if ($row = mysqli_fetch_assoc($resultData)) {
        return $row;
    } else {
        $result = false;
        return $result;
    }

    mysqli_stmt_close($stmt);
}


// check if username already exists 
// creates prepared statements so it runs into the db without input?
function createUser($conn, $name, $email, $username, $pwd)
{
    $sql = "INSERT INTO users (user_username, user_password, user_fname, user_lname, username_email, user_number, date_of_signup,user_security_primaryschool, user_security_favoritefood) VALUES (?,?,?,?,?,?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: ../swapproj/signup?error=stmtfailed");
        exit();
    }

    //password hashing
    $hashedPwd = password_hash($pwd, PASSWORD_DEFAULT);
    $placeholder = "iamafunnydawg";


    // number of 's' indicate number of values? for some reason, and i used placeholder for all the unsupplied values
    //darren: is "s" necessary? any other methods?

    mysqli_stmt_bind_param($stmt, "sssssssss", $username, $hashedPwd, $name, $name, $email, $placeholder, $placeholder, $placeholder, $placeholder);
    mysqli_stmt_execute($stmt);
    //closes the connection
    mysqli_stmt_close($stmt);
    header("location: ../swapproj/signup?error=none");
    exit();
}


//////////////LOGIN FUNCTIONS////////////////
//checks for empty input boxes
function emptyInputLogin($username, $pwd)
{
    $result = false;
    if (empty($username) || empty($pwd)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

//logs in user whether username or email is used
function loginUser($conn, $username, $pwd)
{
    $uidExists = uidExists($conn, $username, $username);

    if ($uidExists === false) {
        header("location: ../swapproj/login?error=wronglogin");
        exit();
    }

    $pwdHashed = $uidExists["user_password"];
    $checkPwd = password_verify($pwd, $pwdHashed);

    if ($checkPwd === false) {
        header("location: ../swapproj/login?error=wronglogin");
        exit();
    } elseif ($checkPwd === true) {
        //session started
        session_start();

        //session superglobal
        $_SESSION["userid"] = $uidExists["user_id"];
        $_SESSION["username"] = $uidExists["user_username"];
        header("location: ../swapproj/campus");
        exit();
    }
}
    //checks for empty input boxes
    function failedCaptcha($captcha)
    {
        $result = false;
        if (!isset($captcha) || empty($captcha)) {
            //runs if captcha is empty
            
            $result = "empty captcha";
            echo $result;
        } else {
            //runs if captcha received input
            $secret = '6LceTzMdAAAAAOpz-EsYoCKZGnAXCzF3lv-FsFfF';

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'https://www.google.com/recaptcha/api/siteverify?secret=' . $secret . '&response=' . $captcha);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($ch);
            curl_close($ch);
            $response = json_decode($response);

            if ($response->success) {
                // What happens when the CAPTCHA was entered incorrectly
                $result = true;
                echo "bad captcha";
            } else {
                // Your code here to handle a successful verification
                $result = false;
                echo "good captcha";
            }
        }
        return $result;
    }

