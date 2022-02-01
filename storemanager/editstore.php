<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/images/showimage.php';
$image = new Image();
$csrf=generateCSRF();


if (isset($_GET['id']) && !empty($_GET['id'])) {

    ## CLEANING GET ID AND GET ERROR ##

    $_GET = XSSPrevention($_GET, ['id', 'error']);
    $_GET = escapeString($conn, $_GET);
    //errors will only ever contain letters so, we remove all other characters
    if (isset($_GET['error'])) {
        $error = preg_replace('/[^a-z]+/', '', $_GET['error']);
    }
    //removes any nondigit characters in the id
    $storeid = preg_replace('/[^\d]/', '', $_GET['id']);

    // declares variable length in chars for each item. 
    $maxlengtharray['id'] = 11;

    // bufferflag returns false (undesired) if length of item is not agreeable
    $bufferflag = empty(checkLength($_GET, $maxlengtharray));

    if (!($bufferflag)) {
        header("location: https://www.swapamc.com/swapproj/productmanager?error=invalidid");
        exit;
    }
    $storeid = $_GET['id'];

    ## CLEANING GET ID AND GET ERROR ##

    try {
        $query = $conn->prepare("SELECT store_name, store_pricepoint, store_about, store_picone, store_pictwo, store_picethree, store_address, store_number, store_url, store_status, store_rating FROM mydb.store WHERE store_id = ?;");
        $query->bind_param('s', $storeid);
        if ($query === false) {
            //change filename accordingly
            throw new Exception("Statement Preparation failed(storeedit)");
        }
    } catch (Exception $e) {
        error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR preparing statement (SELECT)", 0);
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
        error_log("TPAMC:" . $filename . ":3:" . $ipadd . ":1 ERROR executing statement (SELECT)", 0);
        header("location: https://www.swapamc.com/swapproj/productmanager?error=stmt");
        exit;
    }
} else {
    header("location: https://www.swapamc.com/swapproj/productmanager?error=badid");
    exit;
}

$query->bind_result($storename, $storepricepoint, $about, $picone, $pictwo, $picthree, $storeaddress, $storenumber, $websitelink, $storestatus, $storerating);

if ($query->fetch()) {
    echo "<form action='https://www.swapamc.com/swapproj/storemanager/editstoreinc?id=$storeid' enctype='multipart/form-data' method='POST'>";

    echo '    <label class="required-field" for="storename">Store Name:</label>
    <input required type="text" name="storename" id="storename" placeholder="Torchlight" value="' . $storename . '"><br><br>

    <label class="required-field" for="about">Description:</label>
    <textarea required type="text" name="about" id="about" placeholder="text" rows="4"cols="50">' . $about . '</textarea><br><br>


    <label class="required-field" for="storeadress">Address:</label>
    <input type="text" name="storeaddress" id="storeaddress" placeholder="336B Anchorvale Crescent" value="' . $storeaddress . '"><br><br>

    <label class="required-field" for="storenumber">COntact Number:</label>
    <input type="text" name="storenumber" id="storenumber" placeholder="88888888" value ="' . $storenumber . '"> <br><br>

    <label class="required-field" for="storepricepoint">Price Point:</label>
    <br><select id="storepricepoint" name="storepricepoint">
    <option value="' . $storepricepoint . '" selected hidden>' . $storepricepoint . '</option> 
        <option value="1">1</option>
        <option value="2">2</option>
        <option value="3">3</option>
        <option value="4">4</option>
        <option value="5">5</option>
    </select><br><br>



    <label class="required-field" for="storestatus">Active Status:</label>
    <br><select id="storestatus" name="storestatus">
        <option value="Active">Active</option>
        <option value="Inactive">Inactive</option>
    </select><br><br>';


    if ($picone != null) {
        echo "<p>Pic one:</p>";
        $src = $image->show($picone);
        echo "<img src='$src';>";
        echo "<br>";
        echo "<input type='hidden' name='image1' value='" . $picone . "'>";
    }
    echo "<p>Image one:</p>";
    echo "<input type='file' name='image1'>";



    if ($pictwo != null) {
        echo "<p>Pic two:</p>";
        $src = $image->show($pictwo);
        echo "<img src='$src';>";
        echo "<br>";
        echo "<input type='hidden' name='image2' value='" . $pictwo . "'>";
    }
    echo "<p>Image two:</p>";
    echo "<input type='file' name='image2'>";



    if ($picthree != null) {
        echo "<p>Pic three:</p>";
        $src = $image->show($picthree);
        echo "<img src='$src';>";
        echo "<br>";
        echo "<input type='hidden' name='image3' value='" . $picthree . "'>";
    }
    echo "<p>Image three:</p>";
    echo "<input type='file' name='image3'><br><br>";




    echo '    <label for="websitelink">Link to Website:</label>
<input type="text" name="websitelink" id="websitelink" placeholder="www.cisco.com" value="' . $websitelink . '"> <br><br>

';


    echo "<br><br>";

    echo "<input type='submit'>";
    echo "<input type='hidden' name='csrf' value='$csrf'>";


    echo "<br>";

    echo "</form>";
    echo "<a href='https://www.swapamc.com/swapproj/storemanager/deletestoreinc?id=$storeid'><button type='button'>Delete</button></a>";
} else {
    //dosent exist
    header("location: https://www.swapamc.com/swapproj/productmanager?error=badid");
    exit;
}
