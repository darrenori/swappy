<?php


declare(strict_types=1);
require 'vendor/autoload.php';
require '../includes/dbh.inc.php';
require '../includes/functions.inc.php';

// $secret = 'XVQ2UIGO75XRUKJO';



//find out how to feed sql db values to variables $user_number and $user_username
//make sure all variables have no special characters else googleauth cannot decode key
$secret = "\$uidExists['d']";
echo $secret;
$link = \Sonata\GoogleAuthenticator\GoogleQrUrl::generate($user_username, $secret, 'swapamc.com');



?>


<body>
    <form action="" method="post">
        <center>
            <img src="<?= $link; ?>">
            <br>
            <label for="googleautotp">Enter Code Here:</label><br>
            <input type="text" id="googleauthotp" name="googleauthotp" placeholder="Enter Code">
            <br><br>
            <input type="submit" value="submit" name="submit">
        </center>
    </form>

</body>

</html>