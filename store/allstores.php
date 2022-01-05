<?php



require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';





try {
$query = $conn->prepare("SELECT store_id,store_name FROM mydb.store;");
    if ($query === false) {
        //change filename accordingly
        throw new Exception("Statement Preparation failed(allstores)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    //change header location accordingly
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
    echo 'Message: ' . $e->getMessage();
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







?>

<html>
<h1>ALLSTORES</h1>
<a href='https://www.swapamc.com/swapproj/campus'><input type=button name=employeemanager value='Home'></a>

</html>