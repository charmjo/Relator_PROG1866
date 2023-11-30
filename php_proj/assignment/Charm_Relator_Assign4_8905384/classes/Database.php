<?php

// TODO: wrote this function when I was tipsy. I have no idea what this does.
class Database {
    protected $servername;
    protected $username;
    protected $password;
    protected $dbname;
    public $dbConn;

    public function __construct()
    {
        $this->servername = 'localhost';
        $this->username = 'root';
        $this->password = '';
        $this->dbname = 'Assignment3';
        
    }

    public function connectDb () {
        $this->dbConn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);

        if($this->dbConn->connect_error) {
            die('Something went wrong... please try again later...');
        }
    }

    public function retrieveDataList ($queryString) {
        $this->connectDb();

        $sqlResult = $this->dbConn->query($queryString);
        if($sqlResult->num_rows > 0) {
            $list = [];
            while ($row = $sqlResult->fetch_assoc()) {
                array_push($list,$row);
            }
            return $list;
        } else {
            return false;
        }

        $this->closeConnection();
    }

    public function closeConnection () {
        $this->dbConn->mysqli_close();
    }
}