<?php

//read
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
function checkRating($array)
{
    // $pattern = "/^[a-zA-Z0-9_ ]*$/i";
    // checks for anything that is not from the following list
    $pattern = "/^[1-5]{1}$/i";

    foreach($array as $key => $value) {
        
        $a = !(preg_match($pattern, $value));

        if ($a == 1) {
            return true;
        }
    }

    return false;

    //0 is valid input

}


//does token exist
$jwtarray = jwtdecrypt();
if(isset($jwtarray)&&$jwtarray==true){
    
    $jwtarrayinformation = $jwtarray['array'];
    $productid = $jwtarrayinformation['productid'];
    $userid = $jwtarrayinformation['userid'];
} else {
    header("location: https://www.swapamc.com/swapproj/logout");
    exit();
}



$productid=$jwtarrayinformation['productid'];
//check if quantity valid
$whitelist=['comment','rating'];
$maxlengtharray['comment']=255;
$maxlengtharray['rating']=1;
$methd = $_POST;
$empty = checkEmpty($methd,$whitelist);

if($empty!=null){
    header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid&error=empty$empty");
    exit();
} 

$validarray = XSSPrevention($methd,$whitelist);
$validarray = escapeString($conn,$validarray);


if(checkRating([$validarray['rating']])!=false){
    error_log("TPAMC:".$filename.":4:$ipadd:2 Malicious input", 0);
    header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid&error=badrating");
    exit();
}

if(badInputTwo([$validarray['comment']])!=false){
    error_log("TPAMC:".$filename.":4:$ipadd:2 Malicious input", 0);
    header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid&error=badcomment");
    exit();
}


if(checkLength($validarray,$maxlengtharray)!=null){   
    $checklen=checkLength($validarray,$maxlengtharray );
    header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid&error=$checklen"."toolong");
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





$rating = $validarray['rating'];
$comment = $validarray['comment'];





//does post info exist
if(isset($_POST['comment'])&&$_POST['comment']!=null){
    if(isset($_POST['rating'])&&$_POST['rating']!=null){

        if(isset($_FILES['image'])&&$_FILES['image']!=null&&$_FILES['image']['size']!=0){
            
            $error = $_FILES['image']['error'];
            if($error===1){
                header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid&error=uunknown");
                exit;
            } else {
                $img_name = $_FILES['image']['name'];
	            $img_size = $_FILES['image']['size'];
	            $tmp_name = $_FILES['image']['tmp_name'];
                
	
            }
            
        } else {
            
            header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid&error=imageempty");
            exit;
        }
        
        

    } else {
        
        header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid&error=ratingempty");
        exit;
        
    }
} else {

    header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid&error=empty");
    exit;
    
}






//is injection/xss detected
if(badInputTwo([$rating,$comment])==1){
    header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid&error=malicious");
}






if ($img_size > 3025000) {
    $em = "filetoolarge";
    header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid&error=$em");
}else {
    $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
    $img_ex_lc = strtolower($img_ex);

    $allowed_exs = array("jpg", "jpeg", "png"); 

    if (in_array($img_ex_lc, $allowed_exs)) {

        $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
        $img_upload_path = 'uploads/'.$new_img_name;


        
            //image is valid


        //resize image. after resize, isit an actual image/
        if($img_ex_lc=='jpg' || $img_ex_lc=='jpeg'){

            try {
                $image = imagecreatefromjpeg($tmp_name);

                if($image==null){
                    //image malicious
                    header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid&error=badimage");
                    exit();
                } else {
                    $imgResized = imagescale($image , 500, 400);
                    imagejpeg($imgResized, $img_upload_path);

                }
                
                
            } catch (Exception $e) {
                
                echo 'Message: ' . $e->getMessage();
                header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid&error=badimage");
                exit();
                
            }
            
            

            
            

            


        } elseif ($img_ex_lc == 'png'){

            try {
                $image = imagecreatefrompng($tmp_name);

                if($image==null){
                    header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid&error=badimage");
                    exit();

                } else {
                    $imgResized = imagescale($image , 500, 400);
                    imagepng($imgResized, $img_upload_path);

                }
                
                
            } catch (Exception $e) {
                echo 'Message: ' . $e->getMessage();
                header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid&error=badimage");
                exit();
                
                
            }
            
        }

        

        




        
        
        // move_uploaded_file($image, $img_upload_path);

        date_default_timezone_set('Asia/Singapore');
        $now = time();
        $now = date('Y-m-d', $now)." ".date('H:i:s');

        
        //cant directly pass in 0 in mysql
        $zero=0;
        
        try {
            $query=$conn->prepare("INSERT INTO mydb.reviews (review_product_id,review_user_id,review_comment,review_rating,
            review_pic,review_total_likes,review_total_dislikes,review_date) 
            VALUES (?,?,?,?,?,?,?,?);");
            $query->bind_param('ssssssss',$productid,$userid,$comment,$rating,$img_upload_path,$zero,$zero,$now);
            
            if ($query === false) {
                //change filename accordingly
                throw new Exception("Statement Preparation failed");
            }
        } catch (Exception $e) {
            error_log("TPAMC:".$filename.":3:$ipadd:1 ERROR preparing statement (SELECT)", 0);
            //change header location accordingly
            header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid&error=sqlfailed");
                exit();
        }
        
        // throws error "Statment Execution failed" when statement fails
        try {
            $execute = $query->execute();
            if ($execute === false) {
                throw new Exception("Statement Execution failed");
            }
        } catch (Exception $e) {
            error_log("TPAMC:".$filename.":3:$ipadd:1 ERROR executing statement (SELECT)", 0);
            header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid&error=sqlfailed");
                exit();
        }



        echo "Success";
        header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid");

        
        
        
    } else {
        $em = "You can't upload files of this type";
        header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid&error=$em");
        exit();
    }
}