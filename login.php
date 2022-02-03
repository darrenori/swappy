
<html>

<head>
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>
</head>

</html>
<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/auth/pages.php';

$csrf = generateCSRF();

date_default_timezone_set('Asia/Singapore');
    $time = time();

//session started
$jwtarray = jwtdecrypt();

if (isset($jwtarray) && $jwtarray == true) {
    ## use $jwtinformation["key"] to retrieve the values 
    ## keys and values can be viewed on campus.php page
    $jwtarrayinformation = $jwtarray['array'];
    if (isset($jwtarray) && $jwtarray == true) {

        ## use $jwtinformation["key"] to retrieve the values 
        ## keys and values can be viewed on campus.php page
        $jwtarrayinformation = $jwtarray['array'];

        if (isset($jwtarrayinformation['loginstate'])) {
            if ($jwtarrayinformation['loginstate'] === "A") {
                header("location: https://www.swapamc.com/swapproj/emailverification");
                exit();
            } elseif ($jwtarrayinformation['loginstate'] === "B" || $jwtarrayinformation['loginstate'] === "Z") {
                header("location: https://www.swapamc.com/swapproj/googleauthentication");
                exit();
            } elseif ($jwtarrayinformation['loginstate'] === "OK" and isset($jwtarrayinformation['username'])) {
                header("location: https://www.swapamc.com/swapproj/campus");
                exit();
            } else {
                header("location: https://www.swapamc.com/swapproj/logout");
                exit();
            }
        }
    }
} // include_once 'header.php';



?>



