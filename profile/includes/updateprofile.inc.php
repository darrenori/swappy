<?php
## Originally updateprofile and outside includes


//checkusername
function checkUsername($array)
{
    // $pattern = "/^[a-zA-Z0-9_ ]*$/i";
    // checks for anything that is not from the following list
    $pattern = "/^[a-zA-Z]+$/i";

    foreach($array as $key => $value) {
        
        $a = !(preg_match($pattern, $value));

        if ($a == 1) {
            return true;
        }
    }

    return false;

    //0 is valid input

}


//checklastname,firstname
function checkNames($array)
{
    // $pattern = "/^[a-zA-Z0-9_ ]*$/i";
    // checks for anything that is not from the following list
    $pattern = "/^[a-zA-Z ]+$/i";

    foreach($array as $key => $value) {
        
        $a = !(preg_match($pattern, $value));

        if ($a == 1) {
            return true;
        }
    }

    return false;

    //0 is valid input

}



//check number
function checkMobileNumber($array)
{
    // $pattern = "/^[a-zA-Z0-9_ ]*$/i";
    // checks for anything that is not from the following list
    $pattern = "/(6|8|9)\d{7}/";

    foreach($array as $key => $value) {
        
        $a = !(preg_match($pattern, $value));

        if ($a == 1) {
            return true;
        }
    }

    return false;

    //0 is valid input

}


//echo "edit";
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/profile/includes/profilefunctions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
$filename = basename(__FILE__, '.php'); // filename variable is now set as allstores for example
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/functions.inc.php';

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

$userid = $jwtarrayinformation["userid"];


foreach ($_POST as $key => $value) {
    //echo "$key = $value<br>";

    if ($key != "submit") {
        $postinformation[$key] = $value;
    }
}




//check if quantity valid
$whitelist=['username','fname','lname','email','number'];
$maxlengtharray['username']=60;
$maxlengtharray['fname']=60;
$maxlengtharray['lname']=60;
$maxlengtharray['email']=200;
$maxlengtharray['number']=45;
$methd = $_POST;
$empty = checkEmpty($methd,$whitelist);

if($empty!=null){
    header("location: https://www.swapamc.com/swapproj/userprofile?error=empty".$empty);
    exit();
} 

$validarray = XSSPrevention($methd,$whitelist);
$validarray = escapeString($conn,$validarray);


if(checkUsername([$validarray['username']])!=false){
    error_log("TPAMC:".$filename.":4:$ipadd:2 Malicious input", 0);
    header("location: https://www.swapamc.com/swapproj/userprofile?error=badusername");
    exit();
}
if(checkNames([$validarray['fname']])!=false){
    error_log("TPAMC:".$filename.":4:$ipadd:2 Malicious input", 0);
    header("location: https://www.swapamc.com/swapproj/userprofile?error=badfname");
    exit();
}
if(checkNames([$validarray['lname']])!=false){
    error_log("TPAMC:".$filename.":4:$ipadd:2 Malicious input", 0);
    header("location: https://www.swapamc.com/swapproj/userprofile?error=badlname");
    exit();
}

if(invalidEmail($validarray['email'])==true){
    error_log("TPAMC:".$filename.":4:$ipadd:2 Malicious input", 0);
    header("location: https://www.swapamc.com/swapproj/userprofile?error=bademail");
    exit();
}

if(checkMobileNumber([$validarray['number']])!=false){
    error_log("TPAMC:".$filename.":4:$ipadd:2 Malicious input", 0);
    header("location: https://www.swapamc.com/swapproj/userprofile?error=badnumber");
    exit();
}



if(checkLength($validarray,$maxlengtharray)!=null){   
    $toolong=checkLength($validarray,$maxlengtharray);
    header("location: https://www.swapamc.com/swapproj/userprofile?error=toolong".$toolong);
    exit();
}

if(validateCSRF()==false){
    $actual_link = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
  
  
    if($actual_link=="http://www.swapamc.com/swapproj/campus?error=badcsrf"){
        
        //dont redirect if on the same page
  
    } else {
        error_log("TPAMC:".$filename.":4:$ipadd:2 CSRF", 0);
        header("location: https://www.swapamc.com/swapproj/campus?error=badcsrf");
        exit;
    }
    
    
}


$username = $validarray['username'];
$fname = $validarray['fname'];
$lname = $validarray['lname'];
$email = $validarray['email'];
$number = $validarray['number'];










