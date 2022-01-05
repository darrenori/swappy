<?php
if (isset($_GET['type'])) {
    if ($_GET['type'] == 'success') {
        echo "updated succesfully";
        echo "<br>";
    }
}
?>

<section>
    <script type="text/javascript">
        history.pushState(null, null, '<?php echo $_SERVER["REQUEST_URI"]; ?>');
        window.addEventListener('popstate', function(event) {
            window.location.href("http://www.swapamc.com/checkout/viewshippingaddress");
        });
    </script>
</section>
<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';

session_start();

$shipping_id = (int)$_GET['shippingid'];
$_SESSION["shippingid"] = (int)$_GET['shippingid'];
$query = $conn->prepare("SELECT user_shipping_id,user_shipping_name, user_shipping_number, user_shipping_email, user_shipping_address, user_shipping_postalcode, user_shipping_unitnumber FROM mydb.user_shippinginformation WHERE user_shipping_id = $shipping_id;");
$stmt = mysqli_stmt_init($conn);


if (!$query->execute()) {
    header("location: ../swapproj/checkout?error=stmtfailed");
    exit();
}

if ($query->execute()) {
    $query->bind_result($shipping_id, $name, $phone, $email, $address, $zip, $unit);
    if ($query->fetch()) {
        echo "<form method='POST'>";
        echo "Name" . "<br>";
        echo "<input type='text' name='name' value='$name'><br>";

        echo "Phone" . "<br>";
        echo "<input type='text' name='phone' value='$phone'minlength='8' maxlength='8' pattern='\d*'><br>";

        echo "Email" . "<br>";
        echo "<input type='email' name='email' value='$email'><br>";

        echo "Address" . "<br>";
        echo "<input type='text' name='address' value='$address'><br>";

        echo "Zip" . "<br>";
        echo "<input type='text' name='zip' value='$zip'pattern='\d*'><br>";

        echo "Unit" . "<br>";
        echo "<input type='text' name='unit' value='$unit'><br>";

        echo '<input type="submit" value="update" name="submit" formaction="/swapproj/checkout/updatesa">';
        echo '<input type="submit" value="delete" name="submit" formaction="/swapproj/checkout/deletesa">';

        echo "</form>";
    }
    
}
$conn->close();
echo "<a href='https://www.swapamc.com/swapproj/checkout/viewshippingaddress'>Back To View Shipping Address</a>";

//check for error
if (isset($_GET["error"])) {
    if ($_GET["error"] == "shippingaddressemptyinput") {
        echo "<p>Fill in Shipping Address fields!</p>";
    } else if ($_GET["error"] == "invalidemail") {
        echo "<p>Choose a proper email!</p>";
        exit();
    } else if ($_GET["error"] == "invalidpostalcode") {
        echo "<p>Invalid Postal Code</p>";
        exit();
    } else if ($_GET["error"] == "stmtfailed") {
        echo "<p>Something went wrong, try again!</p>";
    } else if ($_GET["error"] == "none") {
        echo "<p>Successfully Edit Shipping Address</p>";
        header("location: ../swapproj/checkout/editshippingaddress?=success");
    } else if ($_GET["type"] == "success") {
        echo "Records were updated successfully.";
        header("location: https://www.swapamc.com/swapproj/checkout/editshippingaddress?type=success");
    }
}
//     }
// }
?>