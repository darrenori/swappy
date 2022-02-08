<html>
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
         integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</html>





<?php
ob_start();
// require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/user_auth.php';
// require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
// require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/auth/pages.php';

require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/navbar.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/images/showimage.php';
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">
<?php include 'product/css/productcss.php'; ?>


<?php

function checkId($array)
    {
    // $pattern = "/^[a-zA-Z0-9_ ]*$/i";
    // checks for anything that is not from the following list
    $pattern = "/^[0-9]+$/i";

    foreach($array as $key => $value) {
        
        $a = !(preg_match($pattern, $value));

        if ($a == 1) {
            return true;
        }
    }

    return false;

    //0 is valid input

    }

    function getRating($number,$reviewid){
        if($number==0){
            echo "<div class='reviewsrating' id='reviewsrating$reviewid'>";
            echo "<i style='opacity:0.5' class=\"fas fa-cog\"></i>";
            echo "<i style='opacity:0.5' class=\"fas fa-cog\"></i>";
            echo "<i style='opacity:0.5' class=\"fas fa-cog\"></i>";
            echo "<i style='opacity:0.5' class=\"fas fa-cog\"></i>";
            echo "<i style='opacity:0.5' class=\"fas fa-cog\"></i>";
            echo "</div>";
    
    
        }elseif($number==1){
    
            echo "<div class='reviewsrating' id='reviewsrating$reviewid'>";
            echo "<i class=\"fas fa-cog\"></i>";
            echo "<i style='opacity:0.5' class=\"fas fa-cog\"></i>";
            echo "<i style='opacity:0.5' class=\"fas fa-cog\"></i>";
            echo "<i style='opacity:0.5' class=\"fas fa-cog\"></i>";
            echo "<i style='opacity:0.5' class=\"fas fa-cog\"></i>";
            echo "</div>";
    
    
        }elseif($number==2){
    
            echo "<div class='reviewsrating' id='reviewsrating$reviewid'>";
            echo "<i class=\"fas fa-cog\"></i>";
            echo "<i class=\"fas fa-cog\"></i>";
            echo "<i style='opacity:0.5' class=\"fas fa-cog\"></i>";
            echo "<i style='opacity:0.5' class=\"fas fa-cog\"></i>";
            echo "<i style='opacity:0.5' class=\"fas fa-cog\"></i>";
            echo "</div>";
    
    
        }elseif($number==3){
            echo "<div class='reviewsrating' id='reviewsrating$reviewid'>";
            echo "<i class=\"fas fa-cog\"></i>";
            echo "<i class=\"fas fa-cog\"></i>";
            echo "<i style='opacity:0.5' class=\"fas fa-cog\"></i>";
            echo "<i style='opacity:0.5' class=\"fas fa-cog\"></i>";
            echo "<i style='opacity:0.5' class=\"fas fa-cog\"></i>";
            echo "</div>";
    
    
        }elseif($number==4){
            echo "<div class='reviewsrating' id='reviewsrating$reviewid'>";
            echo "<i class=\"fas fa-cog\"></i>";
            echo "<i class=\"fas fa-cog\"></i>";
            echo "<i class=\"fas fa-cog\"></i>";
            echo "<i class=\"fas fa-cog\"></i>";
            echo "<i style='opacity:0.5' class=\"fas fa-cog\"></i>";
            echo "</div>";
    
    
        }elseif($number==5){
            echo "<div class='reviewsrating' id='reviewsrating$reviewid'>";
            echo "<i class=\"fas fa-cog\"></i>";
            echo "<i class=\"fas fa-cog\"></i>";
            echo "<i class=\"fas fa-cog\"></i>";
            echo "<i class=\"fas fa-cog\"></i>";
            echo "<i class=\"fas fa-cog\"></i>";
            echo "</div>";
    
    
        }
    }





