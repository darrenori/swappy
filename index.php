<?php

require_once __DIR__ . '/config/__init.php';
require_once __DIR__ . '/router/index.php';



$router = new Router();

//main page route handling
$router->get('/', 'index.html');

//login page route handling
$router->get('/login', 'login.php');






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

