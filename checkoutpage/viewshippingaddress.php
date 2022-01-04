
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/functions.inc.php';

$jwtarray = jwtdecrypt();
if(isset($jwtarray)&&$jwtarray==true){
    
    $jwtarrayinformation = $jwtarray['array'];

}




$userid = $jwtarrayinformation['userid'];
$query = $conn->prepare("SELECT user_shipping_id,user_shipping_name, user_shipping_number, user_shipping_email, user_shipping_address, user_shipping_postalcode, user_shipping_unitnumber FROM user_shippinginformation WHERE user_shipping_userid = $userid");

$stmt = mysqli_stmt_init($conn);


if (!$query->execute()) {
    header("location: ../swapproj/checkout?error=stmtfailed");
    exit();
}
if ($query->execute()) {

    $query->bind_result($shipping_id, $name, $number, $email, $address, $zip, $unit);

    $result = $query->get_result();
    echo '<a href="https://www.swapamc.com/swapproj/checkout/addshippingaddress">Add Shipping Address</a><br>';

// print shipping address (&nbsp is just spacing)
    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_array($result)) {
            echo "<form>";
            echo "<br><br>";
            echo "&nbsp" . "Name:" . "&nbsp" . $row['user_shipping_name'];
            echo "&nbsp" . "Number:" . "&nbsp" . $row["user_shipping_number"];
            echo "&nbsp" . "Email:" . "&nbsp" . $row["user_shipping_email"];
            echo "&nbsp" . "Address:" . "&nbsp" . $row["user_shipping_address"];
            echo "&nbsp" . "Zip:" . "&nbsp" . $row["user_shipping_postalcode"];
            echo "&nbsp" . "Unit:" . "&nbsp" . $row["user_shipping_unitnumber"];
            echo "&nbsp&nbsp&nbsp&nbsp";
            echo "<br>";
            echo "<a href='https://www.swapamc.com/swapproj/checkout/editshippingaddress?shippingid=" . $row['user_shipping_id'] . "'>Edit</a>";
            echo "<br>";
            echo "<a href='https://www.swapamc.com/swapproj/checkout/defaultsa?shippingid=" . $row['user_shipping_id'] . "'>Set Default</a>";
            echo "<br><br>";
            echo "</form>";
        }
    } else {
        echo "No shipping address";
    }
}
$conn->close();
?>
<section>
    <a href='https://www.swapamc.com/swapproj/checkout'>Back To CheckoutPage</a>
    <script type="text/javascript">
        history.pushState(null, document.title, location.href);
        window.addEventListener('popstate', function(event) {
            const leavePage = confirm("Please click back to go back");
            if (leavePage) {
                history.pushState(null, document.title, location.href);
            } else {
                history.pushState(null, document.title, location.href);
            }
        });

    </script>
</section>