<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
$filename = basename(__FILE__, '.php'); // filename variable is now set as allstores for example
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/images/showimage.php';


### CSRF ####
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
### CSRF ####



///1) makes sure only required fields are processed (except images)
$requiredfields = ['storename', 'storepricepoint', 'about', 'storeaddress', 'storenumber', 'storestatus'];
$nonrequiredfields = ['websitelink'];
$requiredimgs = ['image1'];
$nonrequiredimgs = ['image2', 'image3'];

##### ALL POST ITEMS DECLARED #######

$allfields = array_merge($requiredfields, $nonrequiredfields);
$allimgs = array_merge($requiredimgs, $nonrequiredimgs);
$whitelist = array_merge($allfields, $allimgs);

##ZEPH

// if filenames have more than 1 slash, convert it to jsut 1 slash (not working, dk why)
foreach ($allimgs as $value) {
    if (isset($_POST[$value]) && !empty($_POST[$value])) {
        $_POST[$value] = preg_replace('/\\\\{2,}/i', '\\', $_POST[$value], -1);
    }
}


// removes any other GET and POST names and does html specialchars
$_POST = XSSPrevention($_POST, $whitelist);
$_GET = XSSPrevention($_GET, ['id']);
// $_FILES
foreach ($_FILES as $key => $value) {
    if (!in_array(htmlspecialchars($key, ENT_QUOTES), $whitelist)) {
        // removes any keys that are not in side the specified "whitelist"
        unset($_FILES[$key]);
    }
}


// runs all variables thru sqlescape string
$_POST = escapeString($conn, $_POST);
$_GET = escapeString($conn, $_GET);

// declares variable length in chars for each item. 
$maxlengtharray['id'] = 11;
$maxlengtharray['storename'] = 65535;
$maxlengtharray['about'] = 65535;
$maxlengtharray['storeaddress'] = 100;
$maxlengtharray['storenumber'] = 8; // number should be 8 chars long only (SQL allows 45)
$maxlengtharray['storestatus'] = 8; // Inactive is 8 chars long
$maxlengtharray['storepricepoint'] = 1; //1,2,3,4, or 5
$maxlengtharray['websitelink'] = 65535;
$maxlengtharray['image1'] = 200;
$maxlengtharray['image2'] = 200;
$maxlengtharray['image3'] = 200;

//removes any nondigit characters.
$storeid = preg_replace('/[^\d]/', '', $_GET['id']);

// bufferflag and emptyflag return false (undesired) if length of item and item are not agreeable
$bufferflag = empty(checkLength($_GET, $maxlengtharray));
$emptyflag = empty(checkEmpty($_GET, ['id']));

if (!($bufferflag && $emptyflag)) {
    header("location: https://www.swapamc.com/swapproj/productmanager?error=invalidid");
    exit;
}

##### ALL POST ITEMS DECLARED #######

//logs if any values are strings
checkForURL($_POST, $filename, $ipadd);

//Declaring values after input has been sanitised
$storename = $_POST['storename'];
$storepricepoint = $_POST['storepricepoint'];
$about = $_POST['about'];
$storeaddress = $_POST['storeaddress'];
$storenumber = $_POST['storenumber'];
$storerating;



//Is true if variable is set to active
$storestatus = $_POST['storestatus'] === "Active";
$websitelink = "NULL";
if (isset($_POST['websitelink']) && !empty($_POST['websitelink'])) {
    $websitelink = $_POST['websitelink'];
}
$storenumber = str_replace(' ', '', $storenumber);


if (badInputTwo([$storename]) === true) {
    header("location: https://www.swapamc.com/swapproj/storemanageradd?error=malicious");
    exit;
}


if (!is_numeric($storepricepoint) || !is_numeric($storenumber)) {
    header("location: https://www.swapamc.com/swapproj/storemanageradd?error=wrongnumber");
    exit;
}


