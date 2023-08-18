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
        $results = $dtrmodel->getLogs($_SESSION['empid']);
        $html = '';
        $i = 0;
        foreach ($results as $row) {
            $date = (new DateTime($row["log"]))->format("m/d/Y");
            $time = (new DateTime($row["log"]))->format("h:i A");
            $html .= '<tr class="bg-accent ' . ($i % 2 == 0 ? "bg-opacity-10" : "bg-opacity-25") . '">
                <td class="px-4 py-2' . (date("m/d/Y") == $date ? " font-bold" : "") . '">' . $date . ' </td>
                <td class="px-4 py-2">' . $time . ' </td>
                <td class="px-4 py-2">' . $row["state"] . ' </td>
            </tr>';
            $i++;
        }

        return $html;
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
