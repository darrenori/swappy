<?php

include_once 'header.php';
class Signup {
    
}

?>

<section class="signup-form">
    <h2>Sign Up</h2>
    <form action="/swapproj/incsignup" method="POST">
    <label for="firstname">First Name:</label><br>
        <input type="text" id="firstname" name="firstname" placeholder="Full name...">
        <br><label for="lastname">Last Name:</label><br>
        <input type="text" id="lastname" name="lastname" placeholder="Last name...">
        <br><label for="uid">Username:</label><br>
        <input type="text" id="uid" name="uid" placeholder="Username...">
        <br><label for="phonenumber">Phone Number:</label><br>
        <input type="text" id="phonenumber" name="phonenumber" placeholder="Phone...">
        <br><label for="email">Email Address:</label><br>
        <input type="email" id="email" name="email" placeholder="Email...">
        <br><label for="pwd">Password:</label><br>
        <input type="password" id="pwd" name="pwd" placeholder="Password...">
        <br><label for="pwdrepeat">Repeat Password:</label><br>
        <input type="password" id="pwdrepeat" name="pwdrepeat" placeholder="Repeat Password...">
        <br><label for="primaryschool">Primary School:</label><br>
        <input type="text" id="primaryschool" name="primaryschool" placeholder="Primary school...">
        <br><label for="favouritefood">Favourite Food:</label><br>
        <input type="text" id="favouritefood" name="favouritefood" placeholder="Favourite food...">
        <br><br><button type="submit" name="submit">Sign Up</button>
    </form>

<?php
if (isset($_GET["error"])) {
    $error=htmlentities($_GET["error"]);

    if ($error == "emptyinput"){
        echo "<p>Fill in all fields!</p>";
    }
    else if ($error == "invaliduid"){
        echo "<p>Choose a proper username!</p>";
    }
    else if ($error == "invalidemail"){
        echo "<p>Choose a proper email!</p>";
    }
    else if ($error == "passwordsdontmatch"){
        echo "<p>Password dont match!</p>";
    }
    else if ($error == "stmtfailed"){
        echo "<p>Something went wrong, try again!</p>";
    }
    else if ($error == "usernametaken"){
        echo "<p>Username or Email already taken!</p>";
    }
    else if ($error == "badinput"){
        echo "<p>Please enter valid characters</p>";
    }
    else if ($error == "none"){
        echo "<p>You have signed up!</p>";
        header("location: https://www.swapamc.com/swapproj/googleauth/");
    }
}

?>
</section>