<?php

// include_once 'header.php';



?>

<section class="signup-form">
    <h2>Login</h2>
    
    <form action="/swapproj/logininc" method="POST">
        <br><label for="uid"> Email or Username:</label><br>
        <input type="text" id="uid" name="uid" placeholder="Email/Username...">
        <br><label for="pwd">Password:</label><br>
        <input type="password" id="pwd" name="pwd" placeholder="Password...">
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