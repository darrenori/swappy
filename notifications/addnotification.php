<?php

require $_SERVER['DOCUMENT_ROOT'] . '/swapproj/authorization.inc.php';
require_once $_SERVER['DOCUMENT_ROOT']. '/swapproj/includes/functions.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/includes/dbh.inc.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/swapproj/manager/includes/employeefunctions.inc.php';

echo '<h1>Notifications</h1>';

echo "<form method='POST' action='https://www.swapamc.com/swapproj/addnotificationinc'>";

echo "<p>Notification Header</p>";
echo "<input required type='text' name='header' placeholder='Header'>";

echo "<p>Notification Text</p>";
echo "<textarea required type='text' name='notificationtext' placeholder='text' rows='4' cols='50'>";

echo "</textarea>";

echo "<p>Severity Level</p>";
echo '<select required name="severe">';
    
    
    echo '<option value="Low">Low</option>';
    echo '<option value="Medium">Medium</option>';
    echo '<option value="High">High</option>';


echo '</select>';




echo "<p>Type</p>";
echo '<select required name="type">';
    
    
    echo '<option value="Maintenance">Maintenance</option>';
    echo '<option value="Warning">Warning</option>';
    echo '<option value="Others">Others</option>';


echo '</select>';

echo "<p>Username to send (Leave empty for broadcast):</p>";
echo "<input type='text' name='usernametosend' placeholder='Username'>";

echo "<br><br>";
echo "<input type='submit'>";


echo "</form>";












?>








<html>

    <style>
        textarea {
            resize:none;
        }
    </style>
</html>

