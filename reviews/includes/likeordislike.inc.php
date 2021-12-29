<?php
    //db con
    require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/dbh.inc.php';
    
    require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/auth/pages.php';
    
    require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/functions.inc.php';


function badInputThree($array){
    $pattern = "/^[a-zA-Z0-9_ ]*$/i";

    foreach($array as $key=>$val){
        
        $a = !(preg_match($pattern,$val));

        if($a==1){
            return true;
        }
    }
    
    return false;

    //0 is valid input

}

if(isset($_POST)){
    $postinformation = $_POST;

    

    $postinformation = json_decode(json_encode($postinformation), true);
    if(isset($postinformation['info'])){
        
        $postinformation = $postinformation['info'];
    } else {
        echo "error";
    }

    //convert the nested json array inside to array
    $postinformation = json_decode($postinformation, true);

    //line for regex here
    //print_r($postinformation);

    if(badInputThree($postinformation)==1){
        echo "error";
    } 




} else {
    echo "error";
}



if(isset($postinformation['type'])&&isset($postinformation['reviewid'])&&isset($postinformation['likeordislike'])){
    if($postinformation['type']=='ajax'){
        $reviewid = $postinformation['reviewid'];
        $likeordislike = $postinformation['likeordislike'];
    }

    
} else {
    echo "error";
}


    
$jwtarray = jwtdecrypt();
if(isset($jwtarray)&&$jwtarray==true){
    
    $jwtarrayinformation = $jwtarray['array'];

} else {
    echo "error";
    exit();
}

$userid=$jwtarrayinformation['userid'];
$productid=$jwtarrayinformation['productid'];









//does the reviewid exist? //if so, get current toal likes/dislikes
$query=$conn->prepare("SELECT review_id,review_total_likes,review_total_dislikes FROM mydb.reviews WHERE review_id = $reviewid");
if(!$query){
    echo "error";
    exit();
}

if($query->execute()){
    $result = $query->get_result();
    $allrows = $result->fetch_all(MYSQLI_ASSOC);
    
}



if(count($allrows)!=1){
    echo "error id";
    exit();
}

$allrows = $allrows[0];

$ptotallikes = $allrows['review_total_likes'];
$ptotaldislikes = $allrows['review_total_dislikes'];

$query->close();










//has user alr liked/disliked before? if so, update it. if not add new one
$query=$conn->prepare("SELECT liked FROM mydb.likedby WHERE review_id=$reviewid AND user_id=$userid AND product_id=$productid;");
if(!$query){
    echo "error";
    exit();
}

if($query->execute()){
    $result = $query->get_result();
    $allrows = $result->fetch_all(MYSQLI_ASSOC);
}
$query->close();








if(count($allrows)==0){
    $query=$conn->prepare("INSERT INTO mydb.likedby(review_id,user_id,product_id,liked) VALUES ($reviewid,$userid,$productid,$likeordislike);");

    if(!$query){
        echo "error";
        exit();
    }

    if($query->execute()){
        
        
    }
    $query->close();



    //update in rev table
    if($likeordislike==1){
        //if they have liked

        $ptotallikes = $ptotallikes +1;

        

        
    } elseif($likeordislike==0){
        //if they have disliked

    
        $ptotaldislikes = $ptotaldislikes+1;

        

    }


    




} elseif(count($allrows)==1) {
    $allrows = $allrows[0];

    //update

    if($allrows['liked']==$likeordislike){

        //if they have already liked and try to send another like request
        //or if they have already disliked and try to send another dislike reuqset
        echo "error";
        exit();

        
    }

    $query =$conn->prepare("UPDATE mydb.likedby SET liked='$likeordislike' WHERE review_id=$reviewid AND user_id=$userid AND product_id=$productid;");
    if(!$query){
        echo "error";
        exit();
    }


    if($query->execute()){

    };

    $query->close();






    //update in rev table
    if($likeordislike==1){
        //if they have liked

        $ptotallikes = $ptotallikes +1;
        $ptotaldislikes = $ptotaldislikes-1;

        

        
    } elseif($likeordislike==0){
        //if they have disliked

        $ptotallikes = $ptotallikes -1;
        $ptotaldislikes = $ptotaldislikes+1;

        

    }


} 




$query=$conn->prepare("UPDATE mydb.reviews SET review_total_likes = $ptotallikes, review_total_dislikes = $ptotaldislikes WHERE review_id = $reviewid");
    if(!$query){
        echo "error";   
        exit();
    }

    if($query->execute()){
        $array= [];
        
        $array['likes'] = $ptotallikes;
        $array['dislikes'] = $ptotaldislikes;
        $array = json_encode($array);
        echo $array;

    }



