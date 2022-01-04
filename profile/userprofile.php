<?php
require("includes/user_auth.php");
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';

$userid = $jwtarrayinformation['userid'];
if (isset($_GET)) {
        //renders any scripts into html form of special char e.g., & = &amp
    foreach ($_GET as $key => $val) {
        if (gettype($key) == "string" && $key !== "0") {
            $goodkey = htmlentities($key);
            $_GET[$goodkey] = $_GET[$key];
            unset($_GET[$key]);
        }
        //only checks if of string type (integers will not run through htmlspecialchars)
        if (gettype($val) == "string") {
            $goodval = htmlentities($val);
            $_GET[$goodkey] = $goodval;
        }
        if (empty($val)) {
            $_GET[$goodkey] = "0";
        }
    }

    // $getuser = htmlentities($_GET["user"]);
    // $employeeid = $getuser;
}

try {
    $query = $conn->prepare("SELECT user_username, user_fname,user_lname,user_role,username_email,
user_number,date_of_signup
FROM mydb.users WHERE user_id = $userid;");
    if ($query === false) {
        //change filename accordingly
        throw new Exception("Statement Preparation failed(userprofile)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    //change header location accordingly
    header("location: https://www.swapamc.com/swapproj/campus?page=userprofile&error=badstatement");
    exit;
}
// throws error "Statment Execution failed" when statement fails
try {
    $execute = $query->execute();
    if ($execute === false) {
        throw new Exception("Statement Execution failed (userprofile)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    header("location: https://www.swapamc.com/swapproj/campus?page=userprofile&error=badstatement"); //    echo mysqli_error($query);

    exit;
}



$query->bind_result($username, $fname, $lname, $role, $email, $number, $dateofsignup);


if ($query->fetch()) {
    echo "<form method=POST enctype='multipart/form-data'>";
    echo "Username" . "<br>";
    echo "<input type='text' name='username' value='$username'><br>";

    echo "<p>Image:</p>";
    echo "<input type='file' name='image'>";
    echo "<br><br>";


    echo "Fname" . "<br>";
    echo "<input type='text' name='fname' value='$fname'><br>";

    echo "Lname" . "<br>";
    echo "<input type='text' name='lname' value='$lname'><br>";



    echo "Email" . "<br>";
    echo "<input type='email' name='email' value='$email'><br>";

    echo "Number" . "<br>";
    echo "<input type='text' name='number' value='$number'><br><br>";

    echo "Date: " . $dateofsignup . "<br>";

    if ($role == 0) {
        echo "Type: Normal User <br><br>";
    } elseif ($role == 6) {
        echo "Type: Server Admin <br><br>";
    } elseif ($role == 2) {
        echo "Type: Employee Manager <br><br>";
    }

    echo '<input type="submit" value="update" name="submit" formaction="/swapproj/updateprofile">';
    echo '<input type="submit" value="delete" name="submit" formaction="/swapproj/deleteprofile">';

    echo "</form>";

    #checked by debugger, deemed unharmful
    if (isset($_GET['type'])) {
        if ($_GET['type'] === 'success') {
            echo "updated succesfully";
        }
    }
}else {
    header("location: https://www.swapamc.com/swapproj/campus?page=userprofile&error=badstatement"); //    echo mysqli_error($query);
    exit;
}






?>

<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
    setInterval(function() {
        check_user();
    }, 2000);

    function check_user() {
        jQuery.ajax({
            url: 'https://www.swapamc.com/swapproj/check',
            type: 'post',
            data: 'type=ajax',
            success: function(result) {
                console.log(result);
                let text = result.includes("logout");
                if (text == true) {
                    window.location.href = "https://www.swapamc.com/swapproj/logout";
                }
            }

        });
    }
</script>