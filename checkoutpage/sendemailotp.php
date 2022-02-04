<?php



use PHPMailer\PHPMailer\PHPMailer;
require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/phpmailer/includes/SMTP.php';
require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/phpmailer/includes/PHPMailer.php';
require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/phpmailer/includes/Exception.php';
$jwtarray = jwtdecrypt();
$jwtarrayinformation = $jwtarray['array'];


//NO INPUT FROM USER

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
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPOptions = array(
            'ssl' => array(
                'verify_peer' => false,
                'verify_peer_name' => false,
                'allow_self_signed' => true
            )
        );

        $mail->Host = $this->smtpHost;
        $mail->Port = $this->smtpPort;
        $mail->IsHTML(true);
        $mail->Username = $this->sender;
        $mail->Password = $this->password;
        $mail->Body = $this->getHTMLMessage();
        $mail->Subject = "Your verification code is {$this->code}";
        $mail->SetFrom($this->sender, "Verification Codes");
        $mail->AddAddress($this->receiver);
        if ($mail->send()) {
            // echo "MAIL SENT SUCCESSFULLY";
        } else {
            // echo "FAILED TO SEND MAIL";
        }
    }
    public function getVerificationCode()
    {
        return (int) substr(number_format(time() * rand(), 0, '', ''), 0, 6);
    }

    public function getHTMLMessage()
    {

        // Might want to use some if else statements here if we want to have time limit. 
        // the following code is the generation of the email format including the code, so if we want to send an email
        // without the new code we will probably need if else statements here too
        $this->code = $this->getVerificationCode();
        require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/auth/pages.php';
        require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';

        $jwtarray = jwtdecrypt();
        if (isset($jwtarray) && $jwtarray == true) {

            ## use $jwtinformation["key"] to retrieve the values 
            ## keys and values can be viewed on campus.php page
            $jwtarrayinformation = $jwtarray['array'];
            $jwtarrayinformation["emailotp"] = $this->code;
            $jwtarrayinformation["emailotptime"] = $_SERVER["REQUEST_TIME"];
            $htmlMessage = "
        <!DOCTYPE html>
        <html>
         <body>
            <h1>Your verification code is {$this->code}.</h1><br>
            <p>Use this code to verify your account to continue checkout.</p>
         </body>
        </html>
        ";
        jwtupdate($jwtarrayinformation);
        
    
            return $htmlMessage;
        } else {

            header("location: https://www.swapamc.com/swapproj/checkout?error=invalidemail");
            
        }
    }
}
// $vc = new VerificationCode($email);
// $vc->sendMail(); // MAIL SENT SUCCESSFULLY




?>