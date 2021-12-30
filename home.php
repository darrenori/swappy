

<html>
<style type="text/css">

    *{
        margin:0;
        padding:0;
        font-family:sans-serif;
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




    .rowone {
        display:flex;
        justify-content:space-between;
        flex-wrap:wrap;
        flex-direction:row;
        align-items:center;
        margin:100px 7vw;
        max-width: 80vw;
        width:80vw;
        
    }

    .banner-title {
        
        color:white;
        flex-basis:50%;
        position: relative;

        
    }

    .banner-title h1 {
        font-size:50px;
        margin-bottom: 30px;
    }

    .banner-title h2 {
        font-size:80px;
        opacity:10%;
        z-index: -10000;
        font-weight:900;
        
    }

    .banner-title h3{
        color:#8D1D25;
        font-size:30px;
        font-weight:bold;
        z-index: 2;
    }

    .buttoncontainer {
        width:70%;
        display:flex;
        
        flex-wrap:wrap;
        justify-content:space-between;
        
        flex-direction:row;
        
        
    }

    .btntwo {
        flex-basis:30%;
        
        
        padding: 10px 60px;
        font-weight:bold;
        border:0;
        background:#8D1D25;
        color:white;
    
        cursor:pointer;
        border: 2px solid #8D1D25;
        margin-top:30px;
        margin-bottom:30px;

    }

    .btnthree {

        flex-basis:30%;
        
        padding: 10px 69px;
        font-weight:bold;
        border: 2px solid #8D1D25;
        color:white;
        cursor:pointer;
        background:none;
        margin-top:30px;
        margin-bottom:30px;
    }

    .banner-title h1 span  {
        color:#8D1D25;
    }
 

    .imagesection {
        
        flex-basis:45%;
        position: relative;
        
        
        
    }


    .imagesection .vectorshape {
        width:600px;  
        float:right;
        
        
    }

    .imagesection .vectorshape .vector {
        width:100%;
        
        
    }

    .imagesection .whiteshape {
        float:right;
        position:absolute;
        width:600px;
        
        z-index:-1;
        top:0;
        right:0;
            
        
        
    }

    .imagesection .whiteshape .white {
        z-index:-1;
        
        width:100%;
        
        
        
    }

    .imagesection .ballshape {
        width:280px;
        /* //margin-left:-500px; */
        position:absolute;
        top:-80px;
        left:120px;
        z-index:-2;

    }

    

    .imagesection .ballshapetwo {
        width:180px;
        /* //mrgin-left:-500px; */
        position:absolute;
        bottom:0px;
        left:0px;
        z-index:-2;

    }

    

    

    #blob {
        backdrop-filter: blur(20px);
        -webkit-backdrop-filter: blur(20px);
        background-color:green;
        
    }


    .rowone .cylinder {
        width:150px;
        
        position:absolute;
        margin-left:-7vw;
        z-index:-2;
    }
    

    .rowone .cylinder img {
        width:100%;

    }

    .buttoncontainer {

    }

    .scroll {
        display:flex;
        justify-content:center;
        flex-wrap:wrap;
        flex-direction:row;
        align-items:center;

        margin:50px 7vw;

    }


    .bottom {

        margin-top:200px;


    }

    .bottom .textcontainer {
        margin: 0 calc(7vw + 18px);
        margin-bottom:20px;

    }

    .bottom .textcontainer h2 {
        color:white;
        font-size:15px;
        opacity:0.85;
    }

    .bottom .redbottom {
        background-color:#8D1D25;
        width:100%;
        
        padding: 30px 0;

    }

    .marginedredbottom {
        background-color:#8D1D25;
        margin:0 7vw;
        flex-basis:100%;
        display:flex;
        flex-wrap:wrap;
        justify-content:space-between;
        /* //height:100%; */

    }

    .columnbelow {
        background-color:none;
        color:white;
        flex-basis:29%;
        padding:20px 18px;
        opacity:80%;
        transition:.5s;



    /* //margin-left:7vw; */


    }

    .columnbelow:hover {
        background-color:white;
        color:black;
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
    background-color: #2c2f32;
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


    

</style>

<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
         integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
<head>



</head>
<body>
<div class='hero'>
    <div class='nav-bar'>
        <div class='nav-logo'>
            <img src="https://drive.google.com/uc?export=view&id=1sDaIqkxjzSkJAbI0nhS-gd2Roe3VlHXL" class='logo'>
            
        </div>

        <div class='nav-links' id='nav-links'>
            <i class="fas fa-arrow-circle-left" onclick="closeMenu()" style="color:white"></i>

            <ul>
                <a href="#"><li>HOME</li></a>
                <a href="#"><li>FAQs</li></a>
                <a href="#"><li>PRODUCTS</li></a>
               
                
            </ul>

            <button type="button" class="btn">SIGN UP</button>

        </div>
        <i class="fas fa-bars menu-icon" onclick="showMenu()" style="color:white"></i>

        

        

        
        
    </div>

    <div class='rowone'>
        <div class='cylinder'>
            <img src="https://drive.google.com/uc?export=view&id=1xONL4Bwq3Re3OlNgYAsv8AnEA4kjsJyw">
        </div>


        <div class='banner-title'>
                <h2>01</h2>
                <h3>TPAMC</h3>
                <h1>Nothing much.<br>Just the best <span>website</span><br>for the best <span>AMC</span></h1>

                <div class='buttoncontainer'>
                    <button type='button' class='btntwo'>EXPLORE</button>
                    <button type='button' class='btnthree'>LOGIN</button>


                </div>
                

                

        </div>


        <div class='imagesection'>

            <div class="vectorshape">
                <img class='vector' src="https://drive.google.com/uc?export=view&id=1kG4FlqluXDLGe-gSpVeoF0uqEIVvYGGp">

            </div>

            <div class='whiteshape'>

            
            
            
                <svg class='white' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 1011.492 942.46">
                    <defs >
                        <linearGradient  id="linear-gradient" x1="0.89" y1="0.085" x2="-0.341" y2="2.212" gradientUnits="objectBoundingBox">
                        <stop offset="0" stop-color="#fff" stop-opacity="0.4"/>
                        <stop offset="1" stop-color="#fff" stop-opacity="0"/>
                        </linearGradient>

                        
                    </defs>
                    <path  id="blob" d="M609.381,146.842C710.44,232.879,842.227,279.994,905.048,378.323c62.821,97.645,55.992,245.82-15.022,344.148C818.328,820.8,681.761,869.28,564.314,867.914s-215.776-52.578-324.346-87.4C132.08,745,14.633,726.568-34.531,658.967-83.013,592.05-63.21,476.651-28.386,379.005s84.671-178.22,153.638-269.719,156.369-193.925,235.578-183C439.355-62.788,509,61.488,609.381,146.842Z" transform="translate(63.433 74.518)" fill="url(#linear-gradient)"/>
                </svg>

            </div>


            <div class='ballshape'>

                <svg class='ball' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  viewBox="0 0 339.834 339.834">
                        <defs>
                            <radialGradient id="radial-gradient" cx="0.209" cy="0.597" r="0.5" gradientUnits="objectBoundingBox">
                            <stop offset="0" stop-color="#e26565"/>
                            <stop offset="1" stop-color="#8d1d25"/>
                            </radialGradient>
                        </defs>
                        <circle id="Ellipse_9" data-name="Ellipse 9" cx="124.388" cy="124.388" r="124.388" transform="translate(0 124.388) rotate(-30)" fill="url(#radial-gradient)"/>
                    </svg>
                </rect>
                
            </div>



            <div class='ballshapetwo'>

                <svg class='balltwo' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"  viewBox="0 0 339.834 339.834">
                        <defs>
                            <radialGradient id="radial-gradient" cx="0.209" cy="0.597" r="0.5" gradientUnits="objectBoundingBox">
                            <stop offset="0" stop-color="#e26565"/>
                            <stop offset="1" stop-color="#8d1d25"/>
                            </radialGradient>
                        </defs>
                        <circle id="Ellipse_9" data-name="Ellipse 9" cx="124.388" cy="124.388" r="124.388" transform="translate(0 124.388) rotate(-30)" fill="url(#radial-gradient)"/>
                    </svg>
                </rect>
                
            </div>


        </div>

    </div>

    <div class='scroll'>
        <i class="fas fa-chevron-down" style='color:white'></i>



    </div>


    <div class ='bottom'>

        <div class='textcontainer'>
            <h2>How do I use the website?</h2>


        </div>
        
        

        <div class='redbottom'>

            <div class='marginedredbottom'>

                <div class='columnbelow' id='col1'>

                    
                        <h3>Step 1</h3>
                        <p>Sign up for an account. If you are an employee or someone with higher privilege, do check out the FAQs</p>

                        


                </div>

                <div class='columnbelow' id='col2'>

                        <h3>Step 2</h3>
                        <p>View our range of products and booking slots</p>

                        

                </div>


                <div class='columnbelow' id='col3'>
            
                        <h3>Step 3</h3>
                        <p>Leave us with any of your feedback at the FAQs session</p>

                        

                </div>



            </div>  

            
        </div>

        
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




    
    
   
</body>

</html>