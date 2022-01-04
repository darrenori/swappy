<?php 

function validTypes($testifreal,$array){
    for($i=0;$i<sizeof($array);$i++){
        if($testifreal==$array[$i]){
            return true;
        }
    }

    return false;
}

require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/manager/includes/employeefunctions.inc.php';

if (!isset($_POST)) {
    echo 'not correct type!';
    exit;
    
}

if(!isset($_POST['header'])||$_POST['header']==null||!isset($_POST['notificationtext'])||$_POST['notificationtext']==null){
    echo 'Information found was not present';
    header("location: https://www.swapamc.com/swapproj/addnotification?error=missing");
    exit;   
} else {
    $notificationheader = $_POST['header'];
    $notificationtext = $_POST['notificationtext'];

}

if(!isset($_POST['severe'])||$_POST['severe']==null||!isset($_POST['type'])||$_POST['type']==null){
    echo 'Information found was not present';
    header("location: https://www.swapamc.com/swapproj/addnotification?error=missing"); 
    exit;  
} else {
    $notificationsevere = $_POST['severe'];
    $notificationtype = $_POST['type'];


}

if(badInput([$notificationheader,$notificationtype,$notificationsevere,$notificationtext])==true){
    echo 'Malicious';
    header("location: https://www.swapamc.com/swapproj/addnotification?error=malicious"); 
    exit; 
}


if(!isset($_POST['usernametosend'])||$_POST['usernametosend']==null){
    //they wanna broadcast
    $useridtosend = 0; 
} else {
    $usernametosend = $_POST['usernametosend'];
    
    if(badInput([$usernametosend])==true){
        echo 'Malicious';
        header("location: https://www.swapamc.com/swapproj/addnotification?error=malicious"); 
        exit; 
    }


    //does id exist
    try {
        $query = $conn->prepare("SELECT user_id FROM mydb.users WHERE user_username = '$usernametosend'");
        if ($query === false) {
            //change filename accordingly
            throw new Exception("Statement Preparation failed(notification)");
        }
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
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
        echo 'Message: ' . $e->getMessage();
        header("location: https://www.swapamc.com/swapproj/addnotification?error=statement"); 
        exit;
    }


    $result = $query->get_result();
    $array = $result->fetch_all(MYSQLI_ASSOC);

    if(sizeof($array)<1){
        header("location: https://www.swapamc.com/swapproj/addnotification?error=usernamewrong"); 
        exit;

    } else {

        $useridtosend = $array[0]['user_id'];
    }

    
}


$validsevere = ['Low','Medium','High'];
$validtypes = ['Maintenance','Warning','Others'];

if(validTypes($notificationsevere,$validsevere)==false){
    //not valid
    header("location: https://www.swapamc.com/swapproj/addnotification?error=invalidinfo"); 
    exit;

} else {
    if($notificationsevere=='Low'){
        $notificationsevere = 0;
    } else if ($notificationsevere == 'Medium'){
        $notificationsevere = 1;
    } else if ($notificationsevere == 'High'){
        $notificationsevere = 2;
    }
}



if(validTypes($notificationtype,$validtypes)==false){
    //not valid
    header("location: https://www.swapamc.com/swapproj/addnotification?error=invalidinfo"); 
    exit;
} else {
    if($notificationtype=='Maintenance'){
        $notificationtype = 0;
    } else if ($notificationtype == 'Warning'){
        $notificationtype = 1;
    } else if ($notificationtype == 'Others'){
        $notificationtype = 2;
    }
}






//add
try {
    $query = $conn->prepare("INSERT INTO mydb.notification (user_id,notification,header,level,type) VALUES ('$useridtosend','$notificationtext','$notificationheader','$notificationsevere','$notificationtype');");
    if ($query === false) {
        //change filename accordingly
        throw new Exception("Statement Preparation failed(notification)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
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
    echo 'Message: ' . $e->getMessage();
    header("location: https://www.swapamc.com/swapproj/addnotification?error=statement"); 
    exit;
}

header("location: https://www.swapamc.com/swapproj/addnotification?error=none"); 