if(isset($_FILES['image'])&&$_FILES['image']!=null&&$_FILES['image']['size']!=0){
    $error = $_FILES['image']['error'];
    if($error===1){
        header("location: https://www.swapamc.com/swapproj/campus");
        exit;
    } else {
        $img_name = $_FILES['image']['name'];
        $img_size = $_FILES['image']['size'];
        $tmp_name = $_FILES['image']['tmp_name'];
        

    }
} else {
    $imageempty=1;
}

if($img_size>3025000){
    $em="filetoolarge";
    header("location: https://www.swapamc.com/swapproj/campus?error=filetoolarge");
} else {
    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
    $img_ex_lc = strtolower($img_ex);
    $allowed_exs = array("jpg", "jpeg", "png");

    


    if (in_array($img_ex_lc, $allowed_exs)) {
        $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
        $img_upload_path = 'uploads/'.$new_img_name;
    
        //resize image. after resize, isit an actual image/
        if($img_ex_lc=='jpg' || $img_ex_lc=='jpeg'){

            try {
                $image = imagecreatefromjpeg($tmp_name);

                if($image==null){
                    //image malicious
                    header("location: https://www.swapamc.com/swapproj/campus?error=badimage");
                    exit();
                } else {
                    $imgResized = imagescale($image , 500, 400);
                    imagejpeg($imgResized, $img_upload_path);

                }
                
                
            } catch (Exception $e) {
                
                echo 'Message: ' . $e->getMessage();
                header("location: https://www.swapamc.com/swapproj/campus?error=badimage");
                exit();
                
            }
            
            

            
            

            


        } elseif ($img_ex_lc == 'png'){

            try {
                $image = imagecreatefrompng($tmp_name);

                if($image==null){
                    header("location: https://www.swapamc.com/swapproj/campus?error=badimage");
                    exit();

                } else {
                    $imgResized = imagescale($image , 500, 400);
                    imagepng($imgResized, $img_upload_path);

                }
                
                
            } catch (Exception $e) {
                echo 'Message: ' . $e->getMessage();
                header("location: https://www.swapamc.com/swapproj/campus?error=badimage");
                exit();
                
                
            }
            
        }
    }
    
    


}






























$informationarray = [$username, $fname, $lname, $email, $number];







if (notEmpty($informationarray) == 1) {

    if (invalidEmail($email) == 0) {

        if (emailUserExists($conn, $email, $userid) == 0) {
            if (usernameUserExists($conn, $username, $userid) == 0) {

                try {
                        if($imageempty===1){
                            $query = $conn->prepare("UPDATE mydb.users SET user_username = '$username',
                            user_fname = '$fname',user_lname  = '$lname',user_number=  '$number',username_email = '$email'
                            WHERE user_id =$userid;");

                        } else {
                            $query = $conn->prepare("UPDATE mydb.users SET user_username = '$username',
                            user_fname = '$fname',user_lname  = '$lname',user_number=  '$number',username_email = '$email' ,user_profilepicture='$img_upload_path'
                            WHERE user_id =$userid;");
                        }
                        
                        if ($query === false) {
                            //change filename accordingly
                            throw new Exception("Statement Preparation failed(updateprofile.inc)");
                        }
                    } catch (Exception $e) {
                        echo 'Message: ' . $e->getMessage();
                        //change header location accordingly
                        header("location: https://www.swapamc.com/swapproj/userprofile?error=badstatement");
                        exit;
                    }
                    // throws error "Statment Execution failed" when statement fails
                    try {
                        $execute = $query->execute();
                        if ($execute === false) {
                            throw new Exception("Statement Execution failed (updateprofile.inc)");
                        }
                    } catch (Exception $e) {
                        echo 'Message: ' . $e->getMessage();
                        header("location: https://www.swapamc.com/swapproj/userprofile?error=badstatement"); //    echo mysqli_error($query);
                    
                        exit;
                    }

         
                    $jwtarrayinformation['username'] = $username;
                    if(isset($img_name)){
                        $jwtarrayinformation['profilepic'] = $img_upload_path;
                    }
                    $jwtarrayinformation['email'] = $email;

                    jwtupdate($jwtarrayinformation);
                    // exit;

                    header("location: https://www.swapamc.com/swapproj/campus");
            }
        }
    }
}
