<?php
include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/ConnectionModel.php";

class SaleProductModel extends ConnectionModel
{
    function getSaleProductList($od_id)
    {
        //`sp_id`, `od_id`, `prod_id`, `quantity`
        $query = "SELECT sp.`sp_id` as `sp-id`, p.`prod_name` as `product`, sp.`quantity` as `quantity` FROM `sale_product` sp LEFT JOIN `product` p ON p.`prod_id` = sp.`prod_id` WHERE sp.`od_id` = '$od_id'";
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

    function getSaleProduct($sp_id)
    {
        $query = "SELECT * FROM `sale_product` sp LEFT JOIN `product` p ON  p.`prod_id` = sp.`prod_id` WHERE sp.`sp_id` = '$sp_id'";
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

    function createSaleProduct($sd_id, $cp_id, $qty_sold, $amount_sold)
    {
        $query = "INSERT INTO `sale_product` (`sd_id`, `cp_id`, `qty_sold`, `amount_sold`) VALUES (?,?,?,?)";

        try {
            $this->openConnection();

            $stmt = $this->conn->prepare($query);
            if ($stmt) {
                $stmt->bind_param("iiii", $sd_id, $cp_id, $qty_sold, $amount_sold);
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

    function updateSaleProduct($op_id, $prod_id, $quantity)
    {
        $query = "UPDATE `sale_product` SET `prod_id` = ?, `quantity` = ? WHERE `op_id` = ?";

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

    function deleteSaleProducts($od_id)
    {
        $query = "DELETE FROM `sale_product` WHERE `od_id` = $od_id";

        try {
            $this->openConnection();

            mysqli_query($this->conn, $query);
        } catch (Exception $e) {
            $_SESSION["error_message"] = $e;
            $e->getMessage();
            return false;
        }
    }

    function deleteSaleProduct($sp_id)
    {
        $query = "DELETE FROM `sale_product` WHERE `sp_id` = $sp_id";

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
// INSERT INTO `sale_product` (`sp_id`, `od_id`, `prod_id`, `quantity`) VALUES (NULL, '1', '1', '12'), (NULL, '1', '6', '24');