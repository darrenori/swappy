<?php

include_once 'header.php';
class Signup {
    
}


//  this file is for the second page of signing up

?>

<section class="signup-form">
    <h2>Sign Up</h2>
    <form action="/swapproj/incsignup" method="POST">
    <label for="firstname">First Name:</label><br>
        <input type="text" id="firstname" name="firstname" placeholder="Full name...">
        <label for="lastname">Last Name:</label><br>
        <input type="text" id="lastname" name="lastname" placeholder="Last name...">
        <br><label for="email">Email Address:</label><br>
        <input type="text" id="email" name="email" placeholder="Email...">
        <br><label for="uid">Username:</label><br>
        <input type="text" id="uid" name="uid" placeholder="Username...">
        <br><label for="pwd">Password:</label><br>
        <input type="password" id="pwd" name="pwd" placeholder="Password...">
        <br><label for="email">Repeat Password:</label><br>
        <input type="password" id="pwdrepeat" name="pwdrepeat" placeholder="Repeat Password...">
        <label for="primaryschool">Primary School:</label><br>
        <input type="text" id="primaryschool" name="primaryschool" placeholder="Primary school...">
        <label for="favouritefood">Favourite Food:</label><br>
        <input type="text" id="favouritefood" name="favouritefood" placeholder="Favourite food...">
        <button type="submit" name="submit">Sign Up</button>
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
        echo "<p>Username already taken!</p>";
    }
    else if ($error == "none"){
        echo "<p>You have signed up!</p>";
    }
}

?>
</section>
