<html>
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
         integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</html>


<?php
ob_start();
// require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/user_auth.php';
// require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
// require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/auth/pages.php';
// require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/navbar.php';

require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/images/showimage.php';
        

?>

<?php
require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/manager/includes/employeefunctions.inc.php';


$userid = $jwtarrayinformation['userid'];

//add
try {
    $query = $conn->prepare("SELECT mydb.products.product_id,product_name,product_price,product_about,product_picone FROM mydb.usersfavorite
    INNER JOIN mydb.products
    ON mydb.products.product_id = mydb.usersfavorite.product_id WHERE user_id = ?;");
    $query->bind_param('s', $userid);
    if ($query === false) {
        //change filename accordingly
        throw new Exception("Statement Preparation failed(viewnotification)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    header("location: https://www.swapamc.com/swapproj/campus?error=statement");
    exit;
}

// throws error "Statment Execution failed" when statement fails
try {
    $execute = $query->execute();
    if ($execute === false) {
        throw new Exception("Statement Execution failed (viewnotification)");
    }
} catch (Exception $e) {
    echo 'Message: ' . $e->getMessage();
    header("location: https://www.swapamc.com/swapproj/campus?error=statement");
    exit;
}



?>







<?php


$query->bind_result($productid, $productname, $productprice, $productabout, $productpicone);


echo "<div class='container5'>";
echo "<div class='header5'><p class='static5'>Favorites</p><svg xmlns='http://www.w3.org/2000/svg'  viewBox='0 0 900.606 220.024'>
    <g id='Group_265' data-name='Group 265' transform='translate(-15677.513 -4872.09)'>
    <path id='Path_699' data-name='Path 699' d='M485.157,675.139a6.056,6.056,0,0,1,.139-7.841c.193-.218.54.072.347.29a5.608,5.608,0,0,0-.114,7.294C485.714,675.105,485.341,675.361,485.157,675.139Z' transform='translate(15266.723 4390.927)' fill='#fff'/>
    <path id='Path_700' data-name='Path 700' d='M473.088,707.785a11.673,11.673,0,0,0,8.21-2.229c.234-.174.491.2.257.371a12.142,12.142,0,0,1-8.548,2.3C472.718,708.2,472.8,707.753,473.088,707.785Z' transform='translate(15272.938 4369.212)' fill='#fff'/>
    <path id='Path_701' data-name='Path 701' d='M511.8,668.664a3.428,3.428,0,0,0,2.693,1.824c.29.029.207.473-.081.445a3.842,3.842,0,0,1-2.984-2.012.233.233,0,0,1,.057-.314.227.227,0,0,1,.314.057Z' transform='translate(15251.065 4390.163)' fill='#fff'/>
    <path id='Path_703' data-name='Path 703' d='M572.89,280.42H517.6a6.452,6.452,0,0,1-6.444-6.445V243.861a6.452,6.452,0,0,1,6.445-6.444H572.89a6.452,6.452,0,0,1,6.445,6.444v30.114a6.452,6.452,0,0,1-6.444,6.445Z' transform='translate(15251.202 4634.673)' fill='#c11427'/>
    <path id='Path_704' data-name='Path 704' d='M767.89,280.42H712.6a6.452,6.452,0,0,1-6.445-6.445V243.861a6.452,6.452,0,0,1,6.445-6.444H767.89a6.451,6.451,0,0,1,6.444,6.444v30.114a6.452,6.452,0,0,1-6.444,6.445Z' transform='translate(15140.615 4634.673)' fill='#e6e6e6'/>
    <path id='Path_706' data-name='Path 706' d='M572.89,435.42H517.6a6.452,6.452,0,0,1-6.444-6.445V398.861a6.452,6.452,0,0,1,6.445-6.444H572.89a6.452,6.452,0,0,1,6.445,6.444v30.114A6.452,6.452,0,0,1,572.89,435.42Z' transform='translate(15251.202 4546.771)' fill='#e6e6e6'/>
    <g id='aa405d94-515b-444f-88dd-2c52df39214d' transform='translate(15818.12 4967.982)'>
        <circle id='ede3a9f0-5e02-4455-ac7e-751a5f8c3692' cx='9.875' cy='9.875' r='9.875' fill='#c11427'/>
        <path id='ba039ca8-d148-45ed-9781-bacb7304e881' d='M660.356,474.4H657v-3.358a.79.79,0,0,0-.79-.79h0a.79.79,0,0,0-.79.79V474.4h-3.357a.79.79,0,0,0-.79.79h0a.79.79,0,0,0,.79.79h3.358v3.358a.79.79,0,0,0,.79.79h0a.79.79,0,0,0,.79-.79v-3.358h3.357a.79.79,0,0,0,.79-.79h0a.79.79,0,0,0-.79-.79h0Z' transform='translate(-646.38 -465.35)' fill='#fff'/>
    </g>
    <g id='bbf41f8a-587e-4352-8304-6d86282586e3' transform='translate(15903.832 4902.616)'>
        <circle id='e4c91425-bc08-43ed-9b2d-9a6452dd6ab0' cx='9.875' cy='9.875' r='9.875' fill='#c11427'/>
        <path id='b08e8960-896e-4763-a2dc-6c3da3e5d175' d='M858.356,323.4H855v-3.358a.79.79,0,0,0-.79-.79h0a.79.79,0,0,0-.79.79V323.4h-3.358a.79.79,0,0,0-.79.79h0a.79.79,0,0,0,.79.79h3.358v3.358a.79.79,0,0,0,.79.79h0a.79.79,0,0,0,.79-.79v-3.358h3.357a.79.79,0,0,0,.79-.79h0a.79.79,0,0,0-.79-.79h0Z' transform='translate(-844.38 -314.35)' fill='#fff'/>
    </g>
    <g id='b77ad267-181d-433f-b31f-af61e58bf4a6' transform='translate(15733.707 4901.75)'>
        <circle id='e8aef769-5476-47e9-8295-ae809767f9aa' cx='9.875' cy='9.875' r='9.875' fill='#c11427'/>
        <path id='efbebd4e-dbd2-4103-8d2c-f0ca8346a3bf' d='M465.356,321.4H462v-3.358a.79.79,0,0,0-.79-.79h0a.79.79,0,0,0-.79.79h0V321.4h-3.358a.79.79,0,0,0-.79.79h0a.79.79,0,0,0,.79.79h3.357v3.358a.79.79,0,0,0,.79.79h0a.79.79,0,0,0,.79-.79v-3.358h3.358a.79.79,0,0,0,.79-.79h0a.79.79,0,0,0-.79-.79h0Z' transform='translate(-451.38 -312.35)' fill='#fff'/>
    </g>
    <path id='Path_707' data-name='Path 707' d='M618.63,293.652a3.926,3.926,0,0,1-3.169,5.119l-4.566,31.168-7.49-3.658,7.534-31.112a3.947,3.947,0,0,1,7.692-1.517Z' transform='translate(15198.886 4604.332)' fill='#9e616a'/>
    <path id='Path_708' data-name='Path 708' d='M503.188,476.765a3.926,3.926,0,0,0-1.512-5.827l3.081-33.153-6.452,3.307-2.015,31.948a3.947,3.947,0,0,0,6.9,3.726Z' transform='translate(15259.789 4521.043)' fill='#9e616a'/>
    <path id='Path_709' data-name='Path 709' d='M320.81,295.721l27.688-1.065,1.6-28.753H318.148Z' transform='translate(15446.574 4685.318)' fill='#9e616a'/>
    <path id='Path_710' data-name='Path 710' d='M312.426,545.447h4.732l2.251-18.249h-6.983Z' transform='translate(15449.82 4537.136)' fill='#9e616a'/>
    <path id='Path_711' data-name='Path 711' d='M506.955,717.691l7.479-.446v3.2l7.111,4.911a2,2,0,0,1-1.137,3.649h-8.9l-1.535-3.17-.6,3.17h-3.357Z' transform='translate(15254.118 4362.558)' fill='#2f2e41'/>
    <path id='Path_712' data-name='Path 712' d='M361.04,545.447h4.732l2.251-18.249h-6.983Z' transform='translate(15422.251 4537.136)' fill='#9e616a'/>
    <path id='Path_713' data-name='Path 713' d='M514.484,471.244s-8.284,6.688-3.793,30.574c-.684.082.091,1.43.091,1.43l.648,19.462.5,2.231-1.665,3.6.686,3.911-2.116,35.493,7.817,1.011,7.48-36.858,1.425-4.144,1.429-3.632-.771-3.873.632-6.012,4.312-20.272,1.056,35.158-1.473,3.357.82,3.685-1.826,1.956-.722,32.9,8.335.39,6.9-33.161-.535-4.232.918-3.129v-7.308l1.571-3.449,3.426-18.808s1.034-14.7-6.507-32Z' transform='translate(15252.517 4503.045)' fill='#2f2e41'/>
    <path id='Path_714' data-name='Path 714' d='M509.732,365.013s-10.464,2.069-12.267,10.993-2.963,29.117-2.963,29.117l.395,2.812,10.122,2.347,6.46-28.295Z' transform='translate(15260.645 4562.312)' fill='#3f3d56'/>
    <path id='Path_715' data-name='Path 715' d='M584.847,350.785s1.061-1.486,7-1.716c.245-.009-.058-.495-.058-.495l2.857-13.962,9.519,5.271-1.607,14.637-15.643,17.792Z' transform='translate(15209.409 4579.552)' fill='#3f3d56'/>
    <path id='Path_716' data-name='Path 716' d='M534.446,403.153a151.814,151.814,0,0,1-21.383-2,3.1,3.1,0,0,1-2.6-2.6,2.348,2.348,0,0,1-.395-2.667l.009-.019-.23-.271a2.511,2.511,0,0,1-.167-3.035l-3.145-22.5a9.478,9.478,0,0,1,6.592-10.4l1.161-.361,4.391-5.743h.087l14.1.188,4.574,5.809,7.394,1.743.019.113,1.717,9.919c.893,5.159-1.155,7.189-3.769,11.725l.767,12.742.348.632a1.714,1.714,0,0,1-.41,2.15,3.338,3.338,0,0,1,.045,2.066l-.181.6c0,.017-.048.26-.438.557C542.22,402.337,540.2,403.153,534.446,403.153Z' transform='translate(15253.877 4568.807)' fill='#3f3d56'/>
    <path id='Path_717' data-name='Path 717' d='M555.568,717.691l7.479-.446v3.2l7.111,4.911a2,2,0,0,1-1.137,3.649h-8.9l-1.535-3.17-.6,3.17h-3.357Z' transform='translate(15226.549 4362.558)' fill='#2f2e41'/>
    <circle id='Ellipse_37' data-name='Ellipse 37' cx='11.05' cy='11.05' r='11.05' transform='translate(15766.388 4917.22) rotate(-80.783)' fill='#9e616a'/>
    <path id='Path_718' data-name='Path 718' d='M509.589,280.228c-4.05-2.785-7.617-3.21-10.546-2.42a3.851,3.851,0,0,0-1.541-1.368,12.661,12.661,0,0,0-24.226,6.947c.7,3.8,3.094,7.1,4.057,10.844a15.476,15.476,0,0,1-9.8,17.9,15.108,15.108,0,0,0,16.564-9.192c1.173-3.123,1.244-6.533,1.393-9.866a32.712,32.712,0,0,1,.841-6.832,14.6,14.6,0,0,1,1.087-2.909,9.956,9.956,0,0,1,4.765-4.622,3.8,3.8,0,0,0,.555,3.421,10.113,10.113,0,0,0-2.439,5.4c-3.281,6,1.411,11.147,7.408,14.428a12.285,12.285,0,0,0,7.849,1.368l.251-1.071.34.965,1.135,3.234q1.964.95,3.893,2.082c-.489-2.295-.884-4.586-1.156-6.825-.377-3.048.936-7.587,1.883-10.346a16.289,16.289,0,0,0,.892-5.287v-.079l.922,2.962,3.357-1.432C516.453,283.942,517.078,279.875,509.589,280.228Z' transform='translate(15275.938 4617.057)' fill='#2f2e41'/>
    <path id='Path_719' data-name='Path 719' d='M561.253,744.337H315.678a.515.515,0,1,1,0-1.031H561.253a.515.515,0,0,1,0,1.031Z' transform='translate(15362.351 4347.777)' fill='#ccc'/>
    <circle id='e4c91425-bc08-43ed-9b2d-9a6452dd6ab0-2' data-name='e4c91425-bc08-43ed-9b2d-9a6452dd6ab0' cx='9.875' cy='9.875' r='9.875' transform='translate(15732.578 4969.28)' fill='#e6e6e6'/>
    <path id='Path_720' data-name='Path 720' d='M757.748,436.341H723.111a4.042,4.042,0,0,1-4.037-4.037V413.439a4.042,4.042,0,0,1,4.037-4.037h34.637a4.042,4.042,0,0,1,4.037,4.037V432.3A4.042,4.042,0,0,1,757.748,436.341Z' transform='translate(15133.288 4537.138)' fill='#f2f2f2'/>
    <g id='bc9af32e-f7cd-4c85-a4cc-5543d455b8de' transform='translate(15886.302 4955.328)'>
        <circle id='b56288f5-6382-4006-aaf1-aded98dde780' cx='5.244' cy='5.244' r='5.244' fill='#c11427'/>
        <path id='b9aaef6b-2cfc-46ac-8dc0-30fdc28925de' d='M808.3,437.913h-1.783V436.13a.42.42,0,0,0-.42-.42h0a.42.42,0,0,0-.42.42v1.783H803.9a.42.42,0,0,0-.42.42h0a.42.42,0,0,0,.42.42h1.783v1.783a.42.42,0,0,0,.42.42h0a.42.42,0,0,0,.42-.42v-1.783H808.3a.42.42,0,0,0,.42-.42h0a.42.42,0,0,0-.42-.42Z' transform='translate(-800.88 -433.11)' fill='#fff'/>
    </g>
    <path id='Path_721' data-name='Path 721' d='M797.63,429.855H769.087a4.575,4.575,0,0,1-4.57-4.569V408.247a.842.842,0,1,1,1.684,0v4.563l33.155,3.014a2.529,2.529,0,0,1,2.484,2.525.843.843,0,0,1-.014.155l-1.671,8.911a2.528,2.528,0,0,1-2.524,2.44ZM766.2,414.5v10.785a2.889,2.889,0,0,0,2.886,2.886H797.63a.843.843,0,0,0,.842-.842.837.837,0,0,1,.014-.155l1.667-8.89a.843.843,0,0,0-.839-.777c-.025,0-.051,0-.076,0Z' transform='translate(15107.517 4538.271)' fill='#c11427'/>
    <circle id='Ellipse_38' data-name='Ellipse 38' cx='1.403' cy='1.403' r='1.403' transform='translate(15867.615 4973.177)' fill='#c11427'/>
    <circle id='Ellipse_39' data-name='Ellipse 39' cx='1.403' cy='1.403' r='1.403' transform='translate(15902.621 4973.177)' fill='#c11427'/>
    <path id='Path_722' data-name='Path 722' d='M791.387,468.728H753.855a.842.842,0,1,1,0-1.684h37.532a.842.842,0,1,1,0,1.684Z' transform='translate(15114.041 4504.449)' fill='#c11427'/>
    <path id='Path_723' data-name='Path 723' d='M760.986,408.441h-7.3a.842.842,0,1,1,0-1.684h7.3a.842.842,0,1,1,0,1.684Z' transform='translate(15114.134 4538.638)' fill='#c11427'/>
    <path id='Path_724' data-name='Path 724' d='M776.817,461.509a.839.839,0,0,1-.548-.2l-5.534-4.755a.842.842,0,0,1,1.1-1.277l5.533,4.755a.842.842,0,0,1-.549,1.48Z' transform='translate(15104.156 4511.24)' fill='#c11427'/>
    <path id='Path_725' data-name='Path 725' d='M786.759,438.161a.842.842,0,0,1-.842-.842V423.805a.842.842,0,1,1,1.684,0v13.514a.842.842,0,0,1-.842.842Z' transform='translate(15095.381 4529.448)' fill='#c11427'/>
    <path id='Path_726' data-name='Path 726' d='M827.841,439.632a.842.842,0,0,1-.842-.842V426.4a.842.842,0,0,1,1.684,0V438.79a.842.842,0,0,1-.842.842Z' transform='translate(15072.082 4527.978)' fill='#c11427'/>
    </g>
    </svg></div>";
echo "<div class='body5'>";

// require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/images/showimage.php';
// $image=new Image();
// $src= $image ->show($productpicone);


while ($query->fetch()) {

    echo "<div class='item'>";
    echo "<div class='item-image'>";
    echo "$productpicone";
    // echo '<img src="'.$src.'"/>';
    echo "</div>";
    echo "<div class='item-details'>";
    echo "<div class='item-name'>$productid</div>";
    echo "<div class='item-price'>$$productprice</div>";
    echo "</div>";
    echo "</div>";
}

if ($query->num_rows === 0) {
    echo "<a href='https://www.swapamc.com/swapproj/allproducts' class='button5'>Add products to favourites now !!</a>";
}
echo "</div>";
echo "</div>";




ob_flush();





?>
<html>
    <script>
        
    </script>
<style>
    <?php include 'product/css/viewfavourites.css';
    ?>
    
</style>

<!-- <head>
    <style>
        table,
        th,
        td {
            border: 1px solid black;
        }
    </style>

</head> -->

</style>
    <head>
        <style>
            table,th,td {
                border:1px solid black;
            }
            .navlinksic {
    display: none;
}
            
        </style>

    </head>
</html>

<!-- <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" -->
         <!-- integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/> -->
        <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">