<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';

///1) makes sure only required fields are processed (except images)
$requiredfields = ['storename', 'storepricepoint', 'about', 'storeaddress', 'storenumber', 'storestatus'];
$nonrequiredfields = ['websitelink'];
$requiredimgs = ['image1'];
$nonrequiredimgs = ['image2', 'image3'];

$allfields = array_merge($requiredfields, $nonrequiredfields);
$allimgs = array_merge($requiredimgs, $nonrequiredimgs);
foreach ($_POST as $formname => $formvalue) {
    if (!in_array($formname, $allfields)) {
        unset($_POST[$formname]);
    }
}
foreach ($_FILES as $formname => $formvalue) {
    if (!in_array($formname, $allimgs)) {
        unset($_FILES[$formname]);
    }
}

///2) Checks required fields for empty values
foreach ($requiredfields as $i => $requiredfield) {
    if (!isset($_POST[$requiredfield]) || empty($_POST[$requiredfield])) {
        header("location: https://www.swapamc.com/swapproj/storemanageradd?error=empty$requiredfield");
        exit();
    }
}
foreach ($requiredimgs as $i => $requiredimg) {
    if (!isset($_FILES[$requiredimg]) || empty($_FILES[$requiredimg])) {
        header("location: https://www.swapamc.com/swapproj/storemanageradd?error=empty$requiredimg");
        exit();
    }
}




$storename = $_POST['storename'];
$storepricepoint = $_POST['storepricepoint'];
$about = $_POST['about'];
$storeaddress = $_POST['storeaddress'];
$storenumber = $_POST['storenumber'];
$storerating = 0; //rating to default to zero calculated based on reviews. 

//Is true if variable is set to active
$storestatus = $_POST['storestatus'] === "Active";
$websitelink="NULL";
if (isset($_POST['websitelink']) && empty($_POST['websitelink'])) {
    $websitelink = $_POST['websitelink'];
}




if (badInputTwo([$about, $storename]) === true) {
    header("location: https://www.swapamc.com/swapproj/storemanageradd?error=malicious");
    exit;
}


if (!is_numeric($storepricepoint) || !is_numeric($storenumber)) {
    header("location: https://www.swapamc.com/swapproj/storemanageradd?error=wrongnumber");
    exit;
}


//check if storename already exists in store
try {
    $query = $conn->prepare("SELECT store_name FROM mydb.store   
    WHERE store_name=?;");
    $query->bind_param('s', $storename);

    if ($query === false) {
        //change filename accordingly
        throw new Exception("Statement Preparation failed(storemanageradd.inc)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
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
    echo 'Message: ' . $e->getMessage();
    header("location: https://www.swapamc.com/swapproj/storemanageradderror=stmt");

    exit;
}



$result = $query->get_result();
$array = $result->fetch_all(MYSQLI_ASSOC);

if (sizeof($array) > 0) {
    //store already exists
    header("location: https://www.swapamc.com/swapproj/storemanageradd?error=namealreadyexists");
    exit;
}






$imagesarray = ['image1', 'image2', 'image3'];
$storeimages = [];


for ($i = 0; $i < sizeof($imagesarray); $i++) {

    if (isset($_FILES[$imagesarray[$i]]) && $_FILES[$imagesarray[$i]] != null && $_FILES[$imagesarray[$i]]['size'] != 0) {
        $error = $_FILES[$imagesarray[$i]]['error'];
        if ($error === 1) {
            header("location: https://www.swapamc.com/swapproj/storemanageradd?error=badimage");
            exit;
        } else {
            $img_name = $_FILES[$imagesarray[$i]]['name'];
            $img_size = $_FILES[$imagesarray[$i]]['size'];
            $tmp_name = $_FILES[$imagesarray[$i]]['tmp_name'];
        }








        if ($img_size > 10025000) {
            $em = "filetoolarge";
            header("location: https://www.swapamc.com/swapproj/storemanageradd?error=badimagesize");
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
                            header("location: https://www.swapamc.com/swapproj/storemanageradd?error=badimagejpg");
                            exit;
                        } else {
                            $imgResized = imagescale($image, 500, 400);
                            imagejpeg($imgResized, $img_upload_path);
                        }
                    } catch (Exception $e) {

                        echo 'Message: ' . $e->getMessage();
                        header("location: https://www.swapamc.com/swapproj/storemanageradd?error=badimagejpg");
                        exit;
                    }
                } elseif ($img_ex_lc == 'png') {

                    try {
                        $image = imagecreatefrompng($tmp_name);

                        if ($image == null) {
                            header("location: https://www.swapamc.com/swapproj/storemanageradd?error=badimagepng");
                            exit;
                        } else {
                            $imgResized = imagescale($image, 500, 400);
                            imagepng($imgResized, $img_upload_path);
                        }
                    } catch (Exception $e) {
                        echo 'Message: ' . $e->getMessage();
                        header("location: https://www.swapamc.com/swapproj/storemanageradd?error=badimagepng");
                        exit;
                    }
                }










                // move_uploaded_file($image, $img_upload_path);

                date_default_timezone_set('Asia/Singapore');
                $now = time();
                $now = date('Y-m-d', $now) . " " . date('H:i:s');

                array_push($storeimages, $img_upload_path);
            } else {
                $em = "You can't upload files of this type";
                header("location: https://www.swapamc.com/swapproj/storemanageradd?error=badimagefiletype");
                exit;
            }
        }
    }
}

//sets empty images to null so doesn't return error.
$imagesarraypath = [];
for ($k = 0; $k < 3; $k++) {

    if (isset($storeimages[$k]) && $storeimages[$k] != null) {
        $imagesarraypath[$k] = $storeimages[$k];
    } else {
        $imagesarraypath[$k] = NULL;
    }
}


try {

    $query = $conn->prepare("INSERT INTO mydb.store(`store_name`,`store_pricepoint`,`store_about`,`store_picone`,`store_pictwo`,`store_picethree`,`store_address`,`store_number`,`store_url`,`store_status`,`store_rating`) VALUES (?,?,?,?,?,?,?,?,?,?,?);");
    $query->bind_param('sisssssssii', $storename, $storepricepoint, $about, $imagesarraypath[0], $imagesarraypath[1], $imagesarraypath[2], $storeaddress, $storenumber, $websitelink, $storestatus, $storerating);
    if ($query === false) {
        //change filename accordingly
        throw new Exception("Statement Preparation failed(storemanagerall.inc)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    //change header location accordingly
    // header("location: https://www.swapamc.com/swapproj/storemanager?error=stmtallerror");
    exit;
}
// throws error "Statment Execution failed" when statement fails
try {
    $execute = $query->execute();
    if ($execute === false) {
        throw new Exception("Statement Preparation failed(storemanagerall.inc)");
    }
} catch (Exception $e) {
    header("location: https://www.swapamc.com/swapproj/storemanager?error=stmtallerror");
    exit;
}

$query->close();










// header("location: https://www.swapamc.com/swapproj/storemanageraddtypes");
