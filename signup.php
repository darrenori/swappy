
<head>
    <script src='https://www.google.com/recaptcha/api.js' async defer></script>
</head>
<?php

if (isset($_GET["error"])) {
    $error=htmlentities($_GET["error"]);

    if ($error == "emptyinput"){
        echo "<p>Fill in all fields!</p>";
    }
    else if ($error == "invaliduid"){
        echo "<p>Choose a proper username!</p>";
    }
    else if ($error == "invalidemail"){
        echo "<p>Choose a proper email!</p>";
    }
    else if ($error == "passwordsdontmatch"){
        echo "<p>Password dont match!</p>";
    }
    else if ($error == "stmtfailed"){
        echo "<p>Something went wrong, try again!</p>";
    }
    else if ($error == "usernametaken"){
        echo "<p>Username or Email already taken!</p>";
    }
    else if ($error == "badinput"){
        echo "<p>Please enter valid characters</p>";
    }
    else if ($error == "none"){
        echo "<p>You have signed up!</p>";
        header("location: https://www.swapamc.com/swapproj/googleauth/");
    }
}

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



    @media(max-width:850px){

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
        padding:70px 0;
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
        bottom:-1050px;
        left:300px;
        z-index:-2;
}
.ballshape2{
        
        /* //mrgin-left:-500px; */
        position:absolute;
        bottom:-1100px;
        left:1000px;
        z-index:-2;
}

