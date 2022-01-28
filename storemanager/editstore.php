<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/images/showimage.php';
$image = new Image();

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $storeid = $_GET['id'];

    if (badInputTwo([$storeid]) === true) {
        header("location: https://www.swapamc.com/swapproj/productmanager?error=badid");
        exit;
    }
    try {
        $query = $conn->prepare("SELECT store_name, store_pricepoint, store_about, store_picone, store_pictwo, store_picethree, store_address, store_number, store_url, store_status, store_rating FROM mydb.store WHERE store_id = '$storeid';");
        if ($query === false) {
            //change filename accordingly
            throw new Exception("Statement Preparation failed(storeedit)");
        }
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
        //change header location accordingly
        header("location: https://www.swapamc.com/swapproj/productmanager?error=stmt");
        exit;
    }


    try {
        $execute = $query->execute();
        if ($execute === false) {
            throw new Exception("Statement Preparation failed(storeedit)");
        }
    } catch (Exception $e) {
        echo 'Message: ' . $e->getMessage();
        header("location: https://www.swapamc.com/swapproj/productmanager?error=stmt");
        exit;
    }
} else {
    header("location: https://www.swapamc.com/swapproj/productmanager?error=badid");
    exit;
}

$query->bind_result($storename, $storepricepoint, $about, $picone, $pictwo, $picthree, $storeaddress, $storenumber, $websitelink, $storestatus, $storerating);

if ($query->fetch()) {

    echo "<div class='container5'>";
    echo "<div class='item' id='example2'>";
    echo "<div class='static'>Edit Store</div>";
    

    echo "<form action='https://www.swapamc.com/swapproj/storemanager/editstoreinc?id=$storeid' enctype='multipart/form-data' method='POST'>";


        
    echo '<div class="pairing555">
        <div class="pairing1"><label class="required-field" for="storename">Store Name:</label></div>
        <div class="pairing2"><input required type="text" name="storename" id="storename" placeholder="Torchlight" value="' . $storename . '"></div>
    </div>

    <div class="pairing555">
        <div class="pairing1"><label class="required-field" for="storeadress">Address:</label></div>
        <div class="pairing2"><input type="text" name="storeaddress" id="storeaddress" placeholder="336B Anchorvale Crescent" value="' . $storeaddress . '"></div>
    </div>

    <div class="pairing555">
        <div class="pairing1"><label class="required-field" for="about">Description:</label></div>
        <div class="pairing2"><textarea required type="text" name="about" id="about" placeholder="text" rows="4"cols="50">' . $about . '</textarea></div>
    </div>

    <div class="pairing555">
        <div class="pairing1"><label class="required-field" for="storenumber">COntact Number:</label></div>
        <div class="pairing2"><input type="text" name="storenumber" id="storenumber" placeholder="88888888" value ="' . $storenumber . '"></div>
    </div>

    <div class="pairing555">
        <div class="pairing1"><label class="required-field" for="storepricepoint">Price Point:</label></div>
        <div class="pairing2"><input required type="text" name="storepricepoint" id="storepricepoint" min=1 max=5 placeholder="5" value="' . $storepricepoint . '"></div>
    </div>

    <div class="pairing555">
        <div class="pairing1"><label class="required-field" for="storestatus">Active Status:</label></div>
        <div class="pairing2"><select id="storestatus" name="storestatus">
            <option value="Active">Active</option>
            <option value="Inactive">Inactive</option>
    </select></div></div>';


    echo "<div class='pairing555'>";
    if ($picone != null) {
        echo "<p>Pic one:</p>";
        $src = $image->show($picone);
        echo "<img src='$src';>";
        echo "<br>";
        echo "<input type='hidden' name='image1' value='" . $picone . "'>";
    }

    echo "<div class='pairing1'><p>Image one:</p></div>";
    echo "<div class='pairing2'><input type='file' name='image1'></div>";

    echo "</div>";


    echo "<div class='pairing555'>";
    if ($pictwo != null) {
        echo "<p>Pic two:</p>";
        $src = $image->show($pictwo);
        echo "<img src='$src';>";
        echo "<br>";
        echo "<input type='hidden' name='image2' value='" . $pictwo . "'>";
    }
    echo "<div class='pairing1'><p>Image two:</p></div>";
    echo "<div class='pairing2'><input type='file' name='image2'></div>";
    echo "</div>";


    echo "<div class='pairing555'>";
    if ($picthree != null) {
        echo "<p>Pic three:</p>";
        $src = $image->show($picthree);
        echo "<img src='$src';>";
        echo "<br>";
        echo "<input type='hidden' name='image3' value='" . $picthree . "'>";
    }
    echo "<div class='pairing1'><p>Image three:</p></div>";
    echo "<div class='pairing2'><input type='file' name='image3'></div>";
    echo "</div>";



    echo "<div class='pairing555'>";
    echo '<div class="pairing1"><label for="websitelink">Link to Website:</label></div>
            <div class="pairing2"><input type="text" name="websitelink" id="websitelink" placeholder="www.cisco.com" value="' . $websitelink . '"></div>';
    echo "</div>";
    echo "<input type='submit'>";

    echo "<br>";

    echo "</form></div></div>";
    echo "<a href='https://www.swapamc.com/swapproj/storemanager/deletestoreinc?id=$storeid'><button type='button'>Delete</button></a>";
} else {
    //dosent exist
    header("location: https://www.swapamc.com/swapproj/productmanager?error=badid");
    exit;
}
?>

<html>

    <style>
        textarea {
            resize:none;
        }
        <?php include 'storemanager/addstore.css'; ?>
    </style>
</html>
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
         integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

