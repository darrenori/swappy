<?php
    
   
    

    //db con
    require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/dbh.inc.php';
    require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/product/product.function.php';
    require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/auth/pages.php';

    require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/functions.inc.php';
    
// $jwtarray = jwtdecrypt();
// if(isset($jwtarray)&&$jwtarray==true){
    
//     $jwtarrayinformation = $jwtarray['array'];

// } else {
//     header("location: ../product/viewcart");
// }
    

    checkIfIdExists($conn);
    
    if(isset($_GET['id'])){
        if(is_numeric($_GET['id'])){
            $id=$_GET["id"];
        } else {
            header("location: ../allproducts");
        }
    } else {
        header("location: ../allproducts");
    }
    
    $query=$conn->prepare("SELECT * FROM mydb.storeprod
    INNER JOIN mydb.products
    ON mydb.products.product_id = mydb.storeprod.product_id
    INNER JOIN mydb.store
    ON mydb.store.store_id = mydb.storeprod.store_id
    WHERE mydb.storeprod.product_id = $id");


    
            
    if($query->execute()){
        
        //convert to array. 
        //$query->bind_result() works too
        $result = $query->get_result();
        $array = $result->fetch_all(MYSQLI_ASSOC);

        

        $product_name= $array[0]['product_name'];
        $product_price= $array[0]['product_price'];
        $product_about= $array[0]['product_about'];
        $store_name = $array[0]['store_name'];
        echo "<h2>Store: " . $store_name . "</h2>";
        echo "Name: " . $product_name . "<br>";

        echo "Price: " . $product_price . "<br>";
        echo "About: " . $product_about. "<br><br><br>";

        


        
        
    } else {
        echo "faile";
    }


    
    $alltypes = getTypeForProduct($id,$conn);


    $numberofTypes= sizeof($alltypes);

   echo "<form method='POST' action='/swapproj/allproducts/product/addtocart'>";
    for ($i=0;$i<$numberofTypes;$i++){
        $info[$i] = getVariantsFromTypes($alltypes[$i],$id,$conn);

        // print_r($info[$i]);

        echo $alltypes[$i] . "<br>";
        $variant = $info[$i][0];
        $pricevariant = $info[$i][1];
        for($j=0;$j<sizeof($variant);$j++){
            if($pricevariant[$j]!= null && $pricevariant[$j] != "" && $pricevariant[$j]!=0){
                echo "<span class='optionscontainer'>".
                    "<span>".$variant[$j] ."</span> ".
                    "+S$"."<span id='price$variant[$j]'>".$pricevariant[$j]."</span>" .
                    "<input class='checkbox $alltypes[$i]' name='$alltypes[$i]' value='$variant[$j]' onChange='calculatePriceUserSide()' type=radio  id='$variant[$j]'>".
                "</span>";
                echo "<br>";
            } else {
                echo $variant[$j]  ."<input class=checkbox value='$variant[$j]' onChange='calculatePriceUserSide()' 
                type=radio name='$alltypes[$i]'>";
                echo "<br>";
                
            }
            
        }

        echo "<br>";
        






        
    };


    echo "<p id='left'></p>";

   echo "<p>Quantity: </p>";
   
   echo "<input id='quantity' onchange='calculatePriceUserSide()' type=number name='quantity' min=1 max=100  value=1>"."<br><br>";

   echo "Total Costs: <br>";
   
   
   echo "<p id='price'>"."$".$product_price . "</p>";

   echo "<input type='submit' >";

    echo "</form>";



   //store initial session variables
   session_start();


   

   
   
   //update jwt
   require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/functions.inc.php';
   $arraytogivejwt['productid'] = $id;
   $arraytogivejwt['progresscheckout'] = 'A';
   jwtupdate($arraytogivejwt);

//    print_r(apache_request_headers()); 


    echo "<h2>Reviews</h2>";

    echo "<form method='POST' action='/swapproj/addreview'>";

    echo "<p>Comment:</p>";
    echo "<input type='text' name='comment'>";

    echo "<p>Rating:</p>";
    echo "<input type='number' max=5 min=1 name='rating'>";
    echo "<br><br>";

    echo "<input type='submit'>";
    

    echo "</form>";

    
    require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/images/showimage.php';
    $image = new Image();
    $src = $image->show("images/wite.jpg");
    echo '<img src="'.$src.'" />';


    
   
    
    
    

?>




<html>





<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

     <!-- <script src='https://www.swapamc.com/swapproj/allproducts/product/script'></script> -->
    <script type="text/javascript">

        function calculatePriceUserSide(){
            var priceforone = "<?php echo json_encode($product_price); ?>";
            

            //cgeckbox are inputfield
            var checkboxesarray = document.getElementsByClassName("checkbox");
            for (let i = 0; i < checkboxesarray.length; i++) {
                if (checkboxesarray[i].checked){
                    
                    var additional = document.getElementById("price"+checkboxesarray[i].id);
                    if(!isNaN(parseFloat(additional.innerHTML))){
                        priceforone = (parseFloat(priceforone) + parseFloat(additional.innerHTML)).toFixed(2);
                    }
                    
                    
                   // console.log("one" + priceforone);
                } else {


                    // var additional = document.getElementById("price"+checkboxesarray[i].id);
                    // priceforone = (parseFloat(priceforone) + parseFloat(additional.innerHTML)).toFixed(2);
                    // var additional = document.getElementById("price"+checkboxesarray[i].id);
                    // priceforone = (parseFloat(priceforone) - parseFloat(additional.innerHTML)).toFixed(2);
                    // console.log("nt checked");
                
                    //console.log("one" + priceforone);
                }
            }

            var quantity = document.getElementById("quantity").value;

            var total = (quantity * priceforone).toFixed(2);
            document.getElementById("price").innerHTML = "$"+total;


            calculateInventory();

        }

        function calculateInventory(){

            var typesandvariants = {}; //use json style array as we want to push to ajax

            typesandvariants['type'] = 'ajax';
            typesandvariants['product_name'] = <?php echo json_encode($product_name); ?>;
            
            //cgeckbox are inputfield
            var checkboxesarray = document.getElementsByClassName("checkbox");
            for (let i = 0; i < checkboxesarray.length; i++) {
               
                if (checkboxesarray[i].checked){

                    typesandvariants[checkboxesarray[i].getAttribute("name")] = checkboxesarray[i].getAttribute("value");

                   
                }
            }

            
            

            var jsonString = JSON.stringify(typesandvariants);

            


            
            jQuery.ajax({
                url:'https://www.swapamc.com/swapproj/checkquantity',
                type:'post',
                data: {info:jsonString},
                

                success:function(result){

                    console.log(result);



                    if(result!=null&&result!=''){

                        // console.log(result);
                        document.getElementById("left").innerHTML = "ONLY "+result+" REMAINING";
                        
                        document.getElementById("quantity").setAttribute("max",result);

                        // if(document.getElementById("quantity").value>result){
                        //     document.getElementById("quantity").value = result;
                        //     document.getElementById("quantity").setAttribute("value",result);

                        // }
                        
                    }

                    
                    
                    
                }

            });


            


        }

        //initalise - if product has no types, run this
        calculateInventory();

        




        
          
          

  
    </script>



</html>

