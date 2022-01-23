<html>
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
        font-size: 12.5px;
        padding: 9px 31px;
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

    .scroll {
        display:flex;
        justify-content:center;
        flex-wrap:wrap;
        flex-direction:row;
        align-items:center;

        margin:50px 7vw;

    }


    .columnbelow:hover {
        background-color:white;
        color:black;
    }


    @media(max-width:810px){

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

        .container{
            flex-direction: column;
            flex-basis: 100%;
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

.feedbackbtn {
	background-color:#8d1d24;
	border-radius:38px;
	border:1px solid #8d1d24;
	display:inline-block;
    cursor: pointer;
	color:#ffffff;
	font-family:Montserrat;
	font-size:15px;
	padding:11px 30px;
	text-decoration:none;
	text-shadow:0px 1px 0px #2f6627;
    z-index: 1;
}
.container{
    height:100%;
    width:100%;
    margin:0 5em 0 5em;
    display: flex;
    justify-content: center;
    align-items: flex-start;
}
.thing{
    padding: 2em;
    font-family: Montserrat;
    font-weight: bold;
}
.thing .faqq{
    color: white;
    
}
.queries{
    color: #A85258;
    opacity: 70%;
}


.queries span{
        cursor: pointer;
    }
    .queries spann{
        cursor: pointer;
    }
    .queries spannn{
        cursor: pointer;
        opacity: 100%;
        color: #EF0C1D;
    }
    .queries spannnn{
        cursor: pointer;
    }

    .useraccount {
        color: white;
        font: Montserrat;
        font-weight: bold;
    }
    .useraccount h1{
        color: #A85258; 
    }
    .useraccount span{
        color: white;
        font-size: 20px;
    }
    .useraccount spann{
        color: #A85258;
        font-size: 50px;

    }
    .useraccount spannn{
        color: white;
        font-size: 20px;
    }
    .useraccount spanone{
        color: white;
        font-weight: normal;
        font-size: 20px;
        opacity: 50%;

    }
    .useraccount linkk{
        cursor: pointer;
        font-weight: bold;
        color: #EF0C1D;
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
                <a href="https://www.swapamc.com/swapproj/home/"><li>HOME</li></a>
                <a href="https://www.swapamc.com/swapproj/faq"><li>FAQs</li></a>
                <a href="#"><li>PRODUCTS</li></a>
               
                
            </ul>

            <button type="button" class="btn">LOGIN</button>

        </div>
        <i class="fas fa-bars menu-icon" onclick="showMenu()" style="color:white"></i>

    </div>

    <div class="container">
        <div class="thing">
            <h3 class="faqq"><span>Frequently Asked Questions:</span></h3><br>
            <div class="queries"><span onclick="location.href = 'https://www.swapamc.com/swapproj/faq'">User Account</span><br><br><spann onclick="location.href = 'https://www.swapamc.com/swapproj/faq/banned'">Banned</spann><br><br><spannn onclick="location.href = 'https://www.swapamc.com/swapproj/faq/whoarewe'">Who are we?</spannn><br><br><spannnn onclick="location.href = 'https://www.swapamc.com/swapproj/faq/employee'">I'm an employee. What do I do?</spannnn></div>
            <br>
            <div class="modal fade" id="feedback">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded-10">
                        <div class="modal-header">
                        <h5 class="modal-title w-100 text-center">Feedback Form</h5>
                        </div>
                        <div class="modal-body w-100 text-center">
                            <form action="https://formsubmit.co/ryanng6948@gmail.com" method="POST">
                            <input type="hidden" name="_subject" value="New Feedback!">
                            <input type="email" name="email" class="form-control" placeholder="Email Address" required>
                            <br>
                            <input type="hidden" name="_next" value="https://swapamc.com/swapproj/faq">
                            <textarea type="text" name="message" class="form-control" rows="5" placeholder="Write your feedback here" required></textarea>
                            <br>
                            <button class="btn" type="submit">Submit Feedback</button>
                            </form> 
                        </div>
                        <div class="modal-footer">
                                <input class="btn w-100 text-center" data-dismiss="modal" value="Close">
                        </div>
                    </div>
                </div>
            </div>
            <button class="feedbackbtn" data-toggle="modal" data-target="#feedback">Feedback on the website</button>
            
        </div>
        <div class="thing">
             <h1 class="useraccount"><spann>Who are we?</spann><br><img src="https://drive.google.com/uc?export=view&id=19HUPvXqVQGI5aKo4l1tiFzFZSyPKs3H8" width="200px" height="300px"><br><span>I cheated while playing the darts tournament by using a longbow.<br>While all her friends were positive that Mary had a sixth sense, she knew she actually had a seventh sense.<br>She wanted a pet platypus but ended up getting a duck and a ferret instead.<br>The fox in the tophat whispered into the ear of the rabbit.<br>David proudly graduated from high school top of his class at age 97.<br>Happiness can be found in the depths of chocolate pudding. <span>         </div>
         </div>
    </div>

    <div class='scroll'>
        <i class="fas fa-chevron-down" style='color:white'></i>



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
<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

    
    
   
</body>

</html>