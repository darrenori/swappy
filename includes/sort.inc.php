<?php

if (!isset($_POST['searchitem'])) {
    header("location: https://www.swapamc.com/swapproj/campus?error=unauthorized");
    exit;
}