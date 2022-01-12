<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/user_auth.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/auth/pages.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';

require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/images/showimage.php';


echo "<br><br><a href='https://www.swapamc.com/swapproj/employeemanager'><input type=button name=employeemanager value=Employee_Manager></a>";
echo "<a href='https://www.swapamc.com/swapproj/allproducts'><input type=button name=allproducts value=Storefront></a>";
echo "<a href='https://www.swapamc.com/swapproj/allproducts/product/viewcart'><input type=button name=viewcart value='View Cart'></a>";
echo "<a href='https://www.swapamc.com/swapproj/allstores'><input type=button name=allstores value='All Stores'></a>";
echo "<a href='https://www.swapamc.com/swapproj/employeemanager'><input type=button name=employeemanager value='Tasks need to be accessed thru employee manager'></a>";
echo "<a href='https://www.swapamc.com/swapproj/productmanager'><input type=button name=employeemanager value='Tasks need to be accessed thru product manager'></a>";
echo "<a href='https://www.swapamc.com/swapproj/addnotification'><input type=button name=employeemanager value='Notification'></a>";
echo "<a href='https://www.swapamc.com/swapproj/productmanager'><input type=button name=employeemanager value='Product Manager'></a>";

###zeph
//search box
echo '<form action="/swapproj/searchinc" method="post">';
echo '<input type="text" name ="searchitem" placeholder="Router...">';
echo '<input type="submit" value="Submit">';
echo '</form>';


echo "<h3> PHP List All JWT Token Variables</h3>";
foreach ($jwtarray as $key => $val)
    if (gettype($val) != "array") {
        echo $key . " " . $val . "<br/>";
    }
foreach ($jwtarrayinformation as $key => $val)
    if (gettype($val) != "array") {
        echo $key . " " . $val . "<br/>";
    }




echo "<h3> You are logged in! :D</h3>";

echo "<h4><a href='https://www.swapamc.com/swapproj/viewnotifications'>Notification</a></h4>";
echo "<h4><a href='https://www.swapamc.com/swapproj/viewfavorites'>Favorites</a></h4>";
echo "<h4><a href='https://www.swapamc.com/swapproj/viewpurchases'>Purchases</a></h4>";










$userid = $jwtarrayinformation['userid'];



//display their info
try {
    $query = $conn->prepare("SELECT user_username, user_fname,user_lname,user_role,username_email,
user_number,date_of_signup, user_profilepicture
FROM mydb.users WHERE user_id = $userid;");
    if ($query === false) {
        //change filename accordingly
        throw new Exception("Statement Preparation failed(userprofile)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    //change header location accordingly
    
}
// throws error "Statment Execution failed" when statement fails
try {
    $execute = $query->execute();
    if ($execute === false) {
        throw new Exception("Statement Execution failed (userprofile)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    
}
$query->bind_result($username, $fname, $lname, $role, $email, $number, $dateofsignup,$profilepic);


if ($query->fetch()) {
    
    echo "<h5>Username</h5>" . "<br>";
    echo $username . "<br>";

    


    $image = new Image();
    if($profilepic!=null){
       
        $src = $image->show($profilepic);

        echo "<h5>Picture: </h5><br><br><br>";
        
        echo '<img width="10%"  alt="profilepic" src="'.$src.'" />';

        

    }
    



    echo "<h5>Fname</h5>" . "<br>";
    echo $fname . "<br>";
   

    echo "<h5>Lname</h5>" . "<br>";
    echo $lname . "<br>";



    echo "<h5>Email</h5>" . "<br>";
    echo $email . "<br>";

    echo "<h5>Number</h5>";
    echo $number . "<br>";

    echo "Date of signup: " . $dateofsignup . "<br>";

    if ($role == 0) {
        echo "Type: Normal User <br><br>";
    } elseif ($role == 6) {
        echo "Type: Server Admin <br><br>";
    } elseif ($role == 2) {
        echo "Type: Employee Manager <br><br>";
    }




    #checked by debugger, deemed unharmful
    if (isset($_GET['type'])) {
        if ($_GET['type'] === 'success') {
            echo "updated succesfully";
        }
    }
}else {
    echo 'something went wrong';
    // exit;
}













?>
<html>

<body><br><br>
    Congratulations for logging in <b><?php echo $jwtarrayinformation['username'];
                                        ?></b>

    <form method="POST">
        <input type="submit" value="logout" name="submit" formaction="/swapproj/logout">
        <input type="submit" value="editprofile" name="submit" formaction="/swapproj/userprofile">
    </form>

</body>

</html>