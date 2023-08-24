<?php
include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/ConnectionModel.php";

class OrderProductModel extends ConnectionModel
{
    function getOrderProductList($od_id)
    {
        //`op_id`, `od_id`, `prod_id`, `quantity`
        $query = "SELECT op.`op_id` as `op-id`, p.`prod_name` as `product`, op.`quantity` as `quantity` FROM `order_product` op LEFT JOIN `product` p ON p.`prod_id` = op.`prod_id` WHERE op.`od_id` = '$od_id'";
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

    function getOrderProduct($op_id)
    {
        $query = "SELECT * FROM `order_product` op LEFT JOIN `product` p ON  p.`prod_id` = op.`prod_id` WHERE op.`op_id` = '$op_id'";
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

    function createOrderProduct($od_id, $prod_id, $quantity)
    {
        $query = "INSERT INTO `order_product` (`od_id`, `prod_id`, `quantity`) VALUES (?,?,?)";

        try {
            $this->openConnection();

            $stmt = $this->conn->prepare($query);
            if ($stmt) {
                $stmt->bind_param("iii", $od_id, $prod_id, $quantity);
                $stmt->execute();
                $stmt->close();
            } else {
                throw new Exception($this->conn->error);
            }

            $this->closeConnection();
            return true;
        } catch (Exception $e) {
            $_SESSION["error_message"] = $e;
            $e->getMessage();
            return false;
        }
    }

    function updateOrderProduct($op_id, $prod_id, $quantity)
    {
        $query = "UPDATE `order_product` SET `prod_id` = ?, `quantity` = ? WHERE `op_id` = ?";

        try {
            $this->openConnection();

            $stmt = $this->conn->prepare($query);
            if ($stmt) {
                $stmt->bind_param("iii", $prod_id, $quantity, $op_id);
                $stmt->execute();
                $stmt->close();
            } else {
                throw new Exception($this->conn->error);
            }

            $this->closeConnection();
            return true;
        } catch (Exception $e) {
            $_SESSION["error_message"] = $e->getMessage();
            throw $e->getMessage();
        }
    }

    function deleteOrderProducts($od_id)
    {
        $query = "DELETE FROM `order_product` WHERE `od_id` = $od_id";

        try {
            $this->openConnection();

            mysqli_query($this->conn, $query);
        } catch (Exception $e) {
            $_SESSION["error_message"] = $e;
            $e->getMessage();
            return false;
        }
    }

    function deleteOrderProduct($op_id)
    {
        $query = "DELETE FROM `order_product` WHERE `op_id` = $op_id";

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
// INSERT INTO `order_product` (`op_id`, `od_id`, `prod_id`, `quantity`) VALUES (NULL, '1', '1', '12'), (NULL, '1', '6', '24');