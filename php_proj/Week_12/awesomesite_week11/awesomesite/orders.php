<?php
    session_start();
    include('includes/dbconnection.php');

    // send user to login page if they are not logged in
    if(!isset($_SESSION['logged_in'])){
      header('Location:login.php');
      exit();
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
    <table class="ordersTable">
      <thead>
        <tr>
          <th>Order Number</th>
          <th>Name</th>
          <th>Email</th>
          <th>Amount</th>
        </tr>
      </thead>
      <tbody>
        <?php
          // build your query
          $sqlQuery = "SELECT * FROM `orders`";
          $sqlResult = $db->query($sqlQuery); // execute the query
          if($sqlResult->num_rows > 0){ // if there is data returned from DB
            // Iterate through the rows and display data
            while($row = $sqlResult->fetch_assoc()){
              // print the data
              ?>
              <tr>
                <td><?php echo $row['id']; ?></td>
                <td><?php echo $row['name']; ?></td>
                <td><?php echo $row['email']; ?></td>
                <td>$<?php echo $row['totalCost']; ?></td>
              </tr>
              <?php
            }
          }

        ?>
      </tbody>
    </table>
  </main>

</body>

</html>