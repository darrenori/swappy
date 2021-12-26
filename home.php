<html>
<style type="text/css">
    .title{
    position: absolute;
    top: 22%;
    left:50%;
    transform: translate(-50%,-50%);
    color: white;

}
    .logo{
        cursor:pointer;
        margin-right: auto;
        
    }
    body {
        background-color: white;
        font-family: Montserrat;
    }

    nav {
        background-color: black;
        padding: 5px 20px;
    }

    ul {
        list-style-type: none;
    }

    a {
        color: white;
        opacity: 57%;
        text-decoration: none;
    }

    a:hover {
        color: white;
        border-bottom: 3px solid red !important;
    }
    .current{
        border-bottom: 3px solid #8D1D25;
        opacity: 100%;
        color: white;
    }
    .menu li {
        font-size: 20px;
        padding: 30px 50px;
        margin-left:60px;
       
    }

    .menu li a {
        display: block;
    }

    /* Mobile Menu */
    .menu {
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: center;
    }

    .toggle {
        order: 1;
    }

    .item.button {
        order: 2;
    }

    .item {
        width: 100%;
        text-align: center;
        order: 3;
        display: none;
    }

    .item.active {
        display: block;
    }

    .toggle {
        cursor: pointer;

    }

    .bars {
        background: #999;
        display: inline-block;
        height: 2px;
        position: relative;
        width: 18px;
    }

    .bar::before,
    .bars::after {
        background: #999;
        content: "";
        display: inline-block;
        height: 2px;
        position: absolute;
        width: 18px;
    }

    .bars::before {
        top: 5px;
    }

    .bars::after {
        top: -5px;
    }

    /* Tablet Menu */
    @media all and (min-width:468px) {
        .menu {
            justify-content: center;
        }

        .logo {
            flex: 1;
        }

        .item.button {
            width: auto;
            order: 1;
            display: block;

        }

        .toggle {
            order: 2;
        }

        .button.secondary {
            border: 0;
        }

        .button a {
            text-decoration: none;
            padding: 7px 15px;
            background: #8D1D25;
            border: 1px solid #8D1D25;
            border-radius: 50cm;
        }

        .button.secondary a {
            background: transparent;
        }

        .button a:hover {
            transition: all .25s;
        }
    }

    @media all and (min-width:768px) {
        .item {
            display: block;
            width: auto;
        }

        .toggle {
            display: none;
        }

        .logo {
            order: 0;
        }

        .item {
            order: 1;
        }

        .button {
            order: 2;
        }

        .menu li {
            padding: 15px 10px;
        }

        .menu li.button {
            padding-right: 0;
        }
    }
    body {background-color: black;}

.rectangle {
  height: 213px;
  width: 1510px;
  background-color: #8D1D25;
  border: #707070;
  top: 1100px;
  position: absolute;
}
.abc{
    color: white;
    font-family: Montserrat;
    font-weight: Medium;
    top: 1070px;
    left:70px;
    position: absolute;
    font-size: 20px;
}
.step1{
    color: white;
    font-family: Montserrat;
    font-weight: bold;
    font-size: 30px;
    top: 1110px;
    left:50px;
    position: absolute;
}
.step11{
    color: white;
    font-family: Montserrat;
    font-weight: regular;
    font-size: 23px;
    top: 1150px;
    left:50px;
    position: absolute;
}
.rec1 {
  height: 213px;
  width: 440px;
  background-color: white;
  opacity:0%;
  top: 1100px;
  left:35px;
  position: absolute;
}
.rec1:hover {
    background-color: #E3D7D7;
  opacity:100%;
  
}
.rec2 {
  height: 213px;
  width: 500px;
  background-color: white;
  opacity:0%;
  top: 1100px;
  left:510px;
  position: absolute;
}
.rec2:hover {
    background-color: #E3D7D7;
  opacity:100%;
  
}