require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/product/includes/productfunctions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
$filename = basename(__FILE__, '.php'); // filename variable is now set as allstores for example
$jwtarray = jwtdecrypt();
    if(isset($jwtarray)&&$jwtarray==true){
        
        $jwtarrayinformation = $jwtarray['array'];
    
    } else {
        
        header("location: https://www.swapamc.com/swapproj/logout");
        exit();
    }


    $userid = $jwtarrayinformation['userid'];

    $jwtarray = jwtdecrypt();
    $jwtarray_insidearray = $jwtarray['array'];
    $postinformation = [];
    $userid = $jwtarray_insidearray['userid'];
    // $productid = $jwtarray_insidearray["productid"];


   
    if(isset($jwtarray)&&$jwtarray==true){
        
        $jwtarrayinformation = $jwtarray['array'];
    
    } else {
        
        header("location: https://www.swapamc.com/swapproj/logout");
        exit();
    }


    

    foreach ($_POST as $key => $value) {
        //echo "$key = $value<br>";
        
        if($key!="quantity"){
            $postinformation[$key] = $value;
        }
    }

   
    
    

    //check if quantity valid
    $whitelist=['cart'];
    $maxlengtharray['cart']=11;
    $methd = $_GET;
    $empty = checkEmpty($methd,$whitelist);

    if($empty!=null){
        header("location: https://www.swapamc.com/swapproj/allproducts/product/viewcart?error=empty".$empty);
        exit();
    } 

    $validarray = XSSPrevention($methd,$whitelist);
    $validarray = escapeString($conn,$validarray);


    if(checkId($validarray)!=false){
        error_log("TPAMC:".$filename.":4:$ipadd:2 Malicious input", 0);
        header("location: https://www.swapamc.com/swapproj/allproducts/product/viewcart?error=malicious");
        exit();
    }

    if(checkLength($validarray,$maxlengtharray)!=null){   
        header("location: https://www.swapamc.com/swapproj/allproducts/product/viewcart?error=toolong");
        exit();
    }

    $csrf=generateCSRF();
    
    






    echo "<div class='top'>";
        echo "<div class='left'>";
            echo "<div class='rectangle'>";

            echo "</div>";
            echo "<div class=\"tags\">";
                echo "<p class='tagsheader'>Tags</p>";
                echo "<button class='tagsbtn'>Others</button>";
                echo "<button class='tagsbtn'>Utility</button>";
            echo "</div>";
    
            echo "<div class='extrainfo'>";
                echo "<div class='extrainforow'>";
                echo "<span>Delivery Available</span>";
                echo "<i class=\"tk fas fa-check-circle\"></i>";
                
            
            echo "</div>";
    
            echo "<div class='extrainforow'>";
                echo "<span>Fixed Shipping Costs</span>";
                echo "<i class=\"tk fas fa-check-circle\"></i>";
            echo "</div>";
            
            echo "<div class='extrainforow'>";
                echo "<span>Return/Refund</span>";
                echo "<i class=\"tk fas fa-times-circle\"></i>";
            echo "</div>";


        echo "</div>";

        echo "</div>";



            
            

            


            if(!isset($_GET['cart'])){
                header("location: ../product/viewcart");

                
            } elseif(!is_numeric($_GET['cart'])){
                
                header("location: ../product/viewcart");

            } else {
                $cartid = $_GET['cart'];

                //check if information matches in databaase
                try {
                    $query=$conn->prepare("SELECT product_name, product_price,product_about,product_picone FROM mydb.user_cart
                    INNER JOIN mydb.products
                    ON mydb.user_cart.product_id = mydb.products.product_id
                    WHERE cart_id = ?;");
                    $query->bind_param('s',$cartid);
                    
                    if ($query === false) {
                        //change filename accordingly
                        throw new Exception("Statement Preparation failed");
                    }
                } catch (Exception $e) {
                    error_log("TPAMC:".$filename.":3:$ipadd:1 ERROR preparing statement (SELECT)", 0);
                    //change header location accordingly
                    header("location: https://www.swapamc.com/swapproj/allproducts/product/viewcart?error=sqlfailed");
                    exit();
                }
                


                // throws error "Statment Execution failed" when statement fails
                try {
                    $execute = $query->execute();
                    if ($execute === false) {
                        throw new Exception("Statement Execution failed");
                    }
                } catch (Exception $e) {
                    error_log("TPAMC:".$filename.":3:$ipadd:1 ERROR executing statement (SELECT)", 0);
                    header("location: https://www.swapamc.com/swapproj/allproducts/product/viewcart?error=sqlfailed");
                    exit();
                }




                
                $query->bind_result($name,$price,$about,$picone);

                if($query->fetch()){
                    $productname = $name;
                    $price = $price;

                    $arraytogivejwt['productname'] = $productname;
                    $arraytogivejwt['productprice'] = $price;
                    $arraytogivejwt['cartid'] = $cartid;
                    jwtupdate($arraytogivejwt);
                }
                

            }



        echo "<div class='right'>"; 

            


            echo "<h1 class='prodname'>$name</h1>";

            echo "<h3 class='price'>$price</h3>";

            echo "<div class='refunds'>";
            echo "<p class='refundsheader'>No returns/refunds</p>";
            echo "<p class='refundsbody'>Item is confirmed after payment confirmation. No";
            echo "refunds, returns or exchanges will be entertained";
            echo "as required by law</p>";
            echo "</div>";

            echo "<div class=\"details\">";
                echo "<p class='detailsheader'>Details</p>";
                echo "<p class='detailsbody'>$about</p>";
            echo "</div>";




            if(isset($picone)){
                echo "<style>";
                echo ".rectangle{";
                    require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/images/showimage.php';
                    $image = new Image();
                    $src = $image->show($picone);
                    echo "background:linear-gradient(rgba(0, 0, 0, 0.3),rgba(0, 0, 0, 0.3)), url('$src');";
                    echo 'flex-basis: 100%;';
                    echo 'height: 85vh;';
                    echo 'background-position: center;';
                    echo 'background-size: cover;';
                    echo 'background-image: black;';
                    echo 'background-repeat: no-repeat;';
                echo "}";
                echo "</style>";

            } else {
                echo "<style>";
                echo ".rectangle{";
                    require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/images/showimage.php';
                    $image = new Image();
                    $src = $image->show('uploads/IMG-DEFAULTPROFILE.jpg');
                    echo "background:linear-gradient(rgba(0, 0, 0, 0.3),rgba(0, 0, 0, 0.3)), url('$src');";
                    echo 'flex-basis: 100%;';
                    echo 'height: 85vh;';
                    echo 'background-position: center;';
                    echo 'background-size: cover;';
                    echo 'background-image: black;';
                    echo 'background-repeat: no-repeat;';
                echo "}";
                echo "</style>";

            }
    

            

            $query->close();
            //check if information matches in database

            try {
                $query=$conn->prepare("SELECT cart_typevariants_type,cart_typevariants_variant,price,quantity FROM mydb.cart_typevariants 
                INNER JOIN mydb.user_cart
                ON mydb.cart_typevariants.cart_id = mydb.user_cart.cart_id
                where mydb.cart_typevariants.cart_id=?;");
                $query->bind_param('s',$cartid);
                
                if ($query === false) {
                    //change filename accordingly
                    throw new Exception("Statement Preparation failed");
                }
            } catch (Exception $e) {
                error_log("TPAMC:".$filename.":3:$ipadd:1 ERROR preparing statement (SELECT)", 0);
                //change header location accordingly
                header("location: https://www.swapamc.com/swapproj/allproducts/product/viewcart?error=sqlfailed");
                exit();
            }



            // throws error "Statment Execution failed" when statement fails
            try {
                $execute = $query->execute();
                if ($execute === false) {
                    throw new Exception("Statement Execution failed");
                }
            } catch (Exception $e) {
                error_log("TPAMC:".$filename.":3:$ipadd:1 ERROR executing statement (SELECT)", 0);
                header("location: https://www.swapamc.com/swapproj/allproducts/product/viewcart?error=sqlfailed");
                exit();
            }





            $alltypes = [];


            $query->bind_result($type, $variant, $total, $quantity);

            while ($query->fetch()) {
                array_push($alltypes, $type);

                $selectedchoices[$type] = $variant;
            }

            if(!isset($productname)){
                header("location: https://www.swapamc.com/swapproj/allproducts/product/viewcart");
                exit;
            }





            $query->close();




            //if there is a type

            if (isset($selectedchoices)) {
                $numberofTypes = sizeof($alltypes);

                echo "<form method='POST'>";
                for ($i = 0; $i < $numberofTypes; $i++) {
                    $info[$i] = getVariantsFromTypesUsingName($alltypes[$i], $productname, $conn);

                    // print_r($info[$i]);

                    echo $alltypes[$i] . "<br>";
                    $variant = $info[$i][0];
                    $pricevariant = $info[$i][1];


                    echo "<div class='typerow'>";

                            

                        echo '<div class="variants">';
                            echo '<ul class="donate-now">';

                            for ($j = 0; $j < sizeof($variant); $j++) {
                                
                                        if ($pricevariant[$j] != null && $pricevariant[$j] != "" && $pricevariant[$j] != 0) {
                                            
                                            $txx = $variant[$j] . " (+$".$pricevariant[$j].")";
                                            //what the user has chosen before when adding to cart
                                            if($selectedchoices[$alltypes[$i]]==$variant[$j]){
                                                // echo "<span class='optionscontainer'>" . "<span>" . $variant[$j] . "</span> " . "+S$" . "<span id='price$variant[$j]'>" . $pricevariant[$j] . "</span>" . "<input class=checkbox name='$alltypes[$i]' value='$variant[$j]' onChange='calculatePriceUserSide()' type=radio  id='$variant[$j]' checked >" . "</span>";
                                                // echo "<br>";

                                                echo '<li>';
                                                    echo "<input type='radio' class='checkbox $alltypes[$i]' style='opacity:0' id='$variant[$j]' value='$variant[$j]' onChange='calculatePriceUserSide()' name='$alltypes[$i]' checked/>";
                                                    echo "<label for='$variant[$j]'>".$txx."</label>";
                                                    echo "<span style='display:none' id='price$variant[$j]'>".$pricevariant[$j]."</span>";

                                                echo '</li>';
                                            } else {
                                                // echo "<span class='optionscontainer'>" . "<span>" . $variant[$j] . "</span> " . "+S$" . "<span id='price$variant[$j]'>" . $pricevariant[$j] . "</span>" . "<input class=checkbox name='$alltypes[$i]' value='$variant[$j]' onChange='calculatePriceUserSide()' type=radio  id='$variant[$j]' >" . "</span>";
                                                // echo "<br>";
                                                echo '<li>';
                                                    echo "<input type='radio' class='checkbox $alltypes[$i]' style='opacity:0' id='$variant[$j]' value='$variant[$j]' onChange='calculatePriceUserSide()' name='$alltypes[$i]' />";
                                                    echo "<label for='$variant[$j]'>".$txx."</label>";
                                                    echo "<span style='display:none' id='price$variant[$j]'>".$pricevariant[$j]."</span>";

                                                echo '</li>';
                                            }

                                            
                                        } else {

                                            if($selectedchoices[$alltypes[$i]]==$variant[$j]){
                                                // echo '<li>';
                                                //     echo "<input type='radio' class='checkbox $alltypes[$i]' id='$variant[$j]' style='opacity:0'  value='$variant[$j]' onChange='calculatePriceUserSide()' name='$alltypes[$i]' />";
                                                //     echo "<label for='$variant[$j]'>".$variant[$j]."</label>";
                                                // echo '</li>';
                                                echo '<li>';
                                                    echo "<input type='radio' class='checkbox $alltypes[$i]' id='$variant[$j]' style='opacity:0'  value='$variant[$j]' onChange='calculatePriceUserSide()' name='$alltypes[$i]' checked/>";
                                                    echo "<label for='$variant[$j]'>".$variant[$j]."</label>";
                                                echo '</li>';

                                            } else {
                                                // echo '<li>';
                                                //     echo "<input type='radio' class='checkbox $alltypes[$i]' id='$variant[$j]' style='opacity:0'  value='$variant[$j]' onChange='calculatePriceUserSide()' name='$alltypes[$i]' />";
                                                //     echo "<label for='$variant[$j]'>".$variant[$j]."</label>";
                                                // echo '</li>';
                                                echo '<li>';
                                                    echo "<input type='radio' class='checkbox $alltypes[$i]' id='$variant[$j]' style='opacity:0'  value='$variant[$j]' onChange='calculatePriceUserSide()' name='$alltypes[$i]' />";
                                                    echo "<label for='$variant[$j]'>".$variant[$j]."</label>";
                                                echo '</li>';

                                            }
                                        }
                                
                            }

                            echo '</ul>';
                        echo '</div>';

                        
                    
                    echo "</div>"; //typerow
                };

                // echo "<p id='left'></p>";


                // echo "<p>Quantity: </p>";
                // echo "<input id='quantity' onchange='calculatePriceUserSide()' type=number name='quantity' value=$quantity>" . "<br><br>";
                echo "<div class='cont'>";
                    echo "<p class='quantityheader'>Quantity</p>";
                    echo "<div class=\"quantity-control\" data-quantity=\"\">";
                    echo "<button type='button' class=\"quantity-btn\" data-quantity-minus=\"\"><svg viewBox=\"0 0 409.6 409.6\">";
                    echo "<g>";
                    echo "<g>";
                    echo "<path d=\"M392.533,187.733H17.067C7.641,187.733,0,195.374,0,204.8s7.641,17.067,17.067,17.067h375.467 c9.426,0,17.067-7.641,17.067-17.067S401.959,187.733,392.533,187.733z\" />";
                    echo "</g>";
                    echo "</g>";
                    echo "</svg></button>";
                    echo "<input type='number' id='quantity' onchange='calculatePriceUserSide()' class='quantity-input' data-quantity-target='' value='$quantity' step='1' min='1' max='10' name='quantity'>";
                    echo "<button type='button' class=\"quantity-btn\" data-quantity-plus=\"\"><svg viewBox=\"0 0 426.66667 426.66667\">";
                    echo "<path d=\"m405.332031 192h-170.664062v-170.667969c0-11.773437-9.558594-21.332031-21.335938-21.332031-11.773437 0-21.332031 9.558594-21.332031 21.332031v170.667969h-170.667969c-11.773437 0-21.332031 9.558594-21.332031 21.332031 0 11.777344 9.558594 21.335938 21.332031 21.335938h170.667969v170.664062c0 11.777344 9.558594 21.335938 21.332031 21.335938 11.777344 0 21.335938-9.558594 21.335938-21.335938v-170.664062h170.664062c11.777344 0 21.335938-9.558594 21.335938-21.335938 0-11.773437-9.558594-21.332031-21.335938-21.332031zm0 0\" />";
                    echo "</svg>";
                    echo "</button>";
                    echo "</div>";
                    echo "";
                echo "</div>";
                echo "<p id='left' style='opacity:0.7;margin-top:10px'></p>";









                // echo "Total Costs: <br>";


                // echo "<p id='price'>" . "$" . $total . "</p>";

                // echo "<input type='submit' value='edit' formaction='/swapproj/allproducts/product/changes'>";
                







                // print_r($jwtarrayinformation);

                $id=$jwtarrayinformation['productid'];
                $signedinuserid=$jwtarrayinformation['userid'];
// print_r($jwtarrayinformation);
                //add to favorites
                try {
                    $query = $conn->prepare("SELECT product_id,user_id FROM mydb.usersfavorite WHERE product_id = ? AND user_id =?;");
                    $query->bind_param('ss',$id,$signedinuserid);
                    if ($query === false) {
                        //change filename accordingly
                        throw new Exception("Statement Preparation failed(favoriteproduct)");
                    }
                } catch (Exception $e) {
                    echo 'Message: ' . $e->getMessage();
                    //change header location accordingly
                    header("location: https://www.swapamc.com/swapproj/allproducts?error=badstatement");
                    exit;
                }


                // throws error "Statment Execution failed" when statement fails
                try {
                    $execute = $query->execute();
                    if ($execute === false) {
                        throw new Exception("Statement Execution failed (favoriteproduct)");
                    }
                } catch (Exception $e) {
                    echo 'Message: ' . $e->getMessage();
                    header("location: https://www.swapamc.com/swapproj/allproducts?error=badstatement");
                    exit;
                }

                // $query->close();

                $result = $query->get_result();
                $array = $result->fetch_all(MYSQLI_ASSOC);



                // print_r($array);


                if(sizeOf($array)==1){

                    //already favorited
                    // echo "<div id='favorite$id'><button type='button'  onclick='favorite($id)'>Unfavorite</button></div>";
                
                    echo "<div class='lastpart'>";
                            echo "<h1 class='totaloverall' id='price'>Total: S$".$total."</h1>";
                            echo "<div class='lastpartbuttons'>";
                                echo '<input class="addtocart" type="submit" formaction="/swapproj/allproducts/product/changes" value="UPDATE">';
                                echo "<button type='button' onclick='favorite($id)' id='favorite$id' class='afterfavoritebtn'><i class='far fa-heart'></i></button>";
                                echo "<input class='deletecss' type='submit' value='Delete' formaction='/swapproj/allproducts/product/delete'>";
                            echo '</div>';
                        echo '</div>';
                
                } else {
                    // echo "<div id='favorite$id'><button type='button'  onclick='favorite($id)'>Favorite this</button></div>";
                
                    echo "<div class='lastpart'>";
                            echo "<h1 class='totaloverall' id='price'>Total: S$".$total."</h1>";
                            echo "<div class='lastpartbuttons'>";
                                echo '<input class="addtocart" type="submit"  formaction="/swapproj/allproducts/product/changes" value="UPDATE">';
                                echo "<button type='button' onclick='favorite($id)' id='favorite$id' class='favoritebtn'><i class='far fa-heart'></i></button>";
                                echo "<input class='deletecss' type='submit' value='Delete' formaction='/swapproj/allproducts/product/delete'>";
                            echo '</div>';
                    echo '</div>';
                
                }
                
                echo "<input type='hidden' name='csrf' value='$csrf'>";

                echo "</form>";

                



        echo "</div>"; //right end


    echo "</div>"; //top



            } else {
                


                // print_r($cartid);
                // $query->close();



                //if product has no tytpwes
                
                try {
                    $query=$conn->prepare("SELECT quantity,price FROM mydb.user_cart WHERE cart_id = ?;");
                    $query->bind_param('s',$cartid);
                    
                    if ($query === false) {
                        //change filename accordingly
                        throw new Exception("Statement Preparation failed");
                    }
                } catch (Exception $e) {
                    error_log("TPAMC:".$filename.":3:$ipadd:1 ERROR preparing statement (SELECT)", 0);
                    //change header location accordingly
                    header("location: https://www.swapamc.com/swapproj/allproducts/product/viewcart?error=sqlfailed");
                    exit();
                }
                
                
                
                // throws error "Statment Execution failed" when statement fails
                try {
                    $execute = $query->execute();
                    if ($execute === false) {
                        throw new Exception("Statement Execution failed");
                    }
                } catch (Exception $e) {
                    error_log("TPAMC:".$filename.":3:$ipadd:1 ERROR executing statement (SELECT)", 0);
                    header("location: https://www.swapamc.com/swapproj/allproducts/product/viewcart?error=sqlfailed");
                    exit();
                }

                
                    $query->bind_result($quantity,$total);

                    $query->fetch();











                    echo "<form method='POST'>";
                
                    echo "<div class='cont'>";
                        echo "<p class='quantityheader'>Quantity</p>";
                        echo "<div class=\"quantity-control\" data-quantity=\"\">";
                        echo "<button type='button' class=\"quantity-btn\" data-quantity-minus=\"\"><svg viewBox=\"0 0 409.6 409.6\">";
                        echo "<g>";
                        echo "<g>";
                        echo "<path d=\"M392.533,187.733H17.067C7.641,187.733,0,195.374,0,204.8s7.641,17.067,17.067,17.067h375.467 c9.426,0,17.067-7.641,17.067-17.067S401.959,187.733,392.533,187.733z\" />";
                        echo "</g>";
                        echo "</g>";
                        echo "</svg></button>";
                        echo "<input type='number' id='quantity' onchange='calculatePriceUserSide()' class='quantity-input' data-quantity-target='' value='$quantity' step='1' min='1' max='10' name='quantity'>";
                        echo "<button type='button' class=\"quantity-btn\" data-quantity-plus=\"\"><svg viewBox=\"0 0 426.66667 426.66667\">";
                        echo "<path d=\"m405.332031 192h-170.664062v-170.667969c0-11.773437-9.558594-21.332031-21.335938-21.332031-11.773437 0-21.332031 9.558594-21.332031 21.332031v170.667969h-170.667969c-11.773437 0-21.332031 9.558594-21.332031 21.332031 0 11.777344 9.558594 21.335938 21.332031 21.335938h170.667969v170.664062c0 11.777344 9.558594 21.335938 21.332031 21.335938 11.777344 0 21.335938-9.558594 21.335938-21.335938v-170.664062h170.664062c11.777344 0 21.335938-9.558594 21.335938-21.335938 0-11.773437-9.558594-21.332031-21.335938-21.332031zm0 0\" />";
                        echo "</svg>";
                        echo "</button>";
                        echo "</div>";
                        echo "";
                    echo "</div>";
                    echo "<p id='left' style='opacity:0.7;margin-top:10px'></p>";







                    $id=$jwtarrayinformation['productid'];
                $signedinuserid=$jwtarrayinformation['userid'];
                $query->close();
                // print_r($jwtarrayinformation);
                //add to favorites
                try {
                    $query = $conn->prepare("SELECT product_id,user_id FROM mydb.usersfavorite WHERE product_id = ? AND user_id =?;");
                    $query->bind_param('ss',$id,$signedinuserid);
                    if ($query === false) {
                        //change filename accordingly
                        throw new Exception("Statement Preparation failed(favoriteproduct)");
                    }
                } catch (Exception $e) {
                    echo 'Message: ' . $e->getMessage();
                    //change header location accordingly
                    header("location: https://www.swapamc.com/swapproj/allproducts?error=badstatement");
                    exit;
                }


                // throws error "Statment Execution failed" when statement fails
                try {
                    $execute = $query->execute();
                    if ($execute === false) {
                        throw new Exception("Statement Execution failed (favoriteproduct)");
                    }
                } catch (Exception $e) {
                    echo 'Message: ' . $e->getMessage();
                    header("location: https://www.swapamc.com/swapproj/allproducts?error=badstatement");
                    exit;
                }

                // $query->close();

                $result = $query->get_result();
                $array = $result->fetch_all(MYSQLI_ASSOC);



                // print_r($array);


                if(sizeOf($array)==1){

                    //already favorited
                    // echo "<div id='favorite$id'><button type='button'  onclick='favorite($id)'>Unfavorite</button></div>";
                
                    echo "<div class='lastpart'>";
                            echo "<h1 class='totaloverall' id='price'>Total: S$".$total."</h1>";
                            echo "<div class='lastpartbuttons'>";
                                echo '<input class="addtocart" type="submit" formaction="/swapproj/allproducts/product/changes" value="UPDATE">';
                                echo "<button type='button' onclick='favorite($id)' id='favorite$id' class='afterfavoritebtn'><i class='far fa-heart'></i></button>";
                                echo "<input class='deletecss' type='submit' value='Delete' formaction='/swapproj/allproducts/product/delete'>";
                            echo '</div>';
                        echo '</div>';
                
                } else {
                    // echo "<div id='favorite$id'><button type='button'  onclick='favorite($id)'>Favorite this</button></div>";
                
                    echo "<div class='lastpart'>";
                            echo "<h1 class='totaloverall' id='price'>Total: S$".$total."</h1>";
                            echo "<div class='lastpartbuttons'>";
                                echo '<input class="addtocart" type="submit"  formaction="/swapproj/allproducts/product/changes" value="UPDATE">';
                                echo "<button type='button' onclick='favorite($id)' id='favorite$id' class='favoritebtn'><i class='far fa-heart'></i></button>";
                                echo "<input class='deletecss' type='submit' value='Delete' formaction='/swapproj/allproducts/product/delete'>";
                            echo '</div>';
                    echo '</div>';
                
                }
                
                echo "<input type='hidden' name='csrf' value='$csrf'>";

                echo "</form>";


                

                
            }












?>





































<html>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>


<!-- <script src='https://www.swapamc.com/swapproj/allproducts/product/script'></script> -->
<script type="text/javascript">

function sanitizeHTML(text) {
                    var element = document.createElement('div');
                    element.innerText = text;
                    return element.innerHTML;
        }

        function calculatePriceUserSide(){
            var priceforone = "<?php echo json_encode($price); ?>";
            

            //cgeckbox are inputfield
            var checkboxesarray = document.getElementsByClassName("checkbox");

            
            for (let i = 0; i < checkboxesarray.length; i++) {
                if (checkboxesarray[i].checked){
                    
                    var additional = document.getElementById("price"+checkboxesarray[i].id);

                    if(additional!=null){
                        if(!isNaN(parseFloat(additional.innerHTML))){
                    
                            priceforone = (parseFloat(priceforone) + parseFloat(additional.innerHTML)).toFixed(2);
                        }

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

            // console.log(total);

            //new
            total = sanitizeHTML(total);
            document.getElementById("price").textContent = "Total: S$"+total;















            calculateInventory();

        }

    // function checkOrUncheck(id){
    //     console.log(id);
    //     if(document.getElementById(id).checked = true){
    //         document.getElementById(id).checked = false;

    //     }
    // }


    function calculateInventory(){

        var typesandvariants = {}; //use json style array as we want to push to ajax

        typesandvariants['type'] = 'ajax';
        typesandvariants['product_name'] = <?php echo json_encode($productname); ?>;

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
<script>
    function sanitizeHTML(text) {
        var element = document.createElement('div');
        element.innerText = text;
        return element.innerHTML;
    }

    function calculatePriceUserSide(){
        var priceforone = "<?php echo json_encode($price); ?>";
        

        //cgeckbox are inputfield
        var checkboxesarray = document.getElementsByClassName("checkbox");

        
        for (let i = 0; i < checkboxesarray.length; i++) {
            if (checkboxesarray[i].checked){
                
                var additional = document.getElementById("price"+checkboxesarray[i].id);

                if(additional!=null){
                    if(!isNaN(parseFloat(additional.innerHTML))){
                
                        priceforone = (parseFloat(priceforone) + parseFloat(additional.innerHTML)).toFixed(2);
                    }

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

        // console.log(total);

        //new
        total = sanitizeHTML(total);
        document.getElementById("price").textContent = "Total: S$"+total;




        calculateInventory();

    }

    function favorite(productid){
            var array= {};
            array['type'] = 'ajax';
            array['productid'] = productid;
            array['csrf'] = '<?php echo $csrf; ?>';

            var jsonString = JSON.stringify(array);

            jQuery.ajax({
                url:'https://www.swapamc.com/swapproj/product/favorite?id='+productid,
                type:'post',
                data: {info:jsonString},
                

                success:function(result){
                    console.log(result);

                    


                    if(result.includes('unfavorited')){

                        

                        if(document.getElementById("favorite"+productid)){
                            document.getElementById("favorite"+productid).classList.remove("afterfavoritebtn");
                            document.getElementById("favorite"+productid).classList.add("favoritebtn");

                            // document.getElementById("favorite"+productid).innerHTML = "<button type='button'  onclick='favorite("+productid+")'>Favorite This</button>";
                        }

                        


                    } else if (result.includes('favorited')){
                        if(document.getElementById("favorite"+productid)){
                            document.getElementById("favorite"+productid).classList.add("afterfavoritebtn");
                            document.getElementById("favorite"+productid).classList.remove("favoritebtn");
                            
                            // document.getElementById("favorite"+productid).innerHTML = "<button type='button'  onclick='favorite("+productid+")'>Unfavorite</button>";
                        }


                        
                    }

                    



                    

                    
                    
                    
                }

            });
            
            
            
        }

    function calculateInventory(){

        var typesandvariants = {}; //use json style array as we want to push to ajax

        typesandvariants['type'] = 'ajax';
        typesandvariants['product_name'] = <?php echo json_encode($productname); ?>;

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
                if(result!=null&&result!=''&&result!='error'){

                    
                    document.getElementById("left").innerHTML = "ONLY "+result+" REMAINING";
                    
                    document.getElementById("quantity").setAttribute("max",result);

                    
                }
  
                
            }

        });


    }

    
</script>


<script>
    (function() {
        "use strict";
        var jQueryPlugin = (window.jQueryPlugin = function(ident, func) {
            return function(arg) {
                if (this.length > 1) {
                    this.each(function() {
                        var $this = $(this);

                        if (!$this.data(ident)) {
                            $this.data(ident, func($this, arg));
                        }
                    });

                    return this;
                } else if (this.length === 1) {
                    if (!this.data(ident)) {
                        this.data(ident, func(this, arg));
                    }

                    return this.data(ident);
                }
            };
        });
    })();

    (function() {
        "use strict";

        function Guantity($root) {
            const element = $root;
            const quantity = $root.first("data-quantity");
            const quantity_target = $root.find("[data-quantity-target]");
            const quantity_minus = $root.find("[data-quantity-minus]");
            const quantity_plus = $root.find("[data-quantity-plus]");
            var quantity_ = quantity_target.val();
            $(quantity_minus).click(function() {

                // value=document.getElementById('qnn').value;


                if (parseInt(document.getElementById('quantity').value) > parseInt(document.getElementById('quantity').min)) {
                    quantity_target.val(--quantity_);
                    calculatePriceUserSide();

                }




            });
            $(quantity_plus).click(function() {

                if (parseInt(document.getElementById('quantity').value) < parseInt(document.getElementById('quantity').max)) {
                    quantity_target.val(++quantity_);
                    calculatePriceUserSide();   

                }
            });
        }
        $.fn.Guantity = jQueryPlugin("Guantity", Guantity);
        $("[data-quantity]").Guantity();
    })();
</script>

</html>

<?php
ob_flush();
?>