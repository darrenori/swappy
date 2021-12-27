<?php

require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/manager/includes/employeefunctions.inc.php';


if (!isset($_GET['user'])) {
    header("location: https://www.swapamc.com/swapproj/employeemanager");
    exit;
} else {
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

if (badInput([$employeeid]) !== false) {
    header("location: https://www.swapamc.com/swapproj/employeemanager?error=badinput");
    exit;
}
$jwtarrayinformation['employeeid'] = $employeeid;
jwtupdate($jwtarrayinformation);


// throws error "Statment Preparation failed" when statement fails
try {
    $query = $conn->prepare("SELECT user_username, working_role,working_number,working_department,working_perhourpay FROM mydb.working_employees 
    INNER JOIN mydb.users
    ON mydb.working_employees.user_id = mydb.users.user_id 
    WHERE  mydb.working_employees.working_id =" . $employeeid . ";");

    if ($query === false) {
        //change filename accordingly
        throw new Exception("Statement Preparation failed(editemployees)"); //    echo "Prepare failed: (" . $conn->errno . ") " . $conn->error . "<br>";
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    //change header location accordingly
    header("location: https://www.swapamc.com/swapproj/employeemanager?error=badstatement");
    exit;
}

// throws error "Statment Execution failed" when statement fails
try {
    $execute = $query->execute();
    if ($execute === false) {
        throw new Exception("Statement Execution failed (editemployees)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    header("location: https://www.swapamc.com/swapproj/employeemanager?error=badstatement"); //echo mysqli_error($query);
    exit;
}


$query->bind_result($username, $role, $number, $department, $perhourpay);

echo "<form method=POST action=https://www.swapamc.com/swapproj/employeemanager/editinc>";

if ($query->fetch()) {

    echo "<h3>Username: " . $username . "</h3>";
    echo "Role:" . "<br>";
    echo "<input type=text name=role value=$role>" . "<br><br>";
    echo "Number:" . "<br>";
    echo "<input type=text name=number value=$number>" . "<br><br>";
    echo "Department:" . "<br>";
    echo "<input type=text name=department value=$department>" . "<br><br>";
    echo "Hourly wage:" . "<br>";
    echo "<input type=text name=pay value=$perhourpay>" . "<br><br>";
}

echo "<input type=submit>";

echo "</form>";
