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
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous"> -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css">

<style>
    .rectangle {

        flex-basis: 100%;
        height: 85vh;
        
        background-position: center;
        background-size: cover;
        background-image: black;
        background-repeat: no-repeat;



    }
</style>

<style>
    .reviewsrating i {
        margin-right: 3px;
    }
</style>
<?php include 'product/css/productcss.php'; ?>


<?php

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
    

    //db con
    require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/dbh.inc.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/product/includes/productfunctions.inc.php';
    require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/auth/pages.php';

    require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/functions.inc.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
$filename = basename(__FILE__, '.php'); // filename variable is now set as allstores for example

    $csrf = generateCSRF();
    
    $jwtarray = jwtdecrypt();
    if(isset($jwtarray)&&$jwtarray==true){
        
        $jwtarrayinformation = $jwtarray['array'];

    } else {
        header("location: https://www.swapamc.com/swapproj/logout");
        exit();
    }

    


    
    
    
    
    
    // if(isset($_GET['id'])){
    //     if(is_numeric($_GET['id'])){
    //         $id=$_GET["id"];
    //     } else {
    //         header("location: ../allproducts");
    //     }
    // } else {
    //     header("location: ../allproducts");
    // }






    $whitelist=['id'];
    $maxlengtharray['id']=11;
    $methd = $_GET;
    $empty = checkEmpty($methd,$whitelist);

    if($empty!=null){
    header("location: https://www.swapamc.com/swapproj/allproducts?error=empty".$empty);
    exit();
    } 

    $validarray = XSSPrevention($methd,$whitelist);
    $validarray = escapeString($conn,$validarray);


    if(checkId($validarray)!=false){
        error_log("TPAMC:QUANTITY:2:$ip:2 Malicious input", 0); //not sure if this is Malicious Input or MALICIOUS
        header("location: https://www.swapamc.com/swapproj/allproducts?error=badinput");
        exit();
    }


    if(checkLength($validarray,$maxlengtharray)!=null){
        
        header("location: https://www.swapamc.com/swapproj/allproducts?error=toolongid");
        exit();
    }


    $id = $validarray['id'];

    checkIfIdExists($conn);








    $signedinuserid = $jwtarrayinformation['userid'];
    $signedinrole = $jwtarrayinformation['role'];
    
    $query=$conn->prepare("SELECT * FROM mydb.storeprod
    INNER JOIN mydb.products
    ON mydb.products.product_id = mydb.storeprod.product_id
    INNER JOIN mydb.store
    ON mydb.store.store_id = mydb.storeprod.store_id
    WHERE mydb.storeprod.product_id = ?");
    $query->bind_param('s',$id);



    
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
    


    echo "<div class='right'>";

    
            
    if($query->execute()){
        
        //convert to array. 
        //$query->bind_result() works too
        $result = $query->get_result();
        $array = $result->fetch_all(MYSQLI_ASSOC);

        

        $product_name= $array[0]['product_name'];
        $product_price= $array[0]['product_price'];
        $product_about= $array[0]['product_about'];
        $productpicturea = $array[0]['product_picone'];


        if(isset($productpicturea)&&$productpicturea!=null){
            require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/images/showimage.php';
            $image = new Image();
            // print_r($productpicturea);

            $src = $image->show($productpicturea);
            echo "<style>";
            echo ".rectangle{";
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
            
            require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/images/showimage.php';
            $image = new Image();

            $src = $image->show('uploads/IMG-DEFAULTPROFILE.jpg');
            echo "<style>";
            echo ".rectangle{";
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

        $store_name = $array[0]['store_name'];
        echo "<p class='tpamc'>$store_name</p>";
        echo "<h1 class='prodname'>$product_name</h1>";

        echo "<h3 class='price'>$product_price</h3>";
        // echo "<h2>Store: " . $store_name . "</h2>";
        // echo "Name: " . $product_name . "<br>";

        // echo "Price: " . $product_price . "<br>";



        echo "<div class='refunds'>";
        echo "<p class='refundsheader'>No returns/refunds</p>";
        echo "<p class='refundsbody'>Item is confirmed after payment confirmation. No";
        echo "refunds, returns or exchanges will be entertained";
        echo "as required by law</p>";
        echo "</div>";

        echo "<div class=\"details\">";
            echo "<p class='detailsheader'>Details</p>";
            echo "<p class='detailsbody'>$product_about</p>";

        echo "</div>";



        // echo "About: " . $product_about. "<br><br><br>";

        
    }


    echo "<div class='typescontainer'>";

    
    $alltypes = getTypeForProduct($id,$conn);


    $numberofTypes= sizeof($alltypes);

    echo "<form method='POST' action='/swapproj/allproducts/product/addtocart'>";
    for ($i=0;$i<$numberofTypes;$i++){
        $info[$i] = getVariantsFromTypes($alltypes[$i],$id,$conn);

        echo "<div class='typerow'>";
        

        

        // echo $alltypes[$i] . "<br>";
        echo "<p class='typename'>".$alltypes[$i]."</p>";

        echo '<div class="variants">';
        echo '<ul class="donate-now">';
        
        $variant = $info[$i][0];
        $pricevariant = $info[$i][1];
        for($j=0;$j<sizeof($variant);$j++){
            if($pricevariant[$j]!= null && $pricevariant[$j] != "" && $pricevariant[$j]!=0){
                // echo 
                // "<span class='optionscontainer'>".
                //     "<span>".$variant[$j] ."</span> ".
                //     "+S$"."<span id='price$variant[$j]'>".$pricevariant[$j]."</span>" .
                //     "<input class='checkbox $alltypes[$i]' name='$alltypes[$i]' value='$variant[$j]' onChange='calculatePriceUserSide()' type=radio  id='$variant[$j]'>".
                // "</span>";

                //with additinal costs

                $txx = $variant[$j] . " (+$".$pricevariant[$j].")";
                
                    
                echo '<li>';
                    echo "<input type='radio' class='checkbox $alltypes[$i]' style='opacity:0' id='$variant[$j]' value='$variant[$j]' onChange='calculatePriceUserSide()' name='$alltypes[$i]' />";
                    echo "<label for='$variant[$j]'>".$txx."</label>";
                    echo "<span style='display:none' id='price$variant[$j]'>".$pricevariant[$j]."</span>";

                echo '</li>';
                    

                    




                


                
            } else {
                // echo $variant[$j]  ."<input class=checkbox value='$variant[$j]' onChange='calculatePriceUserSide()' type=radio name='$alltypes[$i]'>";
                // echo "<br>";

                echo '<li>';
                    echo "<input type='radio' class='checkbox $alltypes[$i]' id='$variant[$j]' style='opacity:0'  value='$variant[$j]' onChange='calculatePriceUserSide()' name='$alltypes[$i]' />";
                    echo "<label for='$variant[$j]'>".$variant[$j]."</label>";
                echo '</li>';


                
            }
            
        }

        // echo "<br>";
        echo '</ul>';

        echo '</div>';//variants

        echo "</div>"; //typerow
        






        
    };

    echo "</div>"; //types container

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
        echo "<input type='number' id='quantity' onchange='calculatePriceUserSide()' class='quantity-input' data-quantity-target='' value='1' step='1' min='1' max='10' name='quantity'>";
        echo "<button type='button' class=\"quantity-btn\" data-quantity-plus=\"\"><svg viewBox=\"0 0 426.66667 426.66667\">";
        echo "<path d=\"m405.332031 192h-170.664062v-170.667969c0-11.773437-9.558594-21.332031-21.335938-21.332031-11.773437 0-21.332031 9.558594-21.332031 21.332031v170.667969h-170.667969c-11.773437 0-21.332031 9.558594-21.332031 21.332031 0 11.777344 9.558594 21.335938 21.332031 21.335938h170.667969v170.664062c0 11.777344 9.558594 21.335938 21.332031 21.335938 11.777344 0 21.335938-9.558594 21.335938-21.335938v-170.664062h170.664062c11.777344 0 21.335938-9.558594 21.335938-21.335938 0-11.773437-9.558594-21.332031-21.335938-21.332031zm0 0\" />";
        echo "</svg>";
        echo "</button>";
        echo "</div>";
        echo "";
    echo "</div>";
    echo "<p id='left' style='opacity:0.7;margin-top:10px'></p>";


//check fi already favorited

$query->close();


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

$result = $query->get_result();
$array = $result->fetch_all(MYSQLI_ASSOC);

if(sizeOf($array)==1){

    //already favorited
    // echo "<div id='favorite$id'><button type='button'  onclick='favorite($id)'>Unfavorite</button></div>";

    echo "<div class='lastpart'>";
            echo "<h1 class='totaloverall' id='price'>Total: S$".$product_price."</h1>";
            echo "<div class='lastpartbuttons'>";
                echo '<input class="addtocart" type="submit" value="ADD TO CART">';
                echo "<button type='button' onclick='favorite($id)' id='favorite$id' class='afterfavoritebtn'><i class='far fa-heart'></i></button>";
            echo '</div>';
        echo '</div>';

        if(isset($_GET['error']) && $_GET['error']='toomuch'){
            echo "<p style='text-align:center'>Please ensure that varaints are selected and quantity is proper</p>";
        }
} else {
    // echo "<div id='favorite$id'><button type='button'  onclick='favorite($id)'>Favorite this</button></div>";

    echo "<div class='lastpart'>";
            echo "<h1 class='totaloverall' id='price'>Total: S$".$product_price."</h1>";
            echo "<div class='lastpartbuttons'>";
                echo '<input class="addtocart" type="submit" value="ADD TO CART">';
                echo "<button type='button' onclick='favorite($id)' id='favorite$id' class='favoritebtn'><i class='far fa-heart'></i></button>";
            echo '</div>';
    echo '</div>';

    if(isset($_GET['error']) && $_GET['error']='toomuch'){
        echo "<p style='text-align:center'>Please ensure that varaints are selected and quantity is proper</p>";
    }

}







        



   
//    echo "Total Costs: <br>";

   
   
   
//    echo "<p id='price'>"."S$".$product_price . "</p>";
    echo "<input type='hidden' name='csrf' value='$csrf'>";

//    echo "<input type='submit' >";


    echo "</form>";









    
    

    echo "</div>";
    echo "</div>"; //end top



















   //store initial session variables
//    session_start();


   

   
   
   //update jwt
   //require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/functions.inc.php';
   $arraytogivejwt['productid'] = $id;
   $arraytogivejwt['progresscheckout'] = 'A';
   jwtupdate($arraytogivejwt);

//    print_r(apache_request_headers()); 



    //start of reviews
    // echo "<h2>Reviews</h2>";

    // echo "<form method='POST' action='/swapproj/addreview' enctype='multipart/form-data'>";

    // echo "<p>Comment:</p>";
    // echo "<input type='text' name='comment'>";


    // echo "<p>Rating:</p>";
    // echo "<input type='number' max=5 min=1 name='rating'>";


    // echo "<p>Image:</p>";
    // echo "<input type='file' name='image'>";
    // echo "<br><br>";

    // echo "<input type='submit'>";
    // echo "<input type='hidden' name='csrf' value='$csrf'>";
    

    // echo "</form>";



    echo "<form method='POST' action='/swapproj/addreview' enctype='multipart/form-data'>";
    echo "<div class=\"addreview\">";
    echo "<h3 class='addareview'>Add a review</h3>";
    
    echo "<div class='ratingreviewadd'>";
    echo "<p class='ratingreviewheader'>Rating</p>";
    echo "<input class='number' name='rating' type=\"number\" placeholder='1-5'>";
    echo "</div>";
    echo "<div class='productimageadd'>";
    echo "<p>Product Image</p>";
    echo "<input type='file' name='image'>";
    echo "</div>";
    echo "<textarea name='comment' placeholder=\"I loved this product! I really hope I can get A for SWAP!\" class='addreivewtextarea' style=\"width:100%\"></textarea>";
    echo "<input type=\"submit\" class='addreviewbtn' value='Post Publicly'>";
    
    echo "</div>";
    echo "<input type='hidden' name='csrf' value='$csrf'>";
    echo "</form>";



    

    require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/images/showimage.php';
    $image = new Image();



    $query->close();

    //review section
    $childarray = [];
    $parentchild = [];

    $query=$conn->prepare("SELECT review_id,childof_id FROM mydb.reviews INNER JOIN mydb.users ON mydb.reviews.review_user_id = mydb.users.user_id WHERE review_product_id=? AND childof_id IS not null ORDER BY review_date DESC;");
    $query->bind_param('s',$id);
    //child of = parent's id
    if($query->execute()){
        $query->bind_result($reviewid,$childofid);


        //explaining code below:
        //I want to get the list of child and its parents and put it in an array so
        //array['parentone'] = [whoever is under]
        while($query->fetch()){

            $currentid = $childofid;

            if(isset($previd)&& $currentid==$previd){
                //append if it is same parent
                array_push($childarray,$reviewid);
                $parentchild[$childofid] = $childarray;
                
            } else {
                //reset if it becomes a new parent
                $childarray = [];
                array_push($childarray,$reviewid);
                $parentchild[$childofid] = $childarray;
            }

            
            
            $previd = $childofid;

        }
    }

    $query->close();


    

    
    
    // $query = $conn->prepare("")


    //explanation for code is repeated below
    $listwhichuserliked = [];
    $listwhichuserdisliked=[];

    

    $query=$conn->prepare("SELECT user_id,review_id,liked FROM mydb.likedby WHERE product_id = ?;");
    $query->bind_param('s',$id);
    if($query->execute()){
        $query->bind_result($uid,$rid,$liked);
        while($query->fetch()){
            


            if($signedinuserid==$uid){
                if($liked==1){
                    array_push($listwhichuserliked,$rid);
                } else {
                    array_push($listwhichuserdisliked,$rid);

                }
                
            }


            // $currentid = $rid;
            // if(isset($previd)&&$currentid==$previd){

            //     if($liked==1){
            //         array_push($usersarray,$uid);
            //         $whichuserliked[$rid] = $usersarray;

            //     } else {
            //         array_push($usersarray,$uid);
            //         $whichuserdisliked[$rid] = $usersarray;

            //     }
                
                

            // } else {
            //     //if new rid
            //     $usersarray = [];

            //     if($liked==1){
            //         array_push($usersarray,$uid);
            //         $whichuserliked[$rid] = $usersarray;

            //     } else {
            //         array_push($usersarray,$uid);
            //         $whichuserdisliked[$rid] = $usersarray;

            //     }
                
                
            // }

            // $previd = $rid;
        }



    }


    $query->close();

    
    //print_r($listwhichuserliked);






    //get all parents
    $query = $conn->prepare("SELECT user_id,review_id,user_username,user_profilepicture,
    review_comment,review_rating,review_total_likes,review_total_dislikes,review_date,childof_id,
    review_pic,user_role FROM mydb.reviews INNER JOIN mydb.users 
    ON mydb.reviews.review_user_id = mydb.users.user_id WHERE review_product_id = ? AND childof_id IS null ORDER BY review_date DESC;");
    $query->bind_param('s',$id);
    if($query->execute()){
        $result = $query->get_result();
        $allparents = $result->fetch_all(MYSQLI_ASSOC);
        
        
    }

    $query->close();


    echo "<div class='allreviews'>";
    echo "<h2 class='numberofreviews'>All Reviews</h2>";

  











    //allparents

    for($i=0;$i<sizeof($allparents);$i++){

        //echo parent first

        
        // echo '<div >';

        
        if($signedinuserid==$allparents[$i]['user_id']){


            
                //if review posted by user currently signed in

                $reviewidparent = $allparents[$i]['review_id'];
                $revpic = $image->show($allparents[$i]['review_pic']);
                $likes = $allparents[$i]['review_total_likes'];
                $dislikes = $allparents[$i]['review_total_dislikes'];
                $pic=$allparents[$i]['user_profilepicture'];

                echo "<form class='parentsectionreviews' method=POST action='https://www.swapamc.com/swapproj/editreview' enctype='multipart/form-data'>";

                //parentprofilepic
                echo "<div class='parentleft'>";
                        
                echo "<div class='circle' id='circle$reviewidparent'>";
                echo "</div>";
                
                if(isset($pic)){
                    $image = new Image();

                    $src = $image->show($pic);
                    
                
                    

                    echo "<style>";
                        echo "#circle$reviewidparent {";
                        echo "background-image: url('$src');";
                        echo "}";
                    echo "</style>";

                }
                    
                echo "</div>";

                echo '<div class="parentright">';

                    echo "<div class='usernamereviewcontainer'>";
                        echo "<h4 class='usernamereview'>".$allparents[$i]['user_username']."</h4>";
                        echo "<div class='kea'>";
                            echo "<a class=\"kebab-link\" data-toggle='dropdown' data-target=\"#dropdown$reviewidparent\"><i class=\"fa fa-ellipsis-v\"></i></a>";
                            echo "<div class='dropdown kebab-dropdown dropdown-sm' id=\"dropdown$reviewidparent\">";
                                echo "<div class=\"dropdown-menu dropdown-unroll dropdown-menu-right\">";
                                    echo "<a id='delete$reviewidparent' class=\"dropdown-item\" href='"."https://www.swapamc.com/swapproj/deletereview?id=$reviewidparent&csrf=$csrf"."'>Delete Review</a>";
                                    echo "<div class=\"dropdown-divider\"></div>";
                                    echo "<a id='editbutton$reviewidparent'  onclick='editReview($reviewidparent)' class=\"dropdown-item\">Edit Review</a>";
                                    
                                echo "</div>";
                            echo "</div>";
                        echo "</div>";
                    echo "</div>";

                    
                    echo "<input type='hidden' name='csrf' value='$csrf'>";
                    // echo "<p>Username: ".$allparents[$i]['user_username']."</p>";

                    // echo "<div id='image$reviewidparent'>";
                    // echo '<img  width="100px" src="'.$profilepicture.'" />';
                    // echo "</div>";

                    // echo "<br>";
                    getRating($allparents[$i]['review_rating'],$reviewidparent);

                    echo "<div id='rating$reviewidparent'>";
                    
                    echo "</div>";
                    
                    

                    echo "<div id='comment$reviewidparent'>";
                    echo "<p class='reviewdetails'>".$allparents[$i]['review_comment']."</p>";
                    echo "</div>";

                    // echo "<div id='rating$reviewidparent'>";
                    // echo "<p>Rating: ".$allparents[$i]['review_rating']."</p>";
                    // echo "</div>";

                    echo "<div class=\"imagescontainer\">";


                        

                        $image = new Image();

                        $src = $image->show($revpic);
                        
                    
                        echo "<div class='picturesreview' id='picturesreview$reviewidparent'>";
                        
                        
                        echo "</div>";
                        

                        echo "<style>";
                            echo "#picturesreview$reviewidparent {";
                            echo "background-image: url('$src');";
                            echo "}";
                        echo "</style>";
                    
                        
                    echo "</div>";

                    echo "<p class='date'>".$allparents[$i]['review_date']."</p>";

                    
                    echo "<div id=likeordislike>";
                        
                        
                        

                        if(in_array($reviewidparent,$listwhichuserliked)){
                            //if its liked already
                            echo "<span id='likeid$reviewidparent' class='like'>".$allparents[$i]['review_total_likes']."&nbsp&nbsp<i  style='color:#73C2FB;opacity:0.8;' class=\"fas fa-chevron-up\"></i></span>";
                            // echo "<p id='likes$reviewid'>Likes: ".$allparents[$i]['review_total_likes']."</p>";
                            // echo "<h4 id='likesbutton$reviewid'>Liked</h4>";
                        } else {
                            echo "<span id='likeid$reviewidparent' class='like'>".$allparents[$i]['review_total_likes']."&nbsp&nbsp<i onclick='likeOrDislike($reviewidparent,1,$likes,$dislikes)' class=\"fas fa-chevron-up\"></i></span>";
                            // echo "<p id='likes$reviewid'>Likes: ".$allparents[$i]['review_total_likes']."</p>";
                            // echo "<button d='likesbutton$reviewid' type='button' onclick='likeOrDislike($reviewidparent,1,$likes,$dislikes)'>Like</button>";

                        }
                        

                        
                        if(in_array($reviewidparent,$listwhichuserdisliked)){
                            //if its disliked already
                            // echo "<p id='dislikes$reviewid'>Dislikes: ".$allparents[$i]['review_total_dislikes']."</p>";
                            // echo "<h4 id='dislikesbutton$reviewid'>Disliked</h4>";
                            echo "<span id='dislikeid$reviewidparent' class='dislike'>".$allparents[$i]['review_total_dislikes']."&nbsp&nbsp<i style='color:#73C2FB;opacity:0.8;' class='fas fa-chevron-down'></i></span>";
                        } else {
                            echo "<span id='dislikeid$reviewidparent' class='dislike'>".$allparents[$i]['review_total_dislikes']."&nbsp&nbsp<i onclick='likeOrDislike($reviewidparent,0,$likes,$dislikes)' class=\"fas fa-chevron-down\"></i></span>";
                            // echo "<p id='dislikes$reviewid'>Dislikes: ".$allparents[$i]['review_total_dislikes']."</p>";
                            // echo "<button id='dislikesbutton$reviewid' type='button' onclick='likeOrDislike($reviewidparent,0,$likes,$dislikes)'>Dislike</button>";
                        }

                    echo "</div>";
                    

                    


                    echo "<button type='submit' class='inptdesignbtn' id='submit$reviewidparent' style='display:none'>Update Changes</button>";

                    if($signedinrole==6){
                        echo "<p class='replybtn' type='button' id='replybutton$reviewidparent' onclick='replyReview($reviewidparent)'>"."Reply". "</p>";


                    }
                    

                    

                    echo "</form>";

                    echo "<form style='display:none' method='POST' action='https://www.swapamc.com/swapproj/replyreview?id=$reviewidparent' id='replybox$reviewidparent'>";
                        echo "<input type='hidden' name='csrf' value='$csrf'>";
                        echo "<input class='inptdesign' type='text' name='comment' placeholder='comment'><br>";
                        echo "<input class='inptdesignbtn' type='submit'>";
                    echo "</form>";

                    
                echo "</div>"; //parentright

            
                
            



            

        } else {

            //if review posted by user currently signed in

            $reviewidparent = $allparents[$i]['review_id'];
            $revpic = $image->show($allparents[$i]['review_pic']);
            $likes = $allparents[$i]['review_total_likes'];
            $dislikes = $allparents[$i]['review_total_dislikes'];
            $pic=$allparents[$i]['user_profilepicture'];

            echo "<form class='parentsectionreviews' method=POST action='https://www.swapamc.com/swapproj/editreview' enctype='multipart/form-data'>";

            //parentprofilepic
            echo "<div class='parentleft'>";
                // echo "<div class='circle'>";
                // echo "</div>";
                echo "<div class='circle' id='circle$reviewidparent'>";
                    echo "</div>";

                    

                if(isset($pic)){
                    $image = new Image();

                    $src = $image->show($pic);
                    
                
                    

                    echo "<style>";
                        echo "#circle$reviewidparent {";
                        echo "background-image: url('$src');";
                        echo "}";
                    echo "</style>";

                }
                
            echo "</div>";

            echo '<div class="parentright">';

                echo "<div class='usernamereviewcontainer'>";
                    echo "<h4 class='usernamereview'>".$allparents[$i]['user_username']."</h4>";
                    if($signedinrole==6){
                        echo "<div class='kea'>";
                        echo "<a class=\"kebab-link\" data-toggle=\"dropdown\" data-target=\"#dropdown$reviewidparent\"><i class=\"fa fa-ellipsis-v\"></i></a>";
                        echo "<div class=\"dropdown kebab-dropdown dropdown-sm\" id=\"dropdown$reviewidparent\">";
                            echo "<div class=\"dropdown-menu dropdown-unroll dropdown-menu-right\">";
                                echo "<a id='delete$reviewidparent' class=\"dropdown-item\" href='"."https://www.swapamc.com/swapproj/deletereview?id=$reviewidparent&csrf=$csrf"."'>Delete Review</a>";
                                echo "<div class=\"dropdown-divider\"></div>";
                                echo "<a id='editbutton$reviewidparent'  onclick='editReview($reviewidparent)' class=\"dropdown-item\">Edit Review</a>";
                                
                            echo "</div>";
                        echo "</div>";
                    echo "</div>";

                    }
                    
                echo "</div>";

                
                echo "<input type='hidden' name='csrf' value='$csrf'>";
                // echo "<p>Username: ".$allparents[$i]['user_username']."</p>";

                // echo "<div id='image$reviewidparent'>";
                // echo '<img  width="100px" src="'.$profilepicture.'" />';
                // echo "</div>";

                // echo "<br>";
                getRating($allparents[$i]['review_rating'],$reviewidparent);

                echo "<div id='rating$reviewidparent'>";
                
                echo "</div>";
                
                

                echo "<div id='comment$reviewidparent'>";
                echo "<p class='reviewdetails'>".$allparents[$i]['review_comment']."</p>";
                echo "</div>";

                // echo "<div id='rating$reviewidparent'>";
                // echo "<p>Rating: ".$allparents[$i]['review_rating']."</p>";
                // echo "</div>";

                echo "<div class=\"imagescontainer\">";


                        

                        $image = new Image();

                        $src = $image->show($revpic);
                        
                    
                        echo "<div class='picturesreview' id='picturesreview$reviewidparent'>";
                        
                        
                        echo "</div>";
                        

                        echo "<style>";
                            echo "#picturesreview$reviewidparent {";
                            echo "background-image: url('$src');";
                            echo "}";
                        echo "</style>";
                    
                        
                    echo "</div>";


                echo "<p class='date'>".$allparents[$i]['review_date']."</p>";

                
                echo "<div id=likeordislike>";
                    
                    
                    

                    if(in_array($reviewidparent,$listwhichuserliked)){
                        //if its liked already
                        echo "<span id='likeid$reviewidparent' class='like'>".$allparents[$i]['review_total_likes']."&nbsp&nbsp<i  style='color:#73C2FB;opacity:0.8;' class=\"fas fa-chevron-up\"></i></span>";
                        // echo "<p id='likes$reviewid'>Likes: ".$allparents[$i]['review_total_likes']."</p>";
                        // echo "<h4 id='likesbutton$reviewid'>Liked</h4>";
                    } else {
                        echo "<span id='likeid$reviewidparent' class='like'>".$allparents[$i]['review_total_likes']."&nbsp&nbsp<i onclick='likeOrDislike($reviewidparent,1,$likes,$dislikes)' class=\"fas fa-chevron-up\"></i></span>";
                        // echo "<p id='likes$reviewid'>Likes: ".$allparents[$i]['review_total_likes']."</p>";
                        // echo "<button d='likesbutton$reviewid' type='button' onclick='likeOrDislike($reviewidparent,1,$likes,$dislikes)'>Like</button>";

                    }
                    

                    
                    if(in_array($reviewidparent,$listwhichuserdisliked)){
                        //if its disliked already
                        // echo "<p id='dislikes$reviewid'>Dislikes: ".$allparents[$i]['review_total_dislikes']."</p>";
                        // echo "<h4 id='dislikesbutton$reviewid'>Disliked</h4>";
                        echo "<span id='dislikeid$reviewidparent' class='dislike'>".$allparents[$i]['review_total_dislikes']."&nbsp&nbsp<i style='color:#73C2FB;opacity:0.8;' class='fas fa-chevron-down'></i></span>";
                    } else {
                        echo "<span id='dislikeid$reviewidparent' class='dislike'>".$allparents[$i]['review_total_dislikes']."&nbsp&nbsp<i onclick='likeOrDislike($reviewidparent,0,$likes,$dislikes)' class=\"fas fa-chevron-down\"></i></span>";
                        // echo "<p id='dislikes$reviewid'>Dislikes: ".$allparents[$i]['review_total_dislikes']."</p>";
                        // echo "<button id='dislikesbutton$reviewid' type='button' onclick='likeOrDislike($reviewidparent,0,$likes,$dislikes)'>Dislike</button>";
                    }

                echo "</div>";
                

                


                echo "<button type='submit' class='inptdesignbtn' id='submit$reviewidparent' style='display:none'>Update Changes</button>";

                if($signedinrole==6){
                    echo "<p class='replybtn' type='button' id='replybutton$reviewidparent' onclick='replyReview($reviewidparent)'>"."Reply". "</p>";


                }
                

                

                echo "</form>";

                echo "<form style='display:none' method='POST' action='https://www.swapamc.com/swapproj/replyreview?id=$reviewidparent' id='replybox$reviewidparent'>";
                    echo "<input type='hidden' name='csrf' value='$csrf'>";
                    echo "<input class='inptdesign' type='text' name='comment' placeholder='comment'><br>";
                    echo "<input class='inptdesignbtn' type='submit'>";
                echo "</form>";

                
            echo "</div>"; //parentright
            
        }

  
        //children
        if(array_key_exists($allparents[$i]['review_id'],$parentchild)){
            //if there are more child elements
            $parentid = $allparents[$i]['review_id'];
            $childs = $parentchild[$allparents[$i]['review_id']];

            $beforequery = "SELECT user_id,review_id,user_username,user_profilepicture,review_comment,review_rating,review_total_likes,review_total_dislikes,review_date,childof_id,review_pic FROM mydb.reviews 
            INNER JOIN mydb.users 
            ON mydb.reviews.review_user_id = mydb.users.user_id WHERE ";
            
            //crafting statement
            for($a=0;$a<sizeof($childs);$a++){
                
                

                if($a==sizeof($childs)-1){
                    $beforequery = $beforequery . ' review_id = ' .$childs[$a];
                } else {
                    $beforequery = $beforequery . ' review_id = ' . $childs[$a] . ' OR ';
                }


            }

            $query = $conn->prepare($beforequery);
            if($query->execute()){
                $query->bind_result($uid,$reviewid,$username,$profilepicture,$comment,$rating,$likes,$dislikes,$date,$childofid,$reviewpic);
                while($query->fetch()){
                    
                    if($signedinrole==6){
                        //if review posted by user currently signed in


                    
                        //only admin can reply >:)
                        
                        // $profilepicture = $image->show($reviewpic);

                        echo "<div class='childreview'>";
        
                            echo "<form class='parentsectionreviews' method=POST action='https://www.swapamc.com/swapproj/editreview' enctype='multipart/form-data'>";


                                //parentprofilepic
                                echo "<div class='parentleft'>";
                                    echo "<div class='circle' id='circle$reviewid'>";
                                    echo "</div>";

                                    if(isset($profilepicture)){
                                        $image = new Image();

                                        $src = $image->show($profilepicture);
                                        
                                    
                                        
                    
                                        echo "<style>";
                                            echo "#circle$reviewid {";
                                            echo "background-image: url('$src');";
                                            echo "}";
                                        echo "</style>";

                                    }
                                    
                                echo "</div>";

                                echo "<div class='childright'>";


                                    echo "<div class='usernamereviewcontainer'>";
                                        echo "<h4 class='usernamereview'>".$username."</h4>";

                                        echo "<div class='kea'>";
                                            echo "<a class=\"kebab-link\" data-toggle=\"dropdown\" data-target=\"#dropdown$reviewid\"><i class=\"fa fa-ellipsis-v\"></i></a>";
                                            echo "<div class=\"dropdown kebab-dropdown dropdown-sm\" id=\"dropdown$reviewid\">";
                                                echo "<div class=\"dropdown-menu dropdown-unroll dropdown-menu-right\">";
                                                    echo "<a id='delete$reviewid' class=\"dropdown-item\" href='"."https://www.swapamc.com/swapproj/deletereview?id=$reviewid&csrf=$csrf"."'>Delete Review</a>";
                                                    echo "<div class=\"dropdown-divider\"></div>";
                                                    echo "<a id='editbutton$reviewid'  onclick='editReview($reviewid)' class=\"dropdown-item\">Edit Review</a>";
                                                    
                                                echo "</div>";
                                            echo "</div>";
                                        echo "</div>";
                                    echo "</div>";


                                    echo "<input type='hidden' name='csrf' value='$csrf'>";
                                    // echo "<p style='margin-left:30px'>Username: ".$username."</p>";
                        
                                    
                                    // echo "<div id='image$reviewid' style='margin-left:30px'>";
                                    // echo '<img  width="100px" src="'.$profilepicture.'" />';
                                    // echo "</div>";
                        
                                    //echo "<br>";
                        
                                    echo "<div id='comment$reviewid'>";
                                        
                                        echo "<p class='reviewdetails'>".$comment.'</p>';
                                    echo "</div>";
                
                            
                                    echo "<p class='date'>".$date."</p>";
                
                                    // echo "<p style='margin-left:30px'>Likes: ".$likes."</p>";
                                    // echo "<p style='margin-left:30px'>Dislikes: ".$dislikes."</p>";


                                    echo "<div id=likeordislike>";
                                        if(in_array($reviewid,$listwhichuserliked)){
                                            //if its liked already
                                            
                                            // echo "<p style='margin-left:30px' id='likes$reviewid'>Likes: ".$likes."</p>";
                                            // echo "<h4 style='margin-left:30px' id='likesbutton$reviewid'>Liked</h4>";
                                            echo "<span id='likeid$reviewid' class='like'>".$likes."&nbsp&nbsp<i style='color:#73C2FB;opacity:0.8;' class=\"fas fa-chevron-up\"></i></span>";
                                        } else {
                                            echo "<span id='likeid$reviewid' class='like'>".$likes."&nbsp&nbsp<i onclick='likeOrDislike($reviewid,1,$likes,$dislikes)' class=\"fas fa-chevron-up\"></i></span>";
                                            // echo "<p style='margin-left:30px' id='likes$reviewid' >Likes: ".$likes."</p>";
                                            // echo "<button style='margin-left:30px' id='likesbutton$reviewid' type='button' onclick='likeOrDislike($reviewid,1,$likes,$dislikes)'>Like</button>";
                        
                                        }
                        
                                        if(in_array($reviewid,$listwhichuserdisliked)){
                                            //if its disliked already
                                            echo "<span id='dislikeid$reviewid' class='dislike'>".$dislikes."&nbsp&nbsp<i style='color:#73C2FB;opacity:0.8;' class='fas fa-chevron-down'></i></span>";


                                            // echo "<p style='margin-left:30px' id='dislikes$reviewid' >Dislikes: ".$dislikes."</p>";
                                            // echo "<h4 style='margin-left:30px' id='dislikesbutton$reviewid' >Disliked</h4>";
                                        } else {
                                            echo "<span id='dislikeid$reviewid' class='dislike'>".$dislikes."&nbsp&nbsp<i onclick='likeOrDislike($reviewid,0,$likes,$dislikes)' class=\"fas fa-chevron-down\"></i></span>";

                                            // echo "<p style='margin-left:30px' id='dislikes$reviewid' >Dislikes: ".$dislikes."</p>";
                                            // echo "<button style='margin-left:30px' id='dislikesbutton$reviewid' type='button' onclick='likeOrDislike($reviewid,0,$likes,$dislikes)'>Dislike</button>";
                                        }
                                    echo "</div>";







                            
                                        // echo "<p style='margin-left:30px'>Date: ".$date."</p>";
                            
                                        // echo "<button style='margin-left:30px' type='button' id='editbutton$reviewid' onclick='editReview($reviewid)'>"."Edit". "</button>";
                                        // echo "<button style='margin-left:30px' type='button' id='replybutton$reviewid' onclick='replyReview($reviewid)'>"."Reply". "</button>";
                            
                            
                                        echo "<button style='display:none' class='inptdesignbtn' type='submit' id='submit$reviewid'>Update Changes</button>";
                                        
                                        // echo "<a style='margin-left:30px' id='delete$reviewid' href='"."https://www.swapamc.com/swapproj/deletereview?id=$reviewid&csrf=$csrf"."'><button type='button'>Delete</button></a>";
                                        
                                        if($signedinrole==6){
                                            echo "<p class='replybtn' type='button' id='replybutton$reviewid' onclick='replyReview($reviewid)'>"."Reply". "</p>";
                                        }
                                        
                                        echo "</form>";

                                        echo "<form style='display:none' method='POST' action='https://www.swapamc.com/swapproj/replyreview?id=$reviewid' id='replybox$reviewid'>";
                                            echo "<input type='hidden' name='csrf' value='$csrf'>";
                                            echo "<input class='inptdesign' type='text' name='comment' placeholder='comment'>";
                                            echo "<input class='inptdesign' type='submit'>";
                                        
                                        echo "</form>";




                                echo "</div>";//childright
                        
                        echo "</div>";//childreivews
                            
                            
                
                        
            
            
            
                       
            
                    } else {

                        echo "<div class='childreview'>";
        
                            echo "<form class='parentsectionreviews' method=POST action='https://www.swapamc.com/swapproj/editreview' enctype='multipart/form-data'>";


                                //parentprofilepic
                                echo "<div class='parentleft'>";
                                echo "<div class='circle' id='circle$reviewid'>";
                                echo "</div>";

                                    if(isset($profilepicture)){
                                        $image = new Image();

                                        $src = $image->show($profilepicture);
                                        
                                    
                                        
                    
                                        echo "<style>";
                                            echo "#circle$reviewid {";
                                            echo "background-image: url('$src');";
                                            echo "}";
                                        echo "</style>";

                                    }
                                    
                                echo "</div>";

                                echo "<div class='childright'>";


                                    echo "<div class='usernamereviewcontainer'>";
                                        echo "<h4 class='usernamereview'>".$username."</h4>";

                                        // echo "<div class='kea'>";
                                        //     echo "<a class=\"kebab-link\" data-toggle=\"dropdown\" data-target=\"#dropdown$reviewid\"><i class=\"fa fa-ellipsis-v\"></i></a>";
                                        //     echo "<div class=\"dropdown kebab-dropdown dropdown-sm\" id=\"dropdown$reviewid\">";
                                        //         echo "<div class=\"dropdown-menu dropdown-unroll dropdown-menu-right\">";
                                        //             echo "<a id='delete$reviewid' class=\"dropdown-item\" href='"."https://www.swapamc.com/swapproj/deletereview?id=$reviewid&csrf=$csrf"."'>Delete Review</a>";
                                        //             echo "<div class=\"dropdown-divider\"></div>";
                                        //             echo "<a id='editbutton$reviewid'  onclick='editReview($reviewid)' class=\"dropdown-item\">Edit Review</a>";
                                                    
                                        //         echo "</div>";
                                        //     echo "</div>";
                                        // echo "</div>";
                                    echo "</div>";


                                    echo "<input type='hidden' name='csrf' value='$csrf'>";
                                    // echo "<p style='margin-left:30px'>Username: ".$username."</p>";
                        
                                    
                                    // echo "<div id='image$reviewid' style='margin-left:30px'>";
                                    // echo '<img  width="100px" src="'.$profilepicture.'" />';
                                    // echo "</div>";
                        
                                    //echo "<br>";
                        
                                    echo "<div id='comment$reviewid>'";
                                        echo "<p class='reviewdetails'>".$comment."</p>";
                                    echo "</div>";
                
                            
                                    echo "<p class='date'>".$date."</p>";
                
                                    // echo "<p style='margin-left:30px'>Likes: ".$likes."</p>";
                                    // echo "<p style='margin-left:30px'>Dislikes: ".$dislikes."</p>";


                                    echo "<div id=likeordislike>";
                                        if(in_array($reviewid,$listwhichuserliked)){
                                            //if its liked already
                                            
                                            // echo "<p style='margin-left:30px' id='likes$reviewid'>Likes: ".$likes."</p>";
                                            // echo "<h4 style='margin-left:30px' id='likesbutton$reviewid'>Liked</h4>";
                                            echo "<span id='likeid$reviewid' class='like'>".$likes."&nbsp&nbsp<i style='color:#73C2FB;opacity:0.8;' class=\"fas fa-chevron-up\"></i></span>";
                                        } else {
                                            echo "<span id='likeid$reviewid' class='like'>".$likes."&nbsp&nbsp<i onclick='likeOrDislike($reviewid,1,$likes,$dislikes)' class=\"fas fa-chevron-up\"></i></span>";
                                            // echo "<p style='margin-left:30px' id='likes$reviewid' >Likes: ".$likes."</p>";
                                            // echo "<button style='margin-left:30px' id='likesbutton$reviewid' type='button' onclick='likeOrDislike($reviewid,1,$likes,$dislikes)'>Like</button>";
                        
                                        }
                        
                                        if(in_array($reviewid,$listwhichuserdisliked)){
                                            //if its disliked already
                                            echo "<span id='dislikeid$reviewid' class='dislike'>".$dislikes."&nbsp&nbsp<i style='color:#73C2FB;opacity:0.8;' class='fas fa-chevron-down'></i></span>";


                                            // echo "<p style='margin-left:30px' id='dislikes$reviewid' >Dislikes: ".$dislikes."</p>";
                                            // echo "<h4 style='margin-left:30px' id='dislikesbutton$reviewid' >Disliked</h4>";
                                        } else {
                                            echo "<span id='dislikeid$reviewid' class='dislike'>".$dislikes."&nbsp&nbsp<i onclick='likeOrDislike($reviewid,0,$likes,$dislikes)' class=\"fas fa-chevron-down\"></i></span>";

                                            // echo "<p style='margin-left:30px' id='dislikes$reviewid' >Dislikes: ".$dislikes."</p>";
                                            // echo "<button style='margin-left:30px' id='dislikesbutton$reviewid' type='button' onclick='likeOrDislike($reviewid,0,$likes,$dislikes)'>Dislike</button>";
                                        }
                                    echo "</div>";







                            
                                        // echo "<p style='margin-left:30px'>Date: ".$date."</p>";
                            
                                        // echo "<button style='margin-left:30px' type='button' id='editbutton$reviewid' onclick='editReview($reviewid)'>"."Edit". "</button>";
                                        // echo "<button style='margin-left:30px' type='button' id='replybutton$reviewid' onclick='replyReview($reviewid)'>"."Reply". "</button>";
                            
                            
                                        echo "<button style='display:none' class='inptdesignbtn' type='submit' id='submit$reviewid'>Update Changes</button>";
                                        
                                        // echo "<a style='margin-left:30px' id='delete$reviewid' href='"."https://www.swapamc.com/swapproj/deletereview?id=$reviewid&csrf=$csrf"."'><button type='button'>Delete</button></a>";
                                        
                                        if($signedinrole==6){
                                            echo "<p class='replybtn' type='button' id='replybutton$reviewid' onclick='replyReview($reviewid)'>"."Reply". "</p>";
                                        }
                                        
                                        echo "</form>";

                                        echo "<form style='display:none' method='POST' action='https://www.swapamc.com/swapproj/replyreview?id=$reviewid' id='replybox$reviewid'>";
                                            echo "<input type='hidden' name='csrf' value='$csrf'>";
                                            echo "<input class='inptdesign' type='text' name='comment' placeholder='comment'>";
                                            echo "<input class='inptdesign' type='submit'>";
                                        
                                        echo "</form>";




                                echo "</div>";//childright
                        
                        echo "</div>";//childreivews
                        
                        
                    }

                }

            }

            $query->close();
            
            
        }
        

    

    }


    echo "</div>"; //allreviews

    
    
    

?>




<html>





















<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    
    <script type="text/javascript">

        function sanitizeHTML(text) {
                    var element = document.createElement('div');
                    element.innerText = text;
                    return element.innerHTML;
        }

        function calculatePriceUserSide(){
            var priceforone = "<?php echo json_encode($product_price); ?>";
            

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




        function likeOrDislike(reviewid,likeordislike,likes,dislikes){
            // prnt=ele.parentNode;
            
            

            var likeid = "likeid"+reviewid;
            var dislikedid = "dislikeid"+reviewid;

            
            var array= {};
            array['type'] = 'ajax';
            array['reviewid'] = reviewid;
            array['likeordislike'] = likeordislike;
            array['csrf'] = '<?php echo $csrf; ?>';

            var jsonString = JSON.stringify(array);
            jQuery.ajax({
                url:'https://www.swapamc.com/swapproj/likeordislike',
                type:'post',
                data: {info:jsonString},
                

                success:function(result){
                    // console.log(result);

                    


                    console.log(result);
                    // return null;
                    if(result!=null&&result!=''){
                        var response = JSON.parse(result);
                        if(response['likes']!=null||response['dislikes']!=null){
                            likes = response['likes'];
                            dislikes = response['dislikes'];
                        }

                        

                        if(true){

                            
                            if(likeordislike==1){
                                //if liked
                                
                                // var x= 
                                // "<p id='likes$reviewid'>Likes: "+likes+"</p>"+
                                // "<h4 id='likesbutton$reviewid'>Liked</h4>"+
                                // "<p id='dislikes$reviewid'>Dislikes: "+dislikes+"</p>"+
                                // "<button id='dislikesbutton"+reviewid+"' type='button' onclick='likeOrDislike("+reviewid+",0,"+likes+","+dislikes+")'>Dislike</button>";

                                document.getElementById(likeid).innerHTML = likes+"&nbsp&nbsp<i  style='color:#73C2FB;opacity:0.8;' style='color:#73C2FB;opacity:0.8;' class=\"fas fa-chevron-up\"></i>";
                                document.getElementById(dislikedid).innerHTML = dislikes+"&nbsp&nbsp<i onclick='likeOrDislike("+reviewid+",0,"+likes+","+dislikes+")' class=\"fas fa-chevron-down\"></i></span>";
                            } else if(likeordislike==0){
                            

                                // var x ="<p id='likes$reviewid'>Likes: "+likes+"</p>"+
                                // "<button d='likesbutton$reviewid' type='button' onclick='likeOrDislike("+reviewid+",1,"+likes+","+dislikes+")'>Like</button>"+
                                // "<p id='dislikes$reviewid'>Dislikes: "+dislikes+"</p>"+
                                // "<h4 id='dislikesbutton"+reviewid+"'>Disliked</h4>";

                                document.getElementById(likeid).innerHTML = likes+"&nbsp&nbsp<i  onclick='likeOrDislike("+reviewid+",1,"+likes+","+dislikes+")' class=\"fas fa-chevron-up\"></i>";
                                document.getElementById(dislikedid).innerHTML = dislikes+"&nbsp&nbsp<i  style='color:#73C2FB;opacity:0.8;' class=\"fas fa-chevron-down\"></i></span>";


                            }


                            // console.log(box);
                            // console.log(x);

                            // prnt.innerHTML = x;

                        }

                        
                        
                    }

                    
                    
                    
                }

            });
        }

        function editReview(reviewid){

            

            var commentid = "comment"+reviewid;
            var imageid = "image"+reviewid;
            var ratingid = "rating"+reviewid;
            var submitid = "submit"+reviewid;
            var editbutton = "editbutton"+reviewid;
            var deleteid = "delete"+reviewid;
            var replybutton = "replybutton"+reviewid;
            console.log(replybutton);

            
            if(document.getElementById(commentid)){
                document.getElementById(commentid).innerHTML = "<input type='text' name='comment' class='inptdesign' placeholder='Comment'><input name='id' value="+reviewid+" style=display:none>";
            }

            if(document.getElementById(ratingid)){
                document.getElementById("reviewsrating"+reviewid).innerHTML="";
                
                document.getElementById(ratingid).innerHTML = "<input class='inptdesign' type='text' name='rating' placeholder='Rating'>";
            }

            if(document.getElementById(submitid)){
                document.getElementById(submitid).style.display= "";

            }

            if(document.getElementById(editbutton)){
                document.getElementById(editbutton).style.display = "none";
            }

            if(document.getElementById(replybutton)){
                document.getElementById(replybutton).style.display = "none";
            }
             
            if(document.getElementById(deleteid)){
                document.getElementById(deleteid).style.display= "";
            }
               

                

        }


        function replyReview(reviewid){
        

            var replybox = "replybox"+reviewid;
            document.getElementById(replybox).style.display    = "";

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
                    if(result!=null&&result!=''&&result!='error'){

                        
                        document.getElementById("left").innerHTML = "ONLY "+result+" REMAINING";

                        
                        document.getElementById("quantity").setAttribute("max",result);

                        
                    }

                    
                    
                    
                }

            });


            


        }

        calculateInventory();

        
        



        
          
          

  
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

<script>
    
        // Add slideDown animation to Bootstrap dropdown when expanding.
        $('.dropdown').on('show.bs.dropdown', function() {
            $(this).find('.dropdown-unroll').first().stop(true, true).slideDown();
        }).on('hide.bs.dropdown', function() {
            $(this).find('.dropdown-unroll').first().stop(true, true).slideUp();
        });

</script>
</html>