<?php
include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/ConnectionModel.php";

class UserModel extends ConnectionModel
{
    function getUser($username, $password, $role)
    {
        $query = "SELECT * FROM `personnel` p INNER JOIN `users` u ON u.empid = p.empid WHERE `username`='$username' AND `password`='$password' AND `role`='$role'";
        try {
            $this->openConnection();
            $result = mysqli_query($this->conn, $query);

            $count = mysqli_num_rows($result);
            if ($count < 1) {
                $_SESSION["error_message"] = "no user found";
                return false;
            }

            return mysqli_fetch_assoc($result);
        } catch (Exception $e) {
            $_SESSION["error_message"] = $e->getMessage();
            return false;
        }
    }
}
