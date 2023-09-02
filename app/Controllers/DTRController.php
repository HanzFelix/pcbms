<?php
include $_SERVER['DOCUMENT_ROOT'] . "/app/Models/DTRModel.php";

class DTRController
{
    public function processDTR()
    {
        $empid = $_POST['empid'];
        $datetime = date('Y-m-d H:i:s');
        $state = $_POST['state'];

        $dtrmodel = new DTRModel();
        $dtrmodel->processDTR($empid, $datetime, $state);

        header('Location: /personnel');
    }


    public function getLogs()
    {
        $dtrmodel = new DTRModel();
        $result = $dtrmodel->getLogs($_SESSION['empid']);
        $data = [];

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $date = (new DateTime($row["log"]))->format("m/d/Y");
                $time = (new DateTime($row["log"]))->format("h:i A");
                $data[] = [
                    '<span class="' . (date("m/d/Y") == $date ? "font-bold" : "") . '">' . $date . '</span>',
                    $time,
                    $row["state"]
                ];
            }
        } else {
            $data[] = ['No results found', '', ''];
        }

        $headerLabels = ["Date", "Time", "Log State"];
        include $_SERVER['DOCUMENT_ROOT'] . "/resources/partials/table.php";
        echo generateTable($data, $headerLabels);
    }

    public function hasLoggedInToday()
    {
        $dtrmodel = new DTRModel();
        $result = $dtrmodel->getLogs($_SESSION['empid'], date('Y-m-d'));

        $row = $result->fetch_assoc();
        $state = ($result->num_rows > 0 && $row['state'] === 'in') ? "out" : "in";

        return $state;
    }
}
