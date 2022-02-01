<?php

function validTypes($testifreal, $array)
{
    for ($i = 0; $i < sizeof($array); $i++) {
        if ($testifreal == $array[$i]) {
            return true;
        }
    }

    return false;
}

require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/manager/includes/employeefunctions.inc.php';

### CSRF ####
if (validateCSRF() == false) {
    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";


    if ($actual_link == "http://www.swapamc.com/swapproj/campus?error=badcsrf") {
        echo 'bad csrf';
        //dont redirect if on the same page

    } else {
        header("location: https://www.swapamc.com/swapproj/campus?error=badcsrf");
        exit;
    }
}
### CSRF ####

if (!isset($_POST['submit'])) {
    header("location: https://www.swapamc.com/swapproj/campus?error=badncsrf");
    exit;
}
// removes any other GET and POST names and does html specialchars
$whitelist = ['header', 'notificationtext', 'severe', 'type', 'usernametosend'];
$_POST = XSSPrevention($_POST, $whitelist);
// runs all variables thru sqlescape string
$_POST = escapeString($conn, $_POST);

// declares variable length in chars for each item. 
$maxlengtharray['header'] = 65;
$maxlengtharray['notificationtext'] = 200;
$maxlengtharray['severe'] = 6;
$maxlengtharray['type'] = 11;
$maxlengtharray['usernametosend'] = 60; // number should be 8 chars long only (SQL allows 45)

// bufferflag and emptyflag return false (undesired) if length of item and item are not agreeable
$bufferflag = empty(checkLength($_POST, $maxlengtharray));
$emptyflag = empty(checkEmpty($_POST, ['header', 'notificationtext', 'severe', 'type']));

if (!($bufferflag && $emptyflag)) {
    header("location: https://www.swapamc.com/swapproj/addnotification?error=missing");
    exit;
}


$notificationheader = $_POST['header'];
$notificationtext = $_POST['notificationtext'];
$notificationsevere = $_POST['severe'];
$notificationtype = $_POST['type'];



if (badInput([$notificationheader, $notificationtype, $notificationsevere, $notificationtext]) == true) {
    header("location: https://www.swapamc.com/swapproj/addnotification?error=malicious");
    exit;
}


if (!isset($_POST['usernametosend']) || $_POST['usernametosend'] == null) {
    //they wanna broadcast
    $useridtosend = 0;
} else {
    $usernametosend = $_POST['usernametosend'];

    if (badInput([$usernametosend]) == true) {
        header("location: https://www.swapamc.com/swapproj/addnotification?error=malicious");
        exit;
    }


    //does id exist
    try {
        $query = $conn->prepare("SELECT user_id FROM mydb.users WHERE user_username = ?");
        $query->bind_param('s',$usernametosend);
        if ($query === false) {
            //change filename accordingly
            throw new Exception("Statement Preparation failed(notification)");
        }
    } catch (Exception $e) {
        error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR preparing statement (SELECT)", 0);
        header("location: https://www.swapamc.com/swapproj/addnotification?error=statement");
        exit;
    }



    // throws error "Statment Execution failed" when statement fails
    try {
        $execute = $query->execute();
        if ($execute === false) {
            throw new Exception("Statement Execution failed (notification)");
        }
    } catch (Exception $e) {
        error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR executing statement (SELECT)", 0);
        header("location: https://www.swapamc.com/swapproj/addnotification?error=statement");
        exit;
    }


    $result = $query->get_result();
    $array = $result->fetch_all(MYSQLI_ASSOC);

    if (sizeof($array) < 1) {
        header("location: https://www.swapamc.com/swapproj/addnotification?error=usernamewrong");
        exit;
    } else {

        $useridtosend = $array[0]['user_id'];
    }
}


$validsevere = ['Low', 'Medium', 'High'];
$validtypes = ['Maintenance', 'Warning', 'Others'];

if (validTypes($notificationsevere, $validsevere) == false) {
    //not valid
    header("location: https://www.swapamc.com/swapproj/addnotification?error=invalidinfo");
    exit;
} else {
    if ($notificationsevere == 'Low') {
        $notificationsevere = 0;
    } else if ($notificationsevere == 'Medium') {
        $notificationsevere = 1;
    } else if ($notificationsevere == 'High') {
        $notificationsevere = 2;
    }
}



if (validTypes($notificationtype, $validtypes) == false) {
    //not valid
    header("location: https://www.swapamc.com/swapproj/addnotification?error=invalidinfo");
    exit;
} else {
    if ($notificationtype == 'Maintenance') {
        $notificationtype = 0;
    } else if ($notificationtype == 'Warning') {
        $notificationtype = 1;
    } else if ($notificationtype == 'Others') {
        $notificationtype = 2;
    }
}






//add
try {
    $query = $conn->prepare("INSERT INTO mydb.notification (user_id,notification,header,level,type) VALUES (');");
    $query ->bind_param('issii',$useridtosend,$notificationtext,$notificationheader,$notificationsevere,$notificationtype);
    if ($query === false) {
        //change filename accordingly
        throw new Exception("Statement Preparation failed(notification)");
    }
} catch (Exception $e) {
    error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR preparing statement (INSERT)", 0);
    header("location: https://www.swapamc.com/swapproj/addnotification?error=statement");
    exit;
}



// throws error "Statment Execution failed" when statement fails
try {
    $execute = $query->execute();
    if ($execute === false) {
        throw new Exception("Statement Execution failed (notification)");
    }
} catch (Exception $e) {
    error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR executing statement (INSERT)", 0);
    header("location: https://www.swapamc.com/swapproj/addnotification?error=statement");
    exit;
}

header("location: https://www.swapamc.com/swapproj/addnotification?error=none");
