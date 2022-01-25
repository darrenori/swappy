<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/auth/pages.php';

$jwtarray = jwtdecrypt();
if (isset($jwtarray) && $jwtarray == true) {

    ## use $jwtinformation["key"] to retrieve the values 
    ## keys and values can be viewed on campus.php page
    $jwtarrayinformation = $jwtarray['array'];


    //checks if user has begun login process and that session is stable. 

    if (!isset($jwtarrayinformation['loginstate'])) {
        header("location: https://www.swapamc.com/swapproj/login");
        exit();
    } elseif ($jwtarrayinformation['loginstate'] === "A") {
        header("location: https://www.swapamc.com/swapproj/emailverification");
        exit();
    } elseif ($jwtarrayinformation['loginstate'] === "OK" and isset($jwtarrayinformation['username'])) {
        header("location: https://www.swapamc.com/swapproj/campus");
        exit();
    } elseif ($jwtarrayinformation['loginstate'] === "Z") {
        ////Here is the code for right after sign up
        require_once 'includes/dbh.inc.php';
        require_once 'includes/functions.inc.php';
        require 'googleauth/vendor/autoload.php';

        $username = $jwtarrayinformation['username'];

        $uidExists = uidExists($conn, $username, $username);

        //GOOGLE AUTH QR CODE GENERATED
        session_start();
        
        $_SESSION['usersecret'] = $uidExists['user_secret'];
        // $jwtarrayinformation['usersecret'] = $uidExists['user_secret'];
        session_regenerate_id();

        

        
        $randomsecret = $_SESSION['usersecret'];
        // jwtupdate($jwtarrayinformation);

        //Generates the qr code and puts it in html
        $link = \Sonata\GoogleAuthenticator\GoogleQrUrl::generate($uidExists['user_username'], $randomsecret, 'swapamc.com');

?>
        <!-- here's code to prevent back button -->
        <script type="text/javascript">
            function preventBack() {
                window.history.forward();
            }
            setTimeout("preventBack()", 0);
            window.onunload = function() {
                null
            };
        </script>
        <section class="signup-form">
            <h2>OTP for user <?php $username ?></h2>

            <form action="/swapproj/googleauthenticationinc" method="post">
                <center>
                    <img src="<?= $link; ?>"><br>
                    <label for="googleautotp">Enter Code Here:</label><br>
                    <input type="text" id="googleauthotp" name="googleauthotp" placeholder="Enter Code">
                    <br><br>
                    <input type="submit" value="submit" name="submit">
                </center>
            </form>



        </section>
<?php



        exit();
    } elseif ($jwtarrayinformation['loginstate'] !== "B") {
        header("location: https://www.swapamc.com/swapproj/logout");
        exit();
    }

    /////THIS is the code if user accesses page through the login page


    echo "<h3 style='color:white'> PHP List All JWT Session Variables</h3>";
    foreach ($jwtarrayinformation as $key => $val)
        echo "<p style='color:white'>" .$key . " " . $val . "</p>";
    require_once 'includes/dbh.inc.php';
    require_once 'includes/functions.inc.php';
    require 'googleauth/vendor/autoload.php';

    //All is required for login is the username for user to identify code from google auth code.
    $username = $jwtarrayinformation['username'];

    $uidExists = uidExists($conn, $username, $username);

    //GOOGLE AUTH QR CODE GENERATED
    // $jwtarrayinformation['usersecret'] = $uidExists['user_secret'];
    // $randomsecret = $jwtarrayinformation['usersecret'];

    // jwtupdate($jwtarrayinformation);
} else {

    header("location: https://www.swapamc.com/swapproj/logout");
    exit();
}



?>
<script type="text/javascript">
    function preventBack() {
        window.history.forward();
    }
    setTimeout("preventBack()", 0);
    window.onunload = function() {
        null
    };
</script>
<!-- <section class="signup-form">
    <h2>OTP for user <?php $username ?></h2>

    <form action="/swapproj/googleauthenticationinc" method="post">
        <center>
            <label for="googleautotp">Enter Code Here:</label><br>
            <input type="text" id="googleauthotp" name="googleauthotp" placeholder="Enter Code">
            <br><br>
            <input type="submit" value="submit" name="submit">
        </center>
    </form>



