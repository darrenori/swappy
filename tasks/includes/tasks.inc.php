<?php

function checkTime($current,$selected){
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


?>