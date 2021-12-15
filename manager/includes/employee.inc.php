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
    //i at the end represents case-insensitive
    //first condition: length cannot exceed 30 characters or be less than 1
    //second: cannot begin with _ or .
    //third: cannot contain more than 2 consecutive _s or .s
    //fourth: can contain any number of alphabet or number
    //fifth: cannot end with _ or .
    $pattern = "/^(?=.{1,30}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._\s]+(?<![_.])$/i";

    for($i=0;$i<sizeof($array);$i++){
        $input = $array[$i];
        $a = (preg_match($pattern,$input));

        //$a will equal to 0 if the content is not safe(contains only characters inside of $pattern)
        if($a===0){
            //false will indicate that the text is not safe
            return true;
        }
    }
    
    // This code will run if the content is not safe or if t
    return false;

    //0 is valid input

}


?>