<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
$jwtarray = jwtdecrypt();
$jwtarrayinformation = $jwtarray['array'];

if ($jwtarrayinformation['checkoutstate'] == "B" ){



// after user finish checkout
echo "Checkout Completed!";
echo "<br>";
echo "<a href='https://www.swapamc.com/swapproj/campus'>Back To Home Page </a>";
unset($jwtarrayinformation["checkoutstate"]);

} else {
    header("location:https://www.swapamc.com/swapproj/checkout?error=invalidstate");
}
?>

<html>
<script type="text/javascript">
    function preventBack() {
        window.history.forward();
        setTimeout("preventBack()", 0);
        window.onunload = function() {
            null
        };
    }
</script>
</html>