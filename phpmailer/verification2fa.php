

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

    // Might want to use some if else statements here if we want to have time limit. 
    // the following code is the generation of the email format including the code, so if we want to send an email
    // without the new code we will probably need if else statements here too
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


$vc=new VerificationCode('');
$vc->sendMail(); // MAIL SENT SUCCESSFULLY

?>