.rec3 {
  height: 213px;
  width: 460px;
  background-color: white;
  opacity:0%;
  top: 1100px;
  left:1030px;
  position: absolute;
}
.rec3:hover {
    background-color: #E3D7D7;
  opacity:100%;
  
}
.step2{
    color: white;
    font-family: Montserrat;
    font-weight: bold;
    font-size: 30px;
    top: 1110px;
    left:530px;
    position: absolute;
}
.step22{
    color: white;
    font-family: Montserrat;
    font-weight: regular;
    font-size: 23px;
    top: 1150px;
    left:530px;
    position: absolute;
}
.step3{
    color: white;
    font-family: Montserrat;
    font-weight: bold;
    font-size: 30px;
    top: 1110px;
    left:1050px;
    position: absolute;
}
.step33{
    color: white;
    font-family: Montserrat;
    font-weight: regular;
    font-size: 23px;
    top: 1150px;
    left:1050px;
    position: absolute;
}
.quote {
    margin-top: 10px;
    margin-left: 150px;
    color: white;
}
.quote h1{
    font-size: 3rem;
    margin-bottom: 10px;
    font-weight: bolder;
}
.quote h1 span{
    font-family:Segoe UI;
    opacity: 9%;
    font-weight:lighter;
    font-size:10rem;
}
.quote h1 spano {
    color: #8D1D25;
    font-size: 40px;
    font-weight: bold;  
}
.quote h1 spann{
    color: #8D1D25;
}
.quote h1 spannn{
    color: #8D1D25;
}
.signupbtn{
    background-color: #8D1D25;
    font-size: 16px;
    font-weight: bolder;
    padding: 10px 25px;
    margin-left: 0px;
    border: #8D1D25;
    color: white;
    font-family: Montserrat;
    cursor: pointer;
    position: relative;
    z-index: 1;
}
.showmemorebtn{
    background-color: black;
    font-size: 16px;
    font-weight: bolder;
    padding: 10px 25px;
    margin-left:33px;
    border-color: #8D1D25;
    border-width: 1px;
    border-style: solid;
    color: white;
    font-family: Montserrat;
    cursor: pointer;
    position: relative;
    z-index: 1;
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
    <nav>
        <ul class="menu">
            <li class="logo"><img src="https://drive.google.com/uc?export=view&id=1h5mBrjy3khdhJEPWm6FHor9_h0sxUgkG" width="200px";></li>
            <li class="item current"><a href="https://www.swapamc.com/swapproj/home/">Home</a></li>
            <li class="item"><a href="https://www.swapamc.com/swapproj/faq/">FAQ</a></li>
            <li class="item"><a href="#">Bookings</a></li>
            <li class="item"><a href="#">Products</a></li>
            <li class="item button"><a href="#">Login</a></li>
            <li class="toggle"><a href="#"><span class="bars"></span></a></li>
        </ul>
    </nav>
    <div class="quote">
        <h1 class="quotetxt"><span>01</span><br><spano>TPAMC</spano><br>Nothing much.<br>Just the best <spann>website</spann><br>For the best <spannn>AMC</spannn></h1>
        <button class="signupbtn" onclick="location.href = 'https://www.swapamc.com/swapproj/signup'">Sign Up</button>
        <button class="showmemorebtn" onclick="location.href = 'https://www.swapamc.com/swapproj/faq'">Show me more</button>
    </div>
    
   
<img src="https://drive.google.com/uc?export=view&id=1xONL4Bwq3Re3OlNgYAsv8AnEA4kjsJyw" style="position:absolute; top:250px; left:0px;">
<img src="https://drive.google.com/uc?export=view&id=1pdrKPJmTtF3Z2v9GJmsZHgEKg_ytNgAT" style="position:absolute; top:250px; left:930px; height: auto;  width: auto;  max-width: 220px;  max-height:220px; ">
<img src="https://drive.google.com/uc?export=view&id=1pdrKPJmTtF3Z2v9GJmsZHgEKg_ytNgAT" style="position:absolute; top:700px; left:610px; height: auto;  width: auto;  max-width: 220px;  max-height:220px; ">
<img src="https://drive.google.com/uc?export=view&id=1v1Y1ZoLkjPb96i6-R_i985Ia16o0mywy" style="position:absolute; top:320px; left:700px; opacity:40%; height: auto;  width: auto;  max-width: 720px;  max-height:720px; ">
<img src="https://drive.google.com/uc?export=view&id=1kG4FlqluXDLGe-gSpVeoF0uqEIVvYGGp" style="position:absolute; top:380px; left:790px; height: auto;  width: auto;  max-width: 720px;  max-height:720px; ">
</body>
<img src="https://drive.google.com/uc?export=view&id=1HW2BMG9YG9fTPtjMwWs33ZLbLj9UPwa1" style="position:absolute; top: 1000px; left: 50%; right: 50%;">
<footer>
    <div class="rectangle"></div>
    <div class="abc">How do i use the website?</div>
    <div class="rec1"></div>
    <div class="step1">Step 1</div>
    <div class="step11">Sign up for an account. If you are an <br>employee or someone with higher <br> privilege, do check out the FAQs</div>
    <div class="rec2"></div>
    <div class="step2">Step 2</div>
    <div class="step22">View our range of products and booking<br>slots</div>
    <div class="rec3"></div>
    <div class="step3">Step 3</div>
    <div class="step33">Leave us with any of your feedback at the FAQs section</div>
    
</footer>
</html>