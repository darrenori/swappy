<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/functions.inc.php';

?>


<html>


<form method=POST enctype='multipart/form-data' action='https://www.swapamc.com/swapproj/storemanageraddinc'>

    <label class="required-field" for="storename">Store Name:</label>
    <input required type='text' name='storename' id='storename' placeholder='Torchlight'><br><br>

    <label class="required-field" for="about">Description:</label>
    <textarea required type='text' name='about' id='about' placeholder='text' rows='4' cols='50'></textarea><br><br>


    <label class="required-field" for="storeadress">Address:</label>
    <input type='text' name='storeaddress' id='storeaddress' placeholder='Torchlight'> <br><br>

    <label class="required-field" for="storenumber">COntact Number:</label>
    <input type='number' name='storenumber' id='storenumber' placeholder='88888888'> <br><br>

    <label class="required-field" for="storepricepoint">Price Point:</label>
    <input required type='number' name='storepricepoint' id='storepricepoint' min=1 max=5 placeholder='5'><br><br>

    <label class="required-field" for="storestatus">Active Status:</label>
    <br><select id="storestatus" name="storestatus">
        <option value="Active">Active</option>
        <option value="Inactive">Inactive</option>
    </select><br><br>

    <label class="required-field" for="image1">Image one:</label>
    <input required type='file' name='image1' id='image1'><br><br>



    <label for="image2">Image two:</label>
    <input type='file' name='image2' id='image2'><br><br>

    <label for="image3">Image three:</label>
    <input type='file' name='image3' id='image3'><br><br>


    <label for="websitelink">Link to Website:</label>
    <input type='text' name='websitelink' id='websitelink' placeholder='www.cisco.com'> <br><br>


    <input type='submit'>
</form>




<style>
    textarea {
        resize: none;
    }

    /* for required fields */
    .required-field::after {
        content: "*";
        color: red;
    }
</style>

</html>