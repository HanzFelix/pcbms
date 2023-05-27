<?php
include "../models/connectionDAO.php";

class MgtDAO extends ConnectionDAO
{
    // returns either the first user found or false
    function getSuppliers($company)
    {
        $query = "SELECT * FROM supplier WHERE company LIKE '%$company%'";
        try {
            $this->openConnection();

            $result = mysqli_query($this->conn, $query);

            return $result;
        } catch (Exception $e) {
            $_SESSION["error_message"] = $e;
            $e->getMessage();
            return false;
        }
    }
    function getSupplier($supp_id)
    {
        $query = "SELECT * FROM supplier WHERE supp_id = '$supp_id'";
        try {
            $this->openConnection();

            $result = mysqli_query($this->conn, $query);

            // return only one result
            return mysqli_fetch_assoc($result);
        } catch (Exception $e) {
            $_SESSION["error_message"] = $e;
            $e->getMessage();
            return false;
        }
    }
}