.ballshape3{
        
        /* //mrgin-left:-500px; */
        position:absolute;
        bottom:370px;
        left:960px;
        z-index:-2;
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
        
        <div class="thing" style="text-align:center;">
        <svg class="loginlogo" xmlns="http://www.w3.org/2000/svg" width="499" height="467.118" viewBox="0 0 799 667.118">
        <g id="new" transform="translate(0 0.042)">
            <path id="Path_600" data-name="Path 600" d="M849.5,746.62h-485l.219-51.422c.553-130.115,104.408-237.329,234.506-239.542q2.108-.036,4.223-.036h0A245.335,245.335,0,0,1,689.2,471.026c92.054,34.283,153.841,121.384,157.951,219.528Z" transform="translate(-200.5 -116.462)" fill="#8d1d25"/>
            <rect id="Rectangle_271" data-name="Rectangle 271" width="799" height="2" transform="translate(0 630.158)" fill="#2f2e41"/>
            <path id="Path_601" data-name="Path 601" d="M398.287,400.165l21.37,15.543L441.028,598.33H491.54L474.055,390.451l-69.94-27.2Z" fill="#2f2e41"/>
            <path id="Path_602" data-name="Path 602" d="M509.418,458.344s-5.828,66.055,17.485,68,112.682-19.428,112.682-19.428l42.741,151.537,64.112-33.027s-38.856-170.965-62.169-180.679S583.244,415.6,583.244,415.6L526.9,425.316Z" transform="translate(-200.5 -116.462)" fill="#2f2e41"/>
            <path id="Path_603" data-name="Path 603" d="M649.3,710.906s-11.657,44.684-3.886,48.57a140.53,140.53,0,0,1,13.6,7.771v-7.771s9.714,9.714,9.714,17.485,52.455,9.714,52.455,0-1.943-21.371-11.657-27.2-21.371-38.856-21.371-38.856Z" transform="translate(-200.5 -116.462)" fill="#2f2e41"/>
            <path id="Path_604" data-name="Path 604" d="M505.14,514.79l3.885,36.913,13.6,23.313L555.652,538.1,530.4,497.3Z" fill="#2f2e41"/>
            <path id="Path_605" data-name="Path 605" d="M736.724,668.165s7.154-24.46,14.262-21.944,34.307,27.772,34.307,27.772l19.428,11.657s38.856,3.886,27.2,15.542-54.4,27.2-73.826,19.428-23.313-9.714-23.313-9.714l-5.828,3.886-23.313-5.828,3.886-40.8S715.354,685.65,736.724,668.165Z" transform="translate(-200.5 -116.462)" fill="#2f2e41"/>
            <circle id="Ellipse_15" data-name="Ellipse 15" cx="44.684" cy="44.684" r="44.684" transform="translate(330.289 9.665)" fill="#9f616a"/>
            <path id="Path_606" data-name="Path 606" d="M547.3,197.039s3.886,40.8-7.771,40.8,1.942,50.513,33.027,50.513S615.3,228.124,615.3,228.124s-21.371-7.771-17.485-33.027S547.3,197.039,547.3,197.039Z" transform="translate(-200.5 -116.462)" fill="#9f616a"/>
            <path id="Path_607" data-name="Path 607" d="M544.207,234.725l-16.332,7L483.55,260.476a9,9,0,0,0-5.437,9.294l16.734,148.746s-17.485,36.913,9.714,38.856l3.886,13.6,31.085-36.913L656.1,430.173l1.943-188.45-53.335-21.076S597.452,260.755,544.207,234.725Z" transform="translate(-200.5 -116.462)" fill="#3f3d56"/>
            <path id="Path_608" data-name="Path 608" d="M489.991,266.008l-7.179-2.051a5.919,5.919,0,0,0-7.471,4.759L456.288,388.223a41.5,41.5,0,0,0,4.055,25.917c5.887,11.146,18.113,21.254,43.247,9.233l17.485-126.281Z" transform="translate(-200.5 -116.462)" fill="#3f3d56"/>
            <path id="Path_609" data-name="Path 609" d="M635.7,238.809l23.313,3.886,64.112,89.368,5.828,15.542,36.913-11.657s-1.943,17.485,17.485,15.542c0,0-23.313,64.112-71.883,44.684s-64.112-77.712-64.112-77.712Z" transform="translate(-200.5 -116.462)" fill="#3f3d56"/>
            <path id="Path_610" data-name="Path 610" d="M462.4,161.2l-87.426-34.971-3.885,11.657,40.8,34.97Z" fill="#ccc"/>
            <path id="Path_611" data-name="Path 611" d="M548.57,173.66c1.65-.441,1.893-2.632,1.948-4.339.3-9.142,5.8-18.524,14.553-21.185a24.466,24.466,0,0,1,10.313-.568,39.062,39.062,0,0,1,13.967,4.66c2.279,1.281,4.515,2.825,7.1,3.216,1.707.259,9.1,2.408,10.8,2.711,3.738.665,7.212,4.01,10.8,2.765,3.432-1.191,4.191-5.634,4.274-9.265.189-8.273-6.092-19.724-11.623-25.878-4.2-4.671-10.519-6.827-16.7-7.948a111.167,111.167,0,0,0-21.838-1.329c-9.889.176-20.051.94-28.968,5.218s-16.407,12.794-16.834,22.675c-.089,2.058.123,4.125-.05,6.178-.422,5.008-3.082,9.532-4.329,14.4a26.35,26.35,0,0,0,3.68,21.057c3.309,4.87,16.543,9.291,16.351,15.176,2.392-2.478-3.249-4.972-.857-7.45a5.893,5.893,0,0,0,1.752-7.2l-2.54-9.907c-.465-1.814-.922-3.778-.22-5.513C542.875,164.407,545.818,174.4,548.57,173.66Z" transform="translate(-200.5 -116.462)" fill="#2f2e41"/>
            <path id="Path_612" data-name="Path 612" d="M371.088,137.889,334.175,281.655l143.766,50.513,83.54-69.941,52.455-157.365-85.483,62.169Z" fill="#f2f2f2"/>
            <rect id="Rectangle_272" data-name="Rectangle 272" width="1.942" height="144.669" transform="matrix(0.255, -0.967, 0.967, 0.255, 377.637, 155.342)" fill="#e6e6e6"/>
            <rect id="Rectangle_273" data-name="Rectangle 273" width="1.942" height="144.669" transform="matrix(0.255, -0.967, 0.967, 0.255, 373.751, 165.055)" fill="#e6e6e6"/>
            <rect id="Rectangle_274" data-name="Rectangle 274" width="1.942" height="144.669" transform="matrix(0.255, -0.967, 0.967, 0.255, 371.809, 174.769)" fill="#e6e6e6"/>
            <rect id="Rectangle_275" data-name="Rectangle 275" width="1.942" height="144.669" transform="matrix(0.255, -0.967, 0.967, 0.255, 369.866, 184.483)" fill="#e6e6e6"/>
            <rect id="Rectangle_276" data-name="Rectangle 276" width="1.942" height="144.669" transform="matrix(0.255, -0.967, 0.967, 0.255, 367.923, 194.196)" fill="#e6e6e6"/>
            <rect id="Rectangle_277" data-name="Rectangle 277" width="1.942" height="144.669" transform="matrix(0.255, -0.967, 0.967, 0.255, 365.98, 203.91)" fill="#e6e6e6"/>
            <rect id="Rectangle_278" data-name="Rectangle 278" width="1.942" height="144.669" transform="matrix(0.255, -0.967, 0.967, 0.255, 364.037, 213.624)" fill="#e6e6e6"/>
            <rect id="Rectangle_279" data-name="Rectangle 279" width="1.942" height="144.669" transform="matrix(0.255, -0.967, 0.967, 0.255, 362.094, 223.338)" fill="#e6e6e6"/>
            <rect id="Rectangle_280" data-name="Rectangle 280" width="1.942" height="144.669" transform="matrix(0.255, -0.967, 0.967, 0.255, 360.151, 233.053)" fill="#e6e6e6"/>
            <path id="Path_613" data-name="Path 613" d="M512.35,360.1s43.695-26.1,63.123-8.614-56.341,42.741-56.341,42.741Z" transform="translate(-200.5 -116.462)" fill="#9f616a"/>
            <path id="Path_614" data-name="Path 614" d="M464.734,372.861l56.341-21.371s-9.714,36.913,9.714,38.856l-27.2,33.028S449.192,423.374,464.734,372.861Z" transform="translate(-200.5 -116.462)" fill="#3f3d56"/>
            <path id="Path_615" data-name="Path 615" d="M412.494,255.6l74.761,25.2-17.693,38.566-74.761-25.2Z" fill="#e6e6e6"/>
            <path id="Path_616" data-name="Path 616" d="M544.967,173.831l56.341-42.742-15.542,52.456-58.284,42.741Z" fill="#ccc"/>
            <rect id="Rectangle_281" data-name="Rectangle 281" width="70.718" height="1.943" transform="matrix(0.797, -0.604, 0.604, 0.797, 517.184, 244.937)" fill="#e6e6e6"/>
            <rect id="Rectangle_282" data-name="Rectangle 282" width="70.718" height="1.943" transform="matrix(0.797, -0.604, 0.604, 0.797, 513.298, 266.307)" fill="#e6e6e6"/>
            <path id="Path_617" data-name="Path 617" d="M777.523,353.433s48.57-29.142,17.485-40.8-31.085,33.027-31.085,33.027S761.981,355.376,777.523,353.433Z" transform="translate(-200.5 -116.462)" fill="#9f616a"/>
            <path id="Path_618" data-name="Path 618" d="M292.4,171.888l-1.943,75.769,30.113-8.594-24.285.822Z" opacity="0.1"/>
            <path id="Path_619" data-name="Path 619" d="M280.909,712.354c6.073,22.45,26.875,36.354,26.875,36.354s10.955-22.495,4.882-44.945-26.875-36.354-26.875-36.354S274.835,689.9,280.909,712.354Z" transform="translate(-200.5 -116.462)" fill="#8985a8"/>
            <path id="Path_620" data-name="Path 620" d="M289.833,707.53c16.665,16.223,18.7,41.16,18.7,41.16s-24.984-1.364-41.648-17.587-18.7-41.16-18.7-41.16S273.168,691.307,289.833,707.53Z" transform="translate(-200.5 -116.462)" fill="#3f3d56"/>
            <rect id="Rectangle_283" data-name="Rectangle 283" width="30" height="30" transform="translate(626 379.158)" fill="#f2f2f2"/>
            <rect id="Rectangle_284" data-name="Rectangle 284" width="30" height="30" transform="translate(506 39.158)" fill="#f2f2f2"/>
            <circle id="Ellipse_16" data-name="Ellipse 16" cx="15" cy="15" r="15" transform="translate(144 313.158)" fill="#f2f2f2"/>
        </g>
        </svg> 
        <svg class="loginlogo" id="mobile" xmlns="http://www.w3.org/2000/svg" width="446.578" height="482.583" viewBox="0 0 846.578 682.583">
        <circle id="Ellipse_17" data-name="Ellipse 17" cx="97.2" cy="97.2" r="97.2" transform="translate(143.967 264.795)" fill="#e6e6e6"/>
        <path id="Path_621" data-name="Path 621" d="M391.617,612.641l23.91,14.816V527.306l-26.8-16.607a10.4,10.4,0,0,1-4.536-6.039h0a10.4,10.4,0,0,1,7.427,1.374l23.91,14.816V482.015a91.888,91.888,0,0,1,2.743-22.286,91.886,91.886,0,0,1,2.744,22.286V545.4l35.274-21.858a17.287,17.287,0,0,1,9.389-2.59,17.287,17.287,0,0,1-6.5,7.254l-38.164,23.649V790.708h-5.487V633.913l-26.8-16.607a10.4,10.4,0,0,1-4.536-6.039h0a10.4,10.4,0,0,1,7.427,1.374Z" transform="translate(-176.711 -108.708)" fill="#ccc"/>
        <circle id="Ellipse_18" data-name="Ellipse 18" cx="97.2" cy="97.2" r="97.2" transform="translate(0 273.047)" fill="#e6e6e6"/>
        <path id="Path_622" data-name="Path 622" d="M300.173,620.894l-23.91,14.816V535.559l26.8-16.607a10.4,10.4,0,0,0,4.536-6.039h0a10.4,10.4,0,0,0-7.427,1.374L276.263,529.1V490.268a91.889,91.889,0,0,0-2.744-22.286,91.885,91.885,0,0,0-2.744,22.286v63.387L235.5,531.8a17.286,17.286,0,0,0-9.389-2.59,17.287,17.287,0,0,0,6.5,7.254l38.164,23.649V789.231h5.487V642.166l26.8-16.607a10.4,10.4,0,0,0,4.536-6.039h0a10.4,10.4,0,0,0-7.427,1.374Z" transform="translate(-176.711 -108.708)" fill="#ccc"/>
        <circle id="Ellipse_19" data-name="Ellipse 19" cx="167.355" cy="167.355" r="167.355" transform="translate(0.453 0)" fill="#e6e6e6"/>
        <path id="Path_623" data-name="Path 623" d="M389.735,520.445l-41.167,25.51V373.519l46.143-28.593a17.9,17.9,0,0,0,7.81-10.4h0a17.9,17.9,0,0,0-12.787,2.366L348.568,362.4V295.539a158.21,158.21,0,0,0-4.724-38.371,158.207,158.207,0,0,0-4.724,38.371V404.676l-60.733-37.634a29.763,29.763,0,0,0-16.165-4.46,29.764,29.764,0,0,0,11.188,12.49l65.709,40.718V789.6h9.447V557.069l46.143-28.593a17.9,17.9,0,0,0,7.811-10.4h0A17.9,17.9,0,0,0,389.735,520.445Z" transform="translate(-176.711 -108.708)" fill="#ccc"/>
        <rect id="Rectangle_285" data-name="Rectangle 285" width="813" height="2" transform="translate(33.578 680.583)" fill="#3f3d56"/>
        <path id="Path_624" data-name="Path 624" d="M819.635,269.7h-2.27V155.743a38.99,38.99,0,0,0-38.99-38.99H524.585a38.99,38.99,0,0,0-38.99,38.99v49.93h-.86a2.29,2.29,0,0,0-2.29,2.29v22.33a2.29,2.29,0,0,0,2.29,2.29h.86v22.35h-1.06a2.29,2.29,0,0,0-2.29,2.29v42.259a2.29,2.29,0,0,0,2.29,2.29h1.06v16.39h-.96a2.29,2.29,0,0,0-2.29,2.29v42.66a2.29,2.29,0,0,0,2.29,2.29h.96v386.63a38.99,38.99,0,0,0,38.99,38.99h253.79a38.99,38.99,0,0,0,38.99-38.99v-400.6h2.27a2.29,2.29,0,0,0,2.29-2.29v-77.15a2.29,2.29,0,0,0-2.29-2.29Z" transform="translate(-176.711 -108.708)" fill="#3f3d56"/>
        <path id="Path_625" data-name="Path 625" d="M661.935,146.793h-38.59a4.375,4.375,0,0,1-4.37-4.369v-1.671a4.375,4.375,0,0,1,4.37-4.369h38.59a4.375,4.375,0,0,1,4.37,4.369v1.671A4.374,4.374,0,0,1,661.935,146.793Z" transform="translate(-176.711 -108.708)" fill="#fff"/>
        <circle id="Ellipse_20" data-name="Ellipse 20" cx="5.34" cy="5.34" r="5.34" transform="translate(496.094 27.545)" fill="#fff"/>
        <path id="Path_626" data-name="Path 626" d="M770.525,134.313h-38v4.57a21.7,21.7,0,0,1-21.7,21.7H589.765a21.69,21.69,0,0,1-21.7-21.68v-4.59h-35.63a26.35,26.35,0,0,0-26.35,26.35h0V747.1a26.35,26.35,0,0,0,26.35,26.35h238.09a26.34,26.34,0,0,0,26.34-26.34V160.663a26.34,26.34,0,0,0-26.33-26.35Z" transform="translate(-176.711 -108.708)" fill="#fff"/>
        <path id="Path_627" data-name="Path 627" d="M702.476,702.292h-102a27.5,27.5,0,0,1,0-55h102a27.5,27.5,0,1,1,0,55Z" transform="translate(-176.711 -108.708)" fill="#8d1d25"/>
        <path id="Path_628" data-name="Path 628" d="M742.476,476.4h-182a9.5,9.5,0,0,1,0-19h182a9.5,9.5,0,0,1,0,19Z" transform="translate(-176.711 -108.708)" fill="#e6e6e6"/>
        <path id="Path_629" data-name="Path 629" d="M742.476,504.4h-182a9.5,9.5,0,0,1,0-19h182a9.5,9.5,0,0,1,0,19Z" transform="translate(-176.711 -108.708)" fill="#e6e6e6"/>
        <path id="Path_630" data-name="Path 630" d="M742.476,532.4h-182a9.5,9.5,0,0,1,0-19h182a9.5,9.5,0,0,1,0,19Z" transform="translate(-176.711 -108.708)" fill="#e6e6e6"/>
        <path id="Path_631" data-name="Path 631" d="M742.476,560.4h-182a9.5,9.5,0,0,1,0-19h182a9.5,9.5,0,0,1,0,19Z" transform="translate(-176.711 -108.708)" fill="#e6e6e6"/>
        <path id="Path_632" data-name="Path 632" d="M618.476,588.4h-58a9.5,9.5,0,0,1,0-19h58a9.5,9.5,0,1,1,0,19Z" transform="translate(-176.711 -108.708)" fill="#e6e6e6"/>
        <path id="Path_633" data-name="Path 633" d="M770.961,398.552H531.989a7.977,7.977,0,0,1-7.968-7.968V213.222a7.977,7.977,0,0,1,7.968-7.968H770.961a7.977,7.977,0,0,1,7.968,7.968V390.584a7.977,7.977,0,0,1-7.968,7.968Z" transform="translate(-176.711 -108.708)" fill="#e6e6e6"/>
        <g id="Group_202" data-name="Group 202" opacity="0.1">
            <path id="Path_634" data-name="Path 634" d="M813.289,347.923q0-2.06,0-4.14a31.249,31.249,0,0,0,0,3.21C813.279,347.3,813.289,347.613,813.289,347.923Z" transform="translate(-176.711 -108.708)"/>
        </g>
        <circle id="Ellipse_21" data-name="Ellipse 21" cx="26.239" cy="26.239" r="26.239" transform="translate(650.203 265.371)" fill="#ffb8b8"/>
        <path id="Path_635" data-name="Path 635" d="M921.4,613.084a9.5,9.5,0,0,0-.645-14.549l-3.578-31.78-19.925,5.439,9.7,28.6A9.549,9.549,0,0,0,921.4,613.084Z" transform="translate(-176.711 -108.708)" fill="#ffb8b8"/>
        <path id="Path_636" data-name="Path 636" d="M759.242,665.281l11-7.113-22.2-45.8-16.231,10.5Z" fill="#ffb8b8"/>
        <path id="Path_637" data-name="Path 637" d="M932.583,759.919h41.163v15.9H947.893a15.309,15.309,0,0,1-15.31-15.311v-.594Z" transform="translate(1993.828 786.234) rotate(147.104)" fill="#2f2e41"/>
        <path id="Path_638" data-name="Path 638" d="M661.851,669.936h13.1l6.233-50.518h-19.33Z" fill="#ffb8b8"/>
        <path id="Path_639" data-name="Path 639" d="M835.755,774.9h41.163v15.9H851.065A15.309,15.309,0,0,1,835.756,775.5V774.9Z" transform="translate(1535.963 1456.999) rotate(180)" fill="#2f2e41"/>
        <path id="Path_640" data-name="Path 640" d="M891.127,452.418c-1.742,5.671,4.432,11.845,6.425,17.419s4.675,10.938,5.752,16.771c.737,4.01,17.445,92.6,16.641,97.994a20.79,20.79,0,0,0-15.459,1.418,45.947,45.947,0,0,1-5.874-19.113,99.964,99.964,0,0,1,.113-11.967c.519-11.27-4.367-22.556-4.529-33.834a63.745,63.745,0,0,0-.924-11.667c-.535-2.649-.486-7.608-1.061-10.249-.916-4.2,3.022-6.133,2.8-10.435l-1.2-23.5C893.566,461.144,889.434,456.1,891.127,452.418Z" transform="translate(-176.711 -108.708)" fill="#2f2e41"/>
        <path id="Path_641" data-name="Path 641" d="M831.888,551c-4.211,6.569-13.076,7.991-19.277,12.7-9.475,7.233,14.7,169.73,22.677,198.6,21.056-3.158,21.793-3.148,24.214-4.211s4.611-83.6,9.728-100.614c9.575,9.024,39.711,86.58,46.07,103.772,25.267-6.317,0,0,32.636-8.422-.274-5.959-48.228-200.124-49.976-215.421C876.021,541.765,853.766,546.639,831.888,551Z" transform="translate(-176.711 -108.708)" fill="#2f2e41"/>
        <path id="Path_642" data-name="Path 642" d="M829.049,428.979c-2.6,7.7.94,37.682,1.2,44.423a151.142,151.142,0,0,1,0,18.375c-.9,10.6-4.051,21.268-1.936,31.687,1.385,6.895,3.848,13.3,4.424,20.32.389,4.861.267,9.8,1.807,14.414,5.671-2.431,55.953-10.786,59.647-15.645-2.528-12.21-.081-24.817-1.758-37.172-.972-7.122-3.379-13.976-4.513-21.065-1.4-8.75-.81-17.824-3.362-26.323a75.779,75.779,0,0,0-5.372-12.453c-2.2-4.529-4.953-8.249-5.9-8.248C870.9,437.421,829.2,428.292,829.049,428.979Z" transform="translate(-176.711 -108.708)" fill="#8d1d25"/>
        <path id="Path_643" data-name="Path 643" d="M819.424,612.425s8.718-17.4,9.155-27.344c.154-3.573,9.941-17.792,14.349-21.017,10.452-7.656,18.157-58.975,14.624-71.427-6.109-21.527-16.4-41.6-26.842-61.381a4.472,4.472,0,0,0-1.458-1.855c-2.123-1.321-4.424,1.28-5.874,3.314-4.918,6.895-13.02,10.581-20.441,14.657s-15.013,9.5-17.257,17.662c-1.507,5.477-.332,11.286.81,16.836s5.137,9.957,8.159,14.632c3.5,5.159,12.6,28.04,12.534,30.755.178,16.787.348,33.632-1.685,50.305-1.142,9.423-2.147,28.357-2.147,28.357Z" transform="translate(-176.711 -108.708)" fill="#2f2e41"/>
        <path id="Path_644" data-name="Path 644" d="M898.6,594.438c-16.05-36.532-15.151-78.1-25.351-116.669-3.03-11.448-7.081-22.953-6.352-34.774.13-2.115.575-4.489,2.341-5.671,1.572-1.053,3.711-.77,5.436,0s3.2,2.026,4.861,2.884c2.682,1.369,5.8,1.758,8.378,3.306,3.824,2.3,5.777,6.676,7.486,10.792,3.654,8.791,7.292,17.824,7.583,27.352.616,18.505-7.592,36.289-3.314,54.284a107.77,107.77,0,0,0,3.306,10.484A318.748,318.748,0,0,1,913.5,584.351C913.983,586.547,899.27,595.978,898.6,594.438Z" transform="translate(-176.711 -108.708)" fill="#2f2e41"/>
        <path id="Path_645" data-name="Path 645" d="M847.644,585.794a9.5,9.5,0,0,0-9.586-10.963l-22.634-22.594-12.17,16.687,25.435,16.289a9.549,9.549,0,0,0,18.956.58Z" transform="translate(-176.711 -108.708)" fill="#ffb8b8"/>
        <path id="Path_646" data-name="Path 646" d="M775.527,534.483c.373,3.395,28.888,39.2,44.383,50.881-.9-4.61,11.246-19.647,15.175-22-9.82-9.263-30.336-30.748-31.015-31.922-2.22-4.286,0-9.406,1.936-13.838,6.1-14.089,8.977-30.075,5.064-44.926-1.475-5.574-4.051-11.156-8.742-14.584-2.05-1.491-4.821-2.512-7.1-1.377A7.883,7.883,0,0,0,792.8,458.9C785.533,467.739,775.252,531.964,775.527,534.483Z" transform="translate(-176.711 -108.708)" fill="#2f2e41"/>
        <path id="Path_647" data-name="Path 647" d="M841.969,423.278c1.532-6.5-6.212-20.487-4.68-26.987,1.037-4.4,11.389-1.41,13.8-5.233s6.462-6.921,10.984-6.972c5.2-.058,10.313,3.8,15.237,2.131,4.979-1.685,6.57-8.5,4.369-13.276s-6.943-7.814-11.628-10.2c-7.978-4.058-17.266-7.022-25.8-4.337-5.161,1.623-9.477,5.14-13.653,8.58-3.807,3.136-7.678,6.342-10.339,10.495-5.213,8.135-4.9,19.1-.444,27.669s12.573,14.865,21.519,18.517" transform="translate(-176.711 -108.708)" fill="#2f2e41"/>
        </svg>



             </div>
            <div class="thing">
                <section style="font-family:Montserrat; color:white;"class="signup-form">
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="70" height="70" viewBox="0 0 105.367 105.367">
                <defs>
                    <linearGradient id="linear-gradient" x1="1.363" y1="-0.243" x2="0.149" y2="0.921" gradientUnits="objectBoundingBox">
                    <stop offset="0" stop-color="#e26565"/>
                    <stop offset="1" stop-color="#8d1d25"/>
                    </linearGradient>
                </defs>
                <path id="Exclusion_11" data-name="Exclusion 11" d="M73.3,105.367H68.718V91.624H73.3v13.743Zm-9.162,0H59.555V91.624h4.582v13.743Zm-9.164,0h-4.58V91.624h4.58v13.743Zm-9.162,0h-4.58V91.624h4.58v13.743Zm-9.162,0h-4.58V91.624h4.58v13.743ZM77.88,87.042H27.487a9.173,9.173,0,0,1-9.162-9.162V27.487a9.173,9.173,0,0,1,9.162-9.162H77.88a9.173,9.173,0,0,1,9.162,9.162V77.88A9.173,9.173,0,0,1,77.88,87.042ZM52.35,76.876a1.414,1.414,0,0,1,.549.116c.644.268.81.76,1.062,1.5.044.131.091.27.144.417h1.924c.051-.143.1-.277.14-.406.253-.75.42-1.245,1.069-1.514a1.427,1.427,0,0,1,.546-.115,3,3,0,0,1,1.27.433c.122.061.251.125.389.19l1.364-1.361c-.065-.138-.128-.264-.189-.387-.352-.709-.584-1.177-.315-1.824s.767-.816,1.52-1.07c.126-.042.259-.087.4-.137V70.8c-.145-.052-.281-.1-.411-.142-.747-.252-1.24-.418-1.507-1.063s-.036-1.119.319-1.832c.059-.119.121-.244.185-.378l-1.364-1.362c-.134.064-.259.127-.378.186a2.994,2.994,0,0,1-1.279.436,1.421,1.421,0,0,1-.551-.117c-.646-.268-.812-.758-1.062-1.5-.044-.131-.091-.27-.144-.418H54.1c-.051.143-.1.278-.14.407-.252.748-.419,1.243-1.066,1.512a1.413,1.413,0,0,1-.55.117,3,3,0,0,1-1.277-.436c-.12-.06-.246-.123-.38-.187l-1.364,1.362c.065.136.127.262.188.384.353.71.586,1.178.318,1.826s-.761.812-1.507,1.063c-.13.044-.268.09-.413.142v1.927c.14.05.273.095.4.137.753.253,1.251.42,1.521,1.066s.036,1.121-.319,1.832c-.06.12-.123.246-.187.379L50.691,77.5c.135-.064.259-.126.38-.186A3.007,3.007,0,0,1,52.35,76.876Zm15.789-7.83a1.885,1.885,0,0,1,.73.154c.863.357,1.085,1.016,1.421,2.015.058.171.119.353.187.544h2.566c.067-.187.126-.364.183-.534.338-1,.56-1.667,1.429-2.028a1.894,1.894,0,0,1,.729-.154,3.983,3.983,0,0,1,1.689.575c.168.084.338.168.523.256l1.816-1.816c-.087-.184-.171-.354-.253-.518-.467-.944-.776-1.567-.419-2.427s1.025-1.089,2.033-1.427c.168-.056.342-.115.526-.18V60.938c-.191-.068-.369-.128-.542-.186-1-.337-1.659-.559-2.017-1.419s-.049-1.486.42-2.431c.08-.162.165-.333.252-.516l-1.816-1.817c-.177.085-.342.167-.5.246a4.024,4.024,0,0,1-1.713.583,1.893,1.893,0,0,1-.731-.154c-.862-.357-1.084-1.017-1.42-2.016-.058-.171-.118-.352-.186-.543H70.476c-.068.191-.128.37-.186.542-.336,1-.558,1.658-1.421,2.017a1.885,1.885,0,0,1-.733.155,3.994,3.994,0,0,1-1.7-.58c-.16-.08-.33-.165-.512-.251l-1.817,1.817c.087.182.17.351.251.514.47.946.78,1.571.422,2.433s-1.018,1.084-2.016,1.419c-.173.058-.352.118-.543.186v2.568c.186.066.36.124.529.181,1.006.337,1.67.56,2.03,1.423s.049,1.491-.422,2.435c-.081.163-.165.331-.251.513l1.817,1.816c.181-.086.347-.169.508-.249A4.018,4.018,0,0,1,68.139,69.047Zm-31.5-7.825a4,4,0,0,1,1.554.329c1.836.76,2.307,2.164,3.021,4.288.123.368.25.746.393,1.149h5.458c.143-.4.27-.778.392-1.142.715-2.126,1.187-3.531,3.034-4.3a3.991,3.991,0,0,1,1.549-.329,8.478,8.478,0,0,1,3.591,1.222c.353.175.715.355,1.108.542L60.6,59.121c-.186-.391-.365-.753-.539-1.1-.994-2-1.651-3.324-.894-5.156s2.166-2.3,4.293-3.016c.366-.123.745-.25,1.148-.394v-5.46c-.407-.145-.788-.273-1.156-.4-2.121-.714-3.521-1.186-4.281-3.015s-.1-3.164.9-5.176c.171-.343.347-.7.53-1.082l-3.858-3.861c-.386.184-.744.361-1.089.533a8.488,8.488,0,0,1-3.613,1.227,4.015,4.015,0,0,1-1.559-.329c-1.833-.76-2.3-2.162-3.018-4.285-.123-.367-.251-.746-.395-1.151h-5.46c-.144.4-.271.783-.394,1.15C40.5,29.73,40.03,31.133,38.2,31.892a4.032,4.032,0,0,1-1.561.331A8.49,8.49,0,0,1,33.033,31c-.349-.174-.709-.352-1.1-.537l-3.855,3.861c.185.389.363.748.535,1.095,1,2.006,1.655,3.331.9,5.163s-2.163,2.3-4.284,3.016c-.368.124-.749.252-1.155.4V49.45c.406.145.787.273,1.156.4,2.121.714,3.522,1.186,4.28,3.015s.1,3.163-.893,5.164c-.173.348-.352.707-.536,1.094l3.857,3.861c.391-.185.752-.364,1.1-.538A8.483,8.483,0,0,1,36.639,61.222Zm18.429,12.92a2.384,2.384,0,1,1,2.385-2.383A2.387,2.387,0,0,1,55.068,74.142Zm50.3-.843H91.624V68.718h13.743V73.3Zm-91.623,0H0V68.718H13.744V73.3Zm58.015-7.9a3.178,3.178,0,1,1,3.178-3.178A3.182,3.182,0,0,1,71.759,65.4Zm33.608-1.262H91.624V59.555h13.743v4.582Zm-91.623,0H0V59.555H13.744v4.582Zm91.623-9.164H91.624v-4.58h13.743v4.58Zm-91.623,0H0v-4.58H13.744v4.58ZM44.338,53.48a6.757,6.757,0,1,1,6.756-6.757A6.763,6.763,0,0,1,44.338,53.48Zm61.029-7.668H91.624v-4.58h13.743v4.58Zm-91.623,0H0v-4.58H13.744v4.58Zm91.623-9.162H91.624v-4.58h13.743v4.58Zm-91.623,0H0v-4.58H13.744v4.58ZM73.3,13.744H68.718V0H73.3V13.744Zm-9.162,0H59.555V0h4.582V13.744Zm-9.164,0h-4.58V0h4.58V13.744Zm-9.162,0h-4.58V0h4.58V13.744Zm-9.162,0h-4.58V0h4.58V13.744Z" fill="url(#linear-gradient)"/>
                </svg><br>
                <h2 style="font-weight: bold;">Join our family!</h2>
                <h5 style="font-weight: normal;">Nothing much.<br>Just the best website for the best AMC</h5>
                <form style="color: white; font-size:25px; font-weight:normal;" action="/swapproj/incsignup" method="POST">
                    <label for="uid">Username:</label><br>
                    <input type="text" id="uid" name="uid" placeholder="Username...">
                    <br><label for="firstname">First Name:</label><br>
                    <input type="text" id="firstname" name="firstname" placeholder="Full name...">
                    <br><label for="lastname">Last Name:</label><br>
                    <input type="text" id="lastname" name="lastname" placeholder="Last name...">
                    <br><label for="email">Email Address:</label><br>
                    <input type="text" id="email" name="email" placeholder="Email...">
                    <br><label for="phonenumber">Phone Number:</label><br>
                    <input type="text" id="phonenumber" name="phonenumber" placeholder="Phone...">
                    <br><label for="pwd">Password:</label><br>
                    <input type="password" id="pwd" name="pwd" placeholder="Password...">
                    <br><label for="email">Repeat Password:</label><br>
                    <input type="password" id="pwdrepeat" name="pwdrepeat" placeholder="Repeat Password...">
                    <br><label for="primaryschool">Primary School:</label><br>
                    <input type="text" id="primaryschool" name="primaryschool" placeholder="Primary school...">
                    <br><label for="favouritefood">Favourite Food:</label><br>
                    <input type="text" id="favouritefood" name="favouritefood" placeholder="Favourite food...">
                    <br><br><div class="g-recaptcha" data-sitekey="6LceTzMdAAAAAMmsVPxewTs4O4ujsgATF5_otzYu"></div>
                    <br><button type="submit" class="loginbtn" name="submit">Sign Up</button>
                </form>
                   
                    <?php #are you sure you want to use get..?

                        if (isset($_GET["error"])) {
                            if ($_GET["error"] == "emptyinput"){
                                echo "<p>Fill in all fields!</p>";
                            }
                            else if ($_GET["error"] == "invaliduid"){
                                echo "<p>Choose a proper username!</p>";
                            }
                            else if ($_GET["error"] == "invalidemail"){
                                echo "<p>Choose a proper email!</p>";
                            }
                            else if ($_GET["error"] == "passwordsdontmatch"){
                                echo "<p>Password dont match!</p>";
                            }
                            else if ($_GET["error"] == "stmtfailed"){
                                echo "<p>Something went wrong, try again!</p>";
                            }
                            else if ($_GET["error"] == "usernametaken"){
                                echo "<p>Username already taken!</p>";
                            }
                            else if ($_GET["error"] == "none"){
                                echo "<p>You have signed up!</p>";
                                header("location: ../swapproj/googleauth/");
                            }
                             else if ($_GET["error"] == "emptycaptcha") {
                                echo "<p>reCAPTHCA verification empty, please click the captcha.</p>";
                            } else if ($_GET["error"] == "badcaptcha") {
                                echo "<p>reCAPTHCA verification failed, please try again.</p>";
                            } else if ($_GET["error"] == "goodcaptcha") {
                                echo "<p>reCAPTHCA verification failed, please try again.</p>";
                            }
                         }
                    ?>
            </section>
            <p class="user">Already a user?<br><span onclick="location.href = 'https://www.swapamc.com/swapproj/login'">Login</span></p>
        </div>
            
            
        
    </div>
    <br><br><br><br><br><br><br><br>
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
