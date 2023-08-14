<?php
include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/ConnectionModel.php";

class ProductModel extends ConnectionModel
{
    function getProductList()
    {
        $query = "SELECT * FROM product";
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
    function searchProduct($name)
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

    function createProduct($name, $shelf_life, $unit, $appreciation, $max_quantity)
    {
        $query = "INSERT INTO `product` (`prod_name`, `shelf_life`, `unit`, `appreciation`, `max_quantity`) VALUES ('$name', '$shelf_life', '$unit', '$appreciation', '$max_quantity')";

        try {
            $this->openConnection();

            mysqli_query($this->conn, $query);
            return true;
        } catch (Exception $e) {
            $_SESSION["error_message"] = $e;
            $e->getMessage();
            return false;
        }
    }

    function updateProduct($prod_id, $name, $shelf_life, $unit, $appreciation, $max_quantity)
    {
        $query = "UPDATE `product` SET `prod_name` = ?, `shelf_life` = ?, `unit` = ?, `appreciation` = ?, `max_quantity` = ? WHERE `product`.`prod_id` = ?";

        try {
            $this->openConnection();

            $stmt = $this->conn->prepare($query);
            if ($stmt) {
                $stmt->bind_param("sisisi", $name, $shelf_life, $unit, $appreciation, $max_quantity, $prod_id);
                $stmt->execute();
                $stmt->close();
            } else {
                throw new Exception($this->conn->error);
            }

            $this->closeConnection();
            return true;
        } catch (Exception $e) {
            $_SESSION["error_message"] = $e->getMessage();
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
