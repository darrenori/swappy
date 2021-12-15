<?php

function notEmpty($array)
{
    for ($i = 0; $i < sizeof($array); $i++) {
        if ($array[$i] == "" || $array[$i] == null) {
            return false;
        }
    }

    return true;
}


function badInput($array){
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