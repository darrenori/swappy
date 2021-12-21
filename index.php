<?php
//root is www.swapamc.com/swapproj/ . when you create a new route -> will be www.swapamc.com/swapproj/test

require_once __DIR__ . '/config/__init.php';
require_once __DIR__ . '/router/index.php';



$router = new Router();

//main page route handling
$router->get('/', 'beforeloggedin.php');

//login page route handling
$router->get('/login', 'login.php');
// $router->get('/login?error=emptyinput', 'login.php');
// $router->get('/login?error=wronglogin', 'login.php');
// $router->get('/login?error=emptycaptcha', 'login.php');
// $router->get('/login?error=badcaptcha', 'login.php');
// $router->get('/login?error=goodcaptcha', 'login.php');

//login inc route handling
$router->post('/logininc', 'includes/login.inc.php');


//signup route handling
$router->get('/signup', 'signup.php');
// $router->get('/signup?error=emptyinput', 'signup.php');
// $router->get('/signup?error=invaliduid', 'signup.php');
// $router->get('/signup?error=invalidemail', 'signup.php');
// $router->get('/signup?error=passwordsdontmatch', 'signup.php');
// $router->get('/signup?error=usernametaken', 'signup.php');
// $router->get('/signup?error=none', 'signup.php');

//signup inc route handling
$router->post('/incsignup', 'includes/signup.inc.php');

//pre verification route handling
$router->get('/emailverification', 'phpmailer/emailotp.php');
$router->get('/emailverification?error=badotp', 'phpmailer/emailotp.php');

//pre verification inc route handling
$router->post('/emailverificationinc', 'includes/emailotp.inc.php');

//google auth route handling
$router->get('/googleauthentication', 'googleauth/googleauthotplogin.php');
// $router->get('/googleauthenticationimp', 'googleauth/googleauthotp.php');
// $router->get('/googleauthentication?error=badotp', 'googleauth/googleauthotplogin.php');

//google auth inc route handling
$router->post('/googleauthenticationinc', 'includes/googleauth.inc.php');

//post login route handling
$router->get('/campus', 'campus.php');
$router->post('/logout', 'includes/logout.inc.php');
$router->get('/logout', 'includes/logout.inc.php');


$router->post('/check','includes/user_auth.php');











//store route
$router->get('/allstores','store/allstores.php');
$router->get('/allstores/store','store/store.php');

//product route
$router->get('/allproducts','product/allproducts.php');
$router->get('/allproducts/product','product/product.php');



$router->get('/allproducts/product/script','product/product.function.js');

//addtoproduct
$router->post('/allproducts/product/addtocart','product/addtocart.php');

//viewcart
$router->get('/allproducts/product/viewcart','product/viewcart.php');


//editcart
$router->get('/allproducts/product/editcart','product/editcart.php');

//includes change
$router->post('/allproducts/product/changes','product/includes/change.php');
$router->post('/allproducts/product/delete','product/includes/delete.php');

//userprofile
$router->get('/userprofile','profile/userprofile.php');
$router->post('/userprofile','profile/userprofile.php');

//editprofile
$router->post('/updateprofile','profile/updateprofile.php');
$router->post('/deleteprofile','profile/deleteprofile.php');


//employeemanager
$router->get('/employeemanager','manager/allemployees.php');

//employee edit 
$router->get('/employeemanager/edit','manager/editemployees.php');
$router->post('/employeemanager/editinc','manager/includes/edit.inc.php');

//employee delete
$router->get('/employeemanager/delete','manager/deleteemployees.php');
$router->get('/employeemanager/deleteinc','manager/includes/delete.inc.php');

//employeeadd
$router->get('/employeemanager/adduser','manager/addemployees.php');
$router->post('/employeemanager/adduserinc','manager/includes/add.inc.php');

//taskview
$router->get('/employeemanager/taskmanager','tasks/alltasks.php');
$router->post('/employeemanager/taskmanager','tasks/alltasks.php');

//taskadd
$router->get('/employeemanager/taskmanager/addtask','tasks/addtasks.php');
$router->post('/employeemanager/taskmanager','tasks/alltasks.php');

$router->post('/employeemanager/taskmanager/addtaskinc','tasks/includes/addtasks.inc.php');

//taskedit
$router->get('/employeemanager/taskmanager/edittask','tasks/edittasks.php');
$router->post('/employeemanager/taskmanager/edittaskinc','tasks/includes/edittasks.inc.php');

//taskdelete
$router->get('/employeemanager/taskmanager/deletetask','tasks/includes/deletetasks.inc.php');

$router->get('/pages','auth/pages.php');


//check quantity left
$router->post('/checkquantity','product/includes/checkproduct.inc.php');

//image
$router->get('/image','images/showimage.php');










// class Pictures {
//     function __construct() {

//     }

//     function display($name){
//         require_once __DIR__ . '/config/__init.php';
//         require_once __DIR__ . '/router/index.php';



//         $router = new Router();
//         $route = '/images' . '/' . $name;
//         $actual = 'images/' . $name;

//         $router->pictures($route,$actual);

//     }


// }