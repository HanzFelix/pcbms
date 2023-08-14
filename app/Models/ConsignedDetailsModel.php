<?php
include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/ConnectionModel.php";

class ConsignedDetailsModel extends ConnectionModel
{
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
    function getConsignedDetailsListNew()
    {
        $query = "SELECT cd.`cd_id` as `cd_id`, s.`company` as `company`, cd.`date_delivered` as `date`, u.`username` as `username` FROM `consigned_details` cd INNER JOIN `supplier` s ON s.supp_id = cd.supp_id INNER JOIN `users` u ON u.userid = cd.userid ORDER BY cd.`cd_id` DESC";
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
        $query = "SELECT cd.`cd_id` as `cd_id`, s.`company` as `company`, cd.`date_delivered` as `date`, u.`username` as `username` FROM `consigned_details` cd INNER JOIN `supplier` s ON s.supp_id = cd.supp_id INNER JOIN `users` u ON u.userid = cd.userid  WHERE cd_id = '$cd_id'";
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
