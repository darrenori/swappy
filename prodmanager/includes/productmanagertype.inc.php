<?php


require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';


$typearray = [];
if(!isset($_POST['type1'])||$_POST['type1']==null){

} else {
    array_push($typearray,"type1");
}

if(!isset($_POST['type2'])||$_POST['type2']==null){

} else {
    array_push($typearray,"type2");
}
if(!isset($_POST['type3'])||$_POST['type3']==null){

} else {
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
    if(isset($_POST[$type])&&$_POST[$type]!=null){
        array_push($typeinfoarray,$_POST[$type]);

    }
}


if(badInputTwo($typeinfoarray)==1){
    header("location: https://www.swapamc.com/swapproj/productmanagertypes?error=malicious");
    exit();
}

session_start();
$_SESSION['addtypes'] = $typeinfoarray;  
header("location: https://www.swapamc.com/swapproj/productmanagervariant");