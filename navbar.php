
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

    
   
</style>

<div class='nav-bar'>
    <div class='nav-logo'>
        <img src="https://drive.google.com/uc?export=view&id=1sDaIqkxjzSkJAbI0nhS-gd2Roe3VlHXL" class='logo'>
        
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