<?php
    require 'config/config.php';
    require 'classes/classes.php';

    session_start();


    // TODO: test this against shop managers and regular users
    if(isset($_SESSION['access_level'])) {
        if($_SESSION['access_level'] != ADMIN) {
            $logout = new Login();
            $logout->logoutUser();

            header('Location:login-view.php');
            exit();
        } 
    }
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
        <div class="container">
            <div>
                <h1> Manage Shop Managers</h1>
                <form id="manager-form">
                    <div class="form-group">
                        <label for="fname">First Name</label>
                        <input name="fname" type="text" class="form-control" id="fname" placeholder="John">
                    </div>
                    <div class="form-group">
                        <label for="lname">Last Name</label>
                        <input name="lname" type="text" class="form-control" id="lname" placeholder="Doe">
                    </div>
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input name="email" type="text" class="form-control" id="email" placeholder="john@test.com">
                    </div>
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input name="password" type="password" class="form-control" id="password">
                    </div>
                    <div class="form-group row">
                        <div class="col-sm-10">
                            <button type="submit" class="btn btn-primary">Add New Manager</button>
                        </div>
                    </div>
                </form>
            </div>

            <table class="table table-striped">
                <thead>
                    <tr>
                    <th scope="col">#</th>
                    <th scope="col">First</th>
                    <th scope="col">Last</th>
                    <th scope="col">Handle</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>

   
</body>
</html>