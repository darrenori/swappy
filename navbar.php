
 <?php
 require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';


 ?>
 <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@500&display=swap" rel="stylesheet">
        <!-- <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"> -->
        <!-- <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" -->
         <!-- integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/> -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet"> -->


<head>


</head>

<style>
    
    *{
        margin:0;
        padding:0;
        font-family:sans-serif;
    }

    body {
        /* background:black; */
        /* font-family: 'Montserrat', sans-serif; */
        color: white;
    
    }
    html, body {
    max-width: 100%;
    overflow-x: hidden;
}
    
    .nav-bar {
        color: white;
        display:flex;
        padding: 40px 7vw;
        text-align:right;
        align-items:center;
    }
    .navlinksic {
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
        display:inline-block !important;
        padding:8px 25px !important;
        
    }
    .nav-links ul a {
        color: white;
        text-decoration:none;
        font-size:14px;
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
    .nav-links ul .links:hover::after {
        
        width:100%;
        
    }
    .btn {
        padding: 10px 30px;
        font-weight:500;
        border:0;
        background:#8D1D25;
        color:white;
        border-radius:16px;
        cursor:pointer;
    }
    .nav-links .btn {
        float:right;
    }

    .profileinfo {
        color: white;
        font-size: 20px;
    }

    @media(max-width:900px){
        
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
      
        
        .btnthree {
        
            margin-left:0;
        }

        .navic {
            padding-right: 0;
            flex-basis: 20%;
            background-color: #8D1D25;

        }

        #lblCartCount {
            display: none;
        }

        .profileinfo {
            /* width: 100%; */
            flex-basis: 100%;
            
            padding:0;
        }


        
        
    }

    .navic {
        /* padding-right: 20px; */
        padding-right: 25px;
        font-size: 18px;
        transition: .25s;
        flex-basis: 20%;
        width: 20px;
        height: 20px;
        box-sizing: initial !important;
        background: inherit ;

    }

    .naviclast {
        font-size: 18px;
        transition: .25s;
        flex-basis: 20%;
        width: 20px;
        height: 20px;
        background: inherit ;
        /* position: absolute; */
    }

    .navic:hover {
        opacity: 0.7;
        
    }

    .naviclast:hover{
        opacity: 0.7;
    }

    .profileinfo {
        /* font-size: 20px; */

        background-color: rgba(141, 29, 37, 0.8) !important;   
        padding: 10px 20px;
        /* padding-left: 20px; */
        display: flex;
        flex-wrap: wrap;
        justify-content: center;
        align-items: center;

        border-radius: 16px;
        transition: .5s;
        
        
    }

    .profileinfo:hover {
        background-color: rgba(226, 101, 101, 0.8);
    }

    .badge {
  padding-left: 9px;
  padding-right: 9px;
  -webkit-border-radius: 9px;
  -moz-border-radius: 9px;
  border-radius: 9px;
}

.label-warning[href],
.badge-warning[href] {
  background-color: #c67605;
  
}
#lblCartCount {
    font-size: 12px;
    background: black;
    color: #fff;
    padding: 0 5px;
    vertical-align: top;
    margin-left: -1px;
    margin-top: -10px;
    position: relative;
    z-index: 100;
    position: absolute;
}

.logo {
    background: transparent;
}

    
   
</style>

