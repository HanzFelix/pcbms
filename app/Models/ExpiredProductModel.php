<?php
include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/ConnectionModel.php";

class ExpiredProductModel extends ConnectionModel
{
    function getExpiredProductListFromSupplier($supp_id)
    {
        $query = "SELECT
            cp.cp_id,
            p.prod_name,
            SUM(cp.quantity) - COALESCE(SUM(ep.quantity), 0) - COALESCE(SUM(sp.qty_sold), 0) AS unsold_quantity,
            cd.date_delivered,
            cp.expiry_date
        FROM
            consigned_product cp
        LEFT JOIN
            consigned_details cd ON cd.cd_id = cp.cd_id
        LEFT JOIN
            supplier s ON s.supp_id = cd.supp_id
        LEFT JOIN
            expired_product ep ON ep.cp_id = cp.cp_id
        LEFT JOIN
            product p ON p.prod_id = cp.prod_id
        LEFT JOIN
            sale_product sp ON sp.cp_id = cp.cp_id
        WHERE
            cp.expiry_date <= CURDATE()
        AND
            s.supp_id = $supp_id
        GROUP BY
            cp.cp_id
        HAVING
            unsold_quantity <> 0;
        ";

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
    function getExpiredProductList($ed_id)
    {
        $query = "SELECT p.`prod_name` as `product-name`, 
        ep.`quantity` as `quantity`, 
        cp.`expiry_date` as `exp-date`, 
        ep.`ep_id` as `ep-id` 
        FROM `expired_product` ep 
        LEFT JOIN `consigned_product` cp 
        ON cp.`cp_id` = ep.`cp_id` 
        LEFT JOIN `product` p 
        ON p.`prod_id` = cp.`prod_id` 
        WHERE ep.`ed_id` = $ed_id";
        try {
            $this->openConnection();

            $result = mysqli_query($this->conn, $query);

            return $result;
        } catch (Exception $e) {
            $_SESSION["error_message"] = $e->getMessage();
            return false;
        }
    }

    function getExpiredProduct($ep_id)
    {
    }

    function createExpiredProduct($ed_id, $cp_id, $quantity)
    {
        $query = "INSERT INTO `expired_product` (`ed_id`, `cp_id`, `quantity`) VALUES (?,?,?)";
        try {
            $this->openConnection();

            $stmt = $this->conn->prepare($query);
            if (!$stmt) {
                throw new Exception($this->conn->error);
            }
            $stmt->bind_param("iii", $ed_id, $cp_id, $quantity);
            $stmt->execute();
            $stmt->close();

            $this->closeConnection();
        } catch (Exception $e) {
            $_SESSION["error_message"] = $e->getMessage();
            return false;
        }
    }

    function updateExpiredProduct($ep_id, $cp_id, $quantity)
    {
    }

    function deleteExpiredProduct($ep_id)
    {
    }
}
