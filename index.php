<?php
//root is www.swapamc.com/swapproj/ . when you create a new route -> will be www.swapamc.com/swapproj/test

require_once __DIR__ . '/config/__init.php';
require_once __DIR__ . '/router/index.php';



$router = new Router();

//main page route handling
$router->get('/', 'index.html');

//login page route handling
$router->get('/login', 'login.php');
// $router->get('/login?error=emptyinput', 'login.php');
// $router->get('/login?error=wronglogin', 'login.php');

// //login inc route handling
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

//post login route handling
$router->get('/campus', 'campus.php');

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
