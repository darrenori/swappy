<?php
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/product/includes/productfunctions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/auth/pages.php';

require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/functions.inc.php';

$jwtarray = jwtdecrypt();
if(isset($jwtarray)&&$jwtarray==true){
    
    $jwtarrayinformation = $jwtarray['array'];

} else {
    header("location: https://www.swapamc.com/swapproj/logout");
    exit();
}

$useridsignedin = $jwtarrayinformation['userid'];





foreach ($_POST as $key => $value) {
    $postinformation[$key] = $value;
}

//check get data
//check if get data is empty/malicious
$information_needed = ['comment','id'];

for($i=0;$i<sizeof($information_needed);$i++){
    if(isset($_POST[$information_needed[$i]])&&$_POST[$information_needed[$i]]!=null){
        if(badInputTwo([$_POST[$information_needed[$i]]])==1){
            header("location: https://www.swapamc.com/swapproj/allproducts/product?id=".$jwtarrayinformation['productid']."&error=malicious");
            exit();
        }

    } else {
        header("location: https://www.swapamc.com/swapproj/allproducts/product?id=".$jwtarrayinformation['productid']."&error=emptyinfo");
        exit();

    }
}

$comment = $_POST['comment'];

if(isset($_POST['rating'])&&$_POST['rating']!=null){

    

    
    $rating = $_POST['rating'];
    if(badInputTwo([$rating])==1){
        header("location: https://www.swapamc.com/swapproj/allproducts/product?id=".$jwtarrayinformation['productid']."&error=malicious");
        exit();
    }
    
    
} else {
    $rating = 5;
    //default to 5 star

    
    
    
}

$id = $_POST['id'];

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
$query = $conn->prepare("SELECT mydb.users.user_id FROM mydb.reviews INNER JOIN mydb.users ON mydb.reviews.review_user_id = mydb.users.user_id WHERE review_id = '$id';");

if(!$query){
    header("location: https://www.swapamc.com/swapproj/allproducts/product?id=".$jwtarrayinformation['productid']."&error=unknown");
    exit();
}


//was there interception?
if($query->execute()){
    $query->bind_result($uid);

    if($query->fetch()){

        if(!$useridsignedin==$uid){
            header("location: https://www.swapamc.com/swapproj/allproducts/product?id=".$jwtarrayinformation['productid']."&error=intruder");
            exit();

        }
        
    }


    
}

$query->close();



if(isset($imageempty)&&$imageempty==1){
    //if user dont want to upload image

    $query=$conn->prepare("UPDATE mydb.reviews SET review_comment = '$comment', review_rating = '$rating', edited = '1' WHERE review_id='$id'");
            
    if(!$query){
        header("location: https://www.swapamc.com/swapproj/allproducts/product?id=".$jwtarrayinformation['productid']."&error=somethingwentwrong");
        exit();
    }
    
    if($query->execute()){
        echo "Success";
        header("location: https://www.swapamc.com/swapproj/allproducts/product?id=".$jwtarrayinformation['productid']);

    } else {
        $em = 'Something went wrong';
        header("location: https://www.swapamc.com/swapproj/allproducts/product?id=".$jwtarrayinformation['productid']."&error=somethingwentwrong");
        exit();
    }









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
    
            
            
    
           
    
            $query=$conn->prepare("UPDATE mydb.reviews SET review_comment = '$comment', review_rating = '$rating', review_pic = '$img_upload_path', edited = '1' WHERE review_id='$id'");
            
            if(!$query){
                header("location: https://www.swapamc.com/swapproj/allproducts/product?id=".$jwtarrayinformation['productid']."&error=somethingwentwrong");
                exit();
            }
            
            if($query->execute()){
                echo "Success";
                header("location: https://www.swapamc.com/swapproj/allproducts/product?id=".$jwtarrayinformation['productid']);
    
            } else {
                $em = 'Something went wrong';
                header("location: https://www.swapamc.com/swapproj/allproducts/product?id=".$jwtarrayinformation['productid']."&error=somethingwentwrong");
                exit();
            }
            
        } else {
            header("location: https://www.swapamc.com/swapproj/allproducts/product?id=".$jwtarrayinformation['productid']."&error=badfile");
            exit();
        }
    }
    

}


























