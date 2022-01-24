<?php
//root is www.swapamc.com/swapproj/ . when you create a new route -> will be www.swapamc.com/swapproj/test

require_once __DIR__ . '/config/__init.php';
require_once __DIR__ . '/router/index.php';



$router = new Router();

//main page route handling
$router->get('/', 'beforeloggedin.php');

//login page route handling
$router->get('/login', 'login.php');

//login inc route handling
$router->post('/logininc', 'includes/login.inc.php');


//signup route handling
$router->get('/signup', 'signup.php');


//signup inc route handling
$router->post('/incsignup', 'includes/signup.inc.php');

//pre verification route handling
$router->get('/emailverification', 'phpmailer/emailotp.php');

//pre verification inc route handling
$router->post('/emailverificationinc', 'includes/emailotp.inc.php');

//google auth route handling
$router->get('/googleauthentication', 'googleauth/googleauthotplogin.php');

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



$router->get('/allproducts/product/script','product/productfunctions.inc.php');

//addtoproduct
$router->post('/allproducts/product/addtocart','product/includes/addtocart.inc.php');

//viewcart
$router->get('/allproducts/product/viewcart','product/viewcart.php');


//editcart
$router->get('/allproducts/product/editcart','product/editcart.php');

//includes change
$router->post('/allproducts/product/changes','product/includes/editcart.inc.php');
$router->post('/allproducts/product/delete','product/includes/deletecart.inc.php');

//userprofile
$router->get('/userprofile','profile/userprofile.php');
$router->post('/userprofile','profile/userprofile.php');

//editprofile
$router->post('/updateprofile','profile/includes/updateprofile.inc.php');
$router->post('/deleteprofile','profile/includes/deleteprofile.inc.php');


//employeemanager
$router->get('/employeemanager','manager/allemployees.php');

//employee edit 
$router->get('/employeemanager/edit','manager/editemployees.php');
$router->post('/employeemanager/editinc','manager/includes/editemployees.inc.php');

//employee delete
$router->get('/employeemanager/delete','manager/deleteemployees.php');
$router->get('/employeemanager/deleteinc','manager/includes/deleteemployees.inc.php');

//employeeadd
$router->get('/employeemanager/adduser','manager/addemployees.php');
$router->post('/employeemanager/adduserinc','manager/includes/addemployees.inc.php');

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



$router->post('/addreview','reviews/includes/addreview.inc.php');
$router->post('/editreview','reviews/includes/editreview.inc.php');
$router->get('/deletereview','reviews/includes/deletereview.inc.php');

$router->post('/replyreview','reviews/includes/reply.inc.php');
$router->post('/likeordislike','reviews/includes/likeordislike.inc.php');







//checkout
$router->get('/checkout', 'checkoutpage/checkout.php');
$router->post('/checkout', 'checkoutpage/checkout.php');
$router->post('/checkoutinc', 'checkoutpage/includes/checkout.inc.php');

//view shippingaddress
$router->get('/checkout/viewshippingaddress', 'checkoutpage/viewshippingaddress.php');
$router->post('/checkout/viewshippingaddress', 'checkoutpage/viewshippingaddress.php');

//addshipping
$router->post('/checkout/addshippingaddressinc', 'checkoutpage/includes/addshipping.inc.php');
$router->get('/checkout/addshippingaddress', 'checkoutpage/addshippingaddress.php');

//editshipping
$router->get('/checkout/editshippingaddress', 'checkoutpage/editshippingaddress.php');

//includes file for shipping address
$router->post('/checkout/updatesa', 'checkoutpage/includes/updateshipping.inc.php');
$router->post('/checkout/deletesa', 'checkoutpage/includes/deleteshipping.inc.php');
$router->get('/checkout/defaultsa', 'checkoutpage/includes/defaultshipping.inc.php');

//after payment
$router->get('/checkout/success', 'checkoutpage/successpayment.php');

$router->post('/product/favorite','product/includes/favorite.inc.php');




