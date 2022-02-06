<style>

@import url('https://fonts.googleapis.com/css2?family=Montserrat&display=swap');
@import url('https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Montserrat:wght@500&display=swap');

*{
    margin:0;
    padding:0;
    
    color:white;
}
body {
    background:black;
    font-family:Montserrat;
}

html, body {
max-width: 100%;
overflow-x: hidden;
}

.top {
    margin: 120px 45px;
    margin-top: 0px;
    
    display: flex;
    flex-wrap: wrap;
    flex-direction: row;
    justify-content: space-between;
    /* width: 100%; */
    /* background-color: rgba(255, 255, 255, 0.3); */
}


.left {
    display: flex;
    padding: 20px 0px;
    flex-wrap: wrap;
    flex-basis: 35%;    
    /* background-color: gainsboro; */
}

.right {
    flex-basis: 55%;
    border-left: 2px solid white;
    /* display: flex; */
    flex-wrap: wrap;
    margin:0;
    padding: 20px 10px;
    padding-left: 20px;
    align-items: flex-start;
    justify-content: flex-start;
    flex-direction: row;


}


.tags {
    font-weight: bold;
    /* margin-bottom: 20px; */
    margin-top: 10px;
}

.tagsheader {
    flex-basis: 100%;
    color: white;
    margin-bottom: 10px;

}

.tagsbtn {
    color: white;
    border:0;
    padding: 12px 65px;
    background-color: #8D1D25;
    margin-right: 20px;
    border-radius: 3px;
    font-weight: bold;
}

.extrainfo {
    display: flex;
    flex-wrap: wrap;
    flex-basis: 100%;
}

.extrainforow {
    font-weight: bold;
    flex-basis: 100%;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    margin-bottom: 25px;
    font-size: 1em;
    align-items: center;
}

.tk {
    color:#8D1D25;
    font-size: 2em;
    
}



.right .tpamc {
    color: #E26565;
    flex-basis: 100%;
    font-weight: 100;


}


.right .prodname {
    flex-basis: 100%;
}

.right .price {
    margin-top: 30px;
    color: white;

}

.refunds,.details {
    margin-top: 30px;
    flex-basis: 100%;
    display: flex;
    flex-wrap: wrap;
}

.refundsheader,.detailsheader {
    color: #E26565;
    flex-basis: 100%;
    font-weight: bold;
}

.refundsbody,.detailsbody {
    color: white;
    opacity: 0.8;
}


.typescontainer {
    margin-top: 10px;
}

.typename {
    font-weight: bold;
    color: #E26565;
}

.typerow {
    /* display: flex; */
    flex-basis: 100%;
    flex-wrap: wrap;
    /* margin-bottom: 50px; */
}

.variants {
    display: flex;
    flex-wrap: wrap;
    flex-direction: row;
    justify-content: flex-start;
}

.donate-now {
  list-style-type: none;

  /* margin: 25px 0 0 0;
  padding: 0; */
}



.donate-now li {
  float: left;
  /* margin: 0 5px 0 0; */
  
  margin-right: 10px;
  /* width: 100%; */
  /* height: 40px; */
  /* position: relative; */
  
}

label {
    width: 100%;
    padding: 30px 20px;
    
}

.donate-now label,
.donate-now input {
  display: block;
  /* position: absolute; */
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
}

.donate-now input[type="radio"] {
  opacity: 0.01;
  z-index: 100;
}

.donate-now input[type="radio"]:checked+label,
.Checked+label {
  background: white;
  color: black;
}

.donate-now label {
  padding: 12px 20px;
  /* margin: 5px; */
  border: 1px solid #CCC;
  cursor: pointer;
  z-index: 90;
  text-align: center;
  font-weight: bold;
}

.donate-now label:hover {
  background: #DDD;
  color: black;
}

.cont {
    flex-basis: 100%;
}

.quantityheader {
    font-weight: bold;
    color: #E26565;
    margin-bottom: 10px;
}

