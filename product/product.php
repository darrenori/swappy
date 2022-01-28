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
    

    //db con
    require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/dbh.inc.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/product/includes/productfunctions.inc.php';
    require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/auth/pages.php';

    require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/functions.inc.php';
    require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
    
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


    echo "<p id='left' ></p>";

   echo "<p>Quantity: </p>";
   
   echo "<input id='quantity' onchange='calculatePriceUserSide()' type=number name='quantity' min=1 max=100  value=1>"."<br><br>";

   echo "Total Costs: <br>";

   
   
   
   echo "<p id='price'>"."S$".$product_price . "</p>";

   echo "<input type='submit' >";

    echo "</form>";









    //check fi already favorited

    $query->close();


    //add to favorites
    try {
        $query = $conn->prepare("SELECT product_id,user_id FROM mydb.usersfavorite WHERE product_id = '$id' AND user_id ='$signedinuserid';");
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
        echo "<div id='favorite$id'><button type='button'  onclick='favorite($id)'>Unfavorite</button></div>";

    } else {
        echo "<div id='favorite$id'><button type='button'  onclick='favorite($id)'>Favorite this</button></div>";

    }

    



















   //store initial session variables
   session_start();


   

   
   
   //update jwt
   //require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/functions.inc.php';
   $arraytogivejwt['productid'] = $id;
   $arraytogivejwt['progresscheckout'] = 'A';
   jwtupdate($arraytogivejwt);

