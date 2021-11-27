<?php
//root is www.swapamc.com/swapproj/ . when you create a new route -> will be www.swapamc.com/swapproj/test

require_once __DIR__ . '/config/__init.php';
require_once __DIR__ . '/router/index.php';



$router = new Router();

//main page route handling
$router->get('/', 'index.html');

//login page route handling
$router->get('/login', 'login.php');
$router->get('/login?error=emptyinput', 'login.php');
$router->get('/login?error=wronglogin', 'login.php');
$router->get('/login?error=emptycaptcha', 'login.php');
$router->get('/login?error=badcaptcha', 'login.php');
$router->get('/login?error=goodcaptcha', 'login.php');

//login inc route handling
$router->post('/logininc', 'includes/login.inc.php');


//signup route handling
$router->get('/signup', 'signup.php');
$router->get('/signup?error=emptyinput', 'signup.php');
$router->get('/signup?error=invaliduid', 'signup.php');
$router->get('/signup?error=invalidemail', 'signup.php');
$router->get('/signup?error=passwordsdontmatch', 'signup.php');
$router->get('/signup?error=usernametaken', 'signup.php');
$router->get('/signup?error=none', 'signup.php');

//signup inc route handling
$router->post('/incsignup', 'includes/signup.inc.php');

//pre verification route handling
$router->get('/emailverification', 'phpmailer/emailotp.php');
$router->get('/emailverification?error=badotp', 'phpmailer/emailotp.php');

//pre verification inc route handling
$router->post('/emailverificationinc', 'includes/emailotp.inc.php');

//google auth route handling
$router->get('/googleauthentication', 'googleauth/googleauthotp.php');
$router->get('/googleauthentication?error=badotp', 'googleauth/googleauthotp.php');

//google auth inc route handling
$router->post('/googleauthenticationinc', 'includes/googleauth.inc.php');

//post login route handling
$router->get('/campus', 'campus.php');
$router->post('/logout', 'includes/logout.inc.php');
$router->get('/logout', 'includes/logout.inc.php');


$router->post('/check','includes/user_auth.php');


