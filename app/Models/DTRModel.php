<?php
include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/ConnectionModel.php";

class DTRModel extends ConnectionModel
{
    function processDTR($empid, $log, $state)
    {
        $query = "INSERT INTO `dtr` (`empid`, `log`, `state`) VALUES ('$empid', '$log', '$state')";
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

    public function getLogs($empid, $date = "")
    {
        if (!empty($date)) {
            $date = "AND DATE(log) = '$date'";
        }
        $query = "SELECT * FROM dtr WHERE empid = $empid $date order by id DESC";
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
}
