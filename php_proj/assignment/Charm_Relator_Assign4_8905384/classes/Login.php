<?php

class Login {

    public function loginUser ($_username,$_password) {
        $result = $this->findUsername($_username,$_password);
        if($result){
            session_start();
            $_SESSION['username'] = $result['email'];
            $_SESSION['fname'] = $result['fname'];
            $_SESSION['lname'] = $result['lname'];
            $_SESSION['access_level'] = $result['access_level'];
            $_SESSION['logged_in'] = true;

            // header("Location:order-list.php");
            // exit();
          //  session_write_close();
            return "success";
        } else {
            return "failed";
        }
    }

    public function logoutUser () {
        session_start();
        session_destroy();
    }

    protected function findUsername ($username,$password) {
        $conn = new Database ();
        $conn->connectDb();
        $sqlQuery = "SELECT * FROM `user` WHERE `email` = '$username'";
        $sqlResult = $conn->dbConn->query($sqlQuery);

        if($sqlResult->num_rows == 1){
            $result = $sqlResult->fetch_assoc();

            // TODO: check if hash will be the same so I do not have to use password_verify.
            // Because I DO NOT know how to decrypt the hash, I had to do a nested condition.
            // HACK: try to check if the hash of two the same passwords are the same.
            if (password_verify($password, $result['password'])) {
                return $result;
            } else {
                return false; 
            }
        } else {
            return false;
        }
    }
}