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

session_start();
session_regenerate_id();
$csrf = generateCSRF();


$shipping_id = (int)$_GET['shippingid'];
if (!is_numeric($shipping_id) || strlen((string)($shipping_id))>11) {
    header("location: https://www.swapamc.com/swapproj/checkout/viewshippingaddress?error=invalidid");
    exit();
}



$_SESSION["shippingid"] = (int)$_GET['shippingid'];

?>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<style type="text/css">
  *{
        margin:0;
        padding:0;
        font-family:Montserrat;
    }
    body {
        background:black;
    }

    html, body {
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
        font-weight:100;
        border:0;
        background:#8D1D25;
        color:white;
        border-radius:16px;
        cursor:pointer;
    }

    .nav-links .btn {
        float:right;

    }

    .loginlogo{
        margin-top: -90vh;
        margin-left:80vh;
    }

    @media(max-width:1000px){

        .rowone {
            justify-content:flex-start;
        }
        .nav-bar {
            padding: 10px 30px;
        }

        .fa-bars {
            position: absolute;
            right:20px;
            top:10px;
        }

        .nav-bar .fas {
            display:block;
            color:white;
            margin: 10px 25px;
            font-size:22px;
            cursor:pointer;
        }

        .nav-links{
            height:100vh;
            width:200px;
            background:#000;
            top:0;
            right:-200px;
            position:fixed;
            text-align:left;
            z-index:2;
            transition:.5s;
            
        }

        .nav-links ul a{
            display:block;
        }

        .nav-links .btn {
            float:none;
            margin-left:25px;
            margin-top:10px;
        }

        .banner-title {
            flex-basis:100%;
            width:100%;
        }

        .imagesection {
            margin:100px;
            flex-basis:100%;
            width:100%;
        }

        .container{
            flex-direction: column-reverse;
            justify-content: center;
             align-items: center;
             flex-wrap: wrap; 
             text-align: center;
            
             
        }

        .user{
            margin-left:5vw;
            margin-top: 3vh;
            text-align: center;

}
        .thing{
            margin-top: -45px;
        }
        .loginlogo{
            display: none;
        }

        .g-recaptcha{
            margin-left: 5vw;
            justify-content: center;
        }

        .btnthree {
        
            margin-left:0;
        }

        /* .rowone .cylinder {
            width: 100px;
        } */

        .columnbelow {
            flex-basis:100%;
        }

        .imagesection .vectorshape {
            width:400px;
        }

        .imagesection .whiteshape {
            width:400px;
        }

        .imagesection .ballshape {
            width: 200px;
        }

        .imagesection .ballshapetwo {
            width:120px;
        }

        
    }

    


/*footer*/

.footer {
    padding: 85px 0;
    background-color: #212227;
}

