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
	height: 64%;
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
    margin-left:-15vw;
    border-left: 15px solid #8D1D25;
    width: 50vw;
    height:10vh;
}


.wrapper {
    display: flex;
    }
    .calendar {
    border-radius: 4px;
    margin: auto;
    width: 450px;
    color: #fff;
    background-color: rgba(255,255,255,0.3);;
    box-shadow: 0px 0px 15px 4px rgba(0, 0, 0, 0.2);
   
    }
    .month {
    display: flex;
    justify-content: space-between;
    align-items: center;
    width: 86.5%;
    padding: 40px 30px;
    text-align: center;
    background-color: #E26565;
    color: #fff;
    }
    .weekdays {
    background-color: #E26565;
    color: #fff;
    padding: 7px 0;
    display: flex;
    }
    .days {
    font-weight: 300;
    padding: 10px 0;
    display: flex;
    flex-wrap: wrap;
    }
    .weekdays div,
    .days div {
    text-align: center;
    width: 14.28%;
    }
    .days div {
    padding: 10px 0;
    margin-bottom: 10px;
    transition: all 0.4s;
    }
    .prev_date {
    color: #999;
    }
    .today {
    background-color: #E26565;
    color: #fff;
    }
    .days div:hover {
    cursor: pointer;
    background-color: #dfe6e9
    }
    .prev,
    .next {
    display: flex;
    justify-content: center;
    align-items: center;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    font-size: 23px;
    background-color: rgba(0, 0, 0, 0.1);
    transition: all 0.4s;
    }
    .prev:hover,
    .next:hover {
    cursor: pointer;
    background-color: rgba(0, 0, 0, 0.2);
    }
    #month {
    font-size: 30px;
    font-weight: 500;}

    .shape{
    background-color: #E26565;
	border-radius: 100%;
    width: 12px;
    height: 12px;
    margin-left: 1.3vw;
    margin-top:-5vh;
}
/*Table Styles*/
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
     var dt = new Date();
 function renderDate() {
 dt.setDate(1);
 var day = dt.getDay();
 var today = new Date();
 var endDate = new Date(
 dt.getFullYear(),
 dt.getMonth() + 1,
 0
 ).getDate();
 var prevDate = new Date(
 dt.getFullYear(),
 dt.getMonth(),
 0
 ).getDate();
 var months = [
 "January",
 "February",
 "March",
 "April",
 "May",
 "June",
 "July",
 "August",
 "September",
 "October",
 "November",
 "December"
 ]
 document.getElementById("month").innerHTML =
months[dt.getMonth()];
 document.getElementById("date_str").innerHTML =
dt.toDateString();
 var cells = "";
 for (x = day; x > 0; x--) {
 cells += "<div class='prev_date'>" + (prevDate - x +
1) + "</div>";
 }
 console.log(day);
 for (i = 1; i <= endDate; i++) {
 if (i == today.getDate() && dt.getMonth() ==
today.getMonth()) cells += "<div class='today'>" + i + "</div>";
 else
 cells += "<div>" + i + "</div>";
 }
 document.getElementsByClassName("days")[0].innerHTML =
cells;
 }
 function moveDate(para) {
 if(para == "prev") {
 dt.setMonth(dt.getMonth() - 1);
 } else if(para == 'next') {
 dt.setMonth(dt.getMonth() + 1);
 }
 renderDate();
 }
</script>
<script>
 function change() 
{
    var elem = document.getElementById("clock");
    if (elem.value=="Check in") elem.value = "Check out", elem.style.backgroundColor="#8D1D25", alert("Sucessfully Checked In!");
    else if (elem.value=="Check out") elem.value = "Check in",elem.style.backgroundColor="#5681BB",alert("Sucessfully Checked Out!");
    else elem.value = "Check in",elem.style.backgroundColor="#5681BB";
}
    </script>
</head>
<body onload="renderDate()">


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
<div class="wrapper">
        <div class="calendar">
            <div class="month">
                <div class="prev" onclick="moveDate('prev')">
                    <span>&#10094;</span>
                </div>
                <h2 id="month"></h2>
                <p id="date_str"></p>
                <div class="next" onclick="moveDate('next')">
                    <span>&#10095;</span>
                </div>
            </div>
            <div class="weekdays">
                <div>Sun</div>
                <div>Mon</div>
                <div>Tue</div>
                <div>Wed</div>
                <div>Thu</div>
                <div>Fri</div>
                <div>Sat</div>

            </div>
            <div class="days"></div>
        </div>
    </div>
    </div>
    <div class="con">
        <h1>Take Attendance</h1>
        <br><br>
        <div style="margin-top:6vw; margin-left:-16.5vw;">
        <form action="attendanceinc" method="POST">
            <input type="text" name="name" placeholder="Name" /><br><br>
            <input id="date" type="datetime-local" name="date" value=""><br><br>
            <input type="button" onclick="change()"  id="clock" type="submit" value="Check in" style="cursor:pointer; border:#E26565;  width:200px; height:50px; border-radius:100px; background-color:#5681BB; color:white;"></input>
        </form>
           <br>
            <input type="submit" value="Take leave" style="cursor:pointer; border:#E26565;  width:200px; height:50px; border-radius:100px; background-color:#E26565; color:white;"></input>
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