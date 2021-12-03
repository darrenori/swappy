<!--the navbar ish, we might remove this later -->
<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
</head>
<body>
    <nav>
        <div class="wrapper">
            <ul>
            <li><a href="index.php">Home</a></li>
            <?php
            if (isset($_SESSION["username"])) {
                echo'<li><a href="/swapproj/userprofile">Profile</a></li>';
                echo '<li><a href="/swapproj/logout">Log out</a></li>';
            }else {
                echo'<li><a href="/swapporj/signup">Sign up</a></li>';
                echo '<li><a href="/swapproj/login">Login</a></li>';
            }
            ?>
            <li><a href="verification.php">Verification</a></li>
            <li><a href="about-us.php">About Us</a></li>
            </ul>
        </div>
    </nav>
</body>
</html>
