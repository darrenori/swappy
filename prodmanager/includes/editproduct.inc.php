<?php

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

require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/images/showimage.php';



$whitelist=['id'];
$maxlengtharray['id']=11;
$methd = $_GET;
$empty = checkEmpty($methd,$whitelist);

if($empty!=null){
    header("location: https://www.swapamc.com/swapproj/productmanager?error=emptyid");
    exit;
} 

$validarray = XSSPrevention($methd,$whitelist);
$validarray = escapeString($conn,$validarray);


if(checkId([$validarray['id']])!=false){
    error_log("TPAMC:".$filename.":4:$ipadd:2 Malicious input", 0);
    header("location: https://www.swapamc.com/swapproj/productmanager?error=badid");
    exit;
}

if(checkLength($validarray,$maxlengtharray)!=null){   
    header("location: https://www.swapamc.com/swapproj/productmanager?error=toolong");
    exit;
}



$prodid = $validarray['id'];
// $prodid=$_GET['id'];

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











$whitelist=['about'];
$maxlengtharray['about']=11;
$methd = $_POST;
$empty = checkEmpty($methd,$whitelist);

if($empty!=null){
    header("location: https://www.swapamc.com/swapproj/productmanager?error=emptyabout");
    exit;
} 

$validarray = XSSPrevention($methd,$whitelist);
$validarray = escapeString($conn,$validarray);


if(badInputTwo([$validarray['about']])!=false){
    error_log("TPAMC:".$filename.":4:$ipadd:2 Malicious input", 0);
    header("location: https://www.swapamc.com/swapproj/productmanager?error=badabout");
    exit;
}

if(checkLength($validarray,$maxlengtharray)!=null){   
    header("location: https://www.swapamc.com/swapproj/productmanager?error=toolong");
    exit;
}


$about = $validarray['about'];






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
                            header("location: https://www.swapamc.com/swapproj/productmanager?error=image");
                            exit;
                        } else {
                            $imgResized = imagescale($image , 500, 400);
                            imagejpeg($imgResized, $img_upload_path);
        
                        }
                        
                        
                    } catch (Exception $e) {
                        
                        echo 'Message: ' . $e->getMessage();
                        header("location: https://www.swapamc.com/swapproj/productmanager?error=image");
                        exit;
                        
                    }
                    
                    
        
                    
                    
        
                    
        
        
                } elseif ($img_ex_lc == 'png'){
        
                    try {
                        
                        
                        // $image = imagecreatetruecolor($width, $height);
                        // $white = imagecolorallocate($image, 255, 255, 255);
                        // imagefill($image, 0, 0, $white);

                        $image = imagecreatefrompng($tmp_name);
        
                        if($image==null){
                            header("location: https://www.swapamc.com/swapproj/productmanager?error=imagebad");
                            exit;
        
                        } else {
                            $imgResized = imagescale($image , 500, 400);
                            imagepng($imgResized, $img_upload_path);
        
                        }
                        
                        
                    } catch (Exception $e) {
                        echo 'Message: ' . $e->getMessage();
                        header("location: https://www.swapamc.com/swapproj/productmanager?error=badimage");
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



//is id valid
if(isset($_GET['id'])&&$_GET['id']!=null){
    

    if(badInputTwo([$prodid])==true){
        header("location: https://www.swapamc.com/swapproj/productmanager?error=badid");
        exit;
    }
    try {
        $query = $conn->prepare("SELECT product_id FROM mydb.products WHERE product_id = ?;");
        $query->bind_param('s',$prodid);
        if ($query === false) {
            //change filename accordingly
            throw new Exception("Statement Preparation failed(productedit)");
        }
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
        //change header location accordingly
        header("location: https://www.swapamc.com/swapproj/productmanager?error=stmt");
        exit;
    }


    try {
        $execute = $query->execute();
        if ($execute === false) {
            throw new Exception("Statement Preparation failed(productedit)");
        }
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
        header("location: https://www.swapamc.com/swapproj/productmanager?error=stmt");
        exit;
    }
} else {
    header("location: https://www.swapamc.com/swapproj/productmanager?error=badid");
        exit;

}
$query->bind_result($id);

if(!$query->fetch()){
    header("location: https://www.swapamc.com/swapproj/productmanager?error=badid");
    exit;
}



$query->close();








if(badInputTwo([$about])==1){
    header("location: https://www.swapamc.com/swapproj/productmanager?error=malicious");
    exit;
}



for($k=0;$k<3;$k++){
    
    if(isset($productimages[$k])&&$productimages[$k]!=null){
        $imagesarraypath[$k] = $productimages[$k];

    } else {
        $imagesarraypath[$k] = NULL;
    }

    

}





try {
    $query = $conn->prepare("UPDATE mydb.products SET `product_about` = ?, `product_picone` = ?, `product_pictwo` = ?, `product_picthree` = ? WHERE `product_id` = ?");
    $query->bind_param('sssss',$about,$imagesarraypath[0],$imagesarraypath[1],$imagesarraypath[2],$prodid);
    if ($query === false) {
        //change filename accordingly
        throw new Exception("Statement Preparation failed(productedit)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    //change header location accordingly
    header("location: https://www.swapamc.com/swapproj/productmanager?error=stmt");
    exit;
}


try {
    $execute = $query->execute();
    if ($execute === false) {
        throw new Exception("Statement Preparation failed(productedit)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    header("location: https://www.swapamc.com/swapproj/productmanager?error=stmt");
    exit;
}
header("location: https://www.swapamc.com/swapproj/productmanager?error=none");
