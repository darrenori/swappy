<?php


require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';


session_start();


if(!isset($_SESSION['addproductinfo'])||$_SESSION['addproductinfo']==null){
    header("location: https://www.swapamc.com/swapproj/productmanagertypes");
   
}


$productinfo = $_SESSION['addproductinfo'];

$productname = $productinfo[0];

echo "Product";
echo "<br>";

echo "<p>$productname</p>";
echo "<br><br><br>";

echo "<form action='https://www.swapamc.com/swapproj/productmanageraddtypes' method='post'>";

echo "<div id='inputfields'>";

echo "<p>Type:</p>";
echo '<div><input type="text" class="field" name="type1"/><a href="#" class="remove_field">Remove</a></div>';


echo "</div>";

echo "<input type='submit' value='submit'>";

echo "</form>";

// echo '<input type="button"  id="add" value="Add input"/>';


?>



<html>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
$(document).ready(function() {
    var max_fields      = 3; //maximum input boxes allowed
    var wrapper         = $("#inputfields"); //Fields wrapper
    var add_button      = $("#add"); //Add button ID

    var x = 1; //initlal text box count
    $(document).on("change", ".field", function(e){//on add input button click
        
        e.preventDefault();

        if (x == max_fields){
            alert("total fields has been reached!");
        }

        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div><input type="text" class="field" name="type'+x+'"/><a href="#" class="remove_field">Remove</a></div>'); //add input box
        }
    });

    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        if(x!=1){
            e.preventDefault(); $(this).parent('div').remove(); x--;
        }
        
    })
});


</script>
</html>
    
