<?php

##ZEPH
// DONE CHECKING no buffer to overflow, only whitelisted variables will ever be used, escaping and encoding done. 
// echo statements removed no session used




require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
$filename = basename(__FILE__, '.php'); // filename variable is now set as allstores for example
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';

//mysqlescapestring
$_GET = escapeString($conn, $_GET);


try {
    $query = $conn->prepare("SELECT store_id,store_name FROM mydb.store;");
    if ($query === false) {
        //change filename accordingly
        throw new Exception("Statement Preparation failed(allstores)");
    }
} catch (Exception $e) {
    //change header location accordingly
    error_log("TPAMC:" . $filename . ":1:" . $ipadd . ":1 ERROR preparing statement (SELECT)", 0);
    header("location: https://www.swapamc.com/swapproj/campus?page=stores?error=badstatement");
    exit;
}
// throws error "Statment Execution failed" when statement fails
try {
    $execute = $query->execute();
    if ($execute === false) {
        throw new Exception("Statement Execution failed (allstores)");
    }
} catch (Exception $e) {
    error_log("TPAMC:" . $filename . ":1:" . $ipadd . ":1 ERROR executing statement (SELECT)", 0);
    header("location: https://www.swapamc.com/swapproj/campus?page=stores?error=badstatement"); //    echo mysqli_error($query);

    exit;
}


$query->bind_result($id, $name);



while ($query->fetch()) {
    $allstoreslist[$id] = $name;
}

//currently unable to stack sorts
if (!empty($_GET)) {
    if (isset($_GET['sortname'])) {
        if ($_GET['sortname'] === "descending" || $_GET['sortname'] === "ascending") {
            $sortNamedirection = htmlentities($_GET['sortname']);
            if ($sortNamedirection === "descending") {
                $namevalue = "none";
                rsort($allstoreslist);
            } else if ($sortNamedirection === "ascending") {
                $namevalue = "descending";
                sort($allstoreslist);
            } else {
                $namevalue = "ascending";
            }
        } else {
            $namevalue = "ascending";
        }
    } else {
        //default is ascending
        $namevalue = "ascending";
    }
} else {
    $namevalue = "ascending";
}

###zeph
//sort only box
echo '<form action="/swapproj/allstores" method="get">';
echo '<button type="submit" name="sortname" value="' . $namevalue . '">AZ</button><br>';
echo '</form>';




foreach ($allstoreslist as $key => $val) {
    echo "<a href='https://www.swapamc.com/swapproj/allstores/store?id=$key'>$val</a>";

    echo "<br>";
}
echo "";









function checkId($id)
{
    //if it contains only letter or numbers return true)
    if (preg_match("/^[a-zA-Z0-9]*$/", $id)) {
        $result = true;
        //if its too long return false
        if (strlen($id) > 12) { //is the length too long?
            $result = false;
        }
    } else {

        $result = false;
    }
    return $result;
}




?>

<html>
<h1>ALLSTORES</h1>
<a href='https://www.swapamc.com/swapproj/campus'><input type=button name=employeemanager value='Home'></a>

</html>