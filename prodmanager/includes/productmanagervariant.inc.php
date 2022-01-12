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


for($i=0;$i<sizeof($alltypes);$i++){
    $type = $alltypes[$i];         //e..g color
    $variantsforatype = [];      //e.g. color can have white and blue
    
    

    for($k=1;$k<4;$k++){ //1 -3 instead of 0-3
        
        
        $variant=$type."variant".$k; //name is e.g. Colorvariant1 
        $additionalcosts=$type."variant".$k."cost";
        if(isset($_POST[$variant])&&$_POST[$variant]!=null){
            $variant = $_POST[$variant]; //e.g. white

            if(isset($_POST[$additionalcosts])&&$_POST[$additionalcosts]!=null){
                $additionalcosts = $_POST[$additionalcosts];
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


// unset($_SESSION['addtypes']);

$_SESSION['typesvariants'] = $typesandvariants;

header("location: https://www.swapamc.com/swapproj/productmanageraddinventory");






?>















