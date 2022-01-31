<?php

function checkTime($current,$selected){
    //false means good

    
    $current = floatval(strtotime($current));
    $selected = floatval(strtotime($selected));

    if($selected<$current || $selected == $current){
        return false;
    } elseif($selected>$current){
        return true;
    }
}

function badTaskInput($array){
    $pattern = "/^(?=.{1,30}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._]+(?<![_.])$/i";

    for($i=0;$i<sizeof($array);$i++){
        $input = $array[$i];
        $a = !(preg_match($pattern,$input));

        if($a==1){
            return true;
        }
    }
    
    return false;

    //0 is valid input

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



    function regexDate($array){
        $pattern = "/^(19[0-9]{2}|[2-9][0-9]{3})-((0(1|3|5|7|8)|10|12)-(0[1-9]|1[0-9]|2[0-9]|3[0-1])|(0(4|6|9)|11)-(0[1-9]|1[0-9]|2[0-9]|30)|(02)-(0[1-9]|1[0-9]|2[0-9]))\x20(0[0-9]|1[0-9]|2[0-3])(:[0-5][0-9]){2}$/i";
    
        for($i=0;$i<sizeof($array);$i++){
            $input = $array[$i];
            $a = !(preg_match($pattern,$input));
    
            if($a==1){
                return true;
            }
        }
        
        return false;
    
        //0 is valid input
    
    }
?>