</section> -->










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

    

    .nav-bar {
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
        

    }

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



    @media(max-width:900px){

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
        padding: 100px 20px;
         width:120%;
        margin:auto;
         display: flex;
         justify-content: center;
        align-items: center;
        flex-direction: row;
    
    }
    .thing{
    padding: 2em;
    font-family: Montserrat;
    font-weight: bold;
    width:100%;
    margin:auto;
   
    
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
<div class='hero'>
    
  
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

    <div class="container">                      
            <div class="thing">
                <section style="font-family:Montserrat; color:white; align-content:center;" class="signup-form">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="70" height="70" viewBox="0 0 105.367 105.367">
                <defs>
                    <linearGradient id="linear-gradient" x1="1.363" y1="-0.243" x2="0.149" y2="0.921" gradientUnits="objectBoundingBox">
                    <stop offset="0" stop-color="#e26565"/>
                    <stop offset="1" stop-color="#8d1d25"/>
                    </linearGradient>
                </defs>
                <path id="Exclusion_11" data-name="Exclusion 11" d="M73.3,105.367H68.718V91.624H73.3v13.743Zm-9.162,0H59.555V91.624h4.582v13.743Zm-9.164,0h-4.58V91.624h4.58v13.743Zm-9.162,0h-4.58V91.624h4.58v13.743Zm-9.162,0h-4.58V91.624h4.58v13.743ZM77.88,87.042H27.487a9.173,9.173,0,0,1-9.162-9.162V27.487a9.173,9.173,0,0,1,9.162-9.162H77.88a9.173,9.173,0,0,1,9.162,9.162V77.88A9.173,9.173,0,0,1,77.88,87.042ZM52.35,76.876a1.414,1.414,0,0,1,.549.116c.644.268.81.76,1.062,1.5.044.131.091.27.144.417h1.924c.051-.143.1-.277.14-.406.253-.75.42-1.245,1.069-1.514a1.427,1.427,0,0,1,.546-.115,3,3,0,0,1,1.27.433c.122.061.251.125.389.19l1.364-1.361c-.065-.138-.128-.264-.189-.387-.352-.709-.584-1.177-.315-1.824s.767-.816,1.52-1.07c.126-.042.259-.087.4-.137V70.8c-.145-.052-.281-.1-.411-.142-.747-.252-1.24-.418-1.507-1.063s-.036-1.119.319-1.832c.059-.119.121-.244.185-.378l-1.364-1.362c-.134.064-.259.127-.378.186a2.994,2.994,0,0,1-1.279.436,1.421,1.421,0,0,1-.551-.117c-.646-.268-.812-.758-1.062-1.5-.044-.131-.091-.27-.144-.418H54.1c-.051.143-.1.278-.14.407-.252.748-.419,1.243-1.066,1.512a1.413,1.413,0,0,1-.55.117,3,3,0,0,1-1.277-.436c-.12-.06-.246-.123-.38-.187l-1.364,1.362c.065.136.127.262.188.384.353.71.586,1.178.318,1.826s-.761.812-1.507,1.063c-.13.044-.268.09-.413.142v1.927c.14.05.273.095.4.137.753.253,1.251.42,1.521,1.066s.036,1.121-.319,1.832c-.06.12-.123.246-.187.379L50.691,77.5c.135-.064.259-.126.38-.186A3.007,3.007,0,0,1,52.35,76.876Zm15.789-7.83a1.885,1.885,0,0,1,.73.154c.863.357,1.085,1.016,1.421,2.015.058.171.119.353.187.544h2.566c.067-.187.126-.364.183-.534.338-1,.56-1.667,1.429-2.028a1.894,1.894,0,0,1,.729-.154,3.983,3.983,0,0,1,1.689.575c.168.084.338.168.523.256l1.816-1.816c-.087-.184-.171-.354-.253-.518-.467-.944-.776-1.567-.419-2.427s1.025-1.089,2.033-1.427c.168-.056.342-.115.526-.18V60.938c-.191-.068-.369-.128-.542-.186-1-.337-1.659-.559-2.017-1.419s-.049-1.486.42-2.431c.08-.162.165-.333.252-.516l-1.816-1.817c-.177.085-.342.167-.5.246a4.024,4.024,0,0,1-1.713.583,1.893,1.893,0,0,1-.731-.154c-.862-.357-1.084-1.017-1.42-2.016-.058-.171-.118-.352-.186-.543H70.476c-.068.191-.128.37-.186.542-.336,1-.558,1.658-1.421,2.017a1.885,1.885,0,0,1-.733.155,3.994,3.994,0,0,1-1.7-.58c-.16-.08-.33-.165-.512-.251l-1.817,1.817c.087.182.17.351.251.514.47.946.78,1.571.422,2.433s-1.018,1.084-2.016,1.419c-.173.058-.352.118-.543.186v2.568c.186.066.36.124.529.181,1.006.337,1.67.56,2.03,1.423s.049,1.491-.422,2.435c-.081.163-.165.331-.251.513l1.817,1.816c.181-.086.347-.169.508-.249A4.018,4.018,0,0,1,68.139,69.047Zm-31.5-7.825a4,4,0,0,1,1.554.329c1.836.76,2.307,2.164,3.021,4.288.123.368.25.746.393,1.149h5.458c.143-.4.27-.778.392-1.142.715-2.126,1.187-3.531,3.034-4.3a3.991,3.991,0,0,1,1.549-.329,8.478,8.478,0,0,1,3.591,1.222c.353.175.715.355,1.108.542L60.6,59.121c-.186-.391-.365-.753-.539-1.1-.994-2-1.651-3.324-.894-5.156s2.166-2.3,4.293-3.016c.366-.123.745-.25,1.148-.394v-5.46c-.407-.145-.788-.273-1.156-.4-2.121-.714-3.521-1.186-4.281-3.015s-.1-3.164.9-5.176c.171-.343.347-.7.53-1.082l-3.858-3.861c-.386.184-.744.361-1.089.533a8.488,8.488,0,0,1-3.613,1.227,4.015,4.015,0,0,1-1.559-.329c-1.833-.76-2.3-2.162-3.018-4.285-.123-.367-.251-.746-.395-1.151h-5.46c-.144.4-.271.783-.394,1.15C40.5,29.73,40.03,31.133,38.2,31.892a4.032,4.032,0,0,1-1.561.331A8.49,8.49,0,0,1,33.033,31c-.349-.174-.709-.352-1.1-.537l-3.855,3.861c.185.389.363.748.535,1.095,1,2.006,1.655,3.331.9,5.163s-2.163,2.3-4.284,3.016c-.368.124-.749.252-1.155.4V49.45c.406.145.787.273,1.156.4,2.121.714,3.522,1.186,4.28,3.015s.1,3.163-.893,5.164c-.173.348-.352.707-.536,1.094l3.857,3.861c.391-.185.752-.364,1.1-.538A8.483,8.483,0,0,1,36.639,61.222Zm18.429,12.92a2.384,2.384,0,1,1,2.385-2.383A2.387,2.387,0,0,1,55.068,74.142Zm50.3-.843H91.624V68.718h13.743V73.3Zm-91.623,0H0V68.718H13.744V73.3Zm58.015-7.9a3.178,3.178,0,1,1,3.178-3.178A3.182,3.182,0,0,1,71.759,65.4Zm33.608-1.262H91.624V59.555h13.743v4.582Zm-91.623,0H0V59.555H13.744v4.582Zm91.623-9.164H91.624v-4.58h13.743v4.58Zm-91.623,0H0v-4.58H13.744v4.58ZM44.338,53.48a6.757,6.757,0,1,1,6.756-6.757A6.763,6.763,0,0,1,44.338,53.48Zm61.029-7.668H91.624v-4.58h13.743v4.58Zm-91.623,0H0v-4.58H13.744v4.58Zm91.623-9.162H91.624v-4.58h13.743v4.58Zm-91.623,0H0v-4.58H13.744v4.58ZM73.3,13.744H68.718V0H73.3V13.744Zm-9.162,0H59.555V0h4.582V13.744Zm-9.164,0h-4.58V0h4.58V13.744Zm-9.162,0h-4.58V0h4.58V13.744Zm-9.162,0h-4.58V0h4.58V13.744Z" fill="url(#linear-gradient)"/>
                </svg>
                <h1>OTP for user <?php $username ?></h1>
                <form action="/swapproj/googleauthenticationinc" method="post">
                    <label for="googleautotp">Enter Code Here:</label><br>
                    <input type="text" id="googleauthotp" name="googleauthotp" placeholder="Enter Code">
                    <br><br>
                    <input type="submit" value="submit" name="submit">

                </form>
            </div>
                 
    </div>
<script type="text/javascript">
    function preventBack() {
        window.history.forward();
    }
    setTimeout("preventBack()", 0);
    window.onunload = function() {
        null
    };
</script>



<br><br><br><br><br>
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