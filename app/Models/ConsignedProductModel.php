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
}
