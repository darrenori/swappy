<html>
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
         integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</html>
<?php
ob_start();
// require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/user_auth.php';
// require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
// require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/auth/pages.php';

require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/navbar.php';

?>
<html>
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
$filename = basename(__FILE__, '.php'); // filename variable is now set as allstores for example
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/manager/includes/employeefunctions.inc.php';
$userid = $jwtarrayinformation['userid'];
?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<style type="text/css">
    * {
        margin: 0;
        padding: 0;
        font-family: Montserrat;
    }

    body {
        background: #272727;
        color: white;
    }

    html,
    body {
        max-width: 100%;
        overflow-x: hidden;
    }



    /* .nav-bar {
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


    } */

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

        .banner-title {
            flex-basis: 100%;
            width: 100%;
        }

        .imagesection {
            margin: 100px;
            flex-basis: 100%;
            width: 100%;
        }

        .container {
            flex-direction: column-reverse;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            text-align: center;


        }

        .user {
            margin-left: 5vw;
            margin-top: 3vh;
            text-align: center;

        }

        .thing {
            margin-top: -45px;
        }

        .loginlogo {
            display: none;
        }

        .g-recaptcha {
            margin-left: 5vw;
            justify-content: center;
        }

        .btnthree {

            margin-left: 0;
        }

        /* .rowone .cylinder {
            width: 100px;
        } */

        .columnbelow {
            flex-basis: 100%;
        }

        .imagesection .vectorshape {
            width: 400px;
        }

        .imagesection .whiteshape {
            width: 400px;
        }

        .imagesection .ballshape {
            width: 200px;
        }

        .imagesection .ballshapetwo {
            width: 120px;
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
        height: 100%;
        width: 100%;
        margin: auto;
        display: flex;
        justify-content: flex-start;
        align-items: flex-start;
        flex-direction: row;
        margin-bottom: 50px;

    }

    .thing {
        font-weight: bold;
        width: 100%;
        text-align: left;



    }

    .smallbox {
        background-color: white;
        color: black;
        padding: 10px;
        border-radius: 10px;
        margin-right: 3vw;
        margin-bottom: 3vw;
    }

    .description low {
        color: blue;
        font-weight: bold;
    }

    .description medium {
        color: #ffe200;
        font-weight: bold;
    }

    .description high {
        color: red;
        font-weight: bold;
    }

    .description maintenance {
        color: red;
        font-weight: bold;
    }

    .description warning {
        color: #ffe200;
        font-weight: bold;
    }

    .description others {
        color: red;
        font-weight: bold;
    }

    .title {
        font-weight: bolder;
        font-size: 25px;
        border-left:#8D1D25 5px solid;
    }

    .h2 {
        color: white;
        font-weight: bold;
        font-size: 40px;
    }

    .h2 span {
        color: white;
        font-weight: normal;
        font-size: 30px;
    }

    ::placeholder {
        font-size: 25px;
    }

    input::placeholder {
        color: black;
        font-size: 25px;
        font-family: Montserrat;

    }

    input {
        border-radius: 15px;
        width: 35vw;
        height: 50px;
    }

    .loginbtn {
        background-color: #8d1d24;
        margin-top: 2vh;
        border-radius: 38px;
        border: 1px solid #8d1d24;
        display: inline-block;
        cursor: pointer;
        color: #ffffff;
        font-family: Montserrat;
        font-size: 15px;
        padding: 11px 30px;
        width: 35vw;
        text-decoration: none;
        text-shadow: 0px 1px 0px #2f6627;
        z-index: 1;
    }

    .user {
        color: grey;
        margin-top: 2vh;
        text-align: center;

    }

    .user span {
        color: #E26565;
        cursor: pointer;
    }


    .boxcontainer {
        display: flex;
        flex-wrap: wrap;
        flex-direction: flex-start;
    }
</style>

<head>
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script>
        $(function() {
            $(".toggle").on("click", function() {
                if ($(".item").hasClass("active")) {
                    $(".item").removeClass("active");
                } else {
                    $(".item").addClass("active");
                }

            })
        });
    </script>


</head>

