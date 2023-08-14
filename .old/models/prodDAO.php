<?php
include "../../models/connectionDAO.php";

class ProdDAO extends ConnectionDAO
{
    // returns either the first user found or false
    function getProducts($name)
    {
        $query = "SELECT * FROM product WHERE prod_name LIKE '%$name%'";
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

    function getProduct($prod_id)
    {
        $query = "SELECT * FROM product WHERE prod_id = '$prod_id'";
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

    function createProduct($name, $shelf_life, $unit, $appreciation)
    {
        $query = "INSERT INTO `product` (`prod_name`, `shelf_life`, `unit`, `appreciation`) VALUES ('$name', '$shelf_life', '$unit', '$appreciation')";

        try {
            $this->openConnection();

            mysqli_query($this->conn, $query);
        } catch (Exception $e) {
            $_SESSION["error_message"] = $e;
            $e->getMessage();
            return false;
        }
    }

    function updateProduct($prod_id, $name, $shelf_life, $unit, $appreciation)
    {
        $query = "UPDATE `product` SET `prod_name` = '$name', `shelf_life` = '$shelf_life', `unit` = '$unit', `appreciation` = '$appreciation' WHERE `product`.`prod_id` = $prod_id";

        try {
            $this->openConnection();

            mysqli_query($this->conn, $query);
        } catch (Exception $e) {
            $_SESSION["error_message"] = $e;
            $e->getMessage();
            return false;
        }
    }

    function deleteProduct($prod_id)
    {
        $query = "DELETE FROM `product` WHERE `product`.`prod_id` = $prod_id";

        try {
            $this->openConnection();

            mysqli_query($this->conn, $query);
        } catch (Exception $e) {
            $_SESSION["error_message"] = $e;
            $e->getMessage();
            return false;
        }
    }
}