.quantity-control {
  flex-basis: 100%;
  display: flex;
  align-items: center;
  justify-content: space-between;
  /* width: fit-content; */
  /* margin: 0 auto; */
  background: #eaeaea;
  border-radius: 3px;
  padding: 1rem 0.4rem;
  /* margin-top: 4rem; */
}

.quantity-btn {
  background: transparent;
  border: none;
  outline: none;
  margin: 0;
  padding: 0px 8px;
  cursor: pointer;
}
.quantity-btn svg {
  width: 15px;
  height: 15px;
}
.quantity-input {
    color: black;
  outline: none;
  user-select: none;
  text-align: center;
  width: 47px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: transparent;
  border: none;
}
.quantity-input::-webkit-inner-spin-button,
.quantity-input::-webkit-outer-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

.lastpart {
    margin-top: 50px;
    flex-basis: 100%;
    flex-wrap: wrap;
    display: flex;
}

.totaloverall {
    flex-basis: 100%;

}

.lastpartbuttons {
    margin-top: 30px;
    flex-basis: 100%;
    display: flex;
    flex-wrap: wrap;
    flex-direction: row;
    justify-content: space-between;
}

.addtocart {
    background-color: #E26565;   
    padding: 21px 0px;
    border:0;
    flex-basis: 90%;
    cursor: pointer;

}

.favoritebtn {
    flex-basis: 8%;
    padding: 20px 0px;
    border: 1px solid white;
    background-color: transparent;
    transition: all .5s;

}


.afterfavoritebtn {
    flex-basis: 8%;
    padding: 20px 0px;
    border: 1px solid white;
    cursor: pointer;
    background-color: #8D1D25;
    transition: all .5s;

}



.addreview {
    margin: 120px 45px;
    margin-bottom: 30px;
    
    display: flex;
    flex-wrap: wrap;
    flex-direction: row;
    justify-content: space-between;
    /* width: 100%; */
    background-color: rgba(255, 255, 255, 0.3);
    padding: 20px;
    border-radius: 3px;
}

.addareview,.productimageadd {
    flex-basis: 100%;
    color: #E26565;
    margin-bottom: 30px;

}


.ratingreviewheader {
    
    color: white;
    font-weight: lighter;
    flex-basis: 100%;   
}

.number {
    flex-basis: 100%;
    color: black;
    font-weight: 200;
    padding: 5px;
    margin-bottom: 30px;
}

.addreivewtextarea {
    height: 100px;
    background-color: rgba(0, 0, 0, 0.7);
    border: 0;
    color: white;
    padding: 7px;
    margin-bottom: 30px;
    border-radius: 5px;
}

.addreviewbtn {
    background-color: #E26565;
    padding: 10px 30px;
    border: 0;
    color: black;
}

.allreviews {
    margin: 60px 45px;
    display: flex;
    flex-wrap: wrap;
    flex-direction: row;
    padding: 20px;

    background-color: rgba(255, 255, 255, 0.3);
    border-radius: 3px;

    
}

.numberofreviews {
    flex-basis: 100%;


    border-bottom: 1px solid white;
    padding-bottom: 10px;
    margin-bottom: 30px;
}

.parentsectionreviews {
    display: flex;
    flex-wrap: wrap;
    flex-direction: row;
    width: max-content;
    
    width: 100%;
    margin-bottom: 50px;
    flex-basis: 100%;

}

/* form {
    width: fit-content;
    
} */

.circle {
    width: 6vw;
    height: 6vw;
    
    background-color:green;
    border-radius: 50%;
    display: inline-block;
    background-position: center;
        background-size: cover;
        /* background-image: black; */

}

.parentleft {
    /* flex-basis: 1%; */
    

}

.parentright {
    flex-basis: 90%;
    
    margin-left: 10px;
    width: 100%;
    padding-bottom: 20px;
}



.reviewsrating {
    display: flex;
    flex-wrap: wrap;
    flex-basis: 100%;
    /* margin-bottom: 5px; */
    margin-top: 5px;
}

.reviewdetails {
    /* width: 100%; */
    color: white;
    flex-basis: 70%;
    max-width: 80%;
    overflow: auto;
    padding: 5px 0px;
    /* margin-bottom: 5px; */
    word-wrap: break-word;
    margin-bottom: 0;
}

