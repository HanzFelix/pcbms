<?php
include "../models/connectionDAO.php";

class UserDAO extends ConnectionDAO
{
    // returns either the first user found or false
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

            // return only one result
            return mysqli_fetch_assoc($result);
        } catch (Exception $e) {
            $_SESSION["error_message"] = $e;
            $e->getMessage();
            return false;
        }
    }
}