.footer-row {
    width: 80%;
    margin:0px auto;
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
.firstfooter img, .firstfooter h4, .firstfooter h5{
    
    transition: .5s;
}

.firstfooter img:hover {
    opacity: 100%;

}





.linkcol .fab, .linkcol h4{
    transition: .5s;
}

.linkcol .fab:hover, .linkcol h4:hover {
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
    .firstfooter{
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
        
   
    .container{
        background-color: rgba(255,255,255,0.3);
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        height:100%;
         width:120%;
        margin:auto;
         display: flex;
         justify-content: flex-start;
        align-items: flex-start;
        flex-direction: row;
        margin-bottom:50px;
    
    }
    .thing{
    font-family: Montserrat;
    font-weight: bold;
    width:100%;
    margin-top:2vh;
   
    
}

.h2{
    color: white;
    font-weight: bold;
    font-size: 40px;
}
.h2 span{
    color: white;
    font-weight: normal;
    font-size: 30px;
}
::placeholder{
    font-size: 25px;
}

input::placeholder{
    color: black;
    font-size: 25px;
    font-family: Montserrat;

}
input{
    border-radius:15px;
    width:35vw; 
    height:50px;
    padding-left: 10px;
}

.loginbtn {
	background-color:#8d1d24;
    margin-top: 2vh;
	border-radius:38px;
	border:1px solid #8d1d24;
	display:inline-block;
    cursor: pointer;
	color:#ffffff;
	font-family:Montserrat;
	font-size:15px;
	padding:11px 30px;
    width:35vw; 
	text-decoration:none;
	text-shadow:0px 1px 0px #2f6627;
    z-index: 1;
}

.user{
    color: grey;
    margin-top: 2vh;
    text-align: center;

}
.user span{
    color: #E26565;
    cursor: pointer;
}
.ballshape{
        
        /* //mrgin-left:-500px; */
        position:absolute;
        bottom:-500px;
        left:200px;
        z-index:-2;
}
.ballshape2{
        
        /* //mrgin-left:-500px; */
        position:absolute;
        bottom:-450px;
        left:1030px;
        z-index:-2;
}

.ballshape3{
        
        /* //mrgin-left:-500px; */
        position:absolute;
        bottom:370px;
        left:1000px;
        z-index:-2;
}
</style>
<?php
if (isset($_GET['type'])) {
    if ($_GET['type'] == 'success') {
        echo "updated succesfully";
        echo "<br>";
    }
}
?>
<section>
    <script type="text/javascript">
        history.pushState(null, null, '<?php echo $_SERVER["REQUEST_URI"]; ?>');
        window.addEventListener('popstate', function(event) {
            window.location.href("http://www.swapamc.com/checkout/viewshippingaddress");
        });
    </script>
</section>

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
                <a href="https://www.swapamc.com/swapproj/campus/"><li>HOME</li></a>       
            </ul>
        </div>
        <i class="fas fa-bars menu-icon" onclick="showMenu()" style="color:white"></i>

    </div> -->
<div class="ballshape3">
    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="339.834" height="339.834" viewBox="0 0 339.834 339.834">
  <defs>
    <radialGradient id="radial-gradient" cx="0.209" cy="0.597" r="0.5" gradientUnits="objectBoundingBox">
      <stop offset="0" stop-color="#e26565"/>
      <stop offset="1" stop-color="#8d1d25"/>
    </radialGradient>
  </defs>
  <circle id="Ellipse_9" data-name="Ellipse 9" cx="124.388" cy="124.388" r="124.388" transform="translate(0 124.388) rotate(-30)" fill="url(#radial-gradient)"/>
</svg>

    </div>

    <div class="container" style="color:white;">                      
            <div class="thing">
            <input style="background-color:#8D1D25; cursor:pointer; color:white; border:#272727; width:20vw;  text-align:center; font-weight:bolder;" value="Back to Shipping Page" onclick="location.href = 'https://www.swapamc.com/swapproj/checkout/viewshippingaddress'"><br>
            <br>
<?php
$query = $conn->prepare("SELECT user_shipping_id,user_shipping_name, user_shipping_number, user_shipping_email, user_shipping_address, user_shipping_postalcode, user_shipping_unitnumber FROM mydb.user_shippinginformation WHERE user_shipping_id = $shipping_id AND deleted != 1;");
$stmt = mysqli_stmt_init($conn);


if (!$query->execute()) {
    header("location: ../swapproj/checkout?error=stmtfailed");
    exit();
}

if ($query->execute()) {
    $query->bind_result($shipping_id, $name, $phone, $email, $address, $zip, $unit);
    if ($query->fetch()) {
        echo "<form method='POST' action='/swapproj/checkout/updatesa'>";
        echo "<h2>Update Shipping Address</h2>";
        echo "Name" . "<br>";
        echo "<input type='text' name='name' value='$name'><br>";

        echo "Phone" . "<br>";
        echo "<input type='text' name='phone' value='$phone'minlength='8' maxlength='8' pattern='\d*'><br>";

        echo "Email" . "<br>";
        echo "<input type='email' name='email' value='$email'><br>";

        echo "Address" . "<br>";
        echo "<input type='text' name='address' value='$address'><br>";

        echo "Zip" . "<br>";
        echo "<input type='text' name='zip' value='$zip'pattern='\d*'><br>";

        echo "Unit" . "<br>";
        echo "<input type='text' name='unit' value='$unit'><br><br>";

        echo '<input style="background-color:#62A969; border:#272727; font-weight:bolder; color:white;"type="submit" value="Update" name="submit"><br><br>';
        echo "<input type='hidden' name='csrf' value='$csrf'>";

        echo "</form><br><br><br>";
    }
    
}
$conn->close();
?>

<svg class="loginlogo" xmlns="http://www.w3.org/2000/svg" width="510" height="672.016" viewBox="0 0 855.937 672.016">
                        <g id="mob" transform="translate(0 0)">
                            <path id="Path_133" data-name="Path 133" d="M906.142,716.493a255.968,255.968,0,0,1-55.849,45.058c-.473.291-.955.564-1.438.847L815.44,732.824c.351-.326.74-.692,1.158-1.094,24.9-23.641,148.5-188.935,156.733-229.186C972.763,505.9,980.763,637.4,906.142,716.493Z" transform="translate(-127.015 -103.013)" fill="#f0f0f0"/>
                            <path id="Path_134" data-name="Path 134" d="M854.266,737.222c-.632.151-1.275.292-1.919.42l-25.068-22.187c.49-.171,1.062-.374,1.717-.6,10.756-3.809,42.79-15.306,74.67-28.4,34.255-14.077,68.346-29.982,75.677-40.17C977.77,648.653,929.323,720.438,854.266,737.222Z" transform="translate(-124.541 -72.978)" fill="#f0f0f0"/>
                            <path id="Path_578" data-name="Path 578" d="M946.076,344.332h-3.57v-97.8a56.6,56.6,0,0,0-56.6-56.6H678.709a56.6,56.6,0,0,0-56.6,56.6V783.055a56.6,56.6,0,0,0,56.6,56.6H885.9a56.6,56.6,0,0,0,56.6-56.6V413.945h3.57Z" transform="translate(-167.412 -168.333)" fill="#3f3d56"/>
                            <path id="Path_579" data-name="Path 579" d="M927.758,244.378V780.116a42.261,42.261,0,0,1-42.276,42.261H677.288a42.259,42.259,0,0,1-42.261-42.264V244.378a42.259,42.259,0,0,1,42.264-42.261h25.262a20.091,20.091,0,0,0,18.6,27.66h118.7a20.07,20.07,0,0,0,18.6-27.66H885.48A42.261,42.261,0,0,1,927.758,244.378Z" transform="translate(-164.713 -165.787)" fill="#fff"/>
                            <path id="Path_580" data-name="Path 580" d="M857.313,472.574h-183a12.1,12.1,0,0,1-12.089-12.09v-6.018a12.1,12.1,0,0,1,12.089-12.09h183a12.1,12.1,0,0,1,12.09,12.09v6.018a12.1,12.1,0,0,1-12.09,12.089Z" transform="translate(-159.029 -115.585)" fill="#f0f0f0"/>
                            <path id="Path_581" data-name="Path 581" d="M857.313,515.481h-183a12.1,12.1,0,0,1-12.089-12.09v-6.018a12.1,12.1,0,0,1,12.089-12.09h183a12.1,12.1,0,0,1,12.09,12.09v6.018A12.1,12.1,0,0,1,857.313,515.481Z" transform="translate(-159.029 -106.619)" fill="#f0f0f0"/>
                            <path id="Path_582" data-name="Path 582" d="M864.988,463.187H681.994A12.708,12.708,0,0,1,669.3,450.493v-6.018a12.709,12.709,0,0,1,12.694-12.694h183a12.708,12.708,0,0,1,12.694,12.694v6.018A12.708,12.708,0,0,1,864.988,463.187Zm-183-28.988a10.288,10.288,0,0,0-10.276,10.276v6.018a10.288,10.288,0,0,0,10.276,10.276h183a10.288,10.288,0,0,0,10.276-10.276v-6.018A10.288,10.288,0,0,0,864.988,434.2Z" transform="translate(-157.551 -117.799)" fill="#3f3d56"/>
                            <path id="Path_583" data-name="Path 583" d="M864.988,506.094H681.994A12.708,12.708,0,0,1,669.3,493.4v-6.017a12.708,12.708,0,0,1,12.694-12.694h183a12.708,12.708,0,0,1,12.694,12.694V493.4A12.708,12.708,0,0,1,864.988,506.094ZM681.994,477.107a10.288,10.288,0,0,0-10.276,10.276V493.4a10.288,10.288,0,0,0,10.276,10.276h183A10.288,10.288,0,0,0,875.265,493.4v-6.018a10.287,10.287,0,0,0-10.276-10.276Z" transform="translate(-157.551 -108.833)" fill="#3f3d56"/>
                            <path id="Path_584" data-name="Path 584" d="M904.3,244.378V360.909A125.174,125.174,0,0,1,747.28,239.923q0-5.126.412-10.146h68.7a20.07,20.07,0,0,0,18.6-27.66h27.034A42.261,42.261,0,0,1,904.3,244.378Z" transform="translate(-141.257 -165.787)" fill="#f0f0f0"/>
                            <path id="Path_585" data-name="Path 585" d="M740.223,725.239c0,2.456-.092,4.882-.29,7.277H677.288a42.259,42.259,0,0,1-42.261-42.264v-57.3a93.178,93.178,0,0,1,105.2,92.287Z" transform="translate(-164.713 -75.927)" fill="#8d1d25"/>
                            <path id="Path_586" data-name="Path 586" d="M307.691,652.656a7.262,7.262,0,0,0,9.564-3.708l56.433-127.9a16.175,16.175,0,0,0-20.646-21.611h0a15.958,15.958,0,0,0-8.161,6.988,16.517,16.517,0,0,0-.791,1.563l-56.433,127.9a7.253,7.253,0,0,0,3.708,9.565Z" transform="translate(-237.425 -103.891)" fill="#8d1d25"/>
                            <path id="Path_587" data-name="Path 587" d="M366.443,573.993l-55.819-12.4,13.816-36.549A38.626,38.626,0,0,1,365.9,496.475l.538.06Z" transform="translate(-232.497 -104.328)" fill="#2f2e41"/>
                            <path id="Path_588" data-name="Path 588" d="M461.4,654.694a8.5,8.5,0,0,1-7.752-5.049l-56.433-127.9a17.385,17.385,0,0,1,30.96-15.713h0a17.663,17.663,0,0,1,.85,1.678l56.433,127.9a8.463,8.463,0,0,1-4.326,11.159l-16.879,7.447-.009-.019A8.392,8.392,0,0,1,461.4,654.694Z" transform="translate(-214.712 -104.1)" fill="#8d1d25"/>
                            <path id="Path_589" data-name="Path 589" d="M386.739,591.169a7.262,7.262,0,0,0-7.254,7.254V747.141a7.262,7.262,0,0,0,7.254,7.254h17.844a7.262,7.262,0,0,0,7.254-7.254V598.423a7.262,7.262,0,0,0-7.254-7.254Z" transform="translate(-218.108 -84.495)" fill="#8d1d25"/>
                            <path id="Path_590" data-name="Path 590" d="M357.547,591.169a7.262,7.262,0,0,0-7.254,7.254V747.141a7.262,7.262,0,0,0,7.254,7.254h17.844a7.262,7.262,0,0,0,7.254-7.254V598.423a7.262,7.262,0,0,0-7.254-7.254Z" transform="translate(-224.208 -84.495)" fill="#8d1d25"/>
                            <circle id="Ellipse_12" data-name="Ellipse 12" cx="61.656" cy="61.656" r="61.656" transform="translate(97.717 227.553)" fill="#8d1d25"/>
                            <path id="Path_591" data-name="Path 591" d="M394.812,439.813c4-.111,8.971-.25,12.8-3.049a9.832,9.832,0,0,0,3.869-7.342,6.614,6.614,0,0,0-2.249-5.432c-2-1.691-4.924-2.088-8.074-1.162l3.263-23.847-2.4-.328-3.836,28.036,2-.918c2.319-1.064,5.5-1.605,7.481.067a4.25,4.25,0,0,1,1.394,3.5,7.431,7.431,0,0,1-2.879,5.474c-2.982,2.178-6.947,2.459-11.444,2.585Z" transform="translate(-214.92 -124.721)" fill="#2f2e41"/>
                            <rect id="Rectangle_268" data-name="Rectangle 268" width="13.022" height="2.418" transform="translate(201.351 276.316)" fill="#2f2e41"/>
                            <rect id="Rectangle_269" data-name="Rectangle 269" width="13.022" height="2.418" transform="translate(160.246 276.316)" fill="#2f2e41"/>
                            <path id="Path_592" data-name="Path 592" d="M449.3,659.709l-22.191-162a7.254,7.254,0,0,0-7.187-6.269H403.166a7.286,7.286,0,0,0,.109-1.209v-6.045a7.254,7.254,0,0,0-7.253-7.254H381.514a7.254,7.254,0,0,0-7.254,7.254v6.045a7.288,7.288,0,0,0,.109,1.209h-16.75a7.254,7.254,0,0,0-7.187,6.269l-22.191,162a7.254,7.254,0,0,0,7.186,8.238H442.11a7.254,7.254,0,0,0,7.186-8.238Z" transform="translate(-228.83 -108.364)" fill="#2f2e41"/>
                            <path id="Path_593" data-name="Path 593" d="M399.8,573.993V496.534l.538-.06A38.639,38.639,0,0,1,441.818,525.1l13.8,36.486Z" transform="translate(-213.864 -104.327)" fill="#2f2e41"/>
                            <path id="Path_594" data-name="Path 594" d="M389.158,490.005l-42.646-16.553c-6.974-2.707-13.986-5.331-20.923-8.131a23.847,23.847,0,0,1-8.053-4.747,15.824,15.824,0,0,1-4.015-7.77c-1.479-6.252-1.212-13.087-1.106-19.467a148.345,148.345,0,0,1,1.719-20.843,100.688,100.688,0,0,1,12.876-36.728c11.96-19.623,32.566-34.387,56.268-33.209,10.973.546,22.01,4.483,30.163,11.986a19.038,19.038,0,0,0,2.847,2.759,3.951,3.951,0,0,0,2.268.152q1.492-.1,2.987-.147a61.708,61.708,0,0,1,10.355.434,32.788,32.788,0,0,1,17.083,7.093c4.074,3.5,7.39,8.453,7.731,13.951a16.514,16.514,0,0,1-5.578,13.48c-5.088,4.288-12.347,2.781-18.45,2.458l-22.358-1.185-11.328-.6c-2.332-.124-2.326,3.5,0,3.627l30.109,1.6c4.838.256,9.825.885,14.667.594a16.41,16.41,0,0,0,10.074-4.053,20.1,20.1,0,0,0,6.089-18.861c-1.552-7.42-7.075-13.558-13.548-17.21-8.809-4.969-19.329-5.445-29.185-4.71l1.282.531c-11.149-11.966-28.227-17.019-44.26-15.251-16.928,1.867-31.984,11.311-42.8,24.224-12.061,14.4-18.634,32.351-21.189,50.812a169.058,169.058,0,0,0-1.308,30.078,37.9,37.9,0,0,0,2.239,13,18.606,18.606,0,0,0,8.735,9.365,125,125,0,0,0,13.864,5.7l15.712,6.1,30.862,11.979,7.856,3.049c2.177.845,3.12-2.66.964-3.5Z" transform="translate(-232.889 -137.215)" fill="#2f2e41"/>
                            <path id="Path_595" data-name="Path 595" d="M323.034,368.411a18.739,18.739,0,1,1,18.739-18.739A18.739,18.739,0,0,1,323.034,368.411Zm0-33.851a15.112,15.112,0,1,0,15.112,15.112A15.112,15.112,0,0,0,323.034,334.561Z" transform="translate(-233.819 -138.871)" fill="#2f2e41"/>
                            <rect id="Rectangle_270" data-name="Rectangle 270" width="51.062" height="51.062" transform="matrix(0.794, 0.608, -0.608, 0.794, 361.9, 314.644)" fill="#f0f0f0"/>
                            <path id="Path_596" data-name="Path 596" d="M401.177,240.816a41.042,41.042,0,0,1,32.977,16.565l23.683-30.966-71.061-54.349-54.349,71.061,30.627,23.424a41.108,41.108,0,0,1,38.123-25.735Z" transform="translate(-227.941 -172.066)" fill="#f0f0f0"/>
                            <path id="Path_597" data-name="Path 597" d="M1100.728,728.352H247.209a1.209,1.209,0,1,1,0-2.418h853.519a1.209,1.209,0,0,1,0,2.418Z" transform="translate(-246 -56.335)" fill="#3f3d56"/>
                            <path id="Path_598" data-name="Path 598" d="M797.792,567.222H710.915a12.1,12.1,0,0,1-12.089-12.09v-6.018a12.1,12.1,0,0,1,12.089-12.09h86.878a12.1,12.1,0,0,1,12.089,12.09v6.018A12.1,12.1,0,0,1,797.792,567.222Z" transform="translate(-151.382 -95.808)" fill="#8d1d25"/>
                            <path id="Path_599" data-name="Path 599" d="M805.469,557.835H718.591A12.708,12.708,0,0,1,705.9,545.141v-6.018a12.709,12.709,0,0,1,12.694-12.694h86.878a12.709,12.709,0,0,1,12.694,12.694v6.018a12.708,12.708,0,0,1-12.694,12.694Zm-86.878-28.988a10.288,10.288,0,0,0-10.276,10.276v6.018a10.288,10.288,0,0,0,10.276,10.276h86.878a10.288,10.288,0,0,0,10.276-10.276v-6.018a10.288,10.288,0,0,0-10.276-10.276Z" transform="translate(-149.904 -98.022)" fill="#3f3d56"/>
                        </g>
            </svg>
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
                <a><h4>+65 9123 1923</h4></a>
                <a href="mailto:tp@tp.com"><h4>tp@tp.com</h4></a>
                


            </div>

            <div class="linkcol">
                <h3>Make us Famous</h3>
                <a href="https://www.facebook.com/iu.loen"><i class="fab fa-facebook-f"></i></a>
                <a href="https://www.instagram.com/dlwlrma/"><i class="fab fa-instagram"></i></a>
                <a href="https://twitter.com/_iuofficial?lang=en"><i class="fab fa-twitter"></i></a>
                <a href="https://www.pinterest.com/search/pins/?q=iu&rs=typed&term_meta[]=iu%7Ctyped"><i class="fab fa-pinterest"></i></a>
                
                
            </div>

            <div class="linkcol">
                <a href="#"><p>SUBSCRIBE</p></a>
                <a href="#"><p>OUR TEAM</p></a>
                
            </div>
        </div>

    </div>

</div>

</div>

<script>
var show = document.getElementById('nav-links');
function showMenu(){
show.style.display='block';

show.style.right='0';
}

function closeMenu(){
show.style.right='-200px';
}

</script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

</body>
</html>
<?php
//check for error
if (isset($_GET["error"])) {
    if ($_GET["error"] == "shippingaddressemptyinput") {
        echo "<p>Fill in Shipping Address fields!</p>";
    } else if ($_GET["error"] == "invalidemail") {
        echo "<p>Choose a proper email!</p>";
        exit();
    } else if ($_GET["error"] == "invalidpostalcode") {
        echo "<p>Invalid Postal Code</p>";
        exit();
    } else if ($_GET["error"] == "stmtfailed") {
        echo "<p>Something went wrong, try again!</p>";
    } else if ($_GET["error"] == "none") {
        echo "<p>Successfully Edit Shipping Address</p>";
        header("location: ../swapproj/checkout/editshippingaddress?=success");
    } else if ($_GET["type"] == "success") {
        echo "Records were updated successfully.";
        header("location: https://www.swapamc.com/swapproj/checkout/editshippingaddress?type=success");
    }
}

ob_flush();
//     }
// }
?>
