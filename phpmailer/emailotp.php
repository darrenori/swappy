<?php
session_start();
echo "original password". $_SESSION["emailotp"];
echo "you are".$_SESSION["username"];

?>
<section class="signup-form">
    <h2>OTP</h2>

    <form action="/swapproj/emailverificationinc" method="POST">
        <br><label for="emailotp"> Input your verification code</label><br>
        <input type="text" id="emailotp" name="emailotp" placeholder="Verification code...">
        <button type="submit" name="submit">Submit</button>
    </form>

</section>
<?php
if (isset($_GET["error"])) {
    if ($_GET["error"] == "badotp") {
        echo "<p>Badotp</p>";
    }
}
?>