

<?php
use PHPMailer\PHPMailer\PHPMailer;
require 'includes/Exception.php';
require 'includes/PHPMailer.php';
require 'includes/SMTP.php';


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
        
        $this->sender = "swapamcproj@gmail.com";
        
        
        $this->password = "Swappy123123";
        
      
        $this->receiver = $receiver;
        
     
        $this->smtpHost="smtp.gmail.com";
        
     
        $this->smtpPort = 587;
        
    }
   public function sendMail(){
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
        $mail->Body=$this->getHTMLMessage();
        $mail->Subject = "Your verification code is {$this->code}";
        $mail->SetFrom($this->sender,"Verification Codes");
        $mail->AddAddress($this->receiver);
        if($mail->send()){
            echo "MAIL SENT SUCCESSFULLY";
        
        }else{
            echo "FAILED TO SEND MAIL";
        }
        

        
    }
    public function getVerificationCode()
    {
        return (int) substr(number_format(time() * rand(), 0, '', ''), 0, 6);
    }
    
    public function getHTMLMessage(){
        $this->code=$this->getVerificationCode();
        session_start();
        $_SESSION["emailotp"]=$this->code;
        $htmlMessage="
        <!DOCTYPE html>
        <html>
         <body>
            <h1>Your verification code is {$this->code}.</h1><br>
            <p>Use this code to verify your account.</p>
         </body>
        </html>
        ";
        return $htmlMessage;
    }
    
}

///move to functions.inc.php
// // pass your recipient's email
$vc=new VerificationCode('');
$vc->sendMail(); // MAIL SENT SUCCESSFULLY

//feed user email to function above^^




//create input box for OTP
//create columns to store OTP in database for comparing
//create column to store secret for google auth
//include_once ../phpmailer/index.php in login.inc.php (returned errornned to find how to fix)
//test if email received from user clicking login

?>

