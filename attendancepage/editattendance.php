<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/auth/pages.php';
$attendanceid = htmlspecialchars($_GET["attendanceid"]);
$jwtarray = jwtdecrypt();
$jwtarrayinformation['attendanceid'] = $attendanceid;
jwtupdate($jwtarrayinformation);
if ($role == 6 || $role == 5 || $role == 2) {

    if (empty($attendanceid)) {
        header("location: https://www.swapamc.com/swapproj/attendance/editemployee?error=invalidurl");
        error_log("TPAMC:ATTENDANCE(editattendance):0:$ip:Error(invalidurl)", 0);
        exit;
    }


    try {
        $query = $conn->prepare("SELECT attendance_status FROM mydb.employee_attendance WHERE attendance_id=?");
        $query->bind_param('i',  $attendanceid);
        if ($query === false) {
            throw new Exception("Statement Preparation failed (editattendance)");
            error_log("TPAMC:ATTENDANCE:2:$ip:failed statement", 0);
            exit();
        }
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
        header("location: https://www.swapamc.com/swapproj/attendance/editemployee?error=stmtallerror");
        error_log("TPAMC:ATTENDANCE:0:$ip:Error(stmtallerror)", 0);
        exit;
    }

    try {
        $execute = $query->execute();
        if ($execute  === false) {
            throw new Exception("Statement Execution failed (editattendance)");
            error_log("TPAMC:ATTENDANCE:2:$ip:failed statement", 0);
            exit();
        }
    } catch (Exception $e) {
        header("location: https://www.swapamc.com/swapproj/attendance/editemployee?error=badstatement");
        error_log("TPAMC:ATTENDANCE:0:$ip:Error(badstatement)", 0);
        exit;
    }
    $query->bind_result($attendanceStatus);
    $query->fetch();
    $query->close();



    if ($attendanceStatus == "Valid" or $attendanceStatus == "Absent") {
        header("location: https://www.swapamc.com/swapproj/attendance/editemployee?error=invalid");
        exit;
    }


?>


    <html>
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
    <style type="text/css">
        label {
            display: flex;
            align-items: center;
        }

        span::after {
            padding-left: 5px;
        }

        input:invalid+span::after {
            content: '✖';
        }

        input:valid+span::after {
            content: '✓';
        }

        * {
            margin: 0;
            padding: 0;
            font-family: Montserrat;
        }

        body {
            background: rgb(2, 0, 36);
            background: linear-gradient(180deg, rgba(2, 0, 36, 1) 0%, rgba(141, 29, 37, 1) 100%, rgba(0, 212, 255, 1) 100%);
            overflow: hidden;
        }

        html,
        body {
            max-width: 100%;
            overflow-x: hidden;
        }

        .nav-bar {
            display: flex;
            padding: 40px 7vw;
            text-align: right;
            align-items: center;
        }

        .nav-bar .fas {
            display: none;
        }

        .nav-logo img {
            width: 150px;

        }

        .nav-links {
            flex: 1;
            right: -200px;
        }

        .nav-links ul {
            margin-right: 50px;
            display: inline;

        }

        .nav-links ul li {
            list-style: none;
            display: inline-block;
            padding: 8px 25px;

        }

        .nav-links ul a {
            color: white;
            text-decoration: none;
            font-size: 13px;
        }

        .nav-links ul li::after {
            content: '';
            width: 0;
            height: 2px;
            background: #8D1D25;
            display: block;
            margin: auto;
            transition: .25s;
        }

        .nav-links ul li:hover::after {

            width: 100%;

        }

        .btn {
            padding: 10px 20px;
            font-weight: 100;
            border: 0;
            background: #8D1D25;
            color: white;
            border-radius: 16px;
            cursor: pointer;
        }

        .nav-links .btn {
            float: right;
        }

        .scroll {
            display: flex;
            justify-content: center;
            flex-wrap: wrap;
            flex-direction: row;
            align-items: center;
            margin: 50px 7vw;
        }

        .bottom {
            margin-top: 200px;
        }

        .bottom .textcontainer {
            margin: 0 calc(7vw + 18px);
            margin-bottom: 20px;
        }

        .bottom .textcontainer h2 {
            color: white;
            font-size: 15px;
            opacity: 0.85;
        }

        .bottom .redbottom {
            background-color: #8D1D25;
            width: 100%;

            padding: 30px 0;
        }

        .marginedredbottom {
            background-color: #8D1D25;
            margin: 0 7vw;
            flex-basis: 100%;
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            /* //height:100%; */
        }

        .columnbelow {
            background-color: none;
            color: white;
            flex-basis: 29%;
            padding: 20px 18px;
            opacity: 80%;
            transition: .5s;
            /* //margin-left:7vw; */
        }

        .columnbelow:hover {
            background-color: white;
            color: black;
        }

        @media(max-width:900px) {
            .rowone {
                justify-content: flex-start;
            }

            .nav-bar {
                padding: 10px 30px;
            }

            .fa-bars {
                position: absolute;
                right: 20px;
                top: 10px;
            }

            .nav-bar .fas {
                display: block;
                color: white;
                margin: 10px 25px;
                font-size: 22px;
                cursor: pointer;
            }

            .nav-links {
                height: 100vh;
                width: 200px;
                background: #000;
                top: 0;
                right: -200px;
                position: fixed;
                text-align: left;
                z-index: 2;
                transition: .5s;

            }

            .nav-links ul a {
                display: block;
            }

            .nav-links .btn {
                float: none;
                margin-left: 25px;
                margin-top: 10px;
            }
        }

        /*footer*/
        .footer {
            padding: 85px 0;
            background-color: #212227;
        }

        .footer-row {
            width: 80%;
            margin: 0px auto;
            display: flex;
            flex-wrap: wrap;
            align-items: center;
            text-align: center;
        }

        .firstfooter {
            flex-basis: 30%;
            text-align: left;
        }

        .firstfooter img {
            width: 150px;
            opacity: 80%;
            padding-bottom: 40px;
        }

        .firstfooter h4 {
            color: white;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        .firstfooter h5 {
            color: white;
            opacity: 75%;
        }

        .secondfooter {
            flex-basis: 70%;
        }

        .secondfooter h1 {
            color: white;
            padding-bottom: 30px;
            text-align: left;
        }

        .secondfooter .links {
            width: 100%;

            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            text-align: left;

        }

        .linkcol {
            flex-basis: 28%;

        }

        .linkcol h3 {
            color: #8D1D25;
            opacity: 100%;
            text-decoration: underline;
            font-size: 16px;
            padding-bottom: 5px;
        }

        .links .linkcol h4 {
            color: white;


        }

        .linkcol p {
            font-size: 12px;
            color: #8D1D25;
            opacity: 100%;
        }

        .linkcol .fab {

            color: #fff;

            font-size: 25px;
            padding-right: 10px;
            cursor: pointer;

        }

        /*transitions*/
        .firstfooter img,
        .firstfooter h4,
        .firstfooter h5 {

            transition: .5s;
        }

        .firstfooter img:hover {
            opacity: 100%;
        }

        .linkcol .fab,
        .linkcol h4 {
            transition: .5s;
        }

        .linkcol .fab:hover,
        .linkcol h4:hover {
            color: #8D1D25;
        }

        .linkcol p {
            transition: .5s;
        }

        .linkcol p:hover {
            opacity: 100%;
        }

        .linkcol a {
            text-decoration: none;
        }

        @media screen and (max-width: 960px) {
            .firstfooter {
                flex-basis: 100%;
                margin-bottom: 30px;
            }

            .secondfooter {
                flex-basis: 100%;
            }

            .linkcol {
                flex-basis: 100%;
                margin-bottom: 30px;
            }
        }

        .container {
            background-color: rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            height: 30%;
            width: 80%;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: row;
            margin: auto;
            margin-bottom: 50px;
        }

        .thing {
            padding: 2em;
            font-family: Montserrat;
            font-weight: bold;
            width: 100%;
            margin: auto;


        }

        /*Table Styles*/
        .styled-table {
            border-collapse: collapse;
            ;
            font-size: 0.9em;
            min-width: 400px;
            width: 100%;
            font-weight: bold;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }

        .styled-table thead tr {
            background-color: #E26565;
            text-align: left;
        }

        .styled-table th,
        .styled-table td {
            padding: 12px 15px;
        }

        .styled-table tbody tr {
            border-bottom: 1px solid #E26565;
        }

        .styled-table tbody tr:nth-of-type(odd) {
            background-color: white;
            color: black;
        }

        .styled-table tbody tr:nth-of-type(even) {
            background-color: darkgray;
            color: white;
        }

        .styled-table tbody tr:last-of-type {
            border-bottom: 2px solid #E26565;
        }

        .ballshape3 {

            /* //mrgin-left:-500px; */
            position: absolute;
            bottom: 370px;
            left: 1000px;
            z-index: -2;
        }
    </style>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <body>
        <div class='nav-bar'>
            <div class='nav-logo'>
                <img src="https://drive.google.com/uc?export=view&id=1sDaIqkxjzSkJAbI0nhS-gd2Roe3VlHXL" class='logo'>

            </div>
            <div class='nav-links' id='nav-links'>
                <i class="fas fa-arrow-circle-left" onclick="closeMenu()" style="color:white"></i>
                <ul>
                    <a href="#">
                        <li>HOME</li>
                    </a>
                    <a href="#">
                        <li>FAQs</li>
                    </a>
                    <a href="#">
                        <li>PRODUCTS</li>
                    </a>


                </ul>
                <button type="button" class="btn">SIGN UP</button>
            </div>
            <i class="fas fa-bars menu-icon" onclick="showMenu()" style="color:white"></i>

        </div>

        <div class='hero'>


            <div class="ballshape3">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="339.834" height="339.834" viewBox="0 0 339.834 339.834">
                    <defs>
                        <radialGradient id="radial-gradient" cx="0.209" cy="0.597" r="0.5" gradientUnits="objectBoundingBox">
                            <stop offset="0" stop-color="#e26565" />
                            <stop offset="1" stop-color="#8d1d25" />
                        </radialGradient>
                    </defs>
                    <circle id="Ellipse_9" data-name="Ellipse 9" cx="124.388" cy="124.388" r="124.388" transform="translate(0 124.388) rotate(-30)" fill="url(#radial-gradient)" />
                </svg>

            </div>

    </body>
    <div class="container">
        <div class="thing">
            <section style="font-family:Montserrat; color:white; align-content:center;" class="signup-form">
            <?php







            echo "<h3>Edit Employee's Attendance</h3>";
            echo "<form method='POST' action='/swapproj/attendance/editattendanceinc'>";
            echo "<input type='radio' name='attendStatus' value='valid'> Valid";
            echo "<br>";
            echo "<input type='radio' name='attendStatus' value='absent'> Absent";
            echo "<br>" . "<br>";
            echo "<input type='submit' name='submit' value='submit'>";
            echo "</form>";

            if (isset($_GET["error"])) {
                if ($_GET["error"] == "emptyinput") {
                    echo "<p>Please select an option</p>";
                } elseif ($_GET["error"] == "badstatement") {
                    echo "<p>Bad Statement</p>";
                } elseif ($_GET["error"] == "stmtallerror") {
                    echo "<p>STMT All Error</p>";
                } elseif ($_GET["error"] == "emptySubmit") {
                    echo "<p>Empty Submit</p>";
                }
            }
        } else {
            header("location: https://www.swapamc.com/swapproj/campus?error=unauthorized");
            error_log("TPAMC:ATTENDANCE(editattendance):0:$ip:Error(unauthorized)", 0);
            exit;
        }
            ?>

        </div>
    </div>



    <div class="footer">
        <div class="footer-row">
            <div class="firstfooter">
                <img src="https://drive.google.com/uc?export=view&id=1sDaIqkxjzSkJAbI0nhS-gd2Roe3VlHXL" class='logo'>
                <h4>NOTHING MUCH. JUST. THE. BEST.</h4>
                <h5>&#169; 2021 TPAMC Inc.<br>
                    All Rights Reserverd.
                </h5>
            </div>
            <div class="secondfooter">
                <h1>Nothing much.
                    Just the BEST website
                    <br>
                    for the BEST AMC
                </h1>
                <div class="links">
                    <div class="linkcol">

                        <h3>Reach Us</h3>
                        <a>
                            <h4>+65 9123 1923</h4>
                        </a>
                        <a href="mailto:tp@tp.com">
                            <h4>tp@tp.com</h4>
                        </a>

                    </div>
                    <div class="linkcol">
                        <h3>Make us Famous</h3>
                        <a href="https://www.facebook.com/iu.loen"><i class="fab fa-facebook-f"></i></a>
                        <a href="https://www.instagram.com/dlwlrma/"><i class="fab fa-instagram"></i></a>
                        <a href="https://twitter.com/_iuofficial?lang=en"><i class="fab fa-twitter"></i></a>
                        <a href="https://www.pinterest.com/search/pins/?q=iu&rs=typed&term_meta[]=iu%7Ctyped"><i class="fab fa-pinterest"></i></a>


                    </div>
                    <div class="linkcol">
                        <a href="#">
                            <p>SUBSCRIBE</p>
                        </a>
                        <a href="#">
                            <p>OUR TEAM</p>
                        </a>

                    </div>
                </div>
            </div>
        </div>

    </div>
    </body>

    <script>
        var show = document.getElementById('nav-links');

        function showMenu() {
            show.style.display = 'block';

            show.style.right = '0';
        }

        function closeMenu() {
            show.style.right = '-200px';
        }
    </script>
    <script type="text/javascript">
        function preventBack() {
            window.history.forward();
        }
        setTimeout("preventBack()", 0);
        window.onunload = function() {
            null
        };
    </script>

    </html>