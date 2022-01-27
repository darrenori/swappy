<?php

function getTypesVariants($productid, $conn){

    


    $query=$conn->prepare("SELECT DISTINCT type,mydb.type.type_choice FROM mydb.product_type 
    INNER JOIN mydb.products 
    ON mydb.products.product_id = mydb.product_type.product_id 
    INNER JOIN mydb.type 
    ON mydb.type.type_id = mydb.product_type.type_id 
    WHERE mydb.product_type.product_id = $productid;");

    $alltypes = [];

    if($query->execute()){
        
        //convert to array. 
        //$query->bind_result() works too
        $result = $query->get_result();
        $array = $result->fetch_all(MYSQLI_ASSOC);

        

        

    }
    $query->close();


    $totalrows = sizeof($array);

    $alltypesandvariants=[];

    for($i=0;$i<$totalrows;$i++){
        $type= $array[$i]['type'];
        $variant = $array[$i]['type_choice'];
        if(isset($alltypesandvariants[$type])){
            $variantarray = $alltypesandvariants[$type];
            array_push($variantarray,$variant);
            $alltypesandvariants[$type]=$variantarray;

        } else {
            $alltypesandvariants[$type] = [$variant];
        }
        
         
        
    }

    

    return $alltypesandvariants;
}


function getTypeForProduct($productid, $conn){

    


    $query=$conn->prepare("SELECT DISTINCT type FROM mydb.product_type 
    INNER JOIN mydb.products 
    ON mydb.products.product_id = mydb.product_type.product_id 
    INNER JOIN mydb.type 
    ON mydb.type.type_id = mydb.product_type.type_id 
    WHERE mydb.product_type.product_id = $productid;");

    $alltypes = [];

    if($query->execute()){
        
        //convert to array. 
        //$query->bind_result() works too
        $result = $query->get_result();
        $array = $result->fetch_all(MYSQLI_ASSOC);

        $totalrows = sizeof($array);

        for($i=0;$i<$totalrows;$i++){
            $type= $array[$i]['type'];
            $alltypes[$i] = $type;
            //echo $type;
        }

        return $alltypes;

        

    }
}


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





require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';


if(isset($_GET['id'])&&$_GET['id']!=null){
    $id = $_GET['id'];

    if(badInputTwo([$id])!=false){
        exit;
        header("location: https://www.swapamc.com/swapproj/productmanager?error=id");
        exit();
    }
}


//check if id exists
try {
    $query = $conn->prepare("SELECT product_name FROM mydb.products WHERE product_id = ?;");
    $query->bind_param('s',$id);
    if ($query === false) {
        //change filename accordingly
        throw new Exception("Statement Preparation failed(quantity)");
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
        throw new Exception("Statement Execution failed (quantity)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    header("location: https://www.swapamc.com/swapproj/productmanager?error=stmt");

    exit;
}

$result = $query->get_result();
$arrayone = $result->fetch_all(MYSQLI_ASSOC);
if(sizeof($arrayone)<1){
    
    header("location: https://www.swapamc.com/swapproj/productmanager?error=productid");

    exit;

}


$query->close();

$productname = $arrayone[0]['product_name'];
$alltypesvariant= getTypesVariants($id,$conn);
$types = getTypeForProduct($id,$conn);


if($types!=null&&$alltypesvariant!=null){
    echo "<h1>$productname</h1>";

    echo "<table border='1'>";
    echo "<tr>";

    for($i=0;$i<sizeof($types);$i++){
        echo "<th>".$types[$i]."</th>";

    }

    echo "<th>"."Quantity"."</th>";
    echo "</tr>";

    $all=generate_combinations($alltypesvariant);

    for($k=0;$k<sizeof($all);$k++){
        echo "<tr>";
        $vararray = $all[$k];

        $name=$productname.",";

        for($p=0;$p<sizeof($vararray);$p++){
            echo "<td>".$vararray[$p]."</td>";
            

            
            if($p==sizeof($vararray)-1){
                $name = $name .$types[$p].",".$vararray[$p];
            } else {
                $name = $name .$types[$p].",".$vararray[$p]. ",";
            }
            
            
        }


        
        $hashed = md5($name);
        //get current quantity;
        //check if id exists
        try {
            
            $query = $conn->prepare("SELECT quantityleft FROM mydb.inventory WHERE productcode = ?;");
            $query->bind_param('s',$hashed);
            if ($query === false) {
                //change filename accordingly
                throw new Exception("Statement Preparation failed(quantity)");
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
                throw new Exception("Statement Execution failed (quantity)");
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
            header("location: https://www.swapamc.com/swapproj/productmanager?error=stmt");

            exit;
        }

        $query->bind_result($dbqnty);
        $query->fetch();
        $query->close();

        







        echo "<td class='quantity'><input min='1' value='$dbqnty' name='$name' id='$k' onchange=updateQuantity($k) class='no' type='number'></td>";

        echo "</tr>";
    }






    echo "</table>";


} else {
    //no types
    echo "<h1>$productname</h1>";

    echo "<table border='1'>";
    echo "<tr>";

        
        echo "<th>quantity</th>";
    echo "</tr>";


    
        



    $name = $productname;
    $hashed = md5($name);

    try {
            
        $query = $conn->prepare("SELECT quantityleft FROM mydb.inventory WHERE productcode = ?;");
        $query->bind_param('s',$hashed);
        if ($query === false) {
            //change filename accordingly
            throw new Exception("Statement Preparation failed(quantity)");
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
            throw new Exception("Statement Execution failed (quantity)");
        }
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
        header("location: https://www.swapamc.com/swapproj/productmanager?error=stmt");

        exit;
    }

    $query->bind_result($dbqnty);
    $query->fetch();
    $query->close();

    echo "<tr>";

    echo "<td class='quantity'><input min='1' value='$dbqnty' name='$name' id='0' onchange=updateQuantity(0) class='no' type='number'></td>";

    

    echo "</tr>";




    echo "</table>";


}















//list all types


?>

<html>
<script>
    
    function sanitizeHTML(text) {
                    var element = document.createElement('div');
                    element.innerText = text;
                    return element.innerHTML;
        }



    function updateQuantity(id) {
        var name = document.getElementById(id).getAttribute('name');
        var value = document.getElementById(id).value;

      
        name = sanitizeHTML(name);
        value = sanitizeHTML(value);

        var array= {};
        array['type'] = 'ajax';
        array['name'] = name;
        array['value'] = value;
        

        var jsonString = JSON.stringify(array);


        jQuery.ajax({
            url: 'https://www.swapamc.com/swapproj/productmanager/quantityinc',
            type: 'post',
            data: {info:jsonString},
            success: function(result) {
                console.log(result);
                
            }

        });
    }
</script>
</html>