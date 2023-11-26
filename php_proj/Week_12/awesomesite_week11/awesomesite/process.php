<?php 

    include('includes/dbconnection.php');


    $errors = '';
    $output = '';
    $name = '';
    $email = '';
    $phone = '';
    $postcode = '';
    $lunch = '';
    $tickets = '';
    $campus = '';
    if(!empty($_POST)){ // checks if the form has been submitted
      //print_r($_POST);

      $jsonArray = [];
      // fetch
      $name = $_POST['name'];
      $email = $_POST['email'];
      $phone = $_POST['phone'];
      $postcode = $_POST['postcode'];
      $lunch = $_POST['lunch'];
      $tickets = $_POST['tickets'];
      $campus = $_POST['campus'];

      // validate
      // regexes
      $phoneRegex = "/^[0-9]{3}\-[0-9]{3}\-[0-9]{4}$/";      
      $ticketsRegex = "/^[123]$/";

      if(!preg_match($phoneRegex, $phone)){
        $errors .= "Please enter phone in correct format 123-123-1234 <br>";
      }

      if(!preg_match($ticketsRegex, $tickets)){
        $errors .= "Please select tickets <br>";
      }

      // output
      if(!$errors){
        $costTickets = 20;
        $totalCost = $tickets * $costTickets;

        // create SQL query to add data to database
        $sqlQuery = "
          INSERT INTO `orders` 
          (`id`, `name`, `email`, `phone`, `postcode`, `lunch`, `tickets`, `campus`, `totalCost`) 
          VALUES 
          (NULL, '$name', '$email', '$phone', '$postcode', '$lunch', '$tickets', '$campus', '$totalCost');
        ";
        // PDO vs mysqli
        // execute the SQL query to insert data into the database
        $sqlResult = $db->query($sqlQuery);
        if(!$sqlResult){
          exit($db->error); // show this only in development mode
          //exit('Some error.. please try again...'); // in production mode
        }


        $output = "
            Name: $name <br>
            Tickets: $tickets <br>
            Total Cost: $$totalCost
        ";

        $jsonArray['outputType'] = 'success';
        $jsonArray['output'] = $output;

       // echo $output;

      } else {

        $jsonArray['outputType'] = 'error';
        $jsonArray['output'] = $errors;

       // echo $errors;
      }

      $jsonObj = json_encode($jsonArray);
    //  header('Content-Type: application/json');
      echo $jsonObj;
      

    } 

?>