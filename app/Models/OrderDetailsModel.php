<?php
include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/ConnectionModel.php";

class OrderDetailsModel extends ConnectionModel
{
    function getOrderDetailsList()
    {
        $query = "SELECT od.`od_id` as `od_id`, s.`company` as `company`, od.`order_date` as `date`,  CONCAT(p.`lname`, ', ', p.`fname`) as `personnel`, od.`status` as `status` FROM `order_details` od INNER JOIN `supplier` s ON s.supp_id = od.supp_id INNER JOIN `personnel` p ON p.empid = od.emp_id";
        try {
            $this->openConnection();

            $result = mysqli_query($this->conn, $query);

            return $result;
        } catch (Exception $e) {
            $_SESSION["error_message"] = $e->getMessage();
            return false;
        }
    }

    function getOrderDetails($od_id)
    {
        $query = "SELECT od.`od_id` as `od_id`, s.`company` as `supplier`, od.`order_date` as `date`,  CONCAT(p.`lname`, ', ', p.`fname`) as `personnel`, od.`status` as `status`, od.`emp_id` as `emp_id`, od.`supp_id` as `supp_id` FROM `order_details` od INNER JOIN `supplier` s ON s.supp_id = od.supp_id INNER JOIN `personnel` p ON p.empid = od.emp_id WHERE od.od_id = '$od_id'";
        try {
            $this->openConnection();

            $result = mysqli_query($this->conn, $query);

            return mysqli_fetch_assoc($result);
        } catch (Exception $e) {
            $_SESSION["error_message"] = $e->getMessage();
            return false;
        }
    }

    function createOrderDetails($supp_id, $emp_id, $order_date, $status)
    {
        $query = "INSERT INTO `order_details` (`supp_id`, `emp_id`, `order_date`, `status`) VALUES (?,?,?,?)";
        try {
            $this->openConnection();

            $stmt = $this->conn->prepare($query);
            if ($stmt) {
                $stmt->bind_param("iiss", $supp_id, $emp_id, $order_date, $status);
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

    function updateOrderDetails($od_id, $supp_id, $emp_id, $order_date, $status)
    {
        $query = "UPDATE `order_details` SET `supp_id` = ?, `emp_id` = ?, `order_date` = ?, `status` = ? WHERE `od_id` = ?";

        try {
            $this->openConnection();

            $stmt = $this->conn->prepare($query);
            if ($stmt) {
                $stmt->bind_param("iissi", $supp_id, $emp_id, $order_date, $status, $od_id);
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

    function deleteOrderDetails($od_id)
    {
        $query = "DELETE FROM `order_details` WHERE `od_id` = $od_id";

        try {
            $this->openConnection();

            mysqli_query($this->conn, $query);
            $this->closeConnection();
        } catch (Exception $e) {
            $_SESSION["error_message"] = $e->getMessage();
            return false;
        }
    }
}
