<?php

echo "Checkout Completed!";
echo "<br>";
echo "<a href='https://www.swapamc.com/swapproj/campus'>Back To Home Page </a>";
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