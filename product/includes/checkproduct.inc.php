<?php

function calculateProductCode($array){

    //print_r($array);


    $string = '';

    
    $string = $array['product_name'];
    

    foreach ($array as $key => $val) { 

        //check for bad input here

        $a = 0;
        $b = 0;

        

        if($a==1 || $b==1){
            break; //break out of the loop, so code wont be able to match at all
        }

        $key = preg_replace('/\s+/', '_', $key);
        $val = preg_replace('/\s+/', '_', $val);
        
        
        

        
        if($key!='type'&&$key!='product_name'){

            

            $string = $string. ','.$key .',' .$val;



        }

        
    }


   

    return md5($string);

    

}



function badInputThree($array){
    $pattern = "/^[a-zA-Z0-9_\- ]*$/i";

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
    }

    //convert the nested json array inside to array
    $postinformation = json_decode($postinformation, true);

    //line for regex here
    ##NEW------------------------------------------------
    
    
    if(badInputThree($postinformation)==1){
        echo 'error';

    }





}


if(isset($postinformation)&&$postinformation['type']=='ajax'){

    $productcode =  calculateProductCode($postinformation);
    

    if(isset($productcode)){
        //cannot use required once fr ajax!
        $conn = mysqli_connect("localhost", "root", "uwu", "mydb",3307);
        $query = $conn->prepare("SELECT quantityleft FROM mydb.inventory WHERE productcode = '$productcode';");
        if(!$query){
            echo "Prepare failed: (". $conn->errno.") ".$conn->error."<br>";
        }

        if($query->execute()){

            $query->bind_result($qnleft);

            if($query->fetch()){
                echo $qnleft;
            }



        } else {
            echo mysqli_error($query);
        }

    }


}