//check if storename already exists in store
try {
    $query = $conn->prepare("SELECT store_id , store_rating, store_url FROM mydb.store   
    WHERE store_id=?;");
    $query->bind_param('s', $storeid);

    if ($query === false) {
        //change filename accordingly
        throw new Exception("Statement Preparation failed(storemanageradd.inc)");
    }
} catch (Exception $e) {
    error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR preparing statement (SELECT)", 0);
    //change header location accordingly
    header("location: https://www.swapamc.com/swapproj/storemanageradd?error=stmt");
    exit;
}
// throws error "Statment Execution failed" when statement fails
try {
    $execute = $query->execute();
    if ($execute === false) {
        throw new Exception("Statement Execution failed (storemanageradd.inc)");
    }
} catch (Exception $e) {
    error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR executing statement (SELECT)", 0);
    header("location: https://www.swapamc.com/swapproj/storemanageradderror=stmt");

    exit;
}


$query->bind_result($id, $store_rating, $originalwebsite);
// IF ID DOES NOT EXIST
if (!$query->fetch()) {
    header("location: https://www.swapamc.com/swapproj/productmanager?error=invalidid");
    exit;
}

// $bufferflag will return false (undesired) if any of the fields exceed the buffer length
$bufferflag = empty(checkLength($_POST, $maxlengtharray));
// emptyflag will return false (undesired) if any of the required fields are not filled
$emptyflag = empty(checkEmpty($_POST, $requiredfields));
// phoneflag will return false (undesired) if the phone number is not valid (a number and 8 characters in length)
$phoneflag = empty(phoneNumRegEx($storenumber));

if ($phoneflag === false) {
    header("location: https://www.swapamc.com/swapproj/storemanager/editstore?id=$id&error=invalidphonenumber");
    exit();
}


//is id valid
if ($emptyflag === false) {
    header("location: https://www.swapamc.com/swapproj/storemanager/editstore?id=$id&error=missingfields");
    exit();
} elseif ($bufferflag === false) {
    header("location: https://www.swapamc.com/swapproj/storemanager/editstore?id=$id&error=longinput");
    exit();
} // log changes to websitelink
elseif ($originalwebsite !== $websitelink) {
    error_log("TPAMC:" . $filename . ":2:" . $ipadd . ":4 URL UPDATED", 0);
}
$query->close();




$imagesarray = ['image1', 'image2', 'image3'];
$productimages = [];

//Adds image paths to the productimages array if they existed before
foreach ($_POST as $formname => $formvalue) {
    //$allimgs contains the exact names of what the variable should be, hence the in_array() command
    if (in_array($formname, $allimgs)) {
        $imagenumber = (int)substr($formname, 5, 1);
        //confirms only image 1, 2, or 3 can exist
        if (!in_array($imagenumber, [1, 2, 3])) {
            header("location: https://www.swapamc.com/swapproj/productmanager?error=badformname");
            exit;
        }
        $productimages[$imagenumber - 1] = $formvalue;
    }
}

for ($i = 0; $i < sizeof($imagesarray); $i++) {

    if (isset($_FILES[$imagesarray[$i]]) && $_FILES[$imagesarray[$i]] != null && $_FILES[$imagesarray[$i]]['size'] != 0) {
        $error = $_FILES[$imagesarray[$i]]['error'];
        if ($error === 1) {
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
        } else {

            $img_ex = pathinfo($img_name, PATHINFO_EXTENSION);
            $img_ex_lc = strtolower($img_ex);

            $allowed_exs = array("jpg", "jpeg", "png");

            if (in_array($img_ex_lc, $allowed_exs)) {

                $new_img_name = uniqid("IMG-", true) . '.' . $img_ex_lc;
                $img_upload_path = 'uploads/' . $new_img_name;



                //image is valid


                //resize image. after resize, isit an actual image/
                if ($img_ex_lc == 'jpg' || $img_ex_lc == 'jpeg') {

                    try {
                        $image = imagecreatefromjpeg($tmp_name);

                        if ($image == null) {
                            //image malicious
                            header("location: https://www.swapamc.com/swapproj/productmanager?error=image");
                            exit;
                        } else {
                            $imgResized = imagescale($image, 500, 400);
                            imagejpeg($imgResized, $img_upload_path);
                        }
                    } catch (Exception $e) {
                        error_log("TPAMC:" . $filename . ":2:" . $ipadd . ":2 Invalid filetype", 0);
                        header("location: https://www.swapamc.com/swapproj/productmanager?error=image");
                        exit;
                    }
                } elseif ($img_ex_lc == 'png') {

                    try {
                        $image = imagecreatefrompng($tmp_name);

                        if ($image == null) {
                            header("location: https://www.swapamc.com/swapproj/productmanager?error=image");
                            exit;
                        } else {
                            $imgResized = imagescale($image, 500, 400);
                            imagepng($imgResized, $img_upload_path);
                        }
                    } catch (Exception $e) {
                        header("location: https://www.swapamc.com/swapproj/productmanager?error=image");
                        exit;
                    }
                }










                // move_uploaded_file($image, $img_upload_path);

                date_default_timezone_set('Asia/Singapore');
                $now = time();
                $now = date('Y-m-d', $now) . " " . date('H:i:s');
                // Changed so that will override old image
                $productimages[$i] = $img_upload_path;
            } else {
                $em = "You can't upload files of this type";
                header("location: https://www.swapamc.com/swapproj/productmanager?error=badimagefiletype");
                exit;
            }
        }
    }
}






for ($k = 0; $k < 3; $k++) {
    if (isset($productimages[$k]) && !empty($productimages[$k])) {
        $imagesarraypath[$k] = $productimages[$k];
    } else {
        $imagesarraypath[$k] = NULL;
    }
}



try {
    $query = $conn->prepare("UPDATE mydb.store SET `store_name` = ?,`store_pricepoint` = ?,`store_about` = ?, `store_picone` = ?, `store_pictwo` = ?, `store_picethree` = ? , `store_address` = ?, `store_number` = ?, `store_url` = ? , `store_status` = ?, `store_rating` = ? WHERE `store_id` = ?");
    $query->bind_param('sisssssssiii', $storename, $storepricepoint, $about, $imagesarraypath[0], $imagesarraypath[1], $imagesarraypath[2], $storeaddress, $storenumber, $websitelink, $storestatus, $storerating, $storeid);
    if ($query === false) {
        //change filename accordingly
        throw new Exception("Statement Preparation failed(storedit)");
    }
} catch (Exception $e) {
    error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR preparing statement (UPDATE)", 0);
    //change header location accordingly
    header("location: https://www.swapamc.com/swapproj/productmanager?error=stmt");
    exit;
}


try {
    $execute = $query->execute();
    if ($execute === false) {
        throw new Exception("Statement Preparation failed(storedit)");
    }
} catch (Exception $e) {
    error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR executing statement (UPDATE)", 0);
    // header("location: https://www.swapamc.com/swapproj/productmanager?error=stmt");
    exit;
}
header("location: https://www.swapamc.com/swapproj/productmanager?error=none");
