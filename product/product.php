<?php
    
   
    

    //db con
    require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/dbh.inc.php';
    require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/product/product.function.php';
    require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/auth/pages.php';

    require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/functions.inc.php';
    
$jwtarray = jwtdecrypt();
if(isset($jwtarray)&&$jwtarray==true){
    
    $jwtarrayinformation = $jwtarray['array'];

} else {
    header("location: https://www.swapamc.com/swapproj/logout");
    exit();
}


    
    
    
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

    echo "<form method='POST' action='/swapproj/addreview' enctype='multipart/form-data'>";

    echo "<p>Comment:</p>";
    echo "<input type='text' name='comment'>";


    echo "<p>Rating:</p>";
    echo "<input type='number' max=5 min=1 name='rating'>";


    echo "<p>Image:</p>";
    echo "<input type='file' name='image'>";
    echo "<br><br>";

    echo "<input type='submit'>";
    

    echo "</form>";

    
    // require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/images/showimage.php';
    // $image = new Image();
    // $src = $image->show("images/wite.jpg");
    // echo '<img src="'.$src.'" />';


    require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/images/showimage.php';
    $image = new Image();



    $query->close();

    //review section
    $childarray = [];
    $parentchild = [];

    $query=$conn->prepare("SELECT review_id,childof_id FROM mydb.reviews INNER JOIN mydb.users ON mydb.reviews.review_user_id = mydb.users.user_id WHERE review_product_id=1 AND childof_id IS not null ORDER BY review_date;");
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


    $signedinuserid = $jwtarrayinformation['userid'];
    
    
    


    //get all parents
    $query = $conn->prepare("SELECT user_id,review_id,user_username,user_profilepicture,review_comment,review_rating,review_total_likes,review_total_dislikes,review_date,childof_id,review_pic FROM mydb.reviews INNER JOIN mydb.users ON mydb.reviews.review_user_id = mydb.users.user_id WHERE review_product_id = $id AND childof_id IS null;");
    if($query->execute()){
        $result = $query->get_result();
        $allparents = $result->fetch_all(MYSQLI_ASSOC);
        
        
    }

    $query->close();


    for($i=0;$i<sizeof($allparents);$i++){

        //echo parent first

        

        if($signedinuserid==$allparents[$i]['user_id']){
            //if review posted by user currently signed in

            $reviewidparent = $allparents[$i]['review_id'];
            $profilepicture = $image->show($allparents[$i]['review_pic']);

            echo "<form method=POST action='https://www.swapamc.com/swapproj/editreview' enctype='multipart/form-data'>";

            echo "<p>Username: ".$allparents[$i]['user_username']."</p>";

            echo "<div id='image$reviewidparent'>";
            echo '<img  width="100px" src="'.$profilepicture.'" />';
            echo "</div>";

            echo "<br>";

            echo "<div id='comment$reviewidparent'>";
            echo "<p>Comment: ".$allparents[$i]['review_comment']."</p>";
            echo "</div>";

            echo "<div id='rating$reviewidparent'>";
            echo "<p>Rating: ".$allparents[$i]['review_rating']."</p>";
            echo "</div>";


            echo "<p>Likes: ".$allparents[$i]['review_total_likes']."</p>";
            echo "<p>Dislikes: ".$allparents[$i]['review_total_dislikes']."</p>";
            echo "<p>Date: ".$allparents[$i]['review_date']."</p>";

            echo "<button type='button' id='editbutton$reviewidparent' onclick='editReview($reviewidparent)'>"."Edit". "</button>";


            echo "<button type='submit' id='submit$reviewidparent' style='display:none'>Submit</button>";
            echo "<br><br>";
            echo "<a style='display:none' id='delete$reviewidparent' href='"."https://www.swapamc.com/swapproj/deletereview?id=$reviewidparent"."'><button type='button'>Delete</button></a>";
            

            echo "</form>";



            // echo "<a href='"."edit"."'>"."Edit". "</a>";
            // echo "<br>";
            // echo "<a href='"."delete"."'>"."Delete". "</a>";

        } else {
            $profilepicture = $image->show($allparents[$i]['review_pic']);

            echo "<p>Username: ".$allparents[$i]['user_username']."</p>";
            echo '<img width="100px" src="'.$profilepicture.'" />';
            echo "<br>";
            echo "<p>Comment: ".$allparents[$i]['review_comment']."</p>";
            echo "<p>Rating: ".$allparents[$i]['review_rating']."</p>";
            echo "<p>Likes: ".$allparents[$i]['review_total_likes']."</p>";
            echo "<p>Dislikes: ".$allparents[$i]['review_total_dislikes']."</p>";
            echo "<p>Date: ".$allparents[$i]['review_date']."</p>";
        }

        
        
        

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
                    
                    if($signedinuserid==$uid){
                        //if review posted by user currently signed in
            
                        $profilepicture = $image->show($reviewpic);
            
                        echo "<form method=POST action='https://www.swapamc.com/swapproj/editreview' enctype='multipart/form-data'>";
            
                        echo "<p style='margin-left:30px'>Username: ".$username."</p>";
            
                        echo "<div id='image$reviewid' style='margin-left:30px'>";
                        echo '<img  width="100px" src="'.$profilepicture.'" />';
                        echo "</div>";
            
                        echo "<br>";
            
                        echo "<div id='comment$reviewid' style='margin-left:30px'>";
                        echo "<p>Comment: ".$comment."</p>";
                        echo "</div>";
            
                        echo "<div id='rating$reviewid' style='margin-left:30px'>";
                        echo "<p>Rating: ".$rating."</p>";
                        echo "</div>";
            
            
                        echo "<p style='margin-left:30px'>Likes: ".$likes."</p>";
                        echo "<p style='margin-left:30px'>Dislikes: ".$dislikes."</p>";
                        echo "<p style='margin-left:30px'>Date: ".$date."</p>";
            
                        echo "<button style='margin-left:30px' type='button' id='editbutton$reviewid' onclick='editReview($reviewid)'>"."Edit". "</button>";
            
            
                        echo "<button style='margin-left:30px' type='submit' id='submit$reviewid' style='display:none'>Submit</button>";
                        echo "<br><br>";
                        echo "<a style='margin-left:30px' style='display:none' id='delete$reviewid' href='"."https://www.swapamc.com/swapproj/deletereview?id=$reviewid"."'><button type='button'>Delete</button></a>";
                        
            
                        echo "</form>";
            
            
            
                        // echo "<a href='"."edit"."'>"."Edit". "</a>";
                        // echo "<br>";
                        // echo "<a href='"."delete"."'>"."Delete". "</a>";
            
                    } else {
                        $profilepicture = $image->show($reviewpic);
            
                        echo "<p style='margin-left:30px'>Username: ".$username."</p>";
                        echo '<img style="margin-left:30px" width="100px" src="'.$profilepicture.'" />';
                        echo "<br>";
                        echo "<p style='margin-left:30px'>Comment: ".$comment."</p>";
                        echo "<p style='margin-left:30px'>Rating: ".$rating."</p>";
                        echo "<p  style='margin-left:30px'>Likes: ".$likes."</p>";
                        echo "<p style='margin-left:30px'>Dislikes: ".$dislikes."</p>";
                        echo "<p style='margin-left:30px'>Date: ".$date."</p>";
                    }

                }

            }

            $query->close();
            
            
        }
        

    

    }

    // if($query->execute()){
    //     $query->bind_result($reviewid,$username,$profilepicture,$comment,$rating,$likes,$dislikes,$date,$childofid,$reviewpic);

    //     while($query->fetch()){
    //         if($childofid==null){
                // $profilepicture = $image->show($reviewpic);
                // echo "<p>Username: ".$username."</p>";
                // echo '<img width="100px" src="'.$profilepicture.'" />';
                // echo "<br>";
                // echo "<p>Comment: ".$comment."</p>";
                // echo "<p>Rating: ".$rating."</p>";
                // echo "<p>Likes: ".$likes."</p>";
                // echo "<p>Dislikes: ".$dislikes."</p>";
                // echo "<p>Date: ".$date."</p>";

    //         } else {
                
    //         }
            
    //     }
    // }
    
   
    
    
    

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


        function editReview(reviewid){

            var commentid = "comment"+reviewid;
            var imageid = "image"+reviewid;
            var ratingid = "rating"+reviewid;
            var submitid = "submit"+reviewid;
            var editbutton = "editbutton"+reviewid;
            var deleteid = "delete"+reviewid;


            document.getElementById(commentid).innerHTML = "<input type='text' name='comment' placeholder='Comment'>";
            document.getElementById(imageid).innerHTML = "<input type='file' name='image'>";
            document.getElementById(ratingid).innerHTML = "<input type='text' name='rating' placeholder='Rating'><input name='id' value="+reviewid+" style=display:none>";
            document.getElementById(submitid).style.display = "";
            document.getElementById(editbutton).style.display    = "none";

            document.getElementById(deleteid).style.display    = "";



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

