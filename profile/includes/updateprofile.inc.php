<?php
## Originally updateprofile and outside includes


//echo "edit";
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/profile/includes/profilefunctions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/functions.inc.php';


$userid = $jwtarrayinformation["userid"];


foreach ($_POST as $key => $value) {
    //echo "$key = $value<br>";

    if ($key != "submit") {
        $postinformation[$key] = $value;
    }
}



if(isset($_POST['username'])&&$_POST['fname']&&$_POST['lname']&&$_POST['email']&&$_POST['number']){
    $username = $postinformation['username'];
    $fname = $postinformation['fname'];
    $lname = $postinformation['lname'];
    $email = $postinformation['email'];
    $number = $postinformation['number'];
}









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

if (badUserInput([$username, $fname, $lname, $number])) {
    echo "stop trying to hack the website please!";
    //header
}





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
                    

                    header("location: https://www.swapamc.com/swapproj/campus");
            }
        }
    }
}
