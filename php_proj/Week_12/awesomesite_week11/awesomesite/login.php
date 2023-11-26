<?php
    session_start();
    include('includes/dbconnection.php');
    if(!empty($_POST)){ // checks if the form has been submitted
      $username = $_POST['username'];
      $password = $_POST['password'];

      $sqlQuery = "SELECT * FROM `user_login` WHERE `username` = '$username' AND `password` = '$password'";

      $sqlResult = $db->query($sqlQuery);

      if($sqlResult->num_rows == 1){ // if a user with the username and password combination is found
        // store the username in session and set logged in as true
        $_SESSION['username'] = $username;
        $_SESSION['logged_in'] = TRUE;

        header('Location:orders.php'); // redirect the user to the orders page
      }

    }

?><!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Forms and Validations</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script type="text/javascript" src="js/custom.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Bilbo+Swash+Caps" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Kalam" rel="stylesheet">
  <link rel="stylesheet" type="text/css" href="css/style.css">
</head>

<body>
  <header>
    Welcome Admin!
  </header>
  <?php include('includes/nav.php'); ?>
  <main>
    <form name="loginForm" method="Post" action="">
      <label>Username</label>
      <input id="username" type="text" name="username"><br />

      <label>Password</label>
      <input id="password" type="password" name="password"><br />


      <br /><br />

      <input type="submit" value="Login">
      <p id="errors"></p>
    </form>
  </main>
  
  <div class="clear"></div>
</body>

</html>