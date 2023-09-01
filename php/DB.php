<?php

require_once 'php/Downloader.php';
require_once 'php/Search.php';
class DB
{
    private $host = 'localhost';
    private $username = 'root';
    private $password = '';
    private $database = 'inline';

    private $conn;

    public function __construct() {
        $this->conn = new mysqli($this->host, $this->username, $this->password, null);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getConnection()
    {
        return $this->conn;
    }

}