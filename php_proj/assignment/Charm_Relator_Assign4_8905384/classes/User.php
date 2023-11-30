<?php 

class User {
    // wala najud ko kahibalo ngano naa ni diri 
    protected $fname;
    protected $lname;
    protected $email;
    protected $password;
    protected $accessLevel;

    // UNYA NAKO MAG-REFACTOR KAY WALA NAJUD KOY TIME.
    // working.
    public function addNewUser ($_fname,$_lname,$_email,$_password,$_accessLevel) {
        $conn = new Database ();
        $conn->connectDb();

        //  To prepared statements or to escape strings?
        // https://www.w3schools.com/php/php_mysql_prepared_statements.asp
        // https://stackoverflow.com/questions/15786295/should-i-use-mysqli-real-escape-string-or-should-i-use-prepared-statements
        // [ ]: convert the whole query to prepared statements
        $this->fname = $conn->dbConn->real_escape_string($_fname);
        $this->lname = $conn->dbConn->real_escape_string($_lname);
        $this->email = $conn->dbConn->real_escape_string($_email);
        $this->password = $conn->dbConn->real_escape_string($_password);
        $this->accessLevel = $conn->dbConn->real_escape_string($_accessLevel);


        $encryptedPassword = $this->encryptPassword($this->password);

        $sqlQuery = "INSERT INTO `user` (`fname`,`lname`,`email`,`password`,`access_level`) 
                            VALUES ('$this->fname','$this->lname','$this->email','$encryptedPassword','$this->accessLevel')";
        $sqlResult = $conn->dbConn->query($sqlQuery);
        if (!$sqlResult) {
            exit($conn->dbConn->error);
        } 
        return true;

        $conn->closeConnection();
    }

    /*
        - Apparently, password_hash generates a salt that is even not privy to me. 
        - Used this because I am not that well-versed with cryptography.
        - reference: https://www.php.net/manual/en/function.password-hash.php
        - default algorithm is bcrypt.
    */
    protected function encryptPassword ($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }
}