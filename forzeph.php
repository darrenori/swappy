<?php
// if 	button 'submit'    => 
    $csrf = generateCSRF();
    echo "<input type='hidden' name='csrf' value='$csrf'>";

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


// if  	'jquery.ajax' =>  
    $csrf = generateCSRF();
    // array['csrf'] = '<?php echo $csrf; ?>';
<?php

##### ALL POST ITEMS DECLARED #######

$allfields = array_merge($requiredfields, $nonrequiredfields);
$allimgs = array_merge($requiredimgs, $nonrequiredimgs);
$whitelist = array_merge($allfields, $allimgs);

##ZEPH

// if filenames have more than 1 slash, convert it to jsut 1 slash (not working, dk why)
// foreach ($allimgs as $value) {
//     if (isset($_POST[$value]) && !empty($_POST[$value])) {
//         $_POST[$value] = preg_replace('/\\{2,}/i', '\\', $_POST[$value], -1);
//     }
// }


// removes any other GET and POST names and does html specialchars
$whitelist =['resend','submit','emailotp'];
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
$maxlengtharray['websitelink'] = 150;
$maxlengtharray['image1'] = 200;
$maxlengtharray['image2'] = 200;
$maxlengtharray['image3'] = 200;

//removes any nondigit characters.
$storeid = preg_replace('/[^\d]/', '', $_GET['id']);
//cleans GET items
$retrieveditem = preg_replace('/[^a-z]+/', '', $_GET['error']);


// bufferflag and emptyflag return false (undesired) if length of item and item are not agreeable
$bufferflag = empty(checkLength($_GET, $maxlengtharray));
$emptyflag = empty(checkEmpty($_GET, ['id']));

if (!($bufferflag && $emptyflag)) {
    header("location: https://www.swapamc.com/swapproj/productmanager?error=invalidid");
    exit;
}

##### ALL POST ITEMS DECLARED #######

//logs if any values are strings and are links to page
checkForURL($_POST, $filename, $ipadd);

#### all 






### PREPARE STATEMENT LOGS
error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR preparing statement (SELECT)", 0);

### BIND PARAMS find 'prepare'


### AFTER ID has been confirmed to be valid
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
    header("location: https://www.https://www.swapamc.com/swapproj/storemanager/editstore?id=$id&error=missingfields");
    exit();
} elseif ($bufferflag === false) {
    header("location: https://www.https://www.swapamc.com/swapproj/storemanager/editstore?id=$id&error=longinput");
    exit();
} // log changes to websitelink
elseif ($originalwebsite !== $websitelink) {
    error_log("TPAMC:" . $filename . ":2:" . $ipadd . ":4 URL UPDATED", 0);
}



##SESSION 
//if have session