.imagescontainer {
    display: flex;
    flex-wrap: wrap;
    margin-bottom: 10px;
    
}


.picturesreview {
    width: 15vw;
    height: 15vw;
    background-color: white;
    margin-right: 10px;
    background-position: center;
        background-size: cover;
    
}

.date {
    flex-basis: 100%;
    margin-bottom: 10px;
}

.like {
    border-right: 1px solid white;
    padding-right: 20px;
    margin-right: 20px;
    
}

.replybtn {
    
    flex-basis: 100%;
    color: #E26565;
    margin-top: 30px;
    font-size: 1.2em;
}


.usernamereviewcontainer {
    flex-basis: 100%;
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    width: 100%;
}

.btn {
    justify-self: flex-end;
}











.inptdesign {
    color:white;
    padding: 8px 15px;
    padding-left: 6px;
    background-color: rgba(0, 0, 0, 0.7);
    border: 0;
    border-radius: 3px;
    margin-bottom: 5px;
}

.inptdesignbtn {
    background-color: #8D1D25;
    border: 0;
    color: white;
    margin-top: 10px;
    padding: 10px 20px;
    border-radius: 3px;
}



/* kebab */
/***
Bootstrap dropdown container fix
for Bootstrap 4 and Material Design Bootstrap
Hint : Move out the button or the link declaring the data-toggle="dropdwn" from the .dropdown div
Created a dropdown-sm class for smaller dropdowns when using kebabs
***/

/***
	Bootstrap dropdown container fix
	for Bootstrap 4 and Material Design Bootstrap
	Hint : Move out the button or the link declaring the data-toggle="dropdwn" from the .dropdown div
	Created a dropdown-sm class for smaller dropdowns when using kebabs
***/

.dropdown-menu.dropdown-unroll {
    transition: none;
}

.kebab-link i {
    font-size: 1.5rem;
}

.kebab-link i:active,
.kebab-link i:hover {
    color: #4285F4;
}


/*Try to delete this setting and you'll see the problem*/

.kebab-dropdown {
    position: relative;
}


/* material design for dropdown */

.dropdown-sm>.dropdown-menu>.dropdown-item {
    padding: 5px;
    margin-left: 0;
}

.dropdown-menu>.dropdown-item {
    padding: 1rem;
    margin-left: 0;
}

.dropdown-menu>.dropdown-item:hover {
    box-shadow: 0 8px 17px 0 rgba(0, 0, 0, .2), 0 6px 20px 0 rgba(0, 0, 0, .19);
    color: white;
    background: #4285F4;
}


/***
	Bootstrap 4 Collapse Accordion full width clickable
	from Jacob Lett : http://codepen.io/JacobLett/pen/GWqjPw 
	with Material Design Bootstrap
	enhenced by djibe
	Just add the collapse-accordion class to the div wearing the role="tablist"
 ***/

.collapse-accordion>.card a[data-toggle=collapse] {
    display: block;
    padding: .75rem 1.25rem;
}

.collapse-accordion>.card a[data-toggle=collapse]:after {
    /* symbol for "opening" panels */
    font-family: FontAwesome;
    font-size: .9rem;
    content: "\f077";
    /* adjust as needed, taken from bootstrap.css */
    float: right;
    /* adjust as needed */
    vertical-align: middle;
    color: grey;
    /* adjust as needed */
    transition: all .5s linear;
    margin-right: 5%;
}

.collapse-accordion>.card a[data-toggle=collapse].collapsed:after {
    content: "\f078";
}

.collapse-accordion>.card>.card-header {
    padding: 0;
}


.kea {
    position: relative;
    
}

.childreview {
    margin-left: 6vw;
    flex-basis: 100%;
}

.childright {
    margin-left: 10px;
    width: 89.3%;
    /* flex-basis: 100%; */
    /* width: 100%; */
    /* display: flex;
    flex-wrap: wrap; */
    /* align-self: flex-end; */
    

}
/* kebabend */
</style>