<body>
    <!-- <div class='nav-bar'>
        <div class='nav-logo'>
            <img src="https://drive.google.com/uc?export=view&id=1sDaIqkxjzSkJAbI0nhS-gd2Roe3VlHXL" class='logo'>

        </div>

        <div class='nav-links' id='nav-links'>
            <i class="fas fa-arrow-circle-left" onclick="closeMenu()" style="color:white"></i>

            <ul>
                <a href="https://www.swapamc.com/swapproj/campus/">
                    <li>HOME</li>
                </a>
            </ul>
        </div>
        <i class="fas fa-bars menu-icon" onclick="showMenu()" style="color:white"></i>

    </div> -->

    <div class="container">
        <div class="thing">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1000" height="316" viewBox="0 0 1777 316">
                <defs>
                    <filter id="Rectangle_488" x="0" y="0" width="1777" height="316" filterUnits="userSpaceOnUse">
                        <feOffset dx="3" dy="3" input="SourceAlpha" />
                        <feGaussianBlur stdDeviation="3" result="blur" />
                        <feFlood />
                        <feComposite operator="in" in2="blur" />
                        <feComposite in="SourceGraphic" />
                    </filter>
                </defs>
                <g id="Group_411" data-name="Group 411" transform="translate(-18615 -3546)">
                    <g transform="matrix(1, 0, 0, 1, 18615, 3546)" filter="url(#Rectangle_488)">
                        <g id="Rectangle_488-2" data-name="Rectangle 488" transform="translate(6 6)" fill="#fff" stroke="#707070" stroke-width="1">
                            <rect width="1759" height="298" rx="10" stroke="none" />
                            <rect x="0.5" y="0.5" width="1758" height="297" rx="9.5" fill="none" />
                        </g>
                    </g>
                    <text id="Notifications" transform="translate(19030 3658)" fill="#1c1c1c" font-size="70" font-family="Montserrat-SemiBold, Montserrat" font-weight="600">
                        <tspan x="0" y="68">Notifications</tspan>
                    </text>
                    <g id="notify" transform="translate(19365.158 3594.196)">
                        <path id="Path_727" data-name="Path 727" d="M912.406,663.771,903,635.385s10.346,10.346,10.346,18.836l-1.857-19.631a29.959,29.959,0,0,1,4.775,18.04C915.734,663.506,912.406,663.771,912.406,663.771Z" transform="translate(-510.961 -450.843)" fill="#e6e6e6" />
                        <path id="Path_728" data-name="Path 728" d="M428.18,602.752l-9.18-27.7s10.1,10.1,10.1,18.383l-1.812-19.16a29.24,29.24,0,0,1,4.66,17.606C431.428,602.493,428.18,602.752,428.18,602.752Z" transform="translate(-228.733 -415.671)" fill="#e6e6e6" />
                        <path id="Path_729" data-name="Path 729" d="M560.587,642.316c.016,18.224-36.129,12.618-80.379,12.657s-79.849,5.706-79.864-12.518S436.46,620.236,480.71,620.2,560.571,624.092,560.587,642.316Z" transform="translate(-217.855 -442.451)" fill="#e6e6e6" />
                        <path id="Path_730" data-name="Path 730" d="M493.393,389.111h-5.785L484.855,366.8h8.538Z" transform="translate(-181.673 -213.857)" fill="#a0616a" />
                        <path id="Path_731" data-name="Path 731" d="M471.079,416.357h11.8v7.025H464.7v-.643a6.382,6.382,0,0,1,6.382-6.382Z" transform="translate(-169.918 -242.756)" fill="#2f2e41" />
                        <path id="Path_732" data-name="Path 732" d="M595.393,468.111h-5.785L586.855,445.8h8.538Z" transform="translate(-241.15 -259.923)" fill="#a0616a" />
                        <path id="Path_733" data-name="Path 733" d="M573.079,495.357h11.8v7.025H566.7v-.643a6.382,6.382,0,0,1,6.382-6.382Z" transform="translate(-229.396 -288.822)" fill="#2f2e41" />
                        <path id="Path_734" data-name="Path 734" d="M843.846,448.578a4.3,4.3,0,0,0-1.207-6.483L829.2,387.361l-8.591,3.7,15.981,52.923a4.324,4.324,0,0,0,7.253,4.6Z" transform="translate(-462.919 -306.681)" fill="#a0616a" />
                        <path id="Path_735" data-name="Path 735" d="M811.964,266.811a4.745,4.745,0,0,0-7.26.48l-20.8,2.388,3.164,8.021,18.913-3.54a4.771,4.771,0,0,0,5.98-7.35Z" transform="translate(-441.516 -235.532)" fill="#a0616a" />
                        <path id="Path_736" data-name="Path 736" d="M769,511.842l9.075,68.108,11.295-2.325s-1.661-49.6,3.986-55.581-7.264-16.455-7.264-16.455Z" transform="translate(-432.823 -375.621)" fill="#2f2e41" />
                        <path id="Path_737" data-name="Path 737" d="M723.718,465.915l-4.169,6.253s-32.1-13.34-32.1,7.921-1.837,35.689-2.5,36.686,7.686,3.583,11.673,2.918c0,0,4.918-34.276,4.586-36.269,0,0,31.489,15.439,37.468,14.11s7.392-6.033,8.389-8.69-.417-23.762-.417-23.762L726.715,459Z" transform="translate(-383.789 -348.454)" fill="#2f2e41" />
                        <path id="Path_738" data-name="Path 738" d="M764.682,317.923l-1.188-1.426s-13.308-29.944-8.08-38.024,28.043-9.268,28.756-8.793-1.7,6.646-.039,9.5c0,0-17.673,3.832-18.862,4.307s9.157,18.04,9.157,18.04l-1.188,10.694Z" transform="translate(-424.192 -238.006)" fill="#ccc" />
                        <path id="Path_739" data-name="Path 739" d="M795.1,347.858s-12.358,1.426-12.833,1.426-.713-3.089-.713-3.089l-10.932,14.972s-5.386,43.436-3.96,42.723,27.725,3.382,27.963,1.48-.238-11.407.475-11.883,12.358-29.944,12.358-29.944-1.188-6.179-5.228-8.318S795.1,347.858,795.1,347.858Z" transform="translate(-431.321 -282.676)" fill="#ccc" />
                        <path id="Path_740" data-name="Path 740" d="M843.439,378.118l3.8,4.04s5.65,46.424,2.56,47.85-9.171,1.251-9.171,1.251l-5.984-22.009Z" transform="translate(-471.102 -301.291)" fill="#ccc" />
                        <circle id="Ellipse_40" data-name="Ellipse 40" cx="10.939" cy="10.939" r="10.939" transform="translate(340.967 40.365)" fill="#a0616a" />
                        <path id="Path_741" data-name="Path 741" d="M783.588,292.791c-.148-2.27-3.011-2.348-5.286-2.369s-4.994.06-6.281-1.816a4.239,4.239,0,0,1,.015-4.289,12.187,12.187,0,0,1,3-3.334,41.518,41.518,0,0,1,9.485-6.681c3.524-1.625,7.654-2.281,11.309-.977,4.49,1.6,10.559,9.849,11.083,14.588a17.184,17.184,0,0,1-4.562,13.109c-3.192,3.541-10.5,2.112-15.1,3.372,2.8-3.956.953-11.144-3.525-12.992Z" transform="translate(-434.249 -239.781)" fill="#2f2e41" />
                        <circle id="Ellipse_41" data-name="Ellipse 41" cx="26.259" cy="26.259" r="26.259" transform="translate(225.591 141.984)" fill="#c11427" />
                        <path id="Path_742" data-name="Path 742" d="M439.313,334.013a18.827,18.827,0,0,1-17.2-11.168L380.446,229.01a24.942,24.942,0,1,1,46.637-17.453l30.173,98.14a18.793,18.793,0,0,1-17.943,24.317Z" transform="translate(-205 -193.896)" fill="#c11427" />
                    </g>
                </g>
            </svg>
            <div class='boxcontainer'>
                <?php


                //add
                try {
                    $query = $conn->prepare("SELECT notification,header,level,type FROM mydb.notification WHERE user_id = '0' OR user_id=?;");
                    $query->bind_param('s', $userid);
                    if ($query === false) {
                        //change filename accordingly
                        throw new Exception("Statement Preparation failed(viewnotification)");
                    }
                } catch (Exception $e) {
                    error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR preparing statement (SELECT)", 0);
                    header("location: https://www.swapamc.com/swapproj/campus?error=statement");
                    exit;
                }



                // throws error "Statment Execution failed" when statement fails
                try {
                    $execute = $query->execute();
                    if ($execute === false) {
                        throw new Exception("Statement Execution failed (viewnotification)");
                    }
                } catch (Exception $e) {
                    error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR executing statement (SELECT)", 0);
                    header("location: https://www.swapamc.com/swapproj/campus?error=statement");
                    exit;
                }

                $query->bind_result($notification, $header, $level, $type);
                while ($query->fetch()) {
                    echo "<div class='smallbox'>";
                    echo "<p class='title'>$header</p>";
                    echo "<p class='description'>$notification</p>";

                    if ($level == 0) {
                        echo "<p class='description'>Severity Level: <low>Low</low></p>";
                    } else if ($level == 1) {
                        echo "<p class='description'>Severity Level: <medium>Medium</medium></p>";
                    } else if ($level == 2) {
                        echo "<p class='description'>Severity Level: <high>High</high></p>";
                    } else {
                        echo "<p class='description'>Error. Contact Administrator</p>";
                    }

                    if ($type == 0) {
                        echo "<p class='description'>Type: <maintenance>Maintenance</maintenance></p>";
                    } else if ($type == 1) {
                        echo "<p class='description'>Type: <warning>Warning</warning></p>";
                    } else if ($type == 2) {
                        echo "<p class='description'>Type: <others>Others</others></p>";
                    } else {
                        echo "Error. Contact Administrator";
                    }

                    echo "</div>";
                }
                ?>

            </div>


        </div>

    </div>
    <br><br>





    <!-- <div class="footer">

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

    </div> -->

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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>

</html>