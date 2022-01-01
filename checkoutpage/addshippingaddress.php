<html>
<script type="text/javascript">

history.pushState(null, document.title, location.href);
window.addEventListener('popstate', function (event)
{
    const leavePage = confirm("Please click back to go back");
    if (leavePage) {
        history.pushState(null, document.title, location.href);
    } else {
        history.pushState(null, document.title, location.href);
    }  
});
</script>

<form action="/swapproj/checkout/addshippingaddressinc" method="POST">
    <h3>Shipping Address</h3>
    <br><label> Name</label>

    <br><input type="text" id="name" name="name" placeholder="John ">
    <br><label for="email"></i> Email</label>
    <br><input type="email" id="email" name="email" placeholder="john@example.com">
    <br><label for="phone"></i> Phone Number</label>
    <br><input type="text" pattern="\d*" minlength="8" maxlength="8" id="phone" name="phone" placeholder="11112222">
    <br><label for="adr"> Address</label>
    <br><input type="text" id="address" name="address" placeholder="542 W. 15th Street">
    <br><label for="unit"> Unit Number</label>
    <br><input type="text" id="unit" name="unit" placeholder="Unit Number">
    <br><label for="zip">Postal Code</label>
    <br><input type="text" pattern="\d*" minlength="6" maxlength="6" id="zip" name="zip" placeholder="Zip Code">
    <input type="submit" name="addAdr" value="Add" class="btn">
</form>
<a href='https://www.swapamc.com/swapproj/checkout/viewshippingaddress'>Back To view Shipping</a>


</html>
<?php
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
        echo "<p>Successfully Add Shipping Address</p>";
        header("location: https://www.swapamc.com/swapproj/checkout/addshippingaddress?=success");
    }
}
?>