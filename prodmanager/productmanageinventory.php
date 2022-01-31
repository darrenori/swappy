<?php
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



require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
$csrf=generateCSRF();
if(!$_SESSION){
    session_start();
}
if(!isset($_SESSION['addproductinfo'])||$_SESSION['addproductinfo']==null){
    header("location: https://www.swapamc.com/swapproj/productmanageradd");
   
}

if(isset($_SESSION['addproduct'])&&$_SESSION['addproduct']!=null){
    if($_SESSION['addproduct']=='A'){
        //type
        header("location: https://www.swapamc.com/swapproj/productmanagertypes");


    } else if ($_SESSION['addproduct']=='B'){
        //variants
        header("location: https://www.swapamc.com/swapproj/productmanagervariant");


    }
}


// print_r($_SESSION['typesvariants']);

$typesandvariants = $_SESSION['typesvariants'];
// print_r($typesandvariants);
echo "<br>";


$twodimensionarray=[];


echo "<br><br><br>";
foreach ($typesandvariants as $type=>$variantarray){
        //this part is to remove the 'additional costs' of the array
        $variantnames = [];
        for($k=0;$k<sizeOf($variantarray);$k++){
             //0 is name, 1 is additional cost
            array_push($variantnames,$variantarray[$k][0]);
            
        }

        array_push($twodimensionarray,$variantnames);
        
}

// print_r($twodimensionarray);

$combos = generate_combinations($twodimensionarray);
// print_r($combos);



echo "<form method='POST' action='https://www.swapamc.com/swapproj/productmanageraddall'>";

echo "<table border='1'>";

echo "<tr>";

foreach ($typesandvariants as $type=>$variantarray){
    echo "<th>".$type."</th>";
}

echo "<th>Quantity Left</th>";

echo "</tr>";


for($i=0;$i<sizeOf($combos);$i++){
    echo "<tr>";

    $comboarray = $combos[$i];

    for($k=0;$k<sizeof($comboarray);$k++){
        echo "<td>".$comboarray[$k]."</td>";
        
    }

    $name = implode("",$comboarray);

    echo "<td class='quantity'><input min='1' value='1' name='$name' onchange='calculateTotal()' class='no' type='number'></td>";

    echo "</tr>";
}





echo "</table>";



echo "<p id='total'>Total quantity: 0</p>";


echo  "<input type='submit' value='Add finish'>";
echo "<input type='hidden' name='csrf' value='$csrf'>";

echo "</form>";









?>


<html>
    <script>

        function sanitizeHTML(text) {
            var element = document.createElement('div');
            element.innerText = text;
            return element.innerHTML;
        }


        function calculateTotal(){
            all = document.getElementsByClassName('no');

            total = 0;

            for (let i = 0; i < all.length; i++) {
                quantity = sanitizeHTML(all[i].value);


                if(!isNaN(parseInt(quantity))){
                    total = total + parseInt(quantity);
                    

                }
                

                
            }

            console.log(total);


            document.getElementById('total').textContent = "Total Quantity: "+total;
        }

        calculateTotal();


        
    </script>
</html>