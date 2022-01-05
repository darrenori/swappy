<?php

// if (!isset($_POST['Price'])) {
//     header("location: https://www.swapamc.com/swapproj/campus?error=unauthorized");
//     exit;
// }



function sort_up($array){
    sort($array);
    return $array;
}
function sort_down($array){
    rsort($array);
    return $array;
}



//sort 