<?php
session_start();
$userid = $_SESSION["userid"];
$query = $conn->prepare("SELECT user_creditcardinfo_id,user_creditcardinfo_nameoncard, user_creditcardinfo_cardnumber,user_creditcardinfo_expirymonth, user_creditcardinfo_expiryyear FROM user_creditcardinfo WHERE user_creditcardinfo_userid = $userid");
$stmt = mysqli_stmt_init($conn);


if (!$query->execute()) {
    header("location: ../swapproj/checkout?error=stmtfailed");
    exit();
}
if ($query->execute()) {

    // $query->bind_result($shipping_id,$name,$number,$email,$address,$zip,$unit);

    $result = $query->get_result();
    echo '<a href="/swapproj/checkout/addcreditcard">Add Credit Card</a><br>';

    if ($result->num_rows > 0) {
        while ($row = mysqli_fetch_array($result)) {
            // $array[] = $row;
            // array_push($shippingid,$shipping_id);

            echo "<form method='POST'>";
            // echo "&nbsp". "ShippingId:". "&nbsp" . $row['user_shipping_id'] ;
            echo "&nbsp" . "Name:" . "&nbsp" . $row['user_shipping_name'];
            echo "&nbsp" . "Number:" . "&nbsp" . $row["user_shipping_number"];
            echo "&nbsp" . "Email:" . "&nbsp" . $row["user_shipping_email"];
            echo "&nbsp" . "Address:" . "&nbsp" . $row["user_shipping_address"];
            echo "&nbsp" . "Zip:" . "&nbsp" . $row["user_shipping_postalcode"];
            echo "&nbsp" . "Unit:" . "&nbsp" . $row["user_shipping_unitnumber"];

            echo "&nbsp&nbsp&nbsp&nbsp";
            echo "<input type='submit' value='edit' name='edit'  formaction='/swapproj/checkout/editshippingaddress?shippingid=" . $row['user_shipping_id'] . "'>";
            echo  "<input type='checkbox' value='default 'name='default' formaction='' >";
            echo "<br></form>";
        }
    } else {
        echo "No shipping address";
    }
}
$conn->close();