<div class='nav-bar'>
    <div class='nav-logo'>
    <svg class='logo' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="180" height="62" viewBox="0 0 360 123.367">
  <defs>
    <linearGradient id="linear-gradient" x1="1.363" y1="-0.243" x2="0.149" y2="0.921" gradientUnits="objectBoundingBox">
      <stop offset="0" stop-color="#e26565"/>
      <stop offset="1" stop-color="#8d1d25"/>
    </linearGradient>
  </defs>
  <g id="Group_414" data-name="Group 414" transform="translate(-107 -97.817)">
    <path id="Exclusion_2" data-name="Exclusion 2" d="M85.821,123.367H80.457v-16.09h5.365v16.09Zm-10.727,0H69.729v-16.09h5.365v16.09Zm-10.729,0H59v-16.09h5.363v16.09Zm-10.727,0H48.274v-16.09h5.363v16.09Zm-10.727,0H37.547v-16.09H42.91v16.09Zm48.274-21.455h-59A10.74,10.74,0,0,1,21.455,91.184v-59A10.74,10.74,0,0,1,32.182,21.455h59a10.74,10.74,0,0,1,10.727,10.727v59A10.74,10.74,0,0,1,91.184,101.912Zm-29.891-11.9a1.656,1.656,0,0,1,.642.135c.754.314.949.889,1.244,1.761.052.154.107.316.169.488H65.6c.06-.168.113-.324.163-.475.3-.878.491-1.458,1.252-1.773a1.671,1.671,0,0,1,.639-.135,3.511,3.511,0,0,1,1.487.507c.143.071.294.146.455.223l1.6-1.593c-.077-.161-.15-.31-.221-.453-.412-.83-.684-1.379-.369-2.136s.9-.956,1.78-1.252c.147-.05.3-.1.467-.16V82.89c-.17-.061-.328-.114-.482-.166-.874-.295-1.452-.49-1.765-1.245s-.042-1.31.374-2.145c.069-.139.142-.285.217-.442l-1.6-1.6c-.157.075-.3.148-.442.218a3.506,3.506,0,0,1-1.5.511,1.663,1.663,0,0,1-.645-.136c-.757-.314-.95-.888-1.244-1.758-.052-.154-.107-.317-.168-.489H63.347c-.06.168-.113.325-.164.477-.3.876-.491,1.455-1.248,1.77a1.654,1.654,0,0,1-.645.137,3.517,3.517,0,0,1-1.5-.51c-.141-.07-.288-.144-.445-.219l-1.6,1.6c.076.159.149.307.22.449.413.831.686,1.38.372,2.138s-.891.951-1.765,1.245c-.152.051-.313.105-.483.166v2.256c.164.058.32.111.468.16.882.3,1.464.492,1.78,1.249s.042,1.313-.374,2.144c-.07.141-.144.288-.218.444l1.6,1.593c.158-.075.3-.148.445-.218A3.521,3.521,0,0,1,61.293,90.009Zm18.486-9.167a2.207,2.207,0,0,1,.855.18c1.011.418,1.27,1.19,1.664,2.359.067.2.139.413.219.637h3c.078-.219.147-.426.214-.625.4-1.176.656-1.952,1.673-2.374a2.218,2.218,0,0,1,.853-.18,4.663,4.663,0,0,1,1.977.673c.2.1.4.2.612.3l2.126-2.126c-.1-.215-.2-.414-.3-.607-.547-1.105-.909-1.835-.491-2.842s1.2-1.275,2.38-1.67c.2-.066.4-.134.616-.21V71.349c-.223-.08-.432-.15-.635-.218-1.17-.394-1.942-.655-2.361-1.661s-.057-1.74.492-2.846c.094-.189.193-.389.295-.6l-2.126-2.128c-.208.1-.4.2-.587.288a4.711,4.711,0,0,1-2.005.683,2.217,2.217,0,0,1-.856-.18c-1.01-.418-1.269-1.19-1.663-2.36-.067-.2-.139-.412-.218-.636h-3c-.08.224-.15.433-.218.635-.394,1.169-.654,1.941-1.664,2.361a2.207,2.207,0,0,1-.858.182,4.676,4.676,0,0,1-1.99-.679c-.188-.094-.386-.193-.6-.294l-2.128,2.128c.1.213.2.411.294.6.55,1.108.913,1.839.494,2.848s-1.192,1.269-2.36,1.661c-.2.068-.412.138-.636.218v3.007c.217.077.421.145.619.212,1.178.4,1.955.656,2.377,1.666s.057,1.746-.494,2.851c-.1.191-.193.388-.294.6l2.128,2.126c.211-.1.406-.2.595-.291A4.7,4.7,0,0,1,79.779,80.842ZM42.9,71.681a4.679,4.679,0,0,1,1.82.385c2.15.89,2.7,2.533,3.537,5.021.144.43.293.873.461,1.345h6.39c.167-.47.316-.911.459-1.337.837-2.49,1.39-4.134,3.553-5.033a4.673,4.673,0,0,1,1.813-.385,9.926,9.926,0,0,1,4.2,1.431c.413.205.837.416,1.3.634l4.517-4.52c-.217-.458-.427-.881-.631-1.29-1.164-2.344-1.933-3.892-1.046-6.037s2.536-2.7,5.026-3.532c.429-.144.872-.293,1.345-.461V51.508c-.477-.17-.922-.32-1.354-.465-2.483-.836-4.123-1.389-5.012-3.531s-.117-3.7,1.055-6.06c.2-.4.407-.818.621-1.267l-4.517-4.52c-.452.215-.871.423-1.275.625a9.937,9.937,0,0,1-4.23,1.436A4.7,4.7,0,0,1,59.1,37.34c-2.146-.889-2.7-2.531-3.533-5.016-.144-.429-.293-.873-.462-1.348H48.716c-.168.473-.317.917-.461,1.346-.835,2.487-1.386,4.129-3.533,5.018a4.721,4.721,0,0,1-1.828.387,9.94,9.94,0,0,1-4.218-1.434c-.409-.2-.83-.412-1.286-.629l-4.514,4.52c.216.455.425.875.627,1.282,1.167,2.348,1.937,3.9,1.049,6.046s-2.533,2.7-5.015,3.532c-.431.145-.877.295-1.352.464V57.9c.475.17.922.32,1.353.465,2.484.836,4.123,1.389,5.011,3.53s.122,3.7-1.046,6.046c-.2.407-.413.828-.628,1.281l4.516,4.52c.457-.217.88-.427,1.289-.63A9.933,9.933,0,0,1,42.9,71.681ZM64.476,86.808a2.791,2.791,0,1,1,2.792-2.791A2.795,2.795,0,0,1,64.476,86.808Zm58.891-.987h-16.09V80.457h16.09v5.365Zm-107.275,0H0V80.457H16.092v5.365Zm67.926-9.25a3.721,3.721,0,1,1,3.721-3.721A3.726,3.726,0,0,1,84.018,76.572Zm39.349-1.478h-16.09V69.729h16.09v5.365Zm-107.275,0H0V69.729H16.092v5.365ZM123.367,64.365h-16.09V59h16.09v5.363Zm-107.275,0H0V59H16.092v5.363Zm35.82-1.749a7.911,7.911,0,1,1,7.91-7.911A7.919,7.919,0,0,1,51.912,62.616Zm71.454-8.978h-16.09V48.274h16.09v5.363Zm-107.275,0H0V48.274H16.092v5.363ZM123.367,42.91h-16.09V37.547h16.09V42.91Zm-107.275,0H0V37.547H16.092V42.91ZM85.821,16.092H80.457V0h5.365V16.092Zm-10.727,0H69.729V0h5.365V16.092Zm-10.729,0H59V0h5.363V16.092Zm-10.727,0H48.274V0h5.363V16.092Zm-10.727,0H37.547V0H42.91V16.092Z" transform="translate(107 97.817)" fill="url(#linear-gradient)"/>
    <text id="TPAMC" transform="translate(260 131.5)" fill="#fff" font-size="40" font-family="Poppins-Regular, Poppins"><tspan x="0" y="42">TP</tspan><tspan y="42" fill="#8d1d25" font-family="Poppins-Bold, Poppins" font-weight="700">AMC</tspan></text>
  </g>
