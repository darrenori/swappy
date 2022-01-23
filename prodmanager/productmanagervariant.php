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
$alltypes = $_SESSION['addtypes'];


echo "Product";
echo "<br>";

echo "<p>$productname</p>";
echo "<br><br><br>";

echo "<form action='https://www.swapamc.com/swapproj/productmanageraddvariants' method='post'>";


for($i=0;$i<sizeof($alltypes);$i++){

    echo "<div>";

    echo "<h1 id='$alltypes[$i]' class='types'>Type: $alltypes[$i]</h1>";


    echo "<div class='deletewrapper' id='inputfields$alltypes[$i]'>";   
    echo "<p>Variant:</p>";
    echo '<div><input type="text" class="field" name="'.$alltypes[$i].'variant1" /><input type="number" step="any" placeholder="additionalcosts" class="field" name="'.$alltypes[$i].'variant1cost" /><a href="#" class="remove_field">Remove</a></div>';
    echo "</div>";

    echo "</div>";
    echo '<input type="button" class="add" id="'.$alltypes[$i].'" value="Add input"/>';


}


echo "<br><br>";
echo "<input type='submit' value='submit'>";

echo "</form>";



?>



<html>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>

$(document).ready(function() {
    var max_fields      = 5; //maximum input boxes allowed
    var add_button      = $(".add"); //Add button ID
    var deletewrapper = $(".deletewrapper"); //Fields wrapper
    var currentfields = [];
    

    alltype = document.getElementsByClassName('types');

    for (let i = 0; i < alltype.length; i++) {
        currentfields[alltype[i].id] = 1; //inital text box count
       
    }


    $(add_button).click(function(e){//on add input button click

        
        
        e.preventDefault();



        name=this.id;

        
        
        var wrapper = $("#inputfields"+name); //Fields wrapper

        if (currentfields[name] == max_fields){
            alert("total fields has been reached!");
        }

        if(currentfields[name] < max_fields){ //max input box allowed
            currentfields[name] = currentfields[name]+1;
            $(wrapper).append('<div><input type="text" class="field" name="'+name+'variant'+currentfields[name]+'"/><input type="number" step="any" placeholder="additionalcosts" class="field" name="'+name+'variant'+currentfields[name]+'cost" /><a href="#" class="remove_field">Remove</a></div>'); //add input box
        }
    });

    $(deletewrapper).on("click",".remove_field", function(e){ //user click on remove text
        
        if(currentfields[name]!=1){
            e.preventDefault(); $(this).parent('div').remove(); 
            currentfields[name]=currentfields[name]-1;
        }
        
    })
});

</script>