<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
class ConnectionModel
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

    public function getLastInsertID()
    {
        if ($this->conn !== null) {
            return mysqli_insert_id($this->conn);
        } else {
            return null;
        }
    }
}
