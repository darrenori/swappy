<?php


require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';


function generate_combinations(array $data, array &$all = array(), array $group = array(), $value = null, $i = 0)
{
    $keys = array_keys($data);
    if (isset($value) === true) {
        array_push($group, $value);
    }

    if ($i >= count($data)) {
        array_push($all, $group);
    } else {
        $currentKey     = $keys[$i];
        $currentElement = $data[$currentKey];
        foreach ($currentElement as $val) {
            generate_combinations($data, $all, $group, $val, $i + 1);
        }
    }

    return $all;
}

function badInputNumber($array){
    $pattern = "/^[0-9]*$/i";

    for($i=0;$i<sizeof($array);$i++){
        $input = $array[$i];
        $a = !(preg_match($pattern,$input));

        if($a==1){
            return true;
        }
    }
    
    return false;

    //0 is valid input

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

session_start();
echo "<br><br><br>";


$checked = [];
$twodimensionarray = [];
$typesandvariants = $_SESSION['typesvariants'];
foreach ($typesandvariants as $type=>$variantarray){
    //this part is to remove the 'additional costs' of the array
    $variantnames = [];
    for($k=0;$k<sizeOf($variantarray);$k++){
         //0 is name, 1 is additional cost
        array_push($variantnames,$variantarray[$k][0]);
        
    }

    array_push($twodimensionarray,$variantnames);
    
}
$combos = generate_combinations($twodimensionarray);
// print_r($_SESSION);


for($i=0;$i<sizeOf($combos);$i++){


    $name = implode("",$combos[$i]);


    

    if(isset($_POST[$name])&&$_POST[$name]!=null){

        
        $postname=$_POST[$name];
        $postname=htmlspecialchars($postname);
        $postname=mysqli_escape_string($conn,$postname);

        if(badInputNumber([$postname])!=false){
            error_log("TPAMC:".$filename.":4:$ipadd:2 Malicious input", 0);
            header("location: https://www.swapamc.com/swapproj/productmanageraddinventory?error=malicious");
            exit;
        }

    

        $checked[$name] = $postname;


        ###DARREN
        //the reason why i am doing this instead of $_POST to get everything is to check that no 
        //interception or changing of values. even product manager has to be checked to make it harder
        //for attacker to privilege escalate


    }

    
}

echo "<br><br><br>";


$calculateinventory=[];
foreach ($checked as $key => $value){
    array_push($calculateinventory,$value);
}

echo "<br><br><br>";

if(badInputNumber($calculateinventory)==1){
    echo 'bad input bruhv';
}


//productstableinfo
$totalinv=0;
for($i=0;$i<sizeof($calculateinventory);$i++){
    $totalinv = $totalinv+$calculateinventory[$i];
}

//order is name,storeid,about,price
$productableinfo = $_SESSION['addproductinfo'];
$productname = $productableinfo[0];
$storeid = $productableinfo[1];
$about = $productableinfo[2];
$price = $productableinfo[3];

$imagesarray = $_SESSION['addproductimages'];
$imagesarraypath = [];
for($k=0;$k<3;$k++){
    
    if(isset($imagesarray[$k])&&$imagesarray[$k]!=null){
        $imagesarraypath[$k] = $imagesarray[$k];

    } else {
        $imagesarraypath[$k] = NULL;
    }

    

}





try {
    
    $query=$conn->prepare("INSERT INTO mydb.products(`product_name`,`product_price`,`product_about`,`product_picone`,`product_pictwo`,`product_picthree`,`total_quantity`) VALUES (?,?,?,?,?,?,?);");
    $query->bind_param('sdssssi',$productname,$price,$about,$imagesarraypath[0],$imagesarraypath[1],$imagesarraypath[2],$totalinv);
    if ($query === false) {
        //change filename accordingly
        throw new Exception("Statement Preparation failed(productmanagerall.inc)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    //change header location accordingly
    // header("location: https://www.swapamc.com/swapproj/productmanager?error=stmtallerror");
    // exit;
}
// throws error "Statment Execution failed" when statement fails
try {
    $execute = $query->execute();
    if ($execute === false) {
        throw new Exception("Statement Preparation failed(productmanagerall.inc)");
    }
} catch (Exception $e) {
    // header("location: https://www.swapamc.com/swapproj/productmanager?error=stmtallerror");
    // exit;
}

$query->close();







// get productid
try {
    $query = $conn->prepare("SELECT product_id FROM mydb.products WHERE product_name = ?;");
    $query->bind_param('s',$productname);

    if ($query === false) {
        //change filename accordingly
        throw new Exception("Statement Preparation failed(productmanagerall)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    //change header location accordingly
    header("location: https://www.swapamc.com/swapproj/productmanager?error=stmtallerror");
    exit;
}
// throws error "Statment Execution failed" when statement fails
try {
    $execute = $query->execute();
    if ($execute === false) {
        throw new Exception("Statement Execution failed (productmanagerall)");
    }
} catch (Exception $e) {
    header("location: https://www.swapamc.com/swapproj/productmanager?error=stmtallerror");
    exit;
}


$query->bind_result($productid);
$query->fetch();

$query->close();








//insert
try {
    $query = $conn->prepare("INSERT INTO mydb.storeprod (`store_id`,`product_id`) VALUES (?,?);");
    $query->bind_param('ii',$storeid,$productid);

    if ($query === false) {
        //change filename accordingly
        throw new Exception("Statement Preparation failed(productmanagerall)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    // change header location accordingly
    header("location: https://www.swapamc.com/swapproj/productmanager?error=stmtallerror");
    exit;
}
// throws error "Statment Execution failed" when statement fails
try {
    $execute = $query->execute();
    if ($execute === false) {
        throw new Exception("Statement Execution failed (productmanagerall)");
    }
} catch (Exception $e) {
    header("location: https://www.swapamc.com/swapproj/productmanager?error=stmtallerror");
    exit;
}







$randomnumber = floatval(rand(pow(10, 8 - 1), pow(10, 8) - 1));
// $randomnumber = '30068854';

foreach($typesandvariants as $type => $vararray){

    // print_r($vararray);
    echo "<br>";
    for($a=0;$a<sizeof($vararray);$a++){
        $name = $vararray[$a][0];
        $additionalcost = $vararray[$a][1];

        



        try {
            $query = $conn->prepare("INSERT INTO mydb.type (`type`,`type_choice`,`additional_costs`,`automated`) VALUES (?,?,?,?);");
            $query->bind_param('ssds',$type,$name,$additionalcost,$randomnumber);
        
            if ($query === false) {
                //change filename accordingly
                throw new Exception("Statement Preparation failed(productmanagerall)");
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
            //change header location accordingly
            header("location: https://www.swapamc.com/swapproj/productmanager?error=stmtallerror");
            exit;
        }
        // throws error "Statment Execution failed" when statement fails
        try {
            $execute = $query->execute();
            if ($execute === false) {
                throw new Exception("Statement Execution failed (productmanagerall)");
            }
        } catch (Exception $e) {
            header("location: https://www.swapamc.com/swapproj/productmanager?error=stmtallerror");
            exit;
        }


        $query->close();


        















    }
}












try {
    $query = $conn->prepare("SELECT type_id FROM mydb.type WHERE automated = ?");
    $query->bind_param('s',$randomnumber);
    

    if ($query === false) {
        //change filename accordingly
        throw new Exception("Statement Preparation failed(productmanagerall)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    //change header location accordingly
    header("location: https://www.swapamc.com/swapproj/productmanager?error=stmtallerror");
    exit;
}
// throws error "Statment Execution failed" when statement fails
try {
    $execute = $query->execute();
    if ($execute === false) {
        throw new Exception("Statement Execution failed (productmanagerall)");
    }
} catch (Exception $e) {
    header("location: https://www.swapamc.com/swapproj/productmanager?error=stmtallerror");
    exit;
}

$result = $query->get_result();
$alltypeid = $result->fetch_all(MYSQLI_ASSOC);



$query->close();












echo "<br>";


//link products and types

for($a=0;$a<sizeOf($alltypeid);$a++){

    try {
        $query = $conn->prepare("INSERT INTO mydb.product_type (`product_id`,`type_id`) VALUES (?,?)");
        $query->bind_param('ii',$productid,$alltypeid[$a]['type_id']);
        
    
        if ($query === false) {
            //change filename accordingly
            throw new Exception("Statement Preparation failed(productmanagerall)");
        }
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
        //change header location accordingly
        header("location: https://www.swapamc.com/swapproj/productmanager?error=stmtallerror");
        exit;
    }
    // throws error "Statment Execution failed" when statement fails
    try {
        $execute = $query->execute();
        if ($execute === false) {
            throw new Exception("Statement Execution failed (productmanagerall)");
        }
    } catch (Exception $e) {
        header("location: https://www.swapamc.com/swapproj/productmanager?error=stmtallerror");
        exit;
    }

}



// print_r($checked);
// echo "<br><br>";

// print_r($combos);
// echo "<br><br>";





$alltypes = $_SESSION['addtypes'];  

for($i=0;$i<sizeof($combos);$i++){
    $code = $productname;
    

    for($k=0;$k<sizeof($combos[$i]);$k++){
        


        if($k==sizeOf($combos)-1){
            
            $code = $code . "," . $alltypes[$k] . "," . $combos[$i][$k];
        } else {
            $code = $code . "," . $alltypes[$k] . "," . $combos[$i][$k];

        }
    }

    echo "<br>" . $code;

    // $code = preg_replace('/\s+/', '_', $code);

    $code = hash('md5',$code);

    $inventory = array_values($checked)[$i];



    try {
        $query = $conn->prepare("INSERT INTO mydb.inventory (`product_id`,`productcode`,`quantityleft`) VALUES (?,?,?)");
        $query->bind_param('iss',$productid,$code,$inventory);
        
    
        if ($query === false) {
            //change filename accordingly
            throw new Exception("Statement Preparation failed(productmanagerall)");
        }
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
        //change header location accordingly
        header("location: https://www.swapamc.com/swapproj/productmanager?error=stmtallerror");
        exit;
    }
    // throws error "Statment Execution failed" when statement fails
    try {
        $execute = $query->execute();
        if ($execute === false) {
            throw new Exception("Statement Execution failed (productmanagerall)");
        }
    } catch (Exception $e) {
        header("location: https://www.swapamc.com/swapproj/productmanager?error=stmtallerror");
        exit;
    }
    

}

unset($_SESSION['addproductinfo']);
unset($_SESSION['typesvariants']);
unset($_SESSION['addproductinfo']);
unset($_SESSION['addproductimages']);
unset($_SESSION['addtypes']);
unset($_SESSION['addproduct']);
unset($_SESSION['addproductimages']);




header("location: https://www.swapamc.com/swapproj/productmanager?error=none");
exit;







?>