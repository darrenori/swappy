<?php


require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';



$userid = $jwtarrayinformation['userid'];
if($jwtarrayinformation['role']<1){
    header("location: https://www.swapamc.com/swapproj/campus");
    error_log("TPAMC:ATTENDANCE(editattendance):0:$ip:Error(unauthorized)", 0);
    exit;
}
?>
<html>
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
<meta name="viewport" content="width=device-width, initial-scale=1">


<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">
<link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:wght@500&display=swap" rel="stylesheet">
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
<meta name="viewport" content="width=device-width, initial-scale=1">



<head>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <style>
        * {
            margin: 0;
            padding: 0;
            font-family: sans-serif;
        }

        body {

            overflow: hidden;
            font-family: 'Montserrat', sans-serif;
            background-color: #272727;



        }

        html,
        body {
            /* max-width: 100vw; */
            /* width: 100vw; */

            overflow-x: hidden;
        }

        /* nav bar */


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

        @media(max-width:900px) {
            .whitecontainer h2 {
                flex-basis: 100%;
                justify-self: center;
                align-items: center;
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

            #tasks {
                width: 100px;
            }







        }

        .whitecontainer {
            background-color: white;
            display: flex;
            flex-wrap: wrap;

            justify-content: center;
            flex-direction: row;
            width: 30vw;


            margin: auto;







            border-radius: 10px;

            /* margin-bottom: 100px; */

        }

        .wrapper {

            display: flex;
            flex-wrap: wrap;

            flex-direction: row;
            justify-content: space-between;
            align-items: center;


        }

        #tasks {
            width: 10vw;
        }

        .wrapper h2 {
            font-family: 'Montserrat', sans-serif;
            font-size: 2em;

        }



        .taskcontainer {
            width: 80%;

            margin: 20px 7vw;




        }

        .boxcontainer {
            display: flex;
            flex-wrap: wrap;
            flex-direction: flex-start;
        }


        .taskcontainer h3 {
            font-family: 'Montserrat', sans-serif;
            font-size: 1.5em;
            color: white;

        }

        .row {
            width: 100%;
            display: flex;
            flex-wrap: wrap;
            flex-direction: row;
            justify-content: space-between;
            align-items: flex-start;

        }

        .left {
            margin: 50px 0;
            flex-basis: 60%;
            background-color: rgba(255, 255, 255, 0.75);
            padding: 20px 20px;
            border-radius: 8px;
            border-left: 4px solid #8D1D25;

        }

        .right {
            margin: 50px 0;
            flex-basis: 30%;
        }

        .right {
            color: white;

            font-family: 'Montserrat', sans-serif;

            font-size: 1.2em;
            font-weight: 600;

        }


        .title {
            color: black;
            font-family: 'Montserrat', sans-serif;
            font-weight: 700;
            font-size: 2em;
            padding: 5px 0;
        }

        .description {
            color: #8D1D25;
            font-family: 'Montserrat', sans-serif;
            font-weight: 800;
            font-size: 0.9em;
        }

        .assignedby {
            color: white;
            font-family: 'Montserrat', sans-serif;
            font-weight: 400;
            font-size: 0.7em;


        }

        .upper {}

        .timings {

            display: flex;
            flex-wrap: wrap;
            flex-direction: row;
            justify-content: space-between;
            align-items: center;
            font-family: 'Montserrat', sans-serif;


        }

        .start {
            margin: 10px 0;
            flex-basis: 30%;
            font-size: 0.7em;
            font-family: 400;
        }

        .end {
            margin: 10px 0;
            flex-basis: 30%;
            font-size: 0.7em;
            font-family: 400;

        }

        #arrow {

            /* margin: 10px 0; */
            flex-basis: 30%;
            text-align: center;
        }


        .progress {
            padding: 10px;

        }


        select {
            margin-bottom: 1em;
            padding: 20px 50px;
            padding-right: 50px;
            background: none;
            border: 0;
            border-bottom: 2px solid white;
            font-weight: bold;
            letter-spacing: .15em;
            border-radius: 0;
            color: white;

        }

        select option {
            color: black;
        }
    </style>




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
                <a href="https://www.swapamc.com/swapproj/faq/">
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



    <div class="whitecontainer">

        <div class='wrapper'>
            <h2>Past Purchases</h2>
            <svg id="tasks" xmlns="http://www.w3.org/2000/svg" width="290.028" height="217.715" viewBox="0 0 290.028 217.715">
                <path id="Path_649" data-name="Path 649" d="M854.09,627.842l.435-9.789a31.616,31.616,0,0,1,14.747-3.733c-7.083,5.791-6.2,16.953-11,24.74a19.017,19.017,0,0,1-13.945,8.788l-5.927,3.629a31.866,31.866,0,0,1,6.717-25.823,30.778,30.778,0,0,1,5.657-5.256C852.194,624.14,854.09,627.842,854.09,627.842Z" transform="translate(-589.078 -433.762)" fill="#f2f2f2" />
                <path id="Path_650" data-name="Path 650" d="M403.738,422.889a3.627,3.627,0,0,1,.237-5.556L399.914,405.1l6.468,1.738,2.864,11.349a3.646,3.646,0,0,1-5.508,4.7Z" transform="translate(-342.207 -315.836)" fill="#a0616a" />
                <path id="Path_651" data-name="Path 651" d="M410.826,292.853c1.073.615,7.423-.909,8.663-.476-.685,4.177,3.033,2.609-1,8.094s-12.169,21.93-14.016,28.076-.019,14.808-.3,17.721a30.233,30.233,0,0,0,.025,5.07c-2.181-.028-4.331.425-6.547.136-2.363-6.685-3.951-16.2-5.03-21.46s-1.118-3.035-.623-5.665.615-.719.095-3.234,1.582-5.677,3.524-7.479c.837-2.408,1.919-4.654,2.748-7.037C404.44,301.3,404.84,298.24,410.826,292.853Z" transform="translate(-337.574 -252.254)" fill="#c11427" />
                <path id="Path_652" data-name="Path 652" d="M562.11,456.661h-5.367l-2.553-20.7h7.921Z" transform="translate(-312.37 -245.73)" fill="#ffb6b6" />
                <path id="Path_653" data-name="Path 653" d="M820.789,683.768h-17.3v-.219a6.736,6.736,0,0,1,6.735-6.735h0l3.161-2.4,5.9,2.4h1.511Z" transform="translate(-569.68 -467.634)" fill="#2f2e41" />
                <path id="Path_654" data-name="Path 654" d="M504.97,456.661H499.6l-2.553-20.7h7.921Z" transform="translate(-280.163 -245.73)" fill="#ffb6b6" />
                <path id="Path_655" data-name="Path 655" d="M763.649,683.768h-17.3v-.219a6.736,6.736,0,0,1,6.735-6.735h0l3.161-2.4,5.9,2.4h1.511Z" transform="translate(-537.473 -467.634)" fill="#2f2e41" />
                <path id="Path_656" data-name="Path 656" d="M766.293,424.569l34.908.873c6.63,3.6,6.73,11.395,4.558,20.648,0,0,.733,5.5-.733,6.967s-2.2,1.467-1.467,4.033-3.141,6.759-2.671,7.229a18.973,18.973,0,0,1,1.571,3.037l-3.667,20.9s-2.567,36.3-3.3,37.033-1.467,0-.733,1.833,1.467,1.1.733,1.833a26.988,26.988,0,0,0-1.833,2.2h-8.865s-.668-3.667-.668-4.033-.733-2.567-.733-2.933.648-1.015.648-1.015a12.062,12.062,0,0,0,.452-2.285c0-.733,2.2-28.966,2.2-28.966l-4.4-36.666L771.659,491.19s0,31.533-.733,32.266-.733.367-.367,1.833,1.833,1.1.733,2.2-1.467-.733-1.1,1.1l.367,1.833-11,.157s-1.467-3.091-.733-4.191.689-.8-.205-2.6-1.261-2.167-.895-2.533.367-2.317.367-2.317l1.833-35.083s.367-37.033.367-38.133a3.656,3.656,0,0,0-.3-1.65v-1.493l1.4-5.291Z" transform="translate(-543.809 -326.808)" fill="#2f2e41" />
                <circle id="Ellipse_29" data-name="Ellipse 29" cx="10.846" cy="10.846" r="10.846" transform="translate(232.608 3.483)" fill="#ffb6b6" />
                <path id="Path_657" data-name="Path 657" d="M789.217,267.841c-2.337,1.389-3.734,3.941-4.537,6.539a61.963,61.963,0,0,0-2.663,14.8l-.848,15.043-10.5,32.031c9.1,7.7,43.29,1.749,43.29,1.749s1.05-.35,0-1.4-2.071-.12-1.022-1.169.326.12-.024-.93,0-.35.35-.7-2.709-3.5-2.709-3.5l2.8-18.386,3.5-37.087c-4.2-5.248-12.642-8.342-12.642-8.342l-2.182-3.927-10.909.873Z" transform="translate(-551.186 -235.497)" fill="#3f3d56" />
                <path id="Path_658" data-name="Path 658" d="M804.705,208.491a5.124,5.124,0,0,1,1.244.163,17.7,17.7,0,0,0,2.434.408,11.28,11.28,0,0,1,10.1,9.568c.63-.549,2.064-1.56,3.24-.621h0c.018.015.028.023.07,0,.781-.37,2.166-4.929,2.208-8.942.022-2.13-.313-4.85-2.036-5.712l-.091-.045-.024-.1c-.115-.479-1.4-1.3-3.636-1.934-4.062-1.157-10-1.324-13.406,1.993-.258,1.118-1.217,1.425-2.065,1.7-.939.3-1.75.559-1.878,1.711a35.3,35.3,0,0,0,.023,4.922,5.026,5.026,0,0,1,1.786-2.508,3.539,3.539,0,0,1,2.03-.6Z" transform="translate(-568.162 -200.527)" fill="#2f2e41" />
                <path id="Path_659" data-name="Path 659" d="M716.5,326.141l17.717-11.347-8.924-11.862-8.811,10.839-27.455,1.684a5.232,5.232,0,1,0-.293,7.711Z" transform="translate(-500.143 -258.248)" fill="#ffb6b6" />
                <path id="Path_660" data-name="Path 660" d="M796.277,283.372c1.028,6.223-18.39,18.106-18.39,18.106,0-1.461-11.59,9.566-12.113,8.355-1.487-3.443-2.532-11.6-4.61-12.9-1.188-.746,7.156-7.759,7.156-7.759s4.368-4.4,10.1-9.95A13.372,13.372,0,0,1,790.8,275.6S795.249,277.148,796.277,283.372Z" transform="translate(-545.76 -242.662)" fill="#3f3d56" />
                <path id="Path_661" data-name="Path 661" d="M643.219,380.913a59.242,59.242,0,0,1-3.3,19.562c-.1.292-.205.58-.31.873a59.554,59.554,0,0,1-23.759,29.567c-.746.48-1.5.938-2.269,1.383a59,59,0,0,1-28.712,7.95c-.332,0-.663.009-.995.009-.428,0-.851,0-1.274-.013a59.065,59.065,0,0,1-28.712-8.107q-1.152-.674-2.269-1.4a59.4,59.4,0,0,1-21.193-75.641c.14-.292.284-.58.432-.873a59.367,59.367,0,0,1,106.033,0c.148.292.292.58.432.873A59.089,59.089,0,0,1,643.219,380.913Z" transform="translate(-412.444 -268.753)" fill="#f2f2f2" />
                <path id="Path_662" data-name="Path 662" d="M630.892,502.4v.873h5.315V502.4Zm-10.63,0v.873h5.315V502.4Zm-10.629,0v.873h5.315V502.4ZM599,502.4v.873h5.315V502.4Zm-10.629,0v.873h5.315V502.4Zm-10.629,0v.873h5.315V502.4Zm-10.63,0v.873h5.315V502.4Zm-10.625,0v.873h5.31V502.4Zm-10.629,0v.873h5.315V502.4Zm-10.629,0v.873h5.315V502.4Zm110.724,0h-4.433v.873h4.124Z" transform="translate(-418.479 -370.677)" fill="#e6e6e6" />
                <path id="Path_663" data-name="Path 663" d="M641.521,488.4v.873h5.315V488.4Zm-10.629,0v.873h5.315V488.4Zm-10.63,0v.873h5.315V488.4Zm-10.629,0v.873h5.315V488.4ZM599,488.4v.873h5.315V488.4Zm-10.629,0v.873h5.315V488.4Zm-10.629,0v.873h5.315V488.4Zm-10.63,0v.873h5.315V488.4Zm-10.625,0v.873h5.31V488.4Zm-10.629,0v.873h5.315V488.4Zm-10.629,0v.873h5.315V488.4Z" transform="translate(-418.479 -362.786)" fill="#e6e6e6" />
                <path id="Path_664" data-name="Path 664" d="M641.521,459.4v.873h5.315V459.4Zm-10.629,0v.873h5.315V459.4Zm-10.63,0v.873h5.315V459.4Zm-10.629,0v.873h5.315V459.4ZM599,459.4v.873h5.315V459.4Zm-10.629,0v.873h5.315V459.4Zm-10.629,0v.873h5.315V459.4Zm-10.63,0v.873h5.315V459.4Zm-10.625,0v.873h5.31V459.4Zm-10.629,0v.873h5.315V459.4Zm-10.629,0v.873h5.315V459.4Z" transform="translate(-418.479 -346.44)" fill="#e6e6e6" />
                <path id="Path_665" data-name="Path 665" d="M641.521,439.4v.873h5.315V439.4Zm-10.629,0v.873h5.315V439.4Zm-10.63,0v.873h5.315V439.4Zm-10.629,0v.873h5.315V439.4ZM599,439.4v.873h5.315V439.4Zm-10.629,0v.873h5.315V439.4Zm-10.629,0v.873h5.315V439.4Zm-10.63,0v.873h5.315V439.4Zm-10.625,0v.873h5.31V439.4Zm-10.629,0v.873h5.315V439.4Zm-10.629,0v.873h5.315V439.4Z" transform="translate(-418.479 -335.167)" fill="#e6e6e6" />
                <path id="Path_666" data-name="Path 666" d="M644.516,396.4h-1.405v.873h1.837C644.808,396.979,644.664,396.691,644.516,396.4Zm-12.035,0v.873H637.8V396.4Zm-10.629,0v.873h5.315V396.4Zm-10.629,0v.873h5.315V396.4Zm-10.63,0v.873h5.315V396.4Zm-10.629,0v.873h5.315V396.4Zm-10.63,0v.873h5.315V396.4Zm-10.629,0v.873h5.315V396.4Zm-10.625,0v.873h5.31V396.4Zm-10.63,0v.873h5.315V396.4Zm-8.967,0c-.148.292-.292.58-.432.873h4.084V396.4Z" transform="translate(-420.068 -310.93)" fill="#e6e6e6" />
                <path id="Path_667" data-name="Path 667" d="M730.89,403.139v73.752c-.746.48-1.5.938-2.269,1.383V403.139Z" transform="translate(-527.483 -314.729)" fill="#3f3d56" />
                <path id="Path_668" data-name="Path 668" d="M659.89,459.139v58.65c-.332,0-.663.009-.995.009-.428,0-.851,0-1.274-.013V459.139Z" transform="translate(-487.464 -346.294)" fill="#3f3d56" />
                <path id="Path_669" data-name="Path 669" d="M588.89,403.139v74.974q-1.152-.674-2.269-1.4V403.139Z" transform="translate(-447.445 -314.729)" fill="#3f3d56" />
                <path id="Path_670" data-name="Path 670" d="M312.284,612.329l-.866-12.038a38.942,38.942,0,0,0-18.283-4.1c8.915,6.891,8.2,20.664,14.376,30.091a23.423,23.423,0,0,0,17.466,10.351l7.42,4.269a39.25,39.25,0,0,0-9.139-31.568,37.915,37.915,0,0,0-7.142-6.281C314.495,607.708,312.284,612.329,312.284,612.329Z" transform="translate(-282.022 -423.538)" fill="#f2f2f2" />
                <circle id="Ellipse_30" data-name="Ellipse 30" cx="8.291" cy="8.291" r="8.291" transform="translate(193.685 77.689)" fill="#c11427" />
                <path id="Path_671" data-name="Path 671" d="M730.161,389.412a.671.671,0,0,0-.926,0,27.462,27.462,0,0,0-4.7,4.805l-1.005-1.946c-.387-.749-1.517-.087-1.13.661l1.471,2.846a.662.662,0,0,0,1.13,0,26.509,26.509,0,0,1,5.165-5.441A.658.658,0,0,0,730.161,389.412Z" transform="translate(-523.929 -306.887)" fill="#fff" />
                <circle id="Ellipse_31" data-name="Ellipse 31" cx="8.291" cy="8.291" r="8.291" transform="translate(163.141 102.124)" fill="#c11427" />
                <path id="Path_672" data-name="Path 672" d="M660.161,445.412a.671.671,0,0,0-.926,0,27.46,27.46,0,0,0-4.7,4.805l-1.006-1.946c-.387-.749-1.517-.087-1.13.661l1.471,2.846a.662.662,0,0,0,1.13,0,26.51,26.51,0,0,1,5.165-5.441A.658.658,0,0,0,660.161,445.412Z" transform="translate(-484.473 -338.452)" fill="#fff" />
                <circle id="Ellipse_32" data-name="Ellipse 32" cx="8.291" cy="8.291" r="8.291" transform="translate(132.16 79.434)" fill="#c11427" />
                <path id="Path_673" data-name="Path 673" d="M589.161,393.412a.671.671,0,0,0-.926,0,27.462,27.462,0,0,0-4.7,4.805l-1.006-1.946c-.387-.749-1.517-.087-1.13.661l1.471,2.846a.662.662,0,0,0,1.13,0,26.509,26.509,0,0,1,5.165-5.441.658.658,0,0,0,0-.926Z" transform="translate(-444.454 -309.142)" fill="#fff" />
                <path id="Path_674" data-name="Path 674" d="M819.453,358.245l5.458-20.319-14.585-2.761.784,13.947-19.163,19.732a5.232,5.232,0,1,0,4.976,5.9Z" transform="translate(-560.107 -276.416)" fill="#ffb6b6" />
                <path id="Path_675" data-name="Path 675" d="M855.436,286.059c4.951,3.908-1.4,25.77-1.4,25.77-.984-1.08-2.127,14.877-3.329,14.334-3.418-1.544-9.682-6.869-12.1-6.435-1.381.248.066-10.555.066-10.555s.266-6.194.766-14.157A13.372,13.372,0,0,1,846.157,284S850.485,282.15,855.436,286.059Z" transform="translate(-589.14 -247.33)" fill="#3f3d56" />
                <path id="Path_676" data-name="Path 676" d="M176.492,190.831l6,26.777-38.45-2.392,10.456-26.3Z" transform="translate(-81.189 -106.484)" fill="#a0616a" />
                <path id="Path_677" data-name="Path 677" d="M203.735,455.009h4.319l2.055-16.659h-6.375Z" transform="translate(-114.835 -247.076)" fill="#a0616a" />
                <path id="Path_678" data-name="Path 678" d="M466.937,671.647l6.828-.408v2.925l6.491,4.483a1.827,1.827,0,0,1-1.038,3.331h-8.129l-1.4-2.894-.547,2.894h-3.065Z" transform="translate(-379.499 -465.844)" fill="#2f2e41" />
                <path id="Path_679" data-name="Path 679" d="M110.182,450.573l4.221.915,5.54-15.845-6.23-1.351Z" transform="translate(-62.104 -244.789)" fill="#a0616a" />
                <path id="Path_680" data-name="Path 680" d="M371.691,666.648l6.759,1.049-.62,2.859,5.393,5.757a1.827,1.827,0,0,1-1.721,3.035l-7.944-1.723L372.8,674.5l-1.148,2.712-3-.65Z" transform="translate(-324.59 -463.256)" fill="#2f2e41" />
                <path id="Path_681" data-name="Path 681" d="M431.157,462.276c-3.031,16.659-3.789,23.852-3.789,23.852s2.273,2.65.758,4.166,0,4.543,0,4.543l-3.408,36.726-2.743-.445-6.609-1.063-2.383-.385,1.516-34.453s-1.516-3.031-.758-3.789-.758-5.3-.758-5.3L411.09,450.16l-11.74,39.376s1.139,1.516,0,2.65-3.4,6.816-3.4,6.816l-6.981,24.428-.593,2.074-3.641-.682-3.963-.745-.728-.135-1.3-.245-.834-.157-.284-.051-1.372-.258.415-1.842.216-.969,5.906-26.231.135-.605.144-.639s-.758-1.892.377-3.031a2.958,2.958,0,0,0,.758-2.65,1.032,1.032,0,0,1-.1-.127,1.571,1.571,0,0,1-.271-.618,2.049,2.049,0,0,1,.754-1.905,3.231,3.231,0,0,0,.538-.771c1.152-2.18,1.732-6.8,1.732-6.8s1.025-36.582,4.377-42.17c.178-.292,3.737-5.9,3.924-6.014,3.785-2.269,33.272.865,33.272.865s1.786,4.8,1.866,5.3C430.733,437.828,433.727,448.145,431.157,462.276Z" transform="translate(-328.873 -328.761)" fill="#2f2e41" />
                <path id="Path_682" data-name="Path 682" d="M446.919,291.6s.638-3.312-5.493-9.443c-3.246-1.082-8.87-.451-10.819,0-9.016,11.9-7.4,9.8-9.749,16.451a9.365,9.365,0,0,0-.642,4.733c1.082,5.41,2.838,33.179,2.478,34.621s-2.885,3.246-.361,3.246,35.08-.57,34.359-1.652S446.919,291.6,446.919,291.6Z" transform="translate(-353.594 -246.201)" fill="#c11427" />
                <path id="Path_683" data-name="Path 683" d="M547.38,393.123a3.627,3.627,0,0,1-4.869-2.687l-12.759-1.813,4.436-5.017,11.437,2.49a3.646,3.646,0,0,1,1.755,7.026Z" transform="translate(-415.391 -303.72)" fill="#a0616a" />
                <path id="Path_684" data-name="Path 684" d="M446.438,297.2a18.688,18.688,0,0,0,3.138-1.926c3.434,2.473,3.687-1.554,6.8,4.5s14.214,20.663,18.895,25.054,13.25,6.613,15.734,8.158a30.232,30.232,0,0,0,4.551,2.236c-1,1.941-1.549,4.067-2.794,5.922-7.038-.862-16.265-3.678-21.454-5.055s-3.215-.351-5.349-1.965-.37-.87-2.854-1.526-4.378-3.945-5.126-6.486c-1.783-1.822-3.312-3.791-5.076-5.595C450.863,312.717,448.594,304.955,446.438,297.2Z" transform="translate(-368.431 -253.928)" fill="#c11427" />
                <circle id="Ellipse_33" data-name="Ellipse 33" cx="10.443" cy="10.443" r="10.443" transform="translate(75.621 10.454)" fill="#a0616a" />
                <path id="Path_685" data-name="Path 685" d="M449.055,245.484c-.5-.707-4.2-7.716-5.3-10.367a12.123,12.123,0,0,0-.214,1.74l-.011.218-.216.028c-.325.042-8.006.974-12-3.559-2.368-2.685-2.905-6.712-1.6-11.972a2.085,2.085,0,0,1-.673-.259,2.89,2.89,0,0,1-1.232-2.1l-.221.059c-7.111-3.46-.985-13.583,5.511-8.55a3.139,3.139,0,0,1,1.715.1,3.182,3.182,0,0,1,1.964,2.6c3.356-1.765,7.8-1.478,10.095-.154a2.874,2.874,0,0,1,1.612,2.032,6.438,6.438,0,0,1,5.632,6.539v.261h-.261a6.019,6.019,0,0,0-5.244,3.3,7.671,7.671,0,0,0,.236,7.827,11.036,11.036,0,0,1,1.523,8.438l-.98,4.294Z" transform="translate(-356.013 -205.498)" fill="#2f2e41" />
                <path id="Path_686" data-name="Path 686" d="M391.008,695.377a.518.518,0,0,1-.519.519h-122.3a.519.519,0,1,1,0-1.039h122.3a.518.518,0,0,1,.519.519Z" transform="translate(-267.665 -479.157)" fill="#ccc" />
                <path id="Path_687" data-name="Path 687" d="M773.008,695.377a.518.518,0,0,1-.519.519h-122.3a.519.519,0,0,1,0-1.039h122.3a.518.518,0,0,1,.519.519Z" transform="translate(-482.98 -479.157)" fill="#ccc" />
                <circle id="Ellipse_34" data-name="Ellipse 34" cx="4.621" cy="4.621" r="4.621" transform="translate(135.572 169.556)" fill="#e6e6e6" />
                <circle id="Ellipse_35" data-name="Ellipse 35" cx="4.621" cy="4.621" r="4.621" transform="translate(166.553 174.356)" fill="#e6e6e6" />
                <circle id="Ellipse_36" data-name="Ellipse 36" cx="4.621" cy="4.621" r="4.621" transform="translate(197.533 168.683)" fill="#e6e6e6" />
            </svg>


        </div>

    </div>
















    <?php

    //check if authorised to edit
    if ($role == 6 || $role == 5 || $role == 4 || $role == 3) {
    ?>



        <div class='taskcontainer'>

            <h3>Past Purchases</h3>

            <div class='boxcontainer'>



                <?php

                //select purchased and credit card information
                try {
                    $query = $conn->prepare("SELECT user_shipping,purchase_id,purchase_time,purchase_cost,cart_bundled,purchase_status,
                mydb.user_creditcardinfo.user_creditcardinfo_nameoncard, mydb.user_creditcardinfo.user_creditcardinfo_cardtype,mydb.user_creditcardinfo.user_creditcardinfo_cardnumb, mydb.user_creditcardinfo.user_creditcardinfo_encryptkey,mydb.user_creditcardinfo.user_creditcardinfo_iv
                FROM mydb.user_past_purchases 
                INNER JOIN mydb.user_creditcardinfo
                ON mydb.user_creditcardinfo.user_creditcardinfo_id = mydb.user_past_purchases.user_creditcards
                WHERE  purchase_status != '2'
                ORDER BY purchase_time DESC");


                    if ($query === false) {
                        //change filename accordingly
                        throw new Exception("Statement Preparation failed(viewpastpurchases)");
                    }
                } catch (Exception $e) {
                    echo 'Message: ' . $e->getMessage();
                    header("location: https://www.swapamc.com/swapproj/campus?error=statement");
                    exit;
                }

                // throws error "Statment Execution failed" when statement fails
                try {
                    $execute = $query->execute();
                    if ($execute === false) {
                        throw new Exception("Statement Execution failed (viewpastpurchases)");
                    }
                } catch (Exception $e) {
                    echo 'Message: ' . $e->getMessage();
                    header("location: https://www.swapamc.com/swapproj/campus?error=statement");
                    exit;
                }




                $result = $query->get_result();
                $array = $result->fetch_all(MYSQLI_ASSOC);

                $query->close();











                for ($i = 0; $i < sizeOf($array); $i++) {

                    $time = $array[$i]['purchase_time'];
                    $totalcosts = $array[$i]['purchase_cost'];
                    $bundled = $array[$i]['cart_bundled'];
                    $pid = $array[$i]['purchase_id'];
                    $timepurchased = $array[$i]['purchase_time'];
                    $pstatus = $array[$i]['purchase_status'];


                    $pcardname = $array[$i]['user_creditcardinfo_nameoncard'];
                    $pcardtype = $array[$i]['user_creditcardinfo_cardtype'];
                    $pcardnum = $array[$i]['user_creditcardinfo_cardnumb'];
                    $hexkey = $array[$i]['user_creditcardinfo_encryptkey'];
                    $hexiv = $array[$i]['user_creditcardinfo_iv'];



                    //decrypt card number
                    $cipher = "aes-192-cbc";
                    $encryption_key = hex2bin($hexkey);
                    $iv = hex2bin($hexiv);
                    $cardnumber = openssl_decrypt($pcardnum, "aes-192-cbc", $encryption_key, 0, $iv);

                    //get shipping id
                    $usershipping = $array[$i]['user_shipping'];





                    //select shipping information
                    try {
                        $query = $conn->prepare("SELECT user_shipping_address,user_shipping_postalcode,user_shipping_unitnumber FROM mydb.user_shippinginformation WHERE user_shipping_id = $usershipping;");
                        if ($query === false) {
                            //change filename accordingly
                            throw new Exception("Statement Preparation failed(viewpastpurchases)");
                        }
                    } catch (Exception $e) {
                        echo 'Message: ' . $e->getMessage();
                        header("location: https://www.swapamc.com/swapproj/campus?error=statement");
                        exit;
                    }

                    // throws error "Statment Execution failed" when statement fails
                    try {
                        $execute = $query->execute();
                        if ($execute === false) {
                            throw new Exception("Statement Execution failed (viewpastpurchases)");
                        }
                    } catch (Exception $e) {
                        echo 'Message: ' . $e->getMessage();
                        header("location: https://www.swapamc.com/swapproj/campus?error=statement");
                        exit;
                    }

                    $query->bind_result($shippingaddress, $postalcode, $unitnumber);

                    $query->fetch();

                    $fulladdress = $shippingaddress . " " . $postalcode . " " . $unitnumber;

                    $query->close();



                    //display Purchased ID and Time


                    echo "<div class='row'>";
                    echo "<div class='left'>";

                    echo "<div class='upper'>";

                    echo "<div class='lefttext'>";

                    echo "<p class='description'>Purchase: #$pid ($timepurchased)</p>";
                    echo "<br>";







                    //select products info
                    try {
                        $query = $conn->prepare("SELECT cart_id,product_name,product_price,product_picone,quantity,price 
                        FROM mydb.user_cart 
                        INNER JOIN mydb.products
                        ON mydb.user_cart.product_id = mydb.products.product_id
                        WHERE bundled = '$bundled' ");
                        if ($query === false) {
                            //change filename accordingly
                            throw new Exception("Statement Preparation failed(viewpastpurchases)");
                        }
                    } catch (Exception $e) {
                        echo 'Message: ' . $e->getMessage();
                        header("location: https://www.swapamc.com/swapproj/campus?error=statement");
                        exit;
                    }

                    // throws error "Statment Execution failed" when statement fails
                    try {
                        $execute = $query->execute();
                        if ($execute === false) {
                            throw new Exception("Statement Execution failed (viewpastpurchases)");
                        }
                    } catch (Exception $e) {
                        echo 'Message: ' . $e->getMessage();
                        header("location: https://www.swapamc.com/swapproj/campus?error=statement");
                    }

                    $result = $query->get_result();
                    $arrayone = $result->fetch_all(MYSQLI_ASSOC);

                    $query->close();





                    for ($j = 0; $j < sizeOf($arrayone); $j++) {
                        $cartid = $arrayone[$j]['cart_id'];
                        $productname = $arrayone[$j]['product_name'];
                        $productprice = $arrayone[$j]['product_price'];
                        $productpicone = $arrayone[$j]['product_picone'];
                        $productquantity = $arrayone[$j]['quantity'];
                        $totalproductprice = $arrayone[$j]['price'];

                        $j = 0;
                        echo "<p class='description'>Product " . $j + 1 . ": </p>";
                        echo "<p>$productquantity x $productname" . "($productprice)" . "</p>";








                        //select types
                        try {
                            $query = $conn->prepare("SELECT cart_typevariants_type,cart_typevariants_variant,cart_additionalcosts FROM mydb.cart_typevariants 
                        INNER JOIN mydb.user_cart
                        ON mydb.cart_typevariants.cart_id = mydb.user_cart.cart_id
                        WHERE bundled = '$bundled';");

                            if ($query === false) {
                                //change filename accordingly
                                throw new Exception("Statement Preparation failed(viewpastpurchases)");
                            }
                        } catch (Exception $e) {
                            echo 'Message: ' . $e->getMessage();
                            header("location: https://www.swapamc.com/swapproj/campus?error=statement");
                            exit;
                        }

                        // throws error "Statment Execution failed" when statement fails
                        try {
                            $execute = $query->execute();
                            if ($execute === false) {
                                throw new Exception("Statement Execution failed (viewpastpurchases)");
                            }
                        } catch (Exception $e) {
                            echo 'Message: ' . $e->getMessage();
                            header("location: https://www.swapamc.com/swapproj/campus?error=statement");
                        }

                        $query->bind_result($type, $variant, $additionalcosts);





                        while ($query->fetch()) {

                            echo "<p>$type: $variant</p>";
                            echo "<p>Additional Costs:$$additionalcosts</p>";
                            // echo "<br>";
                        }
                        echo "<br>";


                        unset($type);







                        $query->close();
                    }


                    // print address , credit card and total costs
                    echo "<p class='description'>Shipped To:</p>";
                    echo "<p> $fulladdress</p";
                    echo "<br><br>";
                    echo "<p class='description'>Credit Card:</p>";
                    echo "<p>Name: $pcardname</p>";
                    echo "<p>Type: $pcardtype</p>";
                    echo "<p>Number: **** **** **** $cardnumber</p>";
                    echo "<br>";
                    echo "<p class='description'>Total Costs: $$totalcosts</p>";
                    echo "<br>";
                    echo "</div>";
                    echo "</div>";
                    echo "</div>";





                    // show the optinn to cnange status
                    echo "<div class='right'>";
                    echo "<p>Progress:</p>";

                    echo "<select name='status' class='custom-select' id='$pid' onchange='updateStatus($pid,$userid)'>";

                    if ($pstatus == '0') {
                        echo "<option value='0'selected>Waiting</option>";
                        echo "<option value='1'>In Progress</option>";
                        echo "<option value='2'>Received</option>";
                    } elseif ($pstatus == '1') {
                        echo "<option value='0' >Waiting</option>";
                        echo "<option value='1' selected>In Progress</option>";
                        echo "<option value='2' >Received</option>";
                    } elseif ($pstatus == '2') {
                        echo "<option value='0'>Waiting</option>";
                        echo "<option value='1'>In Progress</option>";
                        echo "<option value='2'selected>Received</option>";
                    }


                    echo "</select>";

                    echo "</div>";
                    echo "</div>";
                }

                ?>



            </div>
        </div>

































    <?php


        // if its not authorised, will show the own user past purchases
        // similar to the above, but only user can see their own and cnt edit status
    } else {
    ?>

        <div class='taskcontainer'>

            <h3>Past Purchases</h3>

            <div class='boxcontainer'>


            <?php
            //select shipping information
            try {
                $query = $conn->prepare("SELECT user_shipping,purchase_id,purchase_time,purchase_cost,cart_bundled,purchase_status,
                mydb.user_creditcardinfo.user_creditcardinfo_nameoncard, mydb.user_creditcardinfo.user_creditcardinfo_cardtype,mydb.user_creditcardinfo.user_creditcardinfo_cardnumb, mydb.user_creditcardinfo.user_creditcardinfo_encryptkey,mydb.user_creditcardinfo.user_creditcardinfo_iv
                FROM mydb.user_past_purchases 
                INNER JOIN mydb.user_creditcardinfo
                ON mydb.user_creditcardinfo.user_creditcardinfo_id = mydb.user_past_purchases.user_creditcards
                WHERE user_id = $userid 
                ORDER BY purchase_time DESC");
                if ($query === false) {
                    //change filename accordingly
                    throw new Exception("Statement Preparation failed(viewpastpurchases)");
                }
            } catch (Exception $e) {
                echo 'Message: ' . $e->getMessage();
                header("location: https://www.swapamc.com/swapproj/campus?error=statement");
                exit;
            }

            // throws error "Statment Execution failed" when statement fails
            try {
                $execute = $query->execute();
                if ($execute === false) {
                    throw new Exception("Statement Execution failed (viewpastpurchases)");
                }
            } catch (Exception $e) {
                echo 'Message: ' . $e->getMessage();
                header("location: https://www.swapamc.com/swapproj/campus?error=statement");
                exit;
            }




            $result = $query->get_result();
            $array = $result->fetch_all(MYSQLI_ASSOC);

            $query->close();








            


            for ($i = 0; $i < sizeOf($array); $i++) {

                $time = $array[$i]['purchase_time'];
                $totalcosts = $array[$i]['purchase_cost'];
                $bundled = $array[$i]['cart_bundled'];
                $pid = $array[$i]['purchase_id'];
                $timepurchased = $array[$i]['purchase_time'];
                $pstatus = $array[$i]['purchase_status'];


                $pcardname = $array[$i]['user_creditcardinfo_nameoncard'];
                $pcardtype = $array[$i]['user_creditcardinfo_cardtype'];
                $pcardnum = $array[$i]['user_creditcardinfo_cardnumb'];
                $hexkey = $array[$i]['user_creditcardinfo_encryptkey'];
                $hexiv = $array[$i]['user_creditcardinfo_iv'];

                //decrypt card num
                $cipher = "aes-192-cbc";
                $encryption_key = hex2bin($hexkey);
                $iv = hex2bin($hexiv);
                $cardnumber = openssl_decrypt($pcardnum, "aes-192-cbc", $encryption_key, 0, $iv);


                $usershipping = $array[$i]['user_shipping'];





                // select shipping information
                try {
                    $query = $conn->prepare("SELECT user_shipping_address,user_shipping_postalcode,user_shipping_unitnumber FROM mydb.user_shippinginformation WHERE user_shipping_id = $usershipping;");
                    if ($query === false) {
                        //change filename accordingly
                        throw new Exception("Statement Preparation failed(viewpastpurchases)");
                    }
                } catch (Exception $e) {
                    echo 'Message: ' . $e->getMessage();
                    header("location: https://www.swapamc.com/swapproj/campus?error=statement");
                    exit;
                }

                // throws error "Statment Execution failed" when statement fails
                try {
                    $execute = $query->execute();
                    if ($execute === false) {
                        throw new Exception("Statement Execution failed (viewpastpurchases)");
                    }
                } catch (Exception $e) {
                    echo 'Message: ' . $e->getMessage();
                    header("location: https://www.swapamc.com/swapproj/campus?error=statement");
                    exit;
                }

                $query->bind_result($shippingaddress, $postalcode, $unitnumber);

                $query->fetch();

                $fulladdress = $shippingaddress . " " . $postalcode . " " . $unitnumber;

















                //display
                $query->close();

                echo "<div class='row'>";
                echo "<div class='left'>";

                echo "<div class='upper'>";

                echo "<div class='lefttext'>";
               

                echo "<p class='description'>Purchase Time: $timepurchased</p>";

                echo "<br>";







                //select products information
                try {
                    $query = $conn->prepare("SELECT cart_id,product_name,product_price,product_picone,quantity,price FROM mydb.user_cart 
                    INNER JOIN mydb.products
                    ON mydb.user_cart.product_id = mydb.products.product_id
                    WHERE bundled = '$bundled'");
                    if ($query === false) {
                        //change filename accordingly
                        throw new Exception("Statement Preparation failed(viewpastpurchases)");
                    }
                } catch (Exception $e) {
                    echo 'Message: ' . $e->getMessage();
                    header("location: https://www.swapamc.com/swapproj/campus?error=statement");
                    exit;
                }

                // throws error "Statment Execution failed" when statement fails
                try {
                    $execute = $query->execute();
                    if ($execute === false) {
                        throw new Exception("Statement Execution failed (viewpastpurchases)");
                    }
                } catch (Exception $e) {
                    echo 'Message: ' . $e->getMessage();
                    header("location: https://www.swapamc.com/swapproj/campus?error=statement");
                }

                $result = $query->get_result();
                $arrayone = $result->fetch_all(MYSQLI_ASSOC);

                $query->close();

                //print_r($arrayone);

                for ($j = 0; $j < sizeOf($arrayone); $j++) {
                    $cartid = $arrayone[$j]['cart_id'];
                    $productname = $arrayone[$j]['product_name'];
                    $productprice = $arrayone[$j]['product_price'];
                    $productpicone = $arrayone[$j]['product_picone'];
                    $productquantity = $arrayone[$j]['quantity'];
                    $totalproductprice = $arrayone[$j]['price'];


                    echo "<p class='description'>Product " . $j + 1 . ": </p>";
                    echo "<p>$productquantity x $productname" . "($productprice)" . "</p>";
                    echo "<br>";







                    // select types information
                    try {
                        $query = $conn->prepare("SELECT cart_typevariants_type,cart_typevariants_variant,cart_additionalcosts 
                        FROM mydb.cart_typevariants 
                        INNER JOIN mydb.user_cart
                        ON mydb.cart_typevariants.cart_id = mydb.user_cart.cart_id
                        WHERE bundled = '$bundled';");
                        if ($query === false) {
                            //change filename accordingly
                            throw new Exception("Statement Preparation failed(viewpastpurchases)");
                        }
                    } catch (Exception $e) {
                        echo 'Message: ' . $e->getMessage();
                        header("location: https://www.swapamc.com/swapproj/campus?error=statement");
                        exit;
                    }

                    // throws error "Statment Execution failed" when statement fails
                    try {
                        $execute = $query->execute();
                        if ($execute === false) {
                            throw new Exception("Statement Execution failed (viewpastpurchases)");
                        }
                    } catch (Exception $e) {
                        echo 'Message: ' . $e->getMessage();
                        header("location: https://www.swapamc.com/swapproj/campus?error=statement");
                    }

                    $query->bind_result($type, $variant, $additionalcosts);





                    while ($query->fetch()) {

                        echo "<p>$type: $variant</p>";
                        echo "<p>Additional Costs:$$additionalcosts</p>";
                        echo "<br>";
                    }


                    unset($type);






                    //unset($type);




                    $query->close();
                }


                //print shipping address, card and cost 
                echo "<p class='description'>Shipped To:</p>";
                echo "<p> $fulladdress</p";
                echo "<br>";
                echo "<p class='description'>Credit Card:</p>";
                echo "<p>Name: $pcardname</p>";
                echo "<p>Type: $pcardtype</p>";
                echo "<p>Number: **** **** **** $cardnumber</p>";
                echo "<br>";
                echo "<p class='description'>Total Costs: $$totalcosts</p>";
                echo "<br>";
                echo "</div>";
                echo "</div>";
                echo "</div>";
            }

            echo "<div class='right'>";
            echo "<p>Progress:</p>";

            //only can view status
            echo "<select name='viewstatus' id='$pid'>";

            if ($pstatus == '0') {
                echo "<option value='0'selected>Waiting</option>";
            } elseif ($pstatus == '1') {
                echo "<option value='1' selected>In Progress</option>";
            } elseif ($pstatus == '2') {
                echo "<option value='2'selected>Received</option>";
            }


            echo "</select>";

            echo "</div>";
            echo "</div>";
        }
     
            ?>

















            <script>
                var show = document.getElementById('nav-links');

                function showMenu() {
                    show.style.display = 'block';

                    show.style.right = '0';
                }

                function closeMenu() {
                    show.style.right = '-200px';
                }




                function updateStatus(pid, userid) {
                    console.log(pid);
                    
                    

                    
                    status = document.getElementById(pid).value;
                    var jsonString = JSON.stringify(pid + ',' + userid + ',' + status);

                    // console.log(status);


                    jQuery.ajax({
                        url: 'https://www.swapamc.com/swapproj/updatepastpurchase',
                        type: 'post',
                        data: {
                            info: jsonString
                        },


                        success: function(result) { //we got the response
                            // alert('Successfully called');
                            console.log(result);
                        },
                        error: function(jqxhr, status, exception) {
                            alert('Exception:', exception);
                        }

                    });

                }
            </script>

</html>