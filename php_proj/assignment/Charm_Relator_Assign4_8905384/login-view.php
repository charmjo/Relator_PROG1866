<?php
   // require 'config/config.php';
   // require 'classes/classes.php';
    require 'process.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="assets/bootstrap-5.0.2-dist/css/bootstrap.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="assets/js/custom.js"></script>
</head>
<body>
    <main>
        <?php include 'partials/nav.php';?>
    </main>
    <div class="container text-center">
        <form method="POST" id="login-form">
            <div class="form-group">
                <label for="login-email">Email address</label>
                <input name="login-email" type="email" class="form-control" id="login-email" aria-describedby="emailHelp" placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="login-password">Password</label>
                <input name="login-password" type="password" class="form-control" id="login-password" placeholder="Password">
            </div>
            <input id="action" name="action" value="login" hidden>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>

</body>
</html>