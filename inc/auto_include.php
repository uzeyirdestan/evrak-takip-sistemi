<?php
require('User.php');
require('UserManagement.php');
$user = new User();
$user->getUserFromId($_SESSION["user_id"]); 
$um = new UserManagement();
?>

