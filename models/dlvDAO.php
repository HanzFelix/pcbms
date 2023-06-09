<?php
include "../../models/connectionDAO.php";

class DlvDAO extends ConnectionDAO
{
    // returns either the first user found or false
    function getConsignedDetailsList($company)
    {
        $query = "SELECT cd.`cd_id` as `cd_id`, s.`company` as `company`, cd.`date_delivered` as `date` FROM `consigned_details` cd INNER JOIN `supplier` s ON s.supp_id = cd.supp_id WHERE s.`company` LIKE '%$company%'";
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

    function getConsignedDetails($cd_id)
    {
        $query = "SELECT * FROM `consigned_details` WHERE cd_id = '$cd_id'";
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
    // returns either the first user found or false
    function getConsignedProducts($cd_id)
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
