
<?php
session_start();
if (!isset($_SESSION['loginstate'])) {
    header("location: ../swapproj/login");
    exit();
} elseif ($_SESSION['loginstate'] === "B") {
    header("location: ../swapproj/googleauthentication");
    exit();
} elseif ($_SESSION['loginstate'] === "OK") {
    header("location: ../swapproj/campus");
    exit();
} elseif (!$_SESSION['loginstate'] === "A") {
    header("location: ../swapproj/logout");
    exit();
}


echo "original password". $_SESSION["emailotp"];
echo "you are".$_SESSION["username"];
echo "<br>";
date_default_timezone_set('Asia/Singapore');
echo $date = date('m/d/Y h:i:s a', time());
?>



<script type="text/javascript">  function preventBack() {window.history.forward();}  setTimeout("preventBack()", 0);  window.onunload = function () {null};</script>
<section class="signup-form">

    <h2>Email OTP</h2>

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