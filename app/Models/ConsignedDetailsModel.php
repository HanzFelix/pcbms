<?php
include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/ConnectionModel.php";

class ConsignedDetailsModel extends ConnectionModel
{
    function getConsignedDetailsListOld($company)
    {
        $query = "SELECT cd.`cd_id` as `cd_id`, s.`company` as `company`, cd.`date_delivered` as `date` FROM `consigned_details` cd INNER JOIN `supplier` s ON s.supp_id = cd.supp_id WHERE s.`company` LIKE '%$company%'";
        try {
            $this->openConnection();

            $result = mysqli_query($this->conn, $query);

            return $result;
        } catch (Exception $e) {
            $_SESSION["error_message"] = $e->getMessage();
            return false;
        }
    }
    function getConsignedDetailsList()
    {
        $query = "SELECT cd.`cd_id` as `cd_id`, s.`company` as `company`, cd.`date_delivered` as `date`, CONCAT(p.`lname`, ', ', p.`fname`) as `personnel` FROM `consigned_details` cd LEFT JOIN `supplier` s ON s.supp_id = cd.supp_id LEFT JOIN `personnel` p ON p.empid = cd.empid ORDER BY cd.`cd_id` DESC";
        try {
            $this->openConnection();

            $result = mysqli_query($this->conn, $query);

            return $result;
        } catch (Exception $e) {
            $_SESSION["error_message"] = $e->getMessage();
            return false;
        }
    }

    function getConsignedDetails($cd_id)
    {
        $query = "SELECT cd.`cd_id` as `cd_id`, s.`company` as `company`, cd.`supp_id` as `supp_id`, cd.`empid` as `empid`, cd.`date_delivered` as `date`, CONCAT(p.`lname`, ', ', p.`fname`) as `personnel` FROM `consigned_details` cd INNER JOIN `supplier` s ON s.supp_id = cd.supp_id INNER JOIN `personnel` p ON p.empid = cd.empid  WHERE cd_id = '$cd_id'";
        try {
            $this->openConnection();

            $result = mysqli_query($this->conn, $query);

            // return only one result
            return mysqli_fetch_assoc($result);
        } catch (Exception $e) {
            $_SESSION["error_message"] = $e->getMessage();
            return false;
        }
    }

    function createConsignedDetails($supp_id, $date_delivered, $empid)
    {
        $query = "INSERT INTO `consigned_details` (`supp_id`, `date_delivered`, `empid`) VALUES (?,?,?)";

        try {
            $this->openConnection();

            $stmt = $this->conn->prepare($query);
            if ($stmt) {
                $stmt->bind_param("isi", $supp_id, $date_delivered, $empid);
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

    function updateConsignedDetails($cd_id, $supp_id, $date_delivered, $empid)
    {
        $query = "UPDATE `consigned_details` SET `supp_id` = ?, `date_delivered` = ?, `empid` = ? WHERE `cd_id` = ?";

        try {
            $this->openConnection();

            $stmt = $this->conn->prepare($query);
            if ($stmt) {
                $stmt->bind_param("isii", $supp_id, $date_delivered, $empid, $cd_id);
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

    function deleteConsignedDetails($cd_id)
    {
        $query = "DELETE FROM `consigned_details` WHERE `cd_id` = $cd_id";

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
