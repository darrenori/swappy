<?php

use PHPMailer\PHPMailer\PHPMailer;

require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/includes/Exception.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/includes/PHPMailer.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/includes/SMTP.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';

### CSRF ####
if(validateCSRF()==false){
    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  
  
    if($actual_link=="http://www.swapamc.com/swapproj/campus?error=badcsrf"){
        echo 'bad csrf';
        //dont redirect if on the same page
  
    } else {
        header("location: https://www.swapamc.com/swapproj/campus?error=badcsrf");
        exit;
    }
}
### CSRF ####

if(!(isset($_POST["email"]))){
    header("location: https://www.swapamc.com/swapproj/forgetpassword?error=invalidemail");
    exit();
}
// removes any other GET and POST names and does html specialchars
$whitelist =['email'];
$_POST = XSSPrevention($_POST, $whitelist);
// runs all variables thru sqlescape string
$_POST = escapeString($conn, $_POST);
// declares variable length in chars for each item. 
$maxlengtharray['email'] = 200;


// bufferflag and emptyflag return false (undesired) if length of item and item are not agreeable
$bufferflag = empty(checkLength($_POST, $maxlengtharray));
$emptyflag = empty(checkEmpty($_POST, ['email']));

if (!($bufferflag && $emptyflag)) {
    header("location: https://www.swapamc.com/swapproj/forgetpassword?error=invalidemail");
    exit();
}



$email = $_POST['email'];


//check if email is in database
$query = $conn->prepare("SELECT user_username,user_password,user_fname,user_lname,username_email FROM mydb.users WHERE mydb.users.username_email= ?");
$query->bind_param('s',$email);
if (!$query->execute()) {
    error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR preparing statement (SELECT)", 0);
    header("location: https://www.swapamc.com/swapproj/forgetpassword?error=failed");
    exit();
}


if ($query->execute()) {

    $query->bind_result($username, $pass, $fname, $lname, $dbemail);
    $query->fetch();


    // using username from database to check if array is empty
    if (empty($username)) {
        header("location: https://www.swapamc.com/swapproj/forgetpassword?error=invalidemail");
        // echo "<p>No user is registered with this email address!</p>";
    } else {


        class VerificationCode
        {

            public $smtpHost;
            public $smtpPort;
            public $sender;
            public $password;
            public $receiver;
            public $code;


            public function __construct($receiver)
            {

                $this->sender = "swapamcproj1@gmail.com";


                $this->password = "Swappy123123";


                $this->receiver = $receiver;


                $this->smtpHost = "smtp.gmail.com";


                $this->smtpPort = 587;
            }
            public function sendMail()
            {
                $email = $_POST['email'];
                $_SESSION["forgetpassemail"] = $email;
                $key =  substr(md5(uniqid(rand(), 1)), 1, 1000);
                $_SESSION["forgetpasskey"] = $key; echo $key."<br>";
                $_SESSION["forgetpassexpiry"] = $_SERVER["REQUEST_TIME"];

                $link = ' <p><a href="https://www.swapamc.com/swapproj/forgetpassword/resetpassword?key=' . $key . '&email=' . $email . '&action=reset" target="_blank">Click Here to Reset '.$key.'</a></p>';
                echo $key."<br>";
                $mail = new PHPMailer();
                $mail->IsSMTP();
                $mail->SMTPDebug = 2;
                $mail->SMTPAuth = true;
                $mail->SMTPOptions = array(
                    'ssl' => array(
                        'verify_peer' => false,
                        'verify_peer_name' => false,
                        'allow_self_signed' => true
                    )
                );
                $mail->CharSet =  "utf-8";
                $mail->Host = $this->smtpHost;
                $mail->Port = $this->smtpPort;
                $mail->IsHTML(true);
                $mail->Username = $this->sender;
                $mail->Password = $this->password;
                $mail->Body = ($link);
                $mail->Subject = "Password Recovery";
                $mail->SetFrom($this->sender);
                $mail->AddAddress($this->receiver);
                if ($mail->send()) {
                    header("location: https://www.swapamc.com/swapproj/forgetpassword?email=sent");
                } else {
                    header("location: https://www.swapamc.com/swapproj/forgetpassword?email=failed");
                }
            }
        }
        $vc = new VerificationCode($email);
        $vc->sendMail(); // MAIL SENT SUCCESSFULLY

    }
}