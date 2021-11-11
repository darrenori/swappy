<?php

include_once 'header.php';
?>

<section class="signup-form">
    <h2>Sign Up</h2>
    <form action="includes/signup.inc.php" method="POST">
        <label for="name">Full Name:</label><br>
        <input type="text" id="name" name="name" placeholder="Full name...">
        <br><label for="email">Email Address:</label><br>
        <input type="text" id="email" name="email" placeholder="Email...">
        <br><label for="uid">Username:</label><br>
        <input type="text" id="uid" name="uid" placeholder="Username...">
        <br><label for="pwd">Password:</label><br>
        <input type="password" id="pwd" name="pwd" placeholder="Password...">
        <br><label for="email">Repeat Password:</label><br>
        <input type="password" id="pwdrepeat" name="pwdrepeat" placeholder="Repeat Password...">
        <button type="submit" name="submit">Sign Up</button>
    </form>

<?php
if (isset($_GET["error"])) {
    if ($_GET["error"] == "emptyinput"){
        echo "<p>Fill in all fields!</p>";
    }
    else if ($_GET["error"] == "invaliduid"){
        echo "<p>Choose a proper username!</p>";
    }
    else if ($_GET["error"] == "invalidemail"){
        echo "<p>Choose a proper email!</p>";
    }
    else if ($_GET["error"] == "passwordsdontmatch"){
        echo "<p>Choose a proper username!</p>";
    }
    else if ($_GET["error"] == "stmtfailed"){
        echo "<p>Something went wrong, try again!</p>";
    }
    else if ($_GET["error"] == "usernametaken"){
        echo "<p>Username already taken!</p>";
    }
    else if ($_GET["error"] == "none"){
        echo "<p>You have signed up!</p>";
    }
}

?>
</section>
