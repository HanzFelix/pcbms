<?php
include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/ConnectionModel.php";

class SaleDetailsModel extends ConnectionModel
{
    function getSaleDetailsList()
    {
        $query = "SELECT 
            sd.sd_id, 
            sd.date_issued as `date`, 
            c.name as customer, 
            CONCAT(p.lname, ', ', p.fname) as personnel
        FROM 
            sale_details sd 
        LEFT JOIN 
            customer c ON c.cust_id = sd.cust_id
        LEFT JOIN 
            personnel p ON p.empid = sd.empid";
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

    function getSaleDetails($sd_id)
    {
        $query = "SELECT 
            sd.date_issued as `date`, 
            c.name as customer, 
            CONCAT(p.lname, ', ', p.fname) as personnel
        FROM 
            sale_details sd 
        LEFT JOIN 
            customer c ON c.cust_id = sd.cust_id
        LEFT JOIN 
            personnel p ON p.empid = sd.empid
        WHERE sd.sd_id = '$sd_id'";
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

    function createSaleDetails($date_issued, $cust_id, $emp_id)
    {
        $query = "INSERT INTO `sale_details` (`date_issued`, `cust_id`, `empid`) VALUES (?,?,?)";
        try {
            $this->openConnection();

            $stmt = $this->conn->prepare($query);
            if ($stmt) {
                $stmt->bind_param("sii", $date_issued, $cust_id, $emp_id);
                $stmt->execute();
                $lastID = $this->getLastInsertID();
                $stmt->close();
            } else {
                throw new Exception($this->conn->error);
            }

            $this->closeConnection();
            return $lastID;
        } catch (Exception $e) {
            $_SESSION["error_message"] = $e;
            $e->getMessage();
            return false;
        }
    }

    function updateSaleDetails($sd_id, $supp_id, $emp_id, $order_date, $status)
    {
        $query = "UPDATE `sale_details` SET `supp_id` = ?, `emp_id` = ?, `order_date` = ?, `status` = ? WHERE `sd_id` = ?";

        try {
            $this->openConnection();

            $stmt = $this->conn->prepare($query);
            if ($stmt) {
                $stmt->bind_param("iissi", $supp_id, $emp_id, $order_date, $status, $sd_id);
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

    function deleteSaleDetails($sd_id)
    {
        $query = "DELETE FROM `sale_details` WHERE `sd_id` = $sd_id";

        try {
            $this->openConnection();

            mysqli_query($this->conn, $query);
            $this->closeConnection();
        } catch (Exception $e) {
            $_SESSION["error_message"] = $e;
            $e->getMessage();
            return false;
        }
    }
}
// INSERT INTO `sale_details` (`sd_id`, `supp_id`, `emp_id`, `order_date`, `status`) VALUES (NULL, '1', '1', '2023-08-23', 'Pending');