<?php
include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/ConnectionModel.php";

class ConsignedProductModel extends ConnectionModel
{
    function getConsignedProductList($cd_id)
    {
        $query = "SELECT p.`prod_name` as `product-name`, cp.`quantity` as `quantity`, cp.`barcode` as `barcode`, cp.`particulars` as `particulars`, cp.`item_id` as `item-id`, cp.`expiry_date` as `exp-date`, cp.`unit_price` as `unit-price`, cp.`selling_price` as `selling-price` FROM `consigned_product` cp LEFT JOIN `product` p ON p.`prod_id` = cp.`prod_id` WHERE cp.`cd_id` = '$cd_id' ";
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

    function getConsignedProduct($cp_id)
    {
        $query = "SELECT * FROM `consigned_product` cp LEFT JOIN `product` p ON  p.`prod_id` = cp.`prod_id` WHERE cp.`item_id` = '$cp_id'";
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

    function createConsignedProduct($cd_id, $prod_id, $barcode, $particulars, $expiry_date, $unit_price, $selling_price, $quantity, $amount)
    {
        $query = "INSERT INTO `consigned_product` (`cd_id`, `prod_id`, `barcode`, `particulars`, `expiry_date`, `unit_price`, `selling_price`, `quantity`, `amount`) VALUES (?,?,?,?,?,?,?,?,?)";

        try {
            $this->openConnection();

            $stmt = $this->conn->prepare($query);
            if ($stmt) {
                $stmt->bind_param("iisssiiii", $cd_id, $prod_id, $barcode, $particulars, $expiry_date, $unit_price, $selling_price, $quantity, $amount);
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

    function updateConsignedProduct($item_id, $prod_id, $barcode, $particulars, $expiry_date, $unit_price, $selling_price, $quantity, $amount)
    {
        $query = "UPDATE `consigned_product` SET `prod_id` = ?, `barcode` = ?, `particulars` = ?, `expiry_date` = ?, `unit_price` = ?, `selling_price` = ?, `quantity` = ?, `amount` = ? WHERE `item_id` = ?";

        try {
            $this->openConnection();

            $stmt = $this->conn->prepare($query);
            if ($stmt) {
                $stmt->bind_param("isssiiiii", $prod_id, $barcode, $particulars, $expiry_date, $unit_price, $selling_price, $quantity, $amount, $item_id);
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

    function deleteConsignedProducts($cd_id)
    {
        $query = "DELETE FROM `consigned_product` WHERE `consigned_product`.`cd_id` = $cd_id";

        try {
            $this->openConnection();

            mysqli_query($this->conn, $query);
        } catch (Exception $e) {
            $_SESSION["error_message"] = $e;
            $e->getMessage();
            return false;
        }
    }

    function deleteConsignedProduct($cp_id)
    {
        $query = "DELETE FROM `consigned_product` WHERE `consigned_product`.`item_id` = $cp_id";

        try {
            $this->openConnection();

            mysqli_query($this->conn, $query);
        } catch (Exception $e) {
            $_SESSION["error_message"] = $e;
            $e->getMessage();
            return false;
        }
    }
    //UPDATE `consigned_product` SET `cd_id` = '1', `prod_id` = '3', `barcode` = '1234568', `particulars` = '25.00', `unit_price` = '21.00', `selling_price` = '26.00', `quantity` = '9', `amount` = '189.00' WHERE `consigned_product`.`item_id` = 3;
    //INSERT INTO `consigned_product` (`item_id`, `cd_id`, `prod_id`, `barcode`, `particulars`, `expiry_date`, `unit_price`, `selling_price`, `quantity`, `amount`) VALUES (NULL, '2', '4', '123456', '20.00', '2023-08-16', '20.00', '25.00', '10', '200.00');
}
