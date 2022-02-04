<html>
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />

</html>
<?php
ob_start();
// require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/user_auth.php';
// require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
// require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/auth/pages.php';
// require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/navbar.php';

?>


<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';

$jwtarray = jwtdecrypt();
if (isset($jwtarray) && $jwtarray == true) {

    $jwtarrayinformation = $jwtarray['array'];
}

$userid = $jwtarrayinformation['userid'];
?>
<?php
require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/manager/includes/employeefunctions.inc.php';
$csrf = generateCSRF();
$_SESSION['csrfspecial'] = $csrf; //gives  viewcart page special powers hahah

?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<style type="text/css">
    * {
        margin: 0;
        padding: 0;
        font-family: Montserrat;
    }

    body {
        background: black;
    }

    html,
    body {
        max-width: 100%;
        overflow-x: hidden;
    }



    /* .nav-bar {
        display:flex;
        padding: 40px 7vw;
        text-align:right;
        align-items:center;
    }

    .nav-bar .fas {
        display:none;
    }

    .nav-logo img {
        width:150px;
        
    }

    .nav-links {
        flex:1;

        right:-200px;
        
    }

    .nav-links ul {
        margin-right:50px;
        display:inline;
        
    }

    .nav-links ul li {
        list-style:none;
        display:inline-block;
        padding:8px 25px;
        
    }

    .nav-links ul a {
        color: white;
        text-decoration:none;
        font-size:13px;
    }

    .nav-links ul li::after {
        content:'';
        width:0;
        height:2px;
        background:#8D1D25;
        display:block;
        margin:auto;
        transition:.25s;
    }

    .nav-links ul li:hover::after {
        
        width:100%;
        

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

    /* .nav-links .btn {
        float:right;

    } */



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
            /* flex-direction: column-reverse;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap; 
            text-align: center; */
            /* margin-left:13.3vw; */



        }

        .user {
            margin-left: 5vw;
            margin-top: 3vh;
            text-align: center;

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
        /* padding: 20px; */
        width: 100%;
        /* margin:auto; */
        display: flex;
        justify-content: flex-start;
        /* align-items: flex-start; */
        flex-direction: row;
        margin-bottom: 50px;
        margin-left: 13.3vw;
        padding-left: 0;
        padding: 20px 0;

    }

    .thing {
        font-family: Montserrat;
        font-weight: bold;
        width: 100%;



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

    .smallbox {
        background-color: rgba(255, 255, 255, 0.3);
        color: white;
        padding: 10px;
        border-radius: 10px;
        margin-top: 10px;
        margin-right: 20px;

    }

    .edit {
        background-color: #5681BB;
        color: white;
        padding: 14px 32px 14px 32px;
        border-radius: 10px;
        margin-right: 10px;
        font-weight: bold;
    }

    .delete {
        background-color: #8D1D25;
        color: white;
        padding: 14px 32px 14px 32px;
        border-radius: 10px;
        margin-right: 10px;
        font-weight: bold;
    }

    .setdefault {
        background-color: #62A969;
        color: white;
        padding: 14px 32px 14px 32px;
        border-radius: 10px;
        font-weight: bold;
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
    <input style="background-color:#8D1D25; cursor:pointer; color:white; border:#272727; width:20vw; margin-left:13.3vw; text-align:center; font-weight:bolder;" value="Back to Checkout Page" onclick="location.href = 'https://www.swapamc.com/swapproj/checkout/'"><br>
    <br>
    <h1 style="font-weight: bolder; color:white; margin-left:13.3vw;">Shipping<br>Information</h1>
    <input style="background-color:white; cursor:pointer; width:10vw; margin-left:13.3vw; text-align:center; font-weight:bold;" value="Add" onclick="location.href = 'https://www.swapamc.com/swapproj/checkout/addshippingaddress'">
    <div class="container" style="color:white">

        <?php
        $query = $conn->prepare("SELECT user_shipping_id,user_shipping_name, user_shipping_number, user_shipping_email, user_shipping_address, user_shipping_postalcode, user_shipping_unitnumber FROM user_shippinginformation WHERE user_shipping_userid = $userid AND deleted != 1");

        $stmt = mysqli_stmt_init($conn);


        if (!$query->execute()) {
            header("location: ../swapproj/checkout?error=stmtfailed");
            exit();
        }
        if ($query->execute()) {

            $query->bind_result($shipping_id, $name, $number, $email, $address, $zip, $unit);

            $result = $query->get_result();


            // print shipping address (&nbsp is just spacing)
            if ($result->num_rows > 0) {
                while ($row = mysqli_fetch_array($result)) {
                    echo "<div class='smallbox' style='font-weight:300; margin-bottom:5vh;'>";
                    echo "<form method='POST'>";
                    echo "<div class='name' style='padding: 10px;'>";
                    echo "Name:" . "<br>" . $row['user_shipping_name'];
                    echo "</div>";
                    echo "<div class='number'style='padding: 10px;'>";
                    echo "Number:" . "<br>" . $row["user_shipping_number"];
                    echo "</div>";
                    echo "<div class='email'style='padding: 10px;'>";
                    echo "Email Address:" . "<br>" . $row["user_shipping_email"];
                    echo "</div>";
                    echo "<div class='address'style='padding: 10px;'>";
                    echo "Address:" . "<br>" . $row["user_shipping_address"];
                    echo "</div>";
                    echo "<div class='zipcode'style='padding: 10px;'>";
                    echo "Zip Code:" . "<br>" . $row["user_shipping_postalcode"];;
                    echo "</div>";
                    echo "<div class='unit'style='padding: 10px;'>";
                    echo "Unit No.:" . "<br>" . "#" . $row["user_shipping_unitnumber"];
                    echo "</div>";

                    echo "<br>";
                    echo "<a class='edit'href='https://www.swapamc.com/swapproj/checkout/editshippingaddress?shippingid=" . $row['user_shipping_id'] . "&dt=" . $csrf . "'>Edit</a>";
                    echo "<a class='delete'href='https://www.swapamc.com/swapproj/checkout/deleteshippingaddress?shippingid=" . $row['user_shipping_id'] . "&dt=" . $csrf . "'>Delete</a>";
                    echo "<a class='setdefault' href='https://www.swapamc.com/swapproj/checkout/defaultsa?shippingid=" . $row['user_shipping_id'] . "&dt=" . $csrf . "'>Set Default</a>";
                    echo "<br><br>";
                    echo "<input type='hidden' name='csrf' value='$csrf'>";
                    echo "</form>";
                    echo "</div><br>";
                }
            } else {
                echo "No shipping address";
            }
        }
        $conn->close();
        ob_flush();
        ?>


    </div>
    <br><br><br><br>

    <section>
        <script type="text/javascript">
            history.pushState(null, document.title, location.href);
            window.addEventListener('popstate', function(event) {
                const leavePage = confirm("Please click back to go back");
                if (leavePage) {
                    history.pushState(null, document.title, location.href);
                } else {
                    history.pushState(null, document.title, location.href);
                }
            });
        </script>
    </section>





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