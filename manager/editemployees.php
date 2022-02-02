<?php

require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/manager/includes/employeefunctions.inc.php';
$csrf = generateCSRF();

$signedinrole = $jwtarrayinformation['role'];
$signedinuser = $jwtarrayinformation['username'];
$imagesarraypath;


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

    $getuser = htmlentities($_GET["user"]);
    $employeeid = $getuser;
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
?>
<div class=parentcontainer5>
    <div class='sidebar'>

        <div class='rowone'>
            <svg id='logo' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' width='307.688' height='105.376' viewBox='0 0 307.688 105.376'>
                <defs>
                    <linearGradient id='linear-gradient' x1='1.363' y1='-0.243' x2='0.149' y2='0.921' gradientUnits='objectBoundingBox'>
                        <stop offset='0' stop-color='#e26565' />
                        <stop offset='1' stop-color='#8d1d25' />
                    </linearGradient>
                </defs>
                <g id='amclogo' transform='translate(-107 -97.817)'>
                    <path id='Exclusion_2' data-name='Exclusion 2' d='M73.306,105.376H68.724V91.632h4.582v13.744Zm-9.163,0H59.561V91.632h4.582v13.744Zm-9.164,0H50.4V91.632h4.581v13.744Zm-9.163,0H41.234V91.632h4.581v13.744Zm-9.163,0H32.071V91.632h4.581v13.744ZM77.887,87.05h-50.4a9.173,9.173,0,0,1-9.163-9.163v-50.4a9.173,9.173,0,0,1,9.163-9.163h50.4a9.173,9.173,0,0,1,9.163,9.163v50.4A9.173,9.173,0,0,1,77.887,87.05ZM52.355,76.883A1.414,1.414,0,0,1,52.9,77c.644.268.811.76,1.062,1.5.044.131.091.27.144.417h1.924c.051-.143.1-.277.14-.406.253-.75.42-1.245,1.069-1.515a1.428,1.428,0,0,1,.546-.115,3,3,0,0,1,1.271.433c.122.061.251.125.389.19l1.364-1.361c-.065-.138-.128-.264-.189-.387-.352-.709-.584-1.178-.315-1.824s.767-.816,1.52-1.07c.126-.042.259-.087.4-.137V70.8c-.145-.052-.281-.1-.411-.142-.747-.252-1.24-.418-1.508-1.063s-.036-1.119.319-1.832c.059-.119.121-.244.185-.378l-1.364-1.362c-.134.064-.259.127-.378.186a3,3,0,0,1-1.279.436,1.421,1.421,0,0,1-.551-.117c-.646-.268-.812-.759-1.062-1.5-.044-.131-.091-.27-.144-.418H54.109c-.051.143-.1.278-.14.407-.253.748-.419,1.243-1.066,1.512a1.413,1.413,0,0,1-.551.117,3,3,0,0,1-1.277-.436c-.12-.06-.246-.123-.38-.187l-1.364,1.362c.065.136.127.262.188.384.353.71.586,1.178.318,1.826s-.761.812-1.508,1.063c-.13.044-.268.09-.413.142v1.927c.14.05.274.095.4.137.753.253,1.251.42,1.521,1.067s.036,1.121-.319,1.832c-.06.12-.123.246-.187.379L50.695,77.5c.135-.064.259-.126.38-.186A3.007,3.007,0,0,1,52.355,76.883Zm15.79-7.83a1.885,1.885,0,0,1,.73.154c.863.357,1.085,1.016,1.421,2.015.058.171.119.353.187.544h2.566c.067-.187.126-.364.183-.534.338-1,.56-1.667,1.429-2.028a1.894,1.894,0,0,1,.729-.154,3.983,3.983,0,0,1,1.689.575c.168.084.338.168.523.256l1.816-1.816c-.087-.184-.171-.354-.253-.518-.468-.944-.776-1.568-.419-2.427s1.026-1.089,2.033-1.427c.168-.056.342-.115.526-.18V60.944c-.191-.068-.369-.128-.542-.186-1-.337-1.659-.559-2.017-1.419s-.049-1.487.42-2.431c.08-.162.165-.333.252-.516L77.6,54.574c-.177.085-.342.167-.5.246a4.024,4.024,0,0,1-1.713.583,1.894,1.894,0,0,1-.731-.154c-.862-.357-1.084-1.017-1.42-2.016-.058-.171-.118-.352-.186-.543H70.482c-.068.191-.128.37-.186.542-.336,1-.558,1.658-1.421,2.017a1.885,1.885,0,0,1-.733.155,3.994,3.994,0,0,1-1.7-.58c-.16-.08-.33-.165-.512-.251l-1.818,1.818c.087.182.17.351.251.514.47.946.78,1.571.422,2.433s-1.018,1.084-2.016,1.419c-.173.058-.352.118-.543.186v2.569c.186.066.36.124.529.181,1.006.337,1.67.56,2.03,1.423s.049,1.491-.422,2.436c-.081.163-.165.331-.251.513L65.93,69.88c.181-.086.347-.169.508-.249A4.019,4.019,0,0,1,68.144,69.052Zm-31.5-7.825a4,4,0,0,1,1.555.329c1.836.76,2.308,2.164,3.021,4.289.123.368.25.746.394,1.149h5.458c.143-.4.27-.778.392-1.142.715-2.127,1.187-3.531,3.035-4.3a3.992,3.992,0,0,1,1.549-.329,8.479,8.479,0,0,1,3.591,1.222c.353.175.715.355,1.108.542L60.6,59.126c-.186-.391-.365-.753-.539-1.1-.994-2-1.652-3.325-.894-5.157s2.166-2.3,4.293-3.017c.366-.123.745-.25,1.148-.394V44c-.407-.145-.788-.273-1.156-.4-2.121-.714-3.522-1.186-4.281-3.016s-.1-3.164.9-5.176c.171-.343.347-.7.53-1.082l-3.858-3.861c-.386.184-.744.361-1.089.533a8.488,8.488,0,0,1-3.613,1.227,4.016,4.016,0,0,1-1.559-.329c-1.833-.76-2.3-2.162-3.018-4.285-.123-.367-.251-.746-.395-1.151H41.611c-.144.4-.271.783-.394,1.15-.713,2.124-1.184,3.527-3.018,4.286a4.033,4.033,0,0,1-1.561.331A8.491,8.491,0,0,1,33.035,31c-.349-.174-.709-.352-1.1-.537l-3.856,3.861c.185.389.363.748.535,1.095,1,2.006,1.655,3.331.9,5.164s-2.163,2.3-4.284,3.017c-.368.124-.749.252-1.155.4v5.458c.406.145.787.273,1.156.4,2.122.714,3.522,1.186,4.28,3.016s.1,3.164-.893,5.164c-.173.348-.352.707-.537,1.094l3.857,3.861c.391-.185.752-.364,1.1-.538A8.484,8.484,0,0,1,36.642,61.227Zm18.43,12.922a2.384,2.384,0,1,1,2.385-2.384A2.387,2.387,0,0,1,55.073,74.149Zm50.3-.843H91.632V68.724h13.744v4.582Zm-91.63,0H0V68.724H13.745v4.582Zm58.02-7.9a3.179,3.179,0,1,1,3.179-3.179A3.182,3.182,0,0,1,71.765,65.405Zm33.611-1.262H91.632V59.561h13.744v4.582Zm-91.63,0H0V59.561H13.745v4.582Zm91.63-9.164H91.632V50.4h13.744v4.581Zm-91.63,0H0V50.4H13.745v4.581Zm30.6-1.494A6.757,6.757,0,1,1,51.1,46.727,6.764,6.764,0,0,1,44.342,53.484Zm61.034-7.669H91.632V41.234h13.744v4.581Zm-91.63,0H0V41.234H13.745v4.581Zm91.63-9.163H91.632V32.071h13.744v4.581Zm-91.63,0H0V32.071H13.745v4.581ZM73.306,13.745H68.724V0h4.582V13.745Zm-9.163,0H59.561V0h4.582V13.745Zm-9.164,0H50.4V0h4.581V13.745Zm-9.163,0H41.234V0h4.581V13.745Zm-9.163,0H32.071V0h4.581V13.745Z' transform='translate(107 97.817)' fill='url(#linear-gradient)' />
                    <text id='TPAMC' transform='translate(237.688 126.588)' fill='#fff' font-size='40' font-family='Poppins-Regular, Poppins'>
                        <tspan x='0' y='42'>TP</tspan>
                        <tspan y='42' fill='#8d1d25' font-family='Poppins-Bold, Poppins' font-weight='700'>AMC</tspan>
                    </text>
                </g>
            </svg>

        </div>


        <div class='rowtwo'>

            <div class="rowtwowrapper">
                <p id='profiletext'>PROFILE</p>

                <div class='profileinfo'>



                    <div class='profilepic'>

                    </div>

                    <div class='text'>

                        <?php
                        echo "<p id='username'>$signedinuser</p>";

                        if ($signedinrole == 6) {
                            echo "<p id='role'>server admin</p>";
                        } elseif ($signedinrole == 3) {
                            echo "<p id='role'>Store admin</p>";
                        }

                        ?>

                    </div>
                </div>

            </div>

        </div>


        <div class='rowthree'>
            <p id='manage'>MANAGE</p>


            <div class='managecontainer' style='cursor:pointer;' onclick="location.href = 'https://www.swapamc.com/swapproj/productmanager';">
                <div class='manageproducts'>

                    <div class='textmanagecontainer'>
                        <i class="fas fa-boxes"></i>

                        <span>Manage Products</span>

                    </div>
                </div>
            </div>


            <div class='employeecontainer' style='cursor:pointer;' onclick="location.href = 'https://www.swapamc.com/swapproj/employeemanager';">
                <div class='manageemployee'>

                    <div class='textmanagecontaineremployee'>
                        <i class='fas fa-users'></i>



                        <span>Employee Manager</span>

                    </div>


                </div>
            </div>


            <div class='previouscontainer'>
                <div class='manageprevlogs' style='cursor:pointer;' onclick="location.href = 'https://www.swapamc.com/swapproj/adminlogs';">

                    <div class='textmanagecontainerlogs'>
                        <i class='fas fa-flag'></i>





                        <span>Admin Logs</span>

                    </div>







                </div>
            </div>


            <div class='bottomsection'>
                <div class='viewprofile'>
                    <a href="https://www.swapamc.com/swapproj/campus">View profile</a>
                </div>
            </div>


        </div>

    </div>





    <?php
    echo "<div class='container5'>";
    echo "<div class='role'>Employee Manager</div>";
    echo "<div class='item'>";

    echo "<form id='myform' style='padding-left: 20px' method=POST action=https://www.swapamc.com/swapproj/employeemanager/editinc>";

    if ($query->fetch()) {

        echo "<div class='static' style='margin-left:10px'> <h3>Username: " . $username . "</h3></div>";

        echo "<div class='pairing'>";
        echo "<div class='pairing1'><p>Role:</p></div>";
        echo "<div class='pairing2'><input type=text name=role value=$role></div>";
        echo "</div>";


        echo "<div class='pairing'>";
        echo "<div class='pairing1'><p>Number:</p></div>";
        echo "<div class='pairing2'><input type=text name=number value=$number></div>";
        echo "</div>";


        echo "<div class='pairing'>";
        echo "<div class='pairing1'><p>Department:</p></div>";
        echo "<div class='pairing2'><input type=text name=department value=$department></div>";
        echo "</div>";


        echo "<div class='pairing'>";
        echo "<div class='pairing1'><p>Hourly wage:</p></div>";
        echo "<div class='pairing2'><input type=text name=pay value=$perhourpay></div>";
        echo "</div>";
        echo "<input type='hidden' name='csrf' value='$csrf'>";
    }

    // echo "<input style='margin-left: 9px; width:97%' type=submit>";

    echo "</form></div>
<button class='submit-form' form='myform' type='submit'>Edit</button>
</div></div>";


    ?>
    <style>
        <?php include 'storemanager/addstore1.css'; ?>
    </style>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">