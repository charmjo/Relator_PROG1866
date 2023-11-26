<?php

 // 1. connect to the db
      // do not use root
$servername = 'localhost';
$username = 'root';
$password = '';
$dbname = 'awesomesite';

$db = new mysqli($servername, $username, $password, $dbname);