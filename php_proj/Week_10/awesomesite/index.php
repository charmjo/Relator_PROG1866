<?php
  include('includes/dbconn.php');
  $errors = '';
  $output = '';
  if(!empty($_POST)){
    // print_r($_POST);
    // fetch
    // really need to make a collection checker instead of manually checking the $_POST variable
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $postcode = $_POST['postcode'];
    $lunch = $_POST['lunch'];
    $tickets = $_POST['tickets'];
    $lunch = $_POST['lunch'];
    $campus = $_POST['campus'];
    
    // validate

    // regex
    $phoneRegex = "/^\d{3}\-\d{3}\-\d{4}$/";
    $ticketsRegex = "/^[123]$/";

    if(!preg_match($phoneRegex, $phone)){
      $errors .="Please enter phone in correct format 123-123-1234 <br>";
    }
    if(!preg_match($ticketsRegex, $tickets)){
      $errors .="Please select tickets <br>";
    }

    if (!$errors) {
      $costTickets = 20;
      $totalCost = $tickets * $costTickets;
      
      $output = "
        Name: $name <br>
        Tickets: $tickets <br>
        Total Cost: $totalCost <br>
      ";

      $sqlQuery = "INSERT INTO `orders` (`id`, `name`,`email`,  `phone`, `postcode`, `lunch`, `tickets`, `campus`, `totalCost`)
                          VALUES (NULL, '$name', '$email', '$phone', '$postcode', '$lunch', '$tickets', '$campus', '$totalCost')";

            /*Week 11 Notest:
        1. Can import a .sql.zip file in phpMyAdmin. Man I should've done this in phpmyadmin. faaaak
        2. PDO vs mysqli
            mysqli - for mysql dbs specifically
            PDO - for all dbs
        3. Mysqli with postgres - can but have to test according to the instructor.
      
      */
     

      // check if connection has any issues
      // even without this, the db will still log errors 
      if ($db->connect_error) {
        die("Something went wrong yieeeee");
      } 

      $sqlResult = $db->query($sqlQuery);
      if (!$sqlResult) {
        exit($db->error); // show this in development mode
      //  exit('Some error.. please try again..'); // production mode
      }

    }

  }

  //output
  
  
  
?>
<!DOCTYPE html>
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
  <?php include('includes/nav.php') ?>
  <main>
    <section class="w50">
      <form name="myform" method="POST" onsubmit="return formSubmit();" action="">
        <label>Name</label>
        <input id="name" placeholder="First Last" type="text" name="name"><br />

        <label>Email</label>
        <input id="email" placeholder="email@domain.com" type="email" name="email"><br />

        <label>Phone</label>
        <input id="phone" placeholder="123-123-1234" type="phone" name="phone"><br />

        <label>Post Code</label>
        <input id="postcode" placeholder="X9X 9X9" type="postcode" name="postcode"><br />

        <label>Will you have lunch?</label>
        <input type="radio" value="yes" id="radio1" name="lunch">Yes
        &nbsp;&nbsp;&nbsp;&nbsp;
        <input type="radio" value="no" id="radio2" name="lunch">No
        <br />

        <label>Number of Tickets</label>
        <select name="tickets" id="tickets">
          <option value="">----- Select -----</option>
          <option value="1">1</option>
          <option value="2">2</option>
          <option value="3">3</option>
        </select><br />

        <label>Which Campus?</label>
        <select name="campus" id="campus">
          <option value="">----- Select -----</option>
          <option value="Doon">Doon</option>
          <option value="Waterloo">Waterloo</option>
          <option value="Cambridge">Cambridge</option>
        </select>

        <br /><br />

        <input type="submit" value="Submit">
        <p id="errors">
          <?php if ($errors) {
            echo $errors;
          }
          ?>
        </p>
      </form>
    </section>
    <section class="w50">
      <div class="formData">
        <p id="formResult">
          <?php
          if ($output) {
            echo $output;
          }
          ?>
        </p>
      </div>
    </section>
    <div class="clear"></div>
  </main>
</body>

</html>