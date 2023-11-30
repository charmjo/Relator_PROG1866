<?php

// this is my fake router... 
require 'config/config.php';
require 'classes/classes.php';

if($_POST) {
    $action = $_POST["action"];

    // FIXME: add a general response variable:
    if ($action == 'login') {
    //    $formData = json_decode($_POST["formData"]);
        
        // parse_str($_REQUEST['formData'], $formData);
        $login = new Login ();

        // $login->logoutUser();
        $response = $login->loginUser($_POST['login-email'],$_POST['login-password']);
        if ($response == 'success') {
            header('Location:order-list.php');
            exit();
        }

        
    } else if ($action == 'manager-add') {
        $formData = [];
        parse_str($_REQUEST['formData'], $formData);

        $manager = new StoreManager ();
        $manager->addManager($formData['fname'],$formData['lname'],$formData['email'],$formData['password']);

        // TODO: Provide proper messaging to FE
        // TODO: error and success messages

        // HELPER FUNCTION TO CREATE ADMIN
        // $user = new User ();
        // $user->addNewUser('Admin1','Admin1','admin1@admin.com','admin1',1);
    } else if ($action == 'order-add') {
        $formData = [];
        parse_str($_REQUEST['formData'], $formData);

        $order = new Orders ();
        $result = $order->processOrder($formData);
        
        echo json_encode($result);

    }
    


}
