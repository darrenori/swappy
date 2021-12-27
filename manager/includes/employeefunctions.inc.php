<?php

## Originally employee.inc


function notEmpty($array)
{
    for ($i = 0; $i < sizeof($array); $i++) {
        if ($array[$i] == "" || $array[$i] == null) {
            return false;
        }
    }

    return true;
}


function badEmployeeInput($array)
{
    //i at the end represents case-insensitive
    //first condition: length cannot exceed 30 characters or be less than 1
    //second: cannot begin with _ or .
    //third: cannot contain more than 2 consecutive _s or .s
    //fourth: can contain any number of alphabet or number
    //fifth: cannot end with _ or .
    $pattern = "/^(?=.{1,30}$)(?![_.])(?!.*[_.]{2})[a-zA-Z0-9._\s]+(?<![_.])$/i";

    for ($i = 0; $i < sizeof($array); $i++) {
        $input = $array[$i];
        $a = (preg_match($pattern, $input));

        //$a will equal to 0 if the content is not safe(contains only characters inside of $pattern)
        if ($a === 0) {
            //false will indicate that the text is not safe
            return true;
        }
    }

    // This code will run if the content is not safe or if t
    return false;

    //0 is valid input

}

//called in alltasks.php
function checkIfEmployeeIdExists($conn)
{


    if (isset($_GET["user"])) {

        //converts id to integer (if id is not integer, id will return empty);
        $id = (int)$_GET['user'];
        if (empty($id)) {
            header("location: https://www.swapamc.com/swapproj/taskmanager?error=invalidid");
            exit;
        }

        // throws error "Statment Preparation failed" when statement fails
        try {
            $query = $conn->prepare("SELECT working_id FROM mydb.working_employees WHERE working_employees.working_id = " . $id . ";");

            if ($query === false) {
                //change filename accordingly
                throw new Exception("Statement Preparation failed(employee.inc)");
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
                throw new Exception("Statement Execution failed (employee.inc)");
            }
        } catch (Exception $e) {
            echo 'Message: ' . $e->getMessage();
            header("location: https://www.swapamc.com/swapproj/employeemanager?error=badstatement"); // echo "Prepare failed: (". $conn->errno.") ".$conn->error."<br>";
            exit;
        }

            $result = $query->get_result();
            $array = $result->fetch_all(MYSQLI_ASSOC);

            $totalrows = sizeof($array);

            if ($totalrows == 0) {
                header("location: https://www.swapamc.com/swapproj/taskmanager?error=invalidid");
                exit;
            }
    }
}
