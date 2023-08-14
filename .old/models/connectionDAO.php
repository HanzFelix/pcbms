<?php
session_start();
class ConnectionDAO
{
    protected $dbhost = "localhost";
    protected $dbuser = "root";
    protected $dbpass = "";
    protected $dbname = "tumulak_pcbms_db";

    protected $conn = null;

    public function openConnection()
    {
        try {
            $this->conn = mysqli_connect($this->dbhost, $this->dbuser, $this->dbpass, $this->dbname);
        } catch (Exception $e) {
            $_SESSION["error_message"] = $e;
            $e->getMessage();
        }
    }

    public function closeConnection()
    {
        try {
            $this->conn = null;
        } catch (Exception $e) {
            $e->getMessage();
        }
    }
}
