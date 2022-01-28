<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';


?>


<html>
<body>

<div class='container5'>

    <div class='item' id="example2">
        <div class='static'>Add New Store</div>
    <form  class='form5'; method=POST enctype='multipart/form-data' action='https://www.swapamc.com/swapproj/storemanageraddinc'>

        <div class='pairing'>
            <div class='pairing1'><label class="required-field" for="storename">Store Name:</label></div>
            <div class='break'></div>
            <div class='pairing2'><input required type='text' name='storename' id='storename' placeholder='Store Name'></div>
        </div>


        <div class='pairing'>
            <div class='pairing1'><label class="required-field" for="storeadress">Address:</label></div>
            <div class='pairing2'><input type='text' name='storeaddress' id='storeaddress' placeholder='Address'></div>
        </div>

        <div class='pairing55'>
            <div class='pairing1'><label class="required-field" for="about">Description:</label></div>
            <div class='pairing2'><textarea required type='text' name='about' id='about' placeholder='Description' rows='4' cols='50'></textarea></div>
        </div>


        <div class='pairing'>
            <div class='pairing1'><label class="required-field" for="storenumber">Contact Number:</label></div>
            <div class='pairing2'><input type='number' name='storenumber' id='storenumber' placeholder='Store Number'></div>
        </div>

        <div class='pairing'>
            <div class='pairing1'><label class="required-field" for="storepricepoint">Price Point:</label></div>
            <div class='pairing2'><input required type='number' name='storepricepoint' id='storepricepoint' min=1 max=5 placeholder='Price Point'></div>
        </div>

        <div class='pairing'>
            <div class='pairing1'><label class="required-field" for="image1">Image one:</label></div>
            <div class='pairing2'><input required type='file' name='image1' id='image1'></div>
        </div>

        <div class='pairing'>
            <div class='pairing1'><label for="image2">Image two:</label></div>
            <div class='pairing2'><input type='file' name='image2' id='image2'></div>
        </div>

        <div class='pairing'>
            <div class='pairing1'><label for="image3">Image three:</label></div>
            <div class='pairing2'><input type='file' name='image3' id='image3'></div>
        </div>

        <div class='pairing'>
            <div class='pairing1'><label class="required-field" for="storestatus">Active Status:</label></div>
            <div class='pairing2'><select style='width:100%; height:40px; background-color: rgb(248, 197, 197);' id="storestatus" name="storestatus">
                <option value="Active">Active</option>
                <option value="Inactive">Inactive</option>
            </select></div>
        </div>

        <div class='pairing55'>
            <div class='pairing1'><label for="websitelink">Link to Website:</label></div>
            <div class='pairing2'><input type='text' name='websitelink' id='websitelink' placeholder='www.cisco.com'></div>
    </div>

        <input type='submit'>
    </form>
    </div>
</div>
</body>
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
         integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">



<style>
    textarea {
        resize: none;
    }

    /* for required fields */
    .required-field::after {
        content: "*";
        color: red;
    }

<?php include 'storemanager/addstore.css'; ?>
</style>
</html>