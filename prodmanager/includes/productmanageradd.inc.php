<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';





if(!isset($_POST['name'])||$_POST['name']==null){
    header("location: https://www.swapamc.com/swapproj/productmanageradd?error=empty");
    exit();


}


if(!isset($_POST['price'])||$_POST['price']==null){
    header("location: https://www.swapamc.com/swapproj/productmanageradd?error=empty");
    exit();
    

}

if(!isset($_POST['about'])||$_POST['about']==null){
    header("location: https://www.swapamc.com/swapproj/productmanageradd?error=empty");
    exit();
    

}

if(!isset($_POST['storeid'])||$_POST['storeid']==null){
    header("location: https://www.swapamc.com/swapproj/productmanageradd?error=empty");
    exit();
    

}





$storeid = $_POST['storeid'];
$about = $_POST['about'];
$price= $_POST['price'];
$name = $_POST['name'];




if(badInputTwo([$about,$name])==true){
    
    
    header("location: https://www.swapamc.com/swapproj/productmanager?error=malicious");
    exit;
}


if(!is_numeric($price)||!is_numeric($storeid)){
    header("location: https://www.swapamc.com/swapproj/productmanager?error=wrongnumber");
    exit;
    
}


//check if productname already exists in store
try {
    $query = $conn->prepare("SELECT product_name FROM mydb.storeprod
    INNER JOIN mydb.products
    ON mydb.storeprod.product_id = mydb.products.product_id
    INNER JOIn mydb.store
    ON mydb.store.store_id = mydb.storeprod.store_id
    
    WHERE product_name='$name';");

    if ($query === false) {
        //change filename accordingly
        throw new Exception("Statement Preparation failed(productmanager)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    //change header location accordingly
    header("location: https://www.swapamc.com/swapproj/productmanager?error=stmt");
    exit;
}
// throws error "Statment Execution failed" when statement fails
try {
    $execute = $query->execute();
    if ($execute === false) {
        throw new Exception("Statement Execution failed (productmanager)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    header("location: https://www.swapamc.com/swapproj/productmanagererror=stmt");

    exit;
}



$result = $query->get_result();
$array = $result->fetch_all(MYSQLI_ASSOC);

if(sizeof($array)>0){
    //product already exists
    header("location: https://www.swapamc.com/swapproj/productmanager?error=namealreadyexists");

    exit;


}






$imagesarray=['imageone','imagetwo','imagethree'];
$productimages=[];


for($i=0;$i<sizeof($imagesarray);$i++){

    if(isset($_FILES[$imagesarray[$i]])&&$_FILES[$imagesarray[$i]]!=null&&$_FILES[$imagesarray[$i]]['size']!=0){
        $error = $_FILES[$imagesarray[$i]]['error'];
        if($error===1){
            header("location: https://www.swapamc.com/swapproj/productmanager?error=badimage");
            exit;
        } else {
            $img_name = $_FILES[$imagesarray[$i]]['name'];
            $img_size = $_FILES[$imagesarray[$i]]['size'];
            $tmp_name = $_FILES[$imagesarray[$i]]['tmp_name'];
            
    
        }








        if ($img_size > 10025000) {
            $em = "filetoolarge";
            header("location: https://www.swapamc.com/swapproj/productmanager?error=badimagesize");
            exit;
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
                            header("location: https://www.swapamc.com/swapproj/productmanager?error=badimagejpg");
                            exit;
                        } else {
                            $imgResized = imagescale($image , 500, 400);
                            imagejpeg($imgResized, $img_upload_path);
        
                        }
                        
                        
                    } catch (Exception $e) {
                        
                        echo 'Message: ' . $e->getMessage();
                        header("location: https://www.swapamc.com/swapproj/productmanager?error=badimagejpg");
                        exit;
                        
                    }
                    
                    
        
                    
                    
        
                    
        
        
                } elseif ($img_ex_lc == 'png'){
        
                    try {
                        $image = imagecreatefrompng($tmp_name);
        
                        if($image==null){
                            header("location: https://www.swapamc.com/swapproj/productmanager?error=badimagepng");
                            exit;
        
                        } else {
                            $imgResized = imagescale($image , 500, 400);
                            imagepng($imgResized, $img_upload_path);
        
                        }
                        
                        
                    } catch (Exception $e) {
                        echo 'Message: ' . $e->getMessage();
                        header("location: https://www.swapamc.com/swapproj/productmanager?error=badimagepng");
                        exit;
                        
                        
                    }
                    
                }
        
                
        
                
        
        
        
        
                
                
                // move_uploaded_file($image, $img_upload_path);
        
                date_default_timezone_set('Asia/Singapore');
                $now = time();
                $now = date('Y-m-d', $now)." ".date('H:i:s');

                array_push($productimages,$img_upload_path);
        
                
        
                
                
            } else {
                $em = "You can't upload files of this type";
                header("location: https://www.swapamc.com/swapproj/productmanager?error=badimagefiletype");
                exit;
            }
        }
        
    }


    









}






















$query->close();
session_start();
$_SESSION['addproduct'] = 'A';
$_SESSION['addproductinfo'] = [$name,$storeid,$about,$price];
$_SESSION['addproductimages'] = $productimages;

print_r($productimages);


header("location: https://www.swapamc.com/swapproj/productmanagertypes");








?>