//    print_r(apache_request_headers()); 












    //start of reviews
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

    $query=$conn->prepare("SELECT review_id,childof_id FROM mydb.reviews INNER JOIN mydb.users ON mydb.reviews.review_user_id = mydb.users.user_id WHERE review_product_id=$id AND childof_id IS not null ORDER BY review_date;");
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

    

    $query=$conn->prepare("SELECT user_id,review_id,liked FROM mydb.likedby WHERE product_id = '$id';");
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
    $query = $conn->prepare("SELECT user_id,review_id,user_username,user_profilepicture,review_comment,review_rating,review_total_likes,review_total_dislikes,review_date,childof_id,review_pic,user_role FROM mydb.reviews INNER JOIN mydb.users ON mydb.reviews.review_user_id = mydb.users.user_id WHERE review_product_id = $id AND childof_id IS null;");
    if($query->execute()){
        $result = $query->get_result();
        $allparents = $result->fetch_all(MYSQLI_ASSOC);
        
        
    }

    $query->close();


    for($i=0;$i<sizeof($allparents);$i++){

        //echo parent first

        

        if($signedinuserid==$allparents[$i]['user_id']){


            if($allparents[$i]['user_role']==6){
                //if review posted by user currently signed in

                $reviewidparent = $allparents[$i]['review_id'];
                $profilepicture = $image->show($allparents[$i]['review_pic']);
                $likes = $allparents[$i]['review_total_likes'];
                $dislikes = $allparents[$i]['review_total_dislikes'];

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

                echo "<div id=likeordislikecontainer$reviewidparent>";


                if(in_array($reviewidparent,$listwhichuserliked)){
                    //if its liked already
                    
                    echo "<p id='likes$reviewid'>Likes: ".$allparents[$i]['review_total_likes']."</p>";
                    echo "<h4 id='likesbutton$reviewid'>Liked</h4>";
                } else {
                    echo "<p id='likes$reviewid'>Likes: ".$allparents[$i]['review_total_likes']."</p>";
                    echo "<button d='likesbutton$reviewid' type='button' onclick='likeOrDislike($reviewidparent,1,$likes,$dislikes)'>Like</button>";

                }

                if(in_array($reviewidparent,$listwhichuserdisliked)){
                    //if its disliked already
                    echo "<p id='dislikes$reviewid'>Dislikes: ".$allparents[$i]['review_total_dislikes']."</p>";
                    echo "<h4 id='dislikesbutton$reviewid'>Disliked</h4>";
                } else {
                    echo "<p id='dislikes$reviewid'>Dislikes: ".$allparents[$i]['review_total_dislikes']."</p>";
                    echo "<button id='dislikesbutton$reviewid' type='button' onclick='likeOrDislike($reviewidparent,0,$likes,$dislikes)'>Dislike</button>";
                }

                echo "</div>";
                
                

                


                echo "<p>Date: ".$allparents[$i]['review_date']."</p>";

                echo "<button type='button' id='editbutton$reviewidparent' onclick='editReview($reviewidparent)'>"."Edit". "</button>";


                echo "<button type='submit' id='submit$reviewidparent' style='display:none'>Submit</button>";
                echo "<br><br>";
                echo "<button type='button' id='replybutton$reviewidparent' onclick='replyReview($reviewidparent)'>"."Reply". "</button>";

                echo "<a id='delete$reviewidparent' href='"."https://www.swapamc.com/swapproj/deletereview?id=$reviewidparent"."'><button type='button'>Delete</button></a>";
                

                echo "</form>";

                echo "<form style='display:none' method='POST' action='https://www.swapamc.com/swapproj/replyreview?id=$reviewidparent' id='replybox$reviewidparent'>";
                echo "<input type='text' name='comment' placeholder='comment'>";
                echo "<input type='submit'>";
                echo "</form>";

            } else {
                //if review posted by user currently signed in

                $reviewidparent = $allparents[$i]['review_id'];
                $profilepicture = $image->show($allparents[$i]['review_pic']);
                $likes = $allparents[$i]['review_total_likes'];
                $dislikes = $allparents[$i]['review_total_dislikes'];

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


                // echo "<p>Likes: ".$allparents[$i]['review_total_likes']."</p>";
                // echo "<p>Dislikes: ".$allparents[$i]['review_total_dislikes']."</p>";

                echo "<div id=likeordislikecontainer$reviewidparent>";

                if(in_array($reviewidparent,$listwhichuserliked)){
                    //if its liked already
                    
                    echo "<p id='likes$reviewid'>Likes: ".$allparents[$i]['review_total_likes']."</p>";
                    echo "<h4 id='likesbutton$reviewid'>Liked</h4>";
                } else {
                    echo "<p id='likes$reviewid'>Likes: ".$allparents[$i]['review_total_likes']."</p>";
                    echo "<button d='likesbutton$reviewid' type='button' onclick='likeOrDislike($reviewidparent,1,$likes,$dislikes)'>Like</button>";

                }

                if(in_array($reviewidparent,$listwhichuserdisliked)){
                    //if its disliked already
                    echo "<p id='dislikes$reviewid'>Dislikes: ".$allparents[$i]['review_total_dislikes']."</p>";
                    echo "<h4 id='dislikesbutton$reviewid'>Disliked</h4>";
                } else {
                    echo "<p id='dislikes$reviewid'>Dislikes: ".$allparents[$i]['review_total_dislikes']."</p>";
                    echo "<button id='dislikesbutton$reviewid' type='button' onclick='likeOrDislike($reviewidparent,0,$likes,$dislikes)'>Dislike</button>";
                }

                echo "</div>";


                echo "<p>Date: ".$allparents[$i]['review_date']."</p>";

                echo "<button type='button' id='editbutton$reviewidparent' onclick='editReview($reviewidparent)'>"."Edit". "</button>";


                echo "<button type='submit' id='submit$reviewidparent' style='display:none'>Submit</button>";
                echo "<br><br>";

                echo "<a id='delete$reviewidparent' href='"."https://www.swapamc.com/swapproj/deletereview?id=$reviewidparent"."'><button type='button'>Delete</button></a>";
                

                echo "</form>";
            }
            



            

        } else {
            $reviewidparent = $allparents[$i]['review_id'];
            
            
            if($signedinrole==6){
                $likes = $allparents[$i]['review_total_likes'];
                $dislikes = $allparents[$i]['review_total_dislikes'];
                //if now is admin
                $profilepicture = $image->show($allparents[$i]['review_pic']);
                echo "<p>Username: ".$allparents[$i]['user_username']."</p>";
                echo '<img width="100px" src="'.$profilepicture.'" />';
                echo "<br>";
                echo "<p>Comment: ".$allparents[$i]['review_comment']."</p>";
                echo "<p>Rating: ".$allparents[$i]['review_rating']."</p>";


                echo "<div id=likeordislikecontainer$reviewidparent>";
                if(in_array($reviewidparent,$listwhichuserliked)){
                    //if its liked already
                    
                    echo "<p id='likes$reviewid'>Likes: ".$allparents[$i]['review_total_likes']."</p>";
                    echo "<h4 id='likesbutton$reviewid'>Liked</h4>";
                } else {
                    echo "<p id='likes$reviewid'>Likes: ".$allparents[$i]['review_total_likes']."</p>";
                    echo "<button d='likesbutton$reviewid' type='button' onclick='likeOrDislike($reviewidparent,1,$likes,$dislikes)'>Like</button>";

                }

                if(in_array($reviewidparent,$listwhichuserdisliked)){
                    //if its disliked already
                    echo "<p id='dislikes$reviewid'>Dislikes: ".$allparents[$i]['review_total_dislikes']."</p>";
                    echo "<h4 id='dislikesbutton$reviewid'>Disliked</h4>";
                } else {
                    echo "<p id='dislikes$reviewid'>Dislikes: ".$allparents[$i]['review_total_dislikes']."</p>";
                    echo "<button id='dislikesbutton$reviewid' type='button' onclick='likeOrDislike($reviewidparent,0,$likes,$dislikes)'>Dislike</button>";
                }
                echo "</div>";



                echo "<p>Date: ".$allparents[$i]['review_date']."</p>";
                echo "<button type='button' id='replybutton$reviewidparent' onclick='replyReview($reviewidparent)'>"."Reply". "</button>";
                echo "<a id='delete$reviewidparent' href='"."https://www.swapamc.com/swapproj/deletereview?id=$reviewidparent"."'><button type='button'>Delete</button></a>";

                echo "<form style='display:none' method='POST' action='https://www.swapamc.com/swapproj/replyreview?id=$reviewidparent' id='replybox$reviewidparent'>";
                echo "<input type='text' name='comment' placeholder='comment'>";
                echo "<input type='submit'>";
                echo "</form>";

                
            } else {
                $profilepicture = $image->show($allparents[$i]['review_pic']);
                $likes = $allparents[$i]['review_total_likes'];
                $dislikes = $allparents[$i]['review_total_dislikes'];
                echo "<p>Username: ".$allparents[$i]['user_username']."</p>";
                echo '<img width="100px" src="'.$profilepicture.'" />';
                echo "<br>";
                echo "<p>Comment: ".$allparents[$i]['review_comment']."</p>";
                echo "<p>Rating: ".$allparents[$i]['review_rating']."</p>";


                echo "<div id=likeordislikecontainer$reviewidparent>";

                
                if(in_array($reviewidparent,$listwhichuserliked)){
                    //if its liked already
                    
                    echo "<p id='likes$reviewid'>Likes: ".$allparents[$i]['review_total_likes']."</p>";
                    echo "<h4 id='likesbutton$reviewid'>Liked</h4>";
                } else {
                    echo "<p id='likes$reviewid'>Likes: ".$allparents[$i]['review_total_likes']."</p>";
                    echo "<button d='likesbutton$reviewid' type='button' onclick='likeOrDislike($reviewidparent,1,$likes,$dislikes)'>Like</button>";

                }

                if(in_array($reviewidparent,$listwhichuserdisliked)){
                    //if its disliked already
                    echo "<p id='dislikes$reviewid'>Dislikes: ".$allparents[$i]['review_total_dislikes']."</p>";
                    echo "<h4 id='dislikesbutton$reviewid'>Disliked</h4>";
                } else {
                    echo "<p id='dislikes$reviewid'>Dislikes: ".$allparents[$i]['review_total_dislikes']."</p>";
                    echo "<button id='dislikesbutton$reviewid' type='button' onclick='likeOrDislike($reviewidparent,0,$likes,$dislikes)'>Dislike</button>";
                }

                echo "</div>";



                echo "<p>Date: ".$allparents[$i]['review_date']."</p>";
                
            }
            
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


                        if($signedinrole==6){
                            //only admin can reply >:)
                            
                            // $profilepicture = $image->show($reviewpic);
            
                            echo "<form method=POST action='https://www.swapamc.com/swapproj/editreview' enctype='multipart/form-data'>";
                
                            echo "<p style='margin-left:30px'>Username: ".$username."</p>";
                
                            // echo "<div id='image$reviewid' style='margin-left:30px'>";
                            // echo '<img  width="100px" src="'.$profilepicture.'" />';
                            // echo "</div>";
                
                            //echo "<br>";
                
                            echo "<div id='comment$reviewid' style='margin-left:30px'>";
                            echo "<p>Comment: ".$comment."</p>";
                            echo "</div>";
                
                            
                
                
                            // echo "<p style='margin-left:30px'>Likes: ".$likes."</p>";
                            // echo "<p style='margin-left:30px'>Dislikes: ".$dislikes."</p>";


                            echo "<div id=likeordislikecontainer$reviewid>";
                            if(in_array($reviewid,$listwhichuserliked)){
                                //if its liked already
                                
                                echo "<p style='margin-left:30px' id='likes$reviewid'>Likes: ".$likes."</p>";
                                echo "<h4 style='margin-left:30px' id='likesbutton$reviewid'>Liked</h4>";
                            } else {
                                echo "<p style='margin-left:30px' id='likes$reviewid' >Likes: ".$likes."</p>";
                                echo "<button style='margin-left:30px' id='likesbutton$reviewid' type='button' onclick='likeOrDislike($reviewid,1,$likes,$dislikes)'>Like</button>";
            
                            }
            
                            if(in_array($reviewid,$listwhichuserdisliked)){
                                //if its disliked already
                                echo "<p style='margin-left:30px' id='dislikes$reviewid' >Dislikes: ".$dislikes."</p>";
                                echo "<h4 style='margin-left:30px' id='dislikesbutton$reviewid' >Disliked</h4>";
                            } else {
                                echo "<p style='margin-left:30px' id='dislikes$reviewid' >Dislikes: ".$dislikes."</p>";
                                echo "<button style='margin-left:30px' id='dislikesbutton$reviewid' type='button' onclick='likeOrDislike($reviewid,0,$likes,$dislikes)'>Dislike</button>";
                            }
                            echo "</div>";







                            
                            echo "<p style='margin-left:30px'>Date: ".$date."</p>";
                
                            echo "<button style='margin-left:30px' type='button' id='editbutton$reviewid' onclick='editReview($reviewid)'>"."Edit". "</button>";
                            echo "<button style='margin-left:30px' type='button' id='replybutton$reviewid' onclick='replyReview($reviewid)'>"."Reply". "</button>";
                
                
                            echo "<button style='margin-left:30px;display:none' type='submit' id='submit$reviewid'>Submit</button>";
                            echo "<br><br>";
                            echo "<a style='margin-left:30px' id='delete$reviewid' href='"."https://www.swapamc.com/swapproj/deletereview?id=$reviewid"."'><button type='button'>Delete</button></a>";
                            
                            
                            echo "</form>";

                            echo "<form style='display:none' method='POST' action='https://www.swapamc.com/swapproj/replyreview?id=$reviewid' id='replybox$reviewid'>";
                            echo "<input type='text' name='comment' placeholder='comment'>";
                            echo "<input type='submit'>";
                            
                            echo "</form>";
                            

                        } else {
                            // $profilepicture = $image->show($reviewpic);
            
                            echo "<form method=POST action='https://www.swapamc.com/swapproj/editreview' enctype='multipart/form-data'>";
                
                            echo "<p style='margin-left:30px'>Username: ".$username."</p>";
                
                            // echo "<div id='image$reviewid' style='margin-left:30px'>";
                            // echo '<img  width="100px" src="'.$profilepicture.'" />';
                            // echo "</div>";
                
                            //echo "<br>";
                
                            echo "<div id='comment$reviewid' style='margin-left:30px'>";
                            echo "<p>Comment: ".$comment."</p>";
                            echo "</div>";
                
                            // echo "<div id='rating$reviewid' style='margin-left:30px'>";
                            // echo "<p>Rating: ".$rating."</p>";
                            // echo "</div>";
                
                
                            // echo "<p style='margin-left:30px'>Likes: ".$likes."</p>";
                            // echo "<p style='margin-left:30px'>Dislikes: ".$dislikes."</p>";

                            echo "<div id=likeordislikecontainer$reviewid>";

                            if(in_array($reviewid,$listwhichuserliked)){
                                //if its liked already
                                
                                echo "<p style='margin-left:30px' id='likes$reviewid'>Likes: ".$likes."</p>";
                                echo "<h4 style='margin-left:30px' id='likesbutton$reviewid'>Liked</h4>";
                            } else {
                                echo "<p style='margin-left:30px' id='likes$reviewid' >Likes: ".$likes."</p>";
                                echo "<button style='margin-left:30px' id='likesbutton$reviewid' type='button' onclick='likeOrDislike($reviewid,1,$likes,$dislikes)'>Like</button>";
            
                            }
            
                            if(in_array($reviewid,$listwhichuserdisliked)){
                                //if its disliked already
                                echo "<p style='margin-left:30px' id='dislikes$reviewid' >Dislikes: ".$dislikes."</p>";
                                echo "<h4 style='margin-left:30px' id='dislikesbutton$reviewid' >Disliked</h4>";
                            } else {
                                echo "<p style='margin-left:30px' id='dislikes$reviewid' >Dislikes: ".$dislikes."</p>";
                                echo "<button style='margin-left:30px' id='dislikesbutton$reviewid' type='button' onclick='likeOrDislike($reviewid,0,$likes,$dislikes)'>Dislike</button>";
                            }
                            echo "</div>";




                            echo "<p style='margin-left:30px'>Date: ".$date."</p>";
                
                            echo "<button style='margin-left:30px' type='button' id='editbutton$reviewid' onclick='editReview($reviewid)'>"."Edit". "</button>";
                
                
                            echo "<button style='margin-left:30px;display:none' type='submit' id='submit$reviewid'>Submit</button>";
                            echo "<br><br>";
                            echo "<a style='margin-left:30px' id='delete$reviewid' href='"."https://www.swapamc.com/swapproj/deletereview?id=$reviewid"."'><button type='button'>Delete</button></a>";
                            
                            
                            echo "</form>";
                           
                        }
                        
            
                        
            
            
            
                       
            
                    } else {
                        if($signedinrole==6){
                            //$profilepicture = $image->show($reviewpic);
            
                            echo "<p style='margin-left:30px'>Username: ".$username."</p>";
                            //echo '<img style="margin-left:30px" width="100px" src="'.$profilepicture.'" />';
                            //echo "<br>";
                            echo "<p style='margin-left:30px'>Comment: ".$comment."</p>";
                            //echo "<p style='margin-left:30px'>Rating: ".$rating."</p>";


                            echo "<div id=likeordislikecontainer$reviewid>";
                            if(in_array($reviewid,$listwhichuserliked)){
                                //if its liked already
                                
                                echo "<p style='margin-left:30px' id='likes$reviewid'>Likes: ".$likes."</p>";
                                echo "<h4 style='margin-left:30px' id='likesbutton$reviewid'>Liked</h4>";
                            } else {
                                echo "<p style='margin-left:30px' id='likes$reviewid' >Likes: ".$likes."</p>";
                                echo "<button style='margin-left:30px' id='likesbutton$reviewid' type='button' onclick='likeOrDislike($reviewid,1,$likes,$dislikes)'>Like</button>";
            
                            }
            
                            if(in_array($reviewid,$listwhichuserdisliked)){
                                //if its disliked already
                                echo "<p style='margin-left:30px' id='dislikes$reviewid' >Dislikes: ".$dislikes."</p>";
                                echo "<h4 style='margin-left:30px' id='dislikesbutton$reviewid' >Disliked</h4>";
                            } else {
                                echo "<p style='margin-left:30px' id='dislikes$reviewid' >Dislikes: ".$dislikes."</p>";
                                echo "<button style='margin-left:30px' id='dislikesbutton$reviewid' type='button' onclick='likeOrDislike($reviewid,0,$likes,$dislikes)'>Dislike</button>";
                            }

                            echo"</div>";




                            echo "<p style='margin-left:30px'>Date: ".$date."</p>";
                            echo "<button style='margin-left:30px' type='button' id='replybutton$reviewid' onclick='replyReview($reviewid)'>"."Reply". "</button>";
                            echo "<a style='margin-left:30px' id='delete$reviewid' href='"."https://www.swapamc.com/swapproj/deletereview?id=$reviewid"."'><button type='button'>Delete</button></a>";


                            echo "<form style='display:none' method='POST' action='https://www.swapamc.com/swapproj/replyreview?id=$reviewid' id='replybox$reviewid'>";
                            echo "<input type='text' name='comment' placeholder='comment'>";
                            echo "<input type='submit'>";
                            echo "</form>";
                            

                        } else {
                            //$profilepicture = $image->show($reviewpic);
            
                            echo "<p style='margin-left:30px'>Username: ".$username."</p>";
                            //echo '<img style="margin-left:30px" width="100px" src="'.$profilepicture.'" />';
                           // echo "<br>";
                            echo "<p style='margin-left:30px'>Comment: ".$comment."</p>";



                            echo "<div id=likeordislikecontainer$reviewid>";
                            if(in_array($reviewid,$listwhichuserliked)){
                                //if its liked already
                                
                                echo "<p style='margin-left:30px' id='likes$reviewid'>Likes: ".$likes."</p>";
                                echo "<h4 style='margin-left:30px' id='likesbutton$reviewid'>Liked</h4>";
                            } else {
                                echo "<p style='margin-left:30px' id='likes$reviewid' >Likes: ".$likes."</p>";
                                echo "<button style='margin-left:30px' id='likesbutton$reviewid' type='button' onclick='likeOrDislike($reviewid,1,$likes,$dislikes)'>Like</button>";
            
                            }
            
                            if(in_array($reviewid,$listwhichuserdisliked)){
                                //if its disliked already
                                echo "<p style='margin-left:30px' id='dislikes$reviewid' >Dislikes: ".$dislikes."</p>";
                                echo "<h4 style='margin-left:30px' id='dislikesbutton$reviewid' >Disliked</h4>";
                            } else {
                                echo "<p style='margin-left:30px' id='dislikes$reviewid' >Dislikes: ".$dislikes."</p>";
                                echo "<button style='margin-left:30px' id='dislikesbutton$reviewid' type='button' onclick='likeOrDislike($reviewid,0,$likes,$dislikes)'>Dislike</button>";
                            }
                            echo "</div>";








                            echo "<p style='margin-left:30px'>Date: ".$date."</p>";
                            

                        }
                        
                    }

                }

            }

            $query->close();
            
            
        }
        

    

    }

    
    
    

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

            //new
            total = sanitizeHTML(total);
            document.getElementById("price").textContent = "S$"+total;


            calculateInventory();

        }

        function favorite(productid){
            var array= {};
            array['type'] = 'ajax';
            array['productid'] = productid;

            var jsonString = JSON.stringify(array);

            jQuery.ajax({
                url:'https://www.swapamc.com/swapproj/product/favorite?id='+productid,
                type:'post',
                data: {info:jsonString},
                

                success:function(result){



                    if(result=='favorited'){
                        

                        if(document.getElementById("favorite"+productid)){
                            
                            document.getElementById("favorite"+productid).innerHTML = "<button type='button'  onclick='favorite("+productid+")'>Unfavorite</button>";
                        }

                        


                    } else if (result=='unfavorited'){

                        if(document.getElementById("favorite"+productid)){

                            document.getElementById("favorite"+productid).innerHTML = "<button type='button'  onclick='favorite("+productid+")'>Favorite This</button>";
                        }
                    }

                    



                    

                    
                    
                    
                }

            });
            
            
            
        }




        function likeOrDislike(reviewid,likeordislike,likes,dislikes){
            
            var array= {};
            array['type'] = 'ajax';
            array['reviewid'] = reviewid;
            array['likeordislike'] = likeordislike;

            var jsonString = JSON.stringify(array);
            jQuery.ajax({
                url:'https://www.swapamc.com/swapproj/likeordislike',
                type:'post',
                data: {info:jsonString},
                

                success:function(result){

                    



                    if(result!=null&&result!=''){
                        var response = JSON.parse(result);
                        if(response['likes']!=null||response['dislikes']!=null){
                            likes = response['likes'];
                            dislikes = response['dislikes'];
                        }

                        

                        if(true){

                            
                            if(likeordislike==1){
                                //if liked
                                
                                var x= 
                                "<p id='likes$reviewid'>Likes: "+likes+"</p>"+
                                "<h4 id='likesbutton$reviewid'>Liked</h4>"+
                                "<p id='dislikes$reviewid'>Dislikes: "+dislikes+"</p>"+
                                "<button id='dislikesbutton"+reviewid+"' type='button' onclick='likeOrDislike("+reviewid+",0,"+likes+","+dislikes+")'>Dislike</button>";

                            } else if(likeordislike==0){
                            

                                var x ="<p id='likes$reviewid'>Likes: "+likes+"</p>"+
                                "<button d='likesbutton$reviewid' type='button' onclick='likeOrDislike("+reviewid+",1,"+likes+","+dislikes+")'>Like</button>"+
                                "<p id='dislikes$reviewid'>Dislikes: "+dislikes+"</p>"+
                                "<h4 id='dislikesbutton"+reviewid+"'>Disliked</h4>";
                            }

                            var box  = "likeordislikecontainer"+reviewid;

                            // console.log(box);
                            // console.log(x);

                            document.getElementById(box).innerHTML = x;

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
                document.getElementById(commentid).innerHTML = "<input type='text' name='comment' placeholder='Comment'><input name='id' value="+reviewid+" style=display:none>";
            }

            if(document.getElementById(ratingid)){
                
                document.getElementById(ratingid).innerHTML = "<input type='text' name='rating' placeholder='Rating'>";
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



</html>