<?php
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/product/includes/productfunctions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/auth/pages.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
$filename = basename(__FILE__, '.php'); // filename variable is now set as allstores for example
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/functions.inc.php';

function checkId($array)
    {
    // $pattern = "/^[a-zA-Z0-9_ ]*$/i";
    // checks for anything that is not from the following list
    $pattern = "/^[0-9]+$/i";

    foreach($array as $key => $value) {
        
        $a = !(preg_match($pattern, $value));

        if ($a == 1) {
            return true;
        }
    }

    return false;

    //0 is valid input

    }
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

$jwtarray = jwtdecrypt();
if(isset($jwtarray)&&$jwtarray==true){
    
    $jwtarrayinformation = $jwtarray['array'];

} else {
    header("location: https://www.swapamc.com/swapproj/logout");
    exit();
}

$useridsignedin = $jwtarrayinformation['userid'];


$productid=$jwtarrayinformation['productid'];


// foreach ($_POST as $key => $value) {
//     $postinformation[$key] = $value;
// }

//check get data
//check if get data is empty/malicious
// $information_needed = ['comment','id'];

// for($i=0;$i<sizeof($information_needed);$i++){
//     if(isset($_POST[$information_needed[$i]])&&$_POST[$information_needed[$i]]!=null){
//         if(badInputTwo([$_POST[$information_needed[$i]]])==1){
//             header("location: https://www.swapamc.com/swapproj/allproducts/product?id=".$jwtarrayinformation['productid']."&error=malicious");
//             exit();
//         }

//     } else {
//         header("location: https://www.swapamc.com/swapproj/allproducts/product?id=".$jwtarrayinformation['productid']."&error=emptyinfo");
//         exit();

//     }
// }

// $comment = $_POST['comment'];

// if(isset($_POST['rating'])&&$_POST['rating']!=null){
//     $rating = $_POST['rating'];
//     if(badInputTwo([$rating])==1){
//         header("location: https://www.swapamc.com/swapproj/allproducts/product?id=".$jwtarrayinformation['productid']."&error=malicious");
//         exit();
//     }
// } else {
//     $rating = 5;
//     //default to 5 star
// }

// $id = $_POST['id'];






$whitelist=['id','comment'];
$maxlengtharray['id']=11;
$maxlengtharray['comment']=255;
$methd = $_POST;
$empty = checkEmpty($methd,$whitelist);

if($empty!=null){
    header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid&error=empty$empty");
    exit();
} 

$validarray = XSSPrevention($methd,$whitelist);
$validarray = escapeString($conn,$validarray);


if(checkId([$validarray['id']])!=false){
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


$comment=$validarray['comment'];
$id=$validarray['id'];




//rating, which can be optional(since admins dont need to rate)
if(isset($_POST['rating'])&&$_POST['rating']!=null){
    $whitelist=['rating'];
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

    if(checkLength($validarray,$maxlengtharray)!=null){   
        $checklen=checkLength($validarray,$maxlengtharray );
        header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid&error=$checklen"."toolong");
        exit();
    }
    
    $rating=$validarray['rating'];
    
} else {
    $rating =5;
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






























// //check image properly
if(isset($_FILES['image'])&&$_FILES['image']!=null&&$_FILES['size']!=0){
    
    $error = $_FILES['image']['error'];
    if($error===1){
        header("location: https://www.swapamc.com/swapproj/allproducts/product?id=".$jwtarrayinformation['productid']."&error=unknown");
        exit();
        
    } else {
        $img_name = $_FILES['image']['name'];
        $img_size = $_FILES['image']['size'];
        $tmp_name = $_FILES['image']['tmp_name'];

    }
    
} else {
    $imageempty = 1;
    
    // header("location: https://www.swapamc.com/swapproj/allproducts/product?id=".$jwtarrayinformation['productid']."&error=unknown");
    // exit();
}

//can user edit the specifi review

//check if user allowed to edit review x


try {
    $query=$conn->prepare("SELECT mydb.users.user_id FROM mydb.reviews INNER JOIN mydb.users ON mydb.reviews.review_user_id = mydb.users.user_id 
    WHERE review_id = ?;");
    $query->bind_param('s',$id);
    
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


//was there interception?

$query->bind_result($uid);

if($query->fetch()){

    if(!$useridsignedin==$uid){
        error_log("TPAMC:".$filename.":4:$ipadd:3 Malicious Attempt", 0);
        header("location: https://www.swapamc.com/swapproj/allproducts/product?id=".$jwtarrayinformation['productid']."&error=intruder");
        exit();

    }
    
}


    


$query->close();



if(isset($imageempty)&&$imageempty==1){
    //if user dont want to upload image
    $edited=1;
    
    try {
        $query=$conn->prepare("UPDATE mydb.reviews SET review_comment = ?, review_rating = ?, edited = ? WHERE review_id=?");
        $query->bind_param('ssss',$comment,$rating,$edited,$id);
        
        if ($query === false) {
            //change filename accordingly
            throw new Exception("Statement Preparation failed");
        }
    } catch (Exception $e) {
        error_log("TPAMC:".$filename.":3:$ipadd:1 ERROR preparing statement (UPDATE)", 0);
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
        error_log("TPAMC:".$filename.":3:$ipadd:1 ERROR executing statement (UPDATE)", 0);
        header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid&error=sqlfailed");
                exit();
    }

    header("location: https://www.swapamc.com/swapproj/allproducts/product?id=".$jwtarrayinformation['productid']);

    
    
    // if($query->execute()){
    //     echo "Success";
        

    // } else {
    //     $em = 'Something went wrong';
    //     header("location: https://www.swapamc.com/swapproj/allproducts/product?id=".$jwtarrayinformation['productid']."&error=somethingwentwrong");
    //     exit();
    // }







    

} else {

    
    if ($img_size > 3025000) {
        header("location: https://www.swapamc.com/swapproj/allproducts/product?id=".$jwtarrayinformation['productid']."&error=filetoobig");
        exit();
    }else {
        $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
        $img_ex_lc = strtolower($img_ex);
    
        $allowed_exs = array("jpg", "jpeg", "png"); 
    
        if (in_array($img_ex_lc, $allowed_exs)) {
            $new_img_name = uniqid("IMG-", true).'.'.$img_ex_lc;
            $img_upload_path = 'uploads/'.$new_img_name;
            move_uploaded_file($tmp_name, $img_upload_path);
    
            
            
    
           
    
            // $query=$conn->prepare("UPDATE mydb.reviews SET review_comment = '$comment', review_rating = '$rating', review_pic = '$img_upload_path', edited = '1' WHERE review_id='$id'");
            
            
            
            $edited=1;
            
            try {
                $query=$conn->prepare("UPDATE mydb.reviews SET review_comment = ?, review_rating = ?, edited = ? WHERE review_id=?");
                $query->bind_param('ssss',$comment,$rating,$edited,$id);
                
                if ($query === false) {
                    //change filename accordingly
                    throw new Exception("Statement Preparation failed");
                }
            } catch (Exception $e) {
                error_log("TPAMC:".$filename.":3:$ipadd:1 ERROR preparing statement (UPDATE)", 0);
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
                error_log("TPAMC:".$filename.":3:$ipadd:1 ERROR executing statement (UPDATE)", 0);
                header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid&error=sqlfailed");
                        exit();
            }

            // echo "Success";
            header("location: https://www.swapamc.com/swapproj/allproducts/product?id=".$jwtarrayinformation['productid']);

            
            
        } else {
            header("location: https://www.swapamc.com/swapproj/allproducts/product?id=".$jwtarrayinformation['productid']."&error=badfile");
            exit();
        }
    }
    

}


























