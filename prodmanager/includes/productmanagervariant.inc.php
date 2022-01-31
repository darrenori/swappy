<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';

session_start();

if(!isset($_SESSION['addproductinfo'])||$_SESSION['addproductinfo']==null){
    header("location: https://www.swapamc.com/swapproj/productmanagertypes");
}


if(isset($_SESSION['addtypes'])){
    $alltypes = $_SESSION['addtypes'];

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


for($i=0;$i<sizeof($alltypes);$i++){
    $type = $alltypes[$i];         //e..g color
    $variantsforatype = [];      //e.g. color can have white and blue
    
    

    for($k=1;$k<4;$k++){ //1 -3 instead of 0-3
        
        
        $variant=$type."variant".$k; //name is e.g. Colorvariant1 
        $additionalcosts=$type."variant".$k."cost";
        if(isset($_POST[$variant])&&$_POST[$variant]!=null){
            $variant = $_POST[$variant]; //e.g. white
            $variant=htmlspecialchars($variant);
            $variant=mysqli_escape_string($conn,$variant);

            if(badInputTwo([$variant])!=false){
                error_log("TPAMC:".$filename.":4:$ipadd:2 Malicious input", 0);
                header("location: https://www.swapamc.com/swapproj/productmanagervariant?error=malicious");
                exit;
            }

            if(isset($_POST[$additionalcosts])&&$_POST[$additionalcosts]!=null){
                $additionalcosts = $_POST[$additionalcosts];
                $additionalcosts=htmlspecialchars($additionalcosts);
                $additionalcosts=mysqli_escape_string($conn,$additionalcosts);

                if(badInputTwo([$additionalcosts])!=false){
                    error_log("TPAMC:".$filename.":4:$ipadd:2 Malicious input", 0);
                    header("location: https://www.swapamc.com/swapproj/productmanagervariant?error=malicious");
                    exit;
                }
                
            } else {
                $additionalcosts = 0;
            }
            
            

            if(badInputTwo([$variant])==0&&badInputTwo([$additionalcosts])==0){

                $variant = [$variant,$additionalcosts];
                array_push($variantsforatype,$variant);

               

            }
            
        }
    }

    $typesandvariants[$type] = $variantsforatype;  
    //e.g. 'color' = [[blue,0],[white,10]]


}



$_SESSION['typesvariants'] = $typesandvariants;
$_SESSION['addproduct'] = 'C';
header("location: https://www.swapamc.com/swapproj/productmanageraddinventory");






?>















