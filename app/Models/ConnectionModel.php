<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

class ConnectionModel
{
    protected $conn = null;

    public function openConnection()
    {
        try {
            $this->conn = mysqli_connect($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASS'], $_ENV['DB_NAME']);
        } catch (Exception $e) {
            $_SESSION["error_message"] = $e->getMessage();
        }
    }

    public function closeConnection()
    {
        try {
            $this->conn = null;
        } catch (Exception $e) {
            $_SESSION["error_message"] = $e->getMessage();
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