<html>
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<style type="text/css">
  *{
        margin:0;
        padding:0;
        font-family:sans-serif;
    }
    body {
        background:black;
        overflow:hidden;
        
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
           align-content: center;
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

.cursor {
    position:fixed;
    width:3rem;
    height:3rem;
    border: 2px solid white;
    border-radius:50%;
    
    transform:translate(-50%,-50%);
    pointer-events:none;
    transition:0.1s;
    transition:all 0.5s ease;
    transition-property: width, height;
    /* transform-origin:100% 100%; */ 
    z-index: 100;

}

.link-grow {
    width:10rem;
    height:10rem;
    border: 2px dashed white;
    animation: animate 5s linear infinite;
    background:rgba(0,0,0, 0.3);

}
    

@keyframes animate {
    0%
    {
        transform: translate(-50%,-50%) rotate(0deg);
    }

    100%
    {
        transform: translate(-50%,-50%) rotate(360deg);
    }


}
   
    .container{
        background-color: rgba(255,255,255,0.3);
        padding:30px 0;
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

::placeholder{
    padding-left: 0.5vw;
}
</style>
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
         integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
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


    <div class='nav-bar'>
        <div class='nav-logo'>
            <img src="https://drive.google.com/uc?export=view&id=1sDaIqkxjzSkJAbI0nhS-gd2Roe3VlHXL" class='logo'>
            
        </div>

        <div class='nav-links' id='nav-links'>
            <i class="fas fa-arrow-circle-left" onclick="closeMenu()" style="color:white"></i>

            <ul>
                <a href="https://www.swapamc.com/swapproj/home/"><li>HOME</li></a>
                <a href="https://www.swapamc.com/swapproj/faq"><li>FAQs</li></a>
                <a href="#"><li>PRODUCTS</li></a>
                
            </ul>
        </div>
        <i class="fas fa-bars menu-icon" onclick="showMenu()" style="color:white"></i>

    </div>
    <div class="ballshape">
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
    <div class="ballshape2">
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
                        <svg class="animated" id="freepik_stories-friendly-handshake" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 500" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs"><style>svg#freepik_stories-friendly-handshake:not(.animated) .animable {opacity: 0;}svg#freepik_stories-friendly-handshake.animated #freepik--Plant--inject-141 {animation: 3s Infinite  linear wind;animation-delay: 0s;}svg#freepik_stories-friendly-handshake.animated #freepik--character-2--inject-141 {animation: 3s Infinite  linear floating;animation-delay: 0s;}svg#freepik_stories-friendly-handshake.animated #freepik--character-1--inject-141 {animation: 3s Infinite  linear floating;animation-delay: 0s;}            @keyframes wind {                0% {                    transform: rotate( 0deg );                }                25% {                    transform: rotate( 1deg );                }                75% {                    transform: rotate( -1deg );                }            }                    @keyframes floating {                0% {                    opacity: 1;                    transform: translateY(0px);                }                50% {                    transform: translateY(-10px);                }                100% {                    opacity: 1;                    transform: translateY(0px);                }            }        </style><g id="freepik--background-complete--inject-141" class="animable" style="transform-origin: 250px 228.23px;"><rect x="416.78" y="398.49" width="33.12" height="0.25" style="fill: rgb(235, 235, 235); transform-origin: 433.34px 398.615px;" id="el0cm8ob4z76hb" class="animable"></rect><rect x="322.53" y="401.21" width="8.69" height="0.25" style="fill: rgb(235, 235, 235); transform-origin: 326.875px 401.335px;" id="elkjkeq6mnpph" class="animable"></rect><rect x="396.59" y="389.21" width="19.19" height="0.25" style="fill: rgb(235, 235, 235); transform-origin: 406.185px 389.335px;" id="elwp035glgpid" class="animable"></rect><rect x="52.46" y="390.89" width="43.19" height="0.25" style="fill: rgb(235, 235, 235); transform-origin: 74.055px 391.015px;" id="elu0vfa2xofkh" class="animable"></rect><rect x="104.56" y="390.89" width="6.33" height="0.25" style="fill: rgb(235, 235, 235); transform-origin: 107.725px 391.015px;" id="elqx5wr8s9cw" class="animable"></rect><rect x="131.47" y="395.11" width="93.68" height="0.25" style="fill: rgb(235, 235, 235); transform-origin: 178.31px 395.235px;" id="elso94stbk6j" class="animable"></rect><path d="M238.4,337.8H45.3a5.71,5.71,0,0,1-5.71-5.71V60.66A5.71,5.71,0,0,1,45.3,55H238.4a5.71,5.71,0,0,1,5.71,5.71V332.09A5.71,5.71,0,0,1,238.4,337.8ZM45.3,55.2a5.47,5.47,0,0,0-5.46,5.46V332.09a5.47,5.47,0,0,0,5.46,5.46H238.4a5.47,5.47,0,0,0,5.46-5.46V60.66a5.47,5.47,0,0,0-5.46-5.46Z" style="fill: rgb(235, 235, 235); transform-origin: 141.85px 196.4px;" id="elu0n4j5ncf9f" class="animable"></path><path d="M454.7,337.8H261.6a5.71,5.71,0,0,1-5.71-5.71V60.66A5.71,5.71,0,0,1,261.6,55H454.7a5.71,5.71,0,0,1,5.71,5.71V332.09A5.71,5.71,0,0,1,454.7,337.8ZM261.6,55.2a5.47,5.47,0,0,0-5.46,5.46V332.09a5.47,5.47,0,0,0,5.46,5.46H454.7a5.47,5.47,0,0,0,5.46-5.46V60.66a5.47,5.47,0,0,0-5.46-5.46Z" style="fill: rgb(235, 235, 235); transform-origin: 358.15px 196.4px;" id="elj683n0jpt7" class="animable"></path><rect y="382.4" width="500" height="0.25" style="fill: rgb(235, 235, 235); transform-origin: 250px 382.525px;" id="elouidilwibsr" class="animable"></rect><rect x="284.82" y="94.37" width="162.04" height="288.02" style="fill: rgb(250, 250, 250); transform-origin: 365.84px 238.38px;" id="elr4tvgbztcd" class="animable"></rect><rect x="296.81" y="118.34" width="141.2" height="264.05" style="fill: rgb(235, 235, 235); transform-origin: 367.41px 250.365px;" id="elri7pyqthxuo" class="animable"></rect><rect x="368.2" y="123.55" width="66.43" height="253.63" style="fill: rgb(250, 250, 250); transform-origin: 401.415px 250.365px;" id="eln111qo9dxv" class="animable"></rect><rect x="300.2" y="124.06" width="66.43" height="253.63" style="fill: rgb(250, 250, 250); transform-origin: 333.415px 250.875px;" id="elpm6eqotc40g" class="animable"></rect><rect x="355.68" y="101.15" width="21.37" height="7.29" style="fill: rgb(240, 240, 240); transform-origin: 366.365px 104.795px;" id="elxx1xfdzp49" class="animable"></rect><rect x="52.34" y="94.37" width="162.04" height="288.02" style="fill: rgb(250, 250, 250); transform-origin: 133.36px 238.38px;" id="elr7afylnay4f" class="animable"></rect><rect x="64.32" y="118.34" width="141.2" height="264.05" style="fill: rgb(235, 235, 235); transform-origin: 134.92px 250.365px;" id="el320lfze9kik" class="animable"></rect><rect x="135.71" y="123.55" width="66.43" height="253.63" style="fill: rgb(250, 250, 250); transform-origin: 168.925px 250.365px;" id="elfw2tr3sv26g" class="animable"></rect><rect x="67.71" y="124.06" width="66.43" height="253.63" style="fill: rgb(250, 250, 250); transform-origin: 100.925px 250.875px;" id="elgomi5xsivmb" class="animable"></rect><rect x="123.19" y="101.15" width="21.37" height="7.29" style="fill: rgb(240, 240, 240); transform-origin: 133.875px 104.795px;" id="elgx1ejs76x2" class="animable"></rect><rect x="239.99" y="190.54" width="19.22" height="37.04" style="fill: rgb(230, 230, 230); transform-origin: 249.6px 209.06px;" id="el9i9ryvapwqg" class="animable"></rect><path d="M249.81,198.38a6,6,0,1,1-6,6A6,6,0,0,1,249.81,198.38Z" style="fill: rgb(245, 245, 245); transform-origin: 249.81px 204.38px;" id="elvatnotllsmd" class="animable"></path><polygon points="253.03 205.37 246.6 205.37 249.92 200.85 253.03 205.37" style="fill: rgb(230, 230, 230); transform-origin: 249.815px 203.11px;" id="el411g3zg9ef9" class="animable"></polygon><path d="M249.81,211.18a6,6,0,1,1-6,6A6,6,0,0,1,249.81,211.18Z" style="fill: rgb(245, 245, 245); transform-origin: 249.81px 217.18px;" id="eljqy7oe49bvl" class="animable"></path><polygon points="253.03 215.64 246.6 215.64 249.92 220.17 253.03 215.64" style="fill: rgb(230, 230, 230); transform-origin: 249.815px 217.905px;" id="elwuuqb02ij5" class="animable"></polygon><path d="M230.36,263.16H269.8a0,0,0,0,1,0,0V379.72a2.68,2.68,0,0,1-2.68,2.68H233a2.68,2.68,0,0,1-2.68-2.68V263.16A0,0,0,0,1,230.36,263.16Z" style="fill: rgb(235, 235, 235); transform-origin: 250.06px 322.78px;" id="eltkfxvb2xw4" class="animable"></path><ellipse cx="250.68" cy="290.68" rx="13.21" ry="7.56" style="fill: rgb(224, 224, 224); transform-origin: 250.68px 290.68px;" id="elto8dwnqnx5" class="animable"></ellipse><path d="M231.67,261.26h37.25a2.58,2.58,0,0,1,2.58,2.58v7a0,0,0,0,1,0,0H229.09a0,0,0,0,1,0,0v-7A2.58,2.58,0,0,1,231.67,261.26Z" style="fill: rgb(245, 245, 245); transform-origin: 250.295px 266.05px;" id="elixu7n0lwcxi" class="animable"></path><path d="M233.39,271.77c-.4,0-.71.64-.71,1.43v106c0,.78.31,1.42.71,1.42s.71-.64.71-1.42v-106C234.1,272.41,233.78,271.77,233.39,271.77Z" style="fill: rgb(250, 250, 250); transform-origin: 233.39px 326.195px;" id="eln8mnb9bbgl" class="animable"></path></g><g id="freepik--Shadow--inject-141" class="animable" style="transform-origin: 250px 415.69px;"><ellipse id="freepik--path--inject-141" cx="250" cy="415.69" rx="193.89" ry="11.32" style="fill: rgb(245, 245, 245); transform-origin: 250px 415.69px;" class="animable"></ellipse></g><g id="freepik--Plant--inject-141" class="animable animator-active" style="transform-origin: 250.158px 367.861px;"><path d="M247,366.24a.49.49,0,0,1-.49-.42c0-.11-2-11.8-9.15-18.36-5.76-5.27-11.66-16.82-11.91-17.31a.49.49,0,0,1,.22-.67.5.5,0,0,1,.67.22c.06.12,6.07,11.88,11.69,17,7.43,6.79,9.38,18.44,9.46,18.93a.51.51,0,0,1-.41.58Z" style="fill: rgb(38, 50, 56); transform-origin: 236.445px 347.833px;" id="elxfi55nno4f" class="animable"></path><path d="M238.85,350.41s-7.62-1.85-5,3.7,8.73,3.17,8.73,3.17,5.19-4.1,2.54-9S238.85,350.41,238.85,350.41Z" style="fill: rgb(141, 29, 37); transform-origin: 239.588px 352.166px;" id="elr0rhf81pq5b" class="animable"></path><g id="eldjve73kn02"><path d="M245.15,348.23c-2.65-5-6.3,2.18-6.3,2.18s-.55,3.57,3.76,6.87C242.61,357.28,247.8,353.18,245.15,348.23Z" style="opacity: 0.1; transform-origin: 242.365px 351.87px;" class="animable"></path></g><path d="M226.21,330s-4.83-5.33-5,.07,5.15,6.86,5.15,6.86,5.26-.24,5.16-5.21S226.21,330,226.21,330Z" style="fill: rgb(141, 29, 37); transform-origin: 226.364px 332.291px;" id="elzja4u1n3s4" class="animable"></path><g id="elhppzjvey93h"><path d="M231.57,331.69c-.11-5-5.36-1.72-5.36-1.72s-1.7,2.29.2,6.93C226.41,336.9,231.67,336.66,231.57,331.69Z" style="opacity: 0.1; transform-origin: 228.541px 332.907px;" class="animable"></path></g><path d="M232.33,340s-1.9-7.52,2.21-5.29,2.92,8.53,2.92,8.53-2.48,5.55-6.17,3.28S232.33,340,232.33,340Z" style="fill: rgb(141, 29, 37); transform-origin: 233.751px 340.681px;" id="el2sbh5ir570q" class="animable"></path><g id="elc12vowr4ays"><path d="M231.29,346.55c-3.7-2.28,1-6.52,1-6.52s2.47-.83,5.13,3.24C237.46,343.27,235,348.82,231.29,346.55Z" style="opacity: 0.1; transform-origin: 233.645px 343.528px;" class="animable"></path></g><path d="M253.33,366.24a.32.32,0,0,1-.14,0,.49.49,0,0,1-.34-.62c.13-.44,3.23-10.78,11-16.63a39.22,39.22,0,0,0,11-12.78.49.49,0,0,1,.66-.24.5.5,0,0,1,.24.67,39.6,39.6,0,0,1-11.28,13.14c-7.51,5.66-10.62,16-10.65,16.12A.51.51,0,0,1,253.33,366.24Z" style="fill: rgb(38, 50, 56); transform-origin: 264.313px 351.084px;" id="elpur5wd5awon" class="animable"></path><path d="M251.89,366.24a.5.5,0,0,1-.5-.47c0-.09-.56-9.08-1.15-17.5s-3.59-13-3.62-13a.49.49,0,0,1,.15-.69.5.5,0,0,1,.69.15c.13.2,3.18,5,3.78,13.52s1.15,17.42,1.15,17.51a.5.5,0,0,1-.47.53Z" style="fill: rgb(38, 50, 56); transform-origin: 249.464px 350.395px;" id="elcrgf56yoynt" class="animable"></path><path d="M250.1,342s-2.22-5.84,3.19-4.33,3.54,6.57,3.54,6.57-3.55,4.54-8.4,3S250.1,342,250.1,342Z" style="fill: rgb(141, 29, 37); transform-origin: 251.889px 342.49px;" id="el90bpt6zdqvw" class="animable"></path><g id="elrr19aixc4hi"><path d="M248.43,347.25c-4.85-1.58,1.67-5.21,1.67-5.21a7.86,7.86,0,0,1,6.73,2.24S253.28,348.82,248.43,347.25Z" style="opacity: 0.1; transform-origin: 251.733px 344.768px;" class="animable"></path></g><path d="M271.24,343s-2.22-5.83,3.2-4.32,3.54,6.57,3.54,6.57-3.56,4.54-8.41,3S271.24,343,271.24,343Z" style="fill: rgb(141, 29, 37); transform-origin: 273.036px 343.5px;" id="el07nbvsig22xx" class="animable"></path><g id="el2qsodr396ac"><path d="M269.57,348.25c-4.85-1.57,1.67-5.21,1.67-5.21a7.91,7.91,0,0,1,6.74,2.25S274.42,349.83,269.57,348.25Z" style="opacity: 0.1; transform-origin: 272.878px 345.771px;" class="animable"></path></g><path d="M259.06,355.56s-1.08-6.28,3.92-3.37,2.23,7.34,2.23,7.34-4.31,3.49-8.75.67S259.06,355.56,259.06,355.56Z" style="fill: rgb(141, 29, 37); transform-origin: 260.483px 356.36px;" id="elbkjwqjys649" class="animable"></path><g id="el0ockugmahqt"><path d="M256.46,360.2c-4.43-2.82,2.6-4.64,2.6-4.64s3.41.09,6.15,4C265.21,359.53,260.9,363,256.46,360.2Z" style="opacity: 0.1; transform-origin: 260.103px 358.426px;" class="animable"></path></g><path d="M250.67,352.09s-1.51-4,2.18-2.95a3.31,3.31,0,0,1,2.41,4.47s-2.42,3.1-5.73,2S250.67,352.09,250.67,352.09Z" style="fill: rgb(141, 29, 37); transform-origin: 251.901px 352.405px;" id="el079rhweh1lte" class="animable"></path><g id="elkq36p2oy4gp"><path d="M249.53,355.64c-3.31-1.07,1.14-3.55,1.14-3.55a5.37,5.37,0,0,1,4.59,1.52S252.84,356.71,249.53,355.64Z" style="opacity: 0.1; transform-origin: 251.783px 353.948px;" class="animable"></path></g><path d="M247.38,334.61s1.9-6.08-2.5-4.38-3,6.87-3,6.87,2.79,4.59,6.73,2.85S247.38,334.61,247.38,334.61Z" style="fill: rgb(141, 29, 37); transform-origin: 245.879px 335.137px;" id="elvy9xogo15er" class="animable"></path><g id="elf26e4yg9zkv"><path d="M248.64,340c4-1.75-1.26-5.34-1.26-5.34s-2.68-.76-5.47,2.49C241.91,337.1,244.7,341.69,248.64,340Z" style="opacity: 0.1; transform-origin: 246.026px 337.478px;" class="animable"></path></g><path d="M275,334.11s-2.16-3.79,1.1-3.51,3,4.12,3,4.12-1.27,3.72-4.23,3.31S275,334.11,275,334.11Z" style="fill: rgb(141, 29, 37); transform-origin: 276.346px 334.323px;" id="elk08w0dgs1d" class="animable"></path><g id="els0zdvvs1e8f"><path d="M274.88,338c-3-.4.12-3.92.12-3.92s1.73-1.06,4.11.61C279.11,334.72,277.84,338.44,274.88,338Z" style="opacity: 0.1; transform-origin: 276.344px 335.892px;" class="animable"></path></g><path d="M265.31,347.35s7.71-1.26,3.68-5.45-9.12.44-9.12.44-3.77,5.92.1,9.55S265.31,347.35,265.31,347.35Z" style="fill: rgb(141, 29, 37); transform-origin: 264.19px 346.483px;" id="eltjetxv1bum" class="animable"></path><g id="ell6b46w1ty9e"><path d="M260,351.89c3.87,3.63,5.34-4.54,5.34-4.54s-.46-3.59-5.44-5C259.87,342.34,256.1,348.26,260,351.89Z" style="opacity: 0.1; transform-origin: 261.787px 347.585px;" class="animable"></path></g><path d="M245.61,357.85s-1.9-7.53,2.21-5.3,2.92,8.54,2.92,8.54-2.48,5.55-6.17,3.27S245.61,357.85,245.61,357.85Z" style="fill: rgb(141, 29, 37); transform-origin: 247.031px 358.523px;" id="eldx2m9fud8mp" class="animable"></path><g id="eligs0m9gkpih"><path d="M244.57,364.36c-3.7-2.28,1-6.51,1-6.51s2.46-.84,5.13,3.24C250.74,361.09,248.26,366.64,244.57,364.36Z" style="opacity: 0.1; transform-origin: 246.925px 361.344px;" class="animable"></path></g><path d="M234.41,403v5h4A2.48,2.48,0,0,1,241,405.8h20.56a2.48,2.48,0,0,1,2.64,2.27h4v-5Z" style="fill: rgb(38, 50, 56); transform-origin: 251.305px 405.535px;" id="elw9n30a1k54" class="animable"></path><path d="M267.93,403.53h-33.3c-2.57,0-4.76-5-5.15-11.9l-1.41-24.45a2.75,2.75,0,0,1,2.75-2.91h40.92a2.74,2.74,0,0,1,2.75,2.91l-1.4,24.45C272.69,398.48,270.5,403.53,267.93,403.53Z" style="fill: rgb(38, 50, 56); transform-origin: 251.28px 383.9px;" id="elr7arlll61i" class="animable"></path><g id="elr88s12gli3h"><path d="M267.93,403.53h-33.3c-2.57,0-4.76-5-5.15-11.9l-1.41-24.45a2.75,2.75,0,0,1,2.75-2.91h40.92a2.74,2.74,0,0,1,2.75,2.91l-1.4,24.45C272.69,398.48,270.5,403.53,267.93,403.53Z" style="fill: rgb(255, 255, 255); opacity: 0.2; transform-origin: 251.28px 383.9px;" class="animable"></path></g></g><g id="freepik--Lines--inject-141" class="animable" style="transform-origin: 245.052px 155.205px;"><path d="M245.05,157.66a.5.5,0,0,1-.5-.5v-9.85a.5.5,0,0,1,.5-.5.5.5,0,0,1,.5.5v9.85A.5.5,0,0,1,245.05,157.66Z" style="fill: rgb(141, 29, 37); transform-origin: 245.05px 152.235px;" id="el4r6ffxbqb52" class="animable"></path><path d="M233.12,159.9a.52.52,0,0,1-.38-.17L229,155.29a.5.5,0,1,1,.76-.64l3.77,4.43a.51.51,0,0,1-.06.71A.54.54,0,0,1,233.12,159.9Z" style="fill: rgb(141, 29, 37); transform-origin: 231.245px 157.164px;" id="ela0cdnlomt0s" class="animable"></path><path d="M236.26,163.6a.48.48,0,0,1-.38-.18l-1.12-1.31a.5.5,0,0,1,.76-.65l1.12,1.32a.5.5,0,0,1-.38.82Z" style="fill: rgb(141, 29, 37); transform-origin: 235.698px 162.443px;" id="el9tzvh2hmk3p" class="animable"></path><path d="M253.92,163.52a.5.5,0,0,1-.38-.82l4.2-4.95a.5.5,0,1,1,.76.65l-4.2,4.94A.49.49,0,0,1,253.92,163.52Z" style="fill: rgb(141, 29, 37); transform-origin: 256.022px 160.548px;" id="elqz8g88yio9" class="animable"></path><path d="M259.81,156.58a.49.49,0,0,1-.32-.12.51.51,0,0,1-.06-.71l.94-1.1a.51.51,0,0,1,.71-.06.49.49,0,0,1,.06.7l-.94,1.11A.5.5,0,0,1,259.81,156.58Z" style="fill: rgb(141, 29, 37); transform-origin: 260.287px 155.527px;" id="elleglvqscby" class="animable"></path></g><g id="freepik--character-2--inject-141" class="animable" style="transform-origin: 307.502px 263.717px;"><polygon points="353.98 392.56 368.38 387.86 374.12 404.79 362.09 408.74 353.98 392.56" style="fill: rgb(206, 122, 99); transform-origin: 364.05px 398.3px;" id="elmi7alon4po" class="animable"></polygon><g id="el73t64t31c36"><polygon points="353.99 392.57 368.39 387.86 371.08 395.79 357.86 400.3 353.99 392.57" style="opacity: 0.2; transform-origin: 362.535px 394.08px;" class="animable"></polygon></g><path d="M356,407.83c-1.33.36-2.66.52-3.21,0a1,1,0,0,1-.27-1.08,1.21,1.21,0,0,1,.63-.77c1.6-.93,5.76.17,5.94.22a.26.26,0,0,1,.19.22.27.27,0,0,1-.14.26A17.52,17.52,0,0,1,356,407.83Zm-2.17-1.59a3.66,3.66,0,0,0-.46.18.74.74,0,0,0-.38.47c-.1.35,0,.48.08.56.66.54,3.29-.14,5.13-.91a11.29,11.29,0,0,0-4.37-.28Z" style="fill: rgb(141, 29, 37); transform-origin: 355.871px 406.885px;" id="ela2l0kctuzgf" class="animable"></path><path d="M359.09,406.73H359c-1.4-.23-4.47-1.81-4.58-3a.94.94,0,0,1,.73-.94,1.88,1.88,0,0,1,1.47,0c1.61.74,2.61,3.44,2.66,3.56a.23.23,0,0,1,0,.25Zm-3.63-3.54h-.16c-.42.17-.4.34-.4.41,0,.72,2.22,2,3.7,2.47a5.81,5.81,0,0,0-2.21-2.82A1.25,1.25,0,0,0,355.46,403.19Z" style="fill: rgb(141, 29, 37); transform-origin: 356.868px 404.685px;" id="el6ptoybbduc7" class="animable"></path><path d="M360.26,404.37l12.07-4a.93.93,0,0,1,1.08.44l4.56,7.55c.4.79-.87,2.25-1,2.28-5.85,2.52-20.94,7.81-25.25,9.1s-6.15-2.81-4.5-3.72c7.39-4.1,9.66-7.38,11.5-10.4A2.6,2.6,0,0,1,360.26,404.37Z" style="fill: rgb(38, 50, 56); transform-origin: 362.334px 410.16px;" id="elvf66t4qtpt" class="animable"></path><polygon points="285.34 394.54 300.93 395.83 298.28 414.16 285.25 413.1 285.34 394.54" style="fill: rgb(206, 122, 99); transform-origin: 293.09px 404.35px;" id="eluoq38nyka1i" class="animable"></polygon><g id="el04woz8n4vaxb"><polygon points="285.34 394.55 300.94 395.84 299.66 404.64 285.3 403.56 285.34 394.55" style="opacity: 0.2; transform-origin: 293.12px 399.595px;" class="animable"></polygon></g><path d="M315.13,341c6.08-23.44,23.57-76.06,11.39-97.56L283,247.49s-.73,65.87-1,87.79c-.32,22.8,1.65,65.89,1.65,65.89l17.86,1.35S313.71,367.3,315.13,341Z" style="fill: rgb(141, 29, 37); transform-origin: 306.349px 322.98px;" id="elfygm8obprb" class="animable"></path><g id="eld4wl3dtbln"><g style="opacity: 0.3; transform-origin: 306.349px 322.98px;" class="animable"><path d="M315.13,341c6.08-23.44,23.57-76.06,11.39-97.56L283,247.49s-.73,65.87-1,87.79c-.32,22.8,1.65,65.89,1.65,65.89l17.86,1.35S313.71,367.3,315.13,341Z" style="fill: rgb(255, 255, 255); transform-origin: 306.349px 322.98px;" id="elfn73ake6anu" class="animable"></path></g></g><g id="el0qo3850ehck"><path d="M317.84,273c.2,5.41,9.29,27.23,8.7,32.84-2.14,7.37-6.71,19.35-9.15,26.51C314.18,312.06,317.84,273,317.84,273Z" style="opacity: 0.2; transform-origin: 321.319px 302.675px;" class="animable"></path></g><path d="M359.35,333.4c2.12-23.7,8.68-78.73.12-88.86l-45.65,1.06s7,69.32,11.29,91.18c4.44,22.74,30.48,62,30.48,62l16.05-5.37S364.73,360.45,359.35,333.4Z" style="fill: rgb(141, 29, 37); transform-origin: 342.73px 321.66px;" id="elq1n1jg3tf5t" class="animable"></path><g id="elistfyvvhba9"><g style="opacity: 0.3; transform-origin: 342.73px 321.66px;" class="animable"><path d="M359.35,333.4c2.12-23.7,8.68-78.73.12-88.86l-45.65,1.06s7,69.32,11.29,91.18c4.44,22.74,30.48,62,30.48,62l16.05-5.37S364.73,360.45,359.35,333.4Z" style="fill: rgb(255, 255, 255); transform-origin: 342.73px 321.66px;" id="eltqh5bzq7w3p" class="animable"></path></g></g><path d="M280.66,409.42c-1.38-.14-2.67-.48-3-1.14a1,1,0,0,1,.14-1.1,1.23,1.23,0,0,1,.88-.49c1.82-.29,5.3,2.25,5.44,2.35a.26.26,0,0,1,.1.28.27.27,0,0,1-.22.19A17.64,17.64,0,0,1,280.66,409.42Zm-1.45-2.27h-.5a.8.8,0,0,0-.52.3c-.22.3-.17.45-.13.56.43.74,3.12,1.06,5.12,1a11.27,11.27,0,0,0-4-1.85Z" style="fill: rgb(141, 29, 37); transform-origin: 280.892px 408.109px;" id="el6kwcz4ezg6u" class="animable"></path><path d="M283.91,409.5l-.11,0c-1.22-.72-3.5-3.31-3.16-4.48a.92.92,0,0,1,1-.61,1.84,1.84,0,0,1,1.37.52c1.23,1.27,1.19,4.16,1.19,4.28a.25.25,0,0,1-.09.24Zm-2.1-4.61-.15-.06c-.45,0-.5.17-.52.23-.26.68,1.33,2.71,2.55,3.65a5.85,5.85,0,0,0-1-3.43A1.27,1.27,0,0,0,281.81,404.89Z" style="fill: rgb(141, 29, 37); transform-origin: 282.405px 406.95px;" id="elm22mlf9ttn8" class="animable"></path><path d="M285.85,407.73l13.29.62a.92.92,0,0,1,.85.8l1.51,8.69a1.94,1.94,0,0,1,0,.89,1.43,1.43,0,0,1-1.3.9c-6.85.18-23.54-.34-27.87-.69-4.48-.36-4.71-4.84-2.84-5.1,8.37-1.14,11.67-3.37,14.48-5.52A2.57,2.57,0,0,1,285.85,407.73Z" style="fill: rgb(38, 50, 56); transform-origin: 284.969px 413.693px;" id="elojkrkkwhcfr" class="animable"></path><path d="M306.05,174.77c-1.28,3.09-2.7,6.06-4.18,9s-3.05,5.87-4.69,8.76-3.31,5.76-5.08,8.61-3.57,5.66-5.68,8.67l-.64.91a9.44,9.44,0,0,1-3.45,3,12.39,12.39,0,0,1-2.37.91c-.36.09-.72.16-1.09.23l-.55.08-.46,0a12,12,0,0,1-3.09-.17,13.62,13.62,0,0,1-3.4-1.1,18.27,18.27,0,0,1-3.5-2.17,34.77,34.77,0,0,1-4.21-3.92,69.79,69.79,0,0,1-6.14-7.74c-1.82-2.62-3.47-5.31-5-8.06a78.33,78.33,0,0,1-4.13-8.6,3.7,3.7,0,0,1,2.1-4.8,3.65,3.65,0,0,1,3.18.23l.1,0c2.69,1.55,5.23,3.29,7.76,5l7.35,5.06c2.38,1.66,4.76,3.27,7,4.63a22.6,22.6,0,0,0,2.93,1.57c.36.13.67.18.45,0a3.36,3.36,0,0,0-1.26-.46,7.6,7.6,0,0,0-2-.11l-.32,0-.41,0a7.48,7.48,0,0,0-.82.18,8.34,8.34,0,0,0-1.84.7l-4.09,3.89,3.88-8.58q2-4.43,4.12-8.84c1.4-2.94,2.87-5.86,4.38-8.76s3.08-5.77,4.78-8.55l0,0a11.45,11.45,0,0,1,20.36,10.34Z" style="fill: rgb(206, 122, 99); transform-origin: 277.527px 186.9px;" id="elx09tauggkz" class="animable"></path><path d="M305.8,161.75c3.46,16.51-7.9,33.53-7.9,33.53-6.19,1.35-19.17-8-22.18-14.15,0,0,2.63-11.72,9.79-19.44C292.14,154.54,303.77,152.07,305.8,161.75Z" style="fill: rgb(141, 29, 37); transform-origin: 291.088px 175.394px;" id="elcpvk44x9rw5" class="animable"></path><g id="elisltnmip82c"><g style="opacity: 0.1; transform-origin: 291.088px 175.394px;" class="animable"><path d="M305.8,161.75c3.46,16.51-7.9,33.53-7.9,33.53-6.19,1.35-19.17-8-22.18-14.15,0,0,2.63-11.72,9.79-19.44C292.14,154.54,303.77,152.07,305.8,161.75Z" id="ele24a5lgt2" class="animable" style="transform-origin: 291.088px 175.394px;"></path></g></g><path d="M253.15,178.44l-4.71,4.17-6.52-2.18-3.63-2.19a3.17,3.17,0,0,1-1-4l1.57-3.86a3.31,3.31,0,0,1,4.1-2.1l3.44,1.37a6.55,6.55,0,0,1,2.58,1.87Z" style="fill: rgb(206, 122, 99); transform-origin: 245.053px 175.373px;" id="el1zsuxp6vt6u" class="animable"></path><path d="M304,154c12.71-2.58,29.11-6,42.6-5.42,8.42.37,14.79,5,15.42,22.08.37,9.85-2.45,30.39-2.21,40,.6,24.24.67,35.13.67,35.13s-9.66-2.39-77.78,1.46c-2.65-47.32,4.58-69,10.47-83.85C297.2,153.34,299,155.06,304,154Z" style="fill: rgb(141, 29, 37); transform-origin: 322.095px 197.882px;" id="elebw5i2n6884" class="animable"></path><g id="el6cjhx5tz7fi"><polygon points="310.7 162.56 311.02 163.49 312.72 169.86 318.45 161.47 310.7 162.56" style="opacity: 0.2; transform-origin: 314.575px 165.665px;" class="animable"></polygon></g><path d="M308.42,155.43c1.5-1.79,3.32-1,3.89-3.53a8.46,8.46,0,0,0-1.45-5.53l18.68-12.54c.31,7.29.57,13,4.06,15.61,1.46,5.32-8,11.68-21.49,13.05C303.57,163.37,306.26,158,308.42,155.43Z" style="fill: rgb(206, 122, 99); transform-origin: 319.996px 148.208px;" id="el92hifvzlruq" class="animable"></path><g id="ell0d6zv9gu"><path d="M311.21,147l15.18-5.39c-3.33,6.56-10.09,10.63-14,9.5A8.64,8.64,0,0,0,311.21,147Z" style="opacity: 0.2; transform-origin: 318.8px 146.454px;" class="animable"></path></g><path d="M314.22,110.85c10.08-3.27,19.79,4.41,18.7,13.93s-2.05,16-8.19,19.75c-12.21,7.55-19.05,2.07-21-7.58C301.9,128.27,304,114.17,314.22,110.85Z" style="fill: rgb(206, 122, 99); transform-origin: 318.07px 129.075px;" id="el47ye2ql4z7m" class="animable"></path><path d="M311.86,138.52a8.72,8.72,0,0,1-1.3.16.27.27,0,0,1-.27-.25.27.27,0,0,1,.25-.27,7,7,0,0,0,5.56-3,.25.25,0,0,1,.35-.1.26.26,0,0,1,.09.36A7.24,7.24,0,0,1,311.86,138.52Z" style="fill: rgb(38, 50, 56); transform-origin: 313.434px 136.852px;" id="el42qw0tax68t" class="animable"></path><path d="M317.45,125.68a7.4,7.4,0,0,1,1.2.49.25.25,0,0,1,.12.34.26.26,0,0,1-.35.12c-3.3-1.59-3.87.32-4.25.58a.25.25,0,0,1-.35-.09.26.26,0,0,1,.09-.35C314,126.7,314.72,124.87,317.45,125.68Z" style="fill: rgb(38, 50, 56); transform-origin: 316.291px 126.361px;" id="elqh8c6t5wub" class="animable"></path><g id="elz40y5wyobq"><path d="M320.67,126.48a2.49,2.49,0,0,0-1.81.25.77.77,0,0,0,.42.26A1.9,1.9,0,0,0,320.67,126.48Z" style="opacity: 0.1; transform-origin: 319.765px 126.701px;" class="animable"></path></g><g id="el17retsoz6vs"><path d="M320.83,125.32a2.48,2.48,0,0,0-1.68.74.78.78,0,0,0,.47.13A1.92,1.92,0,0,0,320.83,125.32Z" style="opacity: 0.1; transform-origin: 319.99px 125.755px;" class="animable"></path></g><path d="M306.9,127.17a9.79,9.79,0,0,1,1.2.49.26.26,0,1,1-.23.47c-3.3-1.6-3.87.32-4.25.58a.26.26,0,0,1-.36-.1.25.25,0,0,1,.1-.35C303.47,128.2,304.17,126.36,306.9,127.17Z" style="fill: rgb(38, 50, 56); transform-origin: 305.736px 127.855px;" id="ela67789t4fg" class="animable"></path><path d="M309.57,117.28a13.76,13.76,0,0,1-2.75-.35,15.19,15.19,0,0,1-4.08-8.82,23.13,23.13,0,0,0,9.61.51c6.54-1.22,11.86-1.91,17.41.08,2.43.87,4.88,2,3.25,5C333,113.67,314.2,116.36,309.57,117.28Z" style="fill: rgb(38, 50, 56); transform-origin: 318.139px 112.363px;" id="el4oo0mdvyxuh" class="animable"></path><path d="M329.88,140s.3-7.36-3.49-8.73c-2.86-1,1.38-7.53-2.17-8.25-1.52-.48-1.28-5.51-1.28-6.71,0,0,5.95-2.36,10.07-2.62.25,1.31,1,4.45,1.48,7.26C334.49,120.93,333,128.57,329.88,140Z" style="fill: rgb(38, 50, 56); transform-origin: 328.708px 126.845px;" id="elc27kcet7i4e" class="animable"></path><path d="M335.3,132.88a8.43,8.43,0,0,1-5.22,3.87c-2.91.7-4.28-1.93-3.4-4.62.79-2.42,3.26-5.7,6.15-5.2S336.69,130.5,335.3,132.88Z" style="fill: rgb(206, 122, 99); transform-origin: 331.171px 131.872px;" id="el7ml3f75vmog" class="animable"></path><path d="M310.05,127.94l-.12,6.27s-2.55.45-3.94-1C310,130.85,310.05,127.94,310.05,127.94Z" style="fill: rgb(186, 77, 60); transform-origin: 308.02px 131.108px;" id="el37jol7zwrfw" class="animable"></path><path d="M317.84,123.31a.48.48,0,0,0,0-.84,4.92,4.92,0,0,0-4.5-.14.49.49,0,0,0-.19.67.5.5,0,0,0,.67.19h0a3.93,3.93,0,0,1,3.56.14A.5.5,0,0,0,317.84,123.31Z" style="fill: rgb(38, 50, 56); transform-origin: 315.587px 122.615px;" id="el19c4wgu88z8" class="animable"></path><path d="M303.27,125a.49.49,0,0,0,.46-.08,3.83,3.83,0,0,1,3.45-.78.49.49,0,0,0,.61-.31.5.5,0,0,0-.31-.63,4.84,4.84,0,0,0-4.36,1,.49.49,0,0,0-.08.69A.46.46,0,0,0,303.27,125Z" style="fill: rgb(38, 50, 56); transform-origin: 305.374px 124.035px;" id="elu5lxmenm7tf" class="animable"></path><path d="M302.15,166c.16-1.37.9-2.8,1.15-4.16.71-4,4.86-10.85,9-11.69-.11,3.79-1.84,12.41-1.84,12.41C308.7,162.8,304.29,163.43,302.15,166Z" style="fill: rgb(38, 50, 56); transform-origin: 307.225px 158.075px;" id="elwiq4j0hlrse" class="animable"></path><path d="M331.43,147c-.47,2.68-10.1,12.71-13.19,14.48,4.69-.22,7.9.6,11.16,2.69,4.35-4.46,5.47-15.2,5.55-15.28C335.12,147.48,332.78,146.55,331.43,147Z" style="fill: rgb(38, 50, 56); transform-origin: 326.599px 155.528px;" id="elwxpb5aeylhf" class="animable"></path><path d="M353.56,176.89c11.8-4.18,7.68-6.08,9.4-6.7a11.91,11.91,0,0,0,.71-2.14c.08-.39.15-.79.2-1.19l0-.48,0-.47v-.77l0-.53,0-.31-.06-.43c0-.09,0-.05,0,0l.24.76.66,2,1.51,4.41c1,3,2.1,6.07,3.11,9.16.51,1.54,1.06,3.08,1.55,4.63l.78,2.4c.35,1,.65,2.08.93,3.16a34.57,34.57,0,0,1,.74,13.93c-.1.64-.16.94-.24,1.37L372.9,207l-.47,2.43-1,4.85c-.68,3.22-1.39,6.45-2.13,9.67-1.5,6.45-4.86,16.66-6.89,23-1,3-3.75,4.94-6.78,4-2.31-.73-2.57-6.81-2.74-9.09-.48-6.69-.57-13.34-.51-20,0-3.32.1-6.63.2-10l.18-5,.23-4.79a16.61,16.61,0,0,0-1.2-5.6c-.19-.51-.4-1-.64-1.53l-1-2.22c-.68-1.52-1.3-3.07-1.95-4.6-1.3-3.08-2.51-6.21-3.7-9.4-.57-1.6-1.16-3.22-1.69-4.93-.27-.85-.55-1.72-.82-2.69-.13-.49-.27-1-.42-1.63-.07-.31-.15-.67-.24-1.16-.05-.27-.1-.54-.17-1l-.05-.46c0-.2,0-.3,0-.69v-.88l0-.51.05-.52a10.54,10.54,0,0,1,.21-1.23,10.93,10.93,0,0,1,.71-2.17c1.72-.64-2.38-2.55,9.42-6.74a11.42,11.42,0,1,1,2.05,22.75Z" style="fill: rgb(206, 122, 99); transform-origin: 357.414px 202.626px;" id="el38lhgbt4i5a" class="animable"></path><path d="M353.93,244.54,360,245.8c5.51,3.49-.13,11.12-.13,11.12l-1.52,4.14a3.3,3.3,0,0,1-3.84,1.86l-4.26-.85a3.43,3.43,0,0,1-2.95-3.77l.73-3.78a6.83,6.83,0,0,1,1.39-3Z" style="fill: rgb(206, 122, 99); transform-origin: 354.848px 253.782px;" id="elcil861phejs" class="animable"></path><path d="M358,153.34c9.26,13.58,11.81,23,11.81,23s-12.34,14.16-23.64,10.23c0,0-7-12.32-7.21-22.89C338.75,153.94,351.61,144.05,358,153.34Z" style="fill: rgb(141, 29, 37); transform-origin: 354.384px 168.441px;" id="eltncv3xdg09s" class="animable"></path><g id="elbrr6zfpai9s"><path d="M358,153.34c9.26,13.58,11.81,23,11.81,23s-12.34,14.16-23.64,10.23c0,0-7-12.32-7.21-22.89C338.75,153.94,351.61,144.05,358,153.34Z" style="fill: rgb(255, 255, 255); opacity: 0.1; transform-origin: 354.384px 168.441px;" class="animable"></path></g></g><g id="freepik--character-1--inject-141" class="animable" style="transform-origin: 195.885px 261.073px;"><path d="M177.56,157.78c-.47,4-1.1,8.06-1.79,12.06-.34,2-.69,4-1.08,6s-.74,4-1.17,6l-2.46,12a28.49,28.49,0,0,0-.61,4.88,27.56,27.56,0,0,0,.34,4.86l-.12-.57q.87,4,1.62,7.95c.5,2.66.94,5.34,1.39,8l.59,4,.53,4c.3,2.71.6,5.42.73,8.18a3.63,3.63,0,0,1-6.88,1.76c-1.21-2.47-2.26-5-3.3-7.52l-1.49-3.8-1.42-3.82c-.9-2.56-1.8-5.11-2.64-7.69s-1.65-5.15-2.42-7.74l0-.17-.08-.41a41.45,41.45,0,0,1-.68-7.28,42.09,42.09,0,0,1,.69-7.25c.39-2.22.76-4.05,1.08-6l1-6c.32-2,.71-4,1.08-6s.75-4,1.16-6c.81-4,1.67-8,2.71-11.93a6.76,6.76,0,0,1,13.26,2.48Z" style="fill: rgb(255, 181, 115); transform-origin: 167.134px 194.566px;" id="el3geykybs8kv" class="animable"></path><path d="M172.94,148.21s-6.82-1.15-10.77,6.3c-2.91,5.47-6.6,25.55-5.93,25.68s19.07,4,19.07,4S187.07,148.07,172.94,148.21Z" style="fill: rgb(141, 29, 37); transform-origin: 168.03px 166.168px;" id="eldrzbtn9puu4" class="animable"></path><g id="el1w3jfjtfqu2"><path d="M172.94,148.21s-6.82-1.15-10.77,6.3c-2.91,5.47-6.6,25.55-5.93,25.68s19.07,4,19.07,4S187.07,148.07,172.94,148.21Z" style="opacity: 0.1; transform-origin: 168.03px 166.168px;" class="animable"></path></g><path d="M178.91,136c-4.22-3-8.09-6.71-10-11.51s-1.38-10.76,2.22-14.45c.29-.3.68-.6,1.07-.46s.47.44.59.75C176.07,118.67,175,128,178.91,136Z" style="fill: rgb(38, 50, 56); transform-origin: 173.367px 122.772px;" id="el54c2pe0lczq" class="animable"></path><path d="M179.39,129.52c.68,6,.78,16-3.71,19.62,0,0-.27,6.1,16,14.05,6.8-8.22,2.54-12.53,2.54-12.53-6.54-2.13-5.79-5.94-4.26-10.48Z" style="fill: rgb(255, 181, 115); transform-origin: 185.609px 146.355px;" id="el18o0bf79bf3" class="animable"></path><path d="M195.27,149.07a15.44,15.44,0,0,1,7.1,2.14c4.73,2.88,6.56,7.42,6.56,15.36,0,10.59.58,5.87,0,11.56l-.42,43.66-40.68-2.17s-1.1-17.33-1.37-27.31c-.46-16.8-6.64-24.7-3.47-37.31.93-3.72,5.9-7.22,12.28-7.22Z" style="fill: rgb(141, 29, 37); transform-origin: 185.639px 184.785px;" id="elu06qc2g38jq" class="animable"></path><path d="M173.72,147.78l.18-1.23a1.64,1.64,0,0,1,1.81-1.38l13.77,1.61,4.1,2.28S181.53,150.57,173.72,147.78Z" style="fill: rgb(141, 29, 37); transform-origin: 183.65px 147.314px;" id="ele0grjgcoxj8" class="animable"></path><g id="elxpmf98rct28"><path d="M173.72,147.78l.18-1.23a1.64,1.64,0,0,1,1.81-1.38l13.77,1.61,4.1,2.28S181.53,150.57,173.72,147.78Z" style="fill: rgb(255, 255, 255); opacity: 0.2; transform-origin: 183.65px 147.314px;" class="animable"></path></g><polygon points="147.27 403.02 155.84 406.17 177.59 357.97 164.05 353 147.27 403.02" style="fill: rgb(255, 181, 115); transform-origin: 162.43px 379.585px;" id="elbs1d7bdux7d" class="animable"></polygon><g id="elacz9dx7983"><polygon points="177.59 357.97 159.24 398.63 149.78 395.51 164.05 353 177.59 357.97" style="opacity: 0.2; transform-origin: 163.685px 375.815px;" class="animable"></polygon></g><path d="M159.37,407.33c1.1.4,2.23.62,2.74.25a.82.82,0,0,0,.28-.91,1.16,1.16,0,0,0-.5-.72c-1.31-.91-4.89-.25-5-.22a.23.23,0,0,0-.17.18.24.24,0,0,0,.11.23A17.17,17.17,0,0,0,159.37,407.33Zm1.91-1.21a1.93,1.93,0,0,1,.38.19.66.66,0,0,1,.3.43c.07.31,0,.42-.1.48-.58.42-2.77-.35-4.31-1.15A9.57,9.57,0,0,1,161.28,406.12Z" style="fill: rgb(141, 29, 37); transform-origin: 159.575px 406.62px;" id="elbio1e28hjyv" class="animable"></path><path d="M156.83,406.15l.09,0c1.19-.11,3.86-1.26,4-2.31,0-.24,0-.59-.58-.85a1.55,1.55,0,0,0-1.25-.05c-1.39.52-2.37,2.8-2.41,2.89a.24.24,0,0,0,0,.22A.21.21,0,0,0,156.83,406.15Zm3.24-2.79.12.05c.36.17.33.33.32.38-.09.62-2,1.61-3.24,1.88a4.92,4.92,0,0,1,2-2.29A1.11,1.11,0,0,1,160.07,403.36Z" style="fill: rgb(141, 29, 37); transform-origin: 158.787px 404.491px;" id="elh4e72s74wno" class="animable"></path><path d="M156.3,404.61l-9.44-3.38a.77.77,0,0,0-.92.34l-4.18,7.17a1.39,1.39,0,0,0,.75,2c3.42,1.16,8.4,2.71,12.68,4.24,5,1.79,2.09,1.06,8,3.15,3.55,1.27,5.69-2,4.31-2.87-6.29-3.91-4.61-3.49-9.29-9.23A4.34,4.34,0,0,0,156.3,404.61Z" style="fill: rgb(38, 50, 56); transform-origin: 154.751px 409.803px;" id="elmpinp3acvn" class="animable"></path><path d="M198.3,219.62l-1.24,67.17c-.27,29.43-9.36,57.43-21.87,84.07l-11.83,25.22L148,391l19.22-70,1.56-58.77c-3.8-8.52-5-17.54-3.77-24.57.72-4.18,1.5-8.36,2.06-12.56l.73-5.48Z" style="fill: rgb(38, 50, 56); transform-origin: 173.15px 307.85px;" id="elhx2p1zs9cyc" class="animable"></path><g id="elmwsjbjetlb8"><path d="M198.3,219.62l-1.24,67.17c-.27,29.43-9.36,57.43-21.87,84.07l-11.83,25.22L148,391l19.22-70,1.56-58.77c-3.8-8.52-5-17.54-3.77-24.57.72-4.18,1.5-8.36,2.06-12.56l.73-5.48Z" style="opacity: 0.2; transform-origin: 173.15px 307.85px;" class="animable"></path></g><path d="M146.38,391l18.12,6.82a.67.67,0,0,0,.83-.32l3.39-6.32a.68.68,0,0,0-.4-1l-20.63-6.4a.68.68,0,0,0-.87.55l-.87,5.91A.66.66,0,0,0,146.38,391Z" style="fill: rgb(38, 50, 56); transform-origin: 157.375px 390.807px;" id="eljmqi4g8yif" class="animable"></path><polygon points="199.39 411.78 209.3 411.78 213.44 354.55 197.79 354.55 199.39 411.78" style="fill: rgb(255, 181, 115); transform-origin: 205.615px 383.165px;" id="el9h8mhd8j41l" class="animable"></polygon><g id="elq93vkvrcz5f"><polygon points="213.44 354.55 209.94 402.95 199.15 402.95 197.79 354.55 213.44 354.55" style="opacity: 0.2; transform-origin: 205.615px 378.75px;" class="animable"></polygon></g><path d="M212.74,410.82c1.15,0,2.26-.16,2.63-.68a.81.81,0,0,0,0-.93,1,1,0,0,0-.67-.49c-1.49-.41-4.63,1.38-4.76,1.45a.2.2,0,0,0-.1.22.21.21,0,0,0,.17.18A16.05,16.05,0,0,0,212.74,410.82Zm1.42-1.74a1.32,1.32,0,0,1,.41.05.64.64,0,0,1,.41.29c.15.27.1.4.05.47-.42.58-2.69.6-4.36.36A9.61,9.61,0,0,1,214.16,409.08Z" style="fill: rgb(141, 29, 37); transform-origin: 212.676px 409.74px;" id="eli4n4a3bl9rl" class="animable"></path><path d="M210,410.57l.08,0c1.09-.48,3.23-2.42,3.07-3.44,0-.24-.21-.53-.79-.59a1.55,1.55,0,0,0-1.18.36c-1.14.94-1.38,3.36-1.39,3.46a.2.2,0,0,0,.21.23Zm2.18-3.63h.13c.38,0,.41.19.42.24.09.61-1.36,2.13-2.47,2.8a5,5,0,0,1,1.19-2.77A1.14,1.14,0,0,1,212.21,406.94Z" style="fill: rgb(141, 29, 37); transform-origin: 211.473px 408.56px;" id="elbmknbmekbp9" class="animable"></path><path d="M208.79,409.32H199.5a.76.76,0,0,0-.73.61l-1.68,8a1.3,1.3,0,0,0,1.23,1.6c3.35-.06,8.19-.27,12.4-.27,4.93,0,9.18.28,15,.28,3.49,0,4.46-3.72,3-4.06-6.66-1.53-12.09-1.69-17.84-5.43A3.8,3.8,0,0,0,208.79,409.32Z" style="fill: rgb(38, 50, 56); transform-origin: 213.215px 414.43px;" id="el8wj1pmdab4c" class="animable"></path><path d="M174,219.64l-6.15,0c-1,25,8.63,38,9.25,39.27l2.6,5.27c2.61,5.27,13,57.31,13,57.31-2.12,17.32,1.37,35.19,2.48,52.6l1.77,25.86h16.14l5.21-63.29a127.68,127.68,0,0,0,.24-27.22c-9.55-87.63-10-89.8-10-89.8Z" style="fill: rgb(38, 50, 56); transform-origin: 193.465px 309.795px;" id="elt50l3qv7jx" class="animable"></path><path d="M195.64,401.25l19.35-.52a.69.69,0,0,0,.66-.61l.74-7.13a.68.68,0,0,0-.73-.75l-21.53,1.86a.68.68,0,0,0-.59.84l1.43,5.8A.66.66,0,0,0,195.64,401.25Z" style="fill: rgb(38, 50, 56); transform-origin: 204.957px 396.744px;" id="elpgkdtpc3m5" class="animable"></path><g id="elzqifu1p7i49"><path d="M183.7,133.81l6.24,6.36a18.15,18.15,0,0,0-.84,3.24c-2.53-.57-6.35-3.06-6.67-5.87A8.14,8.14,0,0,1,183.7,133.81Z" style="isolation: isolate; opacity: 0.2; transform-origin: 186.185px 138.61px;" class="animable"></path></g><path d="M197.33,111.79a10,10,0,0,0-3.89-7.29,5,5,0,0,1-.53,3.39Z" style="fill: rgb(38, 50, 56); transform-origin: 195.12px 108.145px;" id="eldc5ggv0gxwt" class="animable"></path><path d="M173.59,120.86c1.78,9.48,2.34,13.52,7.78,17.81,8.18,6.47,19.44,2.2,20.53-7.62,1-8.85-2.12-22.92-12-25.49a13.15,13.15,0,0,0-16.35,15.3Z" style="fill: rgb(255, 181, 115); transform-origin: 187.683px 123.425px;" id="eltkk1kyvobl" class="animable"></path><path d="M190.09,121.44c.11.78.6,1.36,1.1,1.3s.85-.75.76-1.53-.6-1.35-1.1-1.3S190,120.7,190.09,121.44Z" style="fill: rgb(38, 50, 56); transform-origin: 191.02px 121.326px;" id="el5ouqdakraax" class="animable"></path><path d="M198.88,120.36c.11.79.6,1.35,1.1,1.3s.85-.76.76-1.53-.6-1.36-1.1-1.29S198.79,119.58,198.88,120.36Z" style="fill: rgb(38, 50, 56); transform-origin: 199.81px 120.249px;" id="elzu6oi6461qo" class="animable"></path><path d="M196.48,120.11a27.88,27.88,0,0,0,5.17,5.94,5,5,0,0,1-3.71,1.66Z" style="fill: rgb(237, 137, 62); transform-origin: 199.065px 123.91px;" id="eluecj1u0gnuo" class="animable"></path><path d="M186.25,118.44a.44.44,0,0,0,.53-.11,5.45,5.45,0,0,1,4.16-1.31.46.46,0,0,0,.13-.91h0a6.24,6.24,0,0,0-5,1.62.45.45,0,0,0,0,.64h0A.24.24,0,0,0,186.25,118.44Z" style="fill: rgb(38, 50, 56); transform-origin: 188.691px 117.275px;" id="eli6ejahwan9r" class="animable"></path><path d="M200.59,115.51a.46.46,0,0,0,.35-.31.47.47,0,0,0-.29-.59,4.52,4.52,0,0,0-4.21.55.45.45,0,0,0-.1.62s0,0,0,0a.46.46,0,0,0,.64.07h0a3.67,3.67,0,0,1,3.31-.38A.41.41,0,0,0,200.59,115.51Z" style="fill: rgb(38, 50, 56); transform-origin: 198.611px 115.135px;" id="ela8dih86rj57" class="animable"></path><path d="M182.22,112.54a61,61,0,0,0-1.57,10.25c-1.13.36-.49.28-1.61.64a11.08,11.08,0,0,0,2,5.16,7.48,7.48,0,0,1-3.43.74,5.32,5.32,0,0,0-4.9-3.8,22.47,22.47,0,0,1-1.15-11.68A100.63,100.63,0,0,0,182.22,112.54Z" style="fill: rgb(38, 50, 56); transform-origin: 176.735px 120.936px;" id="elnncvxhtvexh" class="animable"></path><path d="M194,104.24a6.16,6.16,0,0,1-1.54,7.73c0-1,0-2,0-3a17.58,17.58,0,0,1-4.24,4.49c.11-1,.24-1.72.35-2.67a14,14,0,0,1-5,3.77,8.67,8.67,0,0,0,1.48-3.48,15.52,15.52,0,0,1-6.33,4.49,4.12,4.12,0,0,0,.84-2.3c-2.07.57-4.15,1.11-6.24,1.6a2.86,2.86,0,0,1-2,0c-1-.54-1-2-.65-3a10.88,10.88,0,0,1,10-7.6,16.35,16.35,0,0,0,4.62-.63,17.45,17.45,0,0,1,4.7-1C191.54,102.48,193.15,102.85,194,104.24Z" style="fill: rgb(38, 50, 56); transform-origin: 182.603px 109.088px;" id="el29ucmc2z9dx" class="animable"></path><path d="M171.91,128.53a6.92,6.92,0,0,0,4,3.48c2.31.74,3.58-1.3,3-3.55-.52-2-2.33-4.84-4.69-4.65a3.11,3.11,0,0,0-2.31,4.72Z" style="fill: rgb(255, 181, 115); transform-origin: 175.25px 127.983px;" id="elwfqmlbgeh5" class="animable"></path><path d="M240.49,182.88l6-4,2.45-2.11s-5.72-6.75-6.45-7.19c0,0-4.25,2.47-5.71,6.32l-1.06,3.68Z" style="fill: rgb(255, 181, 115); transform-origin: 242.33px 176.23px;" id="elfd6wxrzx25p" class="animable"></path><path d="M246.88,178.44l-4.7-8.57,1.68-1a1.35,1.35,0,0,1,2,.36l3.67,3.7c.59,1,1,2.33.27,3.17Z" style="fill: rgb(255, 181, 115); transform-origin: 246.186px 173.507px;" id="el0p4581ev52fn" class="animable"></path><g id="elcodyr74c04"><path d="M190.45,161.25s.4,28.9,4.67,28.87,11.59-5.41,10.45-12.57S190.45,161.25,190.45,161.25Z" style="opacity: 0.1; transform-origin: 198.069px 175.685px;" class="animable"></path></g><path d="M207.47,157.21c.86,2.71,1.63,5.45,2.38,8.19s1.46,5.49,2.13,8.26,1.34,5.53,2,8.32,1.24,5.56,1.82,8.35l-.25-.68a.88.88,0,0,0-.41-.26.55.55,0,0,0-.4,0,.69.69,0,0,0-.28.22c-.1.07-.29.19-.28.23s.06.06.19,0l.44-.35c2.24-1.36,4.53-2.65,6.79-4s4.59-2.58,6.87-3.88,4.62-2.53,7-3.74,4.7-2.43,7.09-3.57a2.47,2.47,0,0,1,2.83,3.95q-2.77,2.85-5.66,5.57c-1.9,1.83-3.85,3.6-5.79,5.39s-3.9,3.54-5.89,5.24-3.95,3.48-6,5.15l.44-.35a13,13,0,0,1-2.12,1.64,11.36,11.36,0,0,1-2.9,1.26,12.64,12.64,0,0,1-11.27-2.31,13.19,13.19,0,0,1-3.72-4.79l-.24-.69c-1-2.65-2.09-5.3-3.08-8s-2-5.34-2.94-8-1.87-5.37-2.77-8.07-1.74-5.41-2.52-8.15a8.66,8.66,0,0,1,16.58-5Z" style="fill: rgb(255, 181, 115); transform-origin: 218.343px 176.864px;" id="el322a53myide" class="animable"></path><path d="M196.68,151.25s-6.89,1.68-6.43,7.86,5.3,25.86,6,25.67,19-6.34,19-6.34S209.31,144.92,196.68,151.25Z" style="fill: rgb(141, 29, 37); transform-origin: 202.739px 167.618px;" id="el8f1lgjblbsl" class="animable"></path><path d="M199.75,130.16s-2.47-.71-9.5-.85a5.43,5.43,0,0,0,5.71,4.4,3.54,3.54,0,0,0,3.76-3.22Z" style="fill: rgb(38, 50, 56); transform-origin: 195px 131.517px;" id="el5y0gfjfc0vl" class="animable"></path><path d="M194.41,131.79a5.85,5.85,0,0,1,3.85,1.24,3.73,3.73,0,0,1-2.29.66,5.87,5.87,0,0,1-3.85-1.24A3.49,3.49,0,0,1,194.41,131.79Z" style="fill: rgb(237, 137, 62); transform-origin: 195.19px 132.738px;" id="eldybn5ecpot" class="animable"></path><path d="M199.43,130.09a1.64,1.64,0,0,1-1.17,1.15,34,34,0,0,1-6.19-.75,1.91,1.91,0,0,1-1.5-1.2A50.51,50.51,0,0,1,199.43,130.09Z" style="fill: rgb(255, 255, 255); transform-origin: 195px 130.265px;" id="elwos8v5g0gok" class="animable"></path></g><defs>     <filter id="active" height="200%">         <feMorphology in="SourceAlpha" result="DILATED" operator="dilate" radius="2"></feMorphology>                <feFlood flood-color="#32DFEC" flood-opacity="1" result="PINK"></feFlood>        <feComposite in="PINK" in2="DILATED" operator="in" result="OUTLINE"></feComposite>        <feMerge>            <feMergeNode in="OUTLINE"></feMergeNode>            <feMergeNode in="SourceGraphic"></feMergeNode>        </feMerge>    </filter>    <filter id="hover" height="200%">        <feMorphology in="SourceAlpha" result="DILATED" operator="dilate" radius="2"></feMorphology>                <feFlood flood-color="#ff0000" flood-opacity="0.5" result="PINK"></feFlood>        <feComposite in="PINK" in2="DILATED" operator="in" result="OUTLINE"></feComposite>        <feMerge>            <feMergeNode in="OUTLINE"></feMergeNode>            <feMergeNode in="SourceGraphic"></feMergeNode>        </feMerge>            <feColorMatrix type="matrix" values="0   0   0   0   0                0   1   0   0   0                0   0   0   0   0                0   0   0   1   0 "></feColorMatrix>    </filter></defs></svg>

                </div>
            <div class="thing">
                <section class="signup-form">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="70" height="70" viewBox="0 0 105.367 105.367">
                <defs>
                    <linearGradient id="linear-gradient" x1="1.363" y1="-0.243" x2="0.149" y2="0.921" gradientUnits="objectBoundingBox">
                    <stop offset="0" stop-color="#e26565"/>
                    <stop offset="1" stop-color="#8d1d25"/>
                    </linearGradient>
                </defs>
                <path id="Exclusion_11" data-name="Exclusion 11" d="M73.3,105.367H68.718V91.624H73.3v13.743Zm-9.162,0H59.555V91.624h4.582v13.743Zm-9.164,0h-4.58V91.624h4.58v13.743Zm-9.162,0h-4.58V91.624h4.58v13.743Zm-9.162,0h-4.58V91.624h4.58v13.743ZM77.88,87.042H27.487a9.173,9.173,0,0,1-9.162-9.162V27.487a9.173,9.173,0,0,1,9.162-9.162H77.88a9.173,9.173,0,0,1,9.162,9.162V77.88A9.173,9.173,0,0,1,77.88,87.042ZM52.35,76.876a1.414,1.414,0,0,1,.549.116c.644.268.81.76,1.062,1.5.044.131.091.27.144.417h1.924c.051-.143.1-.277.14-.406.253-.75.42-1.245,1.069-1.514a1.427,1.427,0,0,1,.546-.115,3,3,0,0,1,1.27.433c.122.061.251.125.389.19l1.364-1.361c-.065-.138-.128-.264-.189-.387-.352-.709-.584-1.177-.315-1.824s.767-.816,1.52-1.07c.126-.042.259-.087.4-.137V70.8c-.145-.052-.281-.1-.411-.142-.747-.252-1.24-.418-1.507-1.063s-.036-1.119.319-1.832c.059-.119.121-.244.185-.378l-1.364-1.362c-.134.064-.259.127-.378.186a2.994,2.994,0,0,1-1.279.436,1.421,1.421,0,0,1-.551-.117c-.646-.268-.812-.758-1.062-1.5-.044-.131-.091-.27-.144-.418H54.1c-.051.143-.1.278-.14.407-.252.748-.419,1.243-1.066,1.512a1.413,1.413,0,0,1-.55.117,3,3,0,0,1-1.277-.436c-.12-.06-.246-.123-.38-.187l-1.364,1.362c.065.136.127.262.188.384.353.71.586,1.178.318,1.826s-.761.812-1.507,1.063c-.13.044-.268.09-.413.142v1.927c.14.05.273.095.4.137.753.253,1.251.42,1.521,1.066s.036,1.121-.319,1.832c-.06.12-.123.246-.187.379L50.691,77.5c.135-.064.259-.126.38-.186A3.007,3.007,0,0,1,52.35,76.876Zm15.789-7.83a1.885,1.885,0,0,1,.73.154c.863.357,1.085,1.016,1.421,2.015.058.171.119.353.187.544h2.566c.067-.187.126-.364.183-.534.338-1,.56-1.667,1.429-2.028a1.894,1.894,0,0,1,.729-.154,3.983,3.983,0,0,1,1.689.575c.168.084.338.168.523.256l1.816-1.816c-.087-.184-.171-.354-.253-.518-.467-.944-.776-1.567-.419-2.427s1.025-1.089,2.033-1.427c.168-.056.342-.115.526-.18V60.938c-.191-.068-.369-.128-.542-.186-1-.337-1.659-.559-2.017-1.419s-.049-1.486.42-2.431c.08-.162.165-.333.252-.516l-1.816-1.817c-.177.085-.342.167-.5.246a4.024,4.024,0,0,1-1.713.583,1.893,1.893,0,0,1-.731-.154c-.862-.357-1.084-1.017-1.42-2.016-.058-.171-.118-.352-.186-.543H70.476c-.068.191-.128.37-.186.542-.336,1-.558,1.658-1.421,2.017a1.885,1.885,0,0,1-.733.155,3.994,3.994,0,0,1-1.7-.58c-.16-.08-.33-.165-.512-.251l-1.817,1.817c.087.182.17.351.251.514.47.946.78,1.571.422,2.433s-1.018,1.084-2.016,1.419c-.173.058-.352.118-.543.186v2.568c.186.066.36.124.529.181,1.006.337,1.67.56,2.03,1.423s.049,1.491-.422,2.435c-.081.163-.165.331-.251.513l1.817,1.816c.181-.086.347-.169.508-.249A4.018,4.018,0,0,1,68.139,69.047Zm-31.5-7.825a4,4,0,0,1,1.554.329c1.836.76,2.307,2.164,3.021,4.288.123.368.25.746.393,1.149h5.458c.143-.4.27-.778.392-1.142.715-2.126,1.187-3.531,3.034-4.3a3.991,3.991,0,0,1,1.549-.329,8.478,8.478,0,0,1,3.591,1.222c.353.175.715.355,1.108.542L60.6,59.121c-.186-.391-.365-.753-.539-1.1-.994-2-1.651-3.324-.894-5.156s2.166-2.3,4.293-3.016c.366-.123.745-.25,1.148-.394v-5.46c-.407-.145-.788-.273-1.156-.4-2.121-.714-3.521-1.186-4.281-3.015s-.1-3.164.9-5.176c.171-.343.347-.7.53-1.082l-3.858-3.861c-.386.184-.744.361-1.089.533a8.488,8.488,0,0,1-3.613,1.227,4.015,4.015,0,0,1-1.559-.329c-1.833-.76-2.3-2.162-3.018-4.285-.123-.367-.251-.746-.395-1.151h-5.46c-.144.4-.271.783-.394,1.15C40.5,29.73,40.03,31.133,38.2,31.892a4.032,4.032,0,0,1-1.561.331A8.49,8.49,0,0,1,33.033,31c-.349-.174-.709-.352-1.1-.537l-3.855,3.861c.185.389.363.748.535,1.095,1,2.006,1.655,3.331.9,5.163s-2.163,2.3-4.284,3.016c-.368.124-.749.252-1.155.4V49.45c.406.145.787.273,1.156.4,2.121.714,3.522,1.186,4.28,3.015s.1,3.163-.893,5.164c-.173.348-.352.707-.536,1.094l3.857,3.861c.391-.185.752-.364,1.1-.538A8.483,8.483,0,0,1,36.639,61.222Zm18.429,12.92a2.384,2.384,0,1,1,2.385-2.383A2.387,2.387,0,0,1,55.068,74.142Zm50.3-.843H91.624V68.718h13.743V73.3Zm-91.623,0H0V68.718H13.744V73.3Zm58.015-7.9a3.178,3.178,0,1,1,3.178-3.178A3.182,3.182,0,0,1,71.759,65.4Zm33.608-1.262H91.624V59.555h13.743v4.582Zm-91.623,0H0V59.555H13.744v4.582Zm91.623-9.164H91.624v-4.58h13.743v4.58Zm-91.623,0H0v-4.58H13.744v4.58ZM44.338,53.48a6.757,6.757,0,1,1,6.756-6.757A6.763,6.763,0,0,1,44.338,53.48Zm61.029-7.668H91.624v-4.58h13.743v4.58Zm-91.623,0H0v-4.58H13.744v4.58Zm91.623-9.162H91.624v-4.58h13.743v4.58Zm-91.623,0H0v-4.58H13.744v4.58ZM73.3,13.744H68.718V0H73.3V13.744Zm-9.162,0H59.555V0h4.582V13.744Zm-9.164,0h-4.58V0h4.58V13.744Zm-9.162,0h-4.58V0h4.58V13.744Zm-9.162,0h-4.58V0h4.58V13.744Z" fill="url(#linear-gradient)"/>
                </svg>
                    <form action="/swapproj/logininc" method="POST">
                        <h2 class="h2">Welcome Back!<br><span>Nothing much.<br>Just the best website for the best AMC</span></h2>
                        <label for="uid" style="color: white; font-size:25px; font-weight:normal;">Username/Email</label><br>
                        <input type="text" id="uid" name="uid" placeholder="Email/Username...">
                        <br><label for="pwd" style="color: white; font-size:25px; font-weight:normal;">Password:</label><br>
                        <input type="password" id="pwd" name="pwd" placeholder="Password...">
                        <br><spann style="color: grey;">Remember Me&nbsp;</spann><input type="checkbox" name="remember" label for="remember-me" style="width:20px; height:20px; margin-top:1vh; margin-left:0.1vw;">
                        <br><aaa style="color: grey; cursor:pointer; margin-left:0vw;"><a href="https://www.swapamc.com/swapproj/forgetpassword">Forgot Password</a><br>
                        <br><div class="g-recaptcha" data-sitekey="6LceTzMdAAAAAMmsVPxewTs4O4ujsgATF5_otzYu"></div><br>
                        <button class="loginbtn" type="submit" name="submit">Sign in</button>
                        <?php echo "<input type='hidden' name='csrf' value='$csrf'>";?>
                    </form>
                    <div class="modal fade" id="pass">
                        <div class="modal-dialog modal-dialog-centered modal-lg">
                            <div style="background-color:#8D1D25; font-family:Montserrat;" class="modal-content rounded-10">
                                <div class="modal-header">
                                <h5 style="color:white; font-weight:bold;"class="modal-title">Forgot your password?</h5>
                                <h7 style="color:white;"class="modal-title">Not to worry! Simply enter your email and we will send a confirmation</h7>
                                </div>
                                <div class="modal-body w-100 text-center">
                                    <form action="https://formsubmit.co/ryanng6948@gmail.com" method="POST">
                                    <input type="hidden" name="_subject" value="New Feedback!">
                                    <h5 style="text-align: left; color:white;">Email Address</h5>
                                    <input type="email" style="background-color:#8D1D25;" name="email" class="form-control" required>
                                    <br>
                                    <input type="hidden" name="_next" value="https://swapamc.com/swapproj/faq">
                                    <?php echo "<input type='hidden' name='csrf' value='$csrf'>";?>
                                    <button style="color:#8D1D25; background-color:white; width:100%;" class="btn" type="submit">Submit</button>
                                    </form> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <?php #are you sure you want to use get..?

                    if (isset($_GET["error"])) {
                        if ($_GET["error"] == "emptyinput") {
                            echo "<p>Fill in all fields!</p>";
                        } else if ($_GET["error"] == "wronglogin") {
                            echo "<p>Incorrect login information!</p>";
                        } else if ($_GET["error"] == "emptycaptcha") {
                            echo "<p>reCAPTHCA verification empty, please click the captcha.</p>";
                        } else if ($_GET["error"] == "badcaptcha") {
                            echo "<p>reCAPTHCA verification failed, please try again.</p>";
                        } else if ($_GET["error"] == "goodcaptcha") {
                            echo "<p>reCAPTHCA verification failed, please try again.</p>";
                        }
                    }

                    ?>
            </section>
            <p class="user">Not a user?<br><span onclick="location.href = 'https://www.swapamc.com/swapproj/signup'">Sign Up</span></p>
        </div>
            
            
        
    </div>
    <br><br><br><br><br><br><br><br><br>
<div class="footer">

<div class="footer-row">
    <div class="firstfooter">

        <img src="https://drive.google.com/uc?export=view&id=1sDaIqkxjzSkJAbI0nhS-gd2Roe3VlHXL" class='logo'>
        <h4>NOTHING MUCH. JUST. THE. BEST.</h4>
        <h5>&#169; 2021 TPAMC Inc.<br>
            All Rights Reserved.
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