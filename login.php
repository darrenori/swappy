
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

    print_r($time);
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
// print_r(apache_request_headers());



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