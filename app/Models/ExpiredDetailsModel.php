<?php
include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/ConnectionModel.php";

class ExpiredDetailsModel extends ConnectionModel
{
    public function getExpiredListBySupplier()
    {
        $query = "SELECT
            s.supp_id,
            s.company as company,
            SUM(cp.quantity) - COALESCE(SUM(ep.quantity),0) AS expired_total
        FROM
            supplier s
        LEFT JOIN
            consigned_details cd ON cd.supp_id = s.supp_id
        LEFT JOIN
            consigned_product cp ON cp.cd_id = cd.cd_id
        LEFT JOIN
            expired_product ep ON ep.cp_id = cp.cp_id
        WHERE
            cp.expiry_date <= CURDATE()
        GROUP BY
            s.supp_id
        HAVING
            expired_total <> 0;";

        try {
            $this->openConnection();

            $result = mysqli_query($this->conn, $query);

            return $result;
        } catch (Exception $e) {
            $_SESSION["error_message"] = $e->getMessage();
            return false;
        }
    }

    function getExpiredDetailsList()
    {
        $query = "SELECT ed.`ed_id` as `ed_id`, 
        s.`company` as `company`, 
        ed.`return_date` as `date`, 
        CONCAT(p.`lname`, ', ', p.`fname`) as `personnel` 
        FROM `expired_details` ed 
        INNER JOIN `supplier` s 
        ON s.supp_id = ed.supp_id 
        INNER JOIN `personnel` p 
        ON p.empid = ed.empid 
        ORDER BY ed.`ed_id` DESC";
        try {
            $this->openConnection();

            $result = mysqli_query($this->conn, $query);

            return $result;
        } catch (Exception $e) {
            $_SESSION["error_message"] = $e->getMessage();
            return false;
        }
    }

    function getExpiredDetails($ed_id)
    {
        $query = "SELECT ed.`ed_id` as `ed_id`, 
        s.`company` as `company`, 
        ed.`supp_id` as `supp_id`, 
        ed.`empid` as `empid`, 
        ed.`return_date` as `date`, 
        CONCAT(p.`lname`, ', ', p.`fname`) as `personnel` 
        FROM `expired_details` ed 
        INNER JOIN `supplier` s 
        ON s.supp_id = ed.supp_id 
        INNER JOIN `personnel` p 
        ON p.empid = ed.empid 
        WHERE ed_id = $ed_id";
        try {
            $this->openConnection();

            $result = mysqli_query($this->conn, $query);

            return mysqli_fetch_assoc($result);
        } catch (Exception $e) {
            $_SESSION["error_message"] = $e->getMessage();
            return false;
        }
    }

    function createExpiredDetails($supp_id, $empid, $return_date)
    {
        $query = "INSERT INTO `expired_details` (`supp_id`, `empid`, `return_date`) VALUES (?,?,?)";
        try {
            $this->openConnection();

            $stmt = $this->conn->prepare($query);
            if ($stmt) {
                $stmt->bind_param("iis", $supp_id, $empid, $return_date);
                $stmt->execute();
                $lastID = $this->getLastInsertID();
                $stmt->close();
            } else {
                throw new Exception($this->conn->error);
            }
            $this->closeConnection();
            return $lastID;
        } catch (Exception $e) {
            $_SESSION["error_message"] = $e->getMessage();
            return false;
        }
    }

    function updateExpiredDetails($ed_id, $supp_id, $empid, $return_date)
    {
    }

    function deleteExpiredDetails($ed_id)
    {
    }
}