###Zeph
//search and sort
$router->post('/searchinc', 'includes/search.inc.php');
$router->get('/searchinc', 'includes/search.inc.php');
$router->post('/sortinc', 'includes/sort.inc.php');
$router->get('/sortinc', 'includes/sort.inc.php');

//notifications
$router->get('/addnotification','notifications/addnotification.php');
$router->post('/addnotificationinc','notifications/includes/addnotification.inc.php');


$router->get('/viewnotifications','notifications/viewnotifications.php');
$router->get('/viewfavorites','product/viewfavorites.php');
$router->get('/viewpurchases','product/viewpurchases.php');







###Darren
//product amager
$router->get('/productmanager','prodmanager/productmanager.php');
$router->get('/productmanageradd','prodmanager/productmanageradd.php');
$router->get('/productmanagertypes','prodmanager/productmanagertypes.php');
$router->get('/productmanagervariant','prodmanager/productmanagervariant.php');
$router->get('/productmanageraddinventory','prodmanager/productmanageinventory.php');


//productmanagerinc
$router->post('/productmanageraddinc','prodmanager/includes/productmanageradd.inc.php');
$router->post('/productmanageraddtypes','prodmanager/includes/productmanagertype.inc.php');
$router->post('/productmanageraddvariants','prodmanager/includes/productmanagervariant.inc.php');
$router->post('/productmanageraddall','prodmanager/includes/productmanagerall.inc.php');


$router->get('/productmanager/editproduct','prodmanager/editproduct.php');
$router->post('/productmanager/editproductinc','prodmanager/includes/editproduct.inc.php');
$router->get('/productmanager/deleteproductinc','prodmanager/includes/deleteproduct.inc.php');




//forgetpassword
$router->get('/forgetpassword','forgetpass/inputemail.php');
$router->post('/forgetpasswordinc','forgetpass/includes/inputemail.inc.php');

$router->get('/forgetpassword/resetpassword','forgetpass/resetpass.php');
$router->post('/forgetpassword/resetpasswordinc','forgetpass/includes/resetpass.inc.php');


//home
$router->get('/home','home/home.php');
//faq
$router->get('/faq','faq/faq.php');
$router->get('/faq/banned','faq/banned.php');
$router->get('/faq/whoarewe','faq/whoarewe.php');
$router->get('/faq/employee','faq/employee.php');


$router->get('/viewtask','viewtasks/task.php');

$router->post('/updatestatus','viewtasks/updatestatus.inc.php');


###zeph
//store amager
$router->get('/storemanageradd','storemanager/storemanageradd.php');
$router->get('/storemanage','storemanager/storemanager.php');
$router->get('/storemanager/editstore','storemanager/editstore.php');


//storemanagerinc
$router->post('/storemanageraddinc','storemanager/includes/storemanageradd.inc.php');
$router->post('/storemanageraddall','storemanager/includes/storemanagerall.inc.php');

$router->post('/storemanager/editstoreinc','storemanager/includes/editstore.inc.php');
$router->get('/storemanager/deletestoreinc','storemanager/includes/deletestore.inc.php');






//logs

$router->get('/adminlogs','admin/adminlogs.php');
$router->get('/downloadlogs','admin/download.php');


//attendance
$router->get('/attendanced','attendance/attendance.php');
$router->post('/attendanced','attendance/includes/attendance.php');


//attendance
$router->get('/attendance','attendancepage/attendance.php');
$router->post('/attendanceinc','attendancepage/includes/attendance.inc.php');

$router->get('/attendance/editattendance','attendancepage/editattendance.php');
$router->post('/attendance/editattendanceinc','attendancepage/includes/editattendance.inc.php');

$router->get('/attendance/takeleave','attendancepage/takeleave.php');
$router->post('/attendance/takeleaveinc','attendancepage/includes/takeleave.inc.php');

$router->get('/attendance/editleave','attendancepage/editleave.php');
$router->post('/attendance/editleaveinc','attendancepage/includes/editleave.inc.php');

$router->get('/attendance/calculatepay','attendancepage/includes/calculatepay.inc.php');
$router->get('/attendance/editemployee','attendancepage/editemployee.php');


$router->get('/test','test.php');