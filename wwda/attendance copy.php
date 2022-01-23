<html>
<link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
<style type="text/css">
    *{
        margin:0;
        padding:0;
        font-family:Montserrat;
    }
    body {
        background: rgb(2,0,36);
        background: linear-gradient(180deg, rgba(2,0,36,1) 0%, rgba(141,29,37,1) 100%, rgba(0,212,255,1) 100%);
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

.container {
	align-items:flex-start;
	display: flex;
	height: 110%;
	justify-content: center;
	margin: 0 auto;
    margin-left: 1vw;
	max-width: 600px;
	width: 100%;
}
 
.con{
    background-color: rgba(255,255,255,0.3);
	border-radius: 4px;
	box-shadow: 0 5px 20px rgba(0, 0, 0, .3);
	align-items:flex-start;
	display: flex;
	height: 74%;
	justify-content: left;
	margin: 0 auto;
    margin-left: 36vw;
    margin-top: -110vh;
	max-width: 857px;
	width: 110%;
}

.con h1{
    color: white;
    font-weight: 300;
    padding-left: 1vw;
    padding-top:2vh;
}

.con h1 span{
    font-weight: bold;
}

.banner{
    font-weight: bold;
    color: white;
    justify-content: center;
    background-color: #E26565;
    margin-top: 45vh;
    margin-left:-13vw;
    border-left: 15px solid #8D1D25;
    width: 50vw;
    height:10vh;
}

.calendar {
	background-color: rgba(255,255,255,0.3);
	border-radius: 4px;
	box-shadow: 0 5px 20px rgba(0, 0, 0, .3);
	height: 550px;
  perspective: 1000;
	transition: .9s;
	transform-style: preserve-3d;
	width: 70%;
}

/* Front - Calendar */
.front {
	transform: rotateY(0deg);
}

.current-date {
	border-bottom: 1px solid rgba(73, 114, 133, .6);
	display: flex;
	justify-content: space-between;
	padding: 30px 40px;
}
.fyi{
	display: flex;
	justify-content: space-between;
	padding: 20px 40px;
}
.fyi h4{
    color: #dfebed;
	font-size: 1em;
	font-weight: 300;
}
.current-date h1 {
	color: #dfebed;
	font-size: 1.4em;
	font-weight: 300;
}

.week-days {
	color: #dfebed;
	display: flex;
	justify-content: space-between;
	font-weight: 600;
	padding: 30px 40px;
}

.days {
	display: flex;
	flex-wrap: wrap;
	justify-content: space-between;
}

.weeks {
	color: #fff;
	display: flex;
	flex-direction: column;
	padding: 0 40px;
}

.weeks div {
	display: flex;
	font-size: 1.2em;
	font-weight: 300;
	justify-content: space-between;
	margin-bottom: 20px;
	width: 100%;
}

.last-month {
	opacity: .3;
}

.weeks span {
	padding: 10px;
}

.weeks span.active {
	background: #E26565;
	border-radius: 100%;
}

.weeks span:not(.last-month):hover {
	cursor: pointer;
	font-weight: 600;
}

/* Back - Event form */

.back {
	height: 100%;
	transform: rotateY(180deg);
}

.back input {
	background: none;
	border: none;
	border-bottom: 1px solid rgba(73, 114, 133, .6);
	color: #dfebed;
	font-size: 1.4em;
	font-weight: 300;
	padding: 30px 40px;
	width: 100%;
}

.info {
	color: #dfebed;
	display: flex;
	flex-direction: column;
	font-weight: 600;
	font-size: 1.2em;
	padding: 30px 40px;
}

.info div:not(.observations) {
	margin-bottom: 40px;
}

.info span {
	font-weight: 300;
}

.info .date {
	display: flex;
	justify-content: space-between;
}

.info .date p {
	width: 50%;
}

.info .address p {
	width: 100%;
}

.actions {
	bottom: 0;
	border-top: 1px solid rgba(73, 114, 133, .6);
	display: flex;
	justify-content: space-between;
	position: absolute;
	width: 100%;
}

.actions button {
	background: none;
	border: 0;
	color: #fff;
	font-weight: 600;
	letter-spacing: 3px;
	margin: 0;
	padding: 30px 0;
	text-transform: uppercase;
	width: 50%;
}

.actions button:first-of-type {
	border-right: 1px solid rgba(73, 114, 133, .6);
}

.actions button:hover {
	background: #497285;
	cursor: pointer;
}

.actions button:active {
	background: #5889a0;
	outline: none;
}

/* Flip animation */

.flip {
  transform: rotateY(180deg);
}

.front, .back {
	backface-visibility: hidden;
}
.shape{
    background-color: #E26565;
	border-radius: 100%;
    width: 12px;
    height: 12px;
    margin-left: 1.3vw;
    margin-top:-5vh;
}
.styled-table {
    border-collapse: collapse;
    margin-left:6.5vw;
    font-size: 0.9em;
    min-width: 400px;
    width: 86%;
    font-weight: bold;
    box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
}   

.styled-table thead tr {
    background-color: #E26565;
    text-align: left;
}

.styled-table th,
.styled-table td {
    padding: 12px 15px;
}

.styled-table tbody tr {
    border-bottom: 1px solid #E26565;
}

.styled-table tbody tr:nth-of-type(odd) {
    background-color:white;
    color: black;
}

.styled-table tbody tr:nth-of-type(even) {
    background-color:darkgray;
    color: white;
}

.styled-table tbody tr:last-of-type {
    border-bottom: 2px solid #E26565;
}

</style>


<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
         integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
<head>
<script>
    
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
            <a href="#"><li>HOME</li></a>
            <a href="#"><li>FAQs</li></a>
            <a href="#"><li>PRODUCTS</li></a>
            
            
        </ul>
        <button type="button" class="btn">SIGN UP</button>
    </div>
    <i class="fas fa-bars menu-icon" onclick="showMenu()" style="color:white"></i>
    
</div>

<div class="container">
      <div class="calendar">
        <div class="front">
          <div class="current-date">
            <h1>February 2022</h1>	
          </div>

          <div class="current-month">
            <ul class="week-days">
              <li>SUN</li>
              <li>MON</li>
              <li>TUE</li>
              <li>WED</li>
              <li>THU</li>
              <li>FRI</li>
              <li>SAT</li>
            </ul>

            <div class="weeks">
              <div class="first">
                <span class="last-month">30</span>
                <span class="last-month">31</span>
                <span>01</span>
                <span>02</span>
                <span>03</span>
                <span>04</span>
                <span>05</span>
              </div>

              <div class="second">
                <span>06</span>
                <span>07</span>
                <span>08</span>
                <span>09</span>
                <span>10</span>
                <span>11</span>
                <span>12</span>
              </div>

              <div class="third">
                <span>13</span>
                <span>14</span>
                <span>15</span>
                <span>16</span>
                <span>17</span>
                <span>18</span>
                <span>19</span>
              </div>

              <div class="fourth">
                <span>20</span>
                <span>21</span>
                <span>22</span>
                <span>23</span>
                <span>24</span>
                <span>25</span>
                <span>26</span>
              </div>

              <div class="fifth">
                <span>26</span>
                <span>27</span>
                <span>28</span>
                <span class="last-month">01</span>
                <span class="last-month">02</span>
                <span class="last-month">03</span>
                <span class="last-month">04</span>
              </div>
            </div>
            <div class="fyi">
              <h4>On Leave / Valid Abscence</h4>
            </div>
            <div class="shape"></div>
          </div>
        </div>

      </div>
    </div>
    <div class="con">
        <h1>Date<span>&nbsp;testing</span>&nbsp;| 0900 Hours</h1>
        <div style="margin-top:6vw; margin-left:-26.5vw;">
            <button type="submit" value="" style="cursor:pointer; border:#E26565;  width:200px; height:50px; border-radius:100px; background-color:#5681BB; color:white;">Check in</button>
           <br><br>
            <button type="submit" value="" style="cursor:pointer; border:#E26565;  width:200px; height:50px; border-radius:100px; background-color:#E26565; color:white;">Take Leave</button>
        </div>
        <div class="banner">
        Do not fake your attendance.<br>Serious actions will be taken against those who do.
        </div>
    </div>
</div><br>
<h1 style="font-weight: 300; margin-left:6.6vw; color:white">Past Attendance</h1><br>
<table class="styled-table">
    <thead>
        <tr>
            <th>Date</th>
            <th>Check in Time</th>
            <th>Clock out Time</th>
            <th>Break</th>
            <th>Status</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Example</td>
            <td>Example</td>
            <td>Example</td>
            <td>Example</td>
            <td>Example</td>
        </tr>
        <tr>
            <td>Example</td>
            <td>Example</td>
            <td>Example</td>
            <td>Example</td>
            <td>Example</td>     
        </tr>
        <tr>
            <td>Example</td>
            <td>Example</td>
            <td>Example</td>
            <td>Example</td>
            <td>Example</td>     
        </tr>
        <tr>
            <td>Example</td>
            <td>Example</td>
            <td>Example</td>
            <td>Example</td>
            <td>Example</td>     
        </tr>
        <tr>
            <td>Example</td>
            <td>Example</td>
            <td>Example</td>
            <td>Example</td>
            <td>Example</td>     
        </tr>
        <!-- and so on... -->
    </tbody>
</table><br>

    


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

        

        


        

        

        



<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>



    

   
</body>

</html>