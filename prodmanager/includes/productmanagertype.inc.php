<?php


require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';

$whitelist=['type1','type2','type3'];
$maxlengtharray['type1']=45;
$maxlengtharray['type2']=45;
$maxlengtharray['type3']=45;
$methd = $_POST;


$validarray = XSSPrevention($methd,$whitelist);
$validarray = escapeString($conn,$validarray);



if(checkLength($validarray,$maxlengtharray)!=null){   
    header("location: https://www.swapamc.com/swapproj/productmanagertypes?error=toolong");
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


$typearray=[];



if(isset($validarray['type1'])&&$validarray['type1']!=null){
    array_push($typearray,"type1");
}

if(isset($validarray['type2'])&&$validarray['type2']!=null){
    array_push($typearray,"type2");
}
if(isset($validarray['type3'])&&$validarray['type3']!=null){
    array_push($typearray,"type3");
}

if(sizeof($typearray)==0){
    header("location: https://www.swapamc.com/swapproj/productmanagertypes?error=entersomething");
    exit();

} elseif(sizeof($typearray)>3){
    header("location: https://www.swapamc.com/swapproj/productmanagertypes?error=toomuch");
    exit();
}

//different from typearray. $typearray is the key while typeinfoarray is the value
$typeinfoarray=[];
for($i=0;$i<sizeof($typearray);$i++){
    $type = $typearray[$i];
    if(isset($validarray[$type])&&$validarray[$type]!=null){
        array_push($typeinfoarray,$validarray[$type]);

    }
}


if(badInputTwo($typeinfoarray)==1){
    header("location: https://www.swapamc.com/swapproj/productmanagertypes?error=malicious");
    exit();
}

if(!$_SESSION){
    session_start();
}

$_SESSION['addtypes'] = $typeinfoarray;  
$_SESSION['addproduct'] = 'B';
header("location: https://www.swapamc.com/swapproj/productmanagervariant");