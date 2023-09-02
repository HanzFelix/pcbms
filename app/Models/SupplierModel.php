<?php
include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/ConnectionModel.php";

class SupplierModel extends ConnectionModel
{
    function getSuppliers($company)
    {
        $query = "SELECT * FROM supplier WHERE company LIKE '%$company%'";
        try {
            $this->openConnection();

            $result = mysqli_query($this->conn, $query);

            return $result;
        } catch (Exception $e) {
            $_SESSION["error_message"] = $e->getMessage();
            return false;
        }
    }
    function getSupplierList()
    {
        $query = "SELECT * FROM supplier";
        try {
            $this->openConnection();

            $result = mysqli_query($this->conn, $query);

            return $result;
        } catch (Exception $e) {
            $_SESSION["error_message"] = $e->getMessage();
            return false;
        }
    }

    function getSupplier($supp_id)
    {
        $query = "SELECT * FROM supplier WHERE supp_id = '$supp_id'";
        try {
            $this->openConnection();

            $result = mysqli_query($this->conn, $query);

            return mysqli_fetch_assoc($result);
        } catch (Exception $e) {
            $_SESSION["error_message"] = $e->getMessage();
            return false;
        }
    }

    function createSupplier($name, $contact, $sex, $address, $phone)
    {
        $query = "INSERT INTO `supplier` (`company`, `contact_person`, `sex`, `phone`, `address`) VALUES ('$name', '$contact', '$sex', '$address', '$phone')";

        try {
            $this->openConnection();

            mysqli_query($this->conn, $query);
        } catch (Exception $e) {
            $_SESSION["error_message"] = $e->getMessage();
            return false;
        }
    }

    function updateSupplier($supp_id, $name, $contact, $sex, $address, $phone)
    {
        $query = "UPDATE `supplier` SET `company` = '$name', `contact_person` = '$contact', `sex` = '$sex', `address` = '$address', `phone` = '$phone' WHERE `supplier`.`supp_id` = $supp_id";

        try {
            $this->openConnection();

            mysqli_query($this->conn, $query);
        } catch (Exception $e) {
            $_SESSION["error_message"] = $e->getMessage();
            return false;
        }
    }

    function deleteSupplier($supp_id)
    {
        $query = "DELETE FROM `supplier` WHERE `supplier`.`supp_id` = $supp_id";

        try {
            $this->openConnection();

            mysqli_query($this->conn, $query);
        } catch (Exception $e) {
            $_SESSION["error_message"] = $e->getMessage();
            return false;
        }
    }
}
