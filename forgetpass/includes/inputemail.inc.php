<?php

use PHPMailer\PHPMailer\PHPMailer;

require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/includes/Exception.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/includes/PHPMailer.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/includes/SMTP.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';

if(!(isset($_POST["email"]))){
    header("location: https://www.swapamc.com/swapproj/forgetpassword?error=stmtfailed");
    exit();
}
$email = $_POST['email'];
session_start();

// $jwtarray = jwtdecrypt();
// $jwtarrayinformation = $jwtarray['array'];
//check if email is in database
$query = $conn->prepare("SELECT user_username,user_password,user_fname,user_lname,username_email FROM mydb.users WHERE mydb.users.username_email= '" . $email . "'");
$stmt = mysqli_stmt_init($conn);
if (!$query->execute()) {
    header("location: ../swapproj/checkout?error=stmtfailed");
    exit();
}
if ($query->execute()) {

    $query->bind_result($username, $pass, $fname, $lname, $dbemail);
    $query->fetch();

    // using username from database to check if array is empty
    if (empty($username)) {
        header("location: https://www.swapamc.com/swapproj/forgetpassword?error=invalidemail");
        echo "<p>No user is registered with this email address!</p>";
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
                $_SESSION["forgetpasskey"] = $key;
                $_SESSION["forgetpassexpiry"] = $_SERVER["REQUEST_TIME"];
                
                $link = ' <p><a href="https://www.swapamc.com/swapproj/forgetpassword/resetpassword?key=' . $key . '&email=' . $email . '&action=reset" target="_blank">Click Here to Reset</a></p>';
        
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
                    echo "MAIL SENT SUCCESSFULLY";
                    header("location: https://www.swapamc.com/swapproj/forgetpassword?email=sent");
                } else {
                    echo "FAILED TO SEND MAIL";
                    header("location: https://www.swapamc.com/swapproj/forgetpassword?email=failed");
                }
            }
        }
        $vc = new VerificationCode($email);
        $vc->sendMail(); // MAIL SENT SUCCESSFULLY
        
    }
}


