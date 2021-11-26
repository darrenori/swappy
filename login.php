<?php

// include_once 'header.php';



?>

<section class="signup-form">
    <h2>Login</h2>
    
    <form action="/swapproj/logininc" method="POST">
        <br><label for="uid"> Email or Username:</label><br>
        <input type="text" id="uid" name="uid" placeholder="Email/Username..." value="<?php if(isset($_COOKIE["user_login"])) {echo $_COOKIE["user_login"]; } ?>" >
        <br><label for="pwd">Password:</label><br>
        <input type="password" id="pwd" name="pwd" placeholder="Password..." value="<?php if(isset($_COOKIE["user_pwd"])) {echo $_COOKIE["user_pwd"]; } ?>">
        <br><input type ="checkbox" name="remember" label for="remember-me" <?php if(isset($_COOKIE["user_login"])) { ?> checked <?php } ?>> Remember me
        <button type="submit" name="submit">Login</button>
    </form>

    <?php #are you sure you want to use get..?
    if (isset($_GET["error"])) {
        if ($_GET["error"] == "emptyinput") {
            echo "<p>Fill in all fields!</p>";
        } else if ($_GET["error"] == "wronglogin") {
            echo "<p>Incorrect login information!</p>";
        }
    }

    ?>

</section>