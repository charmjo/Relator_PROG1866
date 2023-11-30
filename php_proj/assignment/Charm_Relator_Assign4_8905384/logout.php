<?php
require 'config/config.php';
require 'classes/classes.php';

$logout = new Login();
$logout->logoutUser();

header('Location:login-view.php');
exit();
