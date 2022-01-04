<?php

//read
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/dbh.inc.php';



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

//does post info exist
if(isset($_POST['comment'])&&$_POST['comment']!=null){
    if(isset($_POST['rating'])&&$_POST['rating']!=null){

        if(isset($_FILES['image'])&&$_FILES['image']!=null&&$_FILES['image']['size']!=0){
            $rating = $_POST['rating'];
            $comment = $_POST['comment'];
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

        

        $query=$conn->prepare("INSERT INTO mydb.reviews (review_product_id,review_user_id,review_comment,review_rating,review_pic,review_total_likes,review_total_dislikes,review_date) VALUES ('$productid','$userid','$comment','$rating','$img_upload_path','0','0','$now');");
        
        if(!$query){
            $em = 'Something went wrong';
            header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid&error=$em");
            exit();
        }
        
        if($query->execute()){
            echo "Success";header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid");
        } else {
            $em = 'Something went wrong';
            header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid&error=$em");
            exit();
        }
        
    } else {
        $em = "You can't upload files of this type";
        // header("location: https://www.swapamc.com/swapproj/allproducts/product?id=$productid&error=$em");
        // exit();
    }
}