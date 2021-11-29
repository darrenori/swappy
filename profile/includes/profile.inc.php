<?php
function notEmpty($array)
{
    for ($i = 0; $i < sizeof($array); $i++) {
        if ($array[$i] == "" || $array[$i] == null) {
            return false;
        }
    }

    return true;
}

function invalidEmail($email)
{
    $result = false;
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $result = true;
    } else {
        $result = false;
    }
    return $result;

    //false means good input
}



function usernameExists($conn, $username,$id)
{
    $query = $conn->prepare("SELECT user_id FROM mydb.users WHERE user_username = '$username'");
    $uid='';
    


    if($query->execute()){
        $query->bind_result($uid);
        if($query->fetch()){

            if(isset($uid)){
                if($uid!=$id){
                    return true;
                    //username already exists
                }
            }
            

            
            
        }
    }
    
    

    
}


function emailExists($conn, $email,$id)
{
    $query = $conn->prepare("SELECT user_id FROM mydb.users WHERE username_email = '$email'");
    $uid='';


    if($query->execute()){
        $query->bind_result($uid);
        if($query->fetch()){

            if(isset($uid)){
                if($uid!=$id){
                    return true;
                    //username already exists
                }
            }
            

            
            
        }
    }
    

}

function badInput($array){
    $pattern = "/^(?=.{1,30}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$/i";

    for($i=0;$i<sizeof($array);$i++){
        $input = $array[$i];
        $a = !(preg_match($pattern,$input));

        if($a==1){
            return true;
        }
    }
    
    return false;

    //0 is valid input


}





?>