</svg>

        
    </div>

    
    <div class='nav-links' id='nav-links' style='list-style-type: disc !important;'>
        <i class="navlinksic fas fa-arrow-circle-left" onclick="closeMenu()" style="color:white"></i>
        <ul>

            <?php
                require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
                $jwtarray = jwtdecrypt();
                

                if(isset($jwtarray)&&$jwtarray!=null){
                    $jwtarrayinformation = $jwtarray['array'];
                    //signedin











                    ###calculate cart



                    $cartsze=0;

                    $useriduni=$jwtarrayinformation['userid'];
                    try {
                       $query = $conn->prepare("SELECT cart_id FROM mydb.user_cart 
                       WHERE user_id = ? AND mydb.user_cart.purchased='0';");
                       $query->bind_param('s', $useriduni);
                       if ($query === false) {
                           //change filename accordingly
                           throw new Exception("Statement Preparation failed(nav)");
                       }
                   } catch (Exception $e) {
                       error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR preparing statement (SELECT)", 0);
                       //change header location accordingly
                       
                   }
                   // throws error "Statment Execution failed" when statement fails
                   try {
                       $execute = $query->execute();
                       if ($execute === false) {
                           throw new Exception("Statement Execution failed (navbar)");
                       }
                   } catch (Exception $e) {
                       error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR preparing statement (SELECT)", 0);
                       
                   }
                   
                   $result = $query->get_result();
                   $arrayone = $result->fetch_all(MYSQLI_ASSOC);
                   $cartsze= sizeof($arrayone);



                   if($cartsze>9){
                       $cartsze="9+";
                   }























                    echo '<a href="https://www.swapamc.com/swapproj/home/"><li class="links">HOME</li></a>';
                    echo '<a  href="https://www.swapamc.com/swapproj/faq/"><li class="links">FAQs</li></a>';
                    echo '<a href="https://www.swapamc.com/swapproj/allproducts"><li class="links">PRODUCTS</li></a>';
                    echo '<li>';
                        echo '<div class="profileinfo" style="color: white;">';
                            echo "<a href='https://www.swapamc.com/swapproj/campus'><i class='navic fas fa-user'></i></a>";
                            echo "<a href='https://www.swapamc.com/swapproj/allproducts/product/viewcart'><i class='navic fas fa-shopping-cart'><span class='badge badge-warning' id='lblCartCount'>$cartsze</span></i></a>";
                            echo "<a href='https://www.swapamc.com/swapproj/viewnotifications'><i class='navic fas fa-bell'></i></a>";
                            echo "<a href='https://www.swapamc.com/swapproj/viewfavorites'><i class='naviclast fas fa-heart'></i></a>";
                        echo "</div>";
                    echo "</li>";
                } else {
                    echo '<a href="https://www.swapamc.com/swapproj/home/"><li class="links">HOME</li></a>';
                    echo '<a  href="https://www.swapamc.com/swapproj/faq/"><li class="links">FAQs</li></a>';
                    echo '<a href="https://www.swapamc.com/swapproj/allproducts/product/viewcart"><li class="links">PRODUCTS</li></a>';
                    echo "<button onclick=location.href='https://www.swapamc.com/swapproj/login' type='button' class='btn'>LOGIN</button>";


                }


            ?>
            
            
            
        </ul>
        <!-- <button onclick="location.href = 'https://www.swapamc.com/swapproj/login'" type="button" class="btn">LOGIN</button> -->
    </div>
    <i class="navlinksic fas fa-bars menu-icon" onclick="showMenu()" style="color:white"></i>
    
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