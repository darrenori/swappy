<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
         integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
<head>


</head>

<style>
    <style type="text/css">
    *{
        margin:0;
        padding:0;
        font-family:sans-serif;
    }
    body {
        background:black;
        overflow:hidden;
        cursor:none;
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
</style>

<div class='nav-bar'>
    <div class='nav-logo'>
        <img src="https://drive.google.com/uc?export=view&id=1sDaIqkxjzSkJAbI0nhS-gd2Roe3VlHXL" class='logo'>
        
    </div>
    <div class='nav-links' id='nav-links'>
        <i class="fas fa-arrow-circle-left" onclick="closeMenu()" style="color:white"></i>
        <ul>
            <a href="#"><li>HOME</li></a>
            <a href="https://www.swapamc.com/swapproj/faq/"><li>FAQs</li></a>
            <a href="#"><li>PRODUCTS</li></a>
            
            
        </ul>
        <button onclick="location.href = 'https://www.swapamc.com/swapproj/login'" type="button" class="btn">LOGIN</button>
    </div>
    <i class="fas fa-bars menu-icon" onclick="showMenu()" style="color:white"></i>
    
</div>