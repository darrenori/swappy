<?php

use Lablnet\Encryption;

//checks for empty boxes
function emptyInputSignup($firstname, $lastname, $email, $phonenumber, $username, $pwd, $pwdRepeat, $primaryschool, $favouritefood)
{
    $result = true;
    if (empty($firstname) || empty($lastname) || empty($email) || empty($phonenumber) || empty($username) || empty($pwd) || empty($pwdRepeat) || empty($primaryschool) || empty($favouritefood)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
//checks username input this function does not allow any username that contains characters not listed within the square brackets
function invalidUid($username)
{
    $result = true;
    if (!preg_match("/^[a-zA-Z0-9._]*$/", $username)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
//checks username input this function does not allow any username that contains characters not listed within the square brackets
function badInput($array)
{
    $result = true;
    foreach ($array as $key => $val) {

        if (!preg_match("/^pwd|^email|^g-recaptcha-response/", $key) && !preg_match("/^[a-zA-Z0-9\s]*$/", $val)) {
            return $key;
        } else {
            $result = false;
        }
    }
    return $result;
}

//checks if an email exists
function invalidEmail($email)
{
    $result = true;

    if (!filter_var($email, FILTER_SANITIZE_EMAIL)) {
        $result = true;
    } else {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $result = true;
        } else {
            $result = false;
        }
    }
    return $result;
}
//checks if passwords match also used for otp verification
function pwdMatch($pwd, $pwdRepeat)
{
    $result = true;
    if ($pwd !== $pwdRepeat) {
        $result = true;
        echo "true" . $result;
    } else {
        $result = false;
        echo "false" . $result;
    }

    return $result;
}

// check if username already exists AND if it exists returns the values of the user
// creates prepared statements so it runs into the db without input?
function uidExists($conn, $username, $email)
{

    //For LOGGING purposes
    $filename = basename(__FILE__, '.php'); // filename variable is now set as allstores for example
    $ipadd = $_SERVER['REMOTE_ADDR']; //not sure if this works from another machine ://


    try {
        $query = $conn->prepare("SELECT * FROM mydb.users WHERE user_username =? OR username_email =?;");

        $query->bind_param("ss", $username, $email);
        if ($query === false) {
            //change filename accordingly
            throw new Exception("Statement Preparation failed(productedit)");
        }
    } catch (Exception $e) {
        error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR preparing statement (SELECT)", 0);
        //change header location accordingly
        header("location: https://www.swapamc.com/swapproj/googleauthentication");
        exit;
    }
    try {
        $execute = $query->execute();
        if ($execute === false) {
            throw new Exception("Statement Preparation failed(checkout)");
        }
    } catch (Exception $e) {
        error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR executing statement (SELECT)", 0);
        header("location: https://www.swapamc.com/swapproj/googleauthentication");
        exit;
    }
    $resultData = $query->get_result();


    //RETURNS THE DATA FROM THE TABLE AND STORES IT IN $ROW
    //THIS WAY WE CAN USE IT FOR LOGGING IN
    if ($row = $resultData->fetch_array(MYSQLI_ASSOC)) {
        foreach ($row as $key => $value) {
            if (is_array($value)) {
                foreach ($value as $k => $v) {
                    $row[$key][$k] = htmlspecialchars((string)$v);
                }
            } else {
                $row[$key] = htmlspecialchars((string)$value);
            }
        }
        return $row;
    } else {
        $result = false;
        return $result;
    }
    $query->close();
}
// check if username already exists AND if it exists returns the values of the user
// creates prepared statements so it runs into the db without input?
function workingIdExists($conn, $userID)
{
    $sql = "SELECT * FROM users WHERE user_id =?;";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: https://www.swapamc.com/swapproj/signup?error=stmtfailed");
        exit();
    }

    mysqli_stmt_bind_param($stmt, "s", $userID);
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
function createUser($conn, $firstname, $lastname, $email, $username, $pwd, $phonenumber, $primaryschool, $favouritefood)
{
    $defaultpic = "uploads/IMG-DEFAULTPROFILE.jpg";
    session_start();
    $sql = "INSERT INTO users (user_username, user_password, user_fname, user_lname, username_email, user_number, date_of_signup,user_security_primaryschool, user_security_favoritefood, user_secret, user_profilepicture) VALUES (?,?,?,?,?,?,?,?,?,?,?);";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: https://www.swapamc.com/swapproj/signup?error=stmtfailed");
        exit();
    }


    //hashing
    $pepper = "AWiokdfnkFNKKHHDBJXLL28838jkuiu54859dnkkmid93E1928485";
    //password hashing
    //we created a pepper that will persist across all users, the purpose is to secure the password such that people will need access to this file to read the pepper
    //next we hashed that with sha256, then hashed it over with sha256 2 times more.
    //Lastly it's hashed using password_hash together with a secret salt autogenerated by the password_hash function
    $hashedPwd = hash_hmac("sha256", $pwd, $pepper);
    $hashedPwd = hash("sha256", hash("sha256", $hashedPwd));
    $hashedPwd = password_hash($hashedPwd, PASSWORD_DEFAULT);




    $randomsecret = generateRandomString();
    //var username =sessionStorage.getItem("username")
    // print(username);
    $t = time();

    date_default_timezone_set('Asia/Singapore');
    $date = date('Y-m-d H:i:s', time()); //. " " . date('H:i:s')
    echo "<br><br>" . $date;
    // number of 's' indicate number of values? for some reason, and i used placeholder for all the unsupplied values


    mysqli_stmt_bind_param($stmt, "sssssssssss", $username, $hashedPwd, $firstname, $lastname, $email, $phonenumber, $date, $primaryschool, $favouritefood, $randomsecret, $defaultpic);
    mysqli_stmt_execute($stmt);
    //closes the connection
    mysqli_stmt_close($stmt);

    $array['username'] = $username;
    $array['useremail'] = $email;
    $array['loginstate'] = "Z";
    foreach ($array as $key => $value) {
        $array[$key] = htmlspecialchars($value);
    }


    // for debugging, ignore 
    //echo "<p>";
    // var_dump($array);
    // echo "<br><br><br>";
    // echo gettype($array);
    // echo "</p>";


    $encrypted = jwtencrypt($array);
    $encrypted = encrypt($encrypted);
    setCookieSameSite('jwt', $encrypted, 0); //0 means cookie dies when closed


    header("location: https://www.swapamc.com/swapproj/googleauthentication");
    exit();
}
// Function to generate random secret for google auth
function generateRandomString($length = 16)
{
    $characters = '234567QWERTYUIOPASDFGHJKLZXCVBNM';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


//////////////LOGIN FUNCTIONS////////////////
//checks for empty input boxes
function emptyInputLogin($username, $pwd)
{
    $result = true;
    if (empty($username) || empty($pwd)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

//checks for email otp
function verification2fa($email)
{
    $result = true;
    if (empty($username) || empty($pwd)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function isEmployee($conn, $id)
{
    $workingid = null;

    //For LOGGING purposes
    $filename = basename(__FILE__, '.php'); // filename variable is now set as allstores for example
    $ipadd = $_SERVER['REMOTE_ADDR']; //not sure if this works from another machine ://

    $query = $conn->prepare("SELECT working_id FROM mydb.working_employees WHERE user_id = ?;");
    $query->bind_param('s', $id);

    if ($query->execute()) {
        $query->bind_result($workingid);

        if ($query->fetch()) {
            return $workingid;
        } else {
            return null;
        }
    } else {
        error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR executing statement (SELECT)", 0);
    }
}

function checkSuspended($conn, $username)
{
    //For LOGGING purposes
    $filename = basename(__FILE__, '.php'); // filename variable is now set as allstores for example
    $ipadd = $_SERVER['REMOTE_ADDR']; //not sure if this works from another machine ://

    #DEFINED VARIABLES SO THAT WONT HAVE SQUIGGLY LINES
    $is_suspended = 0;
    $finish = 0;


    #CHECK IF USER IS SUSPSENDE AND UNTIL WHEN THEY ARE
    $query = $conn->prepare("SELECT user_suspended,suspendedfinish FROM mydb.users WHERE user_username = ?");
    $query->bind_param('s', $username);
    if (!$query->execute()) {
        error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR executing statement (SELECT)", 0);
    }
    $query->bind_result($is_suspended, $finish);
    if ($query->fetch()) {
    }

    $query->close();




    date_default_timezone_set('Asia/Singapore');
    $time = time();


    #IF USER IS SUSEPNDED
    if ($finish != null && isset($finish)) {
        #IF USER IS PAST THEIR SUSPENDED TIME
        if ($time > $finish) {
            $query = $conn->prepare("UPDATE mydb.users SET suspendedfinish = 0, user_failedattempts = 0, user_suspended = 0 WHERE user_username = ?");
            $query->bind_param('s', $username);
            if (!$query->execute()) {
                error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR executing statement (SELECT)", 0);
            }
            $query->close();
            return null;
        } else {
            #IF USER IS STILL SUSPENDED >:(
            if ($is_suspended == 1) {
                date_default_timezone_set('Asia/Singapore');
                $suspendedtill = date('Y-m-d', $finish) . " " . date('H:i:s');
                return $suspendedtill;
            }
        }
    }
}



//logs in user whether username or email is used
function loginUser($conn, $username, $pwd, $remember)
{
    //For LOGGING purposes
    $filename = basename(__FILE__, '.php'); // filename variable is now set as allstores for example
    $ipadd = $_SERVER['REMOTE_ADDR']; //not sure if this works from another machine ://


    $uidExists = uidExists($conn, $username, $username);
    $numberoftimesbeforesuspend = 5;

    //5 mins
    $defaultsuspendtime = 300;
    date_default_timezone_set('Asia/Singapore');
    $time = time();
    $suspended = $time + $defaultsuspendtime;






    if ($uidExists === false) {
        header("location: https://www.swapamc.com/swapproj/login?error=wronglogin");
        exit();
    }
    $workingIDExists = workingIdExists($conn, $uidExists['user_id']);
    if ($workingIDExists !== false) {
        $jwtarrayinformation['workingid'] = $workingIDExists['working_id'];
    }

    #IS THE USER SUSPENDED? (returns date if they still are) returns null if they ar enot
    $datesus = checkSuspended($conn, $username);
    if ($datesus != null) {
        header("location: https://www.swapamc.com/swapproj/login?error=suspended");
        exit();
    }

    $pepper = "AWiokdfnkFNKKHHDBJXLL28838jkuiu54859dnkkmid93E1928485";
    $pwdHashed = $uidExists["user_password"];
    $pwd = hash_hmac("sha256", $pwd, $pepper);
    $pwd = hash("sha256", hash("sha256", $pwd));
    $checkPwd = password_verify($pwd, $pwdHashed);



    if ($checkPwd === false) {

        ###DARREN: ADDED COUNT OF FAILURE
        $numberoffailed = 0;

        $query = $conn->prepare("SELECT user_failedattempts FROM mydb.users WHERE user_username = ?");
        $query->bind_param('s', $username);
        if (!$query->execute()) {
            error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR executing statement (SELECT)", 0);
        }
        $query->bind_result($numberoffailed);
        if ($query->fetch()) {
            $numberoffailed = $numberoffailed + 1;
        } else {
            //0 attempts
            $numberoffailed = 1;
        }
        $query->close();




        if ($numberoffailed > $numberoftimesbeforesuspend) {

            $query = $conn->prepare("UPDATE mydb.users SET user_suspended = 1, user_failedattempts = 1, suspendedfinish = ? WHERE user_username = ?");
            $query->bind_param('ss', $suspended, $username);
            if (!$query->execute()) {
                error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR executing statement (SELECT)", 0);
            }
            $query->close();
        } else {
            $query = $conn->prepare("UPDATE mydb.users SET user_failedattempts = ? WHERE user_username = ?");
            $query->bind_param('is', $numberoffailed, $username);
            if (!$query->execute()) {
                error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR executing statement (SELECT)", 0);
            }
            $query->close();
        }








        header("location: https://www.swapamc.com/swapproj/login?error=wronglogin");
        exit();
    } elseif ($checkPwd === true) {


        // OTP email


        // //Taking the current time
        // $_SESSION['start'] = time();
        // //Setting the time to end session
        // $_SESSION['expire'] = $_SESSION['start'] + (200);

        // //session superglobal
        // $_SESSION["userid"] = $uidExists["user_id"];
        // $_SESSION["username"] = $uidExists["user_username"];
        // $_SESSION['useremail'] = $uidExists['username_email'];
        // $_SESSION["role"] = $uidExists["user_role"];
        // $_SESSION["loginstate"] = "A";
        // $_SESSION['LAST_ACTIVE_TIME'] = time();

        $array['role'] = $uidExists["user_role"];
        $array['username'] = $uidExists["user_username"];
        $array['loginstate'] = 'A';
        $array['userid'] = $uidExists["user_id"];
        $array['useremail'] = $uidExists["username_email"];
        $array['profilepic'] = $uidExists['user_profilepicture'];
        foreach ($array as $key => $value) {
            $array[$key] = htmlspecialchars($value);
        }
        escapeString($conn, $array);


        $workingid = isEmployee($conn, $array['userid']);

        if ($workingid != null && isset($workingid)) {
            $array['workingid'] = $workingid;
        }


        $encrypted = jwtencrypt($array);
        $encrypted = encrypt($encrypted);
        if ($remember == true) {
            //they checked "rememberme"
            setCookieSameSite('jwt', $encrypted, time() + 86400); //1 day

        } elseif ($remember == false) {
            setCookieSameSite('jwt', $encrypted, 0); //0 means cookie dies when closed

        }

        session_start();
        $_SESSION['variable'] = "hi";





        header("location: https://www.swapamc.com/swapproj/emailverification");
        exit();
    }
}


function jwtencrypt($array)
{
    $objpages = new Pages();


    //renders any scripts into html form of special char e.g., & = &amp
    foreach ($array as $key => $val) {
        if (gettype($key) == "string") {
            $key = htmlspecialchars($key, ENT_QUOTES);
        }
        //only checks if of string type (integers will not run through htmlspecialchars)
        if (gettype($val) == "string") {
            $val = htmlspecialchars($val, ENT_QUOTES);
        }
    }
    $encrypted = $objpages->auth($array);

    if ($encrypted) {
        $encrypted = $encrypted['token'];
        echo "object has been uploaded Kek";
    }


    return $encrypted;
}



function jwtdecrypt()
{
    require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/auth/pages.php';


    if (isset($_COOKIE['jwt'])) {

        $token = $_COOKIE['jwt'];
        $token = decrypt($token);
    } else {
        $token = null;
    }



    $objpages = new Pages();
    $decrypted = $objpages->read($token);
    if ($decrypted) {
        $decrypted = json_decode(json_encode($decrypted), true);
    }



    return $decrypted;
}


function jwtupdate($newarray)
{
    $pages = new Pages();
    if (isset($_COOKIE['jwt'])) {

        $cookie = $_COOKIE['jwt'];
        $cookie = decrypt($cookie);

        $cookie = $pages->read($cookie); //verify if token valid. returns null if its not

        if ($cookie != null) {


            $cookie = json_decode(json_encode($cookie), true); //convert to array
            $array = $cookie['array'];

            foreach ($newarray as $key => $val) { // converts old value to new value
                //renders any scripts into html form of special char e.g., & = &amp
                if (gettype($key) == "string") {
                    $key = htmlspecialchars($key, ENT_QUOTES);
                }
                //only checks if of string type (integers will not run through htmlspecialchars)
                if (gettype($val) == "string") {
                    $val = htmlspecialchars($val, ENT_QUOTES);
                }
                $array[$key] = $val;
            }

            // foreach ($array as $key => $val) { // if new array does not contain item from old array(deleted) then remove it from old array
            //     if (!array_key_exists($key, $newarray)) {
            //         unset($array[$key]);
            //     }
            // }



            //update instead of replace
            $iat = $cookie['iat'];
            $exp = $cookie['exp'];

            $updateInfo = $pages->updateauth($array, $iat, $exp);
            $updateInfo = $updateInfo['token'];

            $encrypted = encrypt($updateInfo);


            //push to cookie
            setCookieSameSite('jwt', $encrypted, time() + 86400);
        }
    }
}


function regenerateJWT()
{
    $pages = new Pages();
    if (isset($_COOKIE['jwt'])) {
        $cookie = $_COOKIE['jwt'];
        $cookie = decrypt($cookie);
        $cookie = $pages->read($cookie); //verify if token valid. returns null if its not

        if ($cookie != null) {
            $cookie = json_decode(json_encode($cookie), true); //convert to array
            $array = $cookie['array'];

            $exp = $cookie['exp'];

            $regenerate = $pages->regenerate($array, $exp);
            $regenerate = $regenerate['token'];

            $encrypted = encrypt($regenerate);


            setCookieSameSite('jwt', $encrypted, time() + 86400);
        }
    }
}




//checks for empty input boxes
function failedCaptcha($captcha)
{
    $result = true;
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
function setCookieSameSite(string $name, string $value, $expire)
{


    $domain = 'www.swapamc.com';
    $samesite = 'Strict';
    $secure = true;
    $httponly = true;
    $path = '/';


    if (PHP_VERSION_ID < 70300) {
        setcookie($name, $value, $expire, $path . '; samesite=' . $samesite, $domain, $secure, $httponly);
        return;
    } else
        setcookie($name, $value, [
            'expires' => $expire,
            'path' => $path,
            'domain' => $domain,
            'samesite' => $samesite,
            'secure' => $secure,
            'httponly' => $httponly,
        ]);
}

function calculateProductCode($array)
{


    $string = '';


    $string = $array['product_name'];


    foreach ($array as $key => $val) {

        //check for bad input

        $pattern = "/^(?=.{1,30}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$/i";


        $a = !(preg_match($pattern, $key));
        $b = !(preg_match($pattern, $val));

        if ($a == 1 || $b == 1) {
            break; //break out of the loop, so code wont be able to match at all
        }

        $key = preg_replace('/\s+/', '_', $key);
        $val = preg_replace('/\s+/', '_', $val);






        if ($key != 'type' && $key != 'product_name') {



            $string = $string . ',' . $key . ',' . $val;
        }
    }

    //echo $string;



    return md5($string);
}



function badInputTwo($array)
{
    // $pattern = "/^[a-zA-Z0-9_ ]*$/i";
    // checks for anything that is not from the following list
    // $pattern = "/^[a-zA-Z0-9_ @,().!?+-]+$/i";
    $pattern = "/^[A-Za-z0-9_ @,().!?+:]+(-[A-Za-z0-9_ @,().!?+:]+)*$/i";


    foreach ($array as $key => $val) {

        $a = !(preg_match($pattern, $val));

        if ($a == 1) {
            return true;
        }
    }

    return false;

    //0 is valid input

}


function emptyInputShippingAdd($name, $email, $phonenumber, $address, $unit, $zip)
{
    $result = false;
    if (empty($name) || empty($email) || empty($phonenumber) || empty($address) || empty($unit) || empty($zip)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
function viewDefaultShippingAdd($conn)
{
    //For LOGGING purposes
    $filename = basename(__FILE__, '.php'); // filename variable is now set as allstores for example
    $ipadd = $_SERVER['REMOTE_ADDR']; //not sure if this works from another machine ://


    $jwtarray = jwtdecrypt();
    if (isset($jwtarray) && $jwtarray == true) {

        $jwtarrayinformation = $jwtarray['array'];
    }




    $userid = $jwtarrayinformation['userid'];
    $query = $conn->prepare("SELECT user_shipping_id, user_shipping_name, user_shipping_number, user_shipping_email, user_shipping_address, user_shipping_postalcode, user_shipping_unitnumber, user_shipping_default FROM user_shippinginformation WHERE user_shipping_userid = ? AND user_shipping_default = 1 AND deleted != 1");
    $query->bind_param('s', $userid);
    $stmt = mysqli_stmt_init($conn);
    if (!$query->execute()) {
        error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR executing statement (SELECT)", 0);


        header("location: https://www.swapamc.com/swapproj/checkout?error=stmtfailed");
        exit();
    }
    if ($query->execute()) {
        $result = $query->get_result();
        if ($result->num_rows > 0) {
            while ($row = mysqli_fetch_array($result)) {

                $shippingaddress = $row;
                return $shippingaddress;
            }
        } else {
            $shippingaddress = 0;
            return $shippingaddress;
        }
    }
    $conn->close();
}



function cartpurchased($conn)
{
    //For LOGGING purposes
    $filename = basename(__FILE__, '.php'); // filename variable is now set as allstores for example
    $ipadd = $_SERVER['REMOTE_ADDR']; //not sure if this works from another machine ://

    $selectedcarts = $_SESSION['cart'];
    $harry = implode(',', $selectedcarts);
    $bundledidrandom = $_SESSION['bundledid'];
    $query = $conn->prepare("UPDATE mydb.user_cart SET  mydb.user_cart.purchased = 1 , mydb.user_cart.bundled=? WHERE  mydb.user_cart.cart_id IN ( ? ) ");
    $query->bind_param('ss', $bundledidrandom, $harry);
    $stmt = mysqli_stmt_init($conn);
    if (!$query->execute()) {
        error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR preparing statement (SELECT)", 0);
        header("location: https://www.swapamc.com/swapproj/checkout?error=stmtfailed");
        exit();
    }
    if ($query->execute()) {

        // header("location: https://www.swapamc.com/swapproj/checkout?payment=success ");
    }
    $query->close();
}



function reduceInventory($conn)
{
    //For LOGGING purposes
    $filename = basename(__FILE__, '.php'); // filename variable is now set as allstores for example
    $ipadd = $_SERVER['REMOTE_ADDR']; //not sure if this works from another machine ://

    // print_r($_SESSION['cart']);

    $cartarray = $_SESSION['cart'];

    for ($i = 0; $i < sizeof($cartarray); $i++) {
        $cartid = $cartarray[$i];





        try {
            $query = $conn->prepare("SELECT quantity,productcode FROM mydb.user_cart WHERE cart_id = ?;");

            $query->bind_param('s', $cartid);
            if ($query === false) {
                //change filename accordingly
                throw new Exception("Statement Preparation failed(productedit)");
            }
        } catch (Exception $e) {
            error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR preparing statement (SELECT)", 0);
            //change header location accordingly
            header("location: https://www.swapamc.com/swapproj/checkout");
            exit;
        }


        try {
            $execute = $query->execute();
            if ($execute === false) {
                throw new Exception("Statement Preparation failed(checkout)");
            }
        } catch (Exception $e) {
            error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR executing statement (SELECT)", 0);
            header("location: https://www.swapamc.com/swapproj/checkout");
            exit;
        }

        $productcode = null;
        $quantity = null;
        $query->bind_result($quantity, $productcode);
        $query->fetch();
        $query->close();

        // echo "<br><br><br>";


        // echo $productcode;




        //get quantity left
        try {
            $query = $conn->prepare("SELECT quantityleft FROM mydb.inventory WHERE productcode = ?;");
            $query->bind_param('s', $productcode);
            if ($query === false) {
                //change filename accordingly
                throw new Exception("Statement Preparation failed(productedit)");
            }
        } catch (Exception $e) {
            error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR preparing statement (SELECT)", 0);
            //change header location accordingly
            header("location: https://www.swapamc.com/swapproj/checkout");
            exit;
        }


        try {
            $execute = $query->execute();
            if ($execute === false) {
                throw new Exception("Statement Preparation failed(productedit)");
            }
        } catch (Exception $e) {
            error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR executing statement (SELECT)", 0);
            header("location: https://www.swapamc.com/swapproj/checkout");
            exit;
        }

        $quantityleft = null;
        $query->bind_result($quantityleft);

        $query->fetch();

        $quantityleft = $quantityleft - $quantity;

        $query->close();


        //update new values!

        try {
            $query = $conn->prepare("UPDATE mydb.inventory SET quantityleft = ? WHERE productcode = ?");
            $query->bind_param('ss', $quantityleft, $productcode);
            if ($query === false) {
                //change filename accordingly
                throw new Exception("Statement Preparation failed(productedit)");
            }
        } catch (Exception $e) {
            error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR preparing statement (UPDATE)", 0);
            //change header location accordingly
            header("location: https://www.swapamc.com/swapproj/checkout");
            exit;
        }


        try {
            $execute = $query->execute();
            if ($execute === false) {
                throw new Exception("Statement Preparation failed(productedit)");
            }
        } catch (Exception $e) {
            error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR executing statement (UPDATE)", 0);
            header("location: https://www.swapamc.com/swapproj/checkout");
            exit;
        }

        $query->close();
    }
}





function calculatetotalprice($conn)
{
    //For LOGGING purposes
    $filename = basename(__FILE__, '.php'); // filename variable is now set as allstores for example
    $ipadd = $_SERVER['REMOTE_ADDR']; //not sure if this works from another machine ://

    $selectedcarts = $_SESSION['cart'];
    $harry = implode(',', $selectedcarts);
    $bundledidrandom = $_SESSION['bundledid'];
    $query = $conn->prepare("SELECT SUM(mydb.user_cart.price) FROM mydb.user_cart WHERE mydb.user_cart.cart_id IN (" . $harry . ")");
    $stmt = mysqli_stmt_init($conn);
    if (!$query->execute()) {
        error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR executing statement (SELECT)", 0);
        header("location: https://www.swapamc.com/swapproj/checkout?error=stmtfailed");
        exit();
    }
    $totalprice = 0;
    if ($query->execute()) {
        $query->bind_result($totalprice);
        $query->fetch();
    }
    return $totalprice;
    $query->close();
}
function selectCreditCardInfo($conn, $userid)
{
    //For LOGGING purposes
    $filename = basename(__FILE__, '.php'); // filename variable is now set as allstores for example
    $ipadd = $_SERVER['REMOTE_ADDR']; //not sure if this works from another machine ://

    $query = $conn->prepare("SELECT MAX(user_creditcardinfo_id) FROM mydb.user_creditcardinfo WHERE user_creditcardinfo_userid = " . $userid);
    $stmt = mysqli_stmt_init($conn);
    if (!$query->execute()) {
        error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR preparing statement (SELECT)", 0);
        header("location: https://www.swapamc.com/swapproj/checkout?error=stmtfailed");
    }
    $ccinfo = 0;
    if ($query->execute()) {
        $query->bind_result($ccinfo);
        $query->fetch();
    }
    return $ccinfo;
    $conn->close();
}

function addIntoPastPurchase($conn)
{
    $jwtarray = jwtdecrypt();
    if (isset($jwtarray) && $jwtarray == true) {

        $jwtarrayinformation = $jwtarray['array'];
    }

    $userid = $jwtarrayinformation['userid'];
    $defaultshippingid = $_SESSION['defaultshippingid'];

    $purchasetime = date('Y-m-d H:i:s', time());
    $totalprice = calculatetotalprice($conn);
    $totalpricegst = $totalprice * 1.07;
    $creditcardinfo = selectCreditCardInfo($conn, $userid);
    $bundledidrandom =  $_SESSION['bundledid'];
    $purchasestatus = "0";

    $sql = "INSERT INTO mydb.user_past_purchases(user_id, user_shipping, user_creditcards, purchase_time, purchase_cost, purchase_status, cart_bundled)
    VALUES (?,?,?,?,?,?,?)";
    $stmt = mysqli_stmt_init($conn);
    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: https://www.swapamc.com/swapproj/checkout?error=stmtfailed");
        exit();
    }
    mysqli_stmt_bind_param($stmt, "sssssss", $userid, $defaultshippingid, $creditcardinfo, $purchasetime, $totalpricegst, $purchasestatus, $bundledidrandom);
    if (mysqli_stmt_execute($stmt)) {
        header("location: https://www.swapamc.com/swapproj/checkout?payment=success ");
    }
    $conn->close();
}


function addShippingAdd($conn, $name, $phonenumber, $email, $address, $zip, $unit)
{

    $jwtarray = jwtdecrypt();
    if (isset($jwtarray) && $jwtarray == true) {

        $jwtarrayinformation = $jwtarray['array'];
    }




    $userid = $jwtarrayinformation['userid'];

    $sql = "INSERT INTO mydb.user_shippinginformation(user_shipping_name, user_shipping_number, user_shipping_email, user_shipping_address, user_shipping_postalcode, user_shipping_unitnumber, user_shipping_userid,user_shipping_default) VALUES (?,?,?,?,?,?,$userid,0)";
    $stmt = mysqli_stmt_init($conn);

    if (!mysqli_stmt_prepare($stmt, $sql)) {
        header("location: https://www.swapamc.com/swapproj/checkout/addshippingaddress?error=stmtfailed");
        echo "error";
        exit();
    }

    mysqli_stmt_bind_param($stmt, "ssssss", $name, $phonenumber, $email, $address, $zip, $unit);
    mysqli_stmt_execute($stmt);
    //closes the connection
    mysqli_stmt_close($stmt);

    // header("location: https://www.swapamc.com/swapproj/checkout/addshippingaddress?=success");
    header("location: https://www.swapamc.com/swapproj/checkout/viewshippingaddress");
    echo "success added";
    exit();
}

function addCreditCard($conn, $cname,  $expmonth, $expyear, $cardtype, $ccnum, $encryptkey, $iv)
{
    $jwtarray = jwtdecrypt();
    if (isset($jwtarray) && $jwtarray == true) {

        $jwtarrayinformation = $jwtarray['array'];
    }
    //For LOGGING purposes
    $filename = basename(__FILE__, '.php'); // filename variable is now set as allstores for example
    $ip = $_SERVER['REMOTE_ADDR']; //not sure if this works from another machine ://




    $userid = $jwtarrayinformation['userid'];

    try {
        $query = $conn->prepare("INSERT INTO mydb.user_creditcardinfo (user_creditcardinfo_nameoncard,user_creditcardinfo_userid, user_creditcardinfo_expirymonth, user_creditcardinfo_expiryyear, user_creditcardinfo_cardtype,user_creditcardinfo_cardnumb,user_creditcardinfo_encryptkey,user_creditcardinfo_iv) VALUES (?,?,?,?,?,?,?,?)");
        $query->bind_param("ssssssss", $cname, $userid, $expmonth, $expyear, $cardtype, $ccnum, $encryptkey, $iv);

        if ($query === false) {
            throw new Exception("Statement Preparation failed (attendance)");
        }
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
        header("location: https://www.swapamc.com/swapproj/attendance/editemployee?error=stmtallerror");
        error_log("TPAMC:$filename:0:$ip:Error(stmtallerror)", 0);
        exit;
    }

    try {
        $execute = $query->execute();
        if ($execute === false) {
            throw new Exception("Statement Execution failed (attendance)");
        }
    } catch (Exception $e) {
        header("location: https://www.swapamc.com/swapproj/attendance/editemployee?error=badstatement");
        error_log("TPAMC:$filename:0:$ip:Error(badstatement)", 0);

        exit;
    }


    //closes the query
    $query->close();
}


function invalidPostalCode($zip)
{
    $result = false;
    if (!preg_match("/\d{6}/", $zip)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function emptyDefaultShipping($sa)
{

    $sa = $_SESSION['shippingaddress'];
    // var_dump($sa);
    $result = false;
    if (empty($sa) or $sa = "0") {
        $result = true;
    } else if ($sa = "1") {
        $result = false;
    }
    return $result;
}

function emptyCart($emptycarts)
{
    $result = false;
    $emptycarts = $_SESSION['cart'];
    // var_dump($emptycarts);
    if (empty($emptycarts)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function emptyInputPayment($cname, $number, $expmonth, $expyear, $cvc)
{
    $result = false;
    if (empty($cname) || empty($number) || empty($expmonth) || empty($expyear) || empty($cvc)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}
function invalidCName($cname)
{
    $result = false;
    if (!preg_match("^[a-zA-Z]*$", $cname)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function invalidExpMonth($expmonth)
{
    if (!is_numeric($expmonth) || $expmonth < 1 || $expmonth > 12) {

        $result = true;
    } else {
        $result = false;
    }
    return $result;
}


// Get the current year    
function invalidExpYear($expyear)
{
    $currentYear = date('Y');

    settype($currentYear, 'integer');


    if (!is_numeric($expyear) || $expyear < $currentYear || $expyear > $currentYear + 10) {

        $result = true;
    } else {
        $result = false;
    }
    return $result;
}


function invalidCVC($cvc)
{
    $result = false;
    if (!preg_match("/^[0-9]{3,4}$/", $cvc)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;
}

function duplicateEmail($conn, $email)
{

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "invalidemail";
        return true;
        exit;
    }
    //For LOGGING purposes
    $filename = basename(__FILE__, '.php'); // filename variable is now set as allstores for example
    $ipadd = $_SERVER['REMOTE_ADDR']; //not sure if this works from another machine ://


    try {
        $query = $conn->prepare("SELECT user_id FROM mydb.users WHERE username_email = ?;");
        $query->bind_param('s', $email);
        if ($query === true) {
            //change filename accordingly
            // return true;
        }
    } catch (Exception $e) {
        error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR preparing statement (SELECT)", 0);
        return true;
    }
    // throws error "Statment Execution failed" when statement fails
    try {
        $execute = $query->execute();
        if ($execute === true) {
            // return true;
        }
    } catch (Exception $e) {
        error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR executing statement (SELECT)", 0);
        return true;
    }

    $result = $query->get_result();
    $arrayone = $result->fetch_all(MYSQLI_ASSOC);


    if (sizeof($arrayone) > 0) {
        //exists

        return true;
    } else {
        return false;
    }
}
// pass in the array of variables that have the same buffer lengths, specify the length
function bufferOverflow($arrayofitems, $numberofcharacters)
{
    // return true if values are faulty AKA TRUE IS NOT DESIRABLE
    foreach ($arrayofitems as $key => $value) {
        if (strlen((string)$value) > $numberofcharacters) {
            return true;
        }
    }

    return false;
}

function checkLength($inputarray, $maxlengtharray)
{

    foreach ($inputarray as $key => $val) {
        if (isset($maxlengtharray[$key])) {
            $maxlength = $maxlengtharray[$key];
        }
        $lengthuserinputted = strlen(trim((string)$val));

        if ($lengthuserinputted > $maxlength) {
            return $key;
        }
    }


    return null;
    //reteunrs null if everything is good length

}


// pass in an array of all the names in array format as whitelist variable e.g., 
// login should only have ['uid', 'pwd', 'g-recaptcha-response', 'remember'];
function XSSPrevention($inputarray, $whitelist)
{
    foreach ($inputarray as $key => $value) {
        // hashes all values into htmlspecialchars versions
        $inputarray[$key] = htmlspecialchars($value, ENT_QUOTES);
        if (!in_array(htmlspecialchars($key, ENT_QUOTES), $whitelist)) {
            // removes any keys that are not in side the specified "whitelist"
            unset($inputarray[$key]);
        }
    }
    return $inputarray; // returns the array so code can be reused. 
}

function escapeString($conn, $inputarray)
{
    foreach ($inputarray as $key => $value) {
        $inputarray[$key] = mysqli_real_escape_string($conn, $value);
    }
    return $inputarray;
    //SYNTAX example, $_POST = escapeString($conn, $_POST);
}


function encrypt($plaintexst)
{

    require 'vendor/autoload.php';

    $encryption = new Encryption('ad!@#@!3!@#!snjsdjnsasd');

    //Encrypt the message

    $encrypt = $encryption->encrypt($plaintexst);
    return $encrypt;
}

function decrypt($encrypted)
{
    require 'vendor/autoload.php';

    $encryption = new Encryption('ad!@#@!3!@#!snjsdjnsasd');

    //Encrypt the message

    $decrypted = $encryption->decrypt($encrypted);
    return $decrypted;
}

function generateCSRF()
{
    if (!isset($_SESSION)) {
        session_start();
    }
    $token = md5(uniqid(rand(), true));
    $_SESSION['csrf'] = $token;
    return $token;
}

function validateCSRF()
{
    if (!isset($_SESSION)) {
        session_start();
    }
    //can only be used before any print statements
    session_regenerate_id();
    if (isset($_POST['csrf']) && isset($_SESSION['csrf'])) {
        if ($_SESSION['csrf'] == $_POST['csrf']) {
            return true;
            //valid token
        }
    }


    return false;
}


function validateCSRFGet()
{
    if (!isset($_SESSION)) {
        session_start();
    }
    // can only be used before any print statements
    session_regenerate_id(); //comment out if not working ig
    if (isset($_GET['csrf']) && isset($_SESSION['csrf'])) {
        if ($_SESSION['csrf'] == $_GET['csrf']) {
            return true;
            //valid token
        }
    }


    return false;
}


function validateCSRFAjax($postinformation)
{
    if (!isset($_SESSION)) {
        session_start();
    }
    if (isset($postinformation['csrf']) && isset($_SESSION['csrf'])) {
        if ($_SESSION['csrf'] == $postinformation['csrf']) {
            return true;
            //valid token
        }
    }


    return false;
}


//method is $_GET, $_POST, or $_SESSION. DONT PUT THE [] for $method
//array will be like $array = ['id','name'];
function checkEmpty($method, $array)
{

    foreach ($array as $value) {

        // if(empty())
        if (!isset($method[$value]) || $method[$value] === null || $method[$value] == '') {

            return $value;

            //return variable name if empty
        }
    }

    return null;
    //returns null if everything is filled up!
}


function phoneNumRegEx($phonenumber)
{
    $phonenumber = trim($phonenumber);
    if (!is_numeric($phonenumber) || strlen($phonenumber) !== 8) {
        return $phonenumber;
    }
    return null;
}

function checkForURL($inputarray, $filename, $ipadd)
{
    foreach ($inputarray as $key => $value) {
        $file_headers = @get_headers($value);
        if ($key !== "websitelink" && (!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found')) {
            error_log("TPAMC:" . $filename . ":2:" . $ipadd . ":4 URL detected in REQUEST values", 0);
        }
    }
}


function cleanValues($array, $whitelistvalues, $exemptkeys)
{
    if (!empty($array)) {
        $newarray = [];
        //shortlists keys with fixed values
        foreach ($array as $key => $value) {
            if (!in_array($key, $exemptkeys)) {
                array_push($newarray, $key);
            }
        }
        foreach ($newarray as $key => $value) {
            if (!in_array($value, $whitelistvalues)) {
                // item does not exist in whitelisted array
                // any unknown values of keys, we will 
                $array[$key] = "failed";
            }
        }
    }
}

function strongPassword($password)
{
    $uppercase = preg_match('@[A-Z]@', $password);
    $lowercase = preg_match('@[a-z]@', $password);
    $number    = preg_match('@[0-9]@', $password);
    $specialchar    = preg_match('@[!\@#$%^&*()_=+{};:,.]@', $password);
    // $specialchar=true;
    if (!$uppercase || !$lowercase || !$number || !$specialchar || strlen($password) < 8) {
        return false;
    }
    return $password;
}
