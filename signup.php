    <?php
    // if 	button 'submit'    => 
    require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
    $csrf = generateCSRF();



    if (isset($_GET["error"])) {

        $_GET = XSSPrevention($_GET, ['error']);

        //cleans GET items
        $retrieveditem = preg_replace('/[^a-z]+/', '', $_GET['error']);
        $whitelistvalues = ['emptyinput','invaliduid','invalidemail','passwordsdontmatch','stmtfailed','usernametaken','badinput','none'];
        $exemptkeys = []; // no exemptkeys are specified.
        cleanValues($_GET, $whitelistvalues, $exemptkeys);


        $error = htmlentities($_GET["error"]);

        if ($error == "emptyinput") {
            echo "<p>Fill in all fields!</p>";
        } else if ($error == "invaliduid") {
            echo "<p>Choose a proper username!</p>";
        } else if ($error == "invalidemail") {
            echo "<p>Choose a proper email!</p>";
        } else if ($error == "passwordsdontmatch") {
            echo "<p>Password dont match!</p>";
        } else if ($error == "stmtfailed") {
            echo "<p>Something went wrong, try again!</p>";
        } else if ($error == "usernametaken") {
            echo "<p>Username or Email already taken!</p>";
        } else if ($error == "badinput") {
            echo "<p>Please enter valid characters</p>";
        } else if ($error == "none") {
            echo "<p>You have signed up!</p>";
            header("location: https://www.swapamc.com/swapproj/googleauth/");
        }
    }

    ?>


    <html>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <style type="text/css">
        * {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
        }

        body {
            background: black;
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



        @media(max-width:850px) {

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
            background-color: rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(20px);
            -webkit-backdrop-filter: blur(20px);
            padding: 70px 0;
            width: 120%;
            margin: auto;
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: row;


        }

        .thing {
            padding: 2em;
            font-family: Montserrat;
            font-weight: bold;
            width: 100%;
            margin: auto;


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

        .ballshape {

            /* //mrgin-left:-500px; */
            position: absolute;
            bottom: -1050px;
            left: 300px;
            z-index: -2;
        }

        .ballshape2 {

            /* //mrgin-left:-500px; */
            position: absolute;
            bottom: -1100px;
            left: 1000px;
            z-index: -2;
        }

        .ballshape3 {

            /* //mrgin-left:-500px; */
            position: absolute;
            bottom: 370px;
            left: 960px;
            z-index: -2;
        }

        .cursor {
            position: fixed;
            width: 3rem;
            height: 3rem;
            border: 2px solid white;
            border-radius: 50%;

            transform: translate(-50%, -50%);
            pointer-events: none;
            transition: 0.1s;
            transition: all 0.5s ease;
            transition-property: width, height;
            /* transform-origin:100% 100%; */
            z-index: 100;

        }

        .link-grow {
            width: 10rem;
            height: 10rem;
            border: 2px dashed white;
            animation: animate 5s linear infinite;
            background: rgba(0, 0, 0, 0.3);

        }


        @keyframes animate {
            0% {
                transform: translate(-50%, -50%) rotate(0deg);
            }

            100% {
                transform: translate(-50%, -50%) rotate(360deg);
            }


        }
    </style>
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
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
                    <a href="https://www.swapamc.com/swapproj/home/">
                        <li>HOME</li>
                    </a>
                    <a href="https://www.swapamc.com/swapproj/faq">
                        <li>FAQs</li>
                    </a>
                    <a href="#">
                        <li>PRODUCTS</li>
                    </a>


                </ul>
            </div>
            <i class="fas fa-bars menu-icon" onclick="showMenu()" style="color:white"></i>

        </div>

        <div class="ballshape">
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
        <div class="ballshape2">
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
        <div class="container">

            <div class="thing" style="text-align:center;">
                <svg class="animated" id="freepik_stories-working-from-anywhere" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 500" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs"><style>svg#freepik_stories-working-from-anywhere:not(.animated) .animable {opacity: 0;}svg#freepik_stories-working-from-anywhere.animated #freepik--Character--inject-307 {animation: 1.5s Infinite  linear floating;animation-delay: 0s;}            @keyframes floating {                0% {                    opacity: 1;                    transform: translateY(0px);                }                50% {                    transform: translateY(-10px);                }                100% {                    opacity: 1;                    transform: translateY(0px);                }            }        </style><g id="freepik--background-complete--inject-307" class="animable" style="transform-origin: 250px 228.23px;"><rect y="382.4" width="500" height="0.25" style="fill: rgb(235, 235, 235); transform-origin: 250px 382.525px;" id="elbfvh4a83gi9" class="animable"></rect><rect x="416.78" y="398.49" width="33.12" height="0.25" style="fill: rgb(235, 235, 235); transform-origin: 433.34px 398.615px;" id="el7rwfku0kib" class="animable"></rect><rect x="322.53" y="401.21" width="8.69" height="0.25" style="fill: rgb(235, 235, 235); transform-origin: 326.875px 401.335px;" id="elobn4icqod2m" class="animable"></rect><rect x="396.59" y="389.21" width="19.19" height="0.25" style="fill: rgb(235, 235, 235); transform-origin: 406.185px 389.335px;" id="elmboid8515hf" class="animable"></rect><rect x="52.46" y="390.89" width="43.19" height="0.25" style="fill: rgb(235, 235, 235); transform-origin: 74.055px 391.015px;" id="ele3fvlw96st9" class="animable"></rect><rect x="104.56" y="390.89" width="6.33" height="0.25" style="fill: rgb(235, 235, 235); transform-origin: 107.725px 391.015px;" id="elk8pfv221mu" class="animable"></rect><rect x="131.47" y="395.11" width="93.68" height="0.25" style="fill: rgb(235, 235, 235); transform-origin: 178.31px 395.235px;" id="elhujwcqwtqev" class="animable"></rect><path d="M237,337.8H43.91a5.71,5.71,0,0,1-5.7-5.71V60.66A5.71,5.71,0,0,1,43.91,55H237a5.71,5.71,0,0,1,5.71,5.71V332.09A5.71,5.71,0,0,1,237,337.8ZM43.91,55.2a5.46,5.46,0,0,0-5.45,5.46V332.09a5.46,5.46,0,0,0,5.45,5.46H237a5.47,5.47,0,0,0,5.46-5.46V60.66A5.47,5.47,0,0,0,237,55.2Z" style="fill: rgb(235, 235, 235); transform-origin: 140.46px 196.4px;" id="el1m9ydot4rkw" class="animable"></path><path d="M453.31,337.8H260.21a5.72,5.72,0,0,1-5.71-5.71V60.66A5.72,5.72,0,0,1,260.21,55h193.1A5.71,5.71,0,0,1,459,60.66V332.09A5.71,5.71,0,0,1,453.31,337.8ZM260.21,55.2a5.47,5.47,0,0,0-5.46,5.46V332.09a5.47,5.47,0,0,0,5.46,5.46h193.1a5.47,5.47,0,0,0,5.46-5.46V60.66a5.47,5.47,0,0,0-5.46-5.46Z" style="fill: rgb(235, 235, 235); transform-origin: 356.75px 196.4px;" id="eloqwz8xju2ye" class="animable"></path><path d="M131,379.14H61.93c7.49-6.88,25.12-6.46,25.12-6.46s-12.23-13.13-7.72-21.56,16.59,10.05,16.59,10.05-15.19-27.49-9.54-34.34,20.84,30.1,20.84,30.1-9.23-39.11-3.68-40.22,11.35,37.09,11.35,37.09-2-34.92,2.67-33.92S120,366.44,120,366.44s4.7-23.25,6.7-15.83-2,23.31-2,23.31A6,6,0,0,1,131,379.14Z" style="fill: rgb(224, 224, 224); transform-origin: 96.465px 347.913px;" id="elrig11jueypg" class="animable"></path><path d="M167.24,379.14h89.69c-9.72-8.93-32.62-8.38-32.62-8.38s15.88-17.07,10-28-21.53,13-21.53,13,19.72-35.7,12.38-44.6-27.05,39.1-27.05,39.1,12-50.79,4.77-52.23-14.73,48.16-14.73,48.16,2.59-45.34-3.48-44.05-3.12,60.47-3.12,60.47-6.1-30.19-8.71-20.56,2.61,30.27,2.61,30.27C169.47,372.44,167.74,376.55,167.24,379.14Z" style="fill: rgb(224, 224, 224); transform-origin: 212.085px 338.57px;" id="el1gxv9j9yalz" class="animable"></path><path d="M249.48,379.14h69.07c-7.49-6.88-25.12-6.46-25.12-6.46s12.23-13.13,7.72-21.56-16.59,10.05-16.59,10.05,15.19-27.49,9.54-34.34-20.84,30.1-20.84,30.1,9.23-39.11,3.68-40.22-11.35,37.09-11.35,37.09,2-34.92-2.67-33.92-2.41,46.56-2.41,46.56-4.7-23.25-6.7-15.83,2,23.31,2,23.31A6,6,0,0,0,249.48,379.14Z" style="fill: rgb(224, 224, 224); transform-origin: 284.015px 347.913px;" id="elqaxig1eaed" class="animable"></path><path d="M114.59,379.14c-3.06-47-10.43-167.27-9.39-218.15l-4.91-.33s-4.9,153.28-2.22,218.48Z" style="fill: rgb(224, 224, 224); transform-origin: 105.929px 269.9px;" id="eln9pjip4zinh" class="animable"></path><polygon points="103.89 182.01 116.5 171.76 117.76 165.4 125.33 153.85 126.96 153.26 119.49 166.32 119.19 170.7 130.54 168.62 135.29 159.85 140.3 155.92 141.05 157.22 136.78 161.03 133.28 170.39 117.74 174.3 101.53 193.95 103.89 182.01" style="fill: rgb(224, 224, 224); transform-origin: 121.29px 173.605px;" id="el3ca9fjg5f5c" class="animable"></polygon><polygon points="101.42 172.48 100.81 176.78 87.18 163.73 78.78 162.07 72.3 157.6 72.74 157.17 78.9 161.09 85.72 161.41 79.26 153.38 72.9 148.75 73.33 148.48 79.71 152.61 90.21 163.24 89.17 153.52 86.74 149.39 86.5 148.25 89.56 152.75 97.54 150.12 98.21 150.62 90.02 153.53 91.5 164.25 101.42 172.48" style="fill: rgb(224, 224, 224); transform-origin: 86.86px 162.515px;" id="elr72g0sdr1ki" class="animable"></polygon><path d="M146.79,155.74c.31-1.74-2.45-3-5.43-3.19a37.68,37.68,0,0,1-6.51-1c.28-.62.08-1.37.48-2.45.87-2.36.4-3.95-2.21-6s-5.24-1.65-11-1-4.92-1.92-10.08-4.39-23.13-1.44-26.44.86c-2,1.38-9.75.57-11.9,3.95S58.84,145,60.52,148s3.71,3.07,3.37,8,4.13,3.28,8.59,5.13,3.86-1.62,6.78-1.84,2.11-.52,5.11-1.91,2.58.36,7.34,2.75c2.62,1.32,3.59-.28,4.4-2,.49,1.11-.06,2.73.92,4.61.79,1.5,3.94,1.84,6.94,1.56,3.29,6.24,4.7,1,8.82,1.48,4.35.47,10.89-3,13.95-3.33s3.27-1.15,6.43,1.31,16.81-2.34,18.1-4.81S146.48,157.48,146.79,155.74Z" style="fill: rgb(224, 224, 224); transform-origin: 105.909px 151.834px;" id="eldgu47fx2n8" class="animable"></path><path d="M203,379.14c-2.9-45.95-8-134.65-7.23-174.23l-4.2-.28s-3.65,113.88-2.28,174.51Z" style="fill: rgb(224, 224, 224); transform-origin: 195.991px 291.885px;" id="elnk9o6l8xha" class="animable"></path><polygon points="194.62 222.89 205.4 214.12 206.48 208.68 212.95 198.81 214.34 198.3 207.96 209.46 207.7 213.22 217.41 211.43 221.47 203.94 225.76 200.57 226.4 201.68 222.75 204.94 219.75 212.95 206.46 216.29 192.59 233.09 194.62 222.89" style="fill: rgb(224, 224, 224); transform-origin: 209.495px 215.695px;" id="el9g4nbmbjv1p" class="animable"></polygon><polygon points="192.5 214.74 191.98 218.41 180.32 207.25 173.14 205.83 167.6 202.01 167.98 201.64 173.24 204.99 179.07 205.27 173.55 198.4 168.11 194.44 168.48 194.21 173.94 197.74 182.92 206.83 182.03 198.52 179.94 194.98 179.74 194.01 182.36 197.86 189.19 195.61 189.76 196.04 182.76 198.53 184.02 207.7 192.5 214.74" style="fill: rgb(224, 224, 224); transform-origin: 180.05px 206.21px;" id="elhcox96wuz5s" class="animable"></polygon><path d="M231.31,200.42c.26-1.49-2.1-2.55-4.64-2.73a31.73,31.73,0,0,1-5.58-.88c.24-.53.07-1.18.41-2.1.75-2,.35-3.37-1.88-5.13s-4.49-1.41-9.38-.84-4.2-1.64-8.62-3.75-19.78-1.23-22.61.73c-1.7,1.18-8.34.5-10.18,3.39s-12.74,2.15-11.3,4.66,3.16,2.63,2.88,6.83,3.52,2.8,7.34,4.38,3.31-1.38,5.8-1.57,1.81-.44,4.37-1.63,2.21.3,6.28,2.35c2.24,1.13,3.07-.24,3.77-1.67.41.95-.06,2.34.78,3.94.67,1.29,3.37,1.58,5.93,1.34,2.81,5.34,4,.88,7.55,1.27,3.71.4,9.31-2.54,11.93-2.85s2.79-1,5.5,1.12,14.38-2,15.48-4.12S231,201.91,231.31,200.42Z" style="fill: rgb(224, 224, 224); transform-origin: 196.346px 197.078px;" id="elhwys0qz73za" class="animable"></path><path d="M169.82,333.31c-.93-6.58-18.44-141.87-22.41-225.81h-6.56s3.69,169.59,14.68,231.41Z" style="fill: rgb(230, 230, 230); transform-origin: 155.335px 223.205px;" id="el5fotveh1zsj" class="animable"></path><path d="M86.92,379.14H261.05c-18.89-10.3-63.33-9.66-63.33-9.66s30.83-19.67,19.46-32.27-41.81,15-41.81,15,38.28-41.14,24-51.4-52.53,45.06-52.53,45.06,23.25-58.54,9.27-60.2-28.61,55.51-28.61,55.51,5-52.26-6.75-50.77-6.07,69.69-6.07,69.69-11.84-34.79-16.9-23.7,5.08,34.89,5.08,34.89C91.23,371.42,87.88,376.16,86.92,379.14Z" style="fill: rgb(240, 240, 240); transform-origin: 173.985px 332.387px;" id="eldwi0fwhu7bm" class="animable"></path><polygon points="147.57 135.59 163.43 120.82 164.53 112.24 173.57 96.18 175.68 95.25 166.91 113.3 166.91 119.16 181.83 115.37 187.37 103.28 193.68 97.58 194.79 99.24 189.45 104.7 185.64 117.48 165.31 124.09 145.49 151.69 147.57 135.59" style="fill: rgb(230, 230, 230); transform-origin: 170.14px 123.47px;" id="el914hg3i4glc" class="animable"></polygon><polygon points="143.41 123.14 142.99 128.9 123.67 112.77 112.34 111.31 103.31 105.94 103.87 105.33 112.41 109.99 121.52 109.82 112.19 99.7 103.31 94.11 103.87 93.71 112.73 98.64 127.66 111.84 125.4 98.99 121.79 93.71 121.37 92.22 125.86 97.94 136.24 93.71 137.17 94.32 126.54 98.94 129.47 113.07 143.41 123.14" style="fill: rgb(230, 230, 230); transform-origin: 123.36px 110.56px;" id="elwm0385sisma" class="animable"></polygon><path d="M202.3,96.76c.25-2.34-3.53-3.75-7.51-3.75a51.65,51.65,0,0,1-8.76-.78c.31-.86,0-1.85.41-3.32.95-3.21.19-5.29-3.48-7.78s-7.13-1.73-14.68-.32-6.71-2.11-13.81-4.93-30.91.17-35.11,3.52c-2.52,2-12.93,1.64-15.49,6.34s-19.6,4.69-17.1,8.44S92,97.94,92,104.51s5.78,4,11.89,6,5-2.5,8.86-3.06,2.76-.88,6.63-3,3.46.24,10,3c3.61,1.52,4.76-.69,5.69-3,.74,1.44.17,3.65,1.64,6.06,1.18,1.93,5.41,2.09,9.37,1.45,4.94,8,6.35,1,11.88,1.18,5.82.23,14.22-4.93,18.27-5.69s4.24-1.82,8.68,1.16,22.16-4.62,23.65-8S202.05,99.11,202.3,96.76Z" style="fill: rgb(240, 240, 240); transform-origin: 147.633px 95.2808px;" id="el8eguujs74w7" class="animable"></path><path d="M426,106.08a6.77,6.77,0,0,0-6.77-6.77,6.6,6.6,0,0,0-1.94.29,14.34,14.34,0,0,0-14.18-16.41,14.41,14.41,0,0,0-2.64.25,12.52,12.52,0,0,0-23.22,6.33h-.21a11.55,11.55,0,1,0,0,23.09h42.38A6.77,6.77,0,0,0,426,106.08Z" style="fill: rgb(245, 245, 245); transform-origin: 395.575px 95.142px;" id="eliyfs7kolj6" class="animable"></path><path d="M279.92,169.28a6.76,6.76,0,0,0-6.77-6.76,6.89,6.89,0,0,0-1.94.28A14.34,14.34,0,0,0,257,146.39a14.41,14.41,0,0,0-2.64.25A12.53,12.53,0,0,0,231.16,153H231a11.55,11.55,0,1,0,0,23.09h42.38A6.76,6.76,0,0,0,279.92,169.28Z" style="fill: rgb(245, 245, 245); transform-origin: 249.515px 158.386px;" id="elkra55qvrg7" class="animable"></path><path d="M437.15,252.69a6.77,6.77,0,0,0-6.77-6.77,6.6,6.6,0,0,0-1.94.29,14.34,14.34,0,0,0-14.18-16.41,14.41,14.41,0,0,0-2.64.25,12.52,12.52,0,0,0-23.22,6.33h-.21a11.54,11.54,0,0,0,0,23.08h42.38A6.77,6.77,0,0,0,437.15,252.69Z" style="fill: rgb(245, 245, 245); transform-origin: 406.9px 241.744px;" id="elixkh6mjv17c" class="animable"></path><path d="M98.81,222.15a4.1,4.1,0,0,0-4.09-4.09,4.16,4.16,0,0,0-1.18.18A8.67,8.67,0,0,0,85,208.32a8.32,8.32,0,0,0-1.59.15,7.57,7.57,0,0,0-14,3.83h-.13a7,7,0,0,0,0,14H94.83A4.09,4.09,0,0,0,98.81,222.15Z" style="fill: rgb(245, 245, 245); transform-origin: 80.5452px 215.596px;" id="elawcedbx8xar" class="animable"></path><path d="M315.73,93.73a4.09,4.09,0,0,0-5.26-3.92,8.67,8.67,0,0,0-8.57-9.92,9.33,9.33,0,0,0-1.6.15,7.57,7.57,0,0,0-14,3.83h-.12a7,7,0,1,0,0,14h25.62A4.08,4.08,0,0,0,315.73,93.73Z" style="fill: rgb(245, 245, 245); transform-origin: 297.455px 87.1661px;" id="elxu4dly2be8f" class="animable"></path></g><g id="freepik--Shadow--inject-307" class="animable" style="transform-origin: 250px 416.24px;"><ellipse id="freepik--path--inject-307" cx="250" cy="416.24" rx="193.89" ry="11.32" style="fill: rgb(245, 245, 245); transform-origin: 250px 416.24px;" class="animable"></ellipse></g><g id="freepik--Tree--inject-307" class="animable" style="transform-origin: 358.427px 260.578px;"><path d="M372.25,400s-3.25-.17-3.57-9,5.4-11.26,9.8-10.17c0,0-.64-6.33,2.21-6.09s2.66,4.45,2.66,4.45,1-9,4.87-9,0,10.61,0,10.61,5.39-2.59,7.37,0-2.47,5.62-2.47,5.62,7,2.28,4.06,9.52c0,0,4.87.76,6.23,4,0,0-.39-6.55,1.37-6.11s1.36,6.18,1.36,6.18,2.92-6.3,5.45-4.08-1.16,7.57-1.16,7.57,4.87-2.36,5.64.77-2.72,4.3-2.72,4.3,5.06-1.17,5.06,4.64c0,0,9.74-.93,12.08,4.29h-58Z" style="fill: #8D1D25; transform-origin: 399.579px 393.845px;" id="el7snlcloehty" class="animable"></path><g id="elffyb6o9sa3c"><path d="M372.25,400s-3.25-.17-3.57-9,5.4-11.26,9.8-10.17c0,0-.64-6.33,2.21-6.09s2.66,4.45,2.66,4.45,1-9,4.87-9,0,10.61,0,10.61,5.39-2.59,7.37,0-2.47,5.62-2.47,5.62,7,2.28,4.06,9.52c0,0,4.87.76,6.23,4,0,0-.39-6.55,1.37-6.11s1.36,6.18,1.36,6.18,2.92-6.3,5.45-4.08-1.16,7.57-1.16,7.57,4.87-2.36,5.64.77-2.72,4.3-2.72,4.3,5.06-1.17,5.06,4.64c0,0,9.74-.93,12.08,4.29h-58Z" style="fill: rgb(255, 255, 255); opacity: 0.4; isolation: isolate; transform-origin: 399.579px 393.845px;" class="animable" id="elislw46146kn"></path></g><path d="M342.61,309c-1.4,23-9,108-9,108l54.91.51L373.08,263.92l24.64-7.52,5.17-14.93L423.7,229.7l10.17-15.62-3.93-1-11.23,14.42-13.1,2.85,5.61-13.29H405l-15.6,30.78-16,3.28-1.46-56c-16.08,7.51-21.22-5-21.22-5s-4.16,87.66-6.5,94.28h0a34.4,34.4,0,0,1-6.57-4.75,76.8,76.8,0,0,1-14-16.56l-1-1.65h-5Z" style="fill: #8D1D25; transform-origin: 375.76px 303.815px;" id="elxsauu3icwih" class="animable"></path><g id="eli9jhkhi86w"><g style="opacity: 0.2; isolation: isolate; transform-origin: 375.76px 303.815px;" class="animable" id="elojsldnexim"><path d="M342.61,309c-1.4,23-9,108-9,108l54.91.51L373.08,263.92l24.64-7.52,5.17-14.93L423.7,229.7l10.17-15.62-3.93-1-11.23,14.42-13.1,2.85,5.61-13.29H405l-15.6,30.78-16,3.28-1.46-56c-16.08,7.51-21.22-5-21.22-5s-4.16,87.66-6.5,94.28h0a34.4,34.4,0,0,1-6.57-4.75,76.8,76.8,0,0,1-14-16.56l-1-1.65h-5Z" id="elnjjl1ouv5vk" class="animable" style="transform-origin: 375.76px 303.815px;"></path></g></g><g id="ele8gfbow7ia4"><path d="M400.49,237.32l-6.69,12.9-20.93,5.3s.07-3.29.41-7.51l.09,3.16,16-3.28L405,217.11h6.24l-5.61,13.29,13.1-2.85,11.23-14.42.55.13-8.65,13.09Z" style="opacity: 0.1; isolation: isolate; transform-origin: 401.69px 234.325px;" class="animable" id="elshpdof93gw"></path></g><polygon points="370.36 341.56 375.3 417.39 366.59 417.31 366.59 357.46 370.36 341.56" style="fill: #8D1D25; isolation: isolate; transform-origin: 370.945px 379.475px;" id="elrn20b1g5uns" class="animable"></polygon><path d="M342.61,309l-25-47.51h5l1,1.65a76.8,76.8,0,0,0,14,16.56,34.4,34.4,0,0,0,6.57,4.75c2.34-6.62,6.5-94.28,6.5-94.28a12.92,12.92,0,0,0,8.44,7q.35,42.47.71,84.94c1.77-4,3.31-7.89,3.46-12.08.53,11.6,1.24,24.07,1.19,35.52l-9.62,35.49L353,417.18,333.64,417S341.21,332,342.61,309Z" style="fill: #8D1D25; isolation: isolate; transform-origin: 341.046px 303.675px;" id="eltn17d7bo6i" class="animable"></path><path d="M280.81,160.66c-8,2.86-13.53,11.33-13.28,19.84a22.8,22.8,0,0,0,13.87,19.76,25.17,25.17,0,0,0,24.19-3.19c.35,8.17,5.93,17.05,13.72,19.52a20.59,20.59,0,0,0,22-6.88c21,13.19,94.5,18.08,107.42-38.09,2.66-11.6-3.8-23.88-13.27-31.09s-21.51-10.16-33.32-11.61c-11.21-17.85-36.07-27.6-57-24.8s-39.46,18.61-45.57,38.78C278.28,143,280.5,162.09,280.81,160.66Z" style="fill: #8D1D25; transform-origin: 358.427px 160.958px;" id="elzfdrd4tfl7p" class="animable"></path><g id="elzv522axu33j"><g style="opacity: 0.2; isolation: isolate; transform-origin: 358.427px 160.958px;" class="animable" id="elc5996usxye"><path d="M280.81,160.66c-8,2.86-13.53,11.33-13.28,19.84a22.8,22.8,0,0,0,13.87,19.76,25.17,25.17,0,0,0,24.19-3.19c.35,8.17,5.93,17.05,13.72,19.52a20.59,20.59,0,0,0,22-6.88c21,13.19,94.5,18.08,107.42-38.09,2.66-11.6-3.8-23.88-13.27-31.09s-21.51-10.16-33.32-11.61c-11.21-17.85-36.07-27.6-57-24.8s-39.46,18.61-45.57,38.78C278.28,143,280.5,162.09,280.81,160.66Z" id="elxgrt8d5seuj" class="animable" style="transform-origin: 358.427px 160.958px;"></path></g></g><path d="M306.74,271.15A11.24,11.24,0,0,0,326.85,268c5,3.5,12.66,2.64,17.7-.77A15.11,15.11,0,0,0,338,239.73,18,18,0,0,0,329.57,226a19.61,19.61,0,0,0-16.78-1.77A20.55,20.55,0,0,0,294.93,230c-3.37,3.27-5.61,7.91-5.22,12.59s3.81,9.17,8.42,10.06a13.79,13.79,0,0,0-.48,10.95C299.14,267.08,303.16,269.82,306.74,271.15Z" style="fill: #8D1D25; transform-origin: 320.428px 249.606px;" id="elwcvyjgy9abk" class="animable"></path><g id="elmvs6og9e06p"><path d="M306.74,271.15A11.24,11.24,0,0,0,326.85,268c5,3.5,12.66,2.64,17.7-.77A15.11,15.11,0,0,0,338,239.73,18,18,0,0,0,329.57,226a19.61,19.61,0,0,0-16.78-1.77A20.55,20.55,0,0,0,294.93,230c-3.37,3.27-5.61,7.91-5.22,12.59s3.81,9.17,8.42,10.06a13.79,13.79,0,0,0-.48,10.95C299.14,267.08,303.16,269.82,306.74,271.15Z" style="opacity: 0.2; isolation: isolate; transform-origin: 320.428px 249.606px;" class="animable" id="el8hgumxbed5m"></path></g><path d="M412.56,186.23a11.24,11.24,0,0,0-14.18,14.6c-6.08.19-11.71,5.5-13.69,11.25a15.1,15.1,0,0,0,21.71,18.07,18,18,0,0,0,15,5.9,19.65,19.65,0,0,0,14.49-8.66,20.56,20.56,0,0,0,10.84-15.31c.73-4.63-.26-9.69-3.39-13.2s-8.55-5-12.77-3a13.79,13.79,0,0,0-6.19-9C421.09,184.93,416.22,185.15,412.56,186.23Z" style="fill: #8D1D25; transform-origin: 415.411px 210.767px;" id="elvlzkyi2rqg" class="animable"></path><g id="ely69i1t90xj"><path d="M412.56,186.23a11.24,11.24,0,0,0-14.18,14.6c-6.08.19-11.71,5.5-13.69,11.25a15.1,15.1,0,0,0,21.71,18.07,18,18,0,0,0,15,5.9,19.65,19.65,0,0,0,14.49-8.66,20.56,20.56,0,0,0,10.84-15.31c.73-4.63-.26-9.69-3.39-13.2s-8.55-5-12.77-3a13.79,13.79,0,0,0-6.19-9C421.09,184.93,416.22,185.15,412.56,186.23Z" style="opacity: 0.1; isolation: isolate; transform-origin: 415.411px 210.767px;" class="animable" id="elnxw0ebwncal"></path></g><path d="M375.45,415.29S355.28,402.22,359.11,400s17.27,10.85,17.27,10.85-14.86-21.74-11.19-26.1,13.56,17.72,13.56,17.72-6.72-25.24-2-28,6.47,25.29,6.47,25.29,1.85-30.4,10.55-30-4,30-4,30,12.27-17.59,16.62-12.6-13.85,19-13.85,19,13.61-6.39,14.52-1.65-15,9.79-15,9.79,5.11,1.47,6.3,3.19H371.18S370.74,416.2,375.45,415.29Z" style="fill: #8D1D25; transform-origin: 382.862px 393.623px;" id="elqkc7g0h0nq" class="animable"></path><g id="elxq5mahxydum"><path d="M375.45,415.29S355.28,402.22,359.11,400s17.27,10.85,17.27,10.85-14.86-21.74-11.19-26.1,13.56,17.72,13.56,17.72-6.72-25.24-2-28,6.47,25.29,6.47,25.29,1.85-30.4,10.55-30-4,30-4,30,12.27-17.59,16.62-12.6-13.85,19-13.85,19,13.61-6.39,14.52-1.65-15,9.79-15,9.79,5.11,1.47,6.3,3.19H371.18S370.74,416.2,375.45,415.29Z" style="fill: rgb(255, 255, 255); opacity: 0.6; isolation: isolate; transform-origin: 382.862px 393.623px;" class="animable" id="elb085ha262ve"></path></g></g><g id="freepik--Stone--inject-307" class="animable" style="transform-origin: 214.47px 359.757px;"><path d="M114.67,364.63c-.07-.36-6.83-35.43-13.43-40.1-6.41-4.52-12,1.69-12.2,2l-.75-.65c.06-.08,6.39-7.15,13.52-2.11,6.94,4.89,13.56,39.26,13.84,40.72Z" style="fill: #8D1D25; transform-origin: 101.97px 343.294px;" id="eltgujrvwdb4i" class="animable"></path><path d="M112.16,367.52c0-.24-2.5-24.35-10.27-31.75-1.88-1.79-3.72-2.49-5.47-2.08-4.16.95-6.73,7.68-6.75,7.75l-.94-.35c.11-.3,2.78-7.3,7.46-8.38,2.1-.48,4.25.3,6.39,2.33,8,7.66,10.48,31.38,10.58,32.38Z" style="fill: #8D1D25; transform-origin: 100.945px 350.046px;" id="el3l3sciulwbf" class="animable"></path><path d="M107.5,328.37s4.52-.91,5.39,3-7.52,16.31-7.52,16.31-7.62-1.47-7.62-11.49S106,326.14,107.5,328.37Z" style="fill: #8D1D25; transform-origin: 105.352px 337.428px;" id="elnq49yqzt5z" class="animable"></path><g id="elxsnl9qtf01"><path d="M107.5,328.37s4.52-.91,5.39,3-7.52,16.31-7.52,16.31-7.62-1.47-7.62-11.49S106,326.14,107.5,328.37Z" style="fill: rgb(255, 255, 255); opacity: 0.2; isolation: isolate; transform-origin: 105.352px 337.428px;" class="animable" id="elot014tehae7"></path></g><path d="M95.83,335.93s1.82-2-.57-2.49S81.84,335,83.45,346c0,0,13.24.11,14.18-4.33S95.83,335.93,95.83,335.93Z" style="fill: #8D1D25; transform-origin: 90.5583px 339.687px;" id="el6hcx77o7t84" class="animable"></path><g id="ely1ntmah3d88"><path d="M95.83,335.93s1.82-2-.57-2.49S81.84,335,83.45,346c0,0,13.24.11,14.18-4.33S95.83,335.93,95.83,335.93Z" style="fill: rgb(255, 255, 255); opacity: 0.2; isolation: isolate; transform-origin: 90.5583px 339.687px;" class="animable" id="el0kpkgutb5b3k"></path></g><path d="M112.83,317.08s-.51-2,1.27-1.48,8.55,5.86,3.49,12.72c0,0-9-4.7-8-8S112.83,317.08,112.83,317.08Z" style="fill: #8D1D25; transform-origin: 114.473px 321.917px;" id="el5v0s8y1i64r" class="animable"></path><g id="eldqfsham165c"><path d="M112.83,317.08s-.51-2,1.27-1.48,8.55,5.86,3.49,12.72c0,0-9-4.7-8-8S112.83,317.08,112.83,317.08Z" style="fill: rgb(255, 255, 255); opacity: 0.2; isolation: isolate; transform-origin: 114.473px 321.917px;" class="animable" id="elv5ar46ms0it"></path></g><path d="M279.18,371.82l-1-.27c.12-.41,11.66-41.48,32.53-52.54l.47.88C290.72,330.76,279.29,371.41,279.18,371.82Z" style="fill: #8D1D25; transform-origin: 294.68px 345.415px;" id="el0529ggzymozg" class="animable"></path><path d="M279.37,367.18l-.91-.42c.21-.43,20.12-43.95,13.26-57.77l.89-.44C299.69,322.79,280.2,365.38,279.37,367.18Z" style="fill: #8D1D25; transform-origin: 286.308px 337.865px;" id="el34d4c7b5518" class="animable"></path><path d="M278.59,370.33l-1-.29c.68-2.26,16.67-55.37,26.9-61.9l.54.84C295.15,315.31,278.75,369.78,278.59,370.33Z" style="fill: #8D1D25; transform-origin: 291.31px 339.235px;" id="elq7z9dkipqj" class="animable"></path><path d="M295.32,310.7s3,.79,3.43-1-8.75-10.51-18-5.72c0,0,1.4,8.66,7.32,11S295.32,310.7,295.32,310.7Z" style="fill: #8D1D25; transform-origin: 289.757px 309.021px;" id="el0wohpaqcb3g" class="animable"></path><g id="elguksescdgz"><path d="M295.32,310.7s3,.79,3.43-1-8.75-10.51-18-5.72c0,0,1.4,8.66,7.32,11S295.32,310.7,295.32,310.7Z" style="fill: rgb(255, 255, 255); opacity: 0.2; isolation: isolate; transform-origin: 289.757px 309.021px;" class="animable" id="ele4ptr5p673"></path></g><path d="M302.29,308.51s-3.08.26-3.19-1.62,10.45-8.83,18.69-2.5c0,0-2.9,8.28-9.14,9.59S302.29,308.51,302.29,308.51Z" style="fill: #8D1D25; transform-origin: 308.445px 307.966px;" id="elss2yth5ltt" class="animable"></path><g id="el040stqkwtash"><path d="M302.29,308.51s-3.08.26-3.19-1.62,10.45-8.83,18.69-2.5c0,0-2.9,8.28-9.14,9.59S302.29,308.51,302.29,308.51Z" style="fill: rgb(255, 255, 255); opacity: 0.2; isolation: isolate; transform-origin: 308.445px 307.966px;" class="animable" id="elnyxwlnvujus"></path></g><path d="M312.06,316.82s-1.36-2.35,1.07-2.31,12.82,4.28,8.95,14.69c0,0-13-2.65-13-7.18S312.06,316.82,312.06,316.82Z" style="fill: #8D1D25; transform-origin: 316.007px 321.855px;" id="eln7wx5ue9adb" class="animable"></path><g id="elnsa29amjr7e"><path d="M312.06,316.82s-1.36-2.35,1.07-2.31,12.82,4.28,8.95,14.69c0,0-13-2.65-13-7.18S312.06,316.82,312.06,316.82Z" style="fill: rgb(255, 255, 255); opacity: 0.2; isolation: isolate; transform-origin: 316.007px 321.855px;" class="animable" id="elrbcrlul9e3f"></path></g><path d="M302.41,322.7s.57-2,1.85-.64,4.47,9.34-3.33,12.76c0,0-5.45-8.56-2.95-11S302.41,322.7,302.41,322.7Z" style="fill: #8D1D25; transform-origin: 301.662px 328.203px;" id="el2jw8jshwhyg" class="animable"></path><g id="eltt61k8avhm8"><path d="M302.41,322.7s.57-2,1.85-.64,4.47,9.34-3.33,12.76c0,0-5.45-8.56-2.95-11S302.41,322.7,302.41,322.7Z" style="fill: rgb(255, 255, 255); opacity: 0.2; isolation: isolate; transform-origin: 301.662px 328.203px;" class="animable" id="elbdpnqe015zm"></path></g><path d="M91.93,323.38s1-1.84-.87-1.75-9.73,3.57-6.52,11.46c0,0,9.88-2.33,9.77-5.8S91.93,323.38,91.93,323.38Z" style="fill: #8D1D25; transform-origin: 89.0447px 327.358px;" id="elhnuqlc5q27q" class="animable"></path><g id="elmx28fcq7z"><path d="M91.93,323.38s1-1.84-.87-1.75-9.73,3.57-6.52,11.46c0,0,9.88-2.33,9.77-5.8S91.93,323.38,91.93,323.38Z" style="fill: rgb(255, 255, 255); opacity: 0.2; isolation: isolate; transform-origin: 89.0447px 327.358px;" class="animable" id="elnlvkj3yawq"></path></g><path d="M267.68,391.53s-6.6-.26-7.25-13.57,11-16.86,19.91-15.23c0,0-1.31-9.48,4.49-9.13s5.4,6.68,5.4,6.68,2-13.44,9.89-13.45,0,15.9,0,15.9,10.95-3.88,15,0-5,8.42-5,8.42,14.19,3.41,8.26,14.27c0,0,9.89,1.14,12.66,6,0,0-.79-9.81,2.77-9.15s2.76,9.26,2.76,9.26,5.94-9.45,11.08-6.11-2.37,11.34-2.37,11.34,9.89-3.54,11.47,1.15-5.54,6.45-5.54,6.45,10.29-1.76,10.29,6.95c0,0,19.78-1.4,24.53,6.42H268.08Z" style="fill: #8D1D25; transform-origin: 323.217px 382.28px;" id="elwxaat353l38" class="animable"></path><g id="el2r8eq23og5k"><path d="M267.68,391.53s-6.6-.26-7.25-13.57,11-16.86,19.91-15.23c0,0-1.31-9.48,4.49-9.13s5.4,6.68,5.4,6.68,2-13.44,9.89-13.45,0,15.9,0,15.9,10.95-3.88,15,0-5,8.42-5,8.42,14.19,3.41,8.26,14.27c0,0,9.89,1.14,12.66,6,0,0-.79-9.81,2.77-9.15s2.76,9.26,2.76,9.26,5.94-9.45,11.08-6.11-2.37,11.34-2.37,11.34,9.89-3.54,11.47,1.15-5.54,6.45-5.54,6.45,10.29-1.76,10.29,6.95c0,0,19.78-1.4,24.53,6.42H268.08Z" style="fill: rgb(255, 255, 255); opacity: 0.4; isolation: isolate; transform-origin: 323.217px 382.28px;" class="animable" id="elwfeog32008"></path></g><path d="M130.06,391.53s4.87-.26,5.35-13.57-8.09-16.86-14.69-15.23c0,0,1-9.48-3.31-9.13s-4,6.68-4,6.68-1.46-13.44-7.3-13.45,0,15.9,0,15.9-8.07-3.88-11,0,3.71,8.42,3.71,8.42-10.47,3.41-6.09,14.27c0,0-7.3,1.14-9.34,6,0,0,.58-9.81-2-9.15s-2,9.26-2,9.26-4.37-9.45-8.17-6.11,1.75,11.34,1.75,11.34-7.29-3.54-8.46,1.15,4.09,6.45,4.09,6.45-7.59-1.76-7.59,6.95c0,0-14.59-1.4-18.1,6.42h87Z" style="fill: #8D1D25; transform-origin: 89.1697px 382.28px;" id="elv6ymhrpgtkj" class="animable"></path><g id="elxb2zre440qt"><path d="M130.06,391.53s4.87-.26,5.35-13.57-8.09-16.86-14.69-15.23c0,0,1-9.48-3.31-9.13s-4,6.68-4,6.68-1.46-13.44-7.3-13.45,0,15.9,0,15.9-8.07-3.88-11,0,3.71,8.42,3.71,8.42-10.47,3.41-6.09,14.27c0,0-7.3,1.14-9.34,6,0,0,.58-9.81-2-9.15s-2,9.26-2,9.26-4.37-9.45-8.17-6.11,1.75,11.34,1.75,11.34-7.29-3.54-8.46,1.15,4.09,6.45,4.09,6.45-7.59-1.76-7.59,6.95c0,0-14.59-1.4-18.1,6.42h87Z" style="fill: rgb(255, 255, 255); opacity: 0.4; isolation: isolate; transform-origin: 89.1697px 382.28px;" class="animable" id="el40m4gkw9qog"></path></g><path d="M86.64,415.51S106.8,402.44,103,400.24,85.7,411.08,85.7,411.08s14.86-21.74,11.19-26.1S83.33,402.7,83.33,402.7s6.72-25.24,2-28S78.84,400,78.84,400,77,369.59,68.29,370s4,30,4,30S60,382.39,55.64,387.39s13.84,19,13.84,19S55.87,400,55,404.76s15,9.79,15,9.79-5.12,1.47-6.3,3.18H90.91S91.34,416.43,86.64,415.51Z" style="fill: #8D1D25; transform-origin: 79.2211px 393.863px;" id="el1n9dva5f8pr" class="animable"></path><g id="el8u8lqyshe6v"><path d="M86.64,415.51S106.8,402.44,103,400.24,85.7,411.08,85.7,411.08s14.86-21.74,11.19-26.1S83.33,402.7,83.33,402.7s6.72-25.24,2-28S78.84,400,78.84,400,77,369.59,68.29,370s4,30,4,30S60,382.39,55.64,387.39s13.84,19,13.84,19S55.87,400,55,404.76s15,9.79,15,9.79-5.12,1.47-6.3,3.18H90.91S91.34,416.43,86.64,415.51Z" style="fill: rgb(255, 255, 255); opacity: 0.6; isolation: isolate; transform-origin: 79.2211px 393.863px;" class="animable" id="el151n6q0glcd"></path></g><path d="M96.73,417.73s23.2-85.37,27.42-88.53,28.29-12.07,28.29-12.07,58.55,9.78,67.35,8.81,37.08-6.41,41.14,0S281,370.87,281,370.87l22.49,9.49,14.25,37.37Z" style="fill: #8D1D25; transform-origin: 207.235px 367.43px;" id="elm3m5i6hope" class="animable"></path><g id="elgun9x1zkn1"><path d="M317.74,417.73h-221s23.09-85,27.39-88.52l0,0a31.57,31.57,0,0,1,4.73-2.55c8.36-3.89,23.56-9.51,23.56-9.51s58.55,9.78,67.35,8.81,37.08-6.42,41.14,0c.86,1.37,2.27,4.19,3.95,7.79C271.08,347,281,370.86,281,370.86l22.49,9.5Z" style="fill: rgb(255, 255, 255); opacity: 0.6; isolation: isolate; transform-origin: 207.24px 367.44px;" class="animable" id="elwribbgym3ie"></path></g><g id="ele7bq4qttp0o"><path d="M264.88,333.73l-8.73,8.64L233.4,337l-25.74,5.35,1.65,9.95-9.37,11.16,3.33-11.16L196,340.05s-29.62,1.8-37.35,0c-4.85-1.13-19.52-8.27-29.74-13.41,8.36-3.89,23.56-9.51,23.56-9.51s58.55,9.78,67.35,8.81,37.08-6.42,41.14,0C261.79,327.31,263.2,330.13,264.88,333.73Z" style="opacity: 0.1; isolation: isolate; transform-origin: 196.895px 340.295px;" class="animable" id="elb1qibh735xj"></path></g><g id="elt9klzlsyp"><path d="M317.74,417.73h-221s23.09-85,27.39-88.52l0,0-14.24,66.24,7.12,11,17.5-13.28L148,400.61l18.62-3.76,1.85-9,26.38-17.35-16.56,15.34,5.83,17.5,25.35,4.37h28L249,400l-3.86-15.7-5.83-9.1,29.55-.07-12.58,7.79,4.64,13.83,14.23,6.6,16.54-10.21,6.74,19.48Z" style="opacity: 0.1; isolation: isolate; transform-origin: 207.24px 373.47px;" class="animable" id="elnsq9bfq7eo"></path></g><path d="M288.2,417.73h36.63s-7.29-11.16-10.4-9.74c-4.05,1.84-7.05-8.27-11.53-5.88-1.58.85-.8,3.55-1.8,4.64-1.64,1.8-3.73,1.45-5.71,2.44C291.5,411.13,290.12,413.69,288.2,417.73Z" style="fill: #8D1D25; transform-origin: 306.515px 409.736px;" id="ely3edkw36iv" class="animable"></path><g id="elh13ugteddjd"><path d="M288.2,417.73h36.63s-7.29-11.16-10.4-9.74c-4.05,1.84-7.05-8.27-11.53-5.88-1.58.85-.8,3.55-1.8,4.64-1.64,1.8-3.73,1.45-5.71,2.44C291.5,411.13,290.12,413.69,288.2,417.73Z" style="opacity: 0.2; isolation: isolate; transform-origin: 306.515px 409.736px;" class="animable" id="elfgw0j0vh1lr"></path></g><path d="M320.83,414.62s-2.41-13.95-.75-16,1.95,7.61,1.95,7.61,5.58-20.16,9.15-20.26S327,403.46,327,403.46s15.26-24.94,19.69-22.62-16,24.43-16,24.43,11.16-9.61,13.62-6.89-12.39,11-12.39,11,6.55-1.47,6.54.71S327.38,415.86,320.83,414.62Z" style="fill: #8D1D25; transform-origin: 333.408px 397.781px;" id="eleidcqyrbrmt" class="animable"></path><g id="eltzzn0e4rgd"><path d="M320.83,414.62s-2.41-13.95-.75-16,1.95,7.61,1.95,7.61,5.58-20.16,9.15-20.26S327,403.46,327,403.46s15.26-24.94,19.69-22.62-16,24.43-16,24.43,11.16-9.61,13.62-6.89-12.39,11-12.39,11,6.55-1.47,6.54.71S327.38,415.86,320.83,414.62Z" style="fill: rgb(255, 255, 255); opacity: 0.2; isolation: isolate; transform-origin: 333.408px 397.781px;" class="animable" id="elh3e0oisqnoe"></path></g><path d="M318.63,412.63s-11.47-2.08-12.58-3.94,6.43.64,6.43.64-14-10-13.09-12.8,12.33,8.21,12.33,8.21-15-18.84-11.93-21.62,14.39,19.26,14.39,19.26-4.28-11.35-1.49-12.49,5,12.7,5,12.7.71-5.48,2.39-4.86S321.44,407.91,318.63,412.63Z" style="fill: #8D1D25; transform-origin: 310.226px 397.754px;" id="el5ovd6pqk2p" class="animable"></path><g id="ellrtgt72zrlk"><path d="M318.63,412.63s-11.47-2.08-12.58-3.94,6.43.64,6.43.64-14-10-13.09-12.8,12.33,8.21,12.33,8.21-15-18.84-11.93-21.62,14.39,19.26,14.39,19.26-4.28-11.35-1.49-12.49,5,12.7,5,12.7.71-5.48,2.39-4.86S321.44,407.91,318.63,412.63Z" style="fill: rgb(255, 255, 255); opacity: 0.2; isolation: isolate; transform-origin: 310.226px 397.754px;" class="animable" id="el7wpilr1oodb"></path></g><path d="M317.77,411.1s-11.08-11.09-10.88-14,6.62,5.64,6.62,5.64-7.81-21.81-4.64-24.18,7.32,18.54,7.32,18.54-2.1-32.32,3.4-33,1.12,32.3,1.12,32.3,4-15.81,7.94-14.93-4.2,17.87-4.2,17.87,5-5.51,6.37-3.53S324.49,408,317.77,411.1Z" style="fill: #8D1D25; transform-origin: 318.934px 387.595px;" id="elsd6ddnwvaop" class="animable"></path><g id="elzhdhb7knp1"><path d="M317.77,411.1s-11.08-11.09-10.88-14,6.62,5.64,6.62,5.64-7.81-21.81-4.64-24.18,7.32,18.54,7.32,18.54-2.1-32.32,3.4-33,1.12,32.3,1.12,32.3,4-15.81,7.94-14.93-4.2,17.87-4.2,17.87,5-5.51,6.37-3.53S324.49,408,317.77,411.1Z" style="fill: rgb(255, 255, 255); opacity: 0.1; isolation: isolate; transform-origin: 318.934px 387.595px;" class="animable" id="el21ookj2w8nl"></path></g><path d="M304.34,417.73h29.19s-5.81-8.89-8.29-7.76c-3.22,1.47-5.61-6.59-9.18-4.68-1.26.67-.65,2.82-1.44,3.69-1.31,1.44-3,1.16-4.55,1.95C307,412.47,305.87,414.51,304.34,417.73Z" style="fill: #8D1D25; transform-origin: 318.935px 411.363px;" id="el85jpw9x9y8m" class="animable"></path><path d="M122,417.73H85.4s7.3-11.16,10.41-9.74c4,1.84,7-8.27,11.52-5.88,1.58.85.81,3.55,1.81,4.64,1.64,1.8,3.73,1.45,5.71,2.44C118.74,411.13,120.12,413.69,122,417.73Z" style="fill: #8D1D25; transform-origin: 103.7px 409.736px;" id="elnji1w6ryqy8" class="animable"></path><g id="elg2rszqx1q2f"><path d="M122,417.73H85.4s7.3-11.16,10.41-9.74c4,1.84,7-8.27,11.52-5.88,1.58.85.81,3.55,1.81,4.64,1.64,1.8,3.73,1.45,5.71,2.44C118.74,411.13,120.12,413.69,122,417.73Z" style="opacity: 0.2; isolation: isolate; transform-origin: 103.7px 409.736px;" class="animable" id="elu0bd3thjam"></path></g><path d="M89.41,414.62s2.4-13.95.74-16-2,7.61-2,7.61S82.62,386.07,79.05,386s4.24,17.49,4.24,17.49S68,378.52,63.59,380.84s16,24.43,16,24.43-11.17-9.61-13.63-6.89,12.4,11,12.4,11-6.55-1.47-6.54.71S82.85,415.86,89.41,414.62Z" style="fill: #8D1D25; transform-origin: 76.8505px 397.781px;" id="elzp0o6hlczpj" class="animable"></path><g id="elupqud7kaw1"><path d="M89.41,414.62s2.4-13.95.74-16-2,7.61-2,7.61S82.62,386.07,79.05,386s4.24,17.49,4.24,17.49S68,378.52,63.59,380.84s16,24.43,16,24.43-11.17-9.61-13.63-6.89,12.4,11,12.4,11-6.55-1.47-6.54.71S82.85,415.86,89.41,414.62Z" style="fill: rgb(255, 255, 255); opacity: 0.2; isolation: isolate; transform-origin: 76.8505px 397.781px;" class="animable" id="elkf8gklr14fi"></path></g><path d="M100.65,415.28s8.73-7.73,8.72-9.9-5.17,3.89-5.17,3.89,6.8-15.83,4.56-17.73S102.47,405,102.47,405s3-23.88-1-24.67-2.32,23.92-2.32,23.92-2.23-11.92-5.2-11.44,2.29,13.45,2.29,13.45-3.45-4.32-4.57-2.91S95.81,412.69,100.65,415.28Z" style="fill: #8D1D25; transform-origin: 100.444px 397.796px;" id="elizykou1yy8" class="animable"></path><g id="elsi7s61lgby"><path d="M100.65,415.28s8.73-7.73,8.72-9.9-5.17,3.89-5.17,3.89,6.8-15.83,4.56-17.73S102.47,405,102.47,405s3-23.88-1-24.67-2.32,23.92-2.32,23.92-2.23-11.92-5.2-11.44,2.29,13.45,2.29,13.45-3.45-4.32-4.57-2.91S95.81,412.69,100.65,415.28Z" style="fill: rgb(255, 255, 255); opacity: 0.2; isolation: isolate; transform-origin: 100.444px 397.796px;" class="animable" id="el9jjjrt4l46v"></path></g><path d="M105.9,417.73H76.7s5.82-8.89,8.3-7.76c3.22,1.47,5.61-6.59,9.18-4.68,1.26.67.64,2.82,1.43,3.69,1.31,1.44,3,1.16,4.56,1.95C103.27,412.47,104.37,414.51,105.9,417.73Z" style="fill: #8D1D25; transform-origin: 91.3px 411.363px;" id="elxa2mkzp4pf" class="animable"></path></g><g id="freepik--Character--inject-307" class="animable" style="transform-origin: 191.48px 268.078px;"><g id="freepik--group--inject-307" class="animable" style="transform-origin: 191.48px 268.078px;"><path d="M174.87,226s-33.62-5.24-40-2.49-8.53,12.64-8.53,12.64-1.15,2,2.33,2.26c0,0-14.23,35.45-9.73,42.24s49.82,9.51,56,6.18S195.79,228.53,174.87,226Z" style="fill: rgb(38, 50, 56); transform-origin: 151.891px 255.48px;" id="elujxb6w8ekv" class="animable"></path><path d="M194.67,259.82s4.45,10.33,5.45,11.77,23.15,11.62,23.15,11.62a19.55,19.55,0,0,1,5.41,0c2.73.43,6.49,1.58,6.83,2s-4.11,6.89-4.11,6.89-8.85.55-10-2.95c0,0-22.19-8.24-24.77-10.4s-9.76-14.92-9.76-14.92Z" style="fill: rgb(228, 137, 123); transform-origin: 211.199px 275.976px;" id="elp0183wo1hv" class="animable"></path><path d="M188.3,237.2c4.16,2.48,10.67,29.18,12.07,32.35s18.4,10.88,18.4,10.88l-7.54,7.22S194,280,191.86,277.86s-10.74-24.33-10.74-24.33Z" style="fill: #8D1D25; transform-origin: 199.945px 262.425px;" id="el232dt12vy02" class="animable"></path><path d="M186.92,298.22s70.12-10.07,73.82,5.31c3.91,16.27-52.39,27.24-86,28.39s-43.33-6.24-37.93-47.82l45.4-.11Z" style="fill: rgb(38, 50, 56); transform-origin: 198.172px 308.01px;" id="elct365w6pu5" class="animable"></path><g id="elfg22ukks709"><path d="M186.92,298.22s70.12-10.07,73.82,5.31c3.91,16.27-52.39,27.24-86,28.39s-43.33-6.24-37.93-47.82l45.4-.11Z" style="opacity: 0.2; isolation: isolate; transform-origin: 198.172px 308.01px;" class="animable" id="elqyzutfr6ca"></path></g><path d="M250.25,322.06a.21.21,0,0,1-.25,0,.17.17,0,0,1-.06-.21c.11-.37,1.22-3.61,2.35-3.95a.7.7,0,0,1,.67.2,1.15,1.15,0,0,1,.4,1.09,3,3,0,0,1-1.05,1.52A12.24,12.24,0,0,1,250.25,322.06Zm.28-.62a4.82,4.82,0,0,0,2.4-2.31.73.73,0,0,0-.28-.74.25.25,0,0,0-.27-.08,1,1,0,0,0-.26.16A9.46,9.46,0,0,0,250.53,321.44Z" style="fill: #8D1D25; transform-origin: 251.652px 319.991px;" id="elu9igjqkhqf" class="animable"></path><path d="M250.19,322.11a.2.2,0,0,1-.21-.06c-.11-.1-1.66-2.06-1.41-3.38a1.3,1.3,0,0,1,.54-.81.72.72,0,0,1,.9-.09c.81.58.71,3.2.31,4.2l0,.1Zm-.89-3.85a.86.86,0,0,0-.27.47c-.16.84.62,2.1,1,2.7.26-1.12.18-3-.3-3.29-.05,0-.15-.11-.39.06l-.08.06Z" style="fill: #8D1D25; transform-origin: 249.582px 319.886px;" id="elpuyftdgb8c" class="animable"></path><polygon points="225.96 330.3 240.66 330.31 247.71 330.32 248.55 322.89 242.03 322.02 226.09 319.89 225.96 330.3" style="fill: rgb(228, 137, 123); transform-origin: 237.255px 325.105px;" id="elzdys2vhfbn" class="animable"></polygon><path d="M247,322l-1.79,8.47a.85.85,0,0,0,.69,1l4.22.76s5.61,1.43,7.19.42c4.6-2.94,9-21.59,7.16-23-.68-.5-1.87.26-2.46.87-1.89,1.93-5.92,7.31-7.52,8.91-1.86,1.86-5.17,1.91-6.62,1.84A.85.85,0,0,0,247,322Z" style="fill: rgb(38, 50, 56); transform-origin: 255.047px 321.249px;" id="elr94gnvyg3h9" class="animable"></path><g id="elbfitf1vcjo6"><polygon points="225.96 330.3 240.66 330.31 242.03 322.02 226.09 319.89 225.96 330.3" style="opacity: 0.2; isolation: isolate; transform-origin: 233.995px 325.1px;" class="animable" id="elc5u24n4wkm6"></polygon></g><path d="M170.45,297.71v1.86a2.41,2.41,0,0,0,2.3,2.4h68.39a2.56,2.56,0,0,0,2.47-2.4v-1.86Z" style="fill: rgb(38, 50, 56); transform-origin: 207.03px 299.84px;" id="elt81n2uucpog" class="animable"></path><g id="el9wsopjn00i9"><path d="M170.45,297.71v1.86a2.41,2.41,0,0,0,2.3,2.4h68.39a2.56,2.56,0,0,0,2.47-2.4v-1.86Z" style="fill: rgb(255, 255, 255); opacity: 0.2; isolation: isolate; transform-origin: 207.03px 299.84px;" class="animable" id="el6lyi6owrf3"></path></g><g id="elhxmnxdzebz8"><path d="M196,297.71v1.86a2.42,2.42,0,0,0,2.31,2.4h42.86a2.56,2.56,0,0,0,2.47-2.4v-1.86Z" style="fill: rgb(255, 255, 255); opacity: 0.2; isolation: isolate; transform-origin: 219.82px 299.84px;" class="animable" id="ellndw84yj4i"></path></g><path d="M198.28,300.26h45.18a3.7,3.7,0,0,0,3.29-2.42l10.36-32.5a1.8,1.8,0,0,0-1.74-2.51H210.19a3.76,3.76,0,0,0-3.28,2.51L196.55,297.8A1.76,1.76,0,0,0,198.28,300.26Z" style="fill: rgb(38, 50, 56); transform-origin: 226.83px 281.546px;" id="elbmz846yz4mc" class="animable"></path><g id="elhir5ge26q96"><path d="M198.28,300.26h45.18a3.7,3.7,0,0,0,3.29-2.42l10.36-32.5a1.8,1.8,0,0,0-1.74-2.51H210.19a3.76,3.76,0,0,0-3.28,2.51L196.55,297.8A1.76,1.76,0,0,0,198.28,300.26Z" style="fill: rgb(255, 255, 255); opacity: 0.2; isolation: isolate; transform-origin: 226.83px 281.546px;" class="animable" id="elh1iordr21dn"></path></g><g id="eljks5q98yo0m"><path d="M200,300.26h43.48a3.7,3.7,0,0,0,3.29-2.42l10.36-32.5a1.8,1.8,0,0,0-1.74-2.51H211.89a3.76,3.76,0,0,0-3.28,2.51L198.25,297.8A1.76,1.76,0,0,0,200,300.26Z" style="fill: rgb(255, 255, 255); opacity: 0.2; isolation: isolate; transform-origin: 227.69px 281.547px;" class="animable" id="elqzaz23dmaln"></path></g><g id="eln8ozhfj6ca"><path d="M226.42,283c-.56,2.16.52,3.92,2.41,3.92s3.86-1.76,4.42-3.92-.52-3.92-2.4-3.92S227,280.87,226.42,283Z" style="fill: rgb(255, 255, 255); opacity: 0.2; isolation: isolate; transform-origin: 229.835px 283px;" class="animable" id="elhvpyag71upl"></path></g><g id="el4xa3y37yxar"><path d="M247,322l-1.79,8.47a.85.85,0,0,0,.69,1l4.22.76s5.61,1.43,7.19.42c4.6-2.94,9-21.59,7.16-23-.68-.5-1.87.26-2.46.87-1.89,1.93-5.92,7.31-7.52,8.91-1.86,1.86-5.17,1.91-6.62,1.84A.85.85,0,0,0,247,322Z" style="fill: rgb(255, 255, 255); opacity: 0.2; isolation: isolate; transform-origin: 255.047px 321.249px;" class="animable" id="elybno1bueu5"></path></g><polygon points="150.26 289.99 136.08 290.17 136.35 285.56 150.26 285.26 150.26 289.99" id="el24zs1ur53jm" class="animable" style="transform-origin: 143.17px 287.715px;"></polygon><polygon points="178.24 284.65 182.48 284.56 184 289.54 178.24 289.62 178.24 284.65" id="el99dne8s4ce" class="animable" style="transform-origin: 181.12px 287.09px;"></polygon><polygon points="176.43 284.69 176.43 289.64 152.44 289.96 152.44 285.21 176.43 284.69" id="elx6f08pjsuda" class="animable" style="transform-origin: 164.435px 287.325px;"></polygon><path d="M162.61,288.78l-.07-1.93a1.9,1.9,0,0,1,1.75-2l4.34-.18a1.77,1.77,0,0,1,1.31.51,2,2,0,0,1,.59,1.36l.07,1.92a1.91,1.91,0,0,1-1.76,2l-4.33.18h-.08A1.89,1.89,0,0,1,162.61,288.78Zm6.2.87a1.11,1.11,0,0,0,1-1.18l-.07-1.92a1.2,1.2,0,0,0-.35-.79,1,1,0,0,0-.76-.3l-4.34.18a1.1,1.1,0,0,0-1,1.18l.07,1.93a1.09,1.09,0,0,0,1.11,1.09Z" style="fill: rgb(255, 255, 255); transform-origin: 166.57px 287.654px;" id="elnel4ucnli5c" class="animable"></path><path d="M163.35,288.15h2.18a.51.51,0,0,0,.5-.5.5.5,0,0,0-.5-.5h-2.18a.5.5,0,0,0-.5.5A.51.51,0,0,0,163.35,288.15Z" style="fill: rgb(255, 255, 255); transform-origin: 164.44px 287.65px;" id="elmeom47xzr6q" class="animable"></path><path d="M188.3,237.2s-5.47,34.59-3.18,47l-50.59,1.47s6-35.73,13.95-49.21C148.48,236.42,161.69,214.36,188.3,237.2Z" style="fill: #8D1D25; transform-origin: 161.415px 256.257px;" id="el3qjnap5vwd3" class="animable"></path><g id="elqmcvpb1avzs"><path d="M188.3,237.2s-5.47,34.59-3.18,47l-50.59,1.47s6-35.73,13.95-49.21C148.48,236.42,161.69,214.36,188.3,237.2Z" style="fill: rgb(255, 255, 255); opacity: 0.6; transform-origin: 161.415px 256.257px;" class="animable" id="elsctim32tlb"></path></g><path d="M158.62,229.5s8.39,8.2,13.24,6.86,6.67-3.81,6.67-3.81-3.9-1.71-3.47-2.64c.05-.1.17-.29.34-.57,1.45-2.2,6.59-9.22,6.59-9.22l-11-6.19s-.9,2.13-2,4.67c-1.49,3.38-3.35,7.47-4,8.23C163.85,228.17,158.62,229.5,158.62,229.5Z" style="fill: rgb(228, 137, 123); transform-origin: 170.305px 225.219px;" id="elzqdq7khngte" class="animable"></path><g id="eli16cvetfmte"><path d="M168.94,218.6c.69,3.9,2.39,8.49,6.46,10.74,1.45-2.2,6.59-9.22,6.59-9.22l-11-6.19S170.05,216.06,168.94,218.6Z" style="opacity: 0.2; isolation: isolate; transform-origin: 175.465px 221.635px;" class="animable" id="ellgptfjb8z4r"></path></g><path d="M166.73,211a19.13,19.13,0,0,0-.89,6c.21,2.48-2.55,3.31-2.9,1.81,0,0,.05,3.65,2.42,3.1,0,0,0,2.53,2.12,2.57a14,14,0,0,0,2.66-8.57C169.81,211.1,166.73,211,166.73,211Z" style="fill: rgb(38, 50, 56); transform-origin: 166.542px 217.74px;" id="els5l0bqp4c" class="animable"></path><path d="M185.74,198.84c-3.6,1.49-3,9.85,3,17,3.67-3.16,5.34-10.46,4.47-13.34C191.81,197.89,188.87,197.55,185.74,198.84Z" style="fill: rgb(38, 50, 56); transform-origin: 188.474px 207.014px;" id="eljle71pm36hs" class="animable"></path><path d="M191,219.19v0a25.1,25.1,0,0,1-1.14,2.8c-3.55,7.23-13.76,8.64-18.28,1.49l-.05-.07c-3-4.82-1.87-9.31-.62-17.1a10.77,10.77,0,0,1,16.81-7.22C193.61,203.24,193.26,212.54,191,219.19Z" style="fill: rgb(228, 137, 123); transform-origin: 181.07px 212.668px;" id="el3zljz5wdmt9" class="animable"></path><path d="M181.88,211c-.14.63.08,1.21.48,1.3s.85-.34,1-1-.07-1.21-.48-1.3S182.06,210.42,181.88,211Z" style="fill: rgb(38, 50, 56); transform-origin: 182.622px 211.151px;" id="el0boqllr3uug4" class="animable"></path><path d="M189,212.63c-.14.62.08,1.2.49,1.29s.85-.33,1-1-.08-1.21-.49-1.3S189.12,212,189,212.63Z" style="fill: rgb(38, 50, 56); transform-origin: 189.747px 212.771px;" id="el8nhty6dn9uf" class="animable"></path><path d="M186.59,212.4a23.06,23.06,0,0,0,1.79,6,3.67,3.67,0,0,1-3.11-.12Z" style="fill: rgb(222, 87, 83); transform-origin: 186.825px 215.544px;" id="eloxg2xndkckp" class="animable"></path><path d="M180.44,208.35a.41.41,0,0,1-.22-.1.39.39,0,0,1,0-.54,3.71,3.71,0,0,1,3.33-.84.36.36,0,0,1,.26.44v0a.39.39,0,0,1-.47.26h0a2.94,2.94,0,0,0-2.62.69A.38.38,0,0,1,180.44,208.35Z" style="fill: rgb(38, 50, 56); transform-origin: 181.967px 207.56px;" id="elqcomyn8uhln" class="animable"></path><path d="M192.75,211a.42.42,0,0,1-.29-.29,3,3,0,0,0-1.69-2.12.38.38,0,0,1-.23-.48.38.38,0,0,1,.48-.23,3.73,3.73,0,0,1,2.17,2.66.37.37,0,0,1-.27.45h0A.42.42,0,0,1,192.75,211Z" style="fill: rgb(38, 50, 56); transform-origin: 191.86px 209.432px;" id="elh9mj4wsi70u" class="animable"></path><path d="M183.79,222.12h0a5.74,5.74,0,0,1-4.8-3.66.28.28,0,0,1,.19-.34.29.29,0,0,1,.35.19c0,.11.82,2.65,4.35,3.26a.29.29,0,0,1,.23.32A.28.28,0,0,1,183.79,222.12Z" style="fill: rgb(38, 50, 56); transform-origin: 181.546px 220.117px;" id="elxo7jyhrvw3f" class="animable"></path><path d="M192.51,205.07s2.32-1.78,2.23-3.86a7.65,7.65,0,0,0-4.08-6.31,14.87,14.87,0,0,0-7.27-2c-8.86-.52-13.68,2.14-15.2,6.87-.94,1.68-.92,4.8-.08,7.72a.09.09,0,0,1,0,.05h0a12.84,12.84,0,0,0,2.31,4.58c5.4-4.68,7.41-8,6.56-10.2.18-.05,2.86-2.45,4.05-2.51,1.72-.09,4.89,1.54,7.46,3.07,1.41.83,2.86-.5,2.86-.5Z" style="fill: rgb(38, 50, 56); transform-origin: 181.112px 202.478px;" id="el4fgddyu8r7o" class="animable"></path><path d="M165.85,211.67a7.48,7.48,0,0,0,2.49,5.16c2,1.72,4.1.22,4.49-2.23.36-2.21-.24-5.78-2.68-6.56S165.71,209.24,165.85,211.67Z" style="fill: rgb(228, 137, 123); transform-origin: 169.385px 212.719px;" id="elfmq7ohcw1dr" class="animable"></path><path d="M165.84,216.93s3.28-12.75,11.39-17.5S193.75,198,193.75,198a25.52,25.52,0,0,0-.55-3.8c-.24-.4-4.26-1.78-4.26-1.78s-2.29-3.37-5.47-4.45-12.68-1.39-16,1.38-5.51,8.41-4.11,8.51,2.47.1,2.47.1-2.62,9.05-1.5,10.41C164.34,208.36,162.4,214.66,165.84,216.93Z" style="fill: #8D1D25; transform-origin: 178.34px 202.059px;" id="eluwkkt7tn0g8" class="animable"></path><path d="M182.11,333.74a.25.25,0,0,1,.23-.1.16.16,0,0,1,.14.16c.08.38.6,3.76-.24,4.59a.71.71,0,0,1-.68.14,1.14,1.14,0,0,1-.86-.78,3,3,0,0,1,.22-1.83A12.13,12.13,0,0,1,182.11,333.74Zm0,.69a4.8,4.8,0,0,0-1,3.16.72.72,0,0,0,.59.52.24.24,0,0,0,.27-.05.71.71,0,0,0,.16-.26A9.31,9.31,0,0,0,182.14,334.43Z" style="fill: #8D1D25; transform-origin: 181.678px 336.101px;" id="eleknno608u8v" class="animable"></path><polygon points="204.49 317.19 190.55 321.82 183.85 324.05 185.4 331.36 191.87 330.13 207.66 327.11 204.49 317.19" style="fill: rgb(228, 137, 123); transform-origin: 195.755px 324.275px;" id="el6pgfgj1gmow" class="animable"></polygon><path d="M187.21,331.74l-1-8.6a.86.86,0,0,0-1-.76L181,323s-5.77.42-6.95,1.87c-3.44,4.25-1.75,23.34.47,24.06.81.26,1.69-.84,2.06-1.6,1.18-2.43,3.31-8.81,4.31-10.83,1.18-2.35,4.3-3.45,5.7-3.84A.85.85,0,0,0,187.21,331.74Z" style="fill: rgb(38, 50, 56); transform-origin: 179.652px 335.668px;" id="ela67lwgn80i" class="animable"></path><path d="M182.14,333.68a.18.18,0,0,1,.22,0c.13,0,2.42,1,2.81,2.33a1.22,1.22,0,0,1-.1,1,.72.72,0,0,1-.75.49c-1-.13-2.12-2.5-2.23-3.56l0-.11A.18.18,0,0,1,182.14,333.68Zm2.58,3a.83.83,0,0,0,0-.54c-.24-.82-1.52-1.57-2.17-1.9.29,1.11,1.22,2.7,1.8,2.77.06,0,.18,0,.31-.24l.05-.09Z" style="fill: #8D1D25; transform-origin: 183.661px 335.573px;" id="elsckrxxytwu" class="animable"></path><g id="elyji1jvcy3e"><polygon points="204.49 317.19 190.55 321.82 191.87 330.13 207.66 327.11 204.49 317.19" style="opacity: 0.2; isolation: isolate; transform-origin: 199.105px 323.66px;" class="animable" id="elxaaoj65u1f"></polygon></g><polygon points="194.29 331.42 198.27 331.79 195.89 318.04 191.32 320.44 194.29 331.42" style="fill: #8D1D25; transform-origin: 194.795px 324.915px;" id="elul7ygrcqetq" class="animable"></polygon><g id="el01i289u7td2s"><polygon points="194.29 331.42 198.27 331.79 195.89 318.04 191.32 320.44 194.29 331.42" style="fill: rgb(255, 255, 255); opacity: 0.6; isolation: isolate; transform-origin: 194.795px 324.915px;" class="animable" id="el41eef0jz3ld"></polygon></g><g id="elb6firgjnlca"><path d="M187.21,331.74l-1-8.6a.86.86,0,0,0-1-.76L181,323s-5.77.42-6.95,1.87c-3.44,4.25-1.75,23.34.47,24.06.81.26,1.69-.84,2.06-1.6,1.18-2.43,3.31-8.81,4.31-10.83,1.18-2.35,4.3-3.45,5.7-3.84A.85.85,0,0,0,187.21,331.74Z" style="fill: rgb(255, 255, 255); opacity: 0.2; isolation: isolate; transform-origin: 179.652px 335.668px;" class="animable" id="elg01himeqqfh"></path></g><path d="M239.32,320.94s-65.24-25.34-85.21-21.11-20.08,14.69-10,24.44,25.26,6,25.26,6-11.89-7.12-11.06-11.52,8.39,5.66,8.39,5.66,39.42,9.64,72,7.1Z" style="fill: rgb(38, 50, 56); transform-origin: 188.418px 315.645px;" id="elormwxgwas1j" class="animable"></path><polygon points="240.11 319.88 236.45 318.2 234.34 331.93 239.44 331.1 240.11 319.88" style="fill: #8D1D25; transform-origin: 237.225px 325.065px;" id="el1dusgtvzuav" class="animable"></polygon><g id="elkkqckzkmval"><polygon points="240.11 319.88 236.45 318.2 234.34 331.93 239.44 331.1 240.11 319.88" style="fill: rgb(255, 255, 255); opacity: 0.6; isolation: isolate; transform-origin: 237.225px 325.065px;" class="animable" id="el3dd5p6322it"></polygon></g><path d="M154.48,226.84s8.83,24,8.37,29.39S144.2,302,144.2,302l-15,6S132.29,248.69,154.48,226.84Z" style="fill: #8D1D25; transform-origin: 146.034px 267.42px;" id="els8xpy7prjas" class="animable"></path><g id="elh7gp437e0xf"><path d="M154.48,226.84s8.83,24,8.37,29.39S144.2,302,144.2,302l-15,6S132.29,248.69,154.48,226.84Z" style="opacity: 0.2; isolation: isolate; transform-origin: 146.034px 267.42px;" class="animable" id="elrxrzar0jabs"></path></g><path d="M186.35,296.51s-4.72-11.19-6.23-17.39,3.77-38.05.93-48.74l7.25,6.82L185.23,277Z" style="fill: #8D1D25; transform-origin: 184.071px 263.445px;" id="elsgd61eisbhj" class="animable"></path><g id="elriz1mhbz48p"><path d="M186.35,296.51s-4.72-11.19-6.23-17.39,3.77-38.05.93-48.74l7.25,6.82L185.23,277Z" style="opacity: 0.2; isolation: isolate; transform-origin: 184.071px 263.445px;" class="animable" id="el0fqpdhdt0hfm"></path></g><path d="M132.82,279.12s31.29,6,26.34-51.16l-5.09-.44s3.1,21.72-2.61,35.93S132.29,277,132.29,277Z" style="fill: rgb(38, 50, 56); transform-origin: 145.99px 253.41px;" id="elepl2dw1z3kp" class="animable"></path><path d="M162.67,253.72l-10.5-24.38L149,233.53s-.56-5.91,1.28-7.63,7,.43,9,.94S162.67,253.72,162.67,253.72Z" style="fill: #8D1D25; transform-origin: 155.795px 239.482px;" id="elol76bq1ull" class="animable"></path><path d="M179.22,230.76s4.05,12,3.39,30.78,2.72,17.22,2.72,17.22l.48-1.77s-1.89-.22-1.74-6.55,1-31.88-1.46-38.59Z" style="fill: rgb(38, 50, 56); transform-origin: 182.515px 254.776px;" id="el0ta7yhgcj9ti" class="animable"></path><path d="M181.34,253s1-18-4.06-23.27c0,0,3.79-1.42,5.33,0s1.92,15.13-1.1,24" style="fill: #8D1D25; transform-origin: 180.53px 241.414px;" id="elxzaxlwrz51" class="animable"></path><path d="M155.93,260.36s4.58,10.63,5.61,12.11,23.82,12,23.82,12a20.25,20.25,0,0,1,5.57,0c2.81.44,6.68,1.62,7,2.07s-4.23,7.09-4.23,7.09-9.11.56-10.24-3c0,0-22.84-8.48-25.49-10.7S148,264.49,148,264.49Z" style="fill: rgb(228, 137, 123); transform-origin: 172.973px 277.011px;" id="el262rq1j9n1m" class="animable"></path><path d="M150.26,236.51c4.88,0,11.73,29.79,13,33.83S184.77,283,184.77,283l-6.43,7.61s-21.88-7.9-24.45-11.53S143.53,254.78,143.17,250,147,236.5,150.26,236.51Z" style="fill: #8D1D25; transform-origin: 163.959px 263.56px;" id="elr84nqdausp" class="animable"></path></g></g><defs>     <filter id="active" height="200%">         <feMorphology in="SourceAlpha" result="DILATED" operator="dilate" radius="2"></feMorphology>                <feFlood flood-color="#32DFEC" flood-opacity="1" result="PINK"></feFlood>        <feComposite in="PINK" in2="DILATED" operator="in" result="OUTLINE"></feComposite>        <feMerge>            <feMergeNode in="OUTLINE"></feMergeNode>            <feMergeNode in="SourceGraphic"></feMergeNode>        </feMerge>    </filter>    <filter id="hover" height="200%">        <feMorphology in="SourceAlpha" result="DILATED" operator="dilate" radius="2"></feMorphology>                <feFlood flood-color="#ff0000" flood-opacity="0.5" result="PINK"></feFlood>        <feComposite in="PINK" in2="DILATED" operator="in" result="OUTLINE"></feComposite>        <feMerge>            <feMergeNode in="OUTLINE"></feMergeNode>            <feMergeNode in="SourceGraphic"></feMergeNode>        </feMerge>            <feColorMatrix type="matrix" values="0   0   0   0   0                0   1   0   0   0                0   0   0   0   0                0   0   0   1   0 "></feColorMatrix>    </filter></defs></svg>
                <svg class="animated" id="freepik_stories-sprout" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 500 500" version="1.1" xmlns:xlink="http://www.w3.org/1999/xlink" xmlns:svgjs="http://svgjs.com/svgjs"><style>svg#freepik_stories-sprout:not(.animated) .animable {opacity: 0;}svg#freepik_stories-sprout.animated #freepik--Character--inject-140 {animation: 1.5s Infinite  linear floating;animation-delay: 0s;}            @keyframes floating {                0% {                    opacity: 1;                    transform: translateY(0px);                }                50% {                    transform: translateY(-10px);                }                100% {                    opacity: 1;                    transform: translateY(0px);                }            }        </style><g id="freepik--background-complete--inject-140" class="animable" style="transform-origin: 250px 228.23px;"><rect y="382.4" width="500" height="0.25" style="fill: rgb(235, 235, 235); transform-origin: 250px 382.525px;" id="elsud0f1xfmsk" class="animable"></rect><rect x="416.78" y="398.49" width="33.12" height="0.25" style="fill: rgb(235, 235, 235); transform-origin: 433.34px 398.615px;" id="el4vi9n9wo3nl" class="animable"></rect><rect x="322.53" y="401.21" width="8.69" height="0.25" style="fill: rgb(235, 235, 235); transform-origin: 326.875px 401.335px;" id="el4y7319go04j" class="animable"></rect><rect x="396.59" y="389.21" width="19.19" height="0.25" style="fill: rgb(235, 235, 235); transform-origin: 406.185px 389.335px;" id="eltwjjkvjvyrp" class="animable"></rect><rect x="52.46" y="390.89" width="43.19" height="0.25" style="fill: rgb(235, 235, 235); transform-origin: 74.055px 391.015px;" id="elygks6t2sr6" class="animable"></rect><rect x="104.56" y="390.89" width="6.33" height="0.25" style="fill: rgb(235, 235, 235); transform-origin: 107.725px 391.015px;" id="el4peimeepc48" class="animable"></rect><rect x="131.47" y="395.11" width="93.68" height="0.25" style="fill: rgb(235, 235, 235); transform-origin: 178.31px 395.235px;" id="el9o9mzhp3g46" class="animable"></rect><path d="M237,337.8H43.91a5.71,5.71,0,0,1-5.7-5.71V60.66A5.71,5.71,0,0,1,43.91,55H237a5.71,5.71,0,0,1,5.71,5.71V332.09A5.71,5.71,0,0,1,237,337.8ZM43.91,55.2a5.46,5.46,0,0,0-5.45,5.46V332.09a5.46,5.46,0,0,0,5.45,5.46H237a5.47,5.47,0,0,0,5.46-5.46V60.66A5.47,5.47,0,0,0,237,55.2Z" style="fill: rgb(235, 235, 235); transform-origin: 140.46px 196.4px;" id="elvug03h6bdx" class="animable"></path><path d="M453.31,337.8H260.21a5.72,5.72,0,0,1-5.71-5.71V60.66A5.72,5.72,0,0,1,260.21,55h193.1A5.71,5.71,0,0,1,459,60.66V332.09A5.71,5.71,0,0,1,453.31,337.8ZM260.21,55.2a5.47,5.47,0,0,0-5.46,5.46V332.09a5.47,5.47,0,0,0,5.46,5.46h193.1a5.47,5.47,0,0,0,5.46-5.46V60.66a5.47,5.47,0,0,0-5.46-5.46Z" style="fill: rgb(235, 235, 235); transform-origin: 356.75px 196.4px;" id="ele2tn6um05ld" class="animable"></path><path d="M212.91,263.26c-.08-.56-2-13.73,1.84-18.28a4.14,4.14,0,0,1,3.17-1.56c7.72-.18,8.78,6,8.79,6.08l-.91.14c0-.22-1-5.47-7.86-5.3a3.23,3.23,0,0,0-2.49,1.23c-3.56,4.24-1.64,17.42-1.62,17.55Z" style="fill: rgb(230, 230, 230); transform-origin: 219.535px 253.338px;" id="eldcn2qhm566p" class="animable"></path><path d="M212.45,262.66l-.92,0c0-.12.3-12.14-5.62-14.62a6.38,6.38,0,0,0-8.52,2.78l-.82-.41a7.36,7.36,0,0,1,9.7-3.22C212.77,249.89,212.46,262.14,212.45,262.66Z" style="fill: rgb(230, 230, 230); transform-origin: 204.512px 254.563px;" id="el96foax9g9" class="animable"></path><path d="M212.47,263.6c0-.19-.05-19.19-3.76-24.75-3.55-5.33-9.29-2.82-9.53-2.71l-.38-.84c.06,0,6.68-3,10.68,3,3.86,5.79,3.92,24.47,3.92,25.26Z" style="fill: rgb(230, 230, 230); transform-origin: 206.1px 249.075px;" id="elst9ws2o6uvg" class="animable"></path><path d="M219,243.87s-3.37,1.25-2.37,4.18,11.66,7.76,11.66,7.76,4.46-4.09.36-10.74S219.12,241.78,219,243.87Z" style="fill: rgb(230, 230, 230); transform-origin: 223.414px 248.477px;" id="el1qsthyc691d" class="animable"></path><path d="M208.55,237.85s2.39-.26,2.2-1.71-9.3-5.21-14.68.85c0,0,3.44,5.91,8.42,6S208.55,237.85,208.55,237.85Z" style="fill: rgb(230, 230, 230); transform-origin: 203.415px 238.322px;" id="elle5a0ip3a6" class="animable"></path><path d="M206.09,247.59s1.65-1.34-.13-2-10.53-.46-10.62,8.2c0,0,10.19,1.69,11.45-1.61S206.09,247.59,206.09,247.59Z" style="fill: rgb(230, 230, 230); transform-origin: 201.276px 249.79px;" id="elcexv205lode" class="animable"></path><polygon points="220.84 280.9 205.03 280.9 203.33 263.6 222.54 263.6 220.84 280.9" style="fill: rgb(230, 230, 230); transform-origin: 212.935px 272.25px;" id="el2lp1u3owy9v" class="animable"></polygon><rect x="202.48" y="261.69" width="20.9" height="3.82" style="fill: rgb(230, 230, 230); transform-origin: 212.93px 263.6px;" id="elb713q49tnst" class="animable"></rect><path d="M165.36,263.26c.08-.56,2-13.73-1.83-18.28a4.17,4.17,0,0,0-3.18-1.56c-7.72-.18-8.77,6-8.78,6.08l.91.14c0-.22,1-5.47,7.85-5.3a3.21,3.21,0,0,1,2.49,1.23c3.56,4.24,1.65,17.42,1.63,17.55Z" style="fill: rgb(230, 230, 230); transform-origin: 158.741px 253.338px;" id="eloqpbctbnzgn" class="animable"></path><path d="M165.83,262.66l.92,0c0-.12-.31-12.14,5.61-14.62a6.38,6.38,0,0,1,8.52,2.78l.82-.41a7.36,7.36,0,0,0-9.7-3.22C165.5,249.89,165.81,262.14,165.83,262.66Z" style="fill: rgb(230, 230, 230); transform-origin: 173.761px 254.563px;" id="el61wivhfwgm" class="animable"></path><path d="M165.8,263.6c0-.19,0-19.19,3.76-24.75,3.56-5.33,9.29-2.82,9.54-2.71l.38-.84c-.07,0-6.69-3-10.69,3-3.86,5.79-3.91,24.47-3.91,25.26Z" style="fill: rgb(230, 230, 230); transform-origin: 172.18px 249.075px;" id="elb4kvp56gdn" class="animable"></path><path d="M159.25,243.87s3.37,1.25,2.37,4.18S150,255.81,150,255.81s-4.47-4.09-.37-10.74S159.16,241.78,159.25,243.87Z" style="fill: rgb(230, 230, 230); transform-origin: 154.852px 248.477px;" id="elq28t15a5csp" class="animable"></path><path d="M169.73,237.85s-2.4-.26-2.2-1.71,9.3-5.21,14.67.85c0,0-3.44,5.91-8.41,6S169.73,237.85,169.73,237.85Z" style="fill: rgb(230, 230, 230); transform-origin: 174.859px 238.322px;" id="elpiawd0mt15" class="animable"></path><path d="M172.18,247.59s-1.65-1.34.13-2,10.53-.46,10.62,8.2c0,0-10.18,1.69-11.44-1.61S172.18,247.59,172.18,247.59Z" style="fill: rgb(230, 230, 230); transform-origin: 176.998px 249.79px;" id="elx61jjpmes8" class="animable"></path><polygon points="157.44 280.9 173.24 280.9 174.95 263.6 155.73 263.6 157.44 280.9" style="fill: rgb(230, 230, 230); transform-origin: 165.34px 272.25px;" id="elrk5zstvddks" class="animable"></polygon><g id="el2qsdg4o0zbk"><rect x="154.89" y="261.69" width="20.9" height="3.82" style="fill: rgb(230, 230, 230); transform-origin: 165.34px 263.6px; transform: rotate(180deg);" class="animable"></rect></g><path d="M118,263.26c-.08-.56-2-13.73,1.83-18.28a4.17,4.17,0,0,1,3.18-1.56c7.72-.18,8.77,6,8.78,6.08l-.91.14c0-.22-1-5.47-7.85-5.3a3.21,3.21,0,0,0-2.49,1.23c-3.56,4.24-1.65,17.42-1.63,17.55Z" style="fill: rgb(230, 230, 230); transform-origin: 124.619px 253.338px;" id="el6vz4ncoz2x" class="animable"></path><path d="M117.48,262.66l-.92,0c0-.12.31-12.14-5.61-14.62a6.38,6.38,0,0,0-8.52,2.78l-.82-.41a7.35,7.35,0,0,1,9.69-3.22C117.81,249.89,117.5,262.14,117.48,262.66Z" style="fill: rgb(230, 230, 230); transform-origin: 109.549px 254.564px;" id="el7vohvv9fbmy" class="animable"></path><path d="M117.51,263.6c0-.19-.06-19.19-3.76-24.75-3.56-5.33-9.3-2.82-9.54-2.71l-.38-.84c.07,0,6.69-3,10.69,3,3.85,5.79,3.91,24.47,3.91,25.26Z" style="fill: rgb(230, 230, 230); transform-origin: 111.13px 249.075px;" id="elmcco27dnmdi" class="animable"></path><path d="M124.06,243.87s-3.37,1.25-2.37,4.18,11.66,7.76,11.66,7.76,4.47-4.09.37-10.74S124.15,241.78,124.06,243.87Z" style="fill: rgb(230, 230, 230); transform-origin: 128.478px 248.477px;" id="elvj7l83wigfb" class="animable"></path><path d="M113.58,237.85s2.4-.26,2.2-1.71-9.3-5.21-14.67.85c0,0,3.44,5.91,8.41,6S113.58,237.85,113.58,237.85Z" style="fill: rgb(230, 230, 230); transform-origin: 108.451px 238.322px;" id="eldgu7j1l62gs" class="animable"></path><path d="M111.13,247.59s1.65-1.34-.13-2-10.53-.46-10.62,8.2c0,0,10.18,1.69,11.44-1.61S111.13,247.59,111.13,247.59Z" style="fill: rgb(230, 230, 230); transform-origin: 106.312px 249.79px;" id="eldcmx4wdeptu" class="animable"></path><polygon points="125.87 280.9 110.07 280.9 108.36 263.6 127.58 263.6 125.87 280.9" style="fill: rgb(230, 230, 230); transform-origin: 117.97px 272.25px;" id="elln6pvmqczu" class="animable"></polygon><rect x="107.52" y="261.69" width="20.9" height="3.82" style="fill: rgb(230, 230, 230); transform-origin: 117.97px 263.6px;" id="elgxhgunhq3b4" class="animable"></rect><polygon points="98.09 382.03 98.09 286.5 228.72 286.5 228.72 382.03 233.72 382.03 233.72 280.35 93.09 280.35 93.09 382.03 98.09 382.03" style="fill: rgb(230, 230, 230); transform-origin: 163.405px 331.19px;" id="elei10yvvtfcj" class="animable"></polygon><polygon points="119.94 382.03 119.94 320.37 250.56 320.37 250.56 382.03 255.56 382.03 255.56 314.21 114.94 314.21 114.94 382.03 119.94 382.03" style="fill: rgb(240, 240, 240); transform-origin: 185.25px 348.12px;" id="elr5nlu9t48e9" class="animable"></polygon><path d="M233.5,300s-3-6.57.43-13.05,4.44-8,2.25-9.32-3.2,5.18-3.2,5.18a14.6,14.6,0,0,1-.32-9.16c1.52-4.69,2.48-12.32.4-13.14s-.4,9.52-2.21,13a30.29,30.29,0,0,1-1.77-7.68c-.25-3.76.14-9.77-1.5-11.31s-2.7-.48-1.09,7.83a86.82,86.82,0,0,1,1.61,15.05s-3.57-10.89-6-11.21-2.4,3.21-.34,6.27,6,8.54,6.66,11.36c0,0-3.93-8.2-7.45-5.69s3.07,7.47,6,9.26,5,13,5,13Z" style="fill: rgb(240, 240, 240); transform-origin: 228.649px 277.157px;" id="elbut99ujdv4v" class="animable"></path><path d="M231.13,302.7s2.93-6.61-.59-13-4.53-7.93-2.35-9.29,3.26,5.13,3.26,5.13a14.64,14.64,0,0,0,.21-9.16c-1.58-4.66-2.63-12.28-.56-13.13s.52,9.51,2.37,13a30.25,30.25,0,0,0,1.67-7.71c.21-3.77-.26-9.77,1.37-11.33s2.7-.52,1.18,7.81a86.92,86.92,0,0,0-1.43,15.07s3.45-10.94,5.84-11.29,2.43,3.17.42,6.26-5.91,8.63-6.53,11.46c0,0,3.83-8.26,7.38-5.8s-3,7.51-5.9,9.34-4.82,13.08-4.82,13.08Z" style="fill: rgb(240, 240, 240); transform-origin: 235.721px 279.87px;" id="el8lqrhq5stgk" class="animable"></path><polygon points="244.65 297.99 220.43 297.99 222.39 315.31 242.69 315.31 244.65 297.99" style="fill: rgb(240, 240, 240); transform-origin: 232.54px 306.65px;" id="elu80dxbw1qpm" class="animable"></polygon><path d="M187.52,300s3-6.57-.42-13.05-4.44-8-2.25-9.32,3.2,5.18,3.2,5.18a14.6,14.6,0,0,0,.32-9.16c-1.52-4.69-2.48-12.32-.4-13.14s.4,9.52,2.21,13a30.29,30.29,0,0,0,1.77-7.68c.25-3.76-.14-9.77,1.5-11.31s2.7-.48,1.09,7.83a86.82,86.82,0,0,0-1.61,15.05s3.57-10.89,6-11.21,2.4,3.21.34,6.27-6,8.54-6.66,11.36c0,0,3.93-8.2,7.45-5.69s-3.07,7.47-6,9.26-5,13-5,13Z" style="fill: rgb(240, 240, 240); transform-origin: 192.382px 277.157px;" id="elup5jvgpof3j" class="animable"></path><path d="M189.9,302.7s-2.93-6.61.59-13,4.53-7.93,2.35-9.29-3.26,5.13-3.26,5.13a14.64,14.64,0,0,1-.21-9.16c1.58-4.66,2.63-12.28.56-13.13s-.52,9.51-2.37,13a30.25,30.25,0,0,1-1.67-7.71c-.21-3.77.25-9.77-1.37-11.33s-2.7-.52-1.18,7.81a86.92,86.92,0,0,1,1.43,15.07s-3.45-10.94-5.84-11.29-2.43,3.17-.42,6.26,5.91,8.63,6.53,11.46c0,0-3.83-8.26-7.38-5.8s3,7.51,5.9,9.34,4.82,13.08,4.82,13.08Z" style="fill: rgb(240, 240, 240); transform-origin: 185.309px 279.87px;" id="elml4x4avmn9f" class="animable"></path><polygon points="176.38 297.99 200.6 297.99 198.64 315.31 178.34 315.31 176.38 297.99" style="fill: rgb(240, 240, 240); transform-origin: 188.49px 306.65px;" id="el3gjnbu8n8yy" class="animable"></polygon><path d="M145.2,300s-3-6.57.43-13.05,4.44-8,2.25-9.32-3.2,5.18-3.2,5.18a14.64,14.64,0,0,1-.33-9.16c1.53-4.69,2.49-12.32.4-13.14s-.39,9.52-2.2,13a30.29,30.29,0,0,1-1.77-7.68c-.25-3.76.14-9.77-1.51-11.31s-2.7-.48-1.08,7.83a86.82,86.82,0,0,1,1.61,15.05s-3.58-10.89-6-11.21-2.4,3.21-.35,6.27,6,8.54,6.66,11.36c0,0-3.92-8.2-7.45-5.69s3.07,7.47,6,9.26,5,13,5,13Z" style="fill: rgb(240, 240, 240); transform-origin: 140.342px 277.157px;" id="eldy0g6dkapen" class="animable"></path><path d="M142.83,302.7s2.93-6.61-.59-13-4.53-7.93-2.36-9.29,3.26,5.13,3.26,5.13a14.6,14.6,0,0,0,.22-9.16c-1.59-4.66-2.63-12.28-.56-13.13s.51,9.51,2.36,13a30.52,30.52,0,0,0,1.68-7.71c.2-3.77-.26-9.77,1.37-11.33s2.69-.52,1.18,7.81A86.92,86.92,0,0,0,148,280.06s3.44-10.94,5.84-11.29,2.43,3.17.41,6.26-5.9,8.63-6.52,11.46c0,0,3.82-8.26,7.38-5.8s-3,7.51-5.9,9.34-4.82,13.08-4.82,13.08Z" style="fill: rgb(240, 240, 240); transform-origin: 147.442px 279.855px;" id="elevwr63292bj" class="animable"></path><polygon points="156.35 297.99 132.13 297.99 134.09 315.31 154.39 315.31 156.35 297.99" style="fill: rgb(240, 240, 240); transform-origin: 144.24px 306.65px;" id="elgingiod83po" class="animable"></polygon><polygon points="238.55 182.05 238.17 185.13 238.1 185.78 236.15 201.84 218.04 201.84 216.07 185.57 215.99 184.88 215.64 182.05 238.55 182.05" style="fill: rgb(235, 235, 235); transform-origin: 227.095px 191.945px;" id="elm8x2tswcbnj" class="animable"></polygon><path d="M214.94,170a5,5,0,0,1,3.21,3.23,7,7,0,0,0,6.12,4.32,4.61,4.61,0,0,1,2.44.85l.77.45c0-.27-.06-.55-.07-.84a7.81,7.81,0,0,1-.64-.53l-.14-.14c-2.41-2.31-2.48-4.75-5.29-6.94S214.94,170,214.94,170Z" style="fill: rgb(235, 235, 235); transform-origin: 221.21px 174.08px;" id="el2eito2fiz1g" class="animable"></path><path d="M238.31,167.6a5,5,0,0,0-2.72,3.65,7,7,0,0,1-5.45,5.14,4.68,4.68,0,0,0-2.3,1.19l-.7.55c0-.27,0-.55,0-.84.19-.19.37-.4.55-.62l.12-.15c2.06-2.63,1.78-5.05,4.26-7.62S238.31,167.6,238.31,167.6Z" style="fill: rgb(235, 235, 235); transform-origin: 232.725px 172.708px;" id="elsof4kkvi50b" class="animable"></path><path d="M227.84,177.58a15.47,15.47,0,0,1-.47,4.53c-1.36,5.26-.75.08-.75.08a13.53,13.53,0,0,0,.52-4.06c0-.27,0-.55,0-.84a12.47,12.47,0,0,0-.64-3.07c-1.42-4.13-4.28-5.41-5.41-9.84s2.78-7.59,2.78-7.59a6.31,6.31,0,0,0,2.11,5.34,8.83,8.83,0,0,1,1.88,9.24c-.66,1.31-.24,3,0,5.15C227.8,176.86,227.82,177.21,227.84,177.58Z" style="fill: rgb(235, 235, 235); transform-origin: 224.659px 170.629px;" id="elnlgf66wc7j" class="animable"></path><path d="M237.27,183.66a.41.41,0,0,1-.4-.32l-9.44-39.41L218,183.34a.42.42,0,0,1-.49.31.43.43,0,0,1-.31-.5L227,142.08a.43.43,0,0,1,.8,0l9.83,41.07a.41.41,0,0,1-.3.5Z" style="fill: rgb(235, 235, 235); transform-origin: 227.417px 162.734px;" id="elow33t2jj6c" class="animable"></path><path d="M227.43,186.34a.41.41,0,0,1-.41-.41V116.72a.41.41,0,1,1,.82,0v69.21A.41.41,0,0,1,227.43,186.34Z" style="fill: rgb(235, 235, 235); transform-origin: 227.43px 151.325px;" id="elljyt5xxk9mm" class="animable"></path><polygon points="111.09 182.05 110.72 185.13 110.64 185.78 108.7 201.84 90.58 201.84 88.61 185.57 88.53 184.88 88.19 182.05 111.09 182.05" style="fill: rgb(235, 235, 235); transform-origin: 99.64px 191.945px;" id="elcm7s12ciqdg" class="animable"></polygon><path d="M110.72,169.39a5,5,0,0,1-4,2.22,7,7,0,0,0-5.81,4.72,4.58,4.58,0,0,1-1.49,2.13c-.2.2,0,.34-.18.56.27,0,.09.15.38.21a6.74,6.74,0,0,1,.68-.46l.17-.11c2.88-1.69,5.24-1.09,8.12-3.21S110.72,169.39,110.72,169.39Z" style="fill: rgb(235, 235, 235); transform-origin: 105.024px 174.31px;" id="el0t8papn6vn3i" class="animable"></path><path d="M88.46,171.51a5,5,0,0,1,2.73,3.66,7,7,0,0,0,5.45,5.14,4.52,4.52,0,0,1,2.3,1.19l.7.55c0-.27,0-.56,0-.84-.19-.2-.37-.4-.55-.62l-.12-.16c-2.06-2.63-1.79-5.05-4.26-7.62S88.46,171.51,88.46,171.51Z" style="fill: rgb(235, 235, 235); transform-origin: 94.05px 176.623px;" id="el8cvja283ek" class="animable"></path><path d="M98.94,179.05a15.47,15.47,0,0,0,.47,4.53c1.35,5.26.75.07.75.07a13.5,13.5,0,0,1-.52-4.05c0-.27,0-.56,0-.84a12.81,12.81,0,0,1,.63-3.07c1.43-4.14,4.29-5.41,5.41-9.85s-2.78-7.58-2.78-7.58a6.26,6.26,0,0,1-2.1,5.33c-2.63,2.55-3,7-1.88,9.24.66,1.32.24,3,.05,5.16C99,178.33,99,178.68,98.94,179.05Z" style="fill: rgb(235, 235, 235); transform-origin: 102.103px 172.098px;" id="elk4vjidyfoye" class="animable"></path><path d="M109.33,183.66a.41.41,0,0,1-.4-.32l-9.44-39.41-9.44,39.41a.41.41,0,1,1-.79-.19l9.83-41.07a.43.43,0,0,1,.8,0l9.84,41.07a.43.43,0,0,1-.31.5Z" style="fill: rgb(235, 235, 235); transform-origin: 99.4853px 162.758px;" id="eln0txjmjxmg" class="animable"></path><path d="M99.49,186.34a.41.41,0,0,1-.41-.41V116.72a.42.42,0,0,1,.41-.41.41.41,0,0,1,.41.41v69.21A.41.41,0,0,1,99.49,186.34Z" style="fill: rgb(235, 235, 235); transform-origin: 99.49px 151.325px;" id="elgu5niakyb5g" class="animable"></path><polygon points="174.64 182.05 174.27 185.13 174.19 185.78 172.25 201.84 154.13 201.84 152.16 185.57 152.08 184.88 151.74 182.05 174.64 182.05" style="fill: rgb(235, 235, 235); transform-origin: 163.19px 191.945px;" id="el88rzslwt7rk" class="animable"></polygon><path d="M175,172.54a5,5,0,0,0-3.21,3.24,7,7,0,0,1-6.12,4.32,4.61,4.61,0,0,0-2.45.85l-.77.45c0-.27.06-.55.07-.84.22-.17.43-.35.64-.54l.14-.13c2.41-2.32,2.48-4.75,5.29-6.95S175,172.54,175,172.54Z" style="fill: rgb(235, 235, 235); transform-origin: 168.725px 176.623px;" id="elwg835t8a5m" class="animable"></path><path d="M151.8,167a5,5,0,0,0,3.61,2.78,7,7,0,0,1,5.06,5.53,4.6,4.6,0,0,0,1.15,2.32l.54.71c-.27,0,0,1-.26,1.05a8.15,8.15,0,0,0-1.19-1.58l-.15-.13c-2.6-2.09-5-1.86-7.55-4.37S151.8,167,151.8,167Z" style="fill: rgb(235, 235, 235); transform-origin: 156.804px 173.195px;" id="elevu76xrrjr4" class="animable"></path><path d="M161.68,177.58a15.51,15.51,0,0,0,.48,4.53c1.35,5.26.75.08.75.08a13.32,13.32,0,0,1-.53-4.06c0-.27,0-.55.05-.84a12,12,0,0,1,.63-3.07c1.42-4.13,4.28-5.41,5.41-9.84s-2.78-7.59-2.78-7.59a6.31,6.31,0,0,1-2.11,5.34,8.8,8.8,0,0,0-1.87,9.24c.65,1.31.24,3,0,5.15C161.72,176.86,161.7,177.21,161.68,177.58Z" style="fill: rgb(235, 235, 235); transform-origin: 164.902px 170.629px;" id="elhgwqhfzmi38" class="animable"></path><path d="M172.87,183.66a.4.4,0,0,1-.39-.32L163,143.93l-9.44,39.41a.42.42,0,0,1-.49.31.43.43,0,0,1-.31-.5l9.84-41.07a.43.43,0,0,1,.8,0l9.83,41.07a.41.41,0,0,1-.3.5Z" style="fill: rgb(235, 235, 235); transform-origin: 162.997px 162.734px;" id="elea3353hv2k" class="animable"></path><path d="M163,186.34a.41.41,0,0,1-.41-.41V116.72a.41.41,0,0,1,.41-.41.42.42,0,0,1,.41.41v69.21A.41.41,0,0,1,163,186.34Z" style="fill: rgb(235, 235, 235); transform-origin: 163px 151.325px;" id="els41zq1zpq9" class="animable"></path><rect x="92.24" y="112.7" width="142.37" height="3.57" style="fill: rgb(235, 235, 235); transform-origin: 163.425px 114.485px;" id="el5de4l9ewe6w" class="animable"></rect><polygon points="308.07 133.9 341.26 114.59 366.83 114.59 400.56 132.98 400.56 258.1 308.07 258.1 308.07 133.9" style="fill: rgb(224, 224, 224); transform-origin: 354.315px 186.345px;" id="elgh381vov1if" class="animable"></polygon><path d="M401.52,258.1H308.07V133.9l1-.92a65.72,65.72,0,0,1,45.77-18.39h0A65.71,65.71,0,0,1,400.56,133l1,.92Zm-87.25-6.2h81.05V136.56a60,60,0,0,0-81.05,0Z" style="fill: rgb(250, 250, 250); transform-origin: 354.815px 186.345px;" id="elxm2x5nc52k" class="animable"></path><polygon points="352.47 252.65 357.12 252.65 357.12 211.13 396.49 211.13 396.49 206.48 357.12 206.48 357.12 164.01 396.49 164.01 396.49 159.36 357.12 159.36 357.12 119.99 352.47 119.99 352.47 159.36 313.1 159.36 313.1 164.01 352.47 164.01 352.47 206.48 313.1 206.48 313.1 211.13 352.47 211.13 352.47 252.65" style="fill: rgb(240, 240, 240); transform-origin: 354.795px 186.32px;" id="eljtqp4417syc" class="animable"></polygon><path d="M404.61,261.2H305V132.63l.9-.91a69.26,69.26,0,0,1,97.83,0l.9.91ZM311.17,255h87.25V135.22a63.05,63.05,0,0,0-87.25,0Z" style="fill: rgb(240, 240, 240); transform-origin: 354.815px 186.347px;" id="el6g3xxwzp2sq" class="animable"></path></g><g id="freepik--Shadow--inject-140" class="animable" style="transform-origin: 250px 416.24px;"><ellipse id="freepik--path--inject-140" cx="250" cy="416.24" rx="193.89" ry="11.32" style="fill: rgb(245, 245, 245); transform-origin: 250px 416.24px;" class="animable"></ellipse></g><g id="freepik--Plant--inject-140" class="animable" style="transform-origin: 109.659px 355.215px;"><path d="M107.53,375.06c0-.39-1.3-38.6-7.52-44.64-6-5.86-13-.22-13.26,0l-.64-.77c.08-.07,7.93-6.47,14.6,0,6.5,6.31,7.77,43.73,7.82,45.32Z" style="fill: rgb(38, 50, 56); transform-origin: 97.32px 350.909px;" id="elq9wkvlyu83p" class="animable"></path><path d="M108.07,382.57c0-.46-4.25-45.89,12.34-64.93l.76.66C104.85,337,109,382,109.06,382.47Z" style="fill: rgb(38, 50, 56); transform-origin: 114.376px 350.105px;" id="el9pnu9wuuaou" class="animable"></path><path d="M107.48,377.77l-1-.07c0-.52,3.25-51.63-8.91-62.82l.67-.74C110.76,325.65,107.62,375.64,107.48,377.77Z" style="fill: rgb(38, 50, 56); transform-origin: 102.75px 345.955px;" id="elmq5isi3efb" class="animable"></path><path d="M109.07,377.74h-1c0-1.41.4-34.54,9.81-39.94a6.67,6.67,0,0,1,6.1-.59c5.7,2.35,8.52,12.49,8.64,12.92l-1,.26c0-.1-2.81-10.09-8.05-12.26a5.72,5.72,0,0,0-5.22.54C109.46,343.77,109.07,377.4,109.07,377.74Z" style="fill: rgb(38, 50, 56); transform-origin: 120.345px 357.236px;" id="elfdizewy16ku" class="animable"></path><path d="M105.4,377.76l-1-.06c0-.26,1.42-26.17-5.57-35.29-1.69-2.21-3.53-3.26-5.47-3.13-4.58.32-8.41,7-8.45,7.09l-.87-.49c.17-.3,4.14-7.24,9.25-7.6,2.29-.16,4.43,1,6.34,3.52C106.84,351.22,105.46,376.68,105.4,377.76Z" style="fill: rgb(38, 50, 56); transform-origin: 94.7918px 358.013px;" id="el5x0bqpat6jr" class="animable"></path><path d="M106.91,381.29c-.19-2.52-4.57-61.7,3.14-72.13l.8.6c-7.49,10.13-3,70.84-2.94,71.45Z" style="fill: rgb(38, 50, 56); transform-origin: 108.175px 345.225px;" id="elpatykwc1dfc" class="animable"></path><path d="M126.07,343.21s-4.62,1.7-3.25,5.73,16,10.65,16,10.65,6.13-5.62.5-14.75S126.2,340.33,126.07,343.21Z" style="fill: rgb(141, 29, 37); transform-origin: 132.132px 349.522px;" id="elr8ufec5k0ee" class="animable"></path><g id="elueh9d4scvy"><path d="M126.07,343.21s-4.62,1.7-3.25,5.73,16,10.65,16,10.65,6.13-5.62.5-14.75S126.2,340.33,126.07,343.21Z" style="fill: rgb(255, 255, 255); isolation: isolate; opacity: 0.2; transform-origin: 132.132px 349.522px;" class="animable"></path></g><path d="M106,335.54s4.92-.2,5.2,4-10.67,16-10.67,16-7.81-2.82-6.13-13.42S104.74,332.93,106,335.54Z" style="fill: rgb(141, 29, 37); transform-origin: 102.684px 344.607px;" id="elx03r2q0gbgr" class="animable"></path><g id="el8qttsxncrsn"><path d="M106,335.54s4.92-.2,5.2,4-10.67,16-10.67,16-7.81-2.82-6.13-13.42S104.74,332.93,106,335.54Z" style="fill: rgb(255, 255, 255); isolation: isolate; opacity: 0.2; transform-origin: 102.684px 344.607px;" class="animable"></path></g><path d="M101.8,315.23s3.28-.36,3-2.36-12.77-7.14-20.14,1.18c0,0,4.72,8.11,11.55,8.22S101.8,315.23,101.8,315.23Z" style="fill: rgb(141, 29, 37); transform-origin: 94.7385px 315.865px;" id="elyjyqd4gkldq" class="animable"></path><g id="el72k8wivazvq"><path d="M101.8,315.23s3.28-.36,3-2.36-12.77-7.14-20.14,1.18c0,0,4.72,8.11,11.55,8.22S101.8,315.23,101.8,315.23Z" style="fill: rgb(255, 255, 255); isolation: isolate; opacity: 0.2; transform-origin: 94.7385px 315.865px;" class="animable"></path></g><path d="M107.92,310.37s-3,1.44-3.81-.4,7-12.82,17.71-9.65c0,0,.29,9.38-5.45,13.08S107.92,310.37,107.92,310.37Z" style="fill: rgb(141, 29, 37); transform-origin: 112.937px 307.13px;" id="elph3a73xf4f" class="animable"></path><g id="el8l3uz5gfaaw"><path d="M107.92,310.37s-3,1.44-3.81-.4,7-12.82,17.71-9.65c0,0,.29,9.38-5.45,13.08S107.92,310.37,107.92,310.37Z" style="fill: rgb(255, 255, 255); isolation: isolate; opacity: 0.2; transform-origin: 112.937px 307.13px;" class="animable"></path></g><path d="M92.37,341.59s2.27-1.83-.18-2.72-14.44-.64-14.57,11.24c0,0,14,2.33,15.71-2.2S92.37,341.59,92.37,341.59Z" style="fill: rgb(141, 29, 37); transform-origin: 85.7609px 344.633px;" id="ellexrbbg0rvn" class="animable"></path><g id="elzxtyi2ubkj"><path d="M92.37,341.59s2.27-1.83-.18-2.72-14.44-.64-14.57,11.24c0,0,14,2.33,15.71-2.2S92.37,341.59,92.37,341.59Z" style="fill: rgb(255, 255, 255); isolation: isolate; opacity: 0.2; transform-origin: 85.7609px 344.633px;" class="animable"></path></g><path d="M120.87,314.93s-2.27-1.83.18-2.72,14.45-.64,14.57,11.24c0,0-14,2.33-15.71-2.2S120.87,314.93,120.87,314.93Z" style="fill: rgb(141, 29, 37); transform-origin: 127.479px 317.973px;" id="elfk0n01ei8ak" class="animable"></path><g id="el1a6hmdvcc8r"><path d="M120.87,314.93s-2.27-1.83.18-2.72,14.45-.64,14.57,11.24c0,0-14,2.33-15.71-2.2S120.87,314.93,120.87,314.93Z" style="fill: rgb(255, 255, 255); isolation: isolate; opacity: 0.2; transform-origin: 127.479px 317.973px;" class="animable"></path></g><path d="M113.48,324.5s-.2-2.22,1.6-1.35,8,7.62,1.57,14c0,0-8.73-6.47-7.16-9.83S113.48,324.5,113.48,324.5Z" style="fill: rgb(141, 29, 37); transform-origin: 114.401px 330.049px;" id="elwp0t76vj5n" class="animable"></path><g id="eljqwtg0kfmsf"><path d="M113.48,324.5s-.2-2.22,1.6-1.35,8,7.62,1.57,14c0,0-8.73-6.47-7.16-9.83S113.48,324.5,113.48,324.5Z" style="fill: rgb(255, 255, 255); isolation: isolate; opacity: 0.2; transform-origin: 114.401px 330.049px;" class="animable"></path></g><path d="M90.35,327.67s1.35-1.77-.63-2-10.88,2.15-8.81,11c0,0,10.83-.82,11.3-4.5S90.35,327.67,90.35,327.67Z" style="fill: rgb(141, 29, 37); transform-origin: 86.4363px 331.163px;" id="elb3mpsa016n" class="animable"></path><g id="ells3w8063y5"><path d="M90.35,327.67s1.35-1.77-.63-2-10.88,2.15-8.81,11c0,0,10.83-.82,11.3-4.5S90.35,327.67,90.35,327.67Z" style="fill: rgb(255, 255, 255); isolation: isolate; opacity: 0.2; transform-origin: 86.4363px 331.163px;" class="animable"></path></g><polygon points="126.94 410.68 89.77 410.68 85.77 369.99 130.95 369.99 126.94 410.68" style="fill: rgb(38, 50, 56); transform-origin: 108.36px 390.335px;" id="elrjw23cvadf" class="animable"></polygon><g id="elnl4tsvy18sa"><polygon points="126.94 410.68 89.77 410.68 85.77 369.99 130.95 369.99 126.94 410.68" style="fill: rgb(255, 255, 255); opacity: 0.7; transform-origin: 108.36px 390.335px;" class="animable"></polygon></g><rect x="83.78" y="365.5" width="49.15" height="8.98" style="fill: rgb(38, 50, 56); transform-origin: 108.355px 369.99px;" id="eltur5c3pg4v" class="animable"></rect><g id="elza78zvhl2m"><rect x="83.78" y="365.5" width="49.15" height="8.98" style="fill: rgb(255, 255, 255); opacity: 0.5; transform-origin: 108.355px 369.99px;" class="animable"></rect></g></g><g id="freepik--Character--inject-140" class="animable animator-active" style="transform-origin: 242.815px 308.011px;"><path d="M293.53,276c.86,2.93,1.69,6,2.6,9s1.78,6,2.71,8.93,1.91,5.84,3,8.43c.27.64.54,1.26.81,1.81s.54,1.05.69,1.29.11.17-.07,0c-.52-.36.05,0,.24.16.45.33,1.16.73,1.77,1.11,2.59,1.56,5.37,3.12,8.13,4.66l8.34,4.67q8.39,4.65,16.67,9.59l-2.76,6q-9.17-3.14-18.12-6.75c-3-1.19-6-2.47-8.95-3.72s-5.93-2.62-9-4.12c-.78-.41-1.5-.75-2.39-1.28a10.38,10.38,0,0,1-1.77-1.16,12,12,0,0,1-1.69-1.73,23,23,0,0,1-1.9-2.75c-.51-.86-1-1.67-1.36-2.48a93.92,93.92,0,0,1-4-9.45,177.6,177.6,0,0,1-5.81-18.86Z" style="fill: rgb(255, 181, 115); transform-origin: 309.545px 303.825px;" id="elaaugr9zbmm" class="animable"></path><path d="M300.62,289.5l-18.14,4.88-.72-1.44-5.71-11.36,7.74-4.35,10.36-5.82C297,276.06,300.62,289.5,300.62,289.5Z" style="fill: rgb(38, 50, 56); transform-origin: 288.335px 282.895px;" id="elbr3ituss36" class="animable"></path><g id="elswb7tkng5gf"><path d="M281.76,292.94l-5.71-11.36,7.74-4.35C284.49,280,285.93,287.72,281.76,292.94Z" style="isolation: isolate; opacity: 0.2; transform-origin: 280.329px 285.085px;" class="animable"></path></g><path d="M294.15,271.41s-15.39,29.8-52.95,37.81l-35.38-13.59s5.74-4.86,13.09-11.84a242.11,242.11,0,0,0,19.59-20.66c4.13-5,7.61-10,9.59-14.32C248.09,248.81,278.14,247.59,294.15,271.41Z" style="fill: rgb(38, 50, 56); transform-origin: 249.985px 279.01px;" id="elop0pcdj0slg" class="animable"></path><path d="M282.48,287.53s-1.18,1.84-3.39,4.57c-4.91,6.07-14.92,16.52-28.32,20.84-19.44,6.25-30.47-3.72-30.47-3.72V294.94c15.22,2,29.62-10.57,35-16,1.43-1.43,2.22-2.35,2.22-2.35l5.37,2.35L278,285.57Z" style="fill: rgb(141, 29, 37); transform-origin: 251.39px 295.795px;" id="elbzfd2lt1nup" class="animable"></path><g id="el8osad3a5k6c"><path d="M262.88,279c-.67,2.35-2,5.6-4.37,5.27s-3.06-3.32-3.22-5.27c1.43-1.43,2.22-2.35,2.22-2.35Z" style="opacity: 0.2; transform-origin: 259.085px 280.472px;" class="animable"></path></g><g id="elt2fhiyhrjnf"><path d="M252.4,295.63s7.81,3.83,14.15,5.22c2.08-1.54,3.52-2.73,3.52-2.73L252.92,292c-6.2,6.66-13.61,9.25-13.36,11s9.05,5,14.05,4.83c2.77-.1,7.54-3.06,11.23-5.68C261.45,301.48,255.31,299.82,252.4,295.63Z" style="opacity: 0.2; transform-origin: 254.812px 299.918px;" class="animable"></path></g><path d="M253.73,249.05s8.84,6.59,2.47,30.74A2.67,2.67,0,0,0,258,283h0a2.66,2.66,0,0,0,3.35-1.87c1.69-6.38,5.16-22.67-.62-31.05Z" style="fill: rgb(141, 29, 37); transform-origin: 258.833px 266.083px;" id="elnau37ufxao" class="animable"></path><g id="elezb9xi3q21m"><path d="M260.59,280.11a1.47,1.47,0,1,1-2.93,0,1.47,1.47,0,0,1,2.93,0Z" style="opacity: 0.2; transform-origin: 259.125px 280.231px;" class="animable"></path></g><g id="elbg0zsnucf19"><path d="M282.48,287.53s-1.18,1.84-3.39,4.57c-2.74-1.06-1.91-4.45-1.1-6.53Z" style="opacity: 0.2; transform-origin: 279.843px 288.835px;" class="animable"></path></g><path d="M277.91,288.49c2.72-3.9,9.36-14.77,8.09-26.32l2.69,2.53s4.18,11.47-8.32,25.72a1.58,1.58,0,0,1-1.81.39h0A1.57,1.57,0,0,1,277.91,288.49Z" style="fill: rgb(141, 29, 37); transform-origin: 283.498px 276.557px;" id="elqg3qmg1gwsb" class="animable"></path><g id="elnv5l3see4v"><path d="M280.79,289.38a1.14,1.14,0,1,1-.21-1.81A1.31,1.31,0,0,1,280.79,289.38Z" style="opacity: 0.2; transform-origin: 279.962px 288.554px;" class="animable"></path></g><polygon points="167.87 399.26 206.96 397.84 199.85 412.19 160.56 405.01 167.87 399.26" style="fill: rgb(235, 179, 118); transform-origin: 183.76px 405.015px;" id="elcp6tqzc59pi" class="animable"></polygon><path d="M172.16,398.57c.67.77-9.09,8.56-9.09,8.56s-10.91-.61-17.6,3.1-6.61-2.39-.46-8l15.23-13.85C164.62,384.42,165.27,390.63,172.16,398.57Z" style="fill: rgb(38, 50, 56); transform-origin: 156.308px 399.259px;" id="elptyl7bor0cn" class="animable"></path><path d="M168.89,402.12a.29.29,0,0,1,.13,0h0a.17.17,0,0,1,.1,0h0a.19.19,0,0,1,.09.05h0a.28.28,0,0,1,.08.11c.06.14,1.23,3,.45,4.63a1.88,1.88,0,0,1-1.22,1.05,1.14,1.14,0,0,1-1.31-.22c-.41-.51-.2-1.6.19-2.68a5.14,5.14,0,0,1-2.27,1.66,1.37,1.37,0,0,1-1.06-.18,1.19,1.19,0,0,1-.67-1.19,1.67,1.67,0,0,1,.61-1A15.68,15.68,0,0,1,168.89,402.12Zm-.7.92c-1.88.66-4,1.69-4.14,2.44,0,.07,0,.26.38.54a.65.65,0,0,0,.55.08,3,3,0,0,0,1.27-.78A15.14,15.14,0,0,0,168.19,403Zm1,3.62c.45-1,.06-2.52-.22-3.42-.9,1.76-1.56,3.68-1.21,4.11.11.14.43.07.61,0a1.31,1.31,0,0,0,.52-.28A1.33,1.33,0,0,0,169.15,406.66Z" style="fill: rgb(141, 29, 37); transform-origin: 166.701px 405.094px;" id="elx839czprpk" class="animable"></path><polygon points="176.44 408.52 184.51 388.69 209.54 390.99 206.61 414.27 176.44 408.52" style="fill: rgb(141, 29, 37); transform-origin: 192.99px 401.48px;" id="elit3sx20qyge" class="animable"></polygon><g id="el5t2s9j9bbvl"><polygon points="176.44 408.52 184.51 388.69 209.54 390.99 206.61 414.27 176.44 408.52" style="opacity: 0.2; transform-origin: 192.99px 401.48px;" class="animable"></polygon></g><polygon points="148.4 403.76 187.5 402.33 180.39 416.69 141.1 409.51 148.4 403.76" style="fill: rgb(235, 179, 118); transform-origin: 164.3px 409.51px;" id="elxa8lcl92h5i" class="animable"></polygon><path d="M152.7,403.07c.67.76-9.09,8.56-9.09,8.56s-10.91-.61-17.6,3.1-6.61-2.39-.46-8l15.23-13.85C145.16,388.91,145.81,395.13,152.7,403.07Z" style="fill: rgb(38, 50, 56); transform-origin: 136.848px 403.757px;" id="elj5v8uyxqte" class="animable"></path><path d="M141.5,411.37h.13a.29.29,0,0,1,.1,0h0a.24.24,0,0,1,.08.06h0a.28.28,0,0,1,.08.11c.06.15,1.23,3,.45,4.63a1.93,1.93,0,0,1-1.22,1.06,1.14,1.14,0,0,1-1.31-.23c-.41-.51-.2-1.59.19-2.67a5.11,5.11,0,0,1-2.27,1.65,1.33,1.33,0,0,1-1.06-.17,1.19,1.19,0,0,1-.67-1.19,1.72,1.72,0,0,1,.61-1A15.74,15.74,0,0,1,141.5,411.37Zm-.7.92c-1.88.66-4,1.69-4.14,2.44,0,.07,0,.27.38.55a.71.71,0,0,0,.56.08,3.18,3.18,0,0,0,1.27-.79A14.15,14.15,0,0,0,140.8,412.29Zm1,3.63a5.41,5.41,0,0,0-.22-3.42c-.89,1.76-1.56,3.67-1.21,4.11.11.13.43.06.61,0a1.32,1.32,0,0,0,.52-.29A1.4,1.4,0,0,0,141.76,415.92Z" style="fill: rgb(141, 29, 37); transform-origin: 139.301px 414.354px;" id="el6oz9peqcxmw" class="animable"></path><path d="M312.34,398.3C309.52,410.21,300.77,414,292,414.63c-10.69.74-21.39-3.3-21.39-3.3s-1,4.06-19.84,6c-26.85,2.79-84.37.38-84.37.38L171,400.53,227,389.12s-41.94-36.55-39.13-67.53c1-11.11,20-30.73,20.32-31.57l47.72,14.7-5.15,8.22S318.37,373,312.34,398.3Z" style="fill: rgb(141, 29, 37); transform-origin: 239.56px 354.348px;" id="elhimjz4xmabq" class="animable"></path><g id="elgbieeu6d9uo"><path d="M292,414.63c-10.69.74-21.39-3.3-21.39-3.3s5-6.53,3.61-17.8c-1.33-11.1-35.84-64.45-36.84-66,1.49,1.38,49,45.47,55.36,67.5C295.16,403.39,294.18,409.84,292,414.63Z" style="opacity: 0.2; transform-origin: 265.767px 371.125px;" class="animable"></path></g><path d="M283.33,261.08c-1,2.41.06,3.59.06,3.59a5.31,5.31,0,0,1-7.78,3.15c-7.13-4.21-5.34-14.3-5.34-14.3,6.44.35,10.43-5.09,12.3-8.55a20.26,20.26,0,0,0,1.29-2.8l7.21,11.09a38.91,38.91,0,0,0-4.32,3.4A14,14,0,0,0,283.33,261.08Z" style="fill: rgb(255, 181, 115); transform-origin: 280.57px 255.355px;" id="elq7eoy26o9ti" class="animable"></path><g id="elnjqfu86lqde"><path d="M291.07,253.26a38.91,38.91,0,0,0-4.32,3.4,14,14,0,0,0-3.42,4.42c-5.67-2.77-.76-16-.76-16V245a20.26,20.26,0,0,0,1.29-2.8Z" style="isolation: isolate; opacity: 0.2; transform-origin: 285.833px 251.64px;" class="animable"></path></g><path d="M296,217.58s7-12-1.05-17a16.49,16.49,0,0,0-15.8-.8s-1.8-4.11-8.66-1.65-10.26,8.49-5.86,15.39c0,0-3.89,2.49-3.89,6.5s5.5,9.85,1.29,10.54c0,0,5,.64,2.81-5.15,0,0,4.4,2,2.2,6.93s2.2,5.54,2.2,5.54-4-3.24,0-5.54,8.65-4.51,8.74-10.72c0-2,5.29,1.49,7.86.88A31.75,31.75,0,0,0,296,217.58Z" style="fill: rgb(38, 50, 56); transform-origin: 279.781px 217.613px;" id="elt51ervqtsyr" class="animable"></path><path d="M300,220.55c10.84,3.23,12.6,10.08,10.07,21.49-3.17,14.27-9.23,23.27-21.9,16.24C271,248.74,282,215.18,300,220.55Z" style="fill: rgb(255, 181, 115); transform-origin: 295.338px 240.346px;" id="el5ajql9jeqtd" class="animable"></path><path d="M303.28,239.35a24.2,24.2,0,0,0,1.81,5.44,3.12,3.12,0,0,1-3.22.37Z" style="fill: rgb(213, 135, 69); transform-origin: 303.48px 242.398px;" id="elvokim21lgf" class="animable"></path><path d="M296.9,236.48c-.24.9-.93,1.49-1.52,1.33s-.89-1-.64-1.92.92-1.49,1.52-1.33S297.15,235.58,296.9,236.48Z" style="fill: rgb(38, 50, 56); transform-origin: 295.821px 236.185px;" id="elpkmbl21saql" class="animable"></path><path d="M296,234.54l2.16-.24S296.74,235.68,296,234.54Z" style="fill: rgb(38, 50, 56); transform-origin: 297.08px 234.646px;" id="eldglkreq98n5" class="animable"></path><path d="M308.11,239.34c-.25.89-.93,1.49-1.53,1.33s-.88-1-.64-1.92.93-1.5,1.53-1.33S308.35,238.44,308.11,239.34Z" style="fill: rgb(38, 50, 56); transform-origin: 307.025px 239.043px;" id="elw1ly2kqktg" class="animable"></path><path d="M307.2,237.39l2.16-.23S308,238.54,307.2,237.39Z" style="fill: rgb(38, 50, 56); transform-origin: 308.28px 237.504px;" id="el6afchj2g4ew" class="animable"></path><path d="M293.83,229.71a.46.46,0,0,1-.39-.21.48.48,0,0,1,.12-.67c2.43-1.7,5.52-.4,5.65-.34a.47.47,0,0,1,.25.63.47.47,0,0,1-.63.25s-2.73-1.14-4.72.25A.49.49,0,0,1,293.83,229.71Z" style="fill: rgb(38, 50, 56); transform-origin: 296.428px 228.834px;" id="eltsbsvhbqbt" class="animable"></path><path d="M311.07,233.56a.49.49,0,0,1-.38-.18,4.83,4.83,0,0,0-3.61-2.1.49.49,0,0,1-.49-.47.48.48,0,0,1,.46-.49,5.73,5.73,0,0,1,4.4,2.46.49.49,0,0,1-.08.68A.47.47,0,0,1,311.07,233.56Z" style="fill: rgb(38, 50, 56); transform-origin: 309.071px 231.94px;" id="ell5f6o9gmgh8" class="animable"></path><path d="M282.73,235.3s7.73-7.4,9-14.51c0,0,24.11-2.38,18.67,19.75,0,0,7.88-18.74-10.64-24.73s-26.57,21.32-19.36,32.31C280.41,248.12,277.94,239.94,282.73,235.3Z" style="fill: rgb(38, 50, 56); transform-origin: 294.922px 231.541px;" id="eljq8m4uncpej" class="animable"></path><path d="M301.86,248.85a35.33,35.33,0,0,0-2.82,4.09c-.27-.1-.54-.2-.81-.32-3.69-1.47-4.91-3.37-5.15-5a4.94,4.94,0,0,1,.29-2.4A5.09,5.09,0,0,1,294,244c1.49,1.94,4.82,3.58,6.64,4.38C301.37,248.67,301.86,248.85,301.86,248.85Z" style="fill: rgb(38, 50, 56); transform-origin: 297.45px 248.47px;" id="eloeecbn3lx2k" class="animable"></path><path d="M300.62,248.33l-.87,1.19c-3.46-1.4-5.72-2.85-6.38-4.33A5.09,5.09,0,0,1,294,244C295.47,245.89,298.8,247.53,300.62,248.33Z" style="fill: rgb(255, 255, 255); transform-origin: 296.995px 246.76px;" id="el4ooys8smzf6" class="animable"></path><path d="M298.23,252.62c-3.69-1.47-4.91-3.37-5.15-5a12.63,12.63,0,0,1,3.77,2.45A4.84,4.84,0,0,1,298.23,252.62Z" style="fill: rgb(222, 87, 83); transform-origin: 295.655px 250.12px;" id="elyqhxzhmqexn" class="animable"></path><path d="M277.79,240.35c.07,1.32,7.3-29.25,30.49-19.34l-3.85-5.42C296.5,211.16,276.48,213.76,277.79,240.35Z" style="fill: rgb(141, 29, 37); transform-origin: 293.004px 227.12px;" id="elysjz4csv64" class="animable"></path><path d="M283.82,238.11a5,5,0,0,0-3.82-5.87c-3.47-.63-7.13,5.79.74,9.94C281.86,242.77,282.89,241.8,283.82,238.11Z" style="fill: rgb(255, 181, 115); transform-origin: 279.984px 237.269px;" id="elu97bacgbky" class="animable"></path><g id="el0hrglbpmp84e"><path d="M246,315.33a15.17,15.17,0,0,0,4.76-2.39c-1.53.26-3,.43-4.5.55A2,2,0,0,1,246,315.33Z" style="opacity: 0.2; transform-origin: 248.38px 314.135px;" class="animable"></path></g><g id="eljg2s73diq1d"><path d="M222,309.31a55.38,55.38,0,0,1-18.72-13.5l-3.06,3.72s5.49,8.09,18.55,13.34A8.93,8.93,0,0,0,222,309.31Z" style="opacity: 0.2; transform-origin: 211.11px 304.34px;" class="animable"></path></g><g id="eleu91peeb5y6"><path d="M244.83,313.59a49.13,49.13,0,0,1-20.19-3.17,19,19,0,0,1-3.55,3.33c1.28.45,2.62.87,4,1.25,7.68,2.07,13.52,1.95,17.68,1.16A3.56,3.56,0,0,0,244.83,313.59Z" style="opacity: 0.2; transform-origin: 232.96px 313.555px;" class="animable"></path></g><path d="M283.13,333.4l-5.9,2.34-10.46-29.26-2.32,1.38,10.61,28.74-7.17,2.85s4.57,11.69,15.24,15.8C283.13,355.25,289.15,348.07,283.13,333.4Z" style="fill: rgb(38, 50, 56); transform-origin: 275.128px 330.865px;" id="elnsbbk2s9aws" class="animable"></path><g id="el76nw33zf6f"><path d="M283.13,333.4l-5.9,2.34-10.46-29.26-2.32,1.38,10.61,28.74-7.17,2.85s4.57,11.69,15.24,15.8C283.13,355.25,289.15,348.07,283.13,333.4Z" style="fill: rgb(255, 255, 255); opacity: 0.2; transform-origin: 275.128px 330.865px;" class="animable"></path></g><path d="M264.34,306.6l1.89-.73a1,1,0,0,1,1.3.6l6.66,19.1a1,1,0,0,1-.64,1.28l-1.47.47a1,1,0,0,1-1.25-.6l-7.07-18.83A1,1,0,0,1,264.34,306.6Z" style="fill: rgb(141, 29, 37); transform-origin: 268.97px 316.587px;" id="eltqdq9ib7m0k" class="animable"></path><g id="el09hp90rppvza"><path d="M264.34,306.6l1.89-.73a1,1,0,0,1,1.3.6l6.66,19.1a1,1,0,0,1-.64,1.28l-1.47.47a1,1,0,0,1-1.25-.6l-7.07-18.83A1,1,0,0,1,264.34,306.6Z" style="opacity: 0.2; transform-origin: 268.97px 316.587px;" class="animable"></path></g><path d="M342.18,324.12a20.17,20.17,0,0,0-6.4-1.22l-4.12-3.76-3.79,11.62,8.44,1.94,7.53,4.4,9.56.29.27-11Z" style="fill: rgb(141, 29, 37); transform-origin: 340.77px 328.265px;" id="elae8cjomi28s" class="animable"></path><g id="elsbk9tprglrk"><path d="M342.18,324.12a20.17,20.17,0,0,0-6.4-1.22l-4.12-3.76-3.79,11.62,8.44,1.94,7.53,4.4,9.56.29.27-11Z" style="fill: rgb(255, 255, 255); opacity: 0.6; transform-origin: 340.77px 328.265px;" class="animable"></path></g><path d="M360.16,316.84a2.84,2.84,0,0,1-2.54,0c-.87-.35-2,.17-2.36-1a1.46,1.46,0,0,1,.46-1.61l.15-.12s0-.63.88-.75,1.28.41,1.9.75,1.93.16,2.72,1.43a2,2,0,0,1,.25.53C361.75,316.7,360.84,316.46,360.16,316.84Z" style="fill: rgb(141, 29, 37); transform-origin: 358.406px 315.241px;" id="el6ltd5p3jy9e" class="animable"></path><g id="ely480qnadnf"><path d="M361.62,316.1a58.32,58.32,0,0,1-5.7-1.75l-.2-.09.15-.12s0-.63.88-.75,1.28.41,1.9.75,1.93.16,2.72,1.43A2,2,0,0,1,361.62,316.1Z" style="opacity: 0.2; transform-origin: 358.67px 314.736px;" class="animable"></path></g><path d="M362.27,310.33a18.58,18.58,0,0,0-2.88,1c-1.08.63-1.74,1.95-2.88,1.72s-2.74-.6-1.6-2.72c0,0,0-.05,0-.08s-1.32.33-2-.36a1.8,1.8,0,0,1,.58-2.7c1.08-.51,1.13.18,2.17-.46s1.72-.11,3.16,0a25.82,25.82,0,0,0,3.1.24,4.19,4.19,0,0,1,2.55,1.25.73.73,0,0,1,.15.16C365,308.8,362.9,310,362.27,310.33Z" style="fill: rgb(141, 29, 37); transform-origin: 358.597px 309.748px;" id="elp3b19o2d2vh" class="animable"></path><g id="elgo6yk8mcavp"><path d="M364.53,308.22a16.36,16.36,0,0,0-9.62,2.11s0-.05,0-.08-1.32.33-2-.36a1.8,1.8,0,0,1,.58-2.7c1.08-.51,1.13.18,2.17-.46s1.72-.11,3.16,0a25.82,25.82,0,0,0,3.1.24A4.19,4.19,0,0,1,364.53,308.22Z" style="fill: rgb(255, 255, 255); opacity: 0.2; transform-origin: 358.529px 308.375px;" class="animable"></path></g><path d="M354.83,287.92c-.51,1.24,1.45,3-2.43,5-2.06,1.05-3-2-3-2l-.25,0c-1.87.23-2.82-.14-2.82-2.14s.43-3.68,2.24-4.65a19.32,19.32,0,0,0,3.43-2.6,6.54,6.54,0,0,1,3.84-.87,2.18,2.18,0,0,1,.47.09c.7.26-.45,2,0,3.38S355.34,286.67,354.83,287.92Z" style="fill: rgb(141, 29, 37); transform-origin: 351.436px 286.889px;" id="el01m6ps98dy3m" class="animable"></path><g id="el42ygamyunhu"><path d="M354.83,287.92c-.51,1.24,1.45,3-2.43,5-2.06,1.05-3-2-3-2l-.25,0c.88-2.37,3.21-7.92,6.69-10.26a2.18,2.18,0,0,1,.47.09c.7.26-.45,2,0,3.38S355.34,286.67,354.83,287.92Z" style="opacity: 0.2; transform-origin: 352.846px 286.9px;" class="animable"></path></g><path d="M362.76,294.88c-.95.91-1,1.84-2.5,2.58s-3.1,2.55-4.83,2.64-3.13-.26-3-1.38,1.52-2.22,1.87-2.51l.08-.06c-1.93-.1-2-.07-2-1.65s3.13-2.59,4.11-2.15,2.87-1.38,3.65-1.08a7.84,7.84,0,0,0,1.81.45,8.15,8.15,0,0,0,1.3.11C364.39,291.83,363.71,294,362.76,294.88Z" style="fill: rgb(141, 29, 37); transform-origin: 358.113px 295.675px;" id="elufu4db1nvhj" class="animable"></path><g id="elskcwe3pjoda"><path d="M362,291.72a14.91,14.91,0,0,1-7.7,4.49l.08-.06c-1.93-.1-2-.07-2-1.65s3.13-2.59,4.11-2.15,2.87-1.38,3.65-1.08A7.84,7.84,0,0,0,362,291.72Z" style="opacity: 0.2; transform-origin: 357.19px 293.723px;" class="animable"></path></g><path d="M343.84,293.64c-.77,1.11-3.23,1-4.88-.45h0l-.37-.37s.14,4.35-1.53,4.18-3.41-1.55-5.05-3.36-.69-2.84-1.12-4.81-1.38-1.74-1.47-4.65a16.87,16.87,0,0,1,1-7,2.89,2.89,0,0,1,.51-1c.54-.61,1.05.33,2.45.38,1.81.06,3.53,1.05,5.6,3.12s2.92,6.38,4.86,7.41S344.66,292.43,343.84,293.64Z" style="fill: rgb(141, 29, 37); transform-origin: 337.147px 286.49px;" id="elyqo54afhf6r" class="animable"></path><g id="elrbhbdpmjl5"><path d="M343.84,293.64c-.77,1.11-3.23,1-4.88-.45h0c-1.85-6.82-6.46-14.53-8-17,.54-.61,1.05.33,2.45.38,1.81.06,3.53,1.05,5.6,3.12s2.92,6.38,4.86,7.41S344.66,292.43,343.84,293.64Z" style="fill: rgb(255, 255, 255); opacity: 0.2; transform-origin: 337.947px 285.186px;" class="animable"></path></g><path d="M336.05,303.13c-.95,1-2.76.24-4.05,0s-6.29-.54-7.49-1.39-4.07-2.15-4.16-3.15a.48.48,0,0,1,.11-.34c.77-1,4.91-3.15,7.12-3.32s3.13,0,6.15,1.55c2.64,1.36,2,3.08,1.22,3.17a.55.55,0,0,1-.33,0S337,302.17,336.05,303.13Z" style="fill: rgb(141, 29, 37); transform-origin: 328.311px 299.255px;" id="ely2axa0td9uf" class="animable"></path><g id="elr2gusms9i1d"><path d="M335,299.65c-8.32-3.2-12.77-2-14.6-1.06a.48.48,0,0,1,.11-.34c.77-1,4.91-3.15,7.12-3.32s3.13,0,6.15,1.55C336.37,297.84,335.75,299.56,335,299.65Z" style="opacity: 0.2; transform-origin: 328.026px 297.264px;" class="animable"></path></g><path d="M341.1,301.89a65.54,65.54,0,0,0-2.32-9.07,68.85,68.85,0,0,0-3.51-8.64,70.24,70.24,0,0,1,3.1,8.77,65.45,65.45,0,0,1,1.87,9.07c0,.21.05.41.08.62-.75-.52-1.51-1-2.29-1.48a37.14,37.14,0,0,0-3.31-1.73,21.52,21.52,0,0,0-7.14-2,21.38,21.38,0,0,1,7,2.32,35.71,35.71,0,0,1,5.9,3.87,71.36,71.36,0,0,1,.43,7.59,53,53,0,0,1-.71,9.12l1.72.31a53.62,53.62,0,0,0,.29-9.46A66.17,66.17,0,0,0,341.1,301.89Z" style="fill: rgb(38, 50, 56); transform-origin: 334.94px 302.41px;" id="elixdwcc3hu8a" class="animable"></path><path d="M353,311.78a20,20,0,0,1,3.28-1.86c.8-.41,1.66-.67,2.5-1s1.74-.5,2.61-.75c-.89.18-1.79.31-2.67.54a24.72,24.72,0,0,0-7.52,3.29,22.32,22.32,0,0,0-4.2,3.63,21.06,21.06,0,0,0-2.28,3,58.25,58.25,0,0,1,.14-6.73,73,73,0,0,1,1.28-9.17c.31-1.41.64-2.82,1-4.22q3.4-.87,6.71-2c1.14-.4,2.26-.84,3.36-1.33a11.78,11.78,0,0,0,3.07-1.88,11.71,11.71,0,0,1-3.14,1.72c-1.11.44-2.25.82-3.39,1.17-2.11.62-4.26,1.15-6.41,1.61.37-1.35.76-2.7,1.23-4,.45-1.49,1.05-2.92,1.59-4.38s1.22-2.86,1.83-4.29c-.67,1.4-1.4,2.78-2,4.21s-1.27,2.84-1.79,4.31a79.35,79.35,0,0,0-2.87,8.93,73.74,73.74,0,0,0-1.73,9.24,52.38,52.38,0,0,0-.39,9.48l1.73-.2c0-.11,0-.23,0-.34l.55.2a18.13,18.13,0,0,1,2.58-4.46,21,21,0,0,1,3.72-3.76l.77-.56a17.85,17.85,0,0,0,3.45,2.2,11.8,11.8,0,0,0,4.24,1.22,11.65,11.65,0,0,1-4.09-1.5A17.92,17.92,0,0,1,353,311.78Z" style="fill: rgb(38, 50, 56); transform-origin: 352.268px 303.215px;" id="el3754kicial8" class="animable"></path><g id="el4cqzmxo0u7f"><g style="opacity: 0.2; transform-origin: 344.485px 302.74px;" class="animable"><path d="M341.1,301.89a65.54,65.54,0,0,0-2.32-9.07,68.85,68.85,0,0,0-3.51-8.64,70.24,70.24,0,0,1,3.1,8.77,65.45,65.45,0,0,1,1.87,9.07c0,.21.05.41.08.62-.75-.52-1.51-1-2.29-1.48a37.14,37.14,0,0,0-3.31-1.73,21.52,21.52,0,0,0-7.14-2,21.38,21.38,0,0,1,7,2.32,35.71,35.71,0,0,1,5.9,3.87,71.36,71.36,0,0,1,.43,7.59,53,53,0,0,1-.71,9.12l1.72.31a53.62,53.62,0,0,0,.29-9.46A66.17,66.17,0,0,0,341.1,301.89Z" style="fill: rgb(255, 255, 255); transform-origin: 334.94px 302.41px;" id="elvhb55q9glta" class="animable"></path><path d="M353,311.78a20,20,0,0,1,3.28-1.86c.8-.41,1.66-.67,2.5-1s1.74-.5,2.61-.75c-.89.18-1.79.31-2.67.54a24.72,24.72,0,0,0-7.52,3.29,22.32,22.32,0,0,0-4.2,3.63,21.06,21.06,0,0,0-2.28,3,58.25,58.25,0,0,1,.14-6.73,73,73,0,0,1,1.28-9.17c.31-1.41.64-2.82,1-4.22q3.4-.87,6.71-2c1.14-.4,2.26-.84,3.36-1.33a11.78,11.78,0,0,0,3.07-1.88,11.71,11.71,0,0,1-3.14,1.72c-1.11.44-2.25.82-3.39,1.17-2.11.62-4.26,1.15-6.41,1.61.37-1.35.76-2.7,1.23-4,.45-1.49,1.05-2.92,1.59-4.38s1.22-2.86,1.83-4.29c-.67,1.4-1.4,2.78-2,4.21s-1.27,2.84-1.79,4.31a79.35,79.35,0,0,0-2.87,8.93,73.74,73.74,0,0,0-1.73,9.24,52.38,52.38,0,0,0-.39,9.48l1.73-.2c0-.11,0-.23,0-.34l.55.2a18.13,18.13,0,0,1,2.58-4.46,21,21,0,0,1,3.72-3.76l.77-.56a17.85,17.85,0,0,0,3.45,2.2,11.8,11.8,0,0,0,4.24,1.22,11.65,11.65,0,0,1-4.09-1.5A17.92,17.92,0,0,1,353,311.78Z" style="fill: rgb(255, 255, 255); transform-origin: 352.268px 303.215px;" id="elz8krymlx9vg" class="animable"></path></g></g><path d="M332.5,325.92c.28-2.14,3.12-4,2.95-5.41a1.87,1.87,0,0,1,1-1.63c.35-.24,1.41-1,1.79-.92a1.54,1.54,0,0,0,.51.1c.38-.06.54-.57.91-.68l.25-.05a.61.61,0,0,0,.45-.45c0-.15,0-.31.11-.43a1,1,0,0,1,.26-.18,1.73,1.73,0,0,0,.43-.53c.11-.16.62-.56.86-.5a.33.33,0,0,1,.17.12,1.78,1.78,0,0,1,.56,1c0,.21,0,.45.09.62s.69.16.87.44a2.15,2.15,0,0,1,.14.45c.15.34.65.44.73.81.11.53.1.58.66.35.33-.14.61-.38.94-.53a1.22,1.22,0,0,1,1.75.66c1,1.72.28,2.51,1.31,3.75s1.92,1.88,1.91,3-1.05,5.45-1.57,5.79-1.2-.1-2.92,1-.8,2.12-2.81,2.12-2.52-.2-3,0-.34,2.11-2.41,0S332,329.94,332.5,325.92Z" style="fill: rgb(38, 50, 56); transform-origin: 341.805px 325.519px;" id="elg5i99v1atwn" class="animable"></path><path d="M348.31,330.55a3.18,3.18,0,0,1-.25,2.67c-.18.38-.43.73-.6,1a1.4,1.4,0,0,0-.14,1,1.82,1.82,0,0,0,.16.53,2.09,2.09,0,0,1,.24.6,1.89,1.89,0,0,0,.07.57c0,.08.08.17.12.29a.43.43,0,0,1-.09.38c-.16.19-.3.26-.38.44a2.58,2.58,0,0,0-.2.55,6.6,6.6,0,0,0-.19,1.18,6.05,6.05,0,0,1,.08-1.2,2.67,2.67,0,0,1,.16-.6c.06-.2.27-.37.35-.49s0-.24-.1-.45a1.71,1.71,0,0,1-.14-.61,2.1,2.1,0,0,0-.26-.48,2.42,2.42,0,0,1-.24-.61A1.91,1.91,0,0,1,347,334c.18-.41.37-.74.51-1.09a3.13,3.13,0,0,0,.24-1.05,1.93,1.93,0,0,0-.17-.94Z" style="fill: rgb(38, 50, 56); transform-origin: 347.66px 335.155px;" id="elmv3961v9ljg" class="animable"></path><path d="M343.36,332.77a3.83,3.83,0,0,0,.25,2.24,2.44,2.44,0,0,1,.37.61,1.11,1.11,0,0,1-.15.81,1.2,1.2,0,0,0-.17.49,2.51,2.51,0,0,0,.08.57,25,25,0,0,1,.2,2.53c0,.41.2.8.26,1.23a1.27,1.27,0,0,1-.33,1.18,1.22,1.22,0,0,0,.23-1.16c-.1-.4-.29-.79-.38-1.21a22.75,22.75,0,0,0-.4-2.47,3,3,0,0,1-.15-.67,1.52,1.52,0,0,1,.17-.71c.17-.43.09-.38-.27-.83a4.5,4.5,0,0,1-.58-2.65Z" style="fill: rgb(38, 50, 56); transform-origin: 343.353px 337.58px;" id="elinrutf33e0q" class="animable"></path><path d="M339.42,331.86l-.26,2a.52.52,0,0,0,0,.33c.05.13.15.26.23.45a.74.74,0,0,1,0,.72,1.38,1.38,0,0,1-.45.39.5.5,0,0,0-.28.64,6.17,6.17,0,0,1,.31,1,6.75,6.75,0,0,0,0,1,1.06,1.06,0,0,0,.58.74,1.13,1.13,0,0,1-.69-.71,7.19,7.19,0,0,1-.08-1,6.54,6.54,0,0,0-.4-.89,1,1,0,0,1,0-.6,1,1,0,0,1,.37-.49,1.29,1.29,0,0,0,.29-.28.26.26,0,0,0-.05-.24l-.27-.4a1.14,1.14,0,0,1-.17-.64l0-2Z" style="fill: rgb(38, 50, 56); transform-origin: 338.942px 335.495px;" id="elfpdf2u6u2wq" class="animable"></path><path d="M336.15,331c-.06,0-.23,0-.36.23a1.4,1.4,0,0,0-.2.74,2.15,2.15,0,0,0,.12.83,2.91,2.91,0,0,1,.26,1V334h-.19a1,1,0,0,0-.84,1.22,7.7,7.7,0,0,1,.39.92,3.35,3.35,0,0,1,.15,1,3.42,3.42,0,0,0-.25-.95c-.13-.3-.32-.57-.49-.88a1.29,1.29,0,0,1,1-1.74l-.2.22a2.62,2.62,0,0,0-.33-.79,2.81,2.81,0,0,1-.27-1,2.22,2.22,0,0,1,.19-1.11,1.46,1.46,0,0,1,.4-.51,1,1,0,0,1,.74-.23Z" style="fill: rgb(38, 50, 56); transform-origin: 335.461px 333.643px;" id="el1frygj4qzk7" class="animable"></path><path d="M333.48,328.11c.08,0,0-.06-.16,0a.78.78,0,0,0-.24.47,3.8,3.8,0,0,1-.24.77.52.52,0,0,0,0,.54,1.59,1.59,0,0,0,.18.3.62.62,0,0,1,.18.47.58.58,0,0,1-.3.38,3,3,0,0,0-.26.24.87.87,0,0,0-.23.65.59.59,0,0,0,.45.52.65.65,0,0,1-.55-.5,1,1,0,0,1,.15-.79c.13-.23.44-.45.42-.54s-.28-.28-.42-.51a1.06,1.06,0,0,1-.14-.93,4,4,0,0,0,.12-.72,1.49,1.49,0,0,1,.36-.91,1.12,1.12,0,0,1,.51-.3.85.85,0,0,1,.72.14Z" style="fill: rgb(38, 50, 56); transform-origin: 333.15px 329.836px;" id="eljt9ndwydxo8" class="animable"></path><path d="M349.56,328.47a.42.42,0,0,1,.16-.33.46.46,0,0,1,.35-.11.5.5,0,0,1,.27.09.69.69,0,0,1,.24.29l.13.29c.09.2.18.39.27.63a1.32,1.32,0,0,1,.06.82,1.74,1.74,0,0,1-.39.62,1.11,1.11,0,0,0-.27,1.06,1,1,0,0,1,.09.68,1.92,1.92,0,0,1-.34.57,2,2,0,0,0,.23-.59.84.84,0,0,0-.18-.57,1.44,1.44,0,0,1,.11-1.39c.25-.41.29-.62.09-.94-.09-.15-.22-.34-.34-.52l-.18-.27c-.06-.09,0,.05,0,0a.21.21,0,0,0,.12,0,.35.35,0,0,0,.27-.09.36.36,0,0,0,.13-.26Z" style="fill: rgb(38, 50, 56); transform-origin: 350.319px 330.554px;" id="eltx6wtquatq" class="animable"></path><g id="el203qgojf17ii"><path d="M248.05,267.79s-.88,19.24-29.14,16a242.11,242.11,0,0,0,19.59-20.66A17.6,17.6,0,0,1,248.05,267.79Z" style="isolation: isolate; opacity: 0.2; transform-origin: 233.48px 273.644px;" class="animable"></path></g><path d="M248.46,265.64c-2.11,2.13-4.38,4.39-6.49,6.65s-4.22,4.55-6.23,6.84a85.12,85.12,0,0,0-5.44,6.93,25.68,25.68,0,0,0-1.84,3.17c-.24.46-.33.8-.4.94a6.34,6.34,0,0,0-.35-1.05s-.08-.11-.06-.09l0,.06.06.13.12.25.37.59.48.65.56.67a26.68,26.68,0,0,0,2.91,2.74,66.6,66.6,0,0,0,7.28,5.13c2.59,1.64,5.31,3.18,8.07,4.69s5.6,3,8.36,4.37l-2.16,6.21a108.19,108.19,0,0,1-19-6.44q-2.31-1.05-4.61-2.28a47.92,47.92,0,0,1-4.56-2.71,38.56,38.56,0,0,1-4.49-3.48l-1.1-1.07-1.08-1.21c-.35-.44-.7-.9-1-1.37l-.49-.78-.25-.4-.12-.2a3.42,3.42,0,0,1-.17-.37,13.25,13.25,0,0,1-.63-1.69A13,13,0,0,1,216,291a7.1,7.1,0,0,1-.05-1.35,11.45,11.45,0,0,1,.09-1.23,17,17,0,0,1,.93-3.7,32.61,32.61,0,0,1,2.62-5.39,74.86,74.86,0,0,1,6.06-8.59c2.12-2.66,4.33-5.18,6.6-7.62s4.56-4.77,7.1-7.11Z" style="fill: rgb(255, 181, 115); transform-origin: 235.899px 285.265px;" id="elnv7r125uo9p" class="animable"></path><path d="M251,248.67c-9.67-2.53-26.29,15.56-26.29,15.56l15.88,12S264.85,252.29,251,248.67Z" style="fill: rgb(38, 50, 56); transform-origin: 239.991px 262.329px;" id="elcjwackzvciu" class="animable"></path><path d="M267.32,309.66l-8.58-1.55h0l-7.68-4-4.67,11.3,5.58-.18a20.12,20.12,0,0,0,5.66,3.23l10.23,5.71,6.92-8.5Z" style="fill: rgb(141, 29, 37); transform-origin: 260.585px 314.14px;" id="el4m57f5iwl7x" class="animable"></path><g id="elq9f9azweu7r"><path d="M267.32,309.66l-8.58-1.55h0l-7.68-4-4.67,11.3,5.58-.18a20.12,20.12,0,0,0,5.66,3.23l10.23,5.71,6.92-8.5Z" style="fill: rgb(255, 255, 255); opacity: 0.6; transform-origin: 260.585px 314.14px;" class="animable"></path></g></g><g id="freepik--Spray--inject-140" class="animable" style="transform-origin: 382.693px 384.02px;"><path d="M392.65,360v13.67h-1.37s-.82-7.48-4.1-10.13S392.65,360,392.65,360Z" style="fill: rgb(141, 29, 37); transform-origin: 389.547px 366.835px;" id="elg8lji8ay8iu" class="animable"></path><g id="elgow63bu5m7v"><path d="M392.65,360v13.67h-1.37s-.82-7.48-4.1-10.13S392.65,360,392.65,360Z" style="opacity: 0.2; transform-origin: 389.547px 366.835px;" class="animable"></path></g><path d="M369,408.41c.65-8.58,5.19-19.92,8.06-26.74a19.87,19.87,0,0,0,1.56-7.72h7.15V374a20,20,0,0,0,1.53,7.66c2.87,6.86,7.42,18.28,8.08,26.72a2.1,2.1,0,0,1-2.09,2.28H371.05A2.11,2.11,0,0,1,369,408.41Z" style="fill: rgb(141, 29, 37); transform-origin: 382.192px 392.305px;" id="elsbh4k1974pc" class="animable"></path><g id="elgwyx3rnb5gp"><path d="M369,408.41c.65-8.58,5.19-19.92,8.06-26.74a19.87,19.87,0,0,0,1.56-7.72h7.15V374a20,20,0,0,0,1.53,7.66c2.87,6.86,7.42,18.28,8.08,26.72a2.1,2.1,0,0,1-2.09,2.28H371.05A2.11,2.11,0,0,1,369,408.41Z" style="fill: rgb(255, 255, 255); opacity: 0.7; transform-origin: 382.192px 392.305px;" class="animable"></path></g><g id="elqnhpiybt16o"><rect x="378.31" y="366.94" width="7.67" height="7.67" style="fill: rgb(141, 29, 37); transform-origin: 382.145px 370.775px; transform: rotate(180deg);" class="animable"></rect></g><path d="M379.6,367.88l-4.47-6.3v-4.2h21.26V360s-10.4,3.08-11.5,7.92H379.6" style="fill: rgb(141, 29, 37); transform-origin: 385.76px 362.65px;" id="elebx1uuzw9xf" class="animable"></path><g id="elj5svd61wll"><rect x="378.31" y="366.94" width="7.67" height="7.67" style="opacity: 0.2; transform-origin: 382.145px 370.775px; transform: rotate(180deg);" class="animable"></rect></g></g><g id="freepik--Vase--inject-140" class="animable" style="transform-origin: 343.58px 391.92px;"><polygon points="376.43 366.43 310.73 366.43 318.4 418.69 368.77 418.69 376.43 366.43" style="fill: rgb(38, 50, 56); transform-origin: 343.58px 392.56px;" id="el8hg78yrho1" class="animable"></polygon><g id="el6eybwt878mm"><polygon points="376.44 366.43 372.3 394.61 372.23 395.11 371.3 401.41 371.16 402.39 370.67 405.75 370.38 407.72 370.07 409.83 369.7 412.33 369.5 413.64 369.14 416.14 368.76 418.69 318.4 418.69 318.02 416.14 317.66 413.64 317.47 412.33 317.1 409.83 316.79 407.72 316.5 405.75 316.01 402.39 315.86 401.41 314.94 395.11 314.86 394.61 310.73 366.43 376.44 366.43" style="fill: rgb(255, 255, 255); opacity: 0.7; transform-origin: 343.585px 392.56px;" class="animable"></polygon></g><rect x="309" y="365.15" width="69.16" height="6.42" style="fill: rgb(38, 50, 56); transform-origin: 343.58px 368.36px;" id="elv9svkun69ch" class="animable"></rect><g id="el2w9tss94w1o"><rect x="309" y="365.15" width="69.16" height="6.42" style="fill: rgb(255, 255, 255); opacity: 0.5; transform-origin: 343.58px 368.36px;" class="animable"></rect></g><g id="el6al46rhzm38"><g style="opacity: 0.2; transform-origin: 343.58px 405.375px;" class="animable"><polygon points="369.5 413.64 369.14 416.14 318.02 416.14 317.66 413.64 369.5 413.64" id="eljryc8323r2r" class="animable" style="transform-origin: 343.58px 414.89px;"></polygon><polygon points="370.07 409.83 369.7 412.33 317.47 412.33 317.1 409.83 370.07 409.83" id="elsdysx4wad1l" class="animable" style="transform-origin: 343.585px 411.08px;"></polygon><polygon points="370.67 405.75 370.38 407.72 316.79 407.72 316.5 405.75 370.67 405.75" id="elxy7yw9ondk8" class="animable" style="transform-origin: 343.585px 406.735px;"></polygon><polygon points="371.3 401.41 371.16 402.39 316.01 402.39 315.86 401.41 371.3 401.41" id="eln3m5invp129" class="animable" style="transform-origin: 343.58px 401.9px;"></polygon><polygon points="372.3 394.61 372.23 395.11 314.94 395.11 314.86 394.61 372.3 394.61" id="elc9yun0d8qea" class="animable" style="transform-origin: 343.58px 394.86px;"></polygon></g></g></g><defs>     <filter id="active" height="200%">         <feMorphology in="SourceAlpha" result="DILATED" operator="dilate" radius="2"></feMorphology>                <feFlood flood-color="#32DFEC" flood-opacity="1" result="PINK"></feFlood>        <feComposite in="PINK" in2="DILATED" operator="in" result="OUTLINE"></feComposite>        <feMerge>            <feMergeNode in="OUTLINE"></feMergeNode>            <feMergeNode in="SourceGraphic"></feMergeNode>        </feMerge>    </filter>    <filter id="hover" height="200%">        <feMorphology in="SourceAlpha" result="DILATED" operator="dilate" radius="2"></feMorphology>                <feFlood flood-color="#ff0000" flood-opacity="0.5" result="PINK"></feFlood>        <feComposite in="PINK" in2="DILATED" operator="in" result="OUTLINE"></feComposite>        <feMerge>            <feMergeNode in="OUTLINE"></feMergeNode>            <feMergeNode in="SourceGraphic"></feMergeNode>        </feMerge>            <feColorMatrix type="matrix" values="0   0   0   0   0                0   1   0   0   0                0   0   0   0   0                0   0   0   1   0 "></feColorMatrix>    </filter></defs></svg>



            </div>
            <div class="thing">
                <section style="font-family:Montserrat; color:white;" class="signup-form">
                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="70" height="70" viewBox="0 0 105.367 105.367">
                        <defs>
                            <linearGradient id="linear-gradient" x1="1.363" y1="-0.243" x2="0.149" y2="0.921" gradientUnits="objectBoundingBox">
                                <stop offset="0" stop-color="#e26565" />
                                <stop offset="1" stop-color="#8d1d25" />
                            </linearGradient>
                        </defs>
                        <path id="Exclusion_11" data-name="Exclusion 11" d="M73.3,105.367H68.718V91.624H73.3v13.743Zm-9.162,0H59.555V91.624h4.582v13.743Zm-9.164,0h-4.58V91.624h4.58v13.743Zm-9.162,0h-4.58V91.624h4.58v13.743Zm-9.162,0h-4.58V91.624h4.58v13.743ZM77.88,87.042H27.487a9.173,9.173,0,0,1-9.162-9.162V27.487a9.173,9.173,0,0,1,9.162-9.162H77.88a9.173,9.173,0,0,1,9.162,9.162V77.88A9.173,9.173,0,0,1,77.88,87.042ZM52.35,76.876a1.414,1.414,0,0,1,.549.116c.644.268.81.76,1.062,1.5.044.131.091.27.144.417h1.924c.051-.143.1-.277.14-.406.253-.75.42-1.245,1.069-1.514a1.427,1.427,0,0,1,.546-.115,3,3,0,0,1,1.27.433c.122.061.251.125.389.19l1.364-1.361c-.065-.138-.128-.264-.189-.387-.352-.709-.584-1.177-.315-1.824s.767-.816,1.52-1.07c.126-.042.259-.087.4-.137V70.8c-.145-.052-.281-.1-.411-.142-.747-.252-1.24-.418-1.507-1.063s-.036-1.119.319-1.832c.059-.119.121-.244.185-.378l-1.364-1.362c-.134.064-.259.127-.378.186a2.994,2.994,0,0,1-1.279.436,1.421,1.421,0,0,1-.551-.117c-.646-.268-.812-.758-1.062-1.5-.044-.131-.091-.27-.144-.418H54.1c-.051.143-.1.278-.14.407-.252.748-.419,1.243-1.066,1.512a1.413,1.413,0,0,1-.55.117,3,3,0,0,1-1.277-.436c-.12-.06-.246-.123-.38-.187l-1.364,1.362c.065.136.127.262.188.384.353.71.586,1.178.318,1.826s-.761.812-1.507,1.063c-.13.044-.268.09-.413.142v1.927c.14.05.273.095.4.137.753.253,1.251.42,1.521,1.066s.036,1.121-.319,1.832c-.06.12-.123.246-.187.379L50.691,77.5c.135-.064.259-.126.38-.186A3.007,3.007,0,0,1,52.35,76.876Zm15.789-7.83a1.885,1.885,0,0,1,.73.154c.863.357,1.085,1.016,1.421,2.015.058.171.119.353.187.544h2.566c.067-.187.126-.364.183-.534.338-1,.56-1.667,1.429-2.028a1.894,1.894,0,0,1,.729-.154,3.983,3.983,0,0,1,1.689.575c.168.084.338.168.523.256l1.816-1.816c-.087-.184-.171-.354-.253-.518-.467-.944-.776-1.567-.419-2.427s1.025-1.089,2.033-1.427c.168-.056.342-.115.526-.18V60.938c-.191-.068-.369-.128-.542-.186-1-.337-1.659-.559-2.017-1.419s-.049-1.486.42-2.431c.08-.162.165-.333.252-.516l-1.816-1.817c-.177.085-.342.167-.5.246a4.024,4.024,0,0,1-1.713.583,1.893,1.893,0,0,1-.731-.154c-.862-.357-1.084-1.017-1.42-2.016-.058-.171-.118-.352-.186-.543H70.476c-.068.191-.128.37-.186.542-.336,1-.558,1.658-1.421,2.017a1.885,1.885,0,0,1-.733.155,3.994,3.994,0,0,1-1.7-.58c-.16-.08-.33-.165-.512-.251l-1.817,1.817c.087.182.17.351.251.514.47.946.78,1.571.422,2.433s-1.018,1.084-2.016,1.419c-.173.058-.352.118-.543.186v2.568c.186.066.36.124.529.181,1.006.337,1.67.56,2.03,1.423s.049,1.491-.422,2.435c-.081.163-.165.331-.251.513l1.817,1.816c.181-.086.347-.169.508-.249A4.018,4.018,0,0,1,68.139,69.047Zm-31.5-7.825a4,4,0,0,1,1.554.329c1.836.76,2.307,2.164,3.021,4.288.123.368.25.746.393,1.149h5.458c.143-.4.27-.778.392-1.142.715-2.126,1.187-3.531,3.034-4.3a3.991,3.991,0,0,1,1.549-.329,8.478,8.478,0,0,1,3.591,1.222c.353.175.715.355,1.108.542L60.6,59.121c-.186-.391-.365-.753-.539-1.1-.994-2-1.651-3.324-.894-5.156s2.166-2.3,4.293-3.016c.366-.123.745-.25,1.148-.394v-5.46c-.407-.145-.788-.273-1.156-.4-2.121-.714-3.521-1.186-4.281-3.015s-.1-3.164.9-5.176c.171-.343.347-.7.53-1.082l-3.858-3.861c-.386.184-.744.361-1.089.533a8.488,8.488,0,0,1-3.613,1.227,4.015,4.015,0,0,1-1.559-.329c-1.833-.76-2.3-2.162-3.018-4.285-.123-.367-.251-.746-.395-1.151h-5.46c-.144.4-.271.783-.394,1.15C40.5,29.73,40.03,31.133,38.2,31.892a4.032,4.032,0,0,1-1.561.331A8.49,8.49,0,0,1,33.033,31c-.349-.174-.709-.352-1.1-.537l-3.855,3.861c.185.389.363.748.535,1.095,1,2.006,1.655,3.331.9,5.163s-2.163,2.3-4.284,3.016c-.368.124-.749.252-1.155.4V49.45c.406.145.787.273,1.156.4,2.121.714,3.522,1.186,4.28,3.015s.1,3.163-.893,5.164c-.173.348-.352.707-.536,1.094l3.857,3.861c.391-.185.752-.364,1.1-.538A8.483,8.483,0,0,1,36.639,61.222Zm18.429,12.92a2.384,2.384,0,1,1,2.385-2.383A2.387,2.387,0,0,1,55.068,74.142Zm50.3-.843H91.624V68.718h13.743V73.3Zm-91.623,0H0V68.718H13.744V73.3Zm58.015-7.9a3.178,3.178,0,1,1,3.178-3.178A3.182,3.182,0,0,1,71.759,65.4Zm33.608-1.262H91.624V59.555h13.743v4.582Zm-91.623,0H0V59.555H13.744v4.582Zm91.623-9.164H91.624v-4.58h13.743v4.58Zm-91.623,0H0v-4.58H13.744v4.58ZM44.338,53.48a6.757,6.757,0,1,1,6.756-6.757A6.763,6.763,0,0,1,44.338,53.48Zm61.029-7.668H91.624v-4.58h13.743v4.58Zm-91.623,0H0v-4.58H13.744v4.58Zm91.623-9.162H91.624v-4.58h13.743v4.58Zm-91.623,0H0v-4.58H13.744v4.58ZM73.3,13.744H68.718V0H73.3V13.744Zm-9.162,0H59.555V0h4.582V13.744Zm-9.164,0h-4.58V0h4.58V13.744Zm-9.162,0h-4.58V0h4.58V13.744Zm-9.162,0h-4.58V0h4.58V13.744Z" fill="url(#linear-gradient)" />
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
                        <br><br>
                        <div class="g-recaptcha" data-sitekey="6LceTzMdAAAAAMmsVPxewTs4O4ujsgATF5_otzYu"></div>
                        <br><button type="submit" class="loginbtn" name="submit">Sign Up</button>
                        <input type='hidden' name='csrf' value='<?php echo $csrf ?>'>

                    </form>

                    <?php #are you sure you want to use get..?

                    if (isset($_GET["error"])) {
                        if ($_GET["error"] == "emptyinput") {
                            echo "<p>Fill in all fields!</p>";
                        } else if ($_GET["error"] == "invaliduid") {
                            echo "<p>Choose a proper username!</p>";
                        } else if ($_GET["error"] == "invalidemail") {
                            echo "<p>Choose a proper email!</p>";
                        } else if ($_GET["error"] == "passwordsdontmatch") {
                            echo "<p>Password dont match!</p>";
                        } else if ($_GET["error"] == "stmtfailed") {
                            echo "<p>Something went wrong, try again!</p>";
                        } else if ($_GET["error"] == "usernametaken") {
                            echo "<p>Username already taken!</p>";
                        } else if ($_GET["error"] == "emptycaptcha") {
                            echo "<p>reCAPTHCA verification empty, please click the captcha.</p>";
                        } else if ($_GET["error"] == "badcaptcha") {
                            echo "<p>reCAPTHCA verification failed, please try again.</p>";
                        } else if ($_GET["error"] == "goodcaptcha") {
                            echo "<p>reCAPTHCA verification failed, please try again.</p>";
                        } else if ($_GET["error"] == "none") {
                            echo "<p>You have signed up!</p>";
                            header("location: ../swapproj/googleauth/");
                        } elseif ($_GET['error']==="weakpass") {
                            echo ("Password should contain 1 capital letter, 1 lower case letter, 1 number, and 1 special character and be at least 8 characters long.